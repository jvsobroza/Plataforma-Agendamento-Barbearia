<?php

namespace App\Http\Controllers;

use App\Models\Barbeiro;
use App\Http\Requests\StoreBarbeiroRequest;
use App\Http\Requests\UpdateBarbeiroRequest;
use App\Models\User;

class BarbeiroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barbeiro = Barbeiro::latest()->paginate(5);
        return view('barbeiro.index', compact('barbeiro'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        return view('barbeiro.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarbeiroRequest $request)
    {
        Barbeiro::create($request->all());
        return redirect()->route('barbeiro.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barbeiro $barbeiro)
    {
        return view('barbeiro.show', compact('barbeiro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barbeiro = Barbeiro::findOrFail($id);
        $user = User::all();
        return view('barbeiro.edit', compact('barbeiro', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarbeiroRequest $request, $id)
    {
        $barbeiro = Barbeiro::findOrFail($id);
        $barbeiro->update($request->all());


        return redirect()->route('barbeiro.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Barbeiro::destroy($id);
        return redirect()->route('barbeiro.index');
    }
}
