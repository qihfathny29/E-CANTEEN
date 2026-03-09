@extends('layouts.admin')
@section('title', 'Tambah User')

@section('page-styles')
        .page-wrap{padding:2rem;max-width:640px;}
        .back-link{display:inline-flex;align-items:center;gap:.45rem;font-family:var(--font-d);font-size:.8rem;font-weight:600;color:var(--text-muted);text-decoration:none;margin-bottom:1.4rem;transition:color .18s;}
        .back-link:hover{color:var(--text);}
        .page-heading{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);margin-bottom:1.5rem;}

        .form-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1.1rem;padding:1.75rem 1.5rem;}
        .form-group{margin-bottom:1.2rem;}
        .form-label{display:block;font-family:var(--font-d);font-size:.78rem;font-weight:700;color:var(--text-muted);margin-bottom:.45rem;letter-spacing:.03em;}
        .form-control{width:100%;padding:.6rem .85rem;background:var(--bg-card2);border:1px solid var(--border);border-radius:.6rem;color:var(--text);font-size:.88rem;font-family:var(--font-b);transition:border-color .18s,box-shadow .18s;box-sizing:border-box;}
        .form-control:focus{outline:none;border-color:var(--red);box-shadow:0 0 0 3px rgba(192,57,43,.15);}
        .form-control::placeholder{color:var(--text-muted);}
        .invalid-feedback{font-family:var(--font-d);font-size:.75rem;color:#f87171;margin-top:.35rem;}

        /* Radio group */
        .radio-group{display:flex;gap:.6rem;flex-wrap:wrap;}
        .radio-card{position:relative;}
        .radio-card input[type="radio"]{position:absolute;opacity:0;pointer-events:none;}
        .radio-card label{display:flex;align-items:center;gap:.5rem;padding:.55rem 1.1rem;background:var(--bg-card2);border:1px solid var(--border);border-radius:.6rem;font-family:var(--font-d);font-size:.82rem;font-weight:700;color:var(--text-muted);cursor:pointer;transition:all .18s;}
        .radio-card input[type="radio"]:checked + label{border-color:var(--red);color:var(--text);background:rgba(192,57,43,.1);}

        .divider{border:none;border-top:1px solid var(--border);margin:1.4rem 0;}
        .form-hint{font-family:var(--font-d);font-size:.75rem;color:var(--text-muted);margin-top:.35rem;}

        .btn-row{display:flex;gap:.7rem;margin-top:1.6rem;flex-wrap:wrap;}
        .btn-submit{padding:.6rem 1.4rem;background:var(--red);color:white;border:none;border-radius:.6rem;font-family:var(--font-d);font-size:.85rem;font-weight:700;cursor:pointer;transition:background .18s;}
        .btn-submit:hover{background:var(--red-h);}
        .btn-cancel{padding:.6rem 1.2rem;background:transparent;color:var(--text-muted);border:1px solid var(--border);border-radius:.6rem;font-family:var(--font-d);font-size:.85rem;font-weight:700;text-decoration:none;transition:all .18s;}
        .btn-cancel:hover{border-color:var(--border-md);color:var(--text);}
@endsection

@section('content')
<div class="page-wrap">
    <a href="{{ route('admin.users.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar User
    </a>
    <div class="page-heading">Tambah User Baru</div>

    <div class="form-card">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            {{-- Nama --}}
            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap</label>
                <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="contoh@email.com" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Tipe user --}}
            <div class="form-group">
                <label class="form-label">Tipe User</label>
                <div class="radio-group">
                    <div class="radio-card">
                        <input type="radio" id="type_siswa" name="user_type" value="siswa" {{ old('user_type','siswa') === 'siswa' ? 'checked' : '' }}>
                        <label for="type_siswa"><i class="fas fa-user-graduate" style="font-size:.75rem;"></i> Siswa</label>
                    </div>
                    <div class="radio-card">
                        <input type="radio" id="type_guru" name="user_type" value="guru" {{ old('user_type') === 'guru' ? 'checked' : '' }}>
                        <label for="type_guru"><i class="fas fa-chalkboard-teacher" style="font-size:.75rem;"></i> Guru</label>
                    </div>
                </div>
                @error('user_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <hr class="divider">

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input id="password" type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Konfirmasi password --}}
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>

            <hr class="divider">

            {{-- Saldo awal --}}
            <div class="form-group">
                <label class="form-label" for="saldo">Saldo Awal (opsional)</label>
                <input id="saldo" type="number" name="saldo" class="form-control" value="{{ old('saldo', 0) }}" min="0" step="1000" placeholder="0">
                <div class="form-hint">Kosongkan atau isi 0 jika tidak ada saldo awal.</div>
                @error('saldo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="btn-row">
                <button type="submit" class="btn-submit"><i class="fas fa-plus" style="font-size:.75rem;"></i> Simpan User</button>
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
