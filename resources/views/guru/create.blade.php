@extends('layouts.app')

@section('title', 'Daftar Guru - Sistem Sekolah')

@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card slide-up">
            <div class="card-header text-center">
                <div style="margin-bottom: var(--spacing-4);">
                    <i data-lucide="user-check" style="width: 48px; height: 48px; color: var(--primary-600);"></i>
                </div>
                <h3 class="card-title">Daftar Akun Guru</h3>
                <p class="text-muted" style="margin: 0; font-size: var(--font-size-sm);">
                    Lengkapi form di bawah untuk membuat akun guru baru
                </p>
            </div>
            
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h6 class="alert-heading">
                            <i data-lucide="alert-circle" style="width: 18px; height: 18px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Validasi Gagal
                        </h6>
                        <ul style="margin: 0; padding-left: var(--spacing-5);">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('guru.store') }}">
                    @csrf
                    
                    <!-- Basic Information -->
                    <div class="form-group">
                        <label for="username" class="form-label">
                            <i data-lucide="user" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Username
                        </label>
                        <input 
                            type="text" 
                            id="username"
                            name="username" 
                            class="form-control @error('username') is-invalid @enderror" 
                            placeholder="Masukkan username unik"
                            value="{{ old('username') }}"
                            required
                            autofocus
                        >
                        @error('username')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
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
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Masukkan password yang kuat (minimal 6 karakter)"
                            required
                        >
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Guru Information -->
                    <div style="border-top: 1px solid var(--gray-200); padding-top: var(--spacing-5); margin-top: var(--spacing-5); margin-bottom: var(--spacing-5);">
                        <h5 style="color: var(--gray-800); margin-bottom: var(--spacing-4);">
                            <i data-lucide="user-check" style="width: 18px; height: 18px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Data Guru
                        </h5>
                        
                        <div class="form-group">
                            <label for="nama_guru" class="form-label">
                                <i data-lucide="user" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                Nama Lengkap
                            </label>
                            <input 
                                type="text" 
                                id="nama_guru"
                                name="nama_guru" 
                                class="form-control @error('nama_guru') is-invalid @enderror" 
                                placeholder="Masukkan nama lengkap guru"
                                value="{{ old('nama_guru') }}"
                                required
                            >
                            @error('nama_guru')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="mapel" class="form-label">
                                <i data-lucide="book-open" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                Mata Pelajaran
                            </label>
                            <input 
                                type="text" 
                                id="mapel"
                                name="mapel" 
                                class="form-control @error('mapel') is-invalid @enderror" 
                                placeholder="Contoh: Matematika, Bahasa Indonesia"
                                value="{{ old('mapel') }}"
                                required
                            >
                            @error('mapel')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i data-lucide="user-check" style="width: 18px; height: 18px;"></i>
                        Daftar Guru
                    </button>
                </form>
            </div>
            
            <div class="card-footer text-center">
                <p class="text-muted" style="margin: 0; font-size: var(--font-size-sm);">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-primary">
                        <i data-lucide="log-in" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i>
                        Login di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
