<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- Anti-flash theme script -->
    <script>(function(){var t=localStorage.getItem('ecanteen-theme')||'dark';document.documentElement.setAttribute('data-theme',t);})();</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-Canteen') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --red:        #c0392b;
            --red-h:      #e74c3c;
            --font-d:     'Sora', sans-serif;
            --font-b:     'DM Sans', sans-serif;
            --bg-body:    #0f0f0f;
            --bg-card:    #1a1a1a;
            --bg-card2:   #262626;
            --text:       #ffffff;
            --text-sub:   rgba(255,255,255,0.68);
            --text-muted: rgba(255,255,255,0.40);
            --border:     rgba(255,255,255,0.07);
            --border-md:  rgba(255,255,255,0.14);
            --nav-bg:     rgba(15,15,15,0.96);
        }
        html[data-theme="light"] {
            --bg-body:    #f0f0f0;
            --bg-card:    #ffffff;
            --bg-card2:   #e6e6e6;
            --text:       #0f0f0f;
            --text-sub:   rgba(15,15,15,0.65);
            --text-muted: rgba(15,15,15,0.42);
            --border:     rgba(0,0,0,0.08);
            --border-md:  rgba(0,0,0,0.15);
            --nav-bg:     rgba(240,240,240,0.97);
        }
        html, body { min-height: 100vh; background: var(--bg-body); color: var(--text); font-family: var(--font-b); transition: background .3s, color .3s; }
        /* ── Top Nav ── */
        .app-nav {
            position: sticky; top: 0; z-index: 100;
            height: 62px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2rem;
            background: var(--nav-bg); backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            transition: background .3s, border-color .3s;
        }
        .nav-logo {
            display: flex; align-items: center; gap: .6rem;
            text-decoration: none;
        }
        .nav-logo-icon {
            background: var(--red); width: 32px; height: 32px;
            border-radius: .45rem;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; color: white;
        }
        .nav-logo-text {
            font-family: var(--font-d); font-size: 1rem; font-weight: 700;
            color: var(--text); letter-spacing: -.02em;
        }
        .nav-center { display: flex; align-items: center; gap: .2rem; }
        .nav-link {
            font-family: var(--font-d); font-size: .8rem; font-weight: 600;
            color: var(--text-sub); text-decoration: none;
            padding: .38rem .8rem; border-radius: .4rem;
            transition: all .15s;
        }
        .nav-link:hover { color: var(--text); background: rgba(128,128,128,.1); }
        .nav-link.active { color: white; background: var(--red); }
        .nav-right { display: flex; align-items: center; gap: .6rem; }
        .theme-btn {
            width: 34px; height: 34px; border-radius: .4rem;
            background: var(--bg-card2); border: 1px solid var(--border-md);
            color: var(--text-sub);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: .85rem; transition: all .2s;
        }
        .theme-btn:hover { color: var(--text); border-color: var(--red); background: rgba(192,57,43,.1); }
        .user-menu-btn {
            display: flex; align-items: center; gap: .45rem;
            font-family: var(--font-d); font-size: .8rem; font-weight: 600;
            color: var(--text-sub); background: var(--bg-card);
            border: 1px solid var(--border); border-radius: .45rem;
            padding: .38rem .8rem; cursor: pointer; transition: all .2s;
        }
        .user-menu-btn:hover { color: var(--text); border-color: var(--border-md); }
        .dropdown-menu {
            position: absolute; right: 0; top: calc(100% + .4rem);
            min-width: 175px;
            background: var(--bg-card); border: 1px solid var(--border-md);
            border-radius: .75rem; overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,.25); z-index: 200;
        }
        .dropdown-item {
            display: flex; align-items: center; gap: .55rem;
            padding: .7rem 1rem;
            font-family: var(--font-d); font-size: .8rem; font-weight: 600;
            color: var(--text-sub); text-decoration: none;
            transition: all .15s; background: transparent; border: none;
            width: 100%; cursor: pointer;
        }
        .dropdown-item:hover { background: rgba(128,128,128,.08); color: var(--text); }
        .dropdown-item.danger:hover { background: rgba(192,57,43,.08); color: #c0392b; }
        .dropdown-item i { width: 14px; color: var(--red); font-size: .8rem; }
        .dropdown-divider { border-top: 1px solid var(--border); }
        /* ── Page shells ── */
        .page-wrap { min-height: calc(100vh - 62px); }
        .page-header { padding: 2rem 2rem .5rem; }
        .page-header h1 { font-family: var(--font-d); font-size: 1.4rem; font-weight: 800; color: var(--text); letter-spacing: -.03em; }
        .page-header p  { font-size: .85rem; color: var(--text-muted); margin-top: .2rem; }
        .panel {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: 1rem; transition: background .3s;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="app-nav">
        <a href="{{ route('dashboard') }}" class="nav-logo">
            <div class="nav-logo-icon"><i class="fas fa-utensils"></i></div>
            <span class="nav-logo-text">E-Canteen</span>
        </a>
        <div class="nav-center">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-table-cells-large"></i> Dashboard
            </a>
        </div>
        <div class="nav-right">
            <button class="theme-btn" id="theme-btn" onclick="toggleTheme()" title="Switch to Light Mode">
                <i class="fas fa-sun" id="theme-icon"></i>
            </button>
            <div style="position:relative;" x-data="{ open: false }">
                <button class="user-menu-btn" @click="open=!open">
                    <i class="fas fa-user-circle"></i>
                    {{ Auth::user()->name }}
                    <i class="fas fa-chevron-down" style="font-size:.65rem;"></i>
                </button>
                <div class="dropdown-menu" x-show="open" @click.outside="open=false" style="display:none;" x-bind:style="open ? 'display:block' : 'display:none'">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item danger">
                            <i class="fas fa-sign-out-alt"></i> Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="page-wrap">
        {{ $slot }}
    </main>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function toggleTheme() {
            var html = document.documentElement;
            var next = (html.getAttribute('data-theme')||'dark') === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', next);
            localStorage.setItem('ecanteen-theme', next);
            updateThemeIcon(next);
        }
        function updateThemeIcon(t) {
            var icon = document.getElementById('theme-icon');
            var btn  = document.getElementById('theme-btn');
            if (!icon) return;
            icon.className = t === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            btn.title = t === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode';
        }
        updateThemeIcon(document.documentElement.getAttribute('data-theme') || 'dark');
    </script>
    @stack('scripts')
</body>
</html>
