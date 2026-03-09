@extends('layouts.user')
@section('title', 'Profil Saya')
@section('page-styles')
        .page-wrap{padding:2rem;}
        .page-header{margin-bottom:1.75rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.25rem;}

        .profile-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.75rem;margin-bottom:1.5rem;transition:background .3s;}

        /* AVATAR SECTION */
        .avatar-section{display:flex;align-items:center;gap:1.5rem;padding-bottom:1.5rem;margin-bottom:1.5rem;border-bottom:1px solid var(--border);}
        .avatar-wrap{position:relative;flex-shrink:0;}
        .avatar-img{width:88px;height:88px;border-radius:50%;object-fit:cover;display:block;border:2px solid var(--border-md);}
        .avatar-initials{width:88px;height:88px;border-radius:50%;background:var(--red);display:flex;align-items:center;justify-content:center;font-family:var(--font-d);font-size:1.6rem;font-weight:800;color:white;border:2px solid var(--border-md);}
        .avatar-change-btn{position:absolute;bottom:0;right:0;width:28px;height:28px;border-radius:50%;background:var(--bg-card2);border:1.5px solid var(--border-md);color:var(--text-sub);display:flex;align-items:center;justify-content:center;font-size:.7rem;cursor:pointer;transition:all .2s;}
        .avatar-change-btn:hover{background:var(--red);border-color:var(--red);color:white;}
        .avatar-file-input{display:none;}
        .avatar-info h3{font-family:var(--font-d);font-size:1.05rem;font-weight:700;color:var(--text);margin-bottom:.25rem;}
        .avatar-info p{font-size:.82rem;color:var(--text-muted);}
        .avatar-info .role-badge{display:inline-block;font-family:var(--font-d);font-size:.68rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;background:rgba(192,57,43,.15);color:var(--red-h);border:1px solid rgba(192,57,43,.25);padding:.18rem .6rem;border-radius:100px;margin-top:.4rem;}

        /* FORM */
        .section-title{font-family:var(--font-d);font-size:.75rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:1rem;}
        .form-group{margin-bottom:1.2rem;}
        .form-label{display:block;font-family:var(--font-d);font-size:.8rem;font-weight:700;color:var(--text-sub);letter-spacing:.02em;margin-bottom:.5rem;}
        .form-input{width:100%;background:var(--input-bg);border:1px solid var(--border-md);border-radius:.6rem;color:var(--text);padding:.7rem 1rem;font-size:.9rem;font-family:var(--font-b);outline:none;transition:border .2s,background .2s,box-shadow .2s;}
        .form-input:focus{border-color:rgba(192,57,43,.65);background:var(--input-bg-f);box-shadow:0 0 0 3px rgba(192,57,43,.12);}
        .form-input::placeholder{color:var(--text-muted);}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
        @media(max-width:540px){.form-row{grid-template-columns:1fr;}}

        .divider{height:1px;background:var(--border);margin:1.5rem 0;}

        .btn-red{display:inline-flex;align-items:center;gap:.45rem;font-family:var(--font-d);font-size:.875rem;font-weight:700;color:white;background:var(--red);border:none;border-radius:.55rem;padding:.65rem 1.5rem;cursor:pointer;transition:all .2s;}
        .btn-red:hover{background:var(--red-h);transform:translateY(-1px);box-shadow:0 6px 18px rgba(192,57,43,.4);}

        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:center;gap:.65rem;}
        .flash-success{background:rgba(34,197,94,.10);border:1px solid rgba(34,197,94,.25);color:#4ade80;}
        .flash-error{background:rgba(192,57,43,.10);border:1px solid rgba(192,57,43,.30);color:var(--red-h);}
        .flash ul{list-style:none;padding:0;margin:0;}

        .new-avatar-row{display:flex;align-items:center;gap:.75rem;margin-top:.75rem;padding:.65rem .85rem;background:var(--bg-card2);border:1px solid var(--border-md);border-radius:.65rem;}
        .new-avatar-row img{width:44px;height:44px;border-radius:50%;object-fit:cover;display:block;flex-shrink:0;}
        .new-avatar-row p{font-size:.82rem;color:var(--text-sub);}
        .new-avatar-row span{font-size:.72rem;color:var(--text-muted);}
@endsection

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <h1>Profil Saya</h1>
        <p>Kelola informasi akun dan ubah foto profil kamu.</p>
    </div>

    @if(session('success'))
        <div class="flash flash-success">
            <i class="fas fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="flash flash-error">
            <i class="fas fa-circle-exclamation"></i>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="profile-card">
            {{-- AVATAR --}}
            <div class="avatar-section">
                <div class="avatar-wrap">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="avatar-img" id="avatar-display">
                    @else
                        @php
                            $parts = explode(' ', trim($user->name));
                            $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                        @endphp
                        <div class="avatar-initials" id="avatar-initials-display">{{ $initials }}</div>
                        <img src="" alt="" class="avatar-img" id="avatar-display" style="display:none;">
                    @endif
                    <label class="avatar-change-btn" for="avatar-input" title="Ganti foto">
                        <i class="fas fa-camera"></i>
                    </label>
                    <input type="file" name="avatar" id="avatar-input" accept="image/*" class="avatar-file-input">
                </div>
                <div class="avatar-info">
                    <h3>{{ $user->name }}</h3>
                    <p>{{ $user->email }}</p>
                    @php
                        $typeLabel = match($user->user_type ?? '') {
                            'guru'  => 'Guru / Staff',
                            'siswa' => 'Siswa',
                            default => 'Pengguna',
                        };
                    @endphp
                    <span class="role-badge">{{ $typeLabel }}</span>
                </div>
            </div>

            {{-- NEW AVATAR PREVIEW --}}
            <div class="new-avatar-row" id="new-avatar-preview" style="display:none;">
                <img src="" alt="" id="new-avatar-preview-img">
                <div>
                    <p>Foto baru dipilih</p>
                    <span>Klik Simpan untuk menerapkan perubahan</span>
                </div>
            </div>

            {{-- PROFILE INFO --}}
            <p class="section-title" style="margin-top:1.5rem;">Informasi Akun</p>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-input"
                           value="{{ old('name', $user->name) }}" placeholder="Nama lengkap" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-input"
                           value="{{ old('email', $user->email) }}" placeholder="email@domain.com" required>
                </div>
            </div>

            <div class="divider"></div>

            <p class="section-title">Ubah Password <span style="font-weight:400;letter-spacing:0;color:var(--text-muted);font-size:.7rem;text-transform:none;">(kosongkan jika tidak ingin diubah)</span></p>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="password">Password Baru</label>
                    <input type="password" id="password" name="password" class="form-input"
                           placeholder="Min. 8 karakter" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-input" placeholder="Ulangi password baru" autocomplete="new-password">
                </div>
            </div>

            <div style="margin-top:.5rem;">
                <button type="submit" class="btn-red">
                    <i class="fas fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </div>

    </form>
</div>
@endsection

@section('page-scripts')
<script>
    document.getElementById('avatar-input').addEventListener('change', function() {
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            var src = e.target.result;
            var img = document.getElementById('avatar-display');
            var initials = document.getElementById('avatar-initials-display');
            img.src = src;
            img.style.display = 'block';
            if (initials) initials.style.display = 'none';
            document.getElementById('new-avatar-preview-img').src = src;
            document.getElementById('new-avatar-preview').style.display = 'flex';
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
