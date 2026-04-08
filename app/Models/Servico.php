<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = ['duracao', 'preco', 'descricao', 'id_barbeiro'];

    public function barbeiro(){
        return $this->belongsTo(Barbeiro::class, 'id_barbeiro', 'id');
    }

    public function agendamentos(){
        return $this->hasMany('App\Models\Agendamento', 'id_servico', 'id');
    }
}
