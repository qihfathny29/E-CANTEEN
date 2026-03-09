<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <script>(function(){var t=localStorage.getItem('ecanteen-theme')||'dark';document.documentElement.setAttribute('data-theme',t);})();</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — E-Canteen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

        :root {
            --red:#c0392b; --red-h:#e74c3c;
            --font-d:'Sora',sans-serif; --font-b:'DM Sans',sans-serif;
            --bg-body:#0f0f0f; --bg-card:#1a1a1a; --bg-card2:#262626;
            --text:#ffffff; --text-sub:rgba(255,255,255,.68);
            --text-muted:rgba(255,255,255,.40);
            --border:rgba(255,255,255,.07); --border-md:rgba(255,255,255,.14);
            --nav-bg:rgba(15,15,15,.96);
            --sidebar-w:225px;
            --input-bg:rgba(255,255,255,.06); --input-bg-f:rgba(255,255,255,.09);
        }
        html[data-theme="light"] {
            --bg-body:#f0f0f0; --bg-card:#ffffff; --bg-card2:#e6e6e6;
            --text:#0f0f0f; --text-sub:rgba(15,15,15,.65);
            --text-muted:rgba(15,15,15,.42);
            --border:rgba(0,0,0,.08); --border-md:rgba(0,0,0,.15);
            --nav-bg:rgba(240,240,240,.97);
            --input-bg:rgba(0,0,0,.04); --input-bg-f:rgba(0,0,0,.07);
        }
        html,body{min-height:100vh;background:var(--bg-body);color:var(--text);font-family:var(--font-b);transition:background .3s,color .3s;scrollbar-width:none;-ms-overflow-style:none;}
        html::-webkit-scrollbar,body::-webkit-scrollbar{display:none;}

        /* ════ LAYOUT ════ */
        .app-layout{display:flex;min-height:100vh;}

        /* ════ SIDEBAR ════ */
        .sidebar{width:var(--sidebar-w);min-height:100vh;position:fixed;top:0;left:0;background:var(--bg-card);border-right:1px solid var(--border);display:flex;flex-direction:column;z-index:200;transition:background .3s,border-color .3s;}

        .sidebar-logo{display:flex;align-items:center;gap:.75rem;padding:1.35rem 1.1rem;border-bottom:1px solid var(--border);text-decoration:none;flex-shrink:0;}
        .sidebar-logo-icon{background:var(--red);width:34px;height:34px;border-radius:.5rem;display:flex;align-items:center;justify-content:center;font-size:.88rem;color:white;flex-shrink:0;}
        .sidebar-logo-text{font-family:var(--font-d);font-size:.93rem;font-weight:700;color:var(--text);letter-spacing:-.02em;}
        .sidebar-badge{font-family:var(--font-d);font-size:.6rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;background:var(--red);color:white;padding:.1rem .42rem;border-radius:100px;margin-left:.3rem;}

        .sidebar-nav{flex:1;padding:.9rem 0;display:flex;flex-direction:column;gap:.1rem;overflow-y:auto;}
        .sidebar-section-label{font-family:var(--font-d);font-size:.63rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:var(--text-muted);padding:.65rem 1.1rem .3rem;margin-top:.25rem;}

        .sidebar-item{display:flex;align-items:center;gap:.7rem;padding:.58rem 1rem .58rem .95rem;border-left:3px solid transparent;border-radius:0 .55rem .55rem 0;text-decoration:none;color:var(--text-sub);font-family:var(--font-d);font-size:.8rem;font-weight:600;transition:all .2s;margin-right:.75rem;}
        .sidebar-item:hover{border-left-color:var(--text);background:var(--bg-body);color:var(--text);}
        .sidebar-item.active{border-left-color:var(--text);background:var(--bg-body);color:var(--text);}

        .s-icon{width:30px;height:30px;border-radius:.45rem;background:var(--bg-card2);display:flex;align-items:center;justify-content:center;font-size:.8rem;color:var(--text-muted);flex-shrink:0;transition:all .2s;position:relative;}
        .sidebar-item:hover .s-icon,.sidebar-item.active .s-icon{background:rgba(192,57,43,.15);color:var(--red-h);}

        .sidebar-footer{padding:.85rem 0;border-top:1px solid var(--border);flex-shrink:0;}
        .sidebar-logout{display:flex;align-items:center;gap:.7rem;padding:.58rem 1rem .58rem .95rem;border-left:3px solid transparent;border-radius:0 .55rem .55rem 0;color:var(--text-muted);font-family:var(--font-d);font-size:.8rem;font-weight:600;cursor:pointer;width:100%;background:none;border-top:none;border-right:none;border-bottom:none;transition:all .2s;margin-right:.75rem;}
        .sidebar-logout:hover{border-left-color:var(--red-h);background:rgba(192,57,43,.08);color:var(--red-h);}
        .sidebar-logout:hover .s-icon{background:rgba(192,57,43,.15);color:var(--red-h);}

        /* ════ MAIN AREA ════ */
        .main-area{flex:1;margin-left:var(--sidebar-w);display:flex;flex-direction:column;min-height:100vh;}

        /* ════ TOP NAVBAR ════ */
        .app-nav{position:sticky;top:0;z-index:100;height:62px;display:flex;align-items:center;padding:0 1.75rem;gap:.65rem;background:var(--nav-bg);backdrop-filter:blur(14px);border-bottom:1px solid var(--border);transition:background .3s;}

        .nav-search{display:flex;align-items:center;gap:.5rem;background:var(--bg-card2);border:1px solid var(--border-md);border-radius:.5rem;padding:.42rem .9rem;width:230px;transition:border-color .2s,background .3s;}
        .nav-search:focus-within{border-color:rgba(192,57,43,.4);}
        .nav-search i{color:var(--text-muted);font-size:.8rem;flex-shrink:0;}
        .nav-search input{background:none;border:none;outline:none;color:var(--text);font-family:var(--font-b);font-size:.82rem;width:100%;}
        .nav-search input::placeholder{color:var(--text-muted);}

        .nav-right{display:flex;align-items:center;gap:.45rem;margin-left:auto;}
        .nav-divider{width:1px;height:20px;background:var(--border-md);flex-shrink:0;}

        .lang-btn{display:flex;align-items:center;gap:.28rem;font-family:var(--font-d);font-size:.76rem;font-weight:700;color:var(--text-sub);cursor:pointer;padding:.32rem .58rem;border-radius:.4rem;border:none;background:none;transition:all .2s;letter-spacing:.04em;}
        .lang-btn:hover{background:var(--bg-card2);color:var(--text);}

        .icon-btn{width:34px;height:34px;border-radius:.4rem;background:none;border:none;color:var(--text-sub);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:.88rem;transition:all .2s;}
        .icon-btn:hover{color:var(--text);background:var(--bg-card2);}

        /* Profile button */
        .nav-profile{display:flex;align-items:center;gap:.55rem;cursor:pointer;padding:.3rem .55rem;border-radius:.5rem;transition:all .2s;position:relative;text-decoration:none;}
        .nav-profile:hover{background:var(--bg-card2);}
        .profile-avatar{width:32px;height:32px;border-radius:50%;background:var(--red);color:white;display:flex;align-items:center;justify-content:center;font-family:var(--font-d);font-size:.72rem;font-weight:700;flex-shrink:0;overflow:hidden;}
        .profile-avatar img{width:100%;height:100%;object-fit:cover;}
        .profile-name{font-family:var(--font-d);font-size:.8rem;font-weight:600;color:var(--text);white-space:nowrap;}

        /* Profile dropdown */
        .profile-dropdown{position:absolute;top:calc(100% + .5rem);right:0;width:200px;background:var(--bg-card);border:1px solid var(--border-md);border-radius:.75rem;box-shadow:0 12px 32px rgba(0,0,0,.35);z-index:300;overflow:hidden;opacity:0;pointer-events:none;transform:translateY(-6px);transition:all .2s;}
        .profile-dropdown.open{opacity:1;pointer-events:auto;transform:translateY(0);}
        .dropdown-header{padding:.85rem 1rem .7rem;border-bottom:1px solid var(--border);}
        .dropdown-header-name{font-family:var(--font-d);font-size:.82rem;font-weight:700;color:var(--text);}
        .dropdown-header-role{font-size:.72rem;color:var(--text-muted);margin-top:.1rem;}
        .dropdown-item{display:flex;align-items:center;gap:.6rem;padding:.55rem 1rem;font-family:var(--font-d);font-size:.78rem;font-weight:600;color:var(--text-sub);text-decoration:none;transition:all .15s;cursor:pointer;border:none;background:none;width:100%;}
        .dropdown-item:hover{background:var(--bg-card2);color:var(--text);}
        .dropdown-item.danger:hover{background:rgba(192,57,43,.1);color:var(--red-h);}
        .dropdown-item i{width:14px;text-align:center;font-size:.8rem;}

        @yield('page-styles')
    </style>
