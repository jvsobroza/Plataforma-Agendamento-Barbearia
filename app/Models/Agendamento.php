<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = ['id_servico', 'id_barbeiro', 'id_cliente', 'data', 'hora', 'status'];

    public function servico(){
        return $this->belongsTo(Servico::class, 'id_servico', 'id');
    }

    public function barbeiro(){
        return $this->belongsTo(Barbeiro::class, 'id_barbeiro', 'id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
}
