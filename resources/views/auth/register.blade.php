<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register Pengguna</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ url('/') }}" class="h1"><b>PWL</b>POS</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Daftar akun baru</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ url('register') }}" method="POST" id="form-register">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
                    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
                    <small id="error-username" class="text-danger error-text"></small>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama') }}">
                    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
                    <small id="error-nama" class="text-danger error-text"></small>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
                    <small id="error-password" class="text-danger error-text"></small>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
                    <small id="error-password_confirmation" class="text-danger error-text"></small>
                </div>
                <div class="input-group mb-3">
                    <select name="level_id" id="level_id" class="form-control">
                        <option value="">Pilih Level</option>
                        @foreach ($levels as $level)
                            <option value="{{ $level->level_id }}" {{ old('level_id') == $level->level_id ? 'selected' : '' }}>{{ $level->level_nama }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-users"></span></div></div>
                    <small id="error-level_id" class="text-danger error-text"></small>
                </div>
                <div class="row">
                    <div class="col-8">
                        <a href="{{ url('/login') }}">Sudah punya akun? Login di sini</a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    $(function () {
        $('#form-register').validate({
            rules: {
                username: { required: true, minlength: 4, maxlength: 20 },
                nama: { required: true, maxlength: 100 },
                password: { required: true, minlength: 6, maxlength: 20 },
                password_confirmation: { required: true, equalTo: "#password" },
                level_id: { required: true }
            },
            messages: {
                username: {
                    required: "Username harus diisi",
                    minlength: "Minimal 4 karakter",
                    maxlength: "Maksimal 20 karakter"
                },
                nama: {
                    required: "Nama harus diisi",
                    maxlength: "Maksimal 100 karakter"
                },
                password: {
                    required: "Password harus diisi",
                    minlength: "Minimal 6 karakter",
                    maxlength: "Maksimal 20 karakter"
                },
                password_confirmation: {
                    required: "Konfirmasi password harus diisi",
                    equalTo: "Konfirmasi tidak sama"
                },
                level_id: {
                    required: "Pilih level terlebih dahulu"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (form) {
               $.ajax({
    url: form.action,
    type: form.method,
    data: $(form).serialize(),
    success: function (res) {
        if (res.status) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: res.message
            }).then(() => {
                window.location.href = '{{ route("login") }}';  
            });
        } else {
            $('.error-text').text('');
            $.each(res.msgField, function (key, val) {
                $('#error-' + key).text(val[0]);
            });
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: res.message
            });
        }
    },
    error: function (xhr) {
        if (xhr.status === 422) {
            $('.error-text').text('');
            let errors = xhr.responseJSON.errors;
            $.each(errors, function (key, val) {
                $('#error-' + key).text(val[0]);
            });
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: xhr.responseJSON.message || 'Cek kembali data Anda'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: xhr.responseJSON.message || 'Terjadi kesalahan sistem'
            });
        }
    }
});

                return false;
            }
        });
    });
</script>
</body>
</html>