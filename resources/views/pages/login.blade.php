<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('login-page/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ url('login-page/css/owl.carousel.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('login-page/css/bootstrap.min.css') }}">
    <!-- Style -->
    <link rel="stylesheet" href="{{ url('login-page/css/style.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <span class="d-block h5 text-center my-4 font-weight-bold text-white"> Visi & Misi SMAN 1 Kota Bengkulu</span>
                    <p class="text-white font-weight-bold">Visi SMA Negeri 1 Kota Bengkulu</p>
                    <p class="text-white font-weight-bold text-justify" style="margin-top: -12px">“Terciptanya peserta didik yang beriman, berakhlak, cerdas, terampil, mandiri dan berwawasan global”</p>
                    <p class="text-white font-weight-bold text-justify">Misi SMA Negeri 1 Kota Bengkulu</p>
                    <ol style="padding-left: 16px">
                        <li class="text-white font-weight-bold text-justify">Menanamkan keimanan dan ketakwaan melalui pengalaman ajaran agama.</li>
                        <li class="text-white font-weight-bold text-justify">Melaksanakan proses pembelajaran dan bimbingan dengan mengedepankan kualitaspembelajaran yang didasari sikap ilmiah dan berwawasan lingkungan serta pelayanan bimbingan secara efektif.</li>
                        <li class="text-white font-weight-bold text-justify">Mengembangkan potensi peserta didik berdasarkan minat dan bakat yang dimiliki.</li>
                        <li class="text-white font-weight-bold text-justify">Membina kemandirian peserta didik melalui kegiatan pembiasaan, kedisiplinan, kewirausahaan, dan pengembangn diri yang terencana serta berkesinambungan.</li>
                        <li class="text-white font-weight-bold text-justify">Menjalin kerjasama yang harmonis antar warga sekolah, warga sekitar sekolah, dan lembaga lain yang terkait.</li>
                        <li class="text-white font-weight-bold text-justify">Membudayakan warga sekolah untuk cinta lingkungan hidup.</li>
                    </ol>
                </div>
                <div class="col-md-2 text-center">
                    &mdash; &mdash;
                </div>
                <div class="col-md-5 contents">
                    <div class="text-center">
                        <img src="{{ url('logo.png') }}" alt="" width="100" class="mb-3">
                    </div>
                    <div class="form-block" style="border-radius: 20px">
                        <div class="mb-4">
                            <h3>Masuk ke Sistem</h3>
                            <p class="mb-2 text-dark mt-2">Masukkan email dan password untuk masuk ke sistem.</p>
                        </div>
                        @error('login')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group first">
                                <label for="login">NIP atau Email</label>
                                <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" required>
                            </div>

                            <div class="form-group last mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                    <input type="checkbox" name="remember" />
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <input type="submit" value="Log In" class="btn btn-pill text-white btn-block btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('login-page/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('login-page/js/popper.min.js') }}"></script>
    <script src="{{ url('login-page/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('login-page/js/main.js') }}"></script>
</body>
</html>
