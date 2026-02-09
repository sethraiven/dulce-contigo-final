@extends('layouts.app')

@section('content')
<!-- Font Awesome para el icono del ojo -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        background: rgba(246, 253, 254, 1);
    }
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        border-radius: 18px;
        box-shadow: 0 8px 32px 0 rgba(18, 33, 61, 0.12);
        border: none;
        background: #fff;
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 430px;
        width: 100%;
    }
    .login-card .card-header {
        background: rgba(18, 33, 61, 1);
        color: rgba(246, 253, 254, 1);
        border-radius: 16px 16px 0 0;
        font-size: 1.5rem;
        text-align: center;
        font-weight: 600;
        letter-spacing: 1px;
        border: none;
        margin-bottom: 1.5rem;
        padding: 1.2rem 1rem;
    }
    .form-control:focus {
        border-color: rgba(18, 33, 61, 1) !important;
        box-shadow: 0 0 0 0.2rem rgba(18, 33, 61, 0.15) !important;
    }
    .btn-primary {
        background: rgba(18, 33, 61, 1);
        color: rgba(246, 253, 254, 1);
        border: none;
        font-weight: 600;
        transition: background 0.2s;
    }
    .btn-primary:focus {
        box-shadow: none !important;
        outline: none !important;
    }
    .btn-primary:hover {
        background: rgba(217, 140, 82, 1);
        color: rgba(18, 33, 61, 1);
    }
    .btn-link {
        color: rgba(217, 140, 82, 1);
        font-weight: 500;
    }
    .btn-link:hover {
        color: rgba(18, 33, 61, 1);
        text-decoration: underline;
    }
    .register-link {
        display: block;
        text-align: center;
        margin-top: 1.5rem;
        font-size: 1rem;
        color: rgba(18, 33, 61, 1);
    }
    .register-link a {
        color: rgba(217, 140, 82, 1);
        font-weight: 600;
        text-decoration: none;
        margin-left: 4px;
    }
    .register-link a:hover {
        color: rgba(18, 33, 61, 1);
        text-decoration: underline;
    }
    /* Estilos para el icono del ojo */
    .password-wrapper {
        position: relative;
    }
    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: rgba(18, 33, 61, 1);
        z-index: 2;
        font-size: 1.1em;
    }
</style>
<div class="login-container">
    <div class="login-card card">
        <div class="card-header">{{ __('Login') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="password-wrapper">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        <span toggle="#password" class="fa fa-eye toggle-password"></span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="d-grid gap-2 mb-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection