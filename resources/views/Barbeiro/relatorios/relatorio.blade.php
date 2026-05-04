<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f2f2f2; padding: 10px; border: 1px solid #ddd; text-align: left; }
        td { padding: 8px; border: 1px solid #ddd; vertical-align: middle; }
        .ranking-title { margin-top: 30px; color: #444; border-bottom: 2px solid #444; display: inline-block; }
        .table-ranking { width: 50%; margin-bottom: 30px; }
        .table-ranking th { background-color: #444; color: white; }

        .status-concluido { color: green; font-weight: bold; }
        .status-cancelado { color: red; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Relatório de Agendamentos</h2>
        <p>Gerado em: {{ date('d/m/Y H:i') }}</p>
    </div>

    <h3 class="ranking-title">Serviços Mais Realizados</h3>
    <table class="table-ranking">
        <thead>
            <tr>
                <th>Serviço</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servicos as $s)
            <tr>
                <td>{{ $s->servico->descricao ?? 'N/A' }}</td>
                <td>{{ $s->total }} atendimentos</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <h3>Detalhamento de Agendamentos</h3>
    <table>
        <thead>
            <tr>
                <th>Data/Hora</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Valor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendamentos as $agenda)
            <tr>
                <td>{{ $agenda->data }} - {{ $agenda->hora }}</td>
                <td>{{ $agenda->cliente->usuario->nome }}</td>
                <td>{{ $agenda->servico->descricao }}</td>
                <td>R$ {{ $agenda->servico->preco }}</td>
                <td class="status-{{ strtolower($agenda->status) }}">
                    {{ $agenda->status }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Lucro total: R$ {{ $lucro }}</h3>
    <h3>Agendamentos por Mês</h3>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mensal as $m)
            <tr>
                <td>{{ $m->ano }}/{{ $m->mes }}</td>
                <td>{{ $m->total }} agendamentos</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>