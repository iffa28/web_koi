<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="[https://fonts.bunny.net](https://fonts.bunny.net)">
    <link
        href="[https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap](https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap)"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'figtree', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-image: url('{{ asset('images/koi.png') }}');
            /* Ensure this path is correct */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }

        .form-input {
            border-radius: 8px !important;
            border: 1px solid #ccc !important;
            background-color: white !important;
            padding: 0.75rem;
            width: 100%;
            box-sizing: border-box;
            margin-top: 0.25rem;
            color: #111827; /* Tambahkan baris ini */
        }

        .btn-primary {
            background-color: #1e3a8a !important;
            /* Dark blue color */
            color: white !important;
            border-radius: 10px !important;
            padding: 1rem !important;
            text-align: center;
            font-weight: bold;
            width: 100%;
            display: block;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
            margin-top: 1.5rem;
        }

        .btn-primary:hover {
            background-color: #152b61 !important;
        }

        .text-white-custom {
            color: #f9f9f9;
        }

        .text-center-custom {
            text-align: center;
        }

        .mt-custom {
            margin-top: 1rem;
        }

        .mb-custom {
            margin-bottom: 0.75rem;
        }

        .text-sm-custom {
            font-size: 0.875rem;
        }

        .underline-custom {
            text-decoration: underline;
        }

        .flex-center-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 login-background">
        <div class="w-full sm:max-w-md mt-6 px-4 py-4 glass-card overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
