@extends('layouts.admin')

@section('title', 'Data Tahun Ajaran - Ubah')

@section('content')
<div class="row">
    <div class="col-lg-6 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Ubah Data Tahun Ajaran</h5>
                <form action="{{ route('data-tahun-ajaran.update', $item->id) }}" method="post" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label><sup class="text-danger">(*)</sup>
                        <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" value="{{ old('tahun_ajaran', $item->tahun_ajaran) }}" required>
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
                                    value="1" @if (old('status', $item->status) == '1') checked @endif required>
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label text-dark">
                                <input type="radio" class="form-check-input" name="status" id="0"
                                    value="0" @if (old('status', $item->status) == '0') checked @endif required>
                                Tidak Aktif
                            </label>
                        </div>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('data-tahun-ajaran.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
