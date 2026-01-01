<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (app()->getLocale() === 'ar') dir="rtl" @endif>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset(config('app.logo')) }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <title>{{ __('Admin Login') }} - {{ config('app.name') }}</title>
    <x-dashboard.styles />
    <x-dashboard.scripts-header />
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('backend/css/rtl.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:slnt,wght@-11..11,200..1000&display=swap" rel="stylesheet">
    @endif
    <style>
        :root {
            --theme-primary: #4e73df;
            --theme-accent: #1cc88a;
            --theme-gradient: linear-gradient(135deg, #4e73df 0%, #1cc88a 100%);
        }

        @if (app()->getLocale() == 'ar')
        body * {
            font-family: 'Cairo', sans-serif !important;
        }
        @endif

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1d1701 0%, #2d2515 50%, #1d1701 100%);
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            padding: 2.5rem;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-container img {
            width: 200px;
            height: auto;
            display: block;
            margin: 0 auto 1rem;
        }

        .login-title {
            color: #fff;
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
        }

        .login-form {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            color: #fff;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            color: #333;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-control:focus {
            background: #fff;
            border-color: var(--theme-primary);
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.2);
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: var(--theme-gradient);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 0.5rem;
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 115, 223, 0.5);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            background: rgba(231, 74, 59, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(231, 74, 59, 0.3);
            border-radius: 10px;
            color: #fff;
            padding: 1rem;
            margin-bottom: 1.25rem;
            font-size: 14px;
        }

        .alert ul {
            margin: 0.5rem 0 0 0;
            padding-left: 1.25rem;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                padding: 2rem 1.5rem;
            }

            .logo-container img {
                width: 160px;
            }

            .login-title {
                font-size: 1.5rem;
            }
        }

        /* RTL Support */
        [dir="rtl"] .form-control {
            text-align: right;
        }

        [dir="rtl"] .logo-container {
            direction: ltr;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <img src="{{ asset(config('app.logo')) }}" alt="Logo">
                <h1 class="login-title">{{ __('Admin Login') }}</h1>
            </div>

            @if ($errors->any())
                <div class="alert">
                    <strong>{{ __('Whoops!') }}</strong> {{ __('There were some problems with your input.') }}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="post" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control"
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="email"
                        autofocus 
                        placeholder="{{ __('Enter your email') }}">
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control"
                        name="password" 
                        placeholder="{{ __('Enter your password') }}" 
                        required>
                </div>
                <button type="submit" class="btn-login">
                    {{ __('Login') }}
                </button>
            </form>
        </div>
    </div>
    <x-dashboard.scripts-footer />
</body>

</html>
