<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KICT X-Change</title>
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
            align-items: center;
            justify-content: center;
            color: white;
        }
        .glass-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(6px);
            border-radius: 1rem;
            padding: 3rem 4rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .glass-box h1 {
            font-weight: 700;
        }
        .glass-box p {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="page-header text-center" style="color: #fff;">
        <h3 class="page-title" style="font-size: 4.5rem; font-weight: bold; text-transform: uppercase; color: #fff; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">
            Welcome to MYKICT
        </h3>
        <p style="margin: 20px auto 0; font-size: 1.5rem; font-style: italic; max-width: 600px; color: #f8f9fa; background: rgba(0, 0, 0, 0.5); padding: 10px 20px; border-radius: 10px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); text-align: center;">
            "KICT X-Change"

        </p>
        <ul class="breadcrumb justify-content-center" style="list-style: none; padding: 0; margin-top: 20px;">
            <li class="breadcrumb-item">
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5 py-2 rounded-pill shadow"
                    style="background: rgba(255, 255, 255, 0.2); border: 2px solid white; backdrop-filter: blur(4px); font-weight: bold;">
                    Login
                </a>
            </li>
        </ul>

    </div>
</body>
</html>
