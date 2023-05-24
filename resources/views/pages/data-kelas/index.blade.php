@extends('layouts.admin')

@section('title', 'Data Kelas')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">Data Kelas</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah Data
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('data-kelas.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jenjang">Jenjang</label><sup class="text-danger">(*)</sup>
                                                    <div class="form-check">
                                                        <label class="form-check-label text-dark">
                                                            <input type="radio" class="form-check-input" name="jenjang" id="X"
                                                                value="X" @if(old('jenjang') == 'X') checked @endif required>
                                                            X
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label text-dark">
                                                            <input type="radio" class="form-check-input" name="jenjang" id="XI"
                                                                value="XI" @if(old('jenjang') == 'XI') checked @endif required>
                                                            XI
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label text-dark">
                                                            <input type="radio" class="form-check-input" name="jenjang" id="XII"
                                                                value="XII" @if(old('jenjang') == 'XII') checked @endif required>
                                                            XII
                                                        </label>
                                                    </div>
                                                    @error('jenjang')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kelas">Kelas</label><sup class="text-danger">(*)</sup>
                                                    <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" id="kelas" value="{{ old('kelas') }}" placeholder="Contoh : IPA 1" required>
                                                    @error('kelas')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="wali_kelas">Wali Kelas</label><sup class="text-danger">(*)</sup><br>
                                            <select name="wali_kelas" id="wali_kelas" class="form-control w-100" required>
                                                <option value="" hidden>-- Pilih Wali Kelas --</option>
                                                @forelse ($waliKelas as $item)
                                                    <option value="{{ $item->id }}" @if(old('wali_kelas') == $item->id) selected @endif>{{ $item->nama }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                            @error('wali_kelas')
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
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->jenjang }} {{ $item->kelas }}</td>
                                <td>{{ $item->walikelas->nama }}</td>
                                <td>
                                    <a href="{{ route('data-kelas.show', $item->id) }}" class="btn btn-secondary btn-sm"><i class="ti ti-eye" style="font-size: 16px"></i></a>
                                    <a href="{{ route('data-kelas.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="ti ti-pencil" style="font-size: 16px"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}">
                                        <i class="ti ti-trash" style="font-size: 16px"></i>
                                    </button>
                                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kelas
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Hapus {{ $item->nama }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{ route('data-kelas.destroy', $item->id) }}"
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