</head>
<body>
@php
    $navUser      = auth()->user();
    $nameParts    = explode(' ', $navUser->name);
    $navInitials  = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
    $navPending   = isset($pendingOrders) ? $pendingOrders : \App\Models\Order::whereIn('status',['pending','sedang_disiapkan','siap_diambil'])->count();
@endphp

<div class="app-layout">

    {{-- ════ SIDEBAR ════ --}}
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
            <div class="sidebar-logo-icon"><i class="fas fa-utensils"></i></div>
            <div>
                <span class="sidebar-logo-text">E-Canteen</span>
                <span class="sidebar-badge">Admin</span>
            </div>
        </a>

        <nav class="sidebar-nav">
            <span class="sidebar-section-label" data-i18n="sidebar.section">Menu Utama</span>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="s-icon"><i class="fas fa-gauge-high"></i></span>
                <span data-i18n="sidebar.dashboard">Dashboard</span>
            </a>

            <a href="{{ route('admin.menus.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                <span class="s-icon"><i class="fas fa-bowl-food"></i></span>
                <span data-i18n="sidebar.manage_menu">Kelola Menu</span>
            </a>

            <a href="{{ route('admin.antrean.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.antrean.*') ? 'active' : '' }}">
                <span class="s-icon" style="position:relative;">
                    <i class="fas fa-list-ol"></i>
                    @if($navPending > 0)
                    <span style="position:absolute;top:-5px;right:-5px;background:var(--red);color:white;font-family:var(--font-d);font-size:.58rem;font-weight:700;padding:.06rem .32rem;border-radius:100px;min-width:15px;text-align:center;">{{ $navPending }}</span>
                    @endif
                </span>
                <span data-i18n="sidebar.queue">Antrean</span>
            </a>

            <a href="{{ route('admin.laporan.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <span class="s-icon"><i class="fas fa-chart-bar"></i></span>
                <span data-i18n="sidebar.report">Laporan</span>
            </a>

            <a href="{{ route('admin.saldo.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.saldo.*') ? 'active' : '' }}">
                <span class="s-icon"><i class="fas fa-wallet"></i></span>
                <span>Kelola Saldo</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <span class="s-icon"><i class="fas fa-users"></i></span>
                <span>Kelola User</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}" style="margin:0;padding-right:.75rem;">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <span class="s-icon"><i class="fas fa-right-from-bracket"></i></span>
                    <span data-i18n="sidebar.logout">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ════ MAIN AREA ════ --}}
    <div class="main-area">

        {{-- ── TOP NAVBAR ── --}}
        <header class="app-nav">
            <div class="nav-search">
                <i class="fas fa-magnifying-glass"></i>
                <input type="text" id="nav-search-input" placeholder="Cari...">
            </div>

            <div class="nav-right">
                <div class="nav-divider"></div>
                <button class="lang-btn" id="lang-btn" onclick="toggleLang()">
                    <span id="lang-label">ID</span>
                    <i class="fas fa-chevron-down" style="font-size:.6rem;"></i>
                </button>

                <div class="nav-divider"></div>
                <button class="icon-btn" title="Notifikasi">
                    <i class="fas fa-bell"></i>
                </button>

                <button class="icon-btn" id="theme-btn" onclick="toggleTheme()">
                    <i class="fas fa-sun" id="theme-icon"></i>
                </button>

                <div class="nav-divider"></div>

                {{-- Profile dengan dropdown --}}
                <div style="position:relative;">
                    <div class="nav-profile" id="profile-btn" onclick="toggleProfileDropdown()">
                        <div class="profile-avatar">
                            @if($navUser->avatar)
                                <img src="{{ Storage::url($navUser->avatar) }}" alt="{{ $navUser->name }}">
                            @else
                                {{ $navInitials }}
                            @endif
                        </div>
                        <span class="profile-name">{{ $navUser->name }}</span>
                        <i class="fas fa-chevron-down" style="font-size:.62rem;color:var(--text-muted);margin-left:.15rem;"></i>
                    </div>

                    <div class="profile-dropdown" id="profile-dropdown">
                        <div class="dropdown-header">
                            <div class="dropdown-header-name">{{ $navUser->name }}</div>
                            <div class="dropdown-header-role" data-i18n="dropdown.role">Administrator</div>
                        </div>
                        <a href="{{ route('admin.profile') }}" class="dropdown-item">
                            <i class="fas fa-user-pen"></i> <span data-i18n="dropdown.edit_profile">Edit Profil</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <i class="fas fa-right-from-bracket"></i> <span data-i18n="dropdown.logout">Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </header>

        {{-- ── PAGE CONTENT ── --}}
        @yield('content')

    </div>{{-- /.main-area --}}
