<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    {{-- <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 4px;
        }

        th {
            background: #f3f4f6;
        }
    </style> --}}
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 40px;
            color: #000;
        }

        /* HEADER */
        .kop {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .kop img {
            width: 90px;
            height: auto;
        }

        .kop-text {
            text-align: center;
            flex: 1;
        }

        .kop-text h2,
        .kop-text h3,
        .kop-text p {
            margin: 2px 0;
        }

        .kop-text h2 {
            font-size: 18px;
            text-transform: uppercase;
        }

        .kop-text h3 {
            font-size: 16px;
            text-transform: uppercase;
        }

        .kop-text p {
            font-size: 12px;
        }

        /* GARIS */
        .garis {
            border-top: 3px solid #000;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        /* JUDUL */
        .judul {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            font-weight: normal;
        }

        table th {
            background-color: white;
        }

        tfoot th {
            font-weight: normal;
        }
    </style>
</head>

<body>
    <!-- KOP SURAT -->
    <div class="kop">
        <img src="{{ public_path('logo.png') }}" alt="Logo Instansi">
        <div class="kop-text">
            <h2>PEMERINTAH KOTA BANDUNG</h2>
            <h3>KECAMATAN BANDUNG KIDUL</h3>
            <p>JL. Ters. Batununggal No.28 Bandung Kode Pos 402627 87304246</p>
        </div>
    </div>

    <div class="garis"></div>

    <!-- JUDUL LAPORAN -->
    <div class="judul">
        DATA KARTU INVENTARIS BARANG ASET TETAP TANAH
    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th colspan="2">Penggolongan dan Kodefikasi Barang</th>

                <th rowspan="2">NIBAR</th>
                <th rowspan="2">No Register</th>
                <th rowspan="2">Spesifikasi Nama Barang</th>
                <th rowspan="2">Spesifikasi Lainnya</th>
                <th rowspan="2">Jumlah</th>
                <th rowspan="2">Satuan</th>
                <th rowspan="2">Lokasi</th>
                <th rowspan="2">Titik Koordinat</th>

                <th colspan="4">Bukti Kepemilikan</th>

                <th rowspan="2">Harga Satuan</th>
                <th rowspan="2">Nilai Perolehan</th>
                <th rowspan="2">Tanggal Perolehan</th>
                <th rowspan="2">Cara Perolehan</th>
                <th rowspan="2">Status Penggunaan</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <th>Kode</th>
                <th>Nama</th>

                <th>Nama</th>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Nama Kepemilikan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->kode_barang }}</td>
                    <td>{{ $row->nama_barang }}</td>
                    <td>{{ $row->nibar }}</td>
                    <td>{{ $row->no_register }}</td>
                    <td>{{ $row->spesifikasi_nama_barang }}</td>
                    <td>{{ $row->spesifikasi_lainnya }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>{{ $row->satuan }}</td>
                    <td>{{ $row->lokasi }}</td>
                    <td>{{ $row->titik_koordinat }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->nomor }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->nama_kepemilikan }}</td>
                    <td>{{ number_format($row->harga_satuan ?? 0, 0, ',', '.') }}</td>
                    <td>{{ number_format($row->nilai_perolehan ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $row->tanggal_perolehan }}</td>
                    <td>{{ $row->cara_perolehan }}</td>
                    <td>{{ $row->status_penggunaan }}</td>
                    <td>{{ $row->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.onload = () => window.print();
    </script>

</body>

</html>
