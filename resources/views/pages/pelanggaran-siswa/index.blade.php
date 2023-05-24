@extends('layouts.admin')

@section('title', 'Pelanggaran Siswa')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">Pelanggaran Siswa</h5>
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Data
                    </button>
                    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggaran Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('pelanggaran-siswa.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="kelas_siswa_id">Pilih Siswa</label><br>
                                            <select class="kelas_siswa_id w-100" id="kelas_siswa_id" name="kelas_siswa_id" required>
                                                <option value=""></option>
                                                @foreach ($siswa as $data)
                                                <option value="{{ $data->id }}" @if(old('kelas_siswa_id') == $data->id) selected @endif>{{ $data->siswa->nama }} - {{ $data->kelas->jenjang }} {{ $data->kelas->kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="pelanggaran_id">Pilih Pelanggaran</label><br>
                                            <select class="pelanggaran_id w-100" id="pelanggaran_id" name="pelanggaran_id" required>
                                                <option value=""></option>
                                                @foreach ($pelanggaran as $data)
                                                <option value="{{ $data->id }}" @if(old('pelanggaran_id') == $data->id) selected @endif>{{ $data->pelanggaran }} ({{ $data->skor }})</option>
                                                @endforeach
                                            </select>
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
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Pelanggaran</th>
                                <th>Skor</th>
                                <th>Petugas</th>
                                <th>Aksi</th>
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
                                <td>
                                    <a href="{{ route('pelanggaran-siswa.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="ti ti-pencil" style="font-size: 16px"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}">
                                        <i class="ti ti-trash" style="font-size: 16px"></i>
                                    </button>
                                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pelanggaran Siswa
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Pelanggaran Siswa {{ $item->kelas_siswa->siswa->nama }} mengenai {{ $item->pelanggaran->pelanggaran }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{ route('pelanggaran-siswa.destroy', $item->id) }}"
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
