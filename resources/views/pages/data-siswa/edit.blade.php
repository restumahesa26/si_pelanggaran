@extends('layouts.admin')

@section('title', 'Data Siswa - Ubah')

@section('content')
<div class="row">
    <div class="col-lg-6 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Ubah Data Siswa</h5>
                <form action="{{ route('data-siswa.update', $item->nisn) }}" method="post" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nisn">NISN</label><sup class="text-danger">(*)</sup>
                        <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" id="nisn" placeholder="NISN" value="{{ old('nisn', $item->nisn) }}" required>
                        @error('nisn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="nama">Nama</label><sup class="text-danger">(*)</sup>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" value="{{ old('nama', $item->nama) }}" required>
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
                                    value="L" @if (old('jenis_kelamin', $item->jenis_kelamin) == 'L') checked @endif required>
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label text-dark">
                                <input type="radio" class="form-check-input" name="jenis_kelamin" id="P"
                                    value="P" @if (old('jenis_kelamin', $item->jenis_kelamin) == 'P') checked @endif required>
                                Perempuan
                            </label>
                        </div>
                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('data-siswa.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
