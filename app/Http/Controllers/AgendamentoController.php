<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Http\Requests\StoreAgendamentoRequest;
use App\Http\Requests\UpdateAgendamentoRequest;
use App\Models\Barbeiro;
use App\Models\Cliente;
use App\Models\Servico;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cliente = Auth::user()->cliente;
        $agendamentos = Agendamento::where('id_cliente', $cliente->id)->get();
        return view('cliente.index', [
            'agendamentos' => $agendamentos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servico = Servico::all();
        $barbeiro = Barbeiro::has('usuario')->with('usuario')->get();
        return view('agendamento.create', compact('servico', 'barbeiro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgendamentoRequest $request)
    {
        $dados = $request->validated();
        $dados['id_cliente'] = Auth::user()->cliente->id;
        $dados['status'] = 'confirmado';
        $conflito = Agendamento::where('id_barbeiro', $dados['id_barbeiro'])
            ->where('data', $dados['data'])
            ->where('hora', $dados['hora'])
            ->where('status', 'confirmado')
            ->exists();
        if ($conflito) {
            return redirect()->back()
                ->withErrors(['hora' => 'Este horário já está ocupado para este barbeiro.'])
                ->withInput();
        }

        Agendamento::create($dados);
        return redirect()->route('cliente.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agendamento = Agendamento::find($id);

        if (!$agendamento) {
            return redirect()->back()->with('erro', 'Agendamento não encontrado!');
        }

        $user = Auth::user();

        if ($user->tipo == 1) {
            if ($user->barbeiro->id !== $agendamento->id_barbeiro) {
                return redirect()->back()->with('erro', 'Você não tem permissão!');
            }
        } else {
            if ($user->cliente->id !== $agendamento->id_cliente) {
                return redirect()->back()->with('erro', 'Você não tem permissão!');
            }
        }

        return view('agendamento.show', compact('agendamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agendamento $agendamento)
    {
        $agendamento = Agendamento::findOrFail($agendamento->id);
        $servico = Servico::all();
        $barbeiro = Barbeiro::all();
        $cliente = Cliente::all();
        return view('agendamento.edit', compact('agendamento', 'servico', 'barbeiro', 'cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendamentoRequest $request, Agendamento $agendamento)
    {
        $agendamento->update(['status' => $request->status]);

        return redirect()->route('barbeiro.index', $agendamento->id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Agendamento::destroy($id);

        $user = Auth::user();

        if ($user->tipo == 1) {
            return redirect()->route('barbeiro.agendamento.index');
        }

        return redirect()->route('cliente.agendamento.index');
    }
}
