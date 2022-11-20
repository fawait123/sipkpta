<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$success = $session->getFlashdata('success');
$errors = $session->getFlashdata('errors');
?>
<!-- Default box -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <div class="card-body">
        <?php if ($success != null) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php
                foreach ($success as $succ) {
                    echo $succ . '<br>';
                }
                ?>
            </div>
        <?php endif ?>
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle"></i> Tambah User</button>
        <table id="example2" class="table table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_user as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->username; ?></td>
                        <td><?= $row->role; ?></td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-username2="<?= $row->username; ?>" data-role="<?= $row->role; ?>"><i class=" far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal Add Product-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-outline card-primary">
                    <div class="card-body login-card-body">
                        <div class="login-logo">
                            <div class="widget-user-image text-center">
                                <img class="img-circle elevation-2" src="<?= base_url(''); ?>/gambar/logouty.png" alt="" width="100" height="100">
                            </div>
                            <a><b>SIP KPTA</b><br>Sistem Informasi</a>
                        </div>
                        <form action="<?= base_url(); ?>/Auth/register" method="post" id="formregister">
                            <div class="input-group form-group mb-3">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="far fa-id-card"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group form-group mb-3">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
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
                            <input type="checkbox" onclick="myFunction2()">&nbsp Show Password
                            <div class="input-group form-group mb-3">
                                <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                <br>
                                <script>
                                    function myFunction2() {
                                        var x = document.getElementById("repeatPassword");
                                        if (x.type === "repeatPassword") {
                                            x.type = "text";
                                        } else {
                                            x.type = "repeatPassword";
                                        }
                                    }
                                </script>
                            </div>
                            <div class="input-group form-group mb-3">
                                <select class="form-select form-control" name="role" id="role" aria-label="Default select example">
                                    <option selected value="admin">- Role -</option>
                                    <option value="admin">Admin Prodi</option>
                                    <option value="sekprod">Sekertaris Prodi</option>
                                    <option value="kaprodi">Kaprodi</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="far fa-id-card"></span>
                                    </div>
                                </div>
                            </div>
                            <p>Hasil dari <br></p>
                            <div class="input-group form-group mb-3">
                                <input type="number" class="form-control" style="width: 50px;" value="<?= rand(1, 10) ?>" name="angka1" autocomplete="false" readonly> &nbsp&nbsp&nbsp+&nbsp&nbsp&nbsp
                                <input type="number" class="form-control" style="width: 50px;" value="<?= rand(1, 10) ?>" name="angka2" autocomplete="false" readonly>
                            </div>
                            <p>adalah?</p>
                            <div class="input-group form-group mb-3">
                                <input type="text" class="form-control" placeholder="Jawaban" id="jawaban" name="c" autocomplete="false">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-equals"></span>
                                    </div>
                                </div>
                            </div>
                            <?php if ($errors != null) : ?>
                                <p class="text-warning">
                                    <?php
                                    foreach ($errors as $err) {
                                        echo $err . '<br>';
                                    }
                                    ?>
                                </p>
                            <?php endif ?>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Add Product-->

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/Register/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Yakin untuk menghapus User dengan Username berikut?</h4>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control username2" required name="username2" id="username2" placeholder="Username" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="username2" class="username2">
                    <input type="hidden" name="role" class="role">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<script>
    $(function() {

        $('.btn-delete').on('click', function() {
            const username2 = $(this).data('username2');
            const role = $(this).data('role');
            $('.username2').val(username2);
            $('.role').val(role);
            $('#deleteModal').modal('show');
        });

        $('#formregister').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 5,
                    maxlength: 15,
                    username: true,
                    remote: {
                        url: "<?= base_url(); ?>/Auth/cekUsername",
                        type: "post",
                        data: {
                            username: function() {
                                return $('#username').val();
                            }
                        }
                    }
                },
                nama: {
                    required: true,
                    nama: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                repeatPassword: {
                    required: true,
                    equalTo: "#password"
                },
                role: {
                    required: true,
                },
                c: {
                    required: true,
                },
            },
            messages: {
                username: {
                    required: "Username Wajib Diisi",
                    minlength: "Username Minimal 5 Karakter",
                    maxlength: "Username Maximal 15 Karakter",
                    username: "Username Hanya Boleh Huruf dan Angka",
                    remote: jQuery.validator.format("{0} Sudah Pernah Dipakai"),
                },
                nama: {
                    required: "Nama Wajib Diisi",
                    nama: "Nama Harus Valid",
                },
                password: {
                    required: "Password Wajib Diisi",
                    minlength: "Password Minimal 8 Karakter",
                },
                repeatPassword: {
                    required: "Password Wajib Diisi",
                    equalTo: "Password Tidak Sama",
                },
                role: {
                    required: "Role Wajib Diisi",
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
    jQuery.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9_]+$/.test(value);
    });
    jQuery.validator.addMethod("nama", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
    });
</script>
<?= $this->endsection(); ?>