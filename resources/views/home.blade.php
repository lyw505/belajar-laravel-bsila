@extends('layouts.app')

@section('title', 'Dashboard - Sistem Sekolah')

@section('content')
<!-- Welcome Header -->
<div class="row mb-6">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h1 style="margin-bottom: var(--spacing-2);">
                            <i data-lucide="wave" style="width: 32px; height: 32px; color: var(--primary-600); display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                            Selamat Datang, {{ session('admin_nama') }}!
                        </h1>
                        <p class="text-muted" style="margin: 0;">
                            <i data-lucide="shield-check" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Anda masuk sebagai <strong class="text-primary">{{ ucfirst(session('admin_role')) }}</strong>
                        </p>
                    </div>
                    <div class="d-flex gap-3">
                        @if(session('admin_role') === 'guru' || session('admin_role') === 'admin' || session('admin_role') === 'siswa')
                            <a href="{{ route('jadwal.index') }}" class="btn btn-outline">
                                <i data-lucide="calendar" style="width: 16px; height: 16px;"></i>
                                Lihat Jadwal
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Cards -->
<div class="row">
    {{-- Profil Guru --}}
    @if(session('admin_role') === 'guru' && $guru)
        <div class="col-12">
            <div class="card fade-in">
                <div class="card-header">
                    <h3 class="card-title">
                        <i data-lucide="user-check" style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                        Profil Guru
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="font-weight: 600; color: var(--gray-700); width: 200px;">
                                        <i data-lucide="user" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Nama
                                    </td>
                                    <td>{{ $guru->nama }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600; color: var(--gray-700);">
                                        <i data-lucide="book-open" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Mata Pelajaran
                                    </td>
                                    <td>
                                        <span class="badge" style="background: var(--primary-100); color: var(--primary-800); padding: var(--spacing-1) var(--spacing-3); border-radius: var(--radius-md); font-size: var(--font-size-xs);">
                                            {{ $guru->mapel }}
                                        </span>
                                    </td>
                                </tr>
                                @if(isset($guru->jenjang) && isset($guru->namakelas))
                                <tr>
                                    <td style="font-weight: 600; color: var(--gray-700);">
                                        <i data-lucide="school" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Wali Kelas
                                    </td>
                                    <td>
                                        <span class="badge" style="background: var(--success); color: white; padding: var(--spacing-1) var(--spacing-3); border-radius: var(--radius-md); font-size: var(--font-size-xs);">
                                            {{ $guru->jenjang }} {{ $guru->namakelas }}
                                        </span>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Profil Siswa --}}
    @if(session('admin_role') === 'siswa' && $siswa)
        <div class="col-12">
            <div class="card fade-in">
                <div class="card-header">
                    <h3 class="card-title">
                        <i data-lucide="user" style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                        Profil Siswa
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="font-weight: 600; color: var(--gray-700); width: 200px;">
                                        <i data-lucide="user" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Nama
                                    </td>
                                    <td>{{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600; color: var(--gray-700);">
                                        <i data-lucide="activity" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Tinggi Badan
                                    </td>
                                    <td>{{ $siswa->tb }} cm</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600; color: var(--gray-700);">
                                        <i data-lucide="scale" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Berat Badan
                                    </td>
                                    <td>{{ $siswa->bb }} kg</td>
                                </tr>
                                @if(isset($siswa->jenjang) && isset($siswa->namakelas))
                                <tr>
                                    <td style="font-weight: 600; color: var(--gray-700);">
                                        <i data-lucide="school" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Kelas
                                    </td>
                                    <td>
                                        <span class="badge" style="background: var(--primary-100); color: var(--primary-800); padding: var(--spacing-1) var(--spacing-3); border-radius: var(--radius-md); font-size: var(--font-size-xs);">
                                            {{ $siswa->jenjang }} {{ $siswa->namakelas }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600; color: var(--gray-700);">
                                        <i data-lucide="user-check" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Wali Kelas
                                    </td>
                                    <td>{{ $siswa->walas_nama }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Daftar Siswa untuk Admin atau Guru Walas --}}
@if(session('admin_role') === 'admin' || (session('admin_role') === 'guru' && $guru && isset($guru->idwalas)))
    <div class="row mt-6">
        <div class="col-12">
            <div class="card slide-up">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title">
                            <i data-lucide="users" style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                            Daftar Siswa
                        </h3>
                        @if(session('admin_role') === 'admin')
                            <a href="{{ route('siswa.create') }}" class="btn btn-primary">
                                <i data-lucide="user-plus" style="width: 16px; height: 16px;"></i>
                                Tambah Siswa
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <div class="d-flex align-items-center justify-content-between" style="padding: 16px; padding-bottom: 0;">
                            <label for="search" class="form-label mb-0" style="margin-right: 12px; font-weight: 500; color: var(--gray-700);">
                                Cari Siswa
                            </label>
                            <input
                                type="text"
                                id="search"
                                placeholder="Ketik nama..."
                                class="form-control"
                                style="max-width: 260px;"
                            >
                        </div>
                        <table class="table" id="tabel-siswa">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>
                                        <i data-lucide="user" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Nama Siswa
                                    </th>
                                    <th>
                                        <i data-lucide="activity" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Tinggi (cm)
                                    </th>
                                    <th>
                                        <i data-lucide="scale" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Berat (kg)
                                    </th>
                                    @if(session('admin_role') === 'admin')
                                        <th style="width: 120px;">
                                            <i data-lucide="settings" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                            Aksi
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
$(document).ready(function(){
    function renderTable(data) {
        let rows = '';
        if (data.length === 0) {
            const colspan = "{{ session('admin_role') === 'admin' ? '5' : '4' }}";
            rows = `<tr><td colspan="${colspan}" class="text-center" style="padding: var(--spacing-8); color: var(--gray-500);"><i data-lucide="users" style="width: 48px; height: 48px; display: block; margin: 0 auto var(--spacing-4) auto; opacity: 0.5;"></i>Tidak ada data ditemukan</td></tr>`;
        } else {
            data.forEach((s, index) => {
                let actions = '';
                @if(session('admin_role') === 'admin')
                actions = `
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/siswa/${s.idsiswa}/edit" class="btn btn-sm btn-outline" title="Edit Siswa">
                                <i data-lucide="edit" style="width: 14px; height: 14px;"></i>
                            </a>
                            <a href="/siswa/${s.idsiswa}/delete" 
                               class="btn btn-sm btn-danger" 
                               title="Hapus Siswa"
                               onclick="return confirm('Yakin ingin menghapus siswa ${s.nama}?')">
                                <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                            </a>
                        </div>
                    </td>
                `;
                @endif
                rows += `
                    <tr>
                        <td style="font-weight: 500; color: var(--gray-600);">${index + 1}</td>
                        <td style="font-weight: 500;">${s.nama}</td>
                        <td>${s.tb}</td>
                        <td>${s.bb}</td>
                        ${actions}
                    </tr>
                `;
            });
        }
        $('#tabel-siswa tbody').html(rows);
        lucide.createIcons();
    }

    function loadSiswa() {
        $.ajax({
            url: "{{ route('siswa.data') }}",
            method: "GET",
            success: function(response) {
                renderTable(response);
            },
            error: function() {
                alert('Gagal memuat data siswa.');
            }
        });
    }

    function searchSiswa(keyword) {
        $.ajax({
            url: "{{ route('siswa.search') }}",
            method: "GET",
            data: { q: keyword },
            success: function(response) {
                renderTable(response);
            },
            error: function() {
                console.error('Gagal mencari data siswa.');
            }
        });
    }

    loadSiswa();

    $('#search').on('keyup', function() {
        const keyword = $(this).val().trim();
        if (keyword.length > 0) {
            searchSiswa(keyword);
        } else {
            loadSiswa();
        }
    });
});
</script>
@endsection