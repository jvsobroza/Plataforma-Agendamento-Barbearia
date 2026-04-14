<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
   public function index()
    {
        $user = User::latest()->paginate(5);
        return view('user.index', compact('user'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::transaction(function () use ($request) {
        
        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $request->password,
            'tipo' => $request->tipo,
        ]);
        if ($user->tipo == 1) { //barbeiro
            $request->validate(['telefone' => 'required|string']);
            $user->barbeiro()->create([
                'telefone' => $request->telefone,
            ]);
        } 
        else
            if ($user->tipo == 2) {//Cliente
            $request->validate(['endereco' => 'required|string']);
            $user->cliente()->create([
                'endereco' => $request->endereco,
            ]);
        }
    });
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());


        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index');
    }
}
