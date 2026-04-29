<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\BarbeiroController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckBarbeiro;
use App\Http\Middleware\CheckCliente;
use App\Http\Requests\StoreUserRequest;
use App\Models\Barbeiro;
use App\Models\Cliente;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Servico;
use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::resource('cliente', ClienteController::class);
Route::resource('barbeiro', BarbeiroController::class);
Route::resource('user', UserController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->tipo == 1) {
            return redirect()->intended('/barbeiro');
        } else {
            return redirect()->intended('/cliente');
        }
    }

    return back()->withErrors([
        'email' => 'As credenciais fornecidas não são válidas ou não existem.',
    ])->onlyInput('email');
});

Route::post('/registrar', function (StoreUserRequest $request) {
    $data = $request->validated();

    $user = User::create([
        'nome' => $data['nome'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'tipo' => $data['tipo'],
    ]);

    if ($user->tipo == 1) {
        Barbeiro::create([
            'id_usuario' => $user->id,
            'telefone' => $data['telefone'],
        ]);
    } else {
        Cliente::create([
            'id_usuario' => $user->id,
            'endereco' => $data['endereco'],
        ]);
    }

    return redirect()->intended('/');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware([CheckBarbeiro::class])->prefix('barbeiro')->name('barbeiro.')->group(function () {

    Route::get('/', function () {
        $barbeiro = Auth::user()->barbeiro;
        $servicos = Servico::where('id_barbeiro', $barbeiro->id)->get();
        $agendamentos = Agendamento::where('id_barbeiro', $barbeiro->id)
            ->where('status', '!=', 'cancelado') //ignorar os cancelados
            ->orderByRaw("FIELD(status, 'confirmado', 'concluido')") //primeiro os confirmados, depois os concluídos
            ->get();
        return view('barbeiro.index', [
            'servicos' => $servicos,
            'agendamentos' => $agendamentos,
        ]);
    })->name('index');
    Route::resource('agendamento', AgendamentoController::class)
        ->except(['create', 'store']);
    Route::resource('servico', ServicoController::class);
});

Route::middleware([CheckCliente::class])->prefix('cliente')->name('cliente.')->group(function () {

    Route::get('/', function () {
        $cliente = Auth::user()->cliente;
        $agendamentos = Agendamento::where('id_cliente', $cliente->id)
            ->orderByRaw("FIELD(status, 'confirmado', 'concluido', 'cancelado')") //primeiro os confirmados, depois os concluídos
            ->get();
        return view('cliente.index', [
            'agendamentos' => $agendamentos,
        ]);
    })->name('index');
    Route::resource('agendamento', AgendamentoController::class)
        ->only(['create', 'store', 'index', 'show', 'destroy']);
});