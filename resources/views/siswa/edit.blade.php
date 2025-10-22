@extends('layouts.app')

@section('title', 'Edit Siswa - Sistem Sekolah')

@section('content')
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card slide-up">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="card-title">
                            <i data-lucide="edit" style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                            Edit Data Siswa
                        </h3>
                        <p class="text-muted" style="margin: 0; font-size: var(--font-size-sm);">
                            Perbarui informasi siswa <strong>{{ $siswa->nama }}</strong>
                        </p>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
                        Kembali
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('siswa.update', $siswa->idsiswa) }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Student Information -->
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
                                value="{{ old('nama', $siswa->nama) }}"
                                required
                                autofocus
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
                                        value="{{ old('tb', $siswa->tb) }}"
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
                                        value="{{ old('bb', $siswa->bb) }}"
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
                            Perbarui Data Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
