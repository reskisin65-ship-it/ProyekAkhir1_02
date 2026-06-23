<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <style>

        @page { margin: 1.8cm 2cm 2.2cm 2cm; }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {

            font-family: DejaVu Sans, sans-serif;

            font-size: 11pt;

            line-height: 1.5;

            color: #000;

        }



        /* === KOP SURAT RESMI === */

        table.kop-table {

            width: 100%;

            border-collapse: collapse;

            margin-bottom: 0;

        }

        table.kop-table td {

            vertical-align: middle;

            padding: 0;

        }

        .kop-logo-cell {

            width: 95px;

            text-align: center;

        }

        .kop-logo-cell img {

            width: 82px;

            height: 82px;

            object-fit: contain;

        }

        .kop-logo-placeholder {

            width: 82px;

            height: 82px;

            border: 2px solid #333;

            border-radius: 50%;

            margin: 0 auto;

            font-size: 8pt;

            line-height: 82px;

            text-align: center;

            color: #555;

        }

        .kop-text-cell {

            text-align: center;

            padding: 0 8px;

        }

        .kop-text-cell .provinsi {

            font-size: 10.5pt;

            text-transform: uppercase;

            letter-spacing: 0.4px;

        }

        .kop-text-cell .kabupaten {

            font-size: 10.5pt;

            text-transform: uppercase;

            letter-spacing: 0.4px;

            margin-top: 1px;

        }

        .kop-text-cell .kecamatan {

            font-size: 11pt;

            text-transform: uppercase;

            letter-spacing: 0.4px;

            margin-top: 2px;

        }

        .kop-text-cell .desa {

            font-size: 14pt;

            font-weight: bold;

            text-transform: uppercase;

            letter-spacing: 0.8px;

            margin-top: 4px;

        }

        .kop-text-cell .alamat {

            font-size: 9.5pt;

            margin-top: 4px;

        }

        .kop-spacer { width: 95px; }



        .kop-border-wrap {

            margin: 8px 0 20px;

        }

        .kop-line-thick {

            border-bottom: 3px solid #000;

            margin-bottom: 1px;

        }

        .kop-line-thin {

            border-bottom: 1px solid #000;

        }



        /* === JUDUL SURAT === */

        .judul-surat {

            text-align: center;

            margin: 18px 0 14px;

        }

        .judul-surat h3 {

            font-size: 12pt;

            font-weight: bold;

            text-decoration: underline;

            text-transform: uppercase;

            letter-spacing: 0.6px;

        }

        .judul-surat .nomor {

            margin-top: 8px;

            font-size: 10.5pt;

        }



        /* === META SURAT === */

        .meta-surat {

            margin: 0 0 16px 0;

            font-size: 10.5pt;

        }

        .meta-surat table { width: auto; border-collapse: collapse; margin-left: 0; }

        .meta-surat td { padding: 2px 0; vertical-align: top; }

        .meta-surat td:first-child { width: 68px; }

        .meta-surat td:nth-child(2) { width: 10px; padding-right: 6px; }



        /* === ISI SURAT === */

        .content { text-align: justify; }

        .content p { margin: 0 0 10px; text-indent: 36px; }

        .content p.no-indent { text-indent: 0; }



        /* === TABEL DATA === */

        table.data {

            width: 100%;

            border-collapse: collapse;

            margin: 6px 0 14px 36px;

            font-size: 10.5pt;

        }

        table.data td {

            padding: 2px 0;

            vertical-align: top;

        }

        table.data td:first-child { width: 24px; }

        table.data td:nth-child(2) { width: 160px; }

        table.data td:nth-child(3) { width: 10px; padding-right: 4px; }



        table.data-signer {

            margin-left: 36px;

            margin-bottom: 10px;

            font-size: 10.5pt;

        }

        table.data-signer td:first-child { width: 60px; }

        table.data-signer td:nth-child(2) { width: 10px; }



        /* === TANDA TANGAN === */

        .closing { margin-top: 16px; }

        .closing p { text-indent: 0; margin: 0; font-size: 10.5pt; }

        .signature-block {

            margin-top: 24px;

            width: 55%;

            float: right;

            text-align: center;

        }

        .signature-block .tempat-tanggal {

            margin: 0 0 4px;

            font-size: 10.5pt;

        }

        .signature-block .jabatan {

            margin: 0 0 65px;

            font-size: 10.5pt;

        }

        .signature-block .nama {

            font-weight: bold;

            text-decoration: underline;

            font-size: 11pt;

            text-transform: uppercase;

            margin: 0;

        }

        .signature-block .nip {

            margin: 3px 0 0;

            font-size: 10pt;

        }

        .clear { clear: both; }



        .doc-footer {

            margin-top: 28px;

            padding-top: 6px;

            border-top: 1px solid #bbb;

            font-size: 7.5pt;

            color: #666;

            text-align: center;

            clear: both;

        }

    </style>

</head>

<body>

    {{-- Kop Surat Resmi dengan Logo --}}

    <table class="kop-table">

        <tr>

            <td class="kop-logo-cell">

                @if(!empty($logoBase64))

                    <img src="{{ $logoBase64 }}" alt="Logo Desa">

                @else

                    <div class="kop-logo-placeholder">LOGO</div>

                @endif

            </td>

            <td class="kop-text-cell">

                <div class="provinsi">Pemerintah Provinsi {{ $profil?->provinsi ?: '....................' }}</div>

                <div class="kabupaten">Pemerintah Kabupaten {{ $profil?->kabupaten ?: '....................' }}</div>

                <div class="kecamatan">Kecamatan {{ $profil?->kecamatan ?: '....................' }}</div>

                <div class="desa">{{ $namaDesa }}</div>

                @if($profil?->alamat_kantor)

                    <div class="alamat">{{ $profil->alamat_kantor }}</div>

                @endif

                @if($profil?->telepon_desa || $profil?->email_desa)

                    <div class="alamat">

                        @if($profil?->telepon_desa) Telp. {{ $profil->telepon_desa }} @endif

                        @if($profil?->telepon_desa && $profil?->email_desa) &nbsp;&nbsp;|&nbsp;&nbsp; @endif

                        @if($profil?->email_desa) Email: {{ $profil->email_desa }} @endif

                    </div>

                @endif

            </td>

            <td class="kop-spacer"></td>

        </tr>

    </table>



    <div class="kop-border-wrap">

        <div class="kop-line-thick"></div>

        <div class="kop-line-thin"></div>

    </div>



    @yield('content')



    <div class="doc-footer">

        Dokumen ini diterbitkan secara elektronik melalui Sistem Informasi Pelayanan {{ $namaDesa }}

    </div>

    <div class="clear"></div>

</body>

</html>


