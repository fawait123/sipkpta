<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$success = $session->getFlashdata('success');
$message = $session->getFlashdata('message');
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
        <form role="form" action="<?= base_url(''); ?>/Dosen/importExcel" id="formimportexcel" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Import Excel</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="fileexcel" id="file" required accept=".xls, .xlsx">
                        <label class="custom-file-label" for="fileexcel">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary float-right" type="submit">Upload</button>
            </div>
        </form>
        <br>
        <br>
        <hr>
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle"></i> Tambah Data</button>
        <table id="example2" class="table table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Jabatan Fungsional</th>
                    <th>Status Homebase</th>
                    <th>Status Menjabat</th>
                    <th>Link Grup Bimbingan KP</th>
                    <th>Link Grup Bimbingan TA</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_dosen as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nik; ?></td>
                        <td><?= $row->nidn; ?></td>
                        <td><?= $row->nama_dosen; ?></td>
                        <td><?= $row->no_telp; ?></td>
                        <td><?= $row->email; ?></td>
                        <td><?= $row->jabatan_fungsional; ?></td>
                        <td><?= $row->status_homebase; ?></td>
                        <td><?= $row->status_menjabat; ?></td>
                        <td><a href="<?= $row->link_kp; ?>" target="_blank"><?= $row->link_kp; ?></a> </td>
                        <td><a href="<?= $row->link_ta; ?>" target="_blank"><?= $row->link_ta; ?></a> </td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-edit" data-nik="<?= $row->nik; ?>" data-nama_dosen="<?= $row->nama_dosen; ?>" data-nidn="<?= $row->nidn; ?>" data-jabatan_fungsional="<?= $row->jabatan_fungsional; ?>" data-status_homebase="<?= $row->status_homebase; ?>" data-no_telp="<?= $row->no_telp; ?>" data-status_menjabat="<?= $row->status_menjabat; ?>" data-email="<?= $row->email; ?>" data-link_kp="<?= $row->link_kp; ?>" data-link_ta="<?= $row->link_ta; ?>">
                                <i class="far fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-nik="<?= $row->nik; ?>"><i class="far fa-trash-alt"></i></a>
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
<form role="form" action="<?= base_url(''); ?>/Dosen/save" id="formtambahdosen" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" required name="nik" id="nik" placeholder="NIK">
                    </div>
                    <div class="form-group">
                        <label>NIDN</label>
                        <input type="text" class="form-control" required name="nidn" id="nidn" placeholder="NIDN">
                    </div>
                    <div class="form-group">
                        <label>Nama Dosen</label>
                        <input type="text" class="form-control" required name="nama_dosen" id="nama_dosen" placeholder="Nama Dosen">
                    </div>
                    <div class="form-group">
                        <label>No. Telp</label>
                        <input type="text" class="form-control" required name="no_telp" id="kateno_telpgori" placeholder="No. Telp">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control" required name="email" id="email" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <label>Jabatan Fungsional</label>
                        <select class="form-control" required name="jabatan_fungsional" id="jabatan_fungsional" placeholder="Jabatan Fungsional">
                            <option value="Pra AA">Pra AA</option>
                            <option value="Asisten Ahli">Asisten Ahli</option>
                            <option value="Lektor">Lektor</option>
                            <option value="Lektor Kepala">Lektor Kepala</option>
                            <option value="Guru Besar">Guru Besar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Homebase</label>
                        <select class="form-control" required name="status_homebase" id="status_homebase" placeholder="Status Homebase">
                            <option value="SI">SI</option>
                            <option value="Non SI">Non SI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Menjabat</label>
                        <select class="form-control" required name="status_menjabat" id="status_menjabat" placeholder="Status Menjabat">
                            <option value="Iya">Iya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Link Grup Bimbingan KP</label>
                        <input type="text" class="form-control" name="link_kp" id="link_kp" placeholder="Link Grup Bimbingan KP">
                    </div>
                    <div class="form-group">
                        <label>Link Grup Bimbingan TA</label>
                        <input type="text" class="form-control" name="link_ta" id="link_ta" placeholder="Link Grup Bimbingan TA">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Product-->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/Dosen/update" id="formeditdosen" method="post">
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

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/Dosen/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Yakin untuk menghapus Data Dosen dengan NIK berikut?</h4>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control nik" required name="nik" id="nik" placeholder="NIK" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="nik" class="nik">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

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

        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const nik = $(this).data('nik');
            // Set data to Form Edit
            $('.nik').val(nik);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

        $('#formtambahdosen').validate({
            rules: {
                nik: {
                    required: true,
                    numeric: true,
                    remote: {
                        url: "<?= base_url(); ?>/Dosen/cekNik",
                        type: "post",
                        data: {
                            nik: function() {
                                return $('#nik').val();
                            }
                        }
                    }
                },
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
                },
                link_ta: {
                    maxlength: 255,
                },
            },
            messages: {
                nik: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid",
                    remote: jQuery.validator.format("{0} Sudah Ada"),
                },
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
                    maxlength: "Link Terlalu Panjang",
                },
                link_ta: {
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