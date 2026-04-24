@extends('cliente.layout')

@section('content')
    <div class="page-content container-fluid py-3">

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="display-5 fw-bold text-dark">
                    <i class="fas fa-cut text-primary me-3"></i>Painel do Cliente
                </h1>
                <p class="text-secondary lead">Gerencie seus agendamentos</p>
            </div>
            <a href="{{ route('cliente.agendamento.create') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="fas fa-plus-circle me-2"></i>Novo Agendamento
            </a>
        </div>

        @session('success')
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Sucesso!</strong> {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        <div class="card shadow-lg mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-calendar-check text-primary me-2"></i>Próximos Agendamentos
                </h5>
                <span class="badge bg-info text-dark rounded-pill">{{ count($agendamentos) }} agendamentos</span>
            </div>

            <div class="card-body p-0">
                @if($agendamentos->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Barbeiro</th>
                                    <th>Serviço</th>
                                    <th>Data / Hora</th>
                                    <th>Preço</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agendamentos as $agenda)
                                    <tr>
                                        <td class="ps-4 fw-medium">
                                            <i class="fas fa-user-circle text-muted me-2"></i>{{ $agenda->barbeiro->usuario->nome}}
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $agenda->servico->descricao ?? 'Serviço' }}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark">
                                                <i class="far fa-calendar-alt text-muted me-1"></i>
                                                {{ date('d/m/Y', strtotime($agenda->data)) }}
                                                {{ date('H:i', strtotime($agenda->hora)) }} </span>
                                        </td>
                                        <td>
                                            <span class="text-success fw-bold">
                                                R$ {{ number_format($agenda->servico->preco ?? 0, 2, ',', '.') }}
                                            </span>
                                        <td class="text-center">
                                            <span class="badge rounded-pill bg-info text-dark">{{ $agenda->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="far fa-calendar-times fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0"><strong>Nenhum agendamento encontrado.</strong></p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection