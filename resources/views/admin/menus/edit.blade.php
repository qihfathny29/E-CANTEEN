@extends('layouts.admin')
@section('title', 'Edit Menu')
@section('page-styles')
        /* PAGE */
        .page-wrap{max-width:640px;margin:0 auto;padding:2rem;}
        .page-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1.75rem;flex-wrap:wrap;gap:1rem;}
        .page-header h1{font-family:var(--font-d);font-size:1.4rem;font-weight:800;color:var(--text);letter-spacing:-.03em;}
        .page-header p{font-size:.85rem;color:var(--text-muted);margin-top:.25rem;}

        /* BUTTONS */
        .btn-red{display:inline-flex;align-items:center;gap:.45rem;font-family:var(--font-d);font-size:.875rem;font-weight:700;color:white;background:var(--red);border:none;border-radius:.55rem;padding:.6rem 1.4rem;text-decoration:none;cursor:pointer;transition:all .2s;}
        .btn-red:hover{background:var(--red-h);transform:translateY(-1px);box-shadow:0 6px 18px rgba(192,57,43,.4);}
        .btn-outline{display:inline-flex;align-items:center;gap:.45rem;font-family:var(--font-d);font-size:.875rem;font-weight:600;color:var(--text-sub);background:transparent;border:1px solid var(--border-md);border-radius:.55rem;padding:.6rem 1.25rem;text-decoration:none;cursor:pointer;transition:all .2s;}
        .btn-outline:hover{color:var(--text);background:var(--bg-card2);}

        /* FLASH */
        .flash{border-radius:.75rem;padding:.85rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;display:flex;align-items:flex-start;gap:.65rem;}
        .flash-error{background:rgba(192,57,43,.10);border:1px solid rgba(192,57,43,.30);color:var(--red-h);}
        .flash ul{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.2rem;}

        /* FORM CARD */
        .form-card{background:var(--bg-card);border:1px solid var(--border);border-radius:1rem;padding:1.75rem;transition:background .3s;}
        .form-group{margin-bottom:1.35rem;}
        .form-label{display:block;font-family:var(--font-d);font-size:.8rem;font-weight:700;color:var(--text-sub);letter-spacing:.02em;margin-bottom:.55rem;}
        .form-input{width:100%;background:var(--input-bg);border:1px solid var(--border-md);border-radius:.6rem;color:var(--text);padding:.7rem 1rem;font-size:.9rem;font-family:var(--font-b);outline:none;transition:border .2s,background .2s,box-shadow .2s;}
        .form-input:focus{border-color:rgba(192,57,43,.65);background:var(--input-bg-f);box-shadow:0 0 0 3px rgba(192,57,43,.12);}
        .form-input::placeholder{color:var(--text-muted);}
        .form-select{width:100%;background:var(--input-bg);border:1px solid var(--border-md);border-radius:.6rem;color:var(--text);padding:.7rem 1rem;font-size:.9rem;font-family:var(--font-b);outline:none;cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,0.4)' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 1rem center;transition:border .2s,box-shadow .2s;}
        .form-select:focus{border-color:rgba(192,57,43,.65);box-shadow:0 0 0 3px rgba(192,57,43,.12);}
        html[data-theme="light"] .form-select{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='rgba(0,0,0,0.4)' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");}
        html[data-theme="light"] select option{background:#ffffff;color:#0f0f0f;}

        /* CURRENT PHOTO */
        .current-photo-wrap{display:flex;align-items:center;gap:1rem;padding:.85rem;background:var(--bg-card2);border:1px solid var(--border);border-radius:.6rem;margin-bottom:.75rem;}
        .current-photo-wrap img{width:60px;height:60px;object-fit:cover;border-radius:.45rem;border:1px solid var(--border-md);display:block;flex-shrink:0;}
        .current-photo-info{font-size:.8rem;}
        .current-photo-info p{color:var(--text-sub);font-weight:500;margin-bottom:.15rem;}
        .current-photo-info span{color:var(--text-muted);}

        /* FILE UPLOAD */
        .file-drop-zone{border:1.5px dashed var(--border-md);border-radius:.75rem;background:var(--input-bg);cursor:pointer;transition:all .2s;position:relative;overflow:hidden;}
        .file-drop-zone:hover{border-color:rgba(192,57,43,.55);background:var(--input-bg-f);}
        .drop-placeholder{padding:1.5rem 1rem;text-align:center;}
        .drop-placeholder i{font-size:1.5rem;color:var(--text-muted);display:block;margin-bottom:.5rem;}
        .drop-placeholder p{font-size:.85rem;font-weight:500;color:var(--text-sub);margin-bottom:.2rem;}
        .drop-placeholder span{font-size:.75rem;color:var(--text-muted);}
        .file-input-hidden{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
        .new-preview-wrap{padding:1rem;display:flex;align-items:center;justify-content:center;}
        .preview-img{max-height:140px;max-width:100%;border-radius:.6rem;border:1px solid var(--border-md);display:block;}

        /* INPUT WITH PREFIX */
        .input-prefix-group{position:relative;display:flex;align-items:center;}
        .input-prefix{position:absolute;left:1rem;font-size:.85rem;font-weight:700;color:var(--text-muted);pointer-events:none;font-family:var(--font-d);}
        .input-prefix-group .form-input{padding-left:2.8rem;}

        /* FORM ACTIONS */
        .form-actions{display:flex;gap:.75rem;margin-top:1.75rem;padding-top:1.5rem;border-top:1px solid var(--border);}
@endsection
@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1>Edit Menu</h1>
            <p>Ubah detail untuk menu <strong>{{ $menu->nama_menu }}</strong>.</p>
        </div>
        <a href="{{ route('admin.menus.index') }}" class="btn-outline">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="flash flash-error">
            <i class="fas fa-circle-exclamation" style="margin-top:.1rem;flex-shrink:0;"></i>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}"
                       class="form-input" placeholder="Contoh: Nasi Goreng Special">
            </div>

            <div class="form-group">
                <label class="form-label">Harga</label>
                <div class="input-prefix-group">
                    <span class="input-prefix">Rp</span>
                    <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}"
                           class="form-input" placeholder="Contoh: 12000" min="0">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Menu</label>

                @if($menu->foto)
                <div class="current-photo-wrap">
                    <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama_menu }}">
                    <div class="current-photo-info">
                        <p>Foto saat ini</p>
                        <span>Upload foto baru di bawah untuk menggantinya</span>
                    </div>
                </div>
                @endif

                <div class="file-drop-zone" id="drop-zone">
                    <div class="new-preview-wrap" id="preview-wrap" style="display:none;">
                        <img id="img-preview" src="" alt="" class="preview-img">
                    </div>
                    <div class="drop-placeholder" id="drop-placeholder">
                        <i class="fas fa-cloud-arrow-up"></i>
                        <p>{{ $menu->foto ? 'Klik untuk ganti foto' : 'Klik untuk pilih foto' }}</p>
                        <span>JPG, JPEG, PNG · Maks 2MB</span>
                    </div>
                    <input type="file" name="foto" id="foto-input" accept="image/*" class="file-input-hidden">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="tersedia" {{ old('status', $menu->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="habis" {{ old('status', $menu->status) === 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-red">
                    <i class="fas fa-floppy-disk"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.menus.index') }}" class="btn-outline">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
@section('page-scripts')
<script>
    // Photo preview
    document.getElementById('foto-input').addEventListener('change', function() {
        var file = this.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('img-preview').src = e.target.result;
            document.getElementById('preview-wrap').style.display = 'flex';
            document.getElementById('drop-placeholder').style.display = 'none';
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection