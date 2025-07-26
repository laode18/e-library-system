@extends('layouts.auth')

@section('title', 'Register - Library Management System')

@section('content')
<div class="auth-header">
    <i class="fas fa-user-plus fa-2x mb-3"></i>
    <h1>Daftar Akun</h1>
    <p class="mb-0">Buat akun baru Anda</p>
</div>

<div class="auth-body">
    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <i class="fas fa-exclamation-circle me-2"></i>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" placeholder="Nama Lengkap" 
                   value="{{ old('name') }}" required>
            <label for="name">
                <i class="fas fa-user me-2"></i>Nama Lengkap
            </label>
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   id="email" name="email" placeholder="name@example.com" 
                   value="{{ old('email') }}" required>
            <label for="email">
                <i class="fas fa-envelope me-2"></i>Email
            </label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password" placeholder="Password" required>
            <label for="password">
                <i class="fas fa-lock me-2"></i>Password
            </label>
        </div>

        <div class="form-floating mb-4">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                   id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
            <label for="password_confirmation">
                <i class="fas fa-lock me-2"></i>Konfirmasi Password
            </label>
        </div>

        <button type="submit" class="btn btn-primary mb-4">
            <i class="fas fa-user-plus me-2"></i>
            Daftar
        </button>

        <div class="text-center">
            <p class="mb-0">Sudah punya akun? 
                <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
            </p>
        </div>
    </form>
</div>
@endsection
