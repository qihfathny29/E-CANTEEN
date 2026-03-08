<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Canteen â€” Web Portal</title>

    <!-- Anti-flash theme script -->
    <script>(function(){var t=localStorage.getItem('ecanteen-theme')||'dark';document.documentElement.setAttribute('data-theme',t);})();</script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            /* Accent — same in both modes */
            --red:        #c0392b;
            --red-h:      #e74c3c;
            --font-d:     'Sora', sans-serif;
            --font-b:     'DM Sans', sans-serif;
            /* Dark mode (default) */
            --bg-body:    #0f0f0f;
            --bg-card:    #1a1a1a;
            --bg-card2:   #262626;
            --text:       #ffffff;
            --text-sub:   rgba(255,255,255,0.70);
            --text-muted: rgba(255,255,255,0.40);
            --border:     rgba(255,255,255,0.07);
            --border-md:  rgba(255,255,255,0.14);
            --nav-bg:     rgba(15,15,15,0.85);
            --out-btn:    rgba(255,255,255,0.65);
            --glow-a:     rgba(192,57,43,0.14);
            --glow-b:     rgba(192,57,43,0.10);
        }

        html[data-theme="light"] {
            --bg-body:    #f0f0f0;
            --bg-card:    #ffffff;
            --bg-card2:   #e6e6e6;
            --text:       #0f0f0f;
            --text-sub:   rgba(15,15,15,0.65);
            --text-muted: rgba(15,15,15,0.42);
            --border:     rgba(0,0,0,0.08);
            --border-md:  rgba(0,0,0,0.16);
            --nav-bg:     rgba(240,240,240,0.92);
            --out-btn:    rgba(15,15,15,0.65);
            --glow-a:     rgba(192,57,43,0.07);
            --glow-b:     rgba(192,57,43,0.04);
        }

        html, body {
            height: 100%;
            overflow-x: hidden;
            background: var(--bg-body);
            color: var(--text);
            font-family: var(--font-b);
            transition: background .3s, color .3s;
        }

        /* â”€â”€ ambient glow â”€â”€ */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 800px 600px at 5% 15%,  var(--glow-a) 0%, transparent 60%),
                radial-gradient(ellipse 600px 500px at 90% 85%, var(--glow-b) 0%, transparent 55%);
            pointer-events: none;
            z-index: 0;
            transition: background .3s;
        }

        /* â”€â”€ NAVBAR â”€â”€ */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 3rem;
            background: var(--nav-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            transition: background .3s, border-color .3s;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: .65rem;
            text-decoration: none;
        }

        .nav-logo-icon {
            background: var(--red);
            width: 36px; height: 36px;
            border-radius: .5rem;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
            color: white;
        }

        .nav-logo-text {
            font-family: var(--font-d);
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -.02em;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: .85rem;
        }

        .btn-outline {
            font-family: var(--font-d);
            font-size: .85rem;
            font-weight: 600;
            color: var(--out-btn);
            border: 1px solid var(--border-md);
            border-radius: .5rem;
            padding: .5rem 1.25rem;
            text-decoration: none;
            transition: all .2s ease;
            background: transparent;
        }
        .btn-outline:hover {
            color: var(--text);
            border-color: var(--border-md);
            background: rgba(128,128,128,.1);
        }

        /* ── Theme toggle button ── */
        .theme-btn {
            width: 36px; height: 36px;
            border-radius: .5rem;
            background: var(--bg-card);
            border: 1px solid var(--border-md);
            color: var(--text-sub);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: .9rem;
            transition: all .2s;
        }
        .theme-btn:hover {
            color: var(--text);
            border-color: var(--red);
            background: rgba(192,57,43,.1);
        }

        .btn-red {
            font-family: var(--font-d);
            font-size: .85rem;
            font-weight: 600;
            color: white;
            background: var(--red);
            border: 1px solid var(--red);
            border-radius: .5rem;
            padding: .5rem 1.4rem;
            text-decoration: none;
            transition: all .2s ease;
        }
        .btn-red:hover {
            background: var(--red-h);
            border-color: var(--red-h);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(192,57,43,.4);
        }

        button.btn-outline {
            cursor: pointer;
            font-family: var(--font-d);
        }

        /* â”€â”€ HERO â”€â”€ */
        .hero {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 8rem 2rem 4rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(192,57,43,.12);
            border: 1px solid rgba(192,57,43,.35);
            color: var(--red-h);
            font-family: var(--font-d);
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: .35rem 1rem;
            border-radius: 100px;
            margin-bottom: 2rem;
        }

        .hero-title {
            font-family: var(--font-d);
            font-size: clamp(2.8rem, 6vw, 5rem);
            font-weight: 800;
            letter-spacing: -.04em;
            line-height: 1.05;
            max-width: 720px;
            margin-bottom: 1.5rem;
            color: var(--text);
        }

        .hero-title span {
            color: var(--red);
        }

        .hero-desc {
            font-size: 1.05rem;
            color: var(--text-sub);
            max-width: 520px;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-lg-red {
            font-family: var(--font-d);
            font-size: 1rem;
            font-weight: 700;
            color: white;
            background: var(--red);
            border-radius: .7rem;
            padding: .85rem 2.2rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: all .25s ease;
            box-shadow: 0 4px 20px rgba(192,57,43,.35);
        }
        .btn-lg-red:hover {
            background: var(--red-h);
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(192,57,43,.5);
        }

        .btn-lg-outline {
            font-family: var(--font-d);
            font-size: 1rem;
            font-weight: 600;
            color: var(--out-btn);
            border: 1px solid var(--border-md);
            background: transparent;
            border-radius: .7rem;
            padding: .85rem 2.2rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            transition: all .25s ease;
        }
        .btn-lg-outline:hover {
            color: var(--text);
            border-color: var(--red);
            background: rgba(192,57,43,.06);
        }

        /* â”€â”€ STATS STRIP â”€â”€ */
        .stats-strip {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            gap: 0;
            flex-wrap: wrap;
            margin: 0 auto;
            max-width: 780px;
            border: 1px solid var(--border);
            border-radius: 1.2rem;
            overflow: hidden;
            background: var(--bg-card);
            transition: background .3s, border-color .3s;
        }

        .stat-item {
            flex: 1;
            min-width: 150px;
            padding: 2rem 1.5rem;
            text-align: center;
            border-right: 1px solid var(--border);
        }
        .stat-item:last-child { border-right: none; }

        .stat-num {
            font-family: var(--font-d);
            font-size: 2rem;
            font-weight: 800;
            color: var(--red);
            letter-spacing: -.03em;
        }

        .stat-label {
            font-size: .82rem;
            color: var(--text-muted);
            margin-top: .3rem;
            letter-spacing: .02em;
        }

        /* â”€â”€ FEATURES â”€â”€ */
        .section {
            position: relative;
            z-index: 1;
            padding: 6rem 2rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-tag {
            font-family: var(--font-d);
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: .75rem;
        }

        .section-title {
            font-family: var(--font-d);
            font-size: clamp(1.6rem, 3.5vw, 2.6rem);
            font-weight: 800;
            letter-spacing: -.03em;
            color: var(--text);
            max-width: 560px;
            line-height: 1.15;
            margin-bottom: 3.5rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
        }

        .feature-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 1.2rem;
            padding: 2rem;
            transition: border-color .2s, transform .2s, background .3s;
        }
        .feature-card:hover {
            border-color: rgba(192,57,43,.4);
            transform: translateY(-3px);
        }

        .feature-icon {
            width: 46px; height: 46px;
            background: rgba(192,57,43,.12);
            border-radius: .75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--red-h);
            font-size: 1.2rem;
            margin-bottom: 1.2rem;
        }

        .feature-title {
            font-family: var(--font-d);
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: .5rem;
        }

        .feature-desc {
            font-size: .875rem;
            color: var(--text-muted);
            line-height: 1.65;
        }

        /* â”€â”€ CTA BANNER â”€â”€ */
        .cta-banner {
            position: relative;
            z-index: 1;
            margin: 0 auto 6rem;
            max-width: 900px;
            padding: 3.5rem 3rem;
            background: var(--bg-card);
            border: 1px solid rgba(192,57,43,.25);
            transition: background .3s;
            border-radius: 1.8rem;
            text-align: center;
            overflow: hidden;
        }

        .cta-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 600px 300px at 50% 50%, rgba(192,57,43,.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-banner h2 {
            font-family: var(--font-d);
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -.03em;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .cta-banner p {
            font-size: .95rem;
            color: var(--text-sub);
            margin-bottom: 2rem;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }

        /* â”€â”€ FOOTER â”€â”€ */
        footer {
            position: relative;
            z-index: 1;
            border-top: 1px solid var(--border);
            padding: 2rem 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            transition: border-color .3s;
        }

        footer p {
            font-size: .8rem;
            color: var(--text-muted);
        }

        footer .footer-logo {
            font-family: var(--font-d);
            font-size: .9rem;
            font-weight: 700;
            color: var(--text-sub);
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        footer .footer-logo i {
            color: var(--red);
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <a href="/" class="nav-logo">
            <div class="nav-logo-icon">
                <i class="fas fa-utensils"></i>
            </div>
            <span class="nav-logo-text">E-Canteen</span>
        </a>
        <div class="nav-links">
            @if (Route::has('login'))
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-outline">Dashboard</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="btn-outline">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;display:inline;">
                        @csrf
                        <button type="submit" class="btn-outline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-outline">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-red">Get Started</a>
                    @endif
                @endauth
            @endif
            <button class="theme-btn" id="theme-btn" onclick="toggleTheme()" title="Switch to Light Mode">
                <i class="fas fa-sun" id="theme-icon"></i>
            </button>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="badge">
            <i class="fas fa-circle-check"></i>
            School Canteen Management System
        </div>
        <h1 class="hero-title">
            Order Smarter,<br> Eat <span>Better</span>.
        </h1>
        <p class="hero-desc">
            E-Canteen adalah platform digital untuk mempermudah pemesanan makanan di kantin sekolah. Cepat, mudah, dan tanpa antrian panjang.
        </p>
        <div class="hero-cta">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-lg-red">
                    <i class="fas fa-arrow-right"></i>
                    Mulai Sekarang
                </a>
            @endif
            <a href="{{ route('login') }}" class="btn-lg-outline">
                <i class="fas fa-sign-in-alt"></i>
                Masuk ke Akun
            </a>
        </div>
    </section>

    <!-- STATS -->
    <div style="position:relative; z-index:1; padding: 0 2rem 5rem; max-width:900px; margin:0 auto;">
        <div class="stats-strip">
            <div class="stat-item">
                <div class="stat-num">500+</div>
                <div class="stat-label">Pengguna Aktif</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">1.2K</div>
                <div class="stat-label">Pesanan Per Hari</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">30+</div>
                <div class="stat-label">Menu Tersedia</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">99%</div>
                <div class="stat-label">Kepuasan Pengguna</div>
            </div>
        </div>
    </div>

    <!-- FEATURES -->
    <div class="section">
        <div class="section-tag">Fitur Unggulan</div>
        <h2 class="section-title">Semua yang kamu butuhkan ada di sini</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-mobile-screen-button"></i></div>
                <div class="feature-title">Pemesanan Digital</div>
                <div class="feature-desc">Pesan makanan langsung dari perangkatmu tanpa perlu mengantri di kantin.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                <div class="feature-title">Proses Cepat</div>
                <div class="feature-desc">Notifikasi real-time saat pesanan siap. Hemat waktu istirahatmu.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-wallet"></i></div>
                <div class="feature-title">Pembayaran Mudah</div>
                <div class="feature-desc">Bayar langsung atau gunakan saldo akun yang sudah terisi sebelumnya.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="feature-title">Laporan Admin</div>
                <div class="feature-desc">Dashboard lengkap untuk admin kantin memantau penjualan dan stok menu.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-shield-halved"></i></div>
                <div class="feature-title">Akun Aman</div>
                <div class="feature-desc">Sistem autentikasi yang aman dengan pemisahan role Student dan Faculty.</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-utensils"></i></div>
                <div class="feature-title">Menu Beragam</div>
                <div class="feature-desc">Jelajahi berbagai pilihan menu yang diperbarui setiap harinya oleh kantin.</div>
            </div>
        </div>
    </div>

    <!-- CTA BANNER -->
    <div style="padding: 0 2rem; position:relative; z-index:1;">
        <div class="cta-banner">
            <h2>Siap untuk mulai?</h2>
            <p>Daftar sekarang dan rasakan kemudahan memesan makanan di kantin sekolahmu.</p>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-lg-red" style="display:inline-flex;">
                    <i class="fas fa-user-plus"></i>
                    Buat Akun Gratis
                </a>
            @endif
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-logo">
            <i class="fas fa-utensils"></i>
            E-Canteen Web Portal
        </div>
        <p>&copy; {{ date('Y') }} E-Canteen. All rights reserved.</p>
    </footer>

    <script>
        function toggleTheme() {
            var html = document.documentElement;
            var current = html.getAttribute('data-theme') || 'dark';
            var next = current === 'dark' ? 'light' : 'dark';
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

</body>
</html>
