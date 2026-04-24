@extends('Servico.layout')

@section('content')
<div class="page-content container-fluid py-3">
    
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="display-5 fw-bold text-dark">
                <i class="fas fa-plus-circle text-primary me-3"></i>Novo Serviço
            </h1>
            <p class="text-secondary lead">Cadastre um novo serviço para seus clientes</p>
        </div>
        <a href="{{ route('barbeiro.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar ao Painel
        </a>
    </div>

    <div class="card shadow-sm border-0" style="max-width: 600px;">
        <div class="card-body p-4">
            
            <form action="{{ route('servico.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome do Serviço</label>
                    <input type="text" class="form-control form-control-lg @error('nome') is-invalid @enderror" 
                           id="nome" name="nome" value="{{ old('nome') }}" placeholder="Ex: Corte Degrade" required>
                    
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="preco" class="form-label fw-bold">Preço (R$)</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">R$</span>
                        <input type="number" step="0.01" class="form-control @error('preco') is-invalid @enderror" 
                               id="preco" name="preco" value="{{ old('preco') }}" placeholder="35.00" required>
                        
                        @error('preco')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg fw-bold">
                        <i class="fas fa-save me-2"></i> Salvar Serviço
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection