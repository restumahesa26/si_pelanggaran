@extends('layouts.admin')

@section('title', 'Pelanggaran Siswa')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">10 Pelanggaran Siswa Terakhir</h5>
                    <a href="{{ route('laporan.cetak') }}" class="btn btn-primary" target="_blank">Cetak Laporan</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Pelanggaran</th>
                                <th>Skor</th>
                                <th>Petugas</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kelas_siswa->siswa->nama }}</td>
                                <td>{{ $item->kelas_siswa->kelas->jenjang }} {{ $item->kelas_siswa->kelas->kelas }}</td>
                                <td>{{ $item->pelanggaran->pelanggaran }}</td>
                                <td>{{ $item->pelanggaran->skor }}</td>
                                <td>{{ $item->petugas->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="7">-- Data Kosong --</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    @if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
    @endif
@endpush
