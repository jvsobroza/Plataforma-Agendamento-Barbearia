@extends('barbeiro.layout')

@section('content')
<div class="page-content container-fluid py-4">

    <div class="mb-5 d-flex justify-content-between align-items-end">
        <div>
            <p class="mb-1" style="font-size:11px; letter-spacing:3px; color:#c95c0a; text-transform:uppercase;">
                Painel
            </p>
            <h1><i class="fas fa-cut me-2" style="color:#c95c0a;"></i>Barbeiro</h1>
            <p class="lead">Gerencie seus serviços e agendamentos</p>
        </div>
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
<a href="{{ route('barbeiro.relatorio') }}" class="btn btn-outline-secondary mb-4">
    <i class="fas fa-file-pdf me-1"></i> Gerar Relatório PDF
</a>
    {{-- SERVIÇOS --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center px-4 py-3">
            <div class="d-flex align-items-center gap-3">
                <h5 class="mb-0"><i class="fas fa-list me-2" style="color:#c95c0a;"></i>Serviços</h5>
                <span class="badge badge-count">{{ count($servicos) }}</span>
            </div>
            <a href="{{ route('barbeiro.servico.create') }}"
                class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i> Novo Serviço
            </a>
        </div>

        <div class="card-body p-0">
            @forelse($servicos as $servico)
                @if($loop->first)
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">#</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                    <th class="text-center">Duração</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                @endif
                            <tr>
                                <td class="ps-4" style="color:#c95c0a; font-weight:600;">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="service-avatar">
                                            <i class="fas fa-cut"></i>
                                        </div>
                                        {{ $servico->descricao }}
                                    </div>
                                </td>
                                <td style="color:#c95c0a; font-weight:600;">
                                    R$ {{ number_format($servico->preco, 2, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-servico">
                                        {{ explode(':', $servico->duracao)[1] }} min
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('barbeiro.servico.destroy', $servico->id) }}"
                                        method="POST" class="d-inline">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('barbeiro.servico.show', $servico->id) }}"
                                                class="btn btn-outline-info btn-sm" title="Visualizar">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('barbeiro.servico.edit', $servico->id) }}"
                                                class="btn btn-outline-primary btn-sm" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Excluir este serviço?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                @if($loop->last)
                            </tbody>
                        </table>
                    </div>
                @endif
            @empty
                <div class="empty-state">
                    <i class="fas fa-cut"></i>
                    <p>Nenhum serviço registrado</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- AGENDAMENTOS --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center px-4 py-3">
            <div class="d-flex align-items-center gap-3">
                <h5 class="mb-0"><i class="fas fa-calendar-check me-2" style="color:#c95c0a;"></i>Agendamentos</h5>
                <span class="badge badge-count">{{ count($agendamentos) }}</span>
            </div>
        </div>

        <div class="card-body p-0">
            @forelse($agendamentos as $agenda)
                @if($loop->first)
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Cliente</th>
                                    <th>Serviço</th>
                                    <th>Data / Hora</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                @endif
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fas fa-user-circle" style="color:#444;"></i>
                                        {{ $agenda->cliente->usuario->nome }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-servico">{{ $agenda->servico->descricao }}</span>
                                </td>
                                <td>
                                    <i class="far fa-calendar-alt me-1" style="color:#555;"></i>
                                    {{ date('d/m/Y', strtotime($agenda->data)) }}
                                    <span style="color:#555; margin: 0 4px;">·</span>
                                    {{ date('H:i', strtotime($agenda->hora)) }}
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-status-{{ $agenda->status }}">
                                        {{ $agenda->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('barbeiro.agendamento.destroy', $agenda->id) }}"
                                        method="POST" class="d-inline">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('barbeiro.agendamento.show', $agenda->id) }}"
                                                class="btn btn-outline-info btn-sm" title="Visualizar">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('barbeiro.agendamento.edit', $agenda->id) }}"
                                                class="btn btn-outline-primary btn-sm" title="Editar Status">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Cancelar este agendamento?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                @if($loop->last)
                            </tbody>
                        </table>
                    </div>
                @endif
            @empty
                <div class="empty-state">
                    <i class="far fa-calendar-times"></i>
                    <p>Nenhum agendamento para mostrar</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection