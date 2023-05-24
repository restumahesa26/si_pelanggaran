<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Rekomendasi</title>
    <link rel="shortcut icon" type="image/png" href="{{ url('backend/src/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Times New Roman';
        }

        h4 {
            margin-bottom: -3px;
        }

        p,
        span {
            margin-bottom: -3px;
            font-size: 22px;
        }

        .table-borderless tr td {
            padding: 3px !important;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000 !important;
        }

        table tr td,
        table tr th {
            font-size: 22px;
        }

        table tr th {
            padding: 2px !important;
        }

        table tr td {
            padding: 16px !important;
        }

    </style>
</head>

<body>
    <div class="container" style="padding-left: 60px; padding-right: 60px; padding-top: 30px">
        <h5 class="text-center font-weight-bold" style="font-size: 24px;">
            SURAT REKOMENDASI SISWA BELAJAR DI RUMAH
        </h5>
        <p class="mt-4" style="text-align: justify">Pada hari ini {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->translatedFormat('l') }} tanggal
            {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->translatedFormat('d') }} bulan
            {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->translatedFormat('F') }} tahun
            {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->translatedFormat('Y') }}, Kepala SMA Negeri 1 Kota Bengkulu
            memberikan rekomendasi kepada siswa-siswa :</p>
        <table class="table table-borderless mt-3">
            <tbody>
                <tr>
                    <td style="width: 25%;">Nama</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->nama }}</td>
                </tr>
                <tr>
                    <td style="width: 25%;">Jenis Kelamin</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td style="width: 25%;">Kelas</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->getKelas($item->nisn)->kelas->jenjang . ' ' . $item->getKelas($item->nisn)->kelas->kelas }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 25%;">Alamat Rumah</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $alamat }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-borderless mt-3">
            <tr>
                <td style="width: 25%;">Orang Tua / Wali Murid</td>
                <td style="width: 1%;"></td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 25%;">1. Ayah</td>
                <td style="width: 1%;">:</td>
                <td>{{ $nama_ayah }}</td>
            </tr>
            <tr>
                <td style="width: 25%;">2. Ibu</td>
                <td style="width: 1%;">:</td>
                <td>{{ $nama_ibu }}</td>
            </tr>
            <tr>
                <td style="width: 25%;">3. Wali</td>
                <td style="width: 1%;">:</td>
                <td>{{ $nama_wali }}</td>
            </tr>
            <tr>
                <td style="width: 25%;">4. Alamat Rumah</td>
                <td style="width: 1%;">:</td>
                <td>{{ $alamat }}</td>
            </tr>
        </table>
        <p style="text-align: justify;">
            Sebagai akibat pelanggaran peraturan dan tata tertib sekolah pasal 13 ayat {{ $pelanggaran->ayat }} Pada
            hari
            {{ \Carbon\Carbon::parse($item->pelanggaran($item->nisn)->pelanggaran->created_at)->translatedFormat('l') }}.
            Berdasarkan klasifikasi dan sanksi tingkat pelanggaran dan tata tertib sekolah, siswa-siswi tersebut telah
            memperoleh jumlah poin sebanyak {{ $item->skorSekarang($item->nisn) }} poin, maka siswa-siswi yang
            bersangkutan dikenakan sanksi belajar di rumah selama {{ $jumlah_hari }} hari terhitung mulai
            tanggal {{ \Carbon\Carbon::parse($tanggal_awal)->translatedFormat('d F Y') }}. Masuk sekolah pada
            tanggal {{ \Carbon\Carbon::parse($tanggal_akhir)->translatedFormat('d F Y') }} setelah melapor
            kepada wali kelas.
        </p>
        <p style="text-align: justify;" class="mt-2">
            Demikianlah surat rekomendasi ini dibuat untuk dapat dilaksanakan dengan penuh rasa tanggung jawab.
        </p>
        <table class="table table-borderless mt-5">
            <tr>
                <td style="width: 65%;">&nbsp;</td>
                <td>Ditetapkan di : Bengkulu</td>
            </tr>
            <tr>
                <td>&nbsp</td>
                <td>Pada tanggal : {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Guru BK,</td>
                <td>Wali Kelas,</td>
            </tr>
        </table>
        <table class="table table-borderless" style="margin-top: 120px;">
            <tr>
                <td style="width: 65%;">{{ Auth::user()->nama }}</td>
                <td>{{ $item->getKelas($item->nisn)->kelas->walikelas->nama }}</td>
            </tr>
            <tr>
                <td>NIP. {{ Auth::user()->nip }}</td>
                <td>NIP. {{ $item->getKelas($item->nisn)->kelas->walikelas->nip }}</td>
            </tr>
        </table>
        <div class="d-flex justify-content-center mt-5">
            <div class="column text-center">
                <p>Waka Kesiswaan</p>
                <p style="margin-top: 120px;">Silvia Firdaus, M.Pd.Si.</p>
                <p>NIP. 19811222007012011</p>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<script>
    window.print()
</script>
</html>
