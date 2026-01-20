<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 10px;
        }

        .label-container {
            width: 100%;
        }

        .label {
            width: 280px;
            padding: 8px;
            border: 2px solid #d4a017;
            background: white;
            display: inline-block;
            /* Supaya label bisa berjejer ke samping */
            margin: 5px;
            vertical-align: top;
        }

        .header {
            border-bottom: 1px solid #777;
            padding-bottom: 3px;
            margin-bottom: 6px;
            width: 100%;
        }

        .header-mid {
            display: flex;
            align-items: center;
            justify-content: center;
            align-content: center;
            margin-top: -10px;
        }

        .header-text {
            font-size: 8px;
            font-weight: bold;
        }

        /* Mengganti flex dengan table untuk kompatibilitas cetak */
        .content-table {
            display: table;
            width: 100%;
        }

        .qr-column {
            display: table-cell;
            width: 55px;
            vertical-align: top;
        }

        .info-column {
            display: table-cell;
            vertical-align: top;
            padding-left: 5px;
        }

        .qr-box {
            width: 50px;
            height: 50px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .qr-box img {
            width: 100%;
            height: auto;
        }

        .text-row {
            display: table;
            width: 100%;
            font-size: 9px;
            margin-bottom: 2px;
        }

        .text-label {
            display: table-cell;
            width: 40px;
            font-weight: normal;
        }

        .text-separator {
            display: table-cell;
            width: 8px;
        }

        .text-value {
            display: table-cell;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="label-container">
        @foreach ($items as $data)
            <div class="label">
                <!-- HEADER -->
                <div class="header">
                    <div class="header-left">
                        <div class="header-mid">
                            <img src="{{ public_path('logo.png') }}" alt="Logo" style="width: 15px;margin-top:10px">
                            <span style="font-size: 5px">PEMERINTAH KOTA BANDUNG</span>
                            <span class="header-text" style="margin-left:80px">KEC. BANDUNG KIDUL</span>
                        </div>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="content-table">
                    <div class="qr-column">
                        <div class="qr-box">
                            <img src="{{ public_path('storage/' . $data->gambar_qr) }}" alt="QR">
                        </div>
                    </div>

                    <div class="info-column">
                        <div class="text-row">
                            <span class="text-label">Kode</span>
                            <span class="text-separator">:</span>
                            <span class="text-value">{{ $data->kode_barang }}</span>
                        </div>
                        <div class="text-row">
                            <span class="text-label">Nama</span>
                            <span class="text-separator">:</span>
                            <span class="text-value">{{ $data->nama_barang }}</span>
                        </div>
                        <div class="text-row">
                            <span class="text-label">Lokasi</span>
                            <span class="text-separator">:</span>
                            <span class="text-value">{{ $data->lokasi }}</span>
                        </div>
                        <div class="text-row">
                            <span class="text-label">Tanggal</span>
                            <span class="text-separator">:</span>
                            <span
                                class="text-value">{{ \Carbon\Carbon::parse($data->tanggal_perolehan)->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
