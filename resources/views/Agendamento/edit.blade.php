@extends('agendamento.layout')

@section('content')
<div class="page-content container-fluid py-4">

    <a href="{{ route('barbeiro.agendamento.show', $agendamento->id) }}"
        class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-1"></i> Voltar
    </a>

    <div class="mb-5">
        <p class="mb-1" style="font-size:11px; letter-spacing:3px; color:#c95c0a; text-transform:uppercase;">
            Agendamento
        </p>
        <h1><i class="fas fa-edit me-2" style="color:#c95c0a;"></i>Atualizar Status</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            @foreach($errors->all() as $error)
                <div><i class="fas fa-times-circle me-1"></i>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="max-width: 480px;">
        <div class="card-body p-4">

            {{-- Resumo do agendamento --}}
            <div class="mb-4 pb-4" style="border-bottom: 0.5px solid #222;">
                <p class="detail-label">Cliente</p>
                <p class="mb-3" style="color:#ccc;">{{ $agendamento->cliente->usuario->nome }}</p>
                <p class="detail-label">Serviço</p>
                <p class="mb-3" style="color:#ccc;">{{ $agendamento->servico->descricao }}</p>
                <p class="detail-label">Data / Hora</p>
                <p class="mb-0" style="color:#ccc;">
                    {{ date('d/m/Y', strtotime($agendamento->data)) }}
                    · {{ date('H:i', strtotime($agendamento->hora)) }}
                </p>
            </div>

            <form action="{{ route('barbeiro.agendamento.update', $agendamento->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="confirmado" {{ $agendamento->status == 'confirmado' ? 'selected' : '' }}>
                            Confirmado
                        </option>
                        <option value="concluido" {{ $agendamento->status == 'concluido' ? 'selected' : '' }}>
                            Concluído
                        </option>
                        <option value="cancelado" {{ $agendamento->status == 'cancelado' ? 'selected' : '' }}>
                            Cancelado
                        </option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Salvar Status
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection