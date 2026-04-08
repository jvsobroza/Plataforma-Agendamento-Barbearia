@extends('tcc.layout')

@section('content')
    <div class="page-content">
        <!-- Header -->
        <div class="mb-4">
            <h1 class="display-5 fw-bold text-dark">
                <i class="fas fa-file-alt text-primary me-3"></i>{{ $tcc->titulo }}
            </h1>
            <p class="text-secondary lead">Trabalho de Conclusão de Curso</p>
        </div>

        <!-- Back Button -->
        <div class="mb-3">
            <a class="btn btn-outline-primary" href="{{ route('tcc.index') }}">
                <i class="fas fa-arrow-left me-2"></i>Voltar à Lista
            </a>
        </div>

        <!-- Main Card -->
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-address-card me-2"></i>Informações Completas</span>
                <div>
                    <a class="btn btn-sm btn-outline-primary me-2" href="{{ route('tcc.edit', $tcc->id) }}">
                        <i class="fas fa-edit me-1"></i>Editar
                    </a>
                    <form action="{{ route('tcc.destroy', $tcc->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir este TCC?')">
                            <i class="fas fa-trash me-1"></i>Excluir
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <!-- Aluno e Autor -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="info-box bg-light p-4 rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-user-graduate fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Aluno</small>
                                    <strong class="fs-6">{{ $tcc->aluno }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-light p-4 rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-circle bg-warning text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-file-lines fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Páginas</small>
                                    <strong class="fs-6">{{ $tcc->paginas }} páginas</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data e Hora --><div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="info-box bg-light p-4 rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-calendar fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Data da Defesa</small>
                                    <strong class="fs-6">{{ date('d/m/Y', strtotime($tcc->data)) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-light p-4 rounded">
                            <div class="d-flex align-items-center">
                                <div class="avatar rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fas fa-clock fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Horário da Defesa</small>
                                    <strong class="fs-6">{{ $tcc->hora }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Resumo -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted fw-bold mb-2"><i class="fas fa-align-left me-2"></i>Resumo</h6>
                    <p class="text-muted">{{ $tcc->resumo }}</p>
                </div>

                <!-- Palavras-chave -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted fw-bold mb-2"><i class="fas fa-tags me-2"></i>Palavras-Chave</h6>
                    <div>
                        @foreach(explode(',', $tcc->palavras_chave) as $palavra)
                            <span class="badge bg-primary me-2 mb-2">{{ trim($palavra) }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- PDF -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted fw-bold mb-2"><i class="fas fa-file-pdf me-2 text-danger"></i>Documento</h6>
                    <a class="btn btn-danger btn-lg" href="{{ asset('pdfs/' . $tcc->pdf) }}" target="_blank">
                        <i class="fas fa-download me-2"></i>Baixar PDF
                    </a>
                </div>

                <hr class="my-4">

                <!-- Banca Examinadora -->
                <div class="mb-2">
                    <h6 class="text-uppercase text-muted fw-bold mb-3"><i class="fas fa-users me-2 text-primary"></i>Banca Examinadora</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-4 border rounded text-center h-100">
                                <div class="avatar rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-chalkboard-teacher fa-lg"></i>
                                </div>
                                <small class="text-muted d-block">Orientador(a)</small>
                                <strong class="fs-6">{{ $tcc->getOrientador->nome }}</strong>
                                <p class="small text-muted mt-1">{{ $tcc->getOrientador->titulacao }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 border rounded text-center h-100">
                                <div class="avatar rounded-circle bg-info text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-user-tie fa-lg"></i>
                                </div>
                                <small class="text-muted d-block">Membro 1</small>
                                <strong class="fs-6">{{ $tcc->banca1->nome ?? 'N/A' }}</strong>
                                <p class="small text-muted mt-1">{{ $tcc->banca1->titulacao ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 border rounded text-center h-100">
                                <div class="avatar rounded-circle bg-info text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-user-tie fa-lg"></i>
                                </div>
                                <small class="text-muted d-block">Membro 2</small>
                                <strong class="fs-6">{{ $tcc->banca2->nome ?? 'N/A' }}</strong>
                                <p class="small text-muted mt-1">{{ $tcc->banca2->titulacao ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Informações de Registro -->
                <div class="row text-muted small">
                    <div class="col-md-6">
                        <i class="fas fa-clock me-1"></i>
                        Registrado em: {{ $tcc->created_at->format('d/m/Y H:i') }}
                    </div>
                    @if($tcc->updated_at != $tcc->created_at)
                        <div class="col-md-6">
                            <i class="fas fa-sync me-1"></i>
                            Última atualização: {{ $tcc->updated_at->format('d/m/Y H:i') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection