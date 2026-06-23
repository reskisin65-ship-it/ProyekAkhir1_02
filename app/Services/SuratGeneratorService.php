<?php



namespace App\Services;



use App\Helpers\TanggalHelper;

use App\Models\DataPenduduk;

use App\Models\DataPengurus;

use App\Models\PengajuanSurat;

use App\Models\ProfilDesa;

use Carbon\Carbon;

use Dompdf\Dompdf;

use Dompdf\Options;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\View;



class SuratGeneratorService

{

    private const NAMA_DESA = 'Desa Lumban Silintong';



    private const JENIS_SURAT = [

        'Surat Keterangan Domisili' => [

            'view' => 'pdf.surat.domisili',

            'kode' => 'SKD',

        ],

        'Surat Keterangan Usaha' => [

            'view' => 'pdf.surat.usaha',

            'kode' => 'SKU',

        ],

        'Surat Keterangan Tidak Mampu' => [

            'view' => 'pdf.surat.tidak-mampu',

            'kode' => 'SKTM',

        ],

        'Surat Keterangan Kelahiran' => [

            'view' => 'pdf.surat.kelahiran',

            'kode' => 'SKL',

        ],

        'Surat Keterangan Kematian' => [

            'view' => 'pdf.surat.kematian',

            'kode' => 'SKM',

        ],

        'Surat Pengantar SKCK' => [

            'view' => 'pdf.surat.pengantar-skck',

            'kode' => 'SPSKCK',

        ],

    ];



    public function generate(PengajuanSurat $pengajuan): string

    {

        $config = self::JENIS_SURAT[$pengajuan->jenis_surat] ?? null;



        if (!$config) {

            throw new \InvalidArgumentException('Jenis surat tidak didukung untuk auto-generate.');

        }



        if ($pengajuan->file_surat_draft && Storage::disk('public')->exists($pengajuan->file_surat_draft)) {

            Storage::disk('public')->delete($pengajuan->file_surat_draft);

        }



        $nomorSurat = $pengajuan->nomor_surat ?: $this->generateNomorSurat($config['kode']);

        $data = $this->buildTemplateData($pengajuan, $nomorSurat);



        $html = View::make($config['view'], $data)->render();

        $pdfContent = $this->renderPdf($html);



        $filename = 'surat_draft_' . $pengajuan->id_surat . '_' . time() . '.pdf';

        $path = 'surat_draft/' . $filename;



        Storage::disk('public')->put($path, $pdfContent);



        $pengajuan->update([

            'nomor_surat' => $nomorSurat,

            'file_surat_draft' => $path,

        ]);



        return $path;

    }



    private function buildTemplateData(PengajuanSurat $pengajuan, string $nomorSurat): array

    {

        $profil = ProfilDesa::first();

        $kepalaDesa = DataPengurus::where('kategori_jabatan', 'kepala_desa')->first();

        $penduduk = DataPenduduk::where('nik', $pengajuan->nik)->first()

            ?? DataPenduduk::where('user_id', $pengajuan->user_id)->first();



        $tanggalLahir = TanggalHelper::format($pengajuan->tanggal_lahir);

        $tanggalSurat = TanggalHelper::format(Carbon::now(), true);



        return [

            'namaDesa' => self::NAMA_DESA,

            'profil' => $profil,

            'kepalaDesa' => $kepalaDesa,

            'penduduk' => $penduduk,

            'pengajuan' => $pengajuan,

            'nomorSurat' => $nomorSurat,

            'tanggalSurat' => $tanggalSurat,

            'tanggalLahir' => $tanggalLahir,

            'logoBase64' => $this->resolveLogoBase64($profil),

            'jenisKelamin' => $this->formatJenisKelamin($penduduk?->jenis_kelamin),

            'alamat' => $this->resolveAlamat($pengajuan, $penduduk, $profil),

            'kecamatan' => $penduduk?->kecamatan ?: $profil?->kecamatan ?: '-',

            'kabupaten' => $penduduk?->kabupaten_kota ?: $profil?->kabupaten ?: '-',

            'provinsi' => $penduduk?->provinsi ?: $profil?->provinsi ?: '-',

            'agama' => $penduduk?->agama ?: '-',

            'pekerjaan' => $penduduk?->pekerjaan ?: '-',

            'pendidikan' => $penduduk?->pendidikan ?: '-',

            'statusPerkawinan' => $penduduk?->status_perkawinan ?: '-',

        ];

    }



    private function resolveLogoBase64(?ProfilDesa $profil): ?string

    {

        $candidates = [];



        if ($profil?->logo_desa && Storage::disk('public')->exists($profil->logo_desa)) {

            $candidates[] = Storage::disk('public')->path($profil->logo_desa);

        }



        $candidates[] = public_path('images/logo-desa.png');

        $candidates[] = public_path('favicon.png');



        foreach ($candidates as $path) {

            if (! is_file($path)) {

                continue;

            }



            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

            if ($extension === 'svg') {

                continue;

            }



            $mime = match ($extension) {

                'png' => 'image/png',

                'jpg', 'jpeg' => 'image/jpeg',

                'gif' => 'image/gif',

                'webp' => 'image/webp',

                default => mime_content_type($path) ?: 'image/png',

            };



            return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));

        }



        return null;

    }



    private function resolveAlamat(PengajuanSurat $pengajuan, ?DataPenduduk $penduduk, ?ProfilDesa $profil): string

    {

        if ($penduduk?->alamat) {

            $parts = array_filter([

                $penduduk->alamat,

                $penduduk->kelurahan_desa ?: self::NAMA_DESA,

                'Kec. ' . ($penduduk->kecamatan ?: $profil?->kecamatan),

                ($penduduk->kabupaten_kota ?: $profil?->kabupaten),

            ]);



            return implode(', ', $parts);

        }



        $parts = array_filter([

            self::NAMA_DESA,

            'Kec. ' . ($profil?->kecamatan ?: '-'),

            ($profil?->kabupaten ?: '-'),

        ]);



        return implode(', ', $parts);

    }



    private function formatJenisKelamin(?string $jenisKelamin): string

    {

        return match ($jenisKelamin) {

            'L' => 'Laki-laki',

            'P' => 'Perempuan',

            default => '-',

        };

    }



    private function generateNomorSurat(string $kode): string

    {

        $year = Carbon::now()->year;

        $month = Carbon::now()->format('m');



        $count = PengajuanSurat::whereYear('updated_at', $year)

            ->whereNotNull('nomor_surat')

            ->where('nomor_surat', 'like', "%/{$kode}/%")

            ->count() + 1;



        return sprintf('%03d/%s/%s/%s', $count, $kode, $month, $year);

    }



    private function renderPdf(string $html): string

    {

        $options = new Options();

        $options->set('isHtml5ParserEnabled', true);

        $options->set('isRemoteEnabled', false);

        $options->set('defaultFont', 'DejaVu Sans');



        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();



        return $dompdf->output();

    }

}


