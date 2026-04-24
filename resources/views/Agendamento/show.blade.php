@extends('agendamento.layout')

@section('content')
<div class="page-content container-fluid py-4">

    @if(Auth::user()->tipo == 1)
        <a href="{{ route('barbeiro.index') }}" class="btn btn-outline-secondary mb-4">
    @else
        <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary mb-4">
    @endif
        <i class="fas fa-arrow-left me-1"></i> Voltar
    </a>

    <div class="mb-5">
        <p class="mb-1" style="font-size:11px; letter-spacing:3px; color:#c95c0a; text-transform:uppercase;">
            Agendamento
        </p>
        <h1><i class="fas fa-calendar-check me-2" style="color:#c95c0a;"></i>Detalhes</h1>
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

    <div class="card" style="max-width: 560px;">
        <div class="card-body p-4">

            <p class="detail-label">Cliente</p>
            <p class="detail-value">{{ $agendamento->cliente->usuario->nome }}</p>

            <p class="detail-label">Barbeiro</p>
            <p class="detail-value">{{ $agendamento->barbeiro->usuario->nome }}</p>

            <p class="detail-label">Serviço</p>
            <p class="detail-value">{{ $agendamento->servico->descricao }}</p>

            <p class="detail-label">Preço</p>
            <p class="detail-value" style="color:#c95c0a; font-weight:600;">
                R$ {{ number_format($agendamento->servico->preco, 2, ',', '.') }}
            </p>

            <p class="detail-label">Data</p>
            <p class="detail-value">{{ date('d/m/Y', strtotime($agendamento->data)) }}</p>

            <p class="detail-label">Hora</p>
            <p class="detail-value">{{ date('H:i', strtotime($agendamento->hora)) }}</p>

            <p class="detail-label">Status</p>
            <p class="detail-value">
                <span class="badge badge-status-{{ $agendamento->status }}">
                    {{ $agendamento->status }}
                </span>
            </p>

            @if(Auth::user()->tipo == 1)
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('barbeiro.agendamento.edit', $agendamento->id) }}"
                        class="btn btn-primary flex-fill">
                        <i class="fas fa-edit me-1"></i> Editar Status
                    </a>
                    <form action="{{ route('barbeiro.agendamento.destroy', $agendamento->id) }}"
                        method="POST" class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100"
                            onclick="return confirm('Cancelar este agendamento?')">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection