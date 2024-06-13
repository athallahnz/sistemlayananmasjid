<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="row justify-content-center">
    <div class="col-5">
        <div class="container">
            <div class="mb-4 py-1 text-center">
                <img src={{ Vite::asset('resources/images/logo.png') }} class="rounded-circle mb-3 p-1"
                        alt="" width="150" height="150">
                <h2 class="fw-bold">Selamat Datang di</h2>
                <h5 class="fw-lighter">Masjid Al Iman Surabaya</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12 d-grid">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Enter Your Email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    <div class="row mb-3">
                        <div class="col-md-12 d-grid">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" placeholder="Enter Your Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">
                            <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                            </div>
                        </div>
                            <div class="col">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg mt-3"
                                        style="background-color: #622200">
                                        <i class="bi-arrow-left-circle me-2"></i>
                                            {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                </form>
                <div class="row mb-2">
                    <div class="col-md-12 text-center">
                        <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="col" style="background-color: #622200">
    </div>
</body>
</html>

