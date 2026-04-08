<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['endereco', 'id_usuario'];

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario', 'id_cliente');
    }
    public function agendamentos(){
        return $this->hasMany('App\Models\Agendamento', 'id_cliente', 'id');
    }
}
