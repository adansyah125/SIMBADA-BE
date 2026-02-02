<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: "Times New Roman";
            font-size: 12pt;
            line-height: 1.4;
        }

        .judul {
            text-align: center;
            font-weight: bold;
        }

        .tabel-border {
            width: 100%;
            border-collapse: collapse;
        }

        .tabel-border td,
        .tabel-border th {
            border: 1px solid black;
            padding: 4px;
        }

        .ttd {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="judul">
        BERITA ACARA SERAH TERIMA {{ $berita->mesin->nama_barang }}<br>
        NOMOR : {{ $berita->id }}/ /BASTIK/Kec.Bankid/2026
    </div>

    <br>

    <p>
        Pada hari ini, {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l') }},
        Tanggal {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d') }}
        Bulan {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('F') }}
        Tahun {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('Y') }},
        kami yang bertanda tangan dibawah ini :
    </p>

    <table width="100%">
        <tr valign="top">
            <td width="20">1.</td>
            <td width="120">Nama</td>
            <td width="10">:</td>
            <td>{{ $berita->nama_pihak1 }}</td>
        </tr>

        <tr valign="top">
            <td></td>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $berita->nip_pihak1 }}</td>
        </tr>

        <tr valign="top">
            <td></td>
            <td>Pangkat/Gol</td>
            <td>:</td>
            <td>-</td>
        </tr>

        <tr valign="top">
            <td></td>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $berita->jabatan_pihak1 }}</td>
        </tr>

        <tr>
            <td colspan="4" height="10"></td>
        </tr>

        <tr valign="top">
            <td>2.</td>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $berita->nama_pihak2 }}</td>
        </tr>

        <tr valign="top">
            <td></td>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $berita->nip_pihak2 }}</td>
        </tr>

        <tr valign="top">
            <td></td>
            <td>Pangkat/Gol</td>
            <td>:</td>
            <td>-</td>
        </tr>

        <tr valign="top">
            <td></td>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $berita->jabatan_pihak2 }}</td>
        </tr>
    </table>

    <br>

    <p style="text-align: justify">
        PIHAK PERTAMA telah menyerahkan kepada PIHAK KEDUA telah menerima, barang dari
        PIHAK PERTAMA dalam keadaan baik yang telah dilengkapi dengan sebagaimana daftar
        dibawah ini :
    </p>

    <table class="tabel-border">
        <tr>
            <th width="40">NO</th>
            <th>BANYAKNYA</th>
            <th>JENIS BARANG</th>
        </tr>

        <tr>
            <td align="center">1.</td>
            <td align="center">
                {{ $berita->jumlah }} Buah
            </td>

            <td>
                {{ $berita->mesin->nama_barang ?? '-' }}
                ({{ $berita->mesin->merk ?? '' }})
                Nomorseri : {{ $berita->mesin->no_polisi ?? '-' }}
            </td>
        </tr>
    </table>

    <br>

    <p style="text-align: justify">
        Untuk selanjutnya barang tersebut menjadi Barangdinas dan tercatat sebagai barang
        inventaris pada Kecamatan Bandung Kidul Pemerintah Kota Bandung. Apabila PIHAK
        KEDUA atau pejabat yang ditunjuk oleh PIHAK PERTAMA sebagai pemegang/penanggungjawab
        NoteBook/Tablet tersebut pindah tugas/pensiun/berhenti/meninggal dunia,
        Note book/Tablet tetap barang inventaris pada Kecamatan Bandung Kidul Kota Bandung.
        Semua kerusakan atau kehilangan sebagian atau seluruh bagian kendaraan menjadi
        tanggungjawab PIHAK KEDUA.
    </p>

    <p>
        Demikian Berita Acara serah terima ini dibuat dalam rangkap 3 (tiga) dan dipergunakan
        sebagaimana mestinya.
    </p>

    <br><br>

    <table width="100%">
        <tr class="ttd">
            <td>PIHAK KEDUA</td>
            <td>PIHAK PERTAMA</td>
        </tr>

        <tr>
            <td colspan="2" height="80"></td>
        </tr>

        <tr class="ttd">
            <td>
                {{ $berita->nama_pihak2 }}<br>
                NIP. {{ $berita->nip_pihak2 }}
            </td>

            <td>
                {{ $berita->nama_pihak1 }}<br>
                NIP. {{ $berita->nip_pihak1 }}
            </td>
        </tr>
    </table>

    <br><br>

    <div class="ttd">
        Mengetahui :<br>
        CAMAT BANDUNG KIDUL
        <br><br><br><br>

        Drs. YAYAN KARYANA, M.Pd<br>
        NIP. 19590521 198101 1 001
    </div>

</body>

</html>
