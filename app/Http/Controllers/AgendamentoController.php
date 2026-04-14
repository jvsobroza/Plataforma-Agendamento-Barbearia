<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Http\Requests\StoreAgendamentoRequest;
use App\Http\Requests\UpdateAgendamentoRequest;
use App\Models\Barbeiro;
use App\Models\Cliente;
use App\Models\Servico;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendamento = Agendamento::latest()->paginate(5);
        return view('agendamento.index', compact('agendamento'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servico = Servico::all();
        $barbeiro = Barbeiro::all();
        $cliente = Cliente::all();
        return view('agendamento.create', compact('servico', 'barbeiro', 'cliente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgendamentoRequest $request)
    {
        $request->validate([
            'data' => 'required',
            'hora' => 'required',
            'id_cliente' => 'required',
        ]);

        Agendamento::create($request->all());

        return redirect()->route('agendamento.index')->with('success', 'Agendamento criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agendamento $agendamento)
    {
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
        return view('agendamento.edit', compact('agendamento', 'servico', 'barbeiro', 'cliente'));}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendamentoRequest $request, Agendamento $agendamento)
    {
       $agendamento = Agendamento::findOrFail($agendamento->id);
        $agendamento->update($request->all());


        return redirect()->route('agendamento.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Agendamento::destroy($id);
        return redirect()->route('agendamento.index');
    }
}
