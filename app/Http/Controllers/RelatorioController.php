<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
class RelatorioController extends Controller
{
public function relatorioAgendamentos()
{
    $barbeiroId = auth()->user()->barbeiro->id;
    $agendamentos = Agendamento::with(['cliente', 'servico'])
        ->where('id_barbeiro', $barbeiroId)
        ->orderByRaw('FIELD(status, "confirmado", "concluido", "cancelado"), data DESC, hora DESC')
        ->get();

    $lucro = $agendamentos->whereIn('status', ['concluido', 'confirmado'])->sum('servico.preco');

    $servicos = Agendamento::where('id_barbeiro', $barbeiroId)
        ->whereIn('status', ['concluido', 'confirmado'])
        ->select('id_servico', DB::raw('count(*) as total'))
        ->groupBy('id_servico')
        ->orderBy('total', 'desc')
        ->with('servico')
        ->get();
    $mensal = Agendamento::where('id_barbeiro', $barbeiroId) 
    ->whereIn('status', ['concluido', 'confirmado'])
    ->select(
        DB::raw('YEAR(data) as ano'), 
        DB::raw('MONTH(data) as mes'),
        DB::raw('COUNT(id) as total')
    )
    ->groupBy('ano', 'mes')
    ->orderBy('ano', 'desc')
    ->orderBy('mes', 'desc')
    ->get();
    $pdf = Pdf::loadView('barbeiro.relatorios.relatorio', compact('agendamentos', 'servicos', 'lucro', 'mensal'));
    
    return $pdf->stream('relatorio_xurupis-' . date('d-m-Y H:i') . '.pdf');
}

}