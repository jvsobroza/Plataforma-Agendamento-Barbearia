<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Barbearia Xurupis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo_xurupis.png') }}">
</head>

<body>
    <nav class="nav navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand nav-logo" href="{{ url('/') }}">
                <div class="logo-circle"><img src="{{ asset('assets/logo_xurupis.png') }}" alt="Logo Xurupis"
                        class="rounded-circle"></div>
                <span class="logo-name">XURUPIS</span>
            </a>
            <a href="{{ url('/') }}" class="nav-cta text-decoration-none">Retornar</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="login-card shadow-lg">
            <h3 class="text-center mb-4 text-white" style="letter-spacing: 1px;">Crie sua Conta</h3>
            <form action="{{ url('/registrar') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">NOME</label>
                    <input type="text" class="form-control form-control-custom @error('nome') is-invalid @enderror" id="nome" name="nome"
                        value="{{ old('nome') }}"
                        placeholder="Alarico da Silva" required>
                </div>
                @error('nome')
                    <div class="invalid-feedback fw-bold" style="color: #ff4d4d;">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-3">
                    <label for="tipo" class="form-label">TIPO DE USUÁRIO</label>
                    <div>
                        <input type="radio" class="form-check-input" id="barbeiro" name="tipo" value="1" required>
                        <label for="barbeiro" class="form-check-label">Barbeiro</label>
                    </div>
                    <div>
                        <input type="radio" class="form-check-input" id="cliente" name="tipo" value="2" required>
                        <label for="cliente" class="form-check-label">Cliente</label>
                    </div>
                </div>
                @error('tipo')
                    <div class="invalid-feedback fw-bold" style="color: #ff4d4d;">
                        {{ $message }}
                    </div>
                @enderror
                <div id="div-telefone" class="mb-3 d-none">
                    <label for="telefone" class="form-label">TELEFONE PROFISSIONAL</label>
                    <input type="text" class="form-control form-control-custom @error('telefone') is-invalid @enderror"
                        name="telefone"
                        value="{{ old('telefone') }}"
                        placeholder="(55) 99999-9999">
                </div>
                @error('telefone')
                    <div class="invalid-feedback fw-bold" style="color: #ff4d4d;">
                        {{ $message }}
                    </div>
                @enderror
                <div id="div-endereco" class="mb-3 d-none">
                    <label for="endereco" class="form-label">ENDEREÇO</label>
                    <input type="text" class="form-control form-control-custom @error('endereco') is-invalid @enderror" name="endereco"
                        value="{{ old('endereco') }}" placeholder="Rua Exemplo, 123">
                </div>
                @error('endereco')
                    <div class="invalid-feedback fw-bold" style="color: #ff4d4d;">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-3">
                    <label for="email" class="form-label">E-MAIL</label>
                    <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror"
                        id="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required>
                    @error('email')
                        <div class="invalid-feedback fw-bold" style="color: #ff4d4d; display: block;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">SENHA</label>
                    <input type="password" class="form-control form-control-custom @error('password') is-invalid @enderror"
                        id="password" name="password" value="{{ old('password') }}"placeholder="••••••••" required>
                </div>
                @error('password')
                    <div class="invalid-feedback fw-bold" style="color: #ff4d4d;">
                        {{ $message }}
                    </div>
                @enderror
                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-primary text-uppercase fw-semibold"
                        style="letter-spacing: 1px; font-size: 13px; border-radius: 0;">Criar conta</button>
                    <a href="{{ url('/login') }}"
                        class="btn nav-cta text-decoration-none text-center d-block fw-semibold"
                        style="letter-spacing: 1px; font-size: 13px;">Já tenho conta</a>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="footer-bottom d-flex justify-content-between align-items-center">
                <div class="nav-logo">
                    <div class="logo-circle"><img src="{{ asset('assets/logo_xurupis.png') }}" alt="Logo Xurupis"
                            class="rounded-circle"></div>
                    <span class="logo-name">XURUPIS</span>
                </div>
                <span>Desenvolvido por João Victor Sobroza Dal Ross — 2026</span>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipoRadios = document.querySelectorAll('input[name="tipo"]');
        const divTelefone = document.getElementById('div-telefone');
        const divEndereco = document.getElementById('div-endereco');

        tipoRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === '1') { // Barbeiro
                    divTelefone.classList.remove('d-none');
                    divEndereco.classList.add('d-none');
                } else if (this.value === '2') { // Cliente
                    divEndereco.classList.remove('d-none');
                    divTelefone.classList.add('d-none');
                }
            });
        });
    });
</script>

</html>