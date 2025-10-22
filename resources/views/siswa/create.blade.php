@extends('layouts.app')

@section('title', 'Tambah Siswa - Sistem Sekolah')

@section('content')
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card slide-up">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="card-title">
                            <i data-lucide="user-plus" style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                            Tambah Siswa Baru
                        </h3>
                        <p class="text-muted" style="margin: 0; font-size: var(--font-size-sm);">
                            Lengkapi form di bawah untuk menambahkan siswa baru ke sistem
                        </p>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
                        Kembali
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('siswa.store') }}">
                    @csrf
                    
                    <!-- Account Information Section -->
                    <div style="border-bottom: 1px solid var(--gray-200); padding-bottom: var(--spacing-5); margin-bottom: var(--spacing-5);">
                        <h5 style="color: var(--gray-800); margin-bottom: var(--spacing-4);">
                            <i data-lucide="key" style="width: 18px; height: 18px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Informasi Akun
                        </h5>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="username" class="form-label">
                                        <i data-lucide="user" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Username
                                    </label>
                                    <input 
                                        type="text" 
                                        id="username"
                                        name="username" 
                                        class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" 
                                        placeholder="Masukkan username unik"
                                        value="{{ old('username') }}"
                                        required
                                        autofocus
                                    >
                                    @if($errors->has('username'))
                                        <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i data-lucide="lock" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Password
                                    </label>
                                    <input 
                                        type="password" 
                                        id="password"
                                        name="password" 
                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                        placeholder="Masukkan password"
                                        required
                                    >
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Personal Information Section -->
                    <div>
                        <h5 style="color: var(--gray-800); margin-bottom: var(--spacing-4);">
                            <i data-lucide="user" style="width: 18px; height: 18px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Data Pribadi Siswa
                        </h5>
                        
                        <div class="form-group">
                            <label for="nama" class="form-label">
                                <i data-lucide="user" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                Nama Lengkap
                            </label>
                            <input 
                                type="text" 
                                id="nama"
                                name="nama" 
                                class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" 
                                placeholder="Masukkan nama lengkap siswa"
                                value="{{ old('nama') }}"
                                required
                            >
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                            @endif
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tb" class="form-label">
                                        <i data-lucide="activity" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Tinggi Badan (cm)
                                    </label>
                                    <input 
                                        type="number" 
                                        id="tb"
                                        name="tb" 
                                        class="form-control {{ $errors->has('tb') ? 'is-invalid' : '' }}" 
                                        placeholder="Contoh: 165"
                                        value="{{ old('tb') }}"
                                        min="100"
                                        max="250"
                                        required
                                    >
                                    @if($errors->has('tb'))
                                        <div class="invalid-feedback">{{ $errors->first('tb') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="bb" class="form-label">
                                        <i data-lucide="scale" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Berat Badan (kg)
                                    </label>
                                    <input 
                                        type="number" 
                                        id="bb"
                                        name="bb" 
                                        class="form-control {{ $errors->has('bb') ? 'is-invalid' : '' }}" 
                                        placeholder="Contoh: 55"
                                        value="{{ old('bb') }}"
                                        min="20"
                                        max="200"
                                        step="0.1"
                                        required
                                    >
                                    @if($errors->has('bb'))
                                        <div class="invalid-feedback">{{ $errors->first('bb') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-3" style="margin-top: var(--spacing-6);">
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i data-lucide="x" style="width: 16px; height: 16px;"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                            Simpan Data Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection