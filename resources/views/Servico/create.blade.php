@extends('servico.layout')

@section('content')
<div class="page-content container-fluid py-4">

    <a href="{{ route('barbeiro.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-1"></i> Voltar
    </a>

    <div class="mb-5">
        <p class="mb-1" style="font-size:11px; letter-spacing:3px; color:#c95c0a; text-transform:uppercase;">Novo</p>
        <h1><i class="fas fa-plus-circle me-2" style="color:#c95c0a;"></i>Novo Serviço</h1>
    </div>

    <div class="card" style="max-width: 480px;">
        <div class="card-body p-4">
            <form action="{{ route('barbeiro.servico.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                        id="descricao" name="descricao" value="{{ old('descricao') }}"
                        placeholder="Ex: Corte Degradê" required>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="preco" class="form-label">Preço (R$)</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" step="0.01" class="form-control @error('preco') is-invalid @enderror"
                            id="preco" name="preco" value="{{ old('preco') }}"
                            placeholder="35.00" required>
                        @error('preco')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="duracao" class="form-label">Duração (minutos)</label>
                    <div class="input-group">
                        <input type="number" class="form-control @error('duracao') is-invalid @enderror"
                            id="duracao" name="duracao" value="{{ old('duracao') }}"
                            placeholder="Ex: 30" min="1" required>
                        <span class="input-group-text">min</span>
                        @error('duracao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Salvar Serviço
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection