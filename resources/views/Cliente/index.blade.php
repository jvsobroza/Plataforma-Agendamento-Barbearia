@extends('cliente.layout')

@section('content')
<div class="page-content container-fluid py-4">

    <div class="mb-5 d-flex justify-content-between align-items-end">
        <div>
            <p class="mb-1" style="font-size:11px; letter-spacing:3px; color:#c95c0a; text-transform:uppercase;">
                Painel
            </p>
            <h1><i class="fas fa-calendar-check me-2" style="color:#c95c0a;"></i>Meus Agendamentos</h1>
            <p class="lead">Acompanhe e gerencie seus agendamentos</p>
        </div>
        <a href="{{ route('cliente.agendamento.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Novo Agendamento
        </a>
    </div>

    @if(session('erro'))
        <div class="alert alert-danger mb-4">
            <i class="fas fa-times-circle me-2"></i>{{ session('erro') }}
        </div>
    @endif

    @session('success')
        <div class="alert alert-success mb-4">
            <i class="fas fa-check-circle me-2"></i>{{ $value }}
        </div>
    @endsession

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center px-4 py-3">
            <h5 class="mb-0"><i class="fas fa-list me-2" style="color:#c95c0a;"></i>Agendamentos</h5>
            <span class="badge badge-count">{{ count($agendamentos) }}</span>
        </div>

        <div class="card-body p-0">
            @if($agendamentos->isNotEmpty())
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Barbeiro</th>
                                <th>Serviço</th>
                                <th>Data / Hora</th>
                                <th>Preço</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agendamentos as $agenda)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fas fa-user-circle" style="color:#444;"></i>
                                            {{ $agenda->barbeiro->usuario->nome }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-servico">{{ $agenda->servico->descricao ?? 'Serviço' }}</span>
                                    </td>
                                    <td>
                                        <i class="far fa-calendar-alt me-1" style="color:#555;"></i>
                                        {{ date('d/m/Y', strtotime($agenda->data)) }}
                                        <span style="color:#555; margin: 0 4px;">·</span>
                                        {{ date('H:i', strtotime($agenda->hora)) }}
                                    </td>
                                    <td style="color:#c95c0a; font-weight:600;">
                                        R$ {{ number_format($agenda->servico->preco ?? 0, 2, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-status-{{ $agenda->status }}">
                                            {{ $agenda->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('cliente.agendamento.show', $agenda->id) }}"
                                                class="btn btn-outline-info btn-sm" title="Detalhes">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="far fa-calendar-times"></i>
                    <p>Nenhum agendamento encontrado</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection