@extends('layouts.admin')

@section('title', 'Data Kelas - Ubah')

@section('content')
<div class="row">
    <div class="col-lg-6 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Ubah Data Kelas</h5>
                <form action="{{ route('data-kelas.update', $item->id) }}" method="post" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenjang">Jenjang</label><sup class="text-danger">(*)</sup>
                                <div class="form-check">
                                    <label class="form-check-label text-dark">
                                        <input type="radio" class="form-check-input" name="jenjang" id="X" @if(old('jenjang', $item->jenjang) == 'X') checked @endif value="X" required>
                                        X
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label text-dark">
                                        <input type="radio" class="form-check-input" name="jenjang" id="XI" @if(old('jenjang', $item->jenjang) == 'XI') checked @endif value="XI" required>
                                        XI
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label text-dark">
                                        <input type="radio" class="form-check-input" name="jenjang" id="XII" @if(old('jenjang', $item->jenjang) == 'XII') checked @endif value="XII" required>
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
                                <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" id="kelas" value="{{ old('kelas', $item->kelas) }}" placeholder="Contoh : IPA 1" required>
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
                            @forelse ($waliKelas as $item2)
                                <option value="{{ $item2->id }}" @if(old('wali_kelas', $item->wali_kelas) == $item2->id) selected @endif>{{ $item2->nama }}</option>
                            @empty

                            @endforelse
                        </select>
                        @error('wali_kelas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('data-kelas.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
