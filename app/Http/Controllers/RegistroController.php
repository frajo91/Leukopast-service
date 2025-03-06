<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registro;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RegistroResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\certificado;
  use App\Models\User;
  use Barryvdh\DomPDF\Facade\Pdf;

class RegistroController extends Controller
{
    //
    public function get(Request $request)
    {
        return response()->json(['datos'=>RegistroResource::collection(registro::with('usuario')->get())]);
    }

    public function getid(Request $request)
    {
        $user=auth()->user()->id;
        $registro=registro::with('usuario')->where('user_id',$user)->first();
         return response()->json(['datos'=>new RegistroResource($registro)]);
    }

    public function post(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'progreso' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['mensaje' => 'No hay registros del progreso'],400);
        }

        //validamos si existe un registro de progreso previo
        $score=registro::where('user_id',auth()->user()->id)->first();
        if ($score) {
            $registro=$score;
        }else{
            $registro=new registro();
            $registro->user_id=auth()->user()->id;
        }
        $registro->progreso=json_encode($request->progreso);
        if($registro->save()){

            $registrofinal=registro::with('usuario')->where('user_id',auth()->user()->id)->first();
            if ($registrofinal->enviado===0) {
                $progreso=collect(json_decode(json_decode($registrofinal->progreso)));
                $lessons=collect(json_decode(json_encode($progreso['lessons']),true));
                $estado=(isset($lessons['5']['s']))?($lessons['5']['s']>=$lessons['5']['ps'])?1:0: 0;
                $origin=collect([1,2,3,4,5,6]);
                $lessiones=$lessons->keys()->map(function (int $item, int $key) {
                            return $item +1;
                        });
                if($estado===1&&count($origin->diff($lessiones))===0){
                    $this->EnviarCertificado(auth()->user()->id);
                }
            }

            return response()->json(['mensaje' => 'Progreso registrado']);
        }
        return response()->json(['mensaje' => 'Error al guardar el progreso'],400);
    }

     public function getprogresobyid(Request $request)
    {
        $user=auth()->user()->id;
        $registro=registro::where('user_id',$user)->first();
        if($registro){
         return response()->json(['datos'=>json_decode($registro->progreso)]);
        }else{
          return response()->json(['datos'=>null]);
        }
    }

    public function EnviarCertificado($id)
    {
        $user=User::find($id);
        Mail::to($user->email)->send(new certificado($user->name.' '.$user->lastname));
        $score=registro::where('user_id',$user->id)->first();
        $score->enviado=true;
        $score->save();
        return response()->json(['mensaje' => 'Correo enviado']);
        /*$pdf = Pdf::loadView('certificado', ['usuario' => 'Fraiber Pabon'])->setPaper('11x17', 'landscape');
        return $pdf->stream();*/

    }
}
