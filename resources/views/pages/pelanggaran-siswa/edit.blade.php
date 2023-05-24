@extends('layouts.admin')

@section('title', 'Pelanggaran Siswa - Ubah')

@section('content')
<div class="row">
    <div class="col-lg-6 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Ubah Pelanggaran Siswa</h5>
                <form action="{{ route('pelanggaran-siswa.update', $item->id) }}" method="post" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kelas_siswa_id">Pilih Siswa</label><br>
                        <select class="kelas_siswa_id w-100" id="kelas_siswa_id" name="kelas_siswa_id" required>
                            <option value=""></option>
                            @foreach ($siswa as $data)
                            <option value="{{ $data->id }}" @if(old('kelas_siswa_id', $item->kelas_siswa_id) == $data->id) selected @endif>{{ $data->siswa->nama }} - {{ $data->kelas->jenjang }} {{ $data->kelas->kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="pelanggaran_id">Pilih Pelanggaran</label><br>
                        <select class="pelanggaran_id w-100" id="pelanggaran_id" name="pelanggaran_id" required>
                            <option value=""></option>
                            @foreach ($pelanggaran as $data)
                            <option value="{{ $data->id }}" @if(old('pelanggaran_id', $item->pelanggaran_id) == $data->id) selected @endif>{{ $data->pelanggaran }} ({{ $data->skor }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('pelanggaran-siswa.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
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
            $('.kelas_siswa_id').select2({
                placeholder: "-- Pilih Nama Siswa --",
                allowClear: true,
                theme: "classic",
                width: '100%'
            });
            $('.pelanggaran_id').select2({
                placeholder: "-- Pilih Pelanggaran --",
                allowClear: true,
                theme: "classic",
                width: '100%'
            });
        });
    </script>
@endpush
