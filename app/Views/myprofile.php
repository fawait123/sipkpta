<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$success = $session->getFlashdata('success');
$message = $session->getFlashdata('message');
?>
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
<?php if ($message != null) : ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php
        foreach ($message as $mess) {
            echo $mess . '<br>';
        }
        ?>
    </div>
<?php endif ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <?php foreach ($user as $row) : ?>
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url(''); ?>/foto/profile/profile.png" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $row->username ?></h3>

                            <p class="text-muted text-center">
                                <?php if ($role == "kaprodi") {
                                    echo $row->nama_kaprodi;
                                } elseif ($role == "sekrprod") {
                                    echo $row->nama_sekprod;
                                } elseif ($role == "admin") {
                                    echo $row->nama_admin;
                                } elseif ($role == "dosen") {
                                    echo $row->nama_dosen;
                                } elseif ($role == "mahasiswa") {
                                    echo $row->nama_mahasiswa;
                                } ?>
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Program Studi Sistem Informasi</b>
                                </li>
                                <li class="list-group-item">
                                    <b>Fakultas Sains & Teknologi</b>
                                </li>
                                <li class="list-group-item">
                                    <b>Universitas Teknologi Yogyakarta</b>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    <?php endforeach ?>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane">
                            <?php foreach ($user as $row) :
                                if ($role == "mahasiswa") { ?>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">NPM :</label>
                                        <div class="col-sm-10">
                                            <a>: <?= $row->username ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <a>: <?= $row->nama_mahasiswa ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">No. Telp</label>
                                        <div class="col-sm-10">
                                            <a>: <?= $row->no_telp ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <a>: <?= $row->email ?></a>
                                        </div>
                                    </div>
                                <?php
                                } elseif ($role == "dosen") {
                                ?>
                                    <span class="float-right">
                                        <a href="#" class="btn btn-info btn-sm btn-edit" data-nik="<?= $row->nik; ?>" data-nama_dosen="<?= $row->nama_dosen; ?>" data-nidn="<?= $row->nidn; ?>" data-jabatan_fungsional="<?= $row->jabatan_fungsional; ?>" data-status_homebase="<?= $row->status_homebase; ?>" data-no_telp="<?= $row->no_telp; ?>" data-status_menjabat="<?= $row->status_menjabat; ?>" data-email="<?= $row->email; ?>" data-link_kp="<?= $row->link_kp; ?>" data-link_ta="<?= $row->link_ta; ?>">
                                            <i class="far fa-edit"></i>&nbsp; Edit Profile</a>
                                    </span>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-8">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">NIK</label>
                                        <div class="col-sm-8">
                                            <a>: <?= $row->username ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">NIDN</label>
                                        <div class="col-sm-8">
                                            <a>: <?= $row->nidn ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <a>: <?= $row->nama_dosen ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">No. Telp</label>
                                        <div class="col-sm-8">
                                            <a>: <?= $row->no_telp ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <a>: <?= $row->email ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Jabatan Fungsional</label>
                                        <div class="col-sm-8">
                                            <a>: <?= $row->jabatan_fungsional ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Status Homebase</label>
                                        <div class="col-sm-8">
                                            <a>: <?= $row->status_homebase ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Status Menjabat</label>
                                        <div class="col-sm-8">
                                            <a>: <?= $row->status_menjabat ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Link Grup Bimbingan KP</label>
                                        <div class="col-sm-8">
                                            <a>: <a href="<?= $row->link_kp; ?>" target="_blank"><?= $row->link_kp; ?></a></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Link Grup Bimbingan TA</label>
                                        <div class="col-sm-8">
                                            <a>: <a href="<?= $row->link_ta; ?>" target="_blank"><?= $row->link_ta; ?></a></a>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">NIK</label>
                                        <div class="col-sm-10">
                                            <a>: <?= $row->username ?></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <a>: <?php if ($role == "kaprodi") {
                                                        echo $row->nama_kaprodi;
                                                    } elseif ($role == "sekrprod") {
                                                        echo $row->nama_sekprod;
                                                    } elseif ($role == "admin") {
                                                        echo $row->nama_admin;
                                                    } ?></a>
                                        </div>
                                    </div>
                            <?php }
                            endforeach; ?>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</section>
