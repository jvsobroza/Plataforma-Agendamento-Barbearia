<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Http\Requests\StoreServicoRequest;
use App\Http\Requests\UpdateServicoRequest;
use App\Models\Barbeiro;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;

class ServicoController extends Controller
{
    public function index()
    {
        $barbeiro = Auth::user()->barbeiro;
        $servicos = Servico::where('id_barbeiro', $barbeiro->id)->get();
        $agendamentos = Agendamento::where('id_barbeiro', $barbeiro->id)->get();
        return view('Barbeiro.index', [
            'servicos' => $servicos,
            'agendamentos' => $agendamentos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barbeiro = Barbeiro::all();
        return view('servico.create', compact('barbeiro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicoRequest $request)
    {
        $barbeiroId = Auth::user()->barbeiro->id;
        $tempoF = gmdate("H:i:s", $request->duracao * 60);
        Servico::create([
            'id_barbeiro' => $barbeiroId,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'duracao' => $tempoF,
        ]);
        return redirect()->route('barbeiro.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        return view('servico.show', compact('servico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $servico = Servico::findOrFail($id);
        $barbeiro = Barbeiro::all();
        return view('servico.edit', compact('servico', 'barbeiro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicoRequest $request, $id)
    {
        $servico = Servico::findOrFail($id);
        $barbeiroId = Auth::user()->barbeiro->id;
        $tempoF = gmdate("H:i:s", $request->duracao * 60);
        $servico->update([
            'id_barbeiro' => $barbeiroId,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'duracao' => $tempoF,
        ]);
        return redirect()->route('barbeiro.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Servico::destroy($id);
        return redirect()->route('barbeiro.servico.index');
    }
}
