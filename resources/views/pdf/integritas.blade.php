<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Times New Roman;
            font-size: 12pt;
            margin: 40px;
        }

        .kop {
            text-align: center;
            line-height: 1.2;
        }

        .kop-wrapper {
            margin-bottom: 5px;
        }

        img {
            max-width: 100%;
        }

        .garis {
            border-bottom: 3px solid black;
            margin-top: 5px;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }

        table {
            width: 100%;
        }

        .indent {
            margin-left: 20px;
        }

        .ttd {
            margin-left: 60%;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="kop-wrapper">
        <table width="100%">
            <tr>
                <td width="90" align="center">
                    <img src="{{ public_path('logo.png') }}" width="80">
                </td>
                <td align="center">
                    <b>PEMERINTAH KOTA BANDUNG</b><br>
                    <b>KELURAHAN KUJANGSARI</b><br>
                    <b>KECAMATAN BANDUNG KIDUL</b><br>
                    Jl. H. Bardan Raya No 294 RT 001 RW 010
                </td>
            </tr>
        </table>
    </div>

    <div class="garis"></div>


    <div class="judul">
        PAKTA INTEGRITAS BARANG MILIK DAERAH
    </div>

    <p>
        Pada Hari ini {{ $tanggal }} Saya yang bertanda tangan di bawah ini :
    </p>

    <table>
        <tr>
            <td width="120">Nama</td>
            <td>: {{ $data->nama }}</td>
        </tr>

        <tr>
            <td>Jabatan</td>
            <td>: {{ $data->jabatan }}</td>
        </tr>
    </table>

    <p>
        Dengan ini menyatakan sebagai berikut :
    </p>

    <p class="indent">
        1. Bahwa telah menerima dan menggunakan Barang Milik Daerah Untuk Menunjang
        Tugas Pokok dan Fungsi selaku ASN berupa :
    </p>

    <p class="indent">
        1) {{ $data->jumlah }} Unit
        <b>{{ $data->mesin->nama_barang }}</b>
        dengan Merk {{ $data->mesin->merk ?? '(-)' }}
        Nomor Polisi {{ $data->mesin->no_polisi ?? '(-)' }}
        Nomor Rangka {{ $data->mesin->no_rangka ?? '(-)' }}
        Nomor Mesin {{ $data->mesin->no_bpkb ?? '(-)' }}
        Tahun {{ $data->mesin->tanggal_perolehan ?? '(-)' }}
    </p>

    <p class="indent">
        2. Bahwa apabila saya dimutasi dan purna bakti, barang milik daerah tersebut akan
        dikembalikan ke Perangkat Daerah sesuai dengan status penggunaannya.
    </p>

    <p class="indent">
        3. Bahwa Pakta Integritas Penyerahan Barang Milik Daerah yang saya tandatangani ini
        berlaku juga sebagai Surat Kuasa kepada Pengguna Barang untuk menarik kembali
        secara langsung Barang Milik Daerah tersebut.
    </p>

    <p class="indent">
        4. Bahwa apabila Saya melanggar hal-hal yang Saya nyatakan dalam Pakta Integritas ini,
        Saya bersedia bertanggung jawab mutlak dan siap dikenakan sanksi sesuai dengan
        peraturan dan perundang-undangan yang berlaku.
    </p>

    <p>
        Demikian Pakta Integritas ini Saya buat dengan sebenar-benarnya
        untuk dipergunakan sebagaimana mestinya.
    </p>

    <div class="ttd">
        Bandung, {{ $tanggal }}<br>
        Yang Membuat Pernyataan dan Pemberi Kuasa<br>
        <br><br><br><br><br>

        <b style="margin-left: 30%">{{ $data->nama }}</b><br>
        NIP. {{ $data->nip }}
    </div>

</body>

</html>
