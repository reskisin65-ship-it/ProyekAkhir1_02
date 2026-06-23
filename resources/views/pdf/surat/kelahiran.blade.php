@extends('pdf.surat.layout')



@section('content')

@include('pdf.surat.partials.letter-header', [

    'judul' => 'Surat Keterangan Kelahiran',

    'nomorSurat' => $nomorSurat,

    'perihal' => 'Keterangan Kelahiran',

])



<div class="content">

    <p class="no-indent">Yang bertanda tangan di bawah ini:</p>



    <table class="data data-signer">

        <tr><td>Nama</td><td>:</td><td><strong>{{ $kepalaDesa?->nama_pengurus ?: 'Kepala ' . $namaDesa }}</strong></td></tr>

        <tr><td>Jabatan</td><td>:</td><td>Kepala {{ $namaDesa }}, Kecamatan {{ $kecamatan }}, Kabupaten {{ $kabupaten }}</td></tr>

    </table>



    <p>Dengan ini menerangkan bahwa:</p>



    <table class="data">

        <tr><td>1.</td><td>Nama Lengkap</td><td>:</td><td>{{ $pengajuan->nama_lengkap }}</td></tr>

        <tr><td>2.</td><td>NIK</td><td>:</td><td>{{ $pengajuan->nik }}</td></tr>

        <tr><td>3.</td><td>Tempat/Tgl. Lahir</td><td>:</td><td>{{ $pengajuan->tempat_lahir }}, {{ $tanggalLahir }}</td></tr>

        <tr><td>4.</td><td>Jenis Kelamin</td><td>:</td><td>{{ $jenisKelamin }}</td></tr>

        <tr><td>5.</td><td>Agama</td><td>:</td><td>{{ $agama }}</td></tr>

        <tr><td>6.</td><td>Alamat</td><td>:</td><td>{{ $alamat }}</td></tr>

        <tr><td>7.</td><td>Nomor Telepon</td><td>:</td><td>{{ $pengajuan->nomor_telepon }}</td></tr>

    </table>



    <p>Adalah benar-benar warga {{ $namaDesa }} yang mengajukan surat keterangan kelahiran dengan rincian keperluan sebagai berikut:</p>



    <table class="data">

        <tr><td>1.</td><td>Keperluan</td><td>:</td><td>{{ $pengajuan->keperluan }}</td></tr>

        @if($pengajuan->keterangan)

            <tr><td>2.</td><td>Keterangan Kelahiran</td><td>:</td><td>{{ $pengajuan->keterangan }}</td></tr>

        @endif

    </table>



    <p>Surat keterangan ini dibuat sebagai pendukung proses administrasi kelahiran dan dokumen kependudukan terkait.</p>



    <p>Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.</p>

</div>



@include('pdf.surat.partials.signature')

@endsection


