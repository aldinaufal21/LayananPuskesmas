
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('admin/img/puskesmas.png') }}">

    <title>Admin | Register Pasien</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                @if (session('error'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif  
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Register Akun Pasien') }}</h1>
                            </div>
                            <form class="user" action="{{ route('register.pasien') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleSelect1">Nama</label>
                                    <input type="text" name="nama" class="form-control"
                                        id="exampleInputNama" aria-describedby="namaHelp"
                                        placeholder="{{ __('Nama') }}">

                                    @error('nama')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Nik</label>
                                    <input type="number" name="nik" class="form-control"
                                        id="exampleInputNik" aria-describedby="nikHelp"
                                        placeholder="{{ __('nik') }}">

                                    @error('nik')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Foto KTP</label>
                                    <input type="file" name="foto_ktp" class="form-control"
                                        id="exampleInputFotoKtp" aria-describedby="fotoKtpHelp"
                                        placeholder="{{ __('foto_ktp') }}">

                                    @error('foto_ktp')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Alamat</label>
                                    <input type="text" name="alamat" class="form-control"
                                        id="exampleInputAlamat" aria-describedby="alamatHelp"
                                        placeholder="{{ __('Alamat') }}">

                                    @error('alamat')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>

                                    @error('jenis_kelamin')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Berat Badan</label>
                                    <input type="number" name="berat_badan" class="form-control"
                                        id="exampleInputBeratBadan" aria-describedby="BeratBadanHelp"
                                        placeholder="{{ __('Berat Badan') }}">

                                    @error('berat_badan')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Tinggi Badan</label>
                                    <input type="number" name="tinggi_badan" class="form-control"
                                        id="exampleInputTinggiBadan" aria-describedby="TinggiBadanHelp"
                                        placeholder="{{ __('Tinggi Badan') }}">

                                    @error('tinggi_badan')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Golongan Darah</label>
                                    <select name="gol_darah" class="form-control">
                                        <option value=""> - </option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>

                                    @error('gol_darah')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control"
                                        id="exampleInputTglLahir" aria-describedby="TglLahirHelp"
                                        placeholder="{{ __('Tanggal Lahir') }}">

                                    @error('tgl_lahir')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Nomor HP</label>
                                    <input type="number" name="no_hp" class="form-control"
                                        id="exampleInputNoHp" aria-describedby="NoHpHelp"
                                        placeholder="{{ __('Nomor HP') }}">

                                    @error('no_hp')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect1">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="{{ __('Email Address') }}">

                                    @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelect1">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        id="exampleInputPassword" placeholder="{{ __('Password') }}">

                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="submit" name="submit" value="{{ __('Register') }}" class="btn btn-primary btn-user btn-block my-4">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="small" href="forgot-password.html">Login Pengurus</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>