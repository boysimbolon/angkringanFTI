<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://github.com/boysimbolon/angkringanFTI/blob/main/public/ftilogos.jpeg?raw=true" type="image/jpeg">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script defer src="{{ asset('js/script.js') }}"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }
        a.aktif{
            background-color: #d6928e;
            color: black;
        }
        .container {
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #d4dceb;
            padding: 15px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 50px;
            border-radius: 50%;
        }

        .menu {
            display: flex;
            gap: 10px;
        }

        .menu a {
            text-decoration: none;
            padding: 8px 15px;
            background-color: white;
            color: #333;
            border-radius: 4px;
            transition: 0.3s;
        }

        .menu a.logout {
            color: red;
        }

        .menu a:hover {
            background-color: #e0e0e0;
        }

        /* Tombol menu untuk tampilan mobile */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }

        /* Responsif: Pindahkan menu ke bawah saat layar kecil */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .logo {
                margin: auto;
            }
            .menu {
                flex-direction: column;
                width: 100%;
                display: none;
            }

            .menu.active {
                display: flex;
            }

            .menu-toggle {
                display: block;
                margin-left: auto;
            }
        }

    </style>
</head>
<body>
<div class="container">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('ftilogos.jpeg') }}" alt="Logo FTI">
        </div>
        <div class="menu" id="menu">
            @if(session('login_as') == 'bendahara')
                <a href="{{ route('stok-bendahara') }}" style="{{Route::currentRouteName() == 'stok-bendahara' ? 'background:rgba(66, 93, 154, 0.5);color:white':''}}">STOCK</a>
                <a href="{{ route('form-pesanan') }}" style="{{Route::currentRouteName() == 'form-pesanan' ? 'background:rgba(66, 93, 154, 0.5);color:white':''}}">FORM Pesanan</a>
                <a href="{{ route('menu') }}" style="{{Route::currentRouteName() == 'menu' ? 'background:rgba(66, 93, 154, 0.5);color:white':''}}">MENU</a>
                <a href="{{ route('histori') }}" style="{{Route::currentRouteName() == 'histori' ? 'background:rgba(66, 93, 154, 0.5);color:white':''}}">Pesanan</a>
                <a href="{{ route('logout') }}" class="logout">LOGOUT</a>
            @elseif(session('login_as') == 'serving')
                <a href="{{ route('stok-serving') }}" style="{{Route::currentRouteName() == 'stok-serving' ? 'background:rgba(66, 93, 154, 0.5);color:white':''}}">STOCK</a>
                <a href="{{ route('histori') }}" style="{{Route::currentRouteName() == 'histori' ? 'background:rgba(66, 93, 154, 0.5);color:white':''}}">Pesanan</a>
                <a href="{{ route('logout') }}" class="logout">LOGOUT</a>
                @elseif(Route::currentRouteName() == 'stok')
                    <a href="{{ Route('login') }}" class="nav-link">LOGIN</a>
                @endif
        </div>
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
    </nav>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

<script>
    function toggleMenu() {
        var menu = document.getElementById('menu');
        menu.classList.toggle('active');
    }
</script>
</body>
</html>
