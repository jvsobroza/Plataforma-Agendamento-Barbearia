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
Route::resource('clientes', ClienteController::class);
Route::resource('barbeiros', BarbeiroController::class);
Route::resource('servicos', ServicoController::class);
Route::resource('agendamentos', AgendamentoController::class);
Route::resource('users', UserController::class);
Route::get('/', function () {
    return view('welcome');
});
