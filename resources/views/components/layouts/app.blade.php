<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="https://github.com/boysimbolon/angkringanFTI/blob/main/public/ftilogos.jpeg?raw=true" type="image/jpeg">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Responsive Navigation */
        .nav-container {
            padding: 20px;
            background-color: #d4dceb;
            color: #1a202c;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap; /* Membuat menu wrap ke baris baru jika tidak cukup ruang */
        }

        .nav-link {
            background-color: white;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: #1a202c;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #f0f0f0;
        }

        /* Responsive Main Content */
        .main-content>.footer {
            padding: 20px;
            text-align: center;
        }

        .logo {
            width: 80px;
            margin: 20px auto;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        /* Media Queries untuk Layar Kecil */
        @media (max-width: 768px) {
            .nav-container {
                justify-content: center; /* Pusatkan menu di layar kecil */
                gap: 8px;
                padding: 10px;
            }

            .nav-link {
                padding: 6px 10px;
                font-size: 12px;
            }

            .logo {
                width: 60px;
            }

            .footer {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .nav-container {
                flex-direction: column; /* Tumpuk menu vertikal di layar sangat kecil */
                align-items: center;
                gap: 6px;
            }

            .nav-link {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <!-- Navigation Bar -->
    <div class="nav-container">
        @if(Route::currentRouteName() == 'stok')
            <a href="{{ Route('login') }}" class="nav-link">LOGIN</a>
        @elseif(Route::currentRouteName() == 'login')
            <a href="{{ Route('stok') }}" class="nav-link">Home</a>
        @endif
    </div>

    <!-- Page Content -->
    <img src="{{ asset('ftilogos.jpeg') }}" class="logo" alt="Logo">
    <main class="main-content">
        {{ $slot }}
        <div class="footer">
            Karya Anak Academic HIMA FTI 2025
        </div>
    </main>
</div>
</body>
</html>
