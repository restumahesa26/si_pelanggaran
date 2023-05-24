@extends('layouts.admin')

@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title">Profile</h5>
                <form action="{{ route('profile.update') }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="nama">Nama</label><sup class="text-danger">(*)</sup>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" value="{{ old('nama', $item->nama) }}" required>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="nip">NIP</label><sup class="text-danger">(*)</sup>
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="NIP" value="{{ old('nip', $item->nip) }}" required>
                        @error('nip')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="email">Email</label><sup class="text-danger">(*)</sup>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email', $item->email) }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" value="{{ old('password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Konfirmasi Password" value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
