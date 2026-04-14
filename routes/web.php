<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\BarbeiroController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('cliente', ClienteController::class);
Route::resource('barbeiro', BarbeiroController::class);
Route::resource('servico', ServicoController::class);
Route::resource('agendamento', AgendamentoController::class);
Route::resource('user', UserController::class);
Route::get('/', function () {
    return view('welcome');
});
