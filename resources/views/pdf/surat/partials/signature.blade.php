<div class="closing">

    <p class="no-indent">&nbsp;</p>

</div>



<div class="signature-block">

    <p class="tempat-tanggal">{{ $namaDesa }}, {{ $tanggalSurat }}</p>

    <p class="jabatan">Kepala {{ $namaDesa }},</p>

    <p class="nama">{{ $kepalaDesa?->nama_pengurus ?: '(..............................)' }}</p>

    @if($kepalaDesa?->nip)

        <p class="nip">NIP. {{ $kepalaDesa->nip }}</p>

    @endif

</div>


