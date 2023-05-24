@extends('layouts.admin')

@section('title', 'Data Pelanggaran - Ubah')

@section('content')
<div class="row">
    <div class="col-lg-6 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Ubah Data Pelanggaran</h5>
                <form action="{{ route('data-pelanggaran.update', $item->id) }}" method="post" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="pelanggaran">Pelanggaran</label><sup class="text-danger">(*)</sup>
                        <input type="text" name="pelanggaran" class="form-control @error('pelanggaran') is-invalid @enderror" id="pelanggaran" placeholder="Pelanggaran" value="{{ old('pelanggaran', $item->pelanggaran) }}" required>
                        @error('pelanggaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="ayat">Ayat</label><sup class="text-danger">(*)</sup>
                        <input type="number" name="ayat" class="form-control @error('ayat') is-invalid @enderror" id="ayat" placeholder="Ayat" value="{{ old('ayat', $item->ayat) }}" min="0" required>
                        @error('ayat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="skor">Skor</label><sup class="text-danger">(*)</sup>
                        <input type="number" name="skor" class="form-control @error('skor') is-invalid @enderror" id="skor" placeholder="Skor" value="{{ old('skor', $item->skor) }}" min="0" required>
                        @error('skor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('data-pelanggaran.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
