{{-- resources/views/admin/profil-desa/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Profil Desa - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Instrument+Sans:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --system-bg: #0a0a0a;
        --card-bg: #ffffff;
        --accent-primary: #10b981;
        --accent-yellow: #f59e0b;
        --accent-blue: #3b82f6;
        --accent-purple: #8b5cf6;
        --accent-red: #ef4444;
        --text-main: #171717;
        --text-mute: #737373;
        --border-color: #f1f1f1;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #fafafa;
        color: var(--text-main);
        letter-spacing: -0.02em;
    }

    .font-display { font-family: 'Instrument Sans', sans-serif; }

    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        mask-image: radial-gradient(ellipse at center, black, transparent 80%);
    }

    .dashboard-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 2rem;
    }

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1.2rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-mute);
        text-decoration: none;
        transition: all 0.3s;
        margin-bottom: 2rem;
    }

    .back-link:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
        transform: translateX(-4px);
    }

    /* Form Card */
    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 32px;
        overflow: hidden;
        transition: all 0.4s;
    }

    .form-card:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .form-header {
        background: linear-gradient(135deg, var(--system-bg), var(--system-bg));
        padding: 1.5rem 2rem;
        color: white;
    }

    .form-header h1 {
        font-size: 1.4rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .form-header p {
        color: rgba(255,255,255,0.6);
        font-size: 0.8rem;
        margin-top: 0.3rem;
    }

    .form-body {
        padding: 2rem;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
        margin-bottom: 0.5rem;
    }

    .form-label i {
        color: var(--accent-primary);
        margin-right: 0.3rem;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 0.2rem;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1.5px solid var(--border-color);
        border-radius: 16px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 4px rgba(16,185,129,0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    /* Section Title */
    .section-title {
        font-size: 1rem;
        font-weight: 700;
        margin: 1.5rem 0 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: var(--accent-primary);
    }

    .section-title:first-of-type {
        margin-top: 0;
    }

    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    /* Current Photo */
    .current-photo {
        margin-bottom: 1rem;
        padding: 0.8rem;
        background: #f8fafc;
        border-radius: 16px;
        text-align: center;
    }

    .current-photo img {
        max-height: 80px;
        border-radius: 12px;
        margin-bottom: 0.3rem;
    }

    .current-photo p {
        font-size: 0.65rem;
        color: var(--text-mute);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .btn-primary {
        padding: 0.75rem 1.8rem;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-primary));
        color: white;
        border: none;
        border-radius: 60px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16,185,129,0.3);
    }

    .btn-secondary {
        padding: 0.75rem 1.8rem;
        background: transparent;
        border: 1.5px solid var(--border-color);
        color: var(--text-mute);
        border-radius: 60px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-secondary:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
        transform: translateY(-2px);
        background: #ecfdf5;
    }

    /* Alert Error */
    .alert-error {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #fef2f2;
        border-left: 3px solid #ef4444;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #dc2626;
    }

    /* Animations */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-up { animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-wrapper { padding: 1rem; }
        .form-body { padding: 1.2rem; }
        .form-header { padding: 1rem 1.2rem; }
        .form-header h1 { font-size: 1.2rem; }
        .form-grid { grid-template-columns: 1fr; }
        .action-buttons { flex-direction: column; }
        .btn-primary, .btn-secondary { justify-content: center; }
    }
</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Back Button --}}
    <a href="{{ route('admin.profil-desa.index') }}" class="back-link animate-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Profil Desa
    </a>

    {{-- Form Card --}}
    <div class="form-card animate-up delay-1">
        <div class="form-header">
            <h1>
                <i class="fa-solid fa-pen"></i>
                Edit Profil Desa
            </h1>
            <p>Perbarui informasi profil desa Lumban Silintong</p>
        </div>
        
        <div class="form-body">
            {{-- Error Alert --}}
            @if($errors->any())
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin-left: 1rem; margin-top: 0.3rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{ route('admin.profil-desa.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                {{-- Sejarah --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-clock"></i> Sejarah Desa
                    </label>
                    <textarea name="sejarah" rows="5" class="form-control" placeholder="Tuliskan sejarah berdirinya Desa Lumban Silintong...">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
                    <p class="text-xs text-gray-400 mt-1">Tuliskan sejarah desa secara lengkap dan informatif</p>
                </div>
                
                {{-- Visi & Misi --}}
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-eye"></i> Visi
                        </label>
                        <textarea name="visi" rows="4" class="form-control" placeholder="Visi desa...">{{ old('visi', $profil->visi ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-flag-checkered"></i> Misi
                        </label>
                        <textarea name="misi" rows="4" class="form-control" placeholder="Misi desa (pisahkan dengan baris baru)...">{{ old('misi', $profil->misi ?? '') }}</textarea>
                    </div>
                </div>
                
                {{-- Foto --}}
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-building"></i> Foto Kantor Desa
                        </label>
                        @if($profil && $profil->foto_kantor)
                        <div class="current-photo">
                            <img src="{{ asset('storage/' . $profil->foto_kantor) }}" alt="Foto Kantor">
                            <p>Foto saat ini</p>
                        </div>
                        @endif
                        <input type="file" name="foto_kantor" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-image"></i> Foto Kegiatan
                        </label>
                        @if($profil && $profil->foto_kegiatan)
                        <div class="current-photo">
                            <img src="{{ asset('storage/' . $profil->foto_kegiatan) }}" alt="Foto Kegiatan">
                            <p>Foto saat ini</p>
                        </div>
                        @endif
                        <input type="file" name="foto_kegiatan" class="form-control" accept="image/*">
                    </div>
                </div>
                
                {{-- Informasi Wilayah --}}
                <div class="section-title">
                    <i class="fa-solid fa-map"></i> Informasi Wilayah
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Luas Wilayah (km²)</label>
                        <input type="text" name="luas_wilayah" value="{{ old('luas_wilayah', $profil->luas_wilayah ?? '') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $profil->kecamatan ?? 'Balige') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kabupaten</label>
                        <input type="text" name="kabupaten" value="{{ old('kabupaten', $profil->kabupaten ?? 'Toba') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $profil->provinsi ?? 'Sumatera Utara') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tahun Berdiri</label>
                        <input type="text" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '1920') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah Dusun</label>
                        <input type="number" name="jumlah_dusun" value="{{ old('jumlah_dusun', $profil->jumlah_dusun ?? 6) }}" class="form-control">
                    </div>
                </div>
                
                {{-- Kontak & Alamat --}}
                <div class="section-title">
                    <i class="fa-regular fa-address-card"></i> Kontak & Alamat
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Alamat Kantor</label>
                        <textarea name="alamat_kantor" rows="2" class="form-control" placeholder="Alamat lengkap kantor desa">{{ old('alamat_kantor', $profil->alamat_kantor ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Desa</label>
                        <input type="email" name="email_desa" value="{{ old('email_desa', $profil->email_desa ?? '') }}" class="form-control" placeholder="desa@lumbansilintong.id">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Telepon Desa</label>
                        <input type="text" name="telepon_desa" value="{{ old('telepon_desa', $profil->telepon_desa ?? '') }}" class="form-control" placeholder="(0622) 123456">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Embed Google Maps</label>
                        <textarea name="maps_embed" rows="2" class="form-control" placeholder="URL embed Google Maps">{{ old('maps_embed', $profil->maps_embed ?? '') }}</textarea>
                    </div>
                </div>
                
                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <a href="{{ route('admin.profil-desa.index') }}" class="btn-secondary">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection