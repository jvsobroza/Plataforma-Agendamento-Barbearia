@extends('tcc.layout')
 
@section('content')
<div class="page-content">
    <!-- Header -->
    <div class="mb-4">
        <h1 class="display-5 fw-bold text-dark">
            <i class="fas fa-plus-circle text-primary me-3"></i>Adicionar Novo TCC
        </h1>
        <p class="text-secondary lead">Registre um novo trabalho de conclusão de curso</p>
    </div>

    <!-- Back Button -->
    <div class="mb-3">
        <a class="btn btn-outline-primary" href="{{ route('tcc.index') }}">
            <i class="fas fa-arrow-left me-2"></i>Voltar à Lista
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow-lg">
        <div class="card-header">
            <i class="fas fa-form me-2"></i>Dados do TCC
        </div>
        <div class="card-body">
    <form action="{{ route('tcc.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
        @csrf
        
        <!-- Dados Básicos -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="inputTitulo" class="form-label">
                        <strong><i class="fas fa-file me-2 text-primary"></i>Título</strong>
                    </label>
                    <input
                        type="text"
                        maxlength="100"
                        minlength="10"
                        name="titulo"
                        class="form-control form-control-lg @error('titulo') is-invalid @enderror"
                        id="inputTitulo"
                        required
                        placeholder="Ex: Sistema de Gerenciamento de TCCs"
                        oninput="tamanhoMax(this); verificarMin(this)">
                    <small class="form-text text-muted">Mínimo de 10 caracteres</small>
                    @error('titulo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="inputPaginas" class="form-label">
                        <strong><i class="fas fa-file-lines me-2 text-primary"></i>Páginas</strong>
                    </label>
                    <input
                        type="number"
                        name="paginas"
                        class="form-control form-control-lg @error('paginas') is-invalid @enderror"
                        id="inputPaginas"
                        required
                        placeholder="Ex: 50">
                    @error('paginas')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Data e Hora -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="inputData" class="form-label">
                        <strong><i class="fas fa-calendar me-2 text-primary"></i>Data da Defesa</strong>
                    </label>
                    <input
                        type="date"
                        name="data"
                        class="form-control form-control-lg @error('data') is-invalid @enderror"
                        id="inputData"
                        required>
                    @error('data')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="inputHora" class="form-label">
                        <strong><i class="fas fa-clock me-2 text-primary"></i>Horário da Defesa</strong>
                    </label>
                    <input
                        type="time"
                        name="hora"
                        class="form-control form-control-lg @error('hora') is-invalid @enderror"
                        id="inputHora"
                        required>
                    @error('hora')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Aluno e Resumo -->
        <div class="mb-4">
            <label for="inputAluno" class="form-label">
                <strong><i class="fas fa-user-graduate me-2 text-primary"></i>Nome do Aluno</strong>
            </label>
            <input
                type="text"
                name="aluno"
                maxlength="100"
                minlength="5"
                class="form-control form-control-lg @error('aluno') is-invalid @enderror"
                id="inputAluno"
                required
                placeholder="Ex: João Silva Santos"
                oninput="tamanhoMax(this); verificarMin(this)">
            <small class="form-text text-muted">Mínimo de 5 caracteres</small>
            @error('aluno')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="inputResumo" class="form-label">
                <strong><i class="fas fa-align-left me-2 text-primary"></i>Resumo</strong>
            </label>
            <textarea
                name="resumo"
                maxlength="200"
                minlength="10"
                class="form-control form-control-lg @error('resumo') is-invalid @enderror"
                id="inputResumo"
                required
                rows="3"
                placeholder="Descrição breve do trabalho..."
                oninput="tamanhoMax(this); verificarMin(this)"></textarea>
            <small class="form-text text-muted">Máximo de 200 caracteres</small>
            @error('resumo')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="inputPalavrasChave" class="form-label">
                <strong><i class="fas fa-tags me-2 text-primary"></i>Palavras-Chave</strong>
            </label>
            <input
                type="text"
                name="palavras_chave"
                maxlength="200"
                minlength="5"
                class="form-control form-control-lg @error('palavras_chave') is-invalid @enderror"
                id="inputPalavrasChave"
                required
                placeholder="Ex: Tecnologia, Educação, Inovação"
                oninput="tamanhoMax(this); verificarMin(this)">
            <small class="form-text text-muted">Separadas por vírgula</small>
            @error('palavras_chave')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Arquivo PDF -->
        <div class="mb-4">
            <label for="inputPdf" class="form-label">
                <strong><i class="fas fa-file-pdf me-2 text-danger"></i>Arquivo PDF</strong>
            </label>
            <input
                type="file"
                name="pdf"
                accept=".pdf"
                class="form-control form-control-lg @error('pdf') is-invalid @enderror"
                id="inputPdf"
                required>
            <small class="form-text text-muted">Somente arquivos PDF</small>
            @error('pdf')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Banca -->
        <hr class="my-4">
        <h5 class="fw-bold mb-4"><i class="fas fa-users me-2 text-primary"></i>Composição da Banca</h5>

        <div class="mb-4">
            <label for="inputOrientador" class="form-label">
                <strong><i class="fas fa-chalkboard-teacher me-2 text-success"></i>Orientador</strong>
            </label>
            <select
                name="orientador" 
                id="inputOrientador" 
                class="form-select form-select-lg @error('orientador') is-invalid @enderror" 
                required>
                <option value="">Selecione um orientador</option>
                @foreach($banca as $ba)
                    <option value="{{ $ba->id }}">{{ $ba->nome }}</option>
                @endforeach
            </select>
            @error('orientador')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="inputBanca" class="form-label">
                        <strong><i class="fas fa-user-tie me-2 text-info"></i>Membro 1 da Banca</strong>
                    </label>
                    <select 
                        name="banca_1" 
                        id="inputBanca" 
                        class="form-select form-select-lg @error('banca_1') is-invalid @enderror" 
                        required>
                        <option value="">Selecione um membro</option>
                        @foreach($banca as $ba)
                            <option value="{{ $ba->id }}">{{ $ba->nome }}</option>
                        @endforeach
                    </select>
                    @error('banca_1')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-4">
                    <label for="inputBanca2" class="form-label">
                        <strong><i class="fas fa-user-tie me-2 text-info"></i>Membro 2 da Banca</strong>
                    </label>
                    <select 
                        name="banca_2" 
                        id="inputBanca2" 
                        class="form-select form-select-lg @error('banca_2') is-invalid @enderror" 
                        required>
                        <option value="">Selecione um membro</option>
                        @foreach($banca as $ba)
                            <option value="{{ $ba->id }}">{{ $ba->nome }}</option>
                        @endforeach
                    </select>
                    @error('banca_2')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Botões -->
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-check-circle me-2"></i>Cadastrar TCC
            </button>
            <a href="{{ route('tcc.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-times me-2"></i>Cancelar
            </a>
        </div>
    </form>
        </div>
    </div>
</div>
@endsection

<script>
    function tamanhoMax(e)
    {
        if (e.value.length > e.maxLength)
        e.value = e.value.slice(0, e.maxLength)
    }

    function verificarMin(e) {
        const min = e.getAttribute('minlength');
        if (e.value.length > 0 && e.value.length < min) {
            e.style.borderColor = "red";
            e.style.borderWidth = "2px"; 
        } else {
            e.style.borderColor = ""; 
            e.style.borderWidth = "";
        }
    }

    document.addEventListener("DOMContentLoaded", (event) => {
    const form = document.querySelector("form");
    const inputs = form.querySelectorAll("input");
    form.addEventListener("submit", function (event) {
            let formValid = true;
            inputs.forEach(e => {
                if (e.value.length > 0 && e.value.length < e.getAttribute('minlength')) {
                    formValid = false;
                }
            });
            if (!formValid) {
                event.preventDefault();
                alert("Preencha todos os campos corretamente!");
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
    const orientador = document.querySelector('[name="orientador"]');
    const banca1 = document.querySelector('[name="banca_1"]');
    const banca2 = document.querySelector('[name="banca_2"]');

    function atualizarOpcoes() {
        const valoresSelecionados = [
            orientador.value,
            banca1.value,
            banca2.value
        ];

        [orientador, banca1, banca2].forEach(select => {
            Array.from(select.options).forEach(option => {
                if (option.value === "") return;

                if (valoresSelecionados.includes(option.value) && option.value !== select.value) {
                    option.style.display = "none";
                } else {
                    option.style.display = "block";
                }
            });
        });
    }

    orientador.addEventListener("change", atualizarOpcoes);
    banca1.addEventListener("change", atualizarOpcoes);
    banca2.addEventListener("change", atualizarOpcoes);
});
</script>