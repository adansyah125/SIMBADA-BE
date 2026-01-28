<!DOCTYPE html>
<html>

<head>
    <title>Laporan Inventaris Barang</title>
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
            margin-bottom: 20px;
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
        }

        table th {
            background-color: white;
        }

        tfoot th {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- KOP SURAT -->
    <div class="kop">
        <img src="{{ asset('logo.png') }}" alt="Logo Instansi">
        <div class="kop-text">
            <h2>PEMERINTAH KOTA BANDUNG</h2>
            <h3>KECAMATAN BANDUNG KIDUL</h3>
            <p>JL. Ters. Batununggal No.28 Bandung Kode Pos 402627 87304246</p>
        </div>
    </div>

    <div class="garis"></div>

    <!-- JUDUL LAPORAN -->
    <div class="judul">
        DATA BARANG KARTU INCENTARIS RUANGAN - {{ strtoupper(str_replace('_', ' ', $kondisi)) }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $item->kode_barang }}</td>
                    <td style="text-align: left">{{ $item->nama_barang }}</td>
                    <td style="text-align: left">{{ $item->lokasi }}</td>
                    <td>{{ ucfirst($item->kondisi) }}</td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.onload = () => window.print();
    </script>

</body>

</html>
