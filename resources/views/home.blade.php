<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Document</title>
</head>

<body>
    <header class="navbar-header">
        <nav class="navbar-container">
            <div class="navbar-content">
                <div class="navbar-brand">
                    <img src="{{ asset('img/imgTeste.jpg') }}" alt="Logo" class="navbar-logo">
                </div>
                <div class="navbar-menu">
                    <a href="#" class="nav-link">Início</a>
                    <a href="#" class="nav-link">Estoque</a>
                    <a href="#" class="nav-link">Serviços</a>
                    <a href="#" class="nav-link">Sobre</a>
                </div>

                <div class="navbar-actions">
                    <button class="icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                    <button class="cta-button">Fale Conosco</button>

                    <button id="hamburger-btn" class="icon-button hamburger-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="mobile-menu" class="mobile-menu">
                <a href="#" class="mobile-nav-link">Início</a>
                <a href="#" class="mobile-nav-link">Estoque</a>
                <a href="#" class="mobile-nav-link">Serviços</a>
                <a href="#" class="mobile-nav-link">Sobre</a>
            </div>
        </nav>
    </header>
</body>
<script src="{{ asset('js/home.js') }}"></script>
</html>