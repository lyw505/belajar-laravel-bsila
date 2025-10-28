@extends('layouts.app')

@section('title', $datakonten->judul . ' - Detail Artikel')

@section('content')
<!-- Back Navigation -->
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ url('/') }}" class="btn btn-outline">
            <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
            Kembali ke Beranda
        </a>
    </div>
</div>

<!-- Article Header -->
<div class="row mb-6">
    <div class="col-12">
        <div class="card fade-in">
            <div class="card-body" style="padding: var(--spacing-8);">
                <div class="d-flex align-items-start" style="gap: var(--spacing-4);">
                    <div style="background: linear-gradient(135deg, var(--primary-500), var(--primary-700)); padding: var(--spacing-4); border-radius: var(--radius-lg); min-width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                        <i data-lucide="file-text" style="width: 32px; height: 32px; color: white;"></i>
                    </div>
                    <div style="flex: 1;">
                        <h1 style="font-size: var(--font-size-3xl); font-weight: 700; color: var(--gray-900); margin-bottom: var(--spacing-3); line-height: 1.2;">
                            {{ $datakonten->judul }}
                        </h1>
                        <div class="d-flex align-items-center" style="gap: var(--spacing-4); color: var(--gray-600);">
                            <div class="d-flex align-items-center" style="gap: var(--spacing-2);">
                                <i data-lucide="hash" style="width: 16px; height: 16px;"></i>
                                <span style="font-size: var(--font-size-sm);">ID: {{ $datakonten->id }}</span>
                            </div>
                            <div class="d-flex align-items-center" style="gap: var(--spacing-2);">
                                <i data-lucide="calendar" style="width: 16px; height: 16px;"></i>
                                <span style="font-size: var(--font-size-sm);">{{ $datakonten->created_at ? $datakonten->created_at->format('d M Y') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Article Summary -->
<div class="row mb-6">
    <div class="col-12">
        <div class="card slide-up">
            <div class="card-header">
                <h3 class="card-title">
                    <i data-lucide="align-left" style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                    Ringkasan
                </h3>
            </div>
            <div class="card-body">
                <div style="font-size: var(--font-size-base); line-height: 1.8; color: var(--gray-700);">
                    {{ $datakonten->isi }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Article Content -->
<div class="row">
    <div class="col-12">
        <div class="card slide-up">
            <div class="card-header">
                <h3 class="card-title">
                    <i data-lucide="book-open" style="width: 20px; height: 20px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
                    Detail Lengkap
                </h3>
            </div>
            <div class="card-body">
                <div style="font-size: var(--font-size-base); line-height: 1.8; color: var(--gray-700); white-space: pre-wrap; word-wrap: break-word;">
                    {{ $datakonten->detil }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row mt-6">
    <div class="col-12">
        <div class="d-flex justify-content-center" style="gap: var(--spacing-3);">
            <a href="{{ url('/') }}" class="btn btn-primary">
                <i data-lucide="home" style="width: 16px; height: 16px;"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection