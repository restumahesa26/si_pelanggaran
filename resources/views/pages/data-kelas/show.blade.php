@extends('layouts.admin')

@section('title', 'Data Kelas - List Siswa')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title fw-semibold">Pilih untuk Tambah Siswa Kelas</h5>
                        <form action="{{ route('data-kelas.store-siswa-kelas') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nisn">Pilih Siswa</label><br>
                                <select class="nisn w-100" id="nisn" name="nisn[]" multiple="multiple" required>
                                    <option value=""></option>
                                    @foreach ($siswa as $data)
                                        @if ($data->checkSiswa($data->nisn))
                                            <option value="{{ $data->nisn }}" @if(old('nisn') == $data->nisn) selected @endif>{{ $data->nama }} - {{ $data->nisn }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="kelas_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-primary mt-2">Tambah Siswa Kelas</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title fw-semibold">Upload File Excel</h5>
                        <form action="{{ route('data-kelas.import-siswa-kelas') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">File Excel</label><sup class="text-danger">(*)</sup>
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file" required>
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="kelas_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-primary mt-2">Import Siswa Kelas</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">List Siswa Kelas {{ $item->jenjang }} {{ $item->kelas }}</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($item->siswa as $item2)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item2->siswa->nama }}</td>
                                <td>{{ $item2->siswa->jenis_kelamin == 'L' ? 'Laki Laki' : 'Perempuan' }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item2->id }}">
                                        <i class="ti ti-trash" style="font-size: 16px"></i>
                                    </button>
                                    <div class="modal fade" id="modalHapus{{ $item2->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Siswa Kelas
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Hapus {{ $item2->siswa->nama }} dari Kelas {{ $item->jenjang }} {{ $item->kelas }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{ route('data-kelas.delete-siswa-kelas', $item2->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

@if ($item->siswa->count() > 0)
@push('addon-style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush

@push('addon-script')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            "orderable": false
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
            $('.nisn').select2({
                placeholder: "-- Pilih Nama Siswa --",
                allowClear: true,
                theme: "classic",
            });
        });
    </script>
@endpush
