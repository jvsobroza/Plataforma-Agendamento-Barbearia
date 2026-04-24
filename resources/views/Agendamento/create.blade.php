@extends('agendamento.layout')
@section('content')
    <div class="page-content container-fluid py-3">
        <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary mb-4">
            <i class="fas fa-arrow-left me-1"></i> Voltar ao Painel Principal
        </a>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="display-5 fw-bold text-dark">
                    <i class="fas fa-plus-circle text-primary me-3"></i>Novo Agendamento
                </h1>
                <p class="text-secondary lead">Crie um novo agendamento para seu corte</p>
            </div>
            </a>
        </div>

        <div class="card shadow-sm border-0" style="max-width: 600px;">
            <div class="card-body p-4">
                <form action="{{ route('cliente.agendamento.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="id_barbeiro" class="form-label fw-bold">Escolha o Barbeiro</label>
                        <select name="id_barbeiro" id="id_barbeiro" class="form-select" required>
                            <option value="">Selecione um barbeiro...</option>
                            @foreach($barbeiro as $b)
                                <option value="{{ $b->id }}">{{ $b->usuario->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_servico" class="form-label fw-bold">Escolha o Serviço</label>
                        <select name="id_servico" id="id_servico" class="form-select" required>
                            <option value="">Selecione primeiro o barbeiro...</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="data" class="form-label fw-bold">Data</label>
                            <input type="date" class="form-control" id="data" name="data" min="{{ date('Y-m-d') }}"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hora" class="form-label fw-bold">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" required>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">
                            <i class="fas fa-calendar-check me-2"></i> Confirmar Agendamento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const todosServicos = @json($servico);
        document.getElementById('id_barbeiro').addEventListener('change', function () {
            const barbeiroId = this.value;
            const servicoSelect = document.getElementById('id_servico');
            servicoSelect.innerHTML = '<option value="">Selecione um serviço</option>';
            const filtrados = todosServicos.filter(s => s.id_barbeiro == barbeiroId);
            if (filtrados.length > 0) {
                filtrados.forEach(s => {
                    const option = document.createElement('option');
                    option.value = s.id;
                    option.textContent = `${s.descricao} - R$ ${parseFloat(s.preco).toFixed(2).replace('.', ',')}`;
                    servicoSelect.appendChild(option);
                });
            } else if (barbeiroId !== "") {
                servicoSelect.innerHTML = '<option value="">Este barbeiro não possui serviços</option>';
            }
        });
    </script>
@endsection