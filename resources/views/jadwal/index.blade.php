@extends('layouts.app')

@section('title', 'Jadwal Pelajaran - Sistem Sekolah')

@section('content')
<!-- Header Section -->
<div class="row mb-6">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h1 style="margin-bottom: var(--spacing-2);">
                            <i data-lucide="calendar" style="width: 32px; height: 32px; color: var(--primary-600); display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                            Jadwal Pelajaran
                        </h1>
                        <p class="text-muted" style="margin: 0;">
                            <i data-lucide="shield-check" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                            Anda masuk sebagai <strong class="text-primary">{{ ucfirst(session('admin_role') ?? '-') }}</strong>
                            @if(session('admin_role') === 'guru' || session('admin_role') === 'siswa')
                                - {{ session('admin_nama') ?? '-' }}
                            @endif
                        </p>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="row mb-6">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i data-lucide="search" style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                    Filter & Pencarian
                </h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('jadwal.index') }}">
                    <div class="row" style="gap: var(--spacing-4);">
                        <!-- Search Input -->
                        <div class="col-4" style="padding: 0 var(--spacing-2);">
                            <div class="form-group">
                                <label for="search" class="form-label">
                                    Cari Jadwal
                                </label>
                                <input 
                                    type="text" 
                                    id="search"
                                    name="search" 
                                    class="form-control" 
                                    placeholder="Cari guru, mapel, atau kelas..."
                                    value="{{ request('search') }}"
                                >
                            </div>
                        </div>

                        @if(session('admin_role') === 'admin')
                        <!-- View Mode for Admin -->
                        <div class="col-3" style="padding: 0 var(--spacing-2);">
                            <div class="form-group">
                                <label for="view" class="form-label">
                                    Tampilan
                                </label>
                                <select id="view" name="view" class="form-control form-select">
                                    <option value="guru" {{ ($adminView ?? request('view','guru')) === 'guru' ? 'selected' : '' }}>Role Guru</option>
                                    <option value="siswa" {{ ($adminView ?? request('view')) === 'siswa' ? 'selected' : '' }}>Role Siswa</option>
                                </select>
                            </div>
                        </div>
                        @endif

                        <!-- Day Filter with Action Buttons -->
                        <div class="{{ session('admin_role') === 'admin' ? 'col-3' : 'col-6' }}" style="padding: 0 var(--spacing-2);">
                            <div class="form-group">
                                <label for="filter-hari" class="form-label">
                                    Hari
                                </label>
                                <div class="d-flex gap-2">
                                    <select id="filter-hari" name="hari" class="form-control form-select" style="flex: 1;">
                                        <option value="">Semua Hari</option>
                                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                                            <option value="{{ $h }}" {{ request('hari') === $h ? 'selected' : '' }}>{{ $h }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary" style="padding: var(--spacing-3);" title="Cari">
                                        <i data-lucide="search" style="width: 18px; height: 18px;"></i>
                                    </button>
                                    <a href="{{ route('jadwal.index') }}" class="btn btn-outline" style="padding: var(--spacing-3);" title="Reset">
                                        <i data-lucide="rotate-ccw" style="width: 18px; height: 18px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Schedule Table -->
<div class="row">
    <div class="col-12">
        <div class="card slide-up">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        <i data-lucide="clock" style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                        Daftar Jadwal Pelajaran
                    </h3>
                    <div class="text-muted" style="font-size: var(--font-size-sm);">
                        Total: <strong>{{ count($jadwals) }}</strong> jadwal
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">
                                    <i data-lucide="hash" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                    No
                                </th>
                                <th>
                                    <i data-lucide="calendar-days" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                    Hari
                                </th>
                                <th>
                                    <i data-lucide="clock" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                    Waktu
                                </th>
                                <th>
                                    <i data-lucide="user-check" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                    Guru
                                </th>
                                @php($role = session('admin_role'))
                                @php($adminViewMode = $adminView ?? request('view'))
                                @if($role === 'admin' && $adminViewMode === 'guru')
                                    <th>
                                        <i data-lucide="school" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Kelas
                                    </th>
                                    <th>
                                        <i data-lucide="users" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Siswa
                                    </th>
                                @elseif($role === 'admin' && $adminViewMode === 'siswa')
                                    <th>
                                        <i data-lucide="book-open" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Mata Pelajaran
                                    </th>
                                @else
                                    <th>
                                        <i data-lucide="{{ $role === 'siswa' ? 'book-open' : 'school' }}" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        {{ $role === 'siswa' ? 'Mata Pelajaran' : 'Kelas' }}
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwals as $i => $jadwal)
                                <tr>
                                    <td style="font-weight: 500; color: var(--gray-600);">{{ $i + 1 }}</td>
                                    <td>
                                        <span class="badge badge-primary">{{ $jadwal->hari }}</span>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: var(--spacing-2);">
                                            <span style="font-weight: 500;">{{ $jadwal->mulai }}</span>
                                            <i data-lucide="arrow-right" style="width: 12px; height: 12px; color: var(--gray-400);"></i>
                                            <span style="font-weight: 500;">{{ $jadwal->selesai }}</span>
                                        </div>
                                    </td>
                                    <td style="font-weight: 500;">
                                        {{ session('admin_role') === 'guru' ? (session('admin_nama') ?? (optional($jadwal->guru)->nama ?? '-')) : (optional($jadwal->guru)->nama ?? '-') }}
                                    </td>
                                    @if($role === 'admin' && $adminViewMode === 'guru')
                                        <td>
                                            @php($walas = optional($jadwal->walas))
                                            @if(trim(($walas->jenjang ?? '') . ' ' . ($walas->namakelas ?? '')))
                                                <span class="badge badge-success">{{ trim(($walas->jenjang ?? '') . ' ' . ($walas->namakelas ?? '')) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php($murids = collect(optional($jadwal->walas)->kelas ?? [])->map(function($k){ return optional($k->siswa)->nama; })->filter()->values())
                                            @if($murids->isNotEmpty())
                                                <div style="display: flex; align-items: center; gap: var(--spacing-2);">
                                                    <span class="badge badge-secondary">{{ $murids->count() }} siswa</span>
                                                    <span class="text-muted" style="font-size: var(--font-size-xs);" title="{{ $murids->join(', ') }}">
                                                        {{ Str::limit($murids->join(', '), 30) }}
                                                    </span>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    @elseif($role === 'admin' && $adminViewMode === 'siswa')
                                        <td>
                                            @if(data_get($jadwal, 'guru.mapel'))
                                                <span class="badge badge-warning">{{ data_get($jadwal, 'guru.mapel') }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                            @if($role === 'siswa')
                                                @if(data_get($jadwal, 'guru.mapel'))
                                                    <span class="badge badge-warning">{{ data_get($jadwal, 'guru.mapel') }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            @else
                                                @php($walas = optional($jadwal->walas))
                                                @if(trim(($walas->jenjang ?? '') . ' ' . ($walas->namakelas ?? '')))
                                                    <span class="badge badge-success">{{ trim(($walas->jenjang ?? '') . ' ' . ($walas->namakelas ?? '')) }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                @php($colspan = ($role === 'admin' && $adminViewMode === 'guru') ? 6 : 5)
                                <tr>
                                    <td colspan="{{ $colspan }}" class="text-center" style="padding: var(--spacing-8); color: var(--gray-500);">
                                        <i data-lucide="calendar-x" style="width: 48px; height: 48px; display: block; margin: 0 auto var(--spacing-4) auto; opacity: 0.5;"></i>
                                        <div>Belum ada jadwal pelajaran</div>
                                        @if(request()->hasAny(['search', 'hari', 'view']))
                                            <div style="margin-top: var(--spacing-2);">
                                                <a href="{{ route('jadwal.index') }}" class="btn btn-outline btn-sm">
                                                    <i data-lucide="refresh-cw" style="width: 14px; height: 14px;"></i>
                                                    Reset Filter
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
