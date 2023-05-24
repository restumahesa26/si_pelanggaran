<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan Siswa</title>
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

        ol {
            padding-left: 20px !important
        }

        ol li {
            font-size: 22px;
            ;
        }

        .table-borderless tr td {
            padding: 1px !important;
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
            padding: 1px !important;
        }

    </style>
</head>

<body>
    <div class="container" style="padding-left: 60px; padding-right: 60px; padding-top: 30px;">
        <h5 class="text-center font-weight-bold" style="font-size: 24px;">
            SURAT PERNYATAAN SISWA
        </h5>
        <p class="mt-4">Saya yang bertanda tangan di bawah ini :</p>
        <table class="table table-borderless mt-3">
            <tbody>
                <tr>
                    <td style="width: 33%;">Nama</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->nama }}</td>
                </tr>
                <tr>
                    <td style="width: 33%;">Jenis Kelamin</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td style="width: 33%;">NISN</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->nisn }}</td>
                </tr>
                <tr>
                    <td style="width: 33%;">Kelas</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->getKelas($item->nisn)->kelas->jenjang . ' ' . $item->getKelas($item->nisn)->kelas->kelas }}</td>
                </tr>
                <tr>
                    <td style="width: 33%;">Tempat dan Tanggal Lahir</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $tempat_lahir }}, {{ \Carbon\Carbon::parse($tanggal_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td style="width: 33%;">Alamat</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $alamat }}</td>
                </tr>
                <tr>
                    <td style="width: 33%;">Tinggal Bersama</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $tinggal_bersama }}</td>
                </tr>
                <tr>
                    <td style="width: 33%;">Nama Orang Tua / Wali</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $nama }}</td>
                </tr>
                <tr>
                    <td style="width: 33%;">Pekerjaan Orang Tua / Wali</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $pekerjaan }}</td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: justify;">
            Dengan ini menyatakan
        </p>
        <ol>
            <li>Sanggup mengikuti kegiatan belajar - mengajar di SMA Negeri 1 Kota Bengkulu dengan baik dan
                sungguh-sungguh.</li>
            <li>Sanggup menjaga nama baik sekolah, pribadi dan keluarga baik di sekolah maupun luar sekolah.</li>
            <li>Sanggup menghadirkan orangtua/wali murid ke sekolah jika diperlukan.</li>
            <li>Sanggup menaati dan melaksanakan tata tertib yang berlaku di SMA Negeri 1 Kota Bengkulu dengan
                sungguh-sungguh.</li>
            <li>Sanggup menarik kembali anak kami jika dikemudian hari melakukan dan melanggar ketentuan dan tata tertib
                yang berlaku di SMA Negeri 1 Kota Bengkulu.</li>
        </ol>
        <p class="mt-2" style="text-align: justify;">
            Demikianlah surat pernyataan ini kami buat dengan sebenar-benarnya dan penuh kesadaran untuk dapat
            dipergunakan sebagaimana mestinya.
        </p>
        <table class="table table-borderless mt-5">
            <tr>
                <td style="width: 65%;">Yang Menyaksikan</td>
                <td>Bengkulu, {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Orang Tua / Wali Murid</td>
                <td>Yang Membuat Pernyataan</td>
            </tr>
        </table>
        <table class="table table-borderless" style="margin-top: 120px;">
            <tr>
                <td style="width: 65%;">{{ $nama }}</td>
                <td>{{ $item->nama }}</td>
            </tr>
        </table>
        <table class="table table-borderless">
            <tr>
                <td style="width: 65%;">Mengetahui</td>
                <td></td>
            </tr>
            <tr>
                <td>Kepala SMAN 1 Kota Bengkulu</td>
                <td>Waka Kesiswaan</td>
            </tr>
        </table>
        <table class="table table-borderless" style="margin-top: 120px;">
            <tr>
                <td style="width: 65%;">H. Rustiyono, M.Pd.</td>
                <td>Silvia Firdaus, M.Pd.Si.</td>
            </tr>
            <tr>
                <td>NIP. 19690509194031004</td>
                <td>NIP. 19811222007012011</td>
            </tr>
        </table>
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
