{{-- resources/views/components/guest-layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - KICT X-Change</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light" style="background-image: url('{{ asset('assets/img/background-kict2.jpg') }}'); background-size: cover; background-position: center; height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; backdrop-filter: blur(5px);">
        <div class="bg-white p-4 rounded shadow" style="min-width: 350px;">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