</div>{{-- /.app-layout --}}

<script>
    /* ── Language ── */
    window.T = {
        id: {
            'search-ph': 'Cari...',
            'sidebar.section': 'Menu Utama',
            'sidebar.dashboard': 'Dashboard',
            'sidebar.manage_menu': 'Kelola Menu',
            'sidebar.queue': 'Antrean',
            'sidebar.report': 'Laporan',
            'sidebar.logout': 'Keluar',
            'dropdown.role': 'Administrator',
            'dropdown.edit_profile': 'Edit Profil',
            'dropdown.logout': 'Keluar',
        },
        en: {
            'search-ph': 'Search...',
            'sidebar.section': 'Main Menu',
            'sidebar.dashboard': 'Dashboard',
            'sidebar.manage_menu': 'Manage Menu',
            'sidebar.queue': 'Queue',
            'sidebar.report': 'Reports',
            'sidebar.logout': 'Logout',
            'dropdown.role': 'Administrator',
            'dropdown.edit_profile': 'Edit Profile',
            'dropdown.logout': 'Logout',
        }
    };
    let currentLang = localStorage.getItem('ecanteen-lang') || 'id';
    window.currentLang = currentLang;
    function applyLang(lang) {
        currentLang = lang;
        window.currentLang = lang;
        localStorage.setItem('ecanteen-lang', lang);
        document.getElementById('lang-label').textContent = lang === 'id' ? 'ID' : 'ENG';
        const inp = document.getElementById('nav-search-input');
        if (inp) inp.placeholder = window.T[lang]['search-ph'] || '';
        document.querySelectorAll('[data-i18n]').forEach(function(el) {
            const key = el.dataset.i18n;
            if (window.T[lang] && window.T[lang][key] !== undefined) el.textContent = window.T[lang][key];
        });
        document.querySelectorAll('[data-i18n-tmpl]').forEach(function(el) {
            const key = el.dataset.i18nTmpl;
            const val = el.dataset.i18nVal !== undefined ? el.dataset.i18nVal : '';
            if (window.T[lang] && window.T[lang][key] !== undefined) {
                el.textContent = window.T[lang][key].replace('{n}', val);
            }
        });
    }
    window.applyLang = applyLang;
    function toggleLang() { applyLang(currentLang === 'id' ? 'en' : 'id'); }
    window.toggleLang = toggleLang;

    /* ── Theme ── */
    function toggleTheme() {
        const h = document.documentElement;
        const n = (h.getAttribute('data-theme') || 'dark') === 'dark' ? 'light' : 'dark';
        h.setAttribute('data-theme', n);
        localStorage.setItem('ecanteen-theme', n);
        updateThemeIcon(n);
    }
    function updateThemeIcon(t) {
        const i = document.getElementById('theme-icon');
        const b = document.getElementById('theme-btn');
        if (!i) return;
        i.className = t === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        b.title     = t === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode';
    }

    /* ── Profile Dropdown ── */
    function toggleProfileDropdown() {
        document.getElementById('profile-dropdown').classList.toggle('open');
    }
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('profile-btn');
        const dd  = document.getElementById('profile-dropdown');
        if (btn && dd && !btn.contains(e.target) && !dd.contains(e.target)) {
            dd.classList.remove('open');
        }
    });

    /* Init */
    updateThemeIcon(document.documentElement.getAttribute('data-theme') || 'dark');
    applyLang(currentLang);
</script>

@yield('page-scripts')
</body>
</html>