<!-- /.content -->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/MyProfile/update" id="formeditdosen" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control nik" required readonly name="nik" id="nik" placeholder="NIK">
                    </div>
                    <div class="form-group">
                        <label>NIDN</label>
                        <input type="text" class="form-control nidn" required name="nidn" id="nidn" placeholder="NIDN">
                    </div>
                    <div class="form-group">
                        <label>Nama Dosen</label>
                        <input type="text" class="form-control nama_dosen" required name="nama_dosen" id="nama_dosen" placeholder="Nama Dosen">
                    </div>
                    <div class="form-group">
                        <label>No. Telp</label>
                        <input type="text" class="form-control no_telp" required name="no_telp" id="kateno_telpgori" placeholder="No. Telp">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control email" required name="email" id="email" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <label>Jabatan Fungsional</label>
                        <select class="form-control jabatan_fungsional" required name="jabatan_fungsional" id="jabatan_fungsional" placeholder="Jabatan Fungsional">
                            <option value="Pra AA">Pra AA</option>
                            <option value="Asisten Ahli">Asisten Ahli</option>
                            <option value="Lektor">Lektor</option>
                            <option value="Lektor Kepala">Lektor Kepala</option>
                            <option value="Guru Besar">Guru Besar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Homebase</label>
                        <select class="form-control status_homebase" required name="status_homebase" id="status_homebase" placeholder="Status Homebase">
                            <option value="SI">SI</option>
                            <option value="Non SI">Non SI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Menjabat</label>
                        <select class="form-control status_menjabat" required name="status_menjabat" id="status_menjabat" placeholder="Status Menjabat">
                            <option value="Iya">Iya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Link Grup Bimbingan KP</label>
                        <input type="text" class="form-control link_kp" required name="link_kp" id="link_kp" placeholder="Link Grup Bimbingan KP">
                    </div>
                    <div class="form-group">
                        <label>Link Grup Bimbingan TA</label>
                        <input type="text" class="form-control link_ta" required name="link_ta" id="link_ta" placeholder="Link Grup Bimbingan TA">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="nik" class="nik">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->
<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init()

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const nik = $(this).data('nik');
            const nama_dosen = $(this).data('nama_dosen');
            const nidn = $(this).data('nidn');
            const no_telp = $(this).data('no_telp');
            const email = $(this).data('email');
            const jabatan_fungsional = $(this).data('jabatan_fungsional');
            const status_homebase = $(this).data('status_homebase');
            const status_menjabat = $(this).data('status_menjabat');
            const link_kp = $(this).data('link_kp');
            const link_ta = $(this).data('link_ta');
            // Set data to Form Edit
            $('.nik').val(nik);
            $('.nama_dosen').val(nama_dosen);
            $('.nidn').val(nidn);
            $('.no_telp').val(no_telp);
            $('.email').val(email);
            $('.jabatan_fungsional').val(jabatan_fungsional);
            $('.status_homebase').val(status_homebase);
            $('.status_menjabat').val(status_menjabat);
            $('.link_kp').val(link_kp);
            $('.link_ta').val(link_ta);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        $('#formeditdosen').validate({
            rules: {
                nidn: {
                    required: true,
                    numeric: true,
                    remote: {
                        url: "<?= base_url(); ?>/Dosen/cekNidn",
                        type: "post",
                        data: {
                            nidn: function() {
                                return $('#nidn').val();
                            }
                        }
                    }
                },
                nama_dosen: {
                    required: true,
                },
                no_telp: {
                    required: true,
                    numeric: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                jabatan_fungsional: {
                    required: true,
                },
                status_homebase: {
                    required: true,
                },
                status_menjabat: {
                    required: true,
                },
                link_kp: {
                    maxlength: 255,
                    required: true,

                },
                link_ta: {
                    maxlength: 255,
                    required: true,
                },
            },
            messages: {
                nidn: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid",
                    remote: jQuery.validator.format("{0} Sudah Ada"),
                },
                nama_dosen: {
                    required: "Nama Wajib Diisi",
                },
                no_telp: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid"
                },
                email: {
                    required: "Wajib Diisi",
                    email: "Tidak Valid"
                },
                jabatan_fungsional: {
                    required: "Wajib Diisi",
                },
                status_menjabat: {
                    required: "Wajib Diisi",
                },
                status_homebase: {
                    required: "Wajib Diisi",
                },
                link_kp: {
                    required: "Wajib Diisi",
                    maxlength: "Link Terlalu Panjang",
                },
                link_ta: {
                    required: "Wajib Diisi",
                    maxlength: "Link Terlalu Panjang",
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

        jQuery.validator.addMethod("nama", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        });

        jQuery.validator.addMethod("numeric", function(value, element) {
            return this.optional(element) || /^[0-9-+]+$/.test(value);
        });

    });
</script>

<?= $this->endsection(); ?>