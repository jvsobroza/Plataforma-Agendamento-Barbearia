{{-- show.blade.php --}}
@extends('servico.layout')

@section('content')
<div class="page-content container-fluid py-4">

    <a href="{{ route('barbeiro.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-1"></i> Voltar
    </a>

    <div class="mb-5">
        <p class="mb-1" style="font-size:11px; letter-spacing:3px; color:#c95c0a; text-transform:uppercase;">Serviço</p>
        <h1><i class="fas fa-concierge-bell me-2" style="color:#c95c0a;"></i>{{ $servico->descricao }}</h1>
    </div>

    <div class="card" style="max-width: 480px;">
        <div class="card-body p-4">

            <p class="detail-label">Descrição</p>
            <p class="detail-value">{{ $servico->descricao }}</p>

            <p class="detail-label">Preço</p>
            <p class="detail-value" style="color:#c95c0a; font-weight:600;">
                R$ {{ number_format($servico->preco, 2, ',', '.') }}
            </p>

            <p class="detail-label">Duração</p>
            <p class="detail-value">{{ explode(':', $servico->duracao)[1] }} minutos</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('barbeiro.servico.edit', $servico->id) }}"
                    class="btn btn-primary flex-fill">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
                <form action="{{ route('barbeiro.servico.destroy', $servico->id) }}"
                    method="POST" class="flex-fill">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100"
                        onclick="return confirm('Excluir este serviço?')">
                        <i class="fas fa-trash me-1"></i> Excluir
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection