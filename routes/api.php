<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Mail;
use App\Mail\Restablecer;


/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);
Route::get('/informacion', [LoginController::class, 'get'])->middleware('auth:sanctum');
Route::get('/miavance', [LoginController::class, 'getid'])->middleware('auth:sanctum');
Route::post('/progreso', [RegistroController::class, 'post'])->middleware('auth:sanctum');
Route::get('/miprogreso', [RegistroController::class, 'getprogresobyid'])->middleware('auth:sanctum');
Route::post('/restablecer', [LoginController::class, 'recuperar']);
Route::post('/update', [LoginController::class, 'changed']);
Route::get('/certificado/{id}',[RegistroController::class,'EnviarCertificado']);
