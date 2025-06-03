<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Penitipan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }

        h2 {
            margin-bottom: 0;
        }

        .alamat {
            margin-top: 0;
            font-size: 13px;
        }

        .line {
            border-top: 3px solid #000;
            margin: 10px 0 20px 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>ReUseMart</h2>
    <p class="alamat">Jl. Green Eco Park No. 456 Yogyakarta</p>
    <div class="line"></div>

    <div class="section">
        <p>No Nota : {{ $penitipan->ID_PENITIPAN }}</p>
        <p>Tanggal penitipan : {{ \Carbon\Carbon::parse($penitipan->TANGGAL_PENITIPAN)->format('d/m/Y H:i:s') }}</p>
        <p>Masa penitipan sampai : {{ \Carbon\Carbon::parse($penitipan->TANGGAL_BERAKHIR)->format('d/m/Y') }}</p>
        <p>Penitip : {{ $penitipan->penitip->ID_PENITIP }} / {{ $penitipan->penitip->NAMA_PENITIP }}</p>
    </div>

    @foreach ($barangList as $barang)
        <div class="section">
            <p>{{ $barang->NAMA_BARANG }} :
                Rp{{ number_format($barang->HARGA_BARANG, 0, ',', '.') }}</p>
            @if (!empty($barang->KETERANGAN))
                <p>{{ $barang->KETERANGAN }}</p>
            @endif
            <p>Berat barang : {{ $barang->BERAT }} kg</p>
        </div>
    @endforeach

    <div class="section">
        <p>Diterima dan QC oleh :</p>
        <p>{{ $penitipan->pegawai->ID_PEGAWAI }} - {{ $penitipan->pegawai->NAMA_PEGAWAI }}</p>
    </div>
</body>

</html>