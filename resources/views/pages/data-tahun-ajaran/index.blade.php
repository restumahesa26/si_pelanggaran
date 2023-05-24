@extends('layouts.admin')

@section('title', 'Data Tahun Ajaran')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">Data Tahun Ajaran</h5>
                    <div class="d-flex justify-content-start">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Data
                        </button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            Ganti Tahun Ajaran Aktif
                        </button>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tahun Ajaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('data-tahun-ajaran.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="tahun_ajaran">Tahun Ajaran</label><sup class="text-danger">(*)</sup>
                                            <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" value="{{ old('tahun_ajaran') }}" required>
                                            @error('tahun_ajaran')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="status">Status</label><sup class="text-danger">(*)</sup>
                                            <div class="form-check">
                                                <label class="form-check-label text-dark">
                                                    <input type="radio" class="form-check-input" name="status" id="1"
                                                        value="1" @if(old('status') == '1') checked @endif required>
                                                    Aktif
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label text-dark">
                                                    <input type="radio" class="form-check-input" name="status" id="0"
                                                        value="0" @if(old('status') == '0') checked @endif  required>
                                                    Tidak Aktif
                                                </label>
                                            </div>
                                            @error('status')
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
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tahun Ajaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('data-tahun-ajaran.ganti-tahun-ajaran') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="id">Pilih Tahun Ajaran</label><br>
                                            <select class="id w-100" id="id" name="id" required>
                                                <option value=""></option>
                                                @foreach ($items->where('status', '0') as $data)
                                                <option value="{{ $data->id }}" @if(old('id') == $data->id) selected @endif>{{ $data->tahun_ajaran }}</option>
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
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tahun_ajaran }}</td>
                                <td>
                                    @if ($item->status == '1')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('data-tahun-ajaran.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="ti ti-pencil" style="font-size: 16px"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}">
                                        <i class="ti ti-trash" style="font-size: 16px"></i>
                                    </button>
                                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Tahun Ajaran
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Hapus Tahun Ajaran {{ $item->tahun_ajaran }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <form action="{{ route('data-tahun-ajaran.destroy', $item->id) }}"
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

@push('addon-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.id').select2({
                placeholder: "-- Pilih Tahun Ajaran --",
                allowClear: true,
                theme: "classic",
                dropdownParent: $('#exampleModal2'),
                width: '100%'
            });
        });
    </script>
@endpush
