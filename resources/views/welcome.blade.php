<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Barbearia Xurupis</title>
</head>

<body>
    <nav class="nav navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand nav-logo" href="#">
                <div class="logo-circle"><img src="{{ asset('assets/logo_xurupis.png') }}" alt="Logo Xurupis" class="rounded-circle"></div>
                <span class="logo-name">XURUPIS</span>
            </a>
            <a href="{{ url('/login') }}" class="nav-cta text-decoration-none">Login / Cadastro</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-bg">
            <svg viewBox="0 0 800 480" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
                <rect x="60" y="40" width="8" height="400" fill="#666" />
                <rect x="120" y="40" width="8" height="400" fill="#555" />
                <rect x="180" y="40" width="8" height="400" fill="#666" />
                <rect x="240" y="40" width="8" height="400" fill="#555" />
                <rect x="300" y="40" width="8" height="400" fill="#666" />
                <rect x="360" y="40" width="8" height="400" fill="#555" />
                <rect x="420" y="40" width="8" height="400" fill="#666" />
                <rect x="480" y="40" width="8" height="400" fill="#555" />
                <rect x="540" y="40" width="8" height="400" fill="#666" />
                <rect x="600" y="40" width="8" height="400" fill="#555" />
                <rect x="660" y="40" width="8" height="400" fill="#666" />
                <rect x="720" y="40" width="8" height="400" fill="#555" />
                <rect x="40" y="100" width="720" height="8" fill="#555" />
                <rect x="40" y="160" width="720" height="8" fill="#666" />
                <rect x="40" y="220" width="720" height="8" fill="#555" />
                <rect x="40" y="280" width="720" height="8" fill="#666" />
                <rect x="40" y="340" width="720" height="8" fill="#555" />
                <rect x="100" y="100" width="100" height="60" fill="#444" rx="2" />
                <rect x="280" y="150" width="120" height="80" fill="#3a3a3a" rx="2" />
                <rect x="500" y="90" width="110" height="70" fill="#444" rx="2" />
                <circle cx="160" cy="370" r="30" fill="none" stroke="#555" stroke-width="3" />
                <circle cx="400" cy="380" r="28" fill="none" stroke="#555" stroke-width="3" />
                <circle cx="640" cy="365" r="32" fill="none" stroke="#555" stroke-width="3" />
            </svg>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <div class="hero-badge">Barbearia Premium — Est. 2026</div>
            <h1 class="hero-title">O CORTE QUE DEFINE <span style="color: #c95c0a;">SUA ATITUDE.</span></h1>
            <p class="hero-sub">
                Navalha afiada, ambiente raiz e um sistema de agendamento que respeita o
                seu tempo.
            </p>
        </div>
    </section>

    <section class="section container">
        <p class="section-label">Por que a Xurupis?</p>
        <h2 class="section-title">Três razões para você voltar sempre</h2>
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="dif-card h-100">
                    <div class="dif-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2L3 7v10l9 5 9-5V7L12 2z" />
                            <line x1="12" y1="22" x2="12" y2="12" />
                            <line x1="3" y1="7" x2="12" y2="12" />
                            <line x1="21" y1="7" x2="12" y2="12" />
                        </svg>
                    </div>
                    <div class="dif-title">Ferramentas de Precisão</div>
                    <div class="dif-desc">
                        Navalhas de fio e máquinas profissionais de última geração para um
                        acabamento impecável em cada detalhe.
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dif-card h-100">
                    <div class="dif-icon">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="3" width="20" height="14" rx="2" />
                            <line x1="8" y1="21" x2="16" y2="21" />
                            <line x1="12" y1="17" x2="12" y2="21" />
                        </svg>
                    </div>
                    <div class="dif-title">Ambiente Industrial</div>
                    <div class="dif-desc">
                        Tijolos à vista, couro legítimo e iluminação quente. Wi-Fi de graça e
                        café fresco enquanto você espera.
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dif-card h-100">
                    <div class="dif-icon">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                            <line x1="8" y1="14" x2="8" y2="14" stroke-linecap="round" />
                            <line x1="12" y1="14" x2="12" y2="14" stroke-linecap="round" />
                            <line x1="16" y1="14" x2="16" y2="14" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="dif-title">Agendamento Inteligente</div>
                    <div class="dif-desc">
                        Sistema próprio desenvolvido internamente. Escolha dia, horário e
                        barbeiro em menos de 30 segundos.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row mb-5">
            <div class="col-md-6">
                <div class="footer-col-title">Localização</div>
                <div class="footer-map"><span>— Jaguari / Santa Maria, RS —</span></div>
                <div class="footer-text" style="margin-top: 10px">
                    Rua Olavo, 123<br />Centro — RS
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-col-title">Horários</div>
                <div class="footer-text">
                    Seg – Sex &nbsp;&nbsp; 09h às 20h<br />
                    Sábado &nbsp;&nbsp;&nbsp;&nbsp; 09h às 18h<br />
                    Domingo &nbsp;&nbsp; Fechado
                </div>
            </div>
        </div>
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