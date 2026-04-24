@extends('Barbeiro.layout')

@section('content')
    <div class="page-content container-fluid py-3">

        <div class="mb-4">
            <h1 class="display-5 fw-bold text-dark">
                <i class="fas fa-cut text-primary me-3"></i>Painel do Barbeiro
            </h1>
            <p class="text-secondary lead">Gerencie todos os serviços e agendamentos</p>
        </div>

        @session('success')
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Sucesso!</strong> {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        <div class="card shadow-lg mb-5">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-list text-primary me-2"></i>Lista de Serviços
                </h5>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-primary rounded-pill">{{ count($servicos) }} serviços</span>
                    <a href="{{ route('servico.create') }}" class="btn btn-success btn-sm fw-bold shadow-sm">
                        <i class="fas fa-plus me-1"></i> Adicionar Novo Serviço
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                @forelse($servicos as $servico)
                    @if ($loop->first)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="60px">#</th>
                                        <th style="min-width: 200px;"><i class="fas fa-tag me-2"></i>Descrição do Serviço</th>
                                        <th style="min-width: 120px;"><i class="fas fa-dollar-sign me-2"></i>Preço</th>
                                        <th class="text-center" width="150px"><i class="fas fa-clock me-2"></i>Duração</th>
                                        <th class="text-center" width="200px"><i class="fas fa-cog me-2"></i>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                    @endif
                                    <tr class="align-middle">
                                        <td class="text-center fw-bold text-primary">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; flex-shrink: 0;">
                                                    <i class="fas fa-cut small"></i>
                                                </div>
                                                <span class="fw-500">{{ $servico->descricao }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                R$ {{ number_format($servico->preco, 2, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-primary">
                                                {{ explode(':', $servico->duracao)[1] }} min
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('servico.destroy', $servico->id) }}" method="POST" class="d-inline">
                                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                                    <a class="btn btn-sm btn-outline-info" href="{{ route('servico.show', $servico->id) }}" title="Visualizar">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('servico.edit', $servico->id) }}" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este serviço?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                    @if ($loop->last)
                                </tbody>
                            </table>
                        </div>
                    @endif
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-cut text-secondary" style="font-size: 3rem;"></i>
                        <p class="text-secondary mt-3">
                            <strong>Nenhum serviço registrado</strong><br>
                            <small>Comece adicionando um novo serviço de barbearia</small>
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="card shadow-lg mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-calendar-check text-primary me-2"></i>Próximos Agendamentos
                </h5>
                <span class="badge bg-info text-dark rounded-pill">{{ count($agendamentos) }} marcados</span>
            </div>

            <div class="card-body p-0">
                @forelse($agendamentos as $agenda)
                    @if ($loop->first)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4"><i class="fas fa-user me-2"></i>Cliente</th>
                                        <th><i class="fas fa-concierge-bell me-2"></i>Serviço</th>
                                        <th><i class="fas fa-clock me-2"></i>Data / Hora</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-end pe-4"><i class="fas fa-cog me-2"></i>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                    @endif
                                    <tr>
                                        <td class="ps-4 fw-medium">
                                            <i class="fas fa-user-circle text-muted me-2"></i>{{ $agenda->cliente->user->nome ?? 'Cliente' }}
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $agenda->servico->descricao ?? 'Serviço' }}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark">
                                                <i class="far fa-calendar-alt text-muted me-1"></i>
                                                {{ $agenda->data_hora }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge rounded-pill bg-info text-dark">{{ $agenda->status }}</span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('agendamento.show', $agenda->id) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye me-1"></i> Detalhes
                                            </a>
                                        </td>
                                    </tr>
                    @if ($loop->last)
                                </tbody>
                            </table>
                        </div>
                    @endif
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="far fa-calendar-times fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0"><strong>Nenhum agendamento para mostrar.</strong></p>
                        <small>Aguarde novos clientes agendarem serviços.</small>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection