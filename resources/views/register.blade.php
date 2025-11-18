@extends('layouts.app')

@section('title', 'Daftar Akun - Sistem Sekolah')

@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card slide-up">
            <div class="card-header text-center">
                <div style="margin-bottom: var(--spacing-4);">
                    <i data-lucide="user-plus" style="width: 48px; height: 48px; color: var(--primary-600);"></i>
                </div>
                <h3 class="card-title">Daftar Akun Baru</h3>
                <p class="text-muted" style="margin: 0; font-size: var(--font-size-sm);">
                    Lengkapi form di bawah untuk membuat akun baru
                </p>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('register.post') }}">
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
                            class="form-control" 
                            placeholder="Masukkan username unik"
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
                            placeholder="Masukkan password yang kuat"
                            required
                        >
                    </div>
                    
                    <!-- Role Selection -->
                    <div class="form-group">
                        <label class="form-label">
                            <i data-lucide="shield" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Pilih Role
                        </label>
                        <div style="display: flex; gap: var(--spacing-4); margin-top: var(--spacing-2);">
                            <div class="form-check">
                                <input 
                                    type="radio" 
                                    id="role_admin"
                                    name="role" 
                                    value="admin" 
                                    class="form-check-input"
                                    onchange="showChoice(this.value)" 
                                    {{ old('role') === 'admin' ? 'checked' : '' }}
                                    required
                                >
                                <label for="role_admin" class="form-check-label">
                                    <i data-lucide="shield-check" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i>
                                    Admin
                                </label>
                            </div>
                            <div class="form-check">
                                <input 
                                    type="radio" 
                                    id="role_guru"
                                    name="role" 
                                    value="guru" 
                                    class="form-check-input"
                                    onchange="showChoice(this.value)"
                                    {{ old('role') === 'guru' ? 'checked' : '' }}
                                >
                                <label for="role_guru" class="form-check-label">
                                    <i data-lucide="user-check" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i>
                                    Guru
                                </label>
                            </div>
                            <div class="form-check">
                                <input 
                                    type="radio" 
                                    id="role_siswa"
                                    name="role" 
                                    value="siswa" 
                                    class="form-check-input"
                                    onchange="showChoice(this.value)"
                                    {{ old('role') === 'siswa' ? 'checked' : '' }}
                                >
                                <label for="role_siswa" class="form-check-label">
                                    <i data-lucide="user" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i>
                                    Siswa
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Fields for Siswa -->
                    <div id="siswa-fields" style="display: none;">
                        <div style="border-top: 1px solid var(--gray-200); padding-top: var(--spacing-5); margin-top: var(--spacing-5);">
                            <h5 style="color: var(--gray-800); margin-bottom: var(--spacing-4);">
                                <i data-lucide="user" style="width: 18px; height: 18px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                Data Siswa
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
                                    class="form-control" 
                                    placeholder="Masukkan nama lengkap siswa"
                                    value="{{ old('nama') }}"
                                >
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
                                            class="form-control" 
                                            placeholder="Contoh: 165"
                                            value="{{ old('tb') }}"
                                            min="100"
                                            max="250"
                                        >
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
                                            class="form-control" 
                                            placeholder="Contoh: 55"
                                            value="{{ old('bb') }}"
                                            min="20"
                                            max="200"
                                            step="0.1"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i data-lucide="user-plus" style="width: 18px; height: 18px;"></i>
                        Daftar Akun
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

@push('scripts')
<script>
    function showChoice(role) {
        // Jika user memilih guru, redirect ke guru registration
        if (role === 'guru') {
            window.location.href = "{{ route('guru.create') }}";
            return;
        }

        // Hide all additional fields first
        document.getElementById('guru-fields').style.display = 'none';
        document.getElementById('siswa-fields').style.display = 'none';

        // Show fields based on selected role
        if (role === 'siswa') {
            document.getElementById('siswa-fields').style.display = 'block';
        }
    }

    // Show appropriate fields on page load if there's old input
    document.addEventListener('DOMContentLoaded', function() {
        const selectedRole = document.querySelector('input[name="role"]:checked');
        if (selectedRole) {
            showChoice(selectedRole.value);
        }
    });
</script>
@endpush
