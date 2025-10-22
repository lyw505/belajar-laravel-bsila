<nav class="navbar">
    <div class="navbar-container">
        <!-- Brand -->
        <a href="{{ route('landing') }}" class="navbar-brand">
            <i data-lucide="graduation-cap" style="width: 24px; height: 24px; display: inline-block; vertical-align: middle; margin-right: 8px;"></i>
            Sistem Sekolah
        </a>

        <!-- User Info & Actions -->
        <div class="d-flex align-items-center gap-4">
            @if(session()->has('admin_id'))
                <!-- User Info -->
                <span class="text-muted" style="font-size: 14px;">
                    <i data-lucide="user" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i>
                    {{ session('admin_nama') }} 
                    <span class="text-primary">({{ ucfirst(session('admin_role')) }})</span>
                </span>
                <!-- Logout Button -->
                <a href="{{ route('logout') }}" class="btn btn-outline btn-sm">
                    <i data-lucide="log-out" style="width: 14px; height: 14px;"></i>
                    Logout
                </a>
            @else
                <!-- Guest Actions -->
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                    <i data-lucide="log-in" style="width: 14px; height: 14px;"></i>
                    Login
                </a>
                <a href="{{ route('register.form') }}" class="btn btn-outline btn-sm">
                    <i data-lucide="user-plus" style="width: 14px; height: 14px;"></i>
                    Daftar
                </a>
            @endif
        </div>
    </div>
</nav>
