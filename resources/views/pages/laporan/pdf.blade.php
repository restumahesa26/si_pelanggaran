<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Pelanggaran Siswa</title>
    <link rel="shortcut icon" type="image/png" href="{{ url('backend/src/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        @media print{
            @page {
                size: landscape
            }
        }

        body {
            font-family: 'Times New Roman';
        }

        table tr th, table tr td {
            font-size: 14px;
        }

        .table-bordered tr td {
            padding: 8px !important;
        }

        .table-bordered th, .table-bordered td{
            border: 1px solid #2C3333 !important;
        }
    </style>
</head>
<body>
    <h4 class="text-center font-weight-bold" style="font-size: 18px;">Data Pelanggaran Siswa</h4>
    <table class="table table-bordered" id="table">
        <thead>
            <tr class="text-center">
                <th style="vertical-align : middle; text-align:center;">No</th>
                <th style="vertical-align : middle; text-align:center;">Nama</th>
                <th style="vertical-align : middle; text-align:center;">Kelas</th>
                <th style="vertical-align : middle; text-align:center; width: 40%">Pelanggaran</th>
                <th style="vertical-align : middle; text-align:center;">Skor</th>
                <th style="vertical-align : middle; text-align:center;">Petugas</th>
                <th style="vertical-align : middle; text-align:center;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
            <tr>
                <td style="vertical-align : middle; text-align:center;"">{{ $loop->iteration }}</td>
                <td style="vertical-align : middle;">{{ $item->kelas_siswa->siswa->nama }}</td>
                <td style="vertical-align : middle;">{{ $item->kelas_siswa->kelas->jenjang }} {{ $item->kelas_siswa->kelas->kelas }}</td>
                <td style="vertical-align : middle;">{{ $item->pelanggaran->pelanggaran }}</td>
                <td style="vertical-align : middle; text-align:center;"">{{ $item->pelanggaran->skor }}</td>
                <td style="vertical-align : middle; text-align:center;"">{{ $item->petugas->nama }}</td>
                <td style="vertical-align : middle;">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="12">-- Data Kosong --</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script>
    window.print()
</script>
</html>
