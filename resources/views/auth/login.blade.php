@extends('layouts.auth')

@section('title', 'Login - Library Management System')

@section('content')
<div class="auth-header">
    <i class="fas fa-book-open fa-2x mb-3"></i>
    <h1>Library System</h1>
    <p class="mb-0">Masuk ke akun Anda</p>
</div>

<div class="auth-body">
    @if(session('success'))
        <div class="alert alert-success mb-4">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        
        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   id="email" name="email" placeholder="name@example.com" 
                   value="{{ old('email') }}" required>
            <label for="email">
                <i class="fas fa-envelope me-2"></i>Email
            </label>
        </div>

        <div class="form-floating mb-4">
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password" placeholder="Password" required>
            <label for="password">
                <i class="fas fa-lock me-2"></i>Password
            </label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="remember" name="remember">
            <label class="form-check-label" for="remember">
                Ingat saya
            </label>
        </div>

        <button type="submit" class="btn btn-primary mb-4">
            <i class="fas fa-sign-in-alt me-2"></i>
            Masuk
        </button>

        <div class="text-center">
            <p class="mb-0">Belum punya akun? 
                <a href="{{ route('register') }}" class="auth-link">Daftar di sini</a>
            </p>
        </div>
    </form>

    
</div>
@endsection
