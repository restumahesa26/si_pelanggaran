@extends('layouts.admin')

@section('title', 'Pelanggaran Siswa')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">10 Pelanggaran Siswa Terakhir</h5>
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('laporan.cetak') }}" class="btn btn-info me-2" target="_blank">Cetak Laporan</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Cetak Berdasarkan Kelas
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Wali Kelas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('laporan.cetak-2') }}" method="GET" target="_blank">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="kelas">Pilih Kelas</label><br>
                                        <select class="kelas w-100" id="kelas" name="kelas" required>
                                            <option value=""></option>
                                            @foreach ($kelas as $data)
                                            <option value="{{ $data->id }}" @if(old('id') == $data->id) selected @endif>{{ $data->jenjang }} {{ $data->kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    </div>
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

@push('addon-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.kelas').select2({
                placeholder: "-- Pilih Kelas --",
                allowClear: true,
                theme: "classic",
                dropdownParent: $('#exampleModal'),
                width: '100%'
            });
        });
    </script>
@endpush
