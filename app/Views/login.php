<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In | SIPKPTA</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/dist/css/adminlte.min.css">
    <link rel="icon" href="<?= base_url(''); ?>/logo_uty.ico" type="image/gif">

</head>
<?php
$session = session();
$errors = $session->getFlashdata('errors');
$errors2 = $session->getFlashdata('errors2');
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <div class="widget-user-image text-center">
                        <img class="img-circle elevation-2" src="<?= base_url(''); ?>/gambar/logouty.png" alt="" width="100" height="100">
                    </div>
                    <a><b>SIP KPTA</b><br>Sistem Informasi</a>
                </div>
                <form action="<?= base_url(); ?>/Auth/login" method="post" id="formlogin">
                    <?php if ($errors != null) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php
                            foreach ($errors as $err) {
                                echo $err . '<br>';
                            }
                            ?>
                        </div>
                    <?php endif ?>
                    <div class="input-group form-group mb-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="NIK/NPM">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="far fa-id-card"></span>
                            </div>
                        </div>
                    </div>
                    <input type="checkbox" onclick="myFunction()">&nbsp Show Password
                    <div class="input-group form-group mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <br>
                        <script>
                            function myFunction() {
                                var x = document.getElementById("password");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }
                        </script>
                    </div>
                    <p>Hasil dari <br></p>
                    <div class="input-group form-group mb-3">
                        <input type="number" class="form-control" style="width: 50px;" value="<?= rand(1, 10) ?>" name="angka1" autocomplete="false" readonly> &nbsp&nbsp&nbsp+&nbsp&nbsp&nbsp
                        <input type="number" class="form-control" style="width: 50px;" value="<?= rand(1, 10) ?>" name="angka2" autocomplete="false" readonly>
                    </div>
                    <p>adalah?</p>
                    <div class="input-group form-group mb-3">
                        <input type="text" class="form-control" placeholder="Jawaban" name="c" autocomplete="false" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-equals"></span>
                            </div>
                        </div>
                    </div>
                    <?php if ($errors2 != null) : ?>
                        <p class="text-warning">
                            <?php
                            foreach ($errors2 as $err2) {
                                echo $err2 . '<br>';
                            }
                            ?>
                        </p>
                    <?php endif ?>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <?php foreach ($tahun_ajaran as $row) : ?>
                                <input type="hidden" class="form-control" name="tahun_ajaran" id="tahun_ajaran" value="<?= $row->tahun_ajaran; ?>">
                                <input type="hidden" class="form-control" name="semester" id="semester" value="<?= $row->semester; ?>">
                                <input type="hidden" class="form-control" name="batas_bimbingan" id="batas_bimbingan" value="<?= $row->batas_bimbingan; ?>">
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(''); ?>/adminlte/dist/js/adminlte.min.js"></script>
    <!-- jquery-validation -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
        $(function() {
            $('#formlogin').validate({
                rules: {
                    username: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    c: {
                        required: true,
                    },
                },
                messages: {
                    username: {
                        required: "Username Wajib Diisi",
                    },
                    password: {
                        required: "Password Wajib Diisi",
                    },
                    c: {
                        required: "Captcha Wajib Diisi",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>