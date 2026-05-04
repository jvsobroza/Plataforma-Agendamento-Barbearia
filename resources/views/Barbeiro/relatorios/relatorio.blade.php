<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        /* Configurações de Página */
        @page { margin: 100px 50px; }
        
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 11px; 
            color: #333; 
            line-height: 1.5;
        }

        /* Cabeçalho */
        .header { 
            position: fixed; 
            top: -70px; 
            left: 0; 
            right: 0; 
            text-align: center; 
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .header h2 { margin: 0; color: #2c3e50; text-transform: uppercase; letter-spacing: 1px; }
        .header p { margin: 5px 0 0; color: #7f8c8d; font-size: 10px; }

        /* Card de Destaque (Lucro) */
        .summary-box {
            background-color: #f8f9fa;
            border-left: 5px solid #27ae60;
            padding: 15px;
            margin-bottom: 25px;
            margin-top: 20px;
        }
        .summary-box h3 { margin: 0; color: #7f8c8d; font-size: 12px; text-transform: uppercase; }
        .summary-box .value { font-size: 20px; color: #27ae60; font-weight: bold; }

        /* Tabelas */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        
        th { 
            background-color: #2c3e50; 
            color: #ffffff; 
            padding: 10px 8px; 
            text-align: left; 
            text-transform: uppercase;
            font-size: 10px;
        }
        
        td { 
            padding: 8px; 
            border-bottom: 1px solid #ecf0f1; 
            vertical-align: middle; 
        }

        /* Títulos de Seção */
        .section-title { 
            font-size: 13px; 
            color: #2c3e50; 
            border-bottom: 2px solid #3498db; 
            padding-bottom: 3px; 
            margin-bottom: 15px;
            margin-top: 30px;
            text-transform: uppercase;
        }

        /* Colunas Lado a Lado */
        .table-ranking { width: 48%; float: left; }
        .table-mensal { width: 48%; float: right; }
        .clear { clear: both; }

        /* Estilos de Status */
        .status { 
            padding: 3px 8px; 
            border-radius: 10px; 
            font-size: 9px; 
            font-weight: bold; 
            text-transform: uppercase;
        }
        .status-concluido { background-color: #d4edda; color: #155724; }
        .status-confirmado { background-color: #d1ecf1; color: #0c5460; }
        .status-cancelado { background-color: #f8d7da; color: #721c24; }

        /* Rodapé */
        .footer { 
            position: fixed; 
            bottom: -60px; 
            left: 0; 
            right: 0; 
            text-align: center; 
            font-size: 9px; 
            color: #bdc3c7; 
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Relatório de Agendamentos</h2>
        <p>Gerado em: {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="summary-box">
        <h3>Faturamento Estimado</h3>
        <div class="value">R$ {{ number_format($lucro, 2, ',', '.') }}</div>
    </div>

    <div class="table-container">
        <!-- Serviços Mais Realizados -->
        <div class="table-ranking">
            <h3 class="section-title">Serviços Populares</h3>
            <table>
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
                        <td style="font-weight: bold;">{{ $s->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Agendamentos por Mês -->
        <div class="table-mensal">
            <h3 class="section-title">Evolução Mensal</h3>
            <table>
                <thead>
                    <tr>
                        <th>Mês/Ano</th>
                        <th>Qtd</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mensal as $m)
                    <tr>
                        <td>{{ str_pad($m->mes, 2, '0', STR_PAD_LEFT) }}/{{ $m->ano }}</td>
                        <td style="font-weight: bold;">{{ $m->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
    </div>

    <h3 class="section-title">Detalhamento de Agendamentos</h3>
    <table>
        <thead>
            <tr>
                <th width="20%">Data/Hora</th>
                <th width="25%">Cliente</th>
                <th width="25%">Serviço</th>
                <th width="15%">Valor</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendamentos as $agenda)
            <tr>
                <td>
                    {{ date('d/m/Y', strtotime($agenda->data)) }}<br>
                    <small style="color: #7f8c8d;">{{ $agenda->hora }}</small>
                </td>
                <td>{{ $agenda->cliente->usuario->nome }}</td>
                <td>{{ $agenda->servico->descricao }}</td>
                <td>R$ {{ number_format($agenda->servico->preco, 2, ',', '.') }}</td>
                <td>
                    <span class="status status-{{ strtolower($agenda->status) }}">
                        {{ $agenda->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Sistema de Gestão de Barbearia - Relatório Administrativo
    </div>

</body>
</html>