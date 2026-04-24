@extends('Servico.layout')

@section('content')
    <div class="page-content container-fluid py-3">
        <a href="{{ route('servico.index') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left me-1"></i> Voltar ao Painel principal
        </a>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="display-5 fw-bold text-dark">
                    <i class="fas fa-plus-circle text-primary me-3"></i>Serviço: {{ $servico->descricao }}
                </h1>
                <p class="text-secondary lead">Detalhes do serviço</p>
            </div>
            </a>
        </div>

        <div class="card shadow-sm border-0" style="max-width: 600px;">
            <div class="card-body p-4">
                <h5 class="card-title fw-bold">Descrição:</h5>
                <p class="card-text mb-4">{{ $servico->descricao }}</p>

                <h5 class="card-title fw-bold">Preço:</h5>
                <p class="card-text mb-4">R$ {{ number_format($servico->preco, 2, ',', '.') }}</p>

                <h5 class="card-title fw-bold">Duração:</h5>
                <p class="card-text mb-4">{{ explode(':', $servico->duracao)[1] }} minutos</p>

                <div class="d-grid">
                    <a href="{{ route('servico.edit', $servico->id) }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-edit me-2"></i> Editar Serviço
                    </a>
                </div>
                <div class="d-grid mt-3">
                    <a href="{{ route('servico.destroy', $servico->id) }}" class="btn btn-danger btn-lg" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja apagar este serviço?')) { document.getElementById('delete-form').submit(); }">
                        <i class="fas fa-trash-alt me-2"></i> Apagar Serviço
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection