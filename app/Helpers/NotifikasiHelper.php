<?php

namespace App\Helpers;

use App\Models\Notifikasi;
use App\Models\User;

class NotifikasiHelper
{
    /**
     * Mengirim notifikasi ke semua admin
     */
    private static function sendToAdmins($jenis, $judul, $pesan, $link = null, $refId = null)
    {
        try {
            $admins = User::whereHas('role', function ($q) {
                $q->where('nama_role', 'admin');
            })->get();

            foreach ($admins as $admin) {
                Notifikasi::create([
                    'user_id' => $admin->user_id,
                    'jenis'   => $jenis,
                    'judul'   => $judul,
                    'pesan'   => $pesan,
                    'link'    => $link,
                    'ref_id'  => $refId,
                    'dibaca'  => false,
                ]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error sendToAdmins: ' . $e->getMessage());
        }
    }

    /**
     * Mengirim notifikasi ke user tertentu
     */
    private static function sendToUser($userId, $jenis, $judul, $pesan, $link = null, $refId = null)
    {
        try {
            Notifikasi::create([
                'user_id' => $userId,
                'jenis'   => $jenis,
                'judul'   => $judul,
                'pesan'   => $pesan,
                'link'    => $link,
                'ref_id'  => $refId,
                'dibaca'  => false,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error sendToUser: ' . $e->getMessage());
        }
    }

    /**
     * Notifikasi saat masyarakat mengirim aspirasi baru (untuk Admin)
     */
    public static function aspirasiBaru($userId, $judul, $kategori, $idAspirasi, $userName)
    {
        $link = route('admin.aspirasi.index');
        self::sendToAdmins(
            'aspirasi',
            'Aspirasi Baru Masuk',
            "Aspirasi baru dengan judul '$judul' (kategori: $kategori) telah dikirimkan oleh $userName.",
            $link,
            $idAspirasi
        );
    }

    /**
     * Notifikasi saat admin merespon/menjawab aspirasi (untuk Masyarakat)
     */
    public static function aspirasiDijawab($userId, $judul, $idAspirasi, $adminId)
    {
        $link = route('masyarakat.aspirasi.index');
        self::sendToUser(
            $userId,
            'aspirasi',
            'Aspirasi Telah Dijawab',
            "Aspirasi Anda dengan judul '$judul' telah selesai ditanggapi oleh admin.",
            $link,
            $idAspirasi
        );
    }

    /**
     * Notifikasi saat admin mengubah status aspirasi menjadi diproses (untuk Masyarakat)
     */
    public static function aspirasiDiproses($userId, $judul, $idAspirasi, $adminId)
    {
        $link = route('masyarakat.aspirasi.index');
        self::sendToUser(
            $userId,
            'aspirasi',
            'Aspirasi Sedang Diproses',
            "Aspirasi Anda dengan judul '$judul' sedang dalam proses tindak lanjut oleh admin.",
            $link,
            $idAspirasi
        );
    }

    /**
     * Notifikasi saat masyarakat mengajukan UMKM baru (untuk Admin)
     */
    public static function umkmBaru($userId, $namaUsaha, $idUmkm, $userName)
    {
        $link = route('admin.umkm.index');
        self::sendToAdmins(
            'umkm',
            'Pengajuan UMKM Baru',
            "Pendaftaran UMKM baru '$namaUsaha' oleh $userName sedang menunggu persetujuan admin.",
            $link,
            $idUmkm
        );
    }

    /**
     * Notifikasi saat pelaku UMKM menambahkan produk baru (untuk Admin)
     */
    public static function produkBaru($userId, $namaProduk, $namaUsaha)
    {
        $link = route('admin.umkm.index');
        self::sendToAdmins(
            'umkm',
            'Produk UMKM Baru',
            "Produk baru '$namaProduk' telah ditambahkan oleh pelaku UMKM dari usaha '$namaUsaha'.",
            $link,
            null
        );
    }

    /**
     * Notifikasi saat pengajuan UMKM disetujui (untuk Masyarakat)
     */
    public static function umkmDisetujui($userId, $namaUsaha, $idUmkm, $adminId)
    {
        $link = route('masyarakat.umkm.status');
        self::sendToUser(
            $userId,
            'umkm',
            'Pengajuan UMKM Disetujui',
            "Selamat! Pengajuan pendaftaran UMKM '$namaUsaha' Anda telah disetujui oleh admin.",
            $link,
            $idUmkm
        );
    }

    /**
     * Notifikasi saat pengajuan UMKM ditolak (untuk Masyarakat)
     */
    public static function umkmDitolak($userId, $namaUsaha, $idUmkm, $alasanPenolakan, $adminId)
    {
        $link = route('masyarakat.umkm.status');
        self::sendToUser(
            $userId,
            'umkm',
            'Pengajuan UMKM Ditolak',
            "Maaf, pengajuan UMKM '$namaUsaha' Anda ditolak oleh admin dengan alasan: $alasanPenolakan",
            $link,
            $idUmkm
        );
    }

    /**
     * Notifikasi saat pengajuan surat baru (untuk Admin)
     */
    public static function suratBaru($userId, $jenisSurat, $idSurat, $userName)
    {
        $link = route('admin.pengajuan-surat.index');
        self::sendToAdmins(
            'surat',
            'Pengajuan Surat Baru',
            "Pengajuan surat baru '$jenisSurat' oleh $userName sedang menunggu verifikasi.",
            $link,
            $idSurat
        );
    }

    /**
     * Notifikasi saat surat disetujui/sedang diproses (untuk Masyarakat)
     */
    public static function suratDiproses($userId, $jenisSurat, $idSurat, $adminId)
    {
        $link = route('masyarakat.surat.index');
        self::sendToUser(
            $userId,
            'surat',
            'Pengajuan Surat Diproses',
            "Pengajuan surat '$jenisSurat' Anda sedang diproses oleh admin.",
            $link,
            $idSurat
        );
    }

    /**
     * Notifikasi saat surat selesai diunggah (untuk Masyarakat)
     */
    public static function suratSelesai($userId, $jenisSurat, $idSurat, $adminId)
    {
        $link = route('masyarakat.surat.index');
        self::sendToUser(
            $userId,
            'surat',
            'Pengajuan Surat Selesai',
            "Pengajuan surat '$jenisSurat' Anda telah selesai. Silakan unduh dokumen surat Anda.",
            $link,
            $idSurat
        );
    }

    /**
     * Notifikasi saat surat ditolak (untuk Masyarakat)
     */
    public static function suratDitolak($userId, $jenisSurat, $idSurat, $catatan, $adminId)
    {
        $link = route('masyarakat.surat.index');
        self::sendToUser(
            $userId,
            'surat',
            'Pengajuan Surat Ditolak',
            "Maaf, pengajuan surat '$jenisSurat' Anda ditolak oleh admin dengan catatan: $catatan",
            $link,
            $idSurat
        );
    }
}
