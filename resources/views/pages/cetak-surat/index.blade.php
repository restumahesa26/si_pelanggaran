@extends('layouts.admin')

@section('title', 'Cetak Surat')

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">Cetak Surat</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="table">
                        <thead>
                            <tr class="text-center">
                                <th style="vertical-align : middle; text-align:center;">Nama Siswa</th>
                                <th style="vertical-align : middle; text-align:center;">Kelas</th>
                                <th style="vertical-align : middle; text-align:center;">Skor Sekarang</th>
                                <th style="vertical-align : middle; text-align:center;">Pelanggaran Terakhir</th>
                                <th style="vertical-align : middle; text-align:center;">Keputusan Terakhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                            <tr>
                                <td style="vertical-align : middle; text-align:center;">{{ $item->nama }}</td>
                                <td style="vertical-align : middle; text-align:center;">
                                    {{ $item->getKelas($item->nisn)->kelas->jenjang }}
                                    {{ $item->getKelas($item->nisn)->kelas->kelas }}</td>
                                <td style="vertical-align : middle; text-align:center;">
                                    {{ $item->skorSekarang($item->nisn) }}</td>
                                <td style="vertical-align : middle; text-align:center;">
                                    {{ $item->pelanggaran($item->nisn) != NULL ? $item->pelanggaran($item->nisn)->pelanggaran->pelanggaran : '-' }}
                                </td>
                                <td style="vertical-align : middle; text-align:center;">
                                    {{ $item->keputusan($item->nisn) != NULL ? $item->keputusan($item->nisn)->keputusan : '-' }}
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
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Cetak Surat Rekomendasi Belajar di Rumah
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cetak Surat Rekomendasi Belajar di Rumah</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('cetak-surat.surat-rekomendasi') }}" method="get" target="_blank">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nisn">Pilih Siswa</label><sup class="text-danger">(*)</sup><br>
                                        <select class="nisn w-100" id="nisn" name="nisn" required>
                                            <option value=""></option>
                                            @foreach ($items as $data)
                                            <option value="{{ $data->nisn }}" @if(old('nisn') == $data->nisn) selected @endif>{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nama_ayah">Nama Ayah</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" placeholder="Nama Ayah" value="{{ old('nama_ayah') }}" required>
                                                @error('nama_ayah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nama_ibu">Nama Ibu</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}" required>
                                                @error('nama_ibu')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nama_wali">Nama Wali</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="nama_wali" class="form-control @error('nama_wali') is-invalid @enderror" id="nama_wali" placeholder="Nama Wali" value="{{ old('nama_wali') }}" required>
                                                @error('nama_wali')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="alamat">Alamat</label><sup class="text-danger">(*)</sup>
                                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" value="{{ old('alamat') }}" required>
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <p class="text-dark">Akan menerima sanksi selama : </p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jumlah_hari">Jumlah Hari</label><sup class="text-danger">(*)</sup>
                                                <input type="number" name="jumlah_hari" class="form-control @error('jumlah_hari') is-invalid @enderror" id="jumlah_hari" placeholder="Jumlah Hari" value="{{ old('jumlah_hari') }}" required>
                                                @error('jumlah_hari')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tanggal_awal">Dari Tanggal</label><sup class="text-danger">(*)</sup>
                                                <input type="date" name="tanggal_awal" class="form-control @error('tanggal_awal') is-invalid @enderror" id="tanggal_awal" placeholder="Dari Tanggal" value="{{ old('tanggal_awal') }}" required>
                                                @error('tanggal_awal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tanggal_akhir">Sampai Tanggal</label><sup class="text-danger">(*)</sup>
                                                <input type="date" name="tanggal_akhir" class="form-control @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" placeholder="Sampai Tanggal" value="{{ old('tanggal_akhir') }}" required>
                                                @error('tanggal_akhir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                    Cetak Surat Pernyataan Orang Tua
                </button>
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cetak Surat Rekomendasi Belajar di Rumah</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('cetak-surat.surat-pernyataan-orang-tua') }}" method="get" target="_blank">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nisn-2">Pilih Siswa</label><sup class="text-danger">(*)</sup><br>
                                        <select class="nisn-2 w-100" id="nisn-2" name="nisn" required>
                                            <option value=""></option>
                                            @foreach ($items as $data)
                                            <option value="{{ $data->nisn }}" @if(old('nisn') == $data->nisn) selected @endif>{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Orang Tua</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Orang Tua" value="{{ old('nama') }}" required>
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin Orang Tua</label><sup class="text-danger">(*)</sup>
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
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="pekerjaan">Pekerjaan Orang Tua</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" placeholder="Pekerjaan Orang Tua" value="{{ old('pekerjaan') }}" required>
                                                @error('pekerjaan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="no_hp">No. HP Orang Tua</label><sup class="text-danger">(*)</sup>
                                                <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="No. HP Orang Tua" value="{{ old('no_hp') }}" required>
                                                @error('no_hp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label for="alamat">Alamat Orang Tua</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat Orang Tua" value="{{ old('alamat') }}" required>
                                                @error('alamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                    Cetak Surat Pernyataan Siswa
                </button>
                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cetak Surat Pernyataan Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('cetak-surat.surat-pernyataan-siswa') }}" method="get" target="_blank">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nisn-3">Pilih Siswa</label><sup class="text-danger">(*)</sup><br>
                                        <select class="nisn-3 w-100" id="nisn-3" name="nisn" required>
                                            <option value=""></option>
                                            @foreach ($items as $data)
                                            <option value="{{ $data->nisn }}" @if(old('nisn') == $data->nisn) selected @endif>{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir Siswa</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" placeholder="Tempat Lahir Siswa" value="{{ old('tempat_lahir') }}" required>
                                                @error('tempat_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir Siswa</label><sup class="text-danger">(*)</sup>
                                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" placeholder="Tanggal Lahir Siswa" value="{{ old('tanggal_lahir') }}" required>
                                                @error('tanggal_lahir')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="tinggal_bersama">Tinggal Bersama</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="tinggal_bersama" class="form-control @error('tinggal_bersama') is-invalid @enderror" id="tinggal_bersama" placeholder="Tinggal Bersama" value="{{ old('tinggal_bersama') }}" required>
                                                @error('tinggal_bersama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="nama">Nama Orang Tua</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Orang Tua" value="{{ old('nama') }}" required>
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="pekerjaan">Pekerjaan Orang Tua</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" placeholder="Pekerjaan Orang Tua" value="{{ old('pekerjaan') }}" required>
                                                @error('pekerjaan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label for="alamat">Alamat Orang Tua</label><sup class="text-danger">(*)</sup>
                                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat Orang Tua" value="{{ old('alamat') }}" required>
                                                @error('alamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
            "order": [
                [2, "desc"]
            ]
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
    $(document).ready(function () {
        $('.nisn').select2({
            placeholder: "-- Pilih Nama Siswa --",
            allowClear: true,
            theme: "classic",
            dropdownParent: $('#exampleModal'),
            width: '100%'
        });
        $('.nisn-2').select2({
            placeholder: "-- Pilih Nama Siswa --",
            allowClear: true,
            theme: "classic",
            dropdownParent: $('#exampleModal2'),
            width: '100%'
        });
        $('.nisn-3').select2({
            placeholder: "-- Pilih Nama Siswa --",
            allowClear: true,
            theme: "classic",
            dropdownParent: $('#exampleModal3'),
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
    $(document).ready(function () {
        $('#exampleModal').modal('show');
    });

</script>
@endif
@endpush
