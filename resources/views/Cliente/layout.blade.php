<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Barbeiro - Xurupis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo_xurupis.png') }}">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="nav navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand nav-logo" href="{{ url('/cliente') }}">
                <div class="logo-circle"><img src="{{ asset('assets/logo_xurupis.png') }}" alt="Logo Xurupis" class="rounded-circle"></div>
                <span class="logo-name">XURUPIS <span style="font-size: 12px; color: #c95c0a;">| CLIENTE</span></span>
            </a>
            @auth
                <div class="d-flex align-items-center gap-4">
                    <span style="color: #fff; font-size: 12px; letter-spacing: 1px; text-transform: uppercase;">
                        Olá, {{ auth()->user()->nome }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="nav-cta text-decoration-none" style="border: none;">Sair</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 py-4" style="background-color: #121212;">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
