<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan Orang Tua</title>
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
    <div class="container" style="padding-left: 60px; padding-right: 60px; padding-top: 30px">
        <h5 class="text-center font-weight-bold" style="font-size: 24px;">
            SURAT PERNYATAAN ORANG TUA
        </h5>
        <p class="mt-4">Saya yang bertanda tangan di bawah ini :</p>
        <table class="table table-borderless mt-3">
            <tbody>
                <tr>
                    <td style="width: 25%;">Nama</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $nama }}</td>
                </tr>
                <tr>
                    <td style="width: 25%;">Jenis Kelamin</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td style="width: 25%;">Alamat</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $alamat }}</td>
                </tr>
                <tr>
                    <td style="width: 25%;">Pekerjaan</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $pekerjaan }}</td>
                </tr>
                <tr>
                    <td style="width: 25%;">No. HP</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $no_hp }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-borderless mt-3">
            <tbody>
                <tr>
                    <td style="width: 25%;">Orang Tua dari</td>
                    <td style="width: 1%;"></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width: 25%;">Nama</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->nama }}</td>
                </tr>
                <tr>
                    <td style="width: 25%;">Kelas</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td style="width: 25%;">NISN</td>
                    <td style="width: 1%;">:</td>
                    <td>{{ $item->nisn }}</td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: justify;">
            Dengan ini telah membaca dengan seksama dan menyetujui setiap poin-poin yang terlampir dalam buku tata
            tertib dan diberlakukan di SMA Negeri 1 Kota Bengkulu. Apabila anak saya melanggar, maka anak kami siap
            untuk diberi sanksi sesuai skor dan kami siap untuk dipanggil pihak sekolah.
        </p>
        <p style="text-align: justify;" class="mt-2">
            Demikianlah surat pernyataan ini dibuat untuk dapat digunakan sebagaimana mestinya.
        </p>
        <table class="table table-borderless mt-5">
            <tr>
                <td style="width: 65%;">&nbsp;</td>
                <td>Bengkulu, {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Mengetahui</td>
                <td>Yang Membuat Pernyataan</td>
            </tr>
            <tr>
                <td>Kepala SMAN 1 Kota Bengkulu</td>
                <td>Orang Tua / Wali Murid</td>
            </tr>
        </table>
        <table class="table table-borderless" style="margin-top: 120px;">
            <tr>
                <td style="width: 65%;">H. Rustiyono, M.Pd.</td>
                <td>{{ $nama }}</td>
            </tr>
            <tr>
                <td>NIP. 19690509194031004</td>
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
