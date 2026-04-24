<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Barbearia Xurupis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="nav navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand nav-logo" href="{{ url('/') }}">
                <div class="logo-circle"><img src="{{ asset('assets/logo_xurupis.png') }}" alt="Logo Xurupis" class="rounded-circle"></div>
                <span class="logo-name">XURUPIS</span>
            </a>
            <a href="{{ url('/') }}" class="nav-cta text-decoration-none">Retornar</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="login-card shadow-lg">
            <h3 class="text-center mb-4 text-white" style="letter-spacing: 1px;">Acesse sua Conta</h3>
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">E-MAIL</label>
                    <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" id="email" name="email" placeholder="seu@email.com" required>
                </div>
                @error('email')
                    <div class="invalid-feedback fw-bold" style="color: #ff4d4d;">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-4">
                    <label for="password" class="form-label">SENHA</label>
                    <input type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-primary text-uppercase fw-semibold" style="letter-spacing: 1px; font-size: 13px; border-radius: 0;">Logar</button>
                    <a href="{{ url('/register') }}" class="btn nav-cta text-decoration-none text-center d-block fw-semibold" style="letter-spacing: 1px; font-size: 13px;">Criar Conta</a>
                </div>
                @error('password')
                    <div class="invalid-feedback fw-bold" style="color: #ff4d4d;">
                        {{ $message }}
                    </div>
                @enderror
            </form>
        </div>
    </main>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="footer-bottom d-flex justify-content-between align-items-center">
                <div class="nav-logo">
                    <div class="logo-circle"><img src="{{ asset('assets/logo_xurupis.png') }}" alt="Logo Xurupis" class="rounded-circle"></div>
                    <span class="logo-name">XURUPIS</span>
                </div>
                <span>Desenvolvido por João Victor Sobroza Dal Ross — 2026</span>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>