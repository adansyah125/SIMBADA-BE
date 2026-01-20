<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
        }

        .page {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            padding: 10mm;
        }

        .label {
            border: 1px solid #facc15;
            padding: 3px;
            width: 300px;
            page-break-inside: avoid;
        }

        .header {
            font-size: 6px;
            font-weight: bold;
            border-bottom: 1px solid #000;
            display: flex;
            justify-content: space-around;
            align-items: center
        }

        .logo {
            display: flex;
            gap: 5px;
            align-items: center
        }

        .body {
            display: flex;
            gap: 5px;
            margin-top: 2px;
        }

        .qr {
            width: 50px;
            height: 50px;
            border: 1px solid #333;
            text-align: center;
        }

        .qr img {
            width: 45px;
            height: 45px;
        }

        .info {
            font-size: 7px;
            line-height: 1.3;
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="label">
            <div class="header">
                <div class="logo">
                    <img src="{{ asset('logo.png') }}" alt="s" style="width: 20px">
                    <span>PEMERINTAH KOTA BANDUNG</span>
                </div>
                <span>KEC. BANDUNG KIDUL</span>
            </div>

            <div class="body">
                <div class="qr">
                    <img src="{{ public_path('storage/qrcodes/qr_1768720995_6.svg') }}">
                </div>

                <div class="info">
                    <div><b>Kode:</b>1231</div>
                    <div><b>Nama:</b> sdasd</div>
                    <div><b>Tahun:</b> as</div>
                    <div><b>Lokasi:</b>asda</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
