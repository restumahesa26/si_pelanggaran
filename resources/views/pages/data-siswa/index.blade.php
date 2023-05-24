@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">Data Siswa</h5>
                    <div class="d-flex justify-content-start">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data
                        </button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            Import Data
                        </button>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('data-siswa.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nisn">NISN</label><sup class="text-danger">(*)</sup>
                                            <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" id="nisn" placeholder="NISN" value="{{ old('nisn') }}" required>
                                            @error('nisn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="nama">Nama</label><sup class="text-danger">(*)</sup>
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" value="{{ old('nama') }}" required>
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="jenis_kelamin">Jenis Kelamin</label><sup class="text-danger">(*)</sup>
                                            <div class="form-check">
                                                <label class="form-check-label text-dark">
                                                    <input type="radio" class="form-check-input" name="jenis_kelamin" id="L"
                                                        value="L" @if (old('jenis_kelamin') == 'L') checked @endif required>
                                                    Laki-Laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label text-dark">
                                                    <input type="radio" class="form-check-input" name="jenis_kelamin" id="P"
                                                        value="P" @if (old('jenis_kelamin') == 'P') checked @endif required>
                                                    Perempuan
                                                </label>
                                            </div>
                                            @error('jenis_kelamin')
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
                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Data Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('data-siswa.import-data-siswa') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="file">File Excel</label><sup class="text-danger">(*)</sup>
                                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file" required>
                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nisn }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis_kelamin == 'L' ? 'Laki Laki' : 'Perempuan' }}</td>
                                <td>
                                    <a href="{{ route('data-siswa.edit', $item->nisn) }}" class="btn btn-primary btn-sm"><i class="ti ti-pencil" style="font-size: 16px"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->nisn }}">
                                        <i class="ti ti-trash" style="font-size: 16px"></i>
                                    </button>
                                    <div class="modal fade" id="modalHapus{{ $item->nisn }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Siswa
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Hapus {{ $item->nama }} dengan NISN {{ $item->nisn }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{ route('data-siswa.destroy', $item->nisn) }}"
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

@push('addon-script')
@if ($errors->any())
<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    });
</script>
@endif
@endpush
