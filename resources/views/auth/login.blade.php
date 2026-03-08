<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- Anti-flash theme script -->
    <script>(function(){var t=localStorage.getItem('ecanteen-theme')||'dark';document.documentElement.setAttribute('data-theme',t);})();</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --font-display: 'Sora', sans-serif;
            --font-body: 'DM Sans', sans-serif;
            /* Dark mode (default) */
            --bg-body:      #0f0f0f;
            --bg-card:      #1a1a1a;
            --text:         #ffffff;
            --text-sub:     rgba(255,255,255,0.75);
            --text-muted:   rgba(255,255,255,0.55);
            --text-dim:     rgba(255,255,255,0.40);
            --border:       rgba(255,255,255,0.07);
            --border-in:    rgba(255,255,255,0.12);
            --input-bg:     rgba(255,255,255,0.07);
            --input-bg-f:   rgba(255,255,255,0.10);
            --form-bg:      rgba(15,15,15,0.60);
            --card-shadow:  0 32px 64px -16px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.06) inset;
            --glow-a:       rgba(192,57,43,0.15);
            --glow-b:       rgba(192,57,43,0.10);
            --tbtn-bg:      rgba(255,255,255,0.08);
            --tbtn-bd:      rgba(255,255,255,0.15);
            --tbtn-cl:      rgba(255,255,255,0.65);
        }

        html[data-theme="light"] {
            --bg-body:      #f0f0f0;
            --bg-card:      #ffffff;
            --text:         #0f0f0f;
            --text-sub:     rgba(15,15,15,0.70);
            --text-muted:   rgba(15,15,15,0.55);
            --text-dim:     rgba(15,15,15,0.42);
            --border:       rgba(0,0,0,0.08);
            --border-in:    rgba(0,0,0,0.15);
            --input-bg:     rgba(0,0,0,0.04);
            --input-bg-f:   rgba(0,0,0,0.06);
            --form-bg:      rgba(255,255,255,0.80);
            --card-shadow:  0 32px 64px -16px rgba(0,0,0,0.10), 0 0 0 1px rgba(0,0,0,0.06) inset;
            --glow-a:       rgba(192,57,43,0.07);
            --glow-b:       rgba(192,57,43,0.04);
            --tbtn-bg:      rgba(0,0,0,0.06);
            --tbtn-bd:      rgba(0,0,0,0.15);
            --tbtn-cl:      rgba(15,15,15,0.55);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text);
            font-family: var(--font-body);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow: hidden;
            letter-spacing: -0.01em;
            transition: background-color .3s, color .3s;
        }

        html {
            overflow: hidden;
        }

        /* ── Ambient background glow ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 700px 500px at 10% 20%, var(--glow-a) 0%, transparent 65%),
                radial-gradient(ellipse 500px 400px at 85% 80%, var(--glow-b) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
            transition: background .3s;
        }

        /* ── Perspective for flip card ── */
        .perspective-1000 {
            perspective: 1200px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
        }

        .is-flipped {
            transform: rotateY(180deg);
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            display: flex;
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: box-shadow .3s;
        }

        .flip-card-back {
            transform: rotateY(180deg);
        }

        .bg-blob {
            position: absolute;
            width: 600px;
            height: 600px;
            background: #c0392b;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.18;
            top: -150px;
            left: -150px;
        }

        /* ── Card base ── */
        .glass-card {
            background-color: var(--bg-card) !important;
            border: 1px solid var(--border);
        }

        /* ── Subtle inner texture on the form half ── */
        .form-side {
            background: var(--form-bg);
            backdrop-filter: blur(2px);
        }

        /* ── Button ── */
        .btn-primary-custom {
            background-color: #c0392b !important;
            color: white !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: var(--font-display);
            font-weight: 600;
            letter-spacing: 0.02em;
            font-size: 1rem;
        }

        .btn-primary-custom:hover {
            background-color: #992d22 !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(192, 57, 43, 0.4);
        }

        .btn-primary-custom:active {
            transform: scale(0.98) translateY(0);
        }

        /* ── Inputs ── */
        .input-field-custom {
            background-color: var(--input-bg) !important;
            border: 1px solid var(--border-in) !important;
            color: var(--text) !important;
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 400;
            transition: border-color 0.2s, background-color 0.2s, box-shadow 0.2s;
        }

        .input-field-custom:focus {
            background-color: var(--input-bg-f) !important;
            border-color: rgba(192, 57, 43, 0.7) !important;
            box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.15) !important;
        }

        .input-field-custom::placeholder {
            color: var(--text-dim) !important;
            font-weight: 400;
        }

        /* ── Typography ── */
        .heading-login {
            font-family: var(--font-display);
            font-size: 2.6rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.1;
            color: var(--text);
        }

        .heading-register {
            font-family: var(--font-display);
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.1;
            color: var(--text);
        }

        .site-title {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text);
        }

        .logo-name {
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-weight: 700;
            font-style: italic;
            letter-spacing: -0.01em;
            color: var(--text);
        }

        /* ── Forgot password / links ── */
        .subtle-link {
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-sub);
            transition: color 0.15s;
            text-decoration: none;
        }
        .subtle-link:hover { color: var(--text); }

        .action-link {
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        /* ── Helper text ── */
        .helper-text {
            font-family: var(--font-body);
            font-size: 0.82rem;
            font-weight: 400;
            color: var(--text-sub);
            text-align: center;
            margin-top: 1rem;
        }

        /* ── Character/image box ── */
        .character-box {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .chef-image {
            width: 100%;
            height: auto;
            max-width: 280px;
        }

        /* ── Icon wrappers in inputs ── */
        .input-icon {
            font-size: 1.05rem;
            color: rgba(192, 57, 43, 0.8);
            transition: color 0.15s;
        }
        .group:focus-within .input-icon {
            color: #e74c3c;
        }

        /* ── Bottom bar ── */
        .bottom-bar-text {
            font-family: var(--font-body);
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* ── Logo icon box ── */
        .logo-icon-box {
            background-color: #c0392b;
            padding: 0.45rem 0.6rem;
            border-radius: 0.6rem;
        }

        /* ── Section label (select user type) ── */
        .section-label {
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        /* ── Theme toggle button ── */
        .theme-btn {
            width: 34px; height: 34px;
            border-radius: .45rem;
            background: var(--tbtn-bg);
            border: 1px solid var(--tbtn-bd);
            color: var(--tbtn-cl);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: .85rem;
            transition: all .2s;
        }
        .theme-btn:hover {
            border-color: #c0392b;
            background: rgba(192,57,43,.15);
            color: #e74c3c;
        }

        /* ── Light mode accent for radio/checkbox ── */
        html[data-theme="light"] input[type="radio"],
        html[data-theme="light"] input[type="checkbox"] {
            accent-color: #c0392b;
        }

        /* ── Divider line on image side ── */
        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(192, 57, 43, 0.2) 100%);
        }

        /* ── Info Panel (replaces image) ── */
        .info-panel {
            background: linear-gradient(145deg, rgba(192,57,43,0.18) 0%, rgba(192,57,43,0.06) 60%, transparent 100%);
            border-right: 1px solid rgba(192,57,43,0.2);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding: 2.5rem 2rem;
            gap: 1.4rem;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .info-panel::before {
            content: '';
            position: absolute;
            top: -80px; left: -80px;
            width: 280px; height: 280px;
            background: rgba(192,57,43,0.12);
            border-radius: 50%;
            filter: blur(50px);
            pointer-events: none;
        }
        .info-panel-right {
            border-right: none;
            border-left: 1px solid rgba(192,57,43,0.2);
        }
        .info-panel-logo {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: .4rem;
        }
        .info-panel-logo-icon {
            background: #c0392b;
            width: 38px; height: 38px;
            border-radius: .55rem;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .info-panel-logo-text {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text);
        }
        .info-panel-headline {
            font-family: var(--font-display);
            font-size: 1.55rem;
            font-weight: 800;
            letter-spacing: -0.035em;
            line-height: 1.2;
            color: var(--text);
        }
        .info-panel-headline span {
            color: #e74c3c;
        }
        .info-panel-desc {
            font-family: var(--font-body);
            font-size: 0.82rem;
            color: var(--text-sub);
            line-height: 1.65;
        }
        .info-panel-features {
            list-style: none;
            padding: 0; margin: 0;
            display: flex;
            flex-direction: column;
            gap: .65rem;
        }
        .info-panel-features li {
            display: flex;
            align-items: flex-start;
            gap: .6rem;
            font-family: var(--font-body);
            font-size: 0.8rem;
            color: var(--text-sub);
            line-height: 1.45;
        }
        .info-panel-features li .feat-icon {
            width: 24px; height: 24px;
            background: rgba(192,57,43,0.18);
            border-radius: .35rem;
            display: flex; align-items: center; justify-content: center;
            color: #e74c3c;
            font-size: .7rem;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .info-panel-badge {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: rgba(192,57,43,0.15);
            border: 1px solid rgba(192,57,43,0.35);
            color: #e74c3c;
            font-family: var(--font-display);
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            padding: .28rem .75rem;
            border-radius: 100px;
        }

        /* ── Scroll lock ── */
        html, body { overflow: hidden; }
    </style>
</head>
<body class="antialiased text-white" x-data="{ isFlipped: false }">
    <div class="bg-blob top-left-circle"></div>

    <div class="min-h-screen flex flex-col items-center justify-center relative p-8" style="z-index:1">
        
        <!-- Header Info -->
        <div class="absolute top-10 left-10">
            <h1 class="site-title text-white">E-Canteen Web Portal</h1>
        </div>

        <div class="absolute top-10 right-10 flex items-center gap-2">
            <div class="logo-icon-box">
                <i class="fas fa-utensils text-xl text-white"></i>
            </div>
            <span class="logo-name">E-Canteen</span>
            <button class="theme-btn" id="theme-btn" onclick="toggleTheme()" title="Switch to Light Mode">
                <i class="fas fa-sun" id="theme-icon"></i>
            </button>
        </div>

        <!-- Bottom bar -->
        <div class="absolute bottom-10 right-10 flex items-center gap-6 bottom-bar-text">
            <div class="flex items-center gap-1 cursor-pointer hover:text-white transition">
                <span>Language: ENG</span>
                <i class="fas fa-chevron-down text-xs ml-0.5"></i>
            </div>
            <div class="flex items-center gap-1 cursor-pointer hover:text-white transition">
                <i class="far fa-question-circle"></i>
                <span>Help</span>
            </div>
        </div>

        <!-- FLIP CARD CONTAINER -->
        <div class="w-full max-w-4xl h-[560px] perspective-1000 mt-16 mb-10">
            <div class="flip-card-inner" :class="isFlipped ? 'is-flipped' : ''">
                
                <!-- FRONT: LOGIN CARD -->
                <div class="flip-card-front glass-card shadow-2xl">
                    <!-- Info Panel (Left) -->
                    <div class="w-1/2 p-0">
                        <div class="info-panel w-full">
                            <div class="info-panel-logo">
                                <div class="info-panel-logo-icon"><i class="fas fa-utensils"></i></div>
                                <span class="info-panel-logo-text">E-Canteen</span>
                            </div>
                            <div class="info-panel-badge">
                                <i class="fas fa-circle-check"></i> Platform Kantin Digital
                            </div>
                            <h2 class="info-panel-headline">Order Smarter,<br>Eat <span>Better</span>.</h2>
                            <p class="info-panel-desc">
                                E-Canteen adalah sistem pemesanan kantin digital untuk siswa dan guru. Tidak perlu antri — pesan dari mana saja, kapan saja.
                            </p>
                            <ul class="info-panel-features">
                                <li>
                                    <span class="feat-icon"><i class="fas fa-mobile-screen-button"></i></span>
                                    <span>Pemesanan digital langsung dari perangkatmu</span>
                                </li>
                                <li>
                                    <span class="feat-icon"><i class="fas fa-bolt"></i></span>
                                    <span>Notifikasi real-time saat pesananmu siap</span>
                                </li>
                                <li>
                                    <span class="feat-icon"><i class="fas fa-wallet"></i></span>
                                    <span>Pembayaran mudah & cepat tanpa uang tunai</span>
                                </li>
                                <li>
                                    <span class="feat-icon"><i class="fas fa-utensils"></i></span>
                                    <span>30+ menu beragam yang diperbarui setiap hari</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Form Side (Right) -->
                    <div class="w-1/2 p-12 flex flex-col justify-center form-side">
                        <h2 class="heading-login mb-8 text-center text-white">Login</h2>
                        
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="space-y-5">
                            @csrf

                            <!-- Student ID / Email -->
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card input-icon"></i>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                                    class="w-full input-field-custom rounded-xl pl-12 py-4 outline-none"
                                    placeholder="Student ID / Email">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-200" />
                            </div>

                            <!-- Password -->
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-key input-icon"></i>
                                </div>
                                <input id="password" type="password" name="password" required 
                                    class="w-full input-field-custom rounded-xl pl-12 py-4 outline-none"
                                    placeholder="Password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-200" />
                            </div>

                            <div class="flex justify-end">
                                @if (Route::has('password.request'))
                                    <a class="subtle-link" href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="w-full py-4 btn-primary-custom rounded-xl shadow-lg text-white">
                                Log In
                            </button>

                            <p class="helper-text">
                                New to E-Canteen? <a href="javascript:void(0)" @click="isFlipped = true" class="action-link">Sign Up</a> below.
                            </p>
                        </form>
                    </div>
                </div>

                <!-- BACK: REGISTER CARD -->
                <div class="flip-card-back glass-card shadow-2xl">
                    
                    <!-- Form Side (Left) -->
                    <div class="w-2/3 p-10 flex flex-col justify-center form-side">
                        <h2 class="heading-register mb-5 text-center text-white">Register</h2>
                        
                        <form method="POST" action="{{ route('register') }}" class="grid grid-cols-2 gap-4">
                            @csrf
                            
                            <!-- Full Name -->
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-user input-icon"></i>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required 
                                    class="w-full input-field-custom rounded-xl pl-12 py-3 outline-none"
                                    placeholder="Full Name">
                                <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-200" />
                            </div>

                            <!-- Student ID -->
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card input-icon"></i>
                                </div>
                                <input id="student_id" type="text" name="student_id" value="{{ old('student_id') }}" required 
                                    class="w-full input-field-custom rounded-xl pl-12 py-3 outline-none"
                                    placeholder="Student ID">
                            </div>

                            <!-- Email Address -->
                            <div class="relative group col-span-2">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope input-icon"></i>
                                </div>
                                <input id="reg_email" type="email" name="email" value="{{ old('email') }}" required 
                                    class="w-full input-field-custom rounded-xl pl-12 py-3 outline-none"
                                    placeholder="Email Address">
                                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-200" />
                            </div>

                            <!-- Grade Level -->
                            <div class="relative group col-span-2">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-graduation-cap input-icon"></i>
                                </div>
                                <select class="w-full input-field-custom rounded-xl pl-12 py-3 appearance-none outline-none cursor-pointer">
                                    <option value="" disabled selected class="bg-[#5a77de]">Grade Level</option>
                                    <option value="10" class="bg-[#5a77de]">Grade 10</option>
                                    <option value="11" class="bg-[#5a77de]">Grade 11</option>
                                    <option value="12" class="bg-[#5a77de]">Grade 12</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-xs input-icon"></i>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-key input-icon"></i>
                                </div>
                                <input id="reg_password" type="password" name="password" required 
                                    class="w-full input-field-custom rounded-xl pl-12 py-3 outline-none"
                                    placeholder="Password">
                            </div>

                            <!-- Confirm Password -->
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-check-circle input-icon"></i>
                                </div>
                                <input id="reg_password_confirmation" type="password" name="password_confirmation" required 
                                    class="w-full input-field-custom rounded-xl pl-12 py-3 outline-none"
                                    placeholder="Confirm Password">
                            </div>

                            <!-- User Type Selection -->
                            <div class="col-span-2 space-y-2">
                                <p class="section-label">Select User Type:</p>
                                <div class="flex gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="user_type" value="student" checked class="w-4 h-4 text-[#323955] bg-white/20 border-white/30 focus:ring-white/50">
                                        <span style="font-family: var(--font-body); font-size: 0.85rem; font-weight: 500; color: rgba(255,255,255,0.85);">Student</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="user_type" value="faculty" class="w-4 h-4 text-[#323955] bg-white/20 border-white/30 focus:ring-white/50">
                                        <span style="font-family: var(--font-body); font-size: 0.85rem; font-weight: 500; color: rgba(255,255,255,0.85);">Faculty/Staff</span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label class="flex items-center gap-2 cursor-pointer group">
                                    <input type="checkbox" required class="w-4 h-4 text-[#323955] bg-white/20 border-white/30 rounded focus:ring-white/50">
                                    <span style="font-family: var(--font-body); font-size: 0.78rem; color: rgba(255,255,255,0.65);">
                                        I agree to the <a href="#" class="text-white font-bold underline underline-offset-2">Terms & Conditions</a>.
                                    </span>
                                </label>
                            </div>

                            <div class="col-span-2 mt-1">
                                <button type="submit" class="w-full py-4 btn-primary-custom rounded-xl shadow-lg text-white">
                                    Register
                                </button>
                                <p class="helper-text">
                                    Already have an account? <a href="javascript:void(0)" @click="isFlipped = false" class="action-link">Log In</a> above.
                                </p>
                            </div>
                        </form>
                    </div>

                    <!-- Info Panel (Right) -->
                    <div class="w-1/3 p-0">
                        <div class="info-panel info-panel-right w-full">
                            <div class="info-panel-logo">
                                <div class="info-panel-logo-icon"><i class="fas fa-utensils"></i></div>
                            </div>
                            <div class="info-panel-badge">
                                <i class="fas fa-user-plus"></i> Daftar Sekarang
                            </div>
                            <h2 class="info-panel-headline" style="font-size:1.2rem;">Bergabung &<br>Mulai <span>Pesan</span>.</h2>
                            <p class="info-panel-desc">
                                Buat akun gratis dan nikmati kemudahan memesan makanan di kantin sekolahmu.
                            </p>
                            <ul class="info-panel-features">
                                <li>
                                    <span class="feat-icon"><i class="fas fa-shield-halved"></i></span>
                                    <span>Akun aman dengan verifikasi</span>
                                </li>
                                <li>
                                    <span class="feat-icon"><i class="fas fa-graduation-cap"></i></span>
                                    <span>Role Student & Faculty tersedia</span>
                                </li>
                                <li>
                                    <span class="feat-icon"><i class="fas fa-chart-bar"></i></span>
                                    <span>Riwayat pesanan lengkap</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

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