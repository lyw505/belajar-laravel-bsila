@extends('layouts.app')

@section('title', 'Tambah Jadwal KBM')

@section('content')
<div class="row mb-6">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="mb-2">
                        <i data-lucide="plus-square" style="width: 32px; height: 32px; color: var(--primary-600); display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                        Tambah Jadwal KBM
                    </h1>
                    <p class="text-muted mb-0">
                        Hanya admin yang dapat menambahkan jadwal KBM.
                    </p>
                </div>
                <div>
                    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">
                        <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
                        Kembali ke Jadwal
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('jadwal.store') }}" method="POST">
                    @csrf

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idguru" class="form-label">Guru</label>
                                <select name="idguru" id="idguru" class="form-control form-select" required>
                                    <option value="">Pilih Guru</option>
                                    @foreach($gurus as $guru)
                                        <option value="{{ $guru->idguru }}" {{ old('idguru') == $guru->idguru ? 'selected' : '' }}>
                                            {{ $guru->nama }} ({{ $guru->mapel }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idwalas" class="form-label">Wali Kelas</label>
                                <select name="idwalas" id="idwalas" class="form-control form-select" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($walas as $w)
                                        <option value="{{ $w->idwalas }}" {{ old('idwalas') == $w->idwalas ? 'selected' : '' }}>
                                            {{ $w->jenjang }} {{ $w->namakelas }} ({{ $w->tahunajaran }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row gy-4 mt-1">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hari" class="form-label">Hari</label>
                                <select name="hari" id="hari" class="form-control form-select" required>
                                    <option value="">Pilih Hari</option>
                                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                                        <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mulai" class="form-label">Jam Mulai</label>
                                <input type="time" name="mulai" id="mulai" class="form-control" value="{{ old('mulai') }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selesai" class="form-label">Jam Selesai</label>
                                <input type="time" name="selesai" id="selesai" class="form-control" value="{{ old('selesai') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 d-flex justify-content-end gap-3">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-outline">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
