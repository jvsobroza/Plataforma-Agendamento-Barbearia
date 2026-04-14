<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Http\Requests\StoreServicoRequest;
use App\Http\Requests\UpdateServicoRequest;
use App\Models\Barbeiro;

class ServicoController extends Controller
{
    public function index()
    {
        $servico = Servico::latest()->paginate(5);
        return view('servico.index', compact('servico'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        Servico::create($request->all());
        return redirect()->route('servico.index');
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
        $servico->update($request->all());


        return redirect()->route('servico.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Servico::destroy($id);
        return redirect()->route('servico.index');
    }
}
