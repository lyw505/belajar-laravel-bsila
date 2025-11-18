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
                <form id="filterForm">
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
                                    <button type="button" id="resetBtn" class="btn btn-outline" style="padding: var(--spacing-3);" title="Reset">
                                        <i data-lucide="rotate-ccw" style="width: 18px; height: 18px;"></i>
                                    </button>
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
                                        <i data-lucide="book-open" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 6px;"></i>
                                        Mata Pelajaran
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
                        <tbody id="jadwal-tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    const role = "{{ session('admin_role') }}";
    const adminView = "{{ $adminView ?? request('view', 'guru') }}";

    function renderTable(data) {
        const role = "{{ session('admin_role') }}";
        const adminView = $('#view').val() || "{{ $adminView ?? request('view', 'guru') }}";
        let colspan = 5;

        if (role === 'admin' && adminView === 'guru') {
            colspan = 6;
        }

        let rows = '';
        if (data.length === 0) {
            rows = `<tr>
                <td colspan="${colspan}" class="text-center" style="padding: var(--spacing-8); color: var(--gray-500);">
                    <i data-lucide="calendar-x" style="width: 48px; height: 48px; display: block; margin: 0 auto var(--spacing-4) auto; opacity: 0.5;"></i>
                    <div>Belum ada jadwal pelajaran</div>
                </td>
            </tr>`;
        } else {
            data.forEach((jadwal, index) => {
                const hari = jadwal.hari ? `<span class="badge badge-primary">${jadwal.hari}</span>` : '-';
                const guruNama = jadwal.guru ? jadwal.guru.nama : '-';
                const mulai = jadwal.mulai || '-';
                const selesai = jadwal.selesai || '-';

                let extraColumn = '';
                if (role === 'admin' && adminView === 'guru') {
                    const kelasInfo = jadwal.walas ? (jadwal.walas.jenjang + ' ' + jadwal.walas.namakelas) : '-';
                    const kelasDisplay = kelasInfo !== '-' ? `<span class="badge badge-success">${kelasInfo}</span>` : '<span class="text-muted">-</span>';
                    const mapel = jadwal.guru ? jadwal.guru.mapel : '-';
                    const mapelDisplay = mapel && mapel !== '-' ? `<span class="badge badge-warning">${mapel}</span>` : '<span class="text-muted">-</span>';
                    extraColumn = `
                        <td>
                            ${kelasDisplay}
                        </td>
                        <td>
                            ${mapelDisplay}
                        </td>
                    `;
                } else if (role === 'admin' && adminView === 'siswa') {
                    const mapel = jadwal.guru ? jadwal.guru.mapel : '-';
                    const mapelDisplay = mapel && mapel !== '-' ? `<span class="badge badge-warning">${mapel}</span>` : '<span class="text-muted">-</span>';
                    extraColumn = `
                        <td>
                            ${mapelDisplay}
                        </td>
                    `;
                } else if (role === 'siswa') {
                    const mapel = jadwal.guru ? jadwal.guru.mapel : '-';
                    const mapelDisplay = mapel && mapel !== '-' ? `<span class="badge badge-warning">${mapel}</span>` : '<span class="text-muted">-</span>';
                    extraColumn = `
                        <td>
                            ${mapelDisplay}
                        </td>
                    `;
                } else {
                    const kelasInfo = jadwal.walas ? (jadwal.walas.jenjang + ' ' + jadwal.walas.namakelas) : '-';
                    const kelasDisplay = kelasInfo !== '-' ? `<span class="badge badge-success">${kelasInfo}</span>` : '<span class="text-muted">-</span>';
                    extraColumn = `
                        <td>
                            ${kelasDisplay}
                        </td>
                    `;
                }

                rows += `
                    <tr>
                        <td style="font-weight: 500; color: var(--gray-600);">${index + 1}</td>
                        <td>
                            ${hari}
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: var(--spacing-2);">
                                <span style="font-weight: 500;">${mulai}</span>
                                <i data-lucide="arrow-right" style="width: 12px; height: 12px; color: var(--gray-400);"></i>
                                <span style="font-weight: 500;">${selesai}</span>
                            </div>
                        </td>
                        <td style="font-weight: 500;">
                            ${guruNama}
                        </td>
                        ${extraColumn}
                    </tr>
                `;
            });
        }
        $('#jadwal-tbody').html(rows);
        lucide.createIcons();
    }

    function loadJadwal() {
        const search = $('#search').val();
        const hari = $('#filter-hari').val();
        const view = $('#view').val() || "{{ $adminView ?? request('view', 'guru') }}";

        $.ajax({
            url: "{{ route('jadwal.search') }}",
            method: "GET",
            data: {
                search: search,
                hari: hari,
                view: view
            },
            success: function(response) {
                renderTable(response.jadwals);
            },
            error: function() {
                alert('Gagal memuat data jadwal.');
            }
        });
    }

    // Load jadwal awal
    loadJadwal();

    // Event listener untuk search
    $('#search').on('keyup', function() {
        loadJadwal();
    });

    // Event listener untuk filter hari
    $('#filter-hari').on('change', function() {
        loadJadwal();
    });

    // Event listener untuk view mode
    $('#view').on('change', function() {
        loadJadwal();
    });

    // Event listener untuk reset button
    $('#resetBtn').on('click', function(e) {
        e.preventDefault();
        $('#search').val('');
        $('#filter-hari').val('');
        $('#view').val('guru');
        loadJadwal();
    });
});
</script>
@endsection
