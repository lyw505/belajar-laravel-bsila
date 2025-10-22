<footer style="background: var(--gray-50); border-top: 1px solid var(--gray-200); margin-top: auto;">
    <div class="container">
        <div class="row" style="padding: var(--spacing-8) 0 var(--spacing-6) 0;">
            <div class="col-4">
                <div style="display: flex; align-items: center; gap: var(--spacing-3); margin-bottom: var(--spacing-4);">
                    <div style="width: 32px; height: 32px; background: var(--primary-600); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                        <i data-lucide="graduation-cap" style="width: 18px; height: 18px; color: white;"></i>
                    </div>
                    <span style="font-weight: 600; color: var(--gray-800); font-size: var(--font-size-lg);">Sistem Sekolah</span>
                </div>
                <p style="color: var(--gray-600); font-size: var(--font-size-sm); margin: 0; line-height: 1.6; max-width: 280px;">
                    Platform digital terpadu untuk mengelola data siswa, guru, dan jadwal pembelajaran dengan mudah dan efisien.
                </p>
            </div>
            <div class="col-4">
                <h6 style="color: var(--gray-800); margin-bottom: var(--spacing-4); font-weight: 600; font-size: var(--font-size-sm);">Fitur Utama</h6>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: var(--spacing-3);">
                        <a href="#" style="color: var(--gray-600); font-size: var(--font-size-sm); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-2); transition: color var(--transition-fast);" onmouseover="this.style.color='var(--primary-600)'" onmouseout="this.style.color='var(--gray-600)'">
                            <i data-lucide="users" style="width: 16px; height: 16px;"></i>
                            Manajemen Siswa
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-3);">
                        <a href="#" style="color: var(--gray-600); font-size: var(--font-size-sm); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-2); transition: color var(--transition-fast);" onmouseover="this.style.color='var(--primary-600)'" onmouseout="this.style.color='var(--gray-600)'">
                            <i data-lucide="user-check" style="width: 16px; height: 16px;"></i>
                            Data Guru
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-3);">
                        <a href="#" style="color: var(--gray-600); font-size: var(--font-size-sm); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-2); transition: color var(--transition-fast);" onmouseover="this.style.color='var(--primary-600)'" onmouseout="this.style.color='var(--gray-600)'">
                            <i data-lucide="calendar" style="width: 16px; height: 16px;"></i>
                            Jadwal Pelajaran
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-4">
                <h6 style="color: var(--gray-800); margin-bottom: var(--spacing-4); font-weight: 600; font-size: var(--font-size-sm);">Akses Cepat</h6>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    @if(session()->has('admin_id'))
                        <li style="margin-bottom: var(--spacing-3);">
                            <a href="{{ route('home') }}" style="color: var(--gray-600); font-size: var(--font-size-sm); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-2); transition: color var(--transition-fast);" onmouseover="this.style.color='var(--primary-600)'" onmouseout="this.style.color='var(--gray-600)'">
                                <i data-lucide="home" style="width: 16px; height: 16px;"></i>
                                Dashboard
                            </a>
                        </li>
                        @if(session('admin_role') === 'guru' || session('admin_role') === 'admin')
                            <li style="margin-bottom: var(--spacing-3);">
                                <a href="{{ route('jadwal.index') }}" style="color: var(--gray-600); font-size: var(--font-size-sm); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-2); transition: color var(--transition-fast);" onmouseover="this.style.color='var(--primary-600)'" onmouseout="this.style.color='var(--gray-600)'">
                                    <i data-lucide="calendar" style="width: 16px; height: 16px;"></i>
                                    Lihat Jadwal
                                </a>
                            </li>
                        @endif
                    @else
                        <li style="margin-bottom: var(--spacing-3);">
                            <a href="{{ route('login') }}" style="color: var(--gray-600); font-size: var(--font-size-sm); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-2); transition: color var(--transition-fast);" onmouseover="this.style.color='var(--primary-600)'" onmouseout="this.style.color='var(--gray-600)'">
                                <i data-lucide="log-in" style="width: 16px; height: 16px;"></i>
                                Login
                            </a>
                        </li>
                        <li style="margin-bottom: var(--spacing-3);">
                            <a href="{{ route('register.form') }}" style="color: var(--gray-600); font-size: var(--font-size-sm); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-2); transition: color var(--transition-fast);" onmouseover="this.style.color='var(--primary-600)'" onmouseout="this.style.color='var(--gray-600)'">
                                <i data-lucide="user-plus" style="width: 16px; height: 16px;"></i>
                                Daftar Akun
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        
        <div style="border-top: 1px solid var(--gray-200); padding: var(--spacing-5) 0; text-align: center;">
            <div style="display: flex; align-items: center; justify-content: center; gap: var(--spacing-2); margin-bottom: var(--spacing-2);">
                <span style="color: var(--gray-500); font-size: var(--font-size-sm);">
                    © {{ date('Y') }} Sistem Manajemen Sekolah
                </span>
            </div>
            <p style="color: var(--gray-400); font-size: var(--font-size-xs); margin: 0; display: flex; align-items: center; justify-content: center; gap: var(--spacing-1);">
                Dibuat dengan 
                <i data-lucide="heart" style="width: 12px; height: 12px; color: var(--error);"></i>
                menggunakan Laravel {{ app()->version() }}
            </p>
        </div>
    </div>
</footer>
