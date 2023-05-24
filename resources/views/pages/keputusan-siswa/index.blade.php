@extends('layouts.admin')

@section('title', 'Keputusan Pelanggaran Siswa')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">Keputusan Pelanggaran Siswa</h5>
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Data
                    </button>
                    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Keputusan Pelanggaran Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('keputusan-siswa.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="kelas_siswa_id">Pilih Siswa</label><sup class="text-danger">(*)</sup><br>
                                            <select class="kelas_siswa_id w-100" id="kelas_siswa_id" name="kelas_siswa_id" required>
                                                <option value=""></option>
                                                @foreach ($siswa as $data)
                                                <option value="{{ $data->id }}" @if(old('kelas_siswa_id') == $data->id) selected @endif>{{ $data->siswa->nama }} - {{ $data->kelas->jenjang }} {{ $data->kelas->kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="keputusan">Keputusan</label><sup class="text-danger">(*)</sup>
                                            <input type="text" name="keputusan" class="form-control @error('keputusan') is-invalid @enderror" id="keputusan" placeholder="Keputusan" value="{{ old('keputusan') }}" required>
                                            @error('keputusan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="table">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2" style="vertical-align : middle; text-align:center;">Nama Siswa</th>
                                <th rowspan="2" style="vertical-align : middle; text-align:center;">Kelas</th>
                                <th colspan="2" style="vertical-align : middle; text-align:center;">Skor</th>
                                <th rowspan="2" style="vertical-align : middle; text-align:center;">Keputusan Terakhir</th>
                                <th rowspan="2" style="vertical-align : middle; text-align:center;">Aksi</th>
                            </tr>
                            <tr>
                                <th style="vertical-align : middle; text-align:center;">Sekarang</th>
                                <th style="vertical-align : middle; text-align:center;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td style="vertical-align : middle; text-align:center;">{{ $item->nama }}</td>
                                <td style="vertical-align : middle; text-align:center;">{{ $item->getKelas($item->nisn)->kelas->jenjang }} {{ $item->getKelas($item->nisn)->kelas->kelas }}</td>
                                <td style="vertical-align : middle; text-align:center;">{{ $item->skorSekarang($item->nisn) }}</td>
                                <td style="vertical-align : middle; text-align:center;">{{ $item->totalSkor($item->nisn) }}</td>
                                <td style="vertical-align : middle; text-align:center;">{{ $item->keputusan($item->nisn) != NULL ? $item->keputusan($item->nisn)->keputusan : '-' }}</td>
                                <td style="vertical-align : middle; text-align:center;">
                                    <a href="{{ route('keputusan-siswa.show', $item->nisn) }}" class="btn btn-primary btn-sm"><i class="ti ti-eye" style="font-size: 16px"></i></a>
                                </td>
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

@if ($items->count() > 0)
@push('addon-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush

@push('addon-script')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            "order": [[2, "desc" ]]
        });
    });
</script>
@endpush
@endif

@push('addon-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.kelas_siswa_id').select2({
                placeholder: "-- Pilih Nama Siswa --",
                allowClear: true,
                theme: "classic",
                dropdownParent: $('#exampleModal'),
                width: '100%'
            });
            $('.pelanggaran_id').select2({
                placeholder: "-- Pilih Pelanggaran --",
                allowClear: true,
                theme: "classic",
                dropdownParent: $('#exampleModal'),
                width: '100%'
            });
        });
    </script>
    @if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
    @endif
@endpush
