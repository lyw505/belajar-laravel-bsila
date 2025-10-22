@extends('layouts.app')

@section('title', 'Login - Sistem Sekolah')

@section('content')
<div class="row justify-content-center">
    <div class="col-4">
        <div class="card slide-up">
            <div class="card-header text-center">
                <div style="margin-bottom: var(--spacing-4);">
                    <i data-lucide="lock" style="width: 48px; height: 48px; color: var(--primary-600);"></i>
                </div>
                <h3 class="card-title">Login ke Sistem</h3>
                <p class="text-muted" style="margin: 0; font-size: var(--font-size-sm);">
                    Masukkan kredensial Anda untuk mengakses dashboard
                </p>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i data-lucide="user" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Username
                        </label>
                        <input 
                            type="text" 
                            id="username"
                            name="username" 
                            class="form-control" 
                            placeholder="Masukkan username Anda"
                            value="{{ old('username') }}"
                            required
                            autofocus
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i data-lucide="lock" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Password
                        </label>
                        <input 
                            type="password" 
                            id="password"
                            name="password" 
                            class="form-control" 
                            placeholder="Masukkan password Anda"
                            required
                        >
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i data-lucide="log-in" style="width: 18px; height: 18px;"></i>
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
            
            <div class="card-footer text-center">
                <p class="text-muted" style="margin: 0; font-size: var(--font-size-sm);">
                    Belum punya akun? 
                    <a href="{{ route('register.form') }}" class="text-primary">
                        <i data-lucide="user-plus" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i>
                        Daftar di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection