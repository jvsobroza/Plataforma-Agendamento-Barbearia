<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\BarbeiroController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\UserController;
use App\Http\Requests\StoreUserRequest;
use App\Models\Barbeiro;
use App\Models\Cliente;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::resource('cliente', ClienteController::class);
Route::resource('barbeiro', BarbeiroController::class);
Route::resource('servico', ServicoController::class);
Route::resource('agendamento', AgendamentoController::class);
Route::resource('user', UserController::class);
Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::post('/login', function (Request $request) {
    }); //fazer
Route::post('/registrar', function (StoreUserRequest $request) {
    $data = $request->validated();
    $user = User::create([
        'nome'     => $data['nome'],
        'email'    => $data['email'],
        'password' => bcrypt($data['password']),
        'tipo'     => $data['tipo'],
    ]);

    if ($user->tipo == 1) { //Barbeiro
        Barbeiro::create([
            'id_usuario' => $user->id,
            'telefone'   => $data['telefone'],
        ]);
    } else { //Cliente
        Cliente::create([
            'id_usuario' => $user->id,
            'endereco'   => $data['endereco'],
        ]);
    }
    return redirect()->intended('/');
});
