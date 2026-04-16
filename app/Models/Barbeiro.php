<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barbeiro extends Model
{
    protected $table = 'barbeiros';
    protected $fillable = ['telefone', 'id_usuario'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function barbearia(){

    }

    public function servicos(){
        return $this->hasMany(Servico::class, 'id_barbeiro', 'id');
    }

    public function agendamentos(){
        return $this->hasMany('App\Models\Agendamento', 'id_barbeiro', 'id');
    }
}
