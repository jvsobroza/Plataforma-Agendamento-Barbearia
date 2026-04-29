@extends('agendamento.layout')

@section('content')
<div class="page-content container-fluid py-4">

    <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-1"></i> Voltar
    </a>

    <div class="mb-5">
        <p class="mb-1" style="font-size:11px; letter-spacing:3px; color:#c95c0a; text-transform:uppercase;">
            Novo
        </p>
        <h1><i class="fas fa-plus-circle me-2" style="color:#c95c0a;"></i>Novo Agendamento</h1>
        <p class="lead">Escolha o barbeiro, serviço, data e hora</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            @foreach($errors->all() as $error)
                <div><i class="fas fa-times-circle me-1"></i>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="max-width: 560px;">
        <div class="card-body p-4">
            <form action="{{ route('cliente.agendamento.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="id_barbeiro" class="form-label">Barbeiro</label>
                    <select name="id_barbeiro" id="id_barbeiro" class="form-select" required>
                        <option value="">Selecione um barbeiro...</option>
                        @foreach($barbeiro as $b)
                            <option value="{{ $b->id }}">{{ $b->usuario->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="id_servico" class="form-label">Serviço</label>
                    <select name="id_servico" id="id_servico" class="form-select" required>
                        <option value="">Selecione primeiro o barbeiro...</option>
                    </select>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="data" class="form-label">Data</label>
                        <input type="date" class="form-control" id="data" name="data"
                            min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="hora" name="hora" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-calendar-check me-1"></i> Confirmar Agendamento
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
        servicoSelect.innerHTML = '<option value="">Selecione um serviço...</option>';
        const filtrados = todosServicos.filter(s => s.id_barbeiro == barbeiroId);
        if (filtrados.length > 0) {
            filtrados.forEach(s => {
                const option = document.createElement('option');
                option.value = s.id;
                option.textContent = `${s.descricao} — R$ ${parseFloat(s.preco).toFixed(2).replace('.', ',')}`;
                servicoSelect.appendChild(option);
            });
        } else if (barbeiroId !== "") {
            servicoSelect.innerHTML = '<option value="">Este barbeiro não possui serviços</option>';
        }
    });
    document.getElementById('data').addEventListener('change', function () {
        const horaInput = document.getElementById('hora');
        const dataVal   = this.value;

        if (!dataVal) return;

        const data = new Date(dataVal + 'T00:00:00');
        const dia  = data.getDay(); 
        if (dia === 0) {
            alert('Não atendemos aos domingos. Por favor escolha outra data.');
            this.value    = '';
            horaInput.min = '';
            horaInput.max = '';
            horaInput.value = '';
            return;
        }
        if (dia === 6) {
            horaInput.min = '09:00';
            horaInput.max = '18:00';

            if (horaInput.value && (horaInput.value < '09:00' || horaInput.value > '18:00')) {
                horaInput.value = '';
            }
            return;
        }
        horaInput.min = '09:00';
        horaInput.max = '20:00';

        if (horaInput.value && (horaInput.value < '09:00' || horaInput.value > '20:00')) {
            horaInput.value = '';
        }
    });
    document.querySelector('form').addEventListener('submit', function (e) {
        const dataVal  = document.getElementById('data').value;
        const horaVal  = document.getElementById('hora').value;
        if (!dataVal || !horaVal) return;
        const dia  = new Date(dataVal + 'T00:00:00').getDay();
        const hora = horaVal;
        if (dia === 0) {
            e.preventDefault();
            alert('Não atendemos aos domingos.');
            return;
        }
        if (dia === 6 && (hora < '09:00' || hora > '18:00')) {
            e.preventDefault();
            alert('Aos sábados atendemos das 09h às 18h.');
            return;
        }
        if (dia !== 6 && (hora < '09:00' || hora > '20:00')) {
            e.preventDefault();
            alert('De segunda a sexta atendemos das 09h às 20h.');
        }
    });
</script>
@endsection