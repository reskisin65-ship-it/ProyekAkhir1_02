<div class="judul-surat">

    <h3>{{ $judul }}</h3>

    <p class="nomor">Nomor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $nomorSurat }}</p>

</div>



@if(!empty($perihal))

<div class="meta-surat">

    <table>

        <tr>

            <td>Lampiran</td>

            <td>:</td>

            <td>-</td>

        </tr>

        <tr>

            <td>Perihal</td>

            <td>:</td>

            <td><strong>{{ $perihal }}</strong></td>

        </tr>

    </table>

</div>

@endif


