@extends('pdf.surat.layout')



@section('content')

@include('pdf.surat.partials.letter-header', [

    'judul' => 'Surat Keterangan Domisili',

    'nomorSurat' => $nomorSurat,

    'perihal' => 'Keterangan Domisili',

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

        <tr><td>6.</td><td>Pekerjaan</td><td>:</td><td>{{ $pekerjaan }}</td></tr>

        <tr><td>7.</td><td>Alamat</td><td>:</td><td>{{ $alamat }}</td></tr>

    </table>



    <p>Adalah benar-benar penduduk dan berdomisili di wilayah {{ $namaDesa }}, Kecamatan {{ $kecamatan }}, Kabupaten {{ $kabupaten }}, Provinsi {{ $provinsi }}, sebagaimana tercatat dalam data administrasi kependudukan.</p>



    <p>Surat keterangan ini dibuat untuk keperluan <strong>{{ $pengajuan->keperluan }}</strong>.</p>



    @if($pengajuan->keterangan)

        <p>Keterangan tambahan: {{ $pengajuan->keterangan }}.</p>

    @endif



    <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

</div>



@include('pdf.surat.partials.signature')

@endsection


