@extends('layouts.admin')

@section('title', 'Data Pelanggaran')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">Data Pelanggaran</h5>
                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Data
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('data-pelanggaran.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="pelanggaran">Pelanggaran</label><sup class="text-danger">(*)</sup>
                                            <input type="text" name="pelanggaran" class="form-control @error('pelanggaran') is-invalid @enderror" id="pelanggaran" placeholder="Pelanggaran" value="{{ old('pelanggaran') }}" required>
                                            @error('pelanggaran')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="ayat">Ayat</label><sup class="text-danger">(*)</sup>
                                            <input type="number" name="ayat" class="form-control @error('ayat') is-invalid @enderror" id="ayat" placeholder="Ayat" value="{{ old('ayat') }}" min="0" required>
                                            @error('ayat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="skor">Skor</label><sup class="text-danger">(*)</sup>
                                            <input type="number" name="skor" class="form-control @error('skor') is-invalid @enderror" id="skor" placeholder="Skor" value="{{ old('skor') }}" min="0" required>
                                            @error('skor')
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
                                <th>No</th>
                                <th>Pelanggaran</th>
                                <th>Ayat</th>
                                <th>Skor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pelanggaran }}</td>
                                <td>{{ $item->ayat }}</td>
                                <td>{{ $item->skor }}</td>
                                <td>
                                    <a href="{{ route('data-pelanggaran.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="ti ti-pencil" style="font-size: 16px"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}">
                                        <i class="ti ti-trash" style="font-size: 16px"></i>
                                    </button>
                                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pelanggaran
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Hapus Pelanggaran {{ $item->pelanggaran }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{ route('data-pelanggaran.destroy', $item->id) }}"
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

