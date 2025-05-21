<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Login - KICT X-Change</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-image: url('{{ asset('assets/img/background-kict2.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 0.75rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .login-box img {
            height: 80px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="login-box">
        {{-- <img src="{{ asset('assets/img/logokict.png') }}" alt="KICT Logo"> --}}
        {{ $slot }}
    </div>

</body>
</html>
