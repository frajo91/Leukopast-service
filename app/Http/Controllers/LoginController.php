<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Restablecer;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nickname' => 'required|string',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['mensaje' => 'Información insuficiente'],401);
        }

        $credentials = $request->only(['nickname', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['mensaje' => 'Usuario o contraseña incorrecto'], 401);
        }

        $user = Auth::user();
        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token,'Inactivo'=>$user->ISADMIN,'restart'=>$user->remember_token]);

    }

     public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'mensaje' => 'Successfully logged out'
        ]);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'lastname'=>'required|string',
            'id_number'=>'required|string',
            'business'=>'required|string',
            'client'=>'required|string',
            'position'=>'required|string',
            'country'=>'required|string',
            'city'=>'required|string',
            'phone'=>'required|regex:/^(\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9})$/',
            'nickname' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('email')) {
                return response()->json(['mensaje' => 'Ya hay un usuario registrado con este correo.'],401);
            }
            if ($validator->errors()->has('nickname')) {
                //return response()->json(['mensaje' => $validator->errors()],401);
                return response()->json(['mensaje' => 'El usuario ya esta siendo utilizado, por favor cambielo.'],401);
            }

            //return response()->json(['mensaje' => $validator->errors()],401);
            return response()->json(['mensaje' => 'La información proporcionada es incorrecta'],401);
        }

        $validatedData=$request->all();


        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'lastname'=>$validatedData['lastname'],
            'id_number'=>$validatedData['id_number'],
            'business'=>$validatedData['business'],
            'client'=>$validatedData['client'],
            'position'=>$validatedData['position'],
            'country'=>$validatedData['country'],
            'city'=>$validatedData['city'],
            'phone'=>$validatedData['phone'],
            'country'=>$validatedData['country'],
            'nickname' =>$validatedData['nickname'],
        ]);


        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token]);

    }

    public function getid(Request $request)
    {
        $user=auth()->user()->id;
        $registro=User::with('registro')->find($user);
        return response()->json(['datos'=>new UserResource($registro)]);
    }

    public function get(Request $request)
    {
        $user=auth()->user()->id;
        $registro=User::with('registro')->get();
        return response()->json(['datos'=>UserResource::collection(($registro))]);
    }

    public function recuperar(Request $request){
        $validator = Validator::make($request->all(), [
            'correo' => 'required|email',
        ]);
         if ($validator->fails()) {
            return response()->json(['mensaje' => 'Correo invalido'],401);
        }
        $validatedData=$request->all();

        $registro=User::where('email',$validatedData['correo'])->first();
        if ($registro) {
            //generamos contraseña
            $new_password=Str::random(12);
            $registro->password = Hash::make($new_password);
            $registro->remember_token=1;
            $registro->save();
            Mail::to($validatedData['correo'])->send(new Restablecer($registro->nickname,$new_password));
            return response()->json(['mensaje' => 'Correo enviado']);
        }else{
            return response()->json(['mensaje' => 'Correo invalido'],401);
        }

    }

     public function changed(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['mensaje' => 'Contraseña requerida'],401);
        }
        $validatedData=$request->all();
        $user=auth()->user();
        $user->password=Hash::make($request->password);
        $user->remember_token=0;
        if ($user->save()) {
             return response()->json(['mensaje'=>'Contraseña actualizada']);
        }
        return response()->json(['mensaje' => 'Error al actualizar contraseña'],401);
    }
}
