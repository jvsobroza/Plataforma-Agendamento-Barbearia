@extends('tcc.layout')
@section('content')

    <div class="page-content">
        <!-- Header -->
        <div class="mb-4">
            <h1 class="display-5 fw-bold text-dark">
                <i class="fas fa-book text-primary me-3"></i>Repositório de TCCs
            </h1>
            <p class="text-secondary lead">Gerencie todos os trabalhos de conclusão de curso</p>
        </div>

        <!-- Alert Success -->
        @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Sucesso!</strong> {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        <!-- Action Buttons -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <a class="btn btn-outline-primary" href="{{ route('banca.index') }}">
                <i class="fas fa-arrow-left me-2"></i>Voltar para Banca
            </a>
            <a class="btn btn-success btn-lg" href="{{ route('tcc.create') }}">
                <i class="fas fa-plus me-2"></i>Adicionar Novo TCC
            </a>
        </div>

        <!-- Table Card -->
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list me-2"></i>Lista de TCCs</span>
                <span class="badge bg-primary rounded-pill">{{ count($tcc) }} registros</span>
            </div>
            <div class="card-body p-0">
                @forelse ($tcc as $t)
                    @if ($loop->first)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="60px">#</th>
                                        <th style="min-width: 200px;"><i class="fas fa-file me-2"></i>Título</th>
                                        <th style="min-width: 120px;"><i class="fas fa-book-open me-2"></i>Aluno</th>
                                        <th class="text-center" width="70px"><i class="fas fa-calendar me-2"></i>Data</th>
                                        <th class="text-center" width="70px"><i class="fas fa-clock me-2"></i>Hora</th>
                                        <th class="text-center" width="70px"><i class="fas fa-file-pdf me-2"></i>PDF</th>
                                        <th class="text-center" width="280px"><i class="fas fa-cog me-2"></i>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                    @endif

                    <tr class="align-middle">
                        <td class="text-center fw-bold text-primary">{{ ++$i }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; flex-shrink: 0;">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div style="overflow: hidden;">
                                    <p class="mb-0 fw-500 text-truncate">{{ $t->titulo }}</p>
                                    <small class="text-muted">{{ Str::limit($t->resumo, 50, '...') }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <i class="fas fa-user-graduate me-2 text-success"></i>{{ $t->aluno }}
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark">
                                {{ date('d/m/Y', strtotime($t->data)) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark">{{ $t->hora }}</span>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-outline-danger" href="{{ asset('pdfs/' . $t->pdf) }}" target="_blank" title="Visualizar PDF">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('tcc.destroy', $t->id) }}" method="POST" class="d-inline">
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    <a class="btn btn-sm btn-outline-info" href="{{ route('tcc.show', $t->id) }}" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('tcc.edit', $t->id) }}" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este TCC?')">
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
                        <i class="fas fa-inbox text-secondary" style="font-size: 3rem;"></i>
                        <p class="text-secondary mt-3">
                            <strong>Nenhum TCC registrado</strong><br>
                            <small>Comece adicionando um novo trabalho de conclusão</small>
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($tcc->hasPages())
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-center">
                        {{ $tcc->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection