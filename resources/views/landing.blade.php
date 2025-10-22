@extends('layouts.app')

@section('title', 'Selamat Datang - Sistem Manajemen Sekolah')

@section('content')
<!-- Hero Section -->
<div class="row" style="margin-bottom: var(--spacing-12); min-height: 80vh; display: flex; align-items: center;">
    <div class="col-12">
        <div class="text-center" style="padding: var(--spacing-12) var(--spacing-6);">
            <div style="margin-bottom: var(--spacing-6);">
                <div style="width: 100px; height: 100px; background: var(--primary-50); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; box-shadow: var(--shadow-lg);">
                    <i data-lucide="graduation-cap" style="width: 50px; height: 50px; color: var(--primary-600);"></i>
                </div>
            </div>
            <h1 style="color: var(--primary-600); font-size: 3rem; font-weight: 700; margin-bottom: var(--spacing-5); line-height: 1.2;">
                Sistem Manajemen Sekolah
            </h1>
            <p style="color: var(--gray-600); font-size: var(--font-size-xl); margin-bottom: var(--spacing-8); max-width: 700px; margin-left: auto; margin-right: auto; line-height: 1.6;">
                Platform digital terpadu untuk mengelola data siswa, guru, dan jadwal pembelajaran dengan mudah, efisien, dan modern.
            </p>
            <div class="d-flex justify-content-center gap-4" style="flex-wrap: wrap;">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg" style="padding: var(--spacing-4) var(--spacing-8); font-weight: 600; font-size: var(--font-size-lg); transition: all var(--transition-normal);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 30px rgba(37, 99, 235, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)'">
                    <i data-lucide="log-in" style="width: 20px; height: 20px;"></i>
                    Masuk ke Sistem
                </a>
                <a href="{{ route('register.form') }}" class="btn btn-outline btn-lg" style="padding: var(--spacing-4) var(--spacing-8); font-weight: 600; font-size: var(--font-size-lg); transition: all var(--transition-normal);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 30px rgba(37, 99, 235, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'">
                    <i data-lucide="user-plus" style="width: 20px; height: 20px;"></i>
                    Daftar Akun Baru
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="row mb-8">
    <div class="col-12">
        <div class="text-center mb-8">
            <h2 style="color: var(--gray-800); margin-bottom: var(--spacing-3);">Fitur Unggulan</h2>
            <p class="text-muted" style="font-size: var(--font-size-lg); max-width: 500px; margin: 0 auto;">
                Kelola seluruh aspek sekolah dalam satu platform yang terintegrasi
            </p>
        </div>
    </div>
</div>

<div class="row" style="margin-left: var(--spacing-4); margin-right: var(--spacing-4); margin-bottom: 120px;">
    <div class="col-4" style="padding-left: var(--spacing-3); padding-right: var(--spacing-3);">
        <div class="card text-center fade-in" style="height: 100%; transition: all var(--transition-normal); border: 1px solid var(--gray-200);" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='var(--shadow-xl)'; this.style.borderColor='var(--primary-200)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'; this.style.borderColor='var(--gray-200)'">
            <div class="card-body" style="padding: var(--spacing-5);">
                <div style="margin-bottom: var(--spacing-4);">
                    <div style="width: 70px; height: 70px; background: var(--primary-50); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; transition: all var(--transition-normal);">
                        <i data-lucide="users" style="width: 35px; height: 35px; color: var(--primary-600);"></i>
                    </div>
                </div>
                <h4 style="color: var(--gray-800); margin-bottom: var(--spacing-3); font-weight: 600; font-size: var(--font-size-lg);">Manajemen Siswa</h4>
                <p class="text-muted" style="font-size: var(--font-size-sm); line-height: 1.6;">
                    Kelola data siswa, informasi pribadi, dan riwayat akademik dengan sistem yang terorganisir.
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-4" style="padding-left: var(--spacing-3); padding-right: var(--spacing-3);">
        <div class="card text-center fade-in" style="animation-delay: 0.1s; height: 100%; transition: all var(--transition-normal); border: 1px solid var(--gray-200);" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='var(--shadow-xl)'; this.style.borderColor='rgba(16, 185, 129, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'; this.style.borderColor='var(--gray-200)'">
            <div class="card-body" style="padding: var(--spacing-5);">
                <div style="margin-bottom: var(--spacing-4);">
                    <div style="width: 70px; height: 70px; background: rgba(16, 185, 129, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; transition: all var(--transition-normal);">
                        <i data-lucide="user-check" style="width: 35px; height: 35px; color: var(--success);"></i>
                    </div>
                </div>
                <h4 style="color: var(--gray-800); margin-bottom: var(--spacing-3); font-weight: 600; font-size: var(--font-size-lg);">Data Guru</h4>
                <p class="text-muted" style="font-size: var(--font-size-sm); line-height: 1.6;">
                    Atur profil guru, mata pelajaran yang diampu, dan penugasan wali kelas dalam satu dashboard.
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-4" style="padding-left: var(--spacing-3); padding-right: var(--spacing-3);">
        <div class="card text-center fade-in" style="animation-delay: 0.2s; height: 100%; transition: all var(--transition-normal); border: 1px solid var(--gray-200);" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='var(--shadow-xl)'; this.style.borderColor='rgba(245, 158, 11, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'; this.style.borderColor='var(--gray-200)'">
            <div class="card-body" style="padding: var(--spacing-5);">
                <div style="margin-bottom: var(--spacing-4);">
                    <div style="width: 70px; height: 70px; background: rgba(245, 158, 11, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; transition: all var(--transition-normal);">
                        <i data-lucide="calendar" style="width: 35px; height: 35px; color: var(--warning);"></i>
                    </div>
                </div>
                <h4 style="color: var(--gray-800); margin-bottom: var(--spacing-3); font-weight: 600; font-size: var(--font-size-lg);">Jadwal Pelajaran</h4>
                <p class="text-muted" style="font-size: var(--font-size-sm); line-height: 1.6;">
                    Buat dan kelola jadwal KBM dengan tampilan yang jelas dan mudah dipahami.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Articles Section -->
@if(isset($konten) && count($konten) > 0)
<div class="row mb-8">
    <div class="col-12">
        <div class="text-center mb-8">
            <h2 style="color: var(--gray-800); margin-bottom: var(--spacing-3);">Artikel & Berita Terbaru</h2>
            <p class="text-muted" style="font-size: var(--font-size-lg); max-width: 500px; margin: 0 auto;">
                Dapatkan informasi terkini seputar pendidikan dan pengumuman penting
            </p>
        </div>
    </div>
</div>

<div class="row mb-10" style="margin-left: var(--spacing-2); margin-right: var(--spacing-2);">
    @foreach($konten as $data)
    <div class="col-6 mb-6" style="padding-left: var(--spacing-4); padding-right: var(--spacing-4);">
        <div class="card" style="height: 100%; border: 1px solid var(--gray-200); transition: all var(--transition-normal);" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-lg)'; this.style.borderColor='var(--primary-200)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)'; this.style.borderColor='var(--gray-200)'">
            <div class="card-body" style="padding: var(--spacing-6); display: flex; flex-direction: column; height: 100%;">
                <div style="margin-bottom: var(--spacing-4);">
                    <div style="width: 48px; height: 48px; background: var(--primary-50); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center;">
                        <i data-lucide="file-text" style="width: 24px; height: 24px; color: var(--primary-600);"></i>
                    </div>
                </div>
                <h5 style="color: var(--gray-800); margin-bottom: var(--spacing-3); font-weight: 600; line-height: 1.4;">
                    <a href="{{ route('detil', $data->id) }}" style="text-decoration: none; color: inherit; transition: color var(--transition-fast);" onmouseover="this.style.color='var(--primary-600)'" onmouseout="this.style.color='inherit'">
                        {{ $data->judul }}
                    </a>
                </h5>
                <p class="text-muted" style="font-size: var(--font-size-sm); line-height: 1.6; margin-bottom: var(--spacing-4); flex-grow: 1;">
                    {{ Str::limit($data->isi, 100) }}
                </p>
                <div style="margin-top: auto;">
                    <a href="{{ route('detil', $data->id) }}" class="btn btn-outline btn-sm" style="transition: all var(--transition-fast);">
                        <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection