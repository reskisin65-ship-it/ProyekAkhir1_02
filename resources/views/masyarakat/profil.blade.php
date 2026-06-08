@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.08);
        --dark: #0f172a;
        --gray: #64748b;
        --gray-soft: #f1f5f9;
        --bg: #fafbfc;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.03);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.05);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.08);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.1);
        --transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--dark);
    }

    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        opacity: 0.3;
    }

    .container-premium {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        color: var(--gray);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 1.5rem;
        transition: var(--transition);
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 40px;
        border: 1px solid var(--border);
    }

    .back-button:hover {
        color: var(--primary);
        transform: translateX(-4px);
        border-color: var(--primary);
    }

    .profile-card {
        background: white;
        border-radius: 32px;
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition-bounce);
    }

    .profile-card:hover {
        box-shadow: var(--shadow-xl);
    }

    .profile-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '👤';
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 7rem;
        opacity: 0.1;
        pointer-events: none;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        background: white;
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-lg);
        transition: var(--transition-bounce);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .profile-avatar:hover {
        transform: scale(1.05);
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-avatar i {
        font-size: 2.5rem;
        color: var(--primary);
    }

    .avatar-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition);
    }

    .profile-avatar:hover .avatar-overlay {
        opacity: 1;
    }

    .avatar-overlay i {
        color: white;
        font-size: 1.2rem;
    }

    .profile-tabs {
        display: flex;
        gap: 0.5rem;
        background: var(--gray-soft);
        padding: 0.25rem;
        border-radius: 60px;
        margin-bottom: 2rem;
    }

    .profile-tab {
        flex: 1;
        padding: 0.8rem;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        color: var(--gray);
    }

    .profile-tab.active {
        background: white;
        color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        margin-bottom: 0.6rem;
    }

    .form-label i {
        color: var(--primary);
    }

    .form-input {
        width: 100%;
        padding: 0.9rem 1rem;
        background: var(--bg);
        border: 1.5px solid var(--border);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--dark);
        transition: var(--transition);
        outline: none;
    }

    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-soft);
        background: white;
    }

    .form-input.readonly {
        background: var(--gray-soft);
        color: var(--gray);
        cursor: not-allowed;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        width: 100%;
        padding: 0.9rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: white;
        transition: var(--transition-bounce);
        cursor: pointer;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .alert-premium {
        margin-bottom: 1.5rem;
        padding: 1rem 1.2rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        animation: slideInRight 0.4s ease;
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .alert-success {
        background: #ecfdf5;
        border-left: 3px solid var(--primary);
        color: #059669;
    }

    .alert-error {
        background: #fef2f2;
        border-left: 3px solid #ef4444;
        color: #dc2626;
    }

    .alert-close {
        cursor: pointer;
        opacity: 0.6;
        transition: var(--transition);
        padding: 0.25rem;
        border-radius: 10px;
    }

    .alert-close:hover { opacity: 1; background: rgba(0,0,0,0.05); }

    .tips-card {
        margin-top: 1rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 20px;
        padding: 1rem;
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .profile-header { padding: 1.5rem; text-align: center; }
        .profile-avatar { margin: 0 auto 1rem; }
        .profile-tabs { flex-direction: column; border-radius: 28px; }
        .profile-tab { text-align: center; }
    }

    [x-cloak] { display: none !important; }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    <a href="{{ url()->previous() }}" class="back-button animate__animated animate__fadeIn">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>

    @if(session('success'))
    <div class="alert-premium alert-success animate__animated animate__fadeInUp">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        <div class="alert-close" onclick="this.parentElement.remove()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="alert-premium alert-error animate__animated animate__fadeInUp">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>Terjadi kesalahan. Silakan periksa kembali.</span>
        </div>
        <div class="alert-close" onclick="this.parentElement.remove()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    @endif

    <div class="profile-card animate__animated animate__fadeInUp">
        <div class="profile-header">
            <div>
                <form action="{{ route('masyarakat.profil.foto') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                    @csrf
                    <div class="profile-avatar" onclick="document.getElementById('avatar_input').click()">
                        @if($user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="{{ $user->name }}">
                        @else
                            <i class="fa-regular fa-user"></i>
                        @endif
                        <div class="avatar-overlay">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                    </div>
                    <input type="file" name="foto_profil" id="avatar_input" class="hidden" accept="image/*" onchange="this.form.submit()">
                </form>
                <h2 class="text-2xl font-bold text-white mb-1">{{ $user->name }}</h2>
                <p class="text-emerald-100 text-sm flex items-center gap-2">
                    <i class="fa-regular fa-envelope"></i> {{ $user->email }}
                </p>
                @if($user->role)
                <p class="text-emerald-100/70 text-xs mt-1 flex items-center gap-1">
                    @if($user->role->nama_role == 'umkm')
                        🛍️ Pemilik UMKM
                    @else
                        👤 Warga Masyarakat
                    @endif
                </p>
                @endif
            </div>
        </div>

        <div class="p-8">
            <div class="profile-tabs" id="profileTabs">
                <button type="button" id="tabProfile" class="profile-tab active">
                    <i class="fa-regular fa-user mr-2"></i> Informasi Pribadi
                </button>
                <button type="button" id="tabPassword" class="profile-tab">
                    <i class="fa-solid fa-lock mr-2"></i> Ubah Password
                </button>
            </div>

            <div id="profileSection">
                <form action="{{ route('masyarakat.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-user"></i> Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-input">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-envelope"></i> Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-input">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-phone"></i> Nomor Telepon</label>
                        <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon', $user->nomor_telepon) }}" class="form-input" placeholder="Contoh: 08123456789">
                        @error('nomor_telepon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-location-dot"></i> Alamat</label>
                        <textarea name="alamat" rows="3" class="form-input" placeholder="Masukkan alamat lengkap Anda">{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <h3 class="text-base font-bold text-gray-800 mb-3">Data Kependudukan</h3>
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="form-label"><i class="fa-solid fa-id-card"></i> NIK</label>
                                <input type="text" name="nik" value="{{ old('nik', $dataPenduduk?->nik ?? '') }}" class="form-input" placeholder="16 digit NIK">
                                @error('nik')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-regular fa-user"></i> Nama Sesuai KTP</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $dataPenduduk?->nama_lengkap ?? $user->name) }}" class="form-input" placeholder="Nama lengkap sesuai KTP">
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-venus-mars"></i> Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-input">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $dataPenduduk?->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $dataPenduduk?->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-map-pin"></i> Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $dataPenduduk?->tempat_lahir ?? '') }}" class="form-input" placeholder="Tempat lahir">
                                @error('tempat_lahir')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-regular fa-calendar-days"></i> Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($dataPenduduk?->tanggal_lahir)->format('Y-m-d') ?? '') }}" class="form-input">
                                @error('tanggal_lahir')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-church"></i> Agama</label>
                                <select name="agama" class="form-input">
                                    <option value="">Pilih agama</option>
                                    <option value="Islam" {{ old('agama', $dataPenduduk?->agama ?? '') === 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $dataPenduduk?->agama ?? '') === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $dataPenduduk?->agama ?? '') === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $dataPenduduk?->agama ?? '') === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $dataPenduduk?->agama ?? '') === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $dataPenduduk?->agama ?? '') === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    <option value="Lainnya" {{ old('agama', $dataPenduduk?->agama ?? '') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('agama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-graduation-cap"></i> Pendidikan</label>
                                <input type="text" name="pendidikan" value="{{ old('pendidikan', $dataPenduduk?->pendidikan ?? '') }}" class="form-input" placeholder="Pendidikan terakhir">
                                @error('pendidikan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-briefcase"></i> Pekerjaan</label>
                                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $dataPenduduk?->pekerjaan ?? '') }}" class="form-input" placeholder="Pekerjaan">
                                @error('pekerjaan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-ring"></i> Status Perkawinan</label>
                                <select name="status_perkawinan" class="form-input">
                                    <option value="">Pilih status perkawinan</option>
                                    <option value="Belum Menikah" {{ old('status_perkawinan', $dataPenduduk?->status_perkawinan ?? '') === 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ old('status_perkawinan', $dataPenduduk?->status_perkawinan ?? '') === 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Cerai Hidup" {{ old('status_perkawinan', $dataPenduduk?->status_perkawinan ?? '') === 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old('status_perkawinan', $dataPenduduk?->status_perkawinan ?? '') === 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                                @error('status_perkawinan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-location-dot"></i> Kelurahan / Desa</label>
                                <input type="text" name="kelurahan_desa" value="{{ old('kelurahan_desa', $dataPenduduk?->kelurahan_desa ?? '') }}" class="form-input" placeholder="Kelurahan / Desa">
                                @error('kelurahan_desa')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-road"></i> Kecamatan</label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan', $dataPenduduk?->kecamatan ?? '') }}" class="form-input" placeholder="Kecamatan">
                                @error('kecamatan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-city"></i> Kabupaten / Kota</label>
                                <input type="text" name="kabupaten_kota" value="{{ old('kabupaten_kota', $dataPenduduk?->kabupaten_kota ?? '') }}" class="form-input" placeholder="Kabupaten / Kota">
                                @error('kabupaten_kota')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-map"></i> Provinsi</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi', $dataPenduduk?->provinsi ?? '') }}" class="form-input" placeholder="Provinsi">
                                @error('provinsi')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-users"></i> Status Keluarga</label>
                                <select name="status_keluarga" class="form-input">
                                    <option value="">Pilih status keluarga</option>
                                    <option value="Kepala Keluarga" {{ old('status_keluarga', $dataPenduduk?->status_keluarga ?? '') === 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                    <option value="Istri" {{ old('status_keluarga', $dataPenduduk?->status_keluarga ?? '') === 'Istri' ? 'selected' : '' }}>Istri</option>
                                    <option value="Anak" {{ old('status_keluarga', $dataPenduduk?->status_keluarga ?? '') === 'Anak' ? 'selected' : '' }}>Anak</option>
                                    <option value="Anggota Keluarga" {{ old('status_keluarga', $dataPenduduk?->status_keluarga ?? '') === 'Anggota Keluarga' ? 'selected' : '' }}>Anggota Keluarga</option>
                                    <option value="Lainnya" {{ old('status_keluarga', $dataPenduduk?->status_keluarga ?? '') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('status_keluarga')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label"><i class="fa-solid fa-credit-card"></i> No. KK</label>
                                <input type="text" name="no_kk" value="{{ old('no_kk', $dataPenduduk?->no_kk ?? '') }}" class="form-input" placeholder="Nomor KK">
                                @error('no_kk')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-location-dot"></i> Alamat Kependudukan</label>
                        <textarea name="alamat_penduduk" rows="3" class="form-input" placeholder="Alamat sesuai data kependudukan">{{ old('alamat_penduduk', $dataPenduduk?->alamat ?? '') }}</textarea>
                        @error('alamat_penduduk')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-calendar"></i> Bergabung Sejak</label>
                        <input type="text" value="{{ $user->created_at->translatedFormat('d F Y') }}" readonly class="form-input readonly">
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fa-regular fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>

            <div id="passwordSection" class="hidden">
                <form action="{{ route('masyarakat.profil.password') }}" method="POST" x-data="{ showOld: false, showNew: false, showConfirm: false }">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-lock"></i> Password Lama</label>
                        <div class="relative">
                            <input :type="showOld ? 'text' : 'password'" name="current_password" required class="form-input pr-12" placeholder="Masukkan password lama Anda">
                            <button type="button" @click="showOld = !showOld" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-emerald-600 transition-colors focus:outline-none">
                                <i :class="showOld ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-key"></i> Password Baru</label>
                        <div class="relative">
                            <input :type="showNew ? 'text' : 'password'" name="new_password" required class="form-input pr-12" placeholder="Minimal 6 karakter">
                            <button type="button" @click="showNew = !showNew" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-emerald-600 transition-colors focus:outline-none">
                                <i :class="showNew ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                            </button>
                        </div>
                        @error('new_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-check-circle"></i> Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input :type="showConfirm ? 'text' : 'password'" name="new_password_confirmation" required class="form-input pr-12" placeholder="Ulangi password baru Anda">
                            <button type="button" @click="showConfirm = !showConfirm" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-emerald-600 transition-colors focus:outline-none">
                                <i :class="showConfirm ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                            </button>
                        </div>
                    </div>

                    <div class="tips-card">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-shield-alt text-emerald-500 text-lg mt-0.5"></i>
                            <div>
                                <p class="text-sm font-bold text-emerald-800">Tips Keamanan:</p>
                                <ul class="text-xs text-emerald-700 mt-1 space-y-1">
                                    <li>• Gunakan minimal 6 karakter</li>
                                    <li>• Kombinasikan huruf besar, huruf kecil, dan angka</li>
                                    <li>• Jangan gunakan password yang sama dengan akun lain</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-key"></i> Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-6 text-center">
        <p class="text-xs text-gray-400">
            <i class="fa-regular fa-circle-question mr-1"></i> 
            Klik foto profil untuk mengganti avatar | Semua perubahan akan langsung tersimpan
        </p>
    </div>

</div>

<script>
    setTimeout(() => {
        document.querySelectorAll('.alert-premium').forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(20px)';
            setTimeout(() => alert.remove(), 300);
        });
    }, 4000);

    document.addEventListener('DOMContentLoaded', function () {
        const tabProfile = document.getElementById('tabProfile');
        const tabPassword = document.getElementById('tabPassword');
        const profileSection = document.getElementById('profileSection');
        const passwordSection = document.getElementById('passwordSection');

        function setTab(tab) {
            if (tab === 'profile') {
                tabProfile.classList.add('active');
                tabPassword.classList.remove('active');
                profileSection.classList.remove('hidden');
                passwordSection.classList.add('hidden');
            } else {
                tabProfile.classList.remove('active');
                tabPassword.classList.add('active');
                profileSection.classList.add('hidden');
                passwordSection.classList.remove('hidden');
            }
        }

        tabProfile.addEventListener('click', () => setTab('profile'));
        tabPassword.addEventListener('click', () => setTab('password'));
        setTab('profile');
    });
</script>
@endsection
