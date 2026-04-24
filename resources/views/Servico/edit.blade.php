@extends('Servico.layout')

@section('content')
    <div class="page-content container-fluid py-3">
        <a href="{{ route('barbeiro.index') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left me-1"></i> Voltar ao Painel principal
        </a>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="display-5 fw-bold text-dark">
                    <i class="fas fa-plus-circle text-primary me-3"></i>Editar Serviço: {{ $servico->descricao }}
                </h1>
                <p class="text-secondary lead">Atualize as informações do serviço</p>
            </div>
            </a>
        </div>

        <div class="card shadow-sm border-0" style="max-width: 600px;">
            <div class="card-body p-4">

                <form action="{{ route('barbeiro.servico.update', $servico->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-bold">Descrição do Serviço</label>
                        <input type="text" class="form-control form-control-lg @error('descricao') is-invalid @enderror"
                            id="descricao" name="descricao" value="{{ old('descricao', $servico->descricao) }}" placeholder="Ex: Corte Degrade"
                            required>

                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="preco" class="form-label fw-bold">Preço (R$)</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">R$</span>
                            <input type="number" step="0.01" class="form-control @error('preco') is-invalid @enderror"
                                id="preco" name="preco" value="{{ old('preco', $servico->preco) }}" placeholder="35.00" required>

                            @error('preco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="duracao" class="form-label fw-bold">Duração (em minutos)</label>
                        <div class="input-group">
                            <input type="number" class="form-control form-control-lg @error('duracao') is-invalid @enderror"
                                id="duracao" name="duracao" value="{{ explode(':', $servico->duracao)[1] }}" placeholder="Ex: 30" min="1"
                                required>
                            <span class="input-group-text text-white"
                                style="background-color: #c95c0a; border: none;">minutos</span>

                            @error('duracao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted text-white-50">Apenas números. Ex: 45 para 45 minutos.</small>
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