<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$success = $session->getFlashdata('success');
$message = $session->getFlashdata('message');
?>
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
        <form role="form" action="<?= base_url(''); ?>/Mahasiswa/importExcel" id="formimportexcel" method="post" enctype="multipart/form-data">
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
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>NIK (Nomor Induk Kependudukan)</th>
                    <th>TTL</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_mahasiswa as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->npm; ?></td>
                        <td><?= $row->nama_mahasiswa; ?></td>
                        <td><?= $row->ni_kependudukan; ?></td>
                        <td>
                            <?= $row->tempat_lahir; ?>, &nbsp;
                            <?php echo date("d-M-Y", strtotime($row->tanggal_lahir)); ?>
                        </td>
                        <td><?= $row->no_telp; ?></td>
                        <td><?= $row->email; ?></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-edit" data-npm="<?= $row->npm; ?>" data-nama_mahasiswa="<?= $row->nama_mahasiswa; ?>" data-ni_kependudukan="<?= $row->ni_kependudukan; ?>" data-tanggal_lahir="<?= $row->tanggal_lahir; ?>" data-tempat_lahir="<?= $row->tempat_lahir; ?>" data-no_telp="<?= $row->no_telp; ?>" data-email="<?= $row->email; ?>">
                                <i class="far fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-npm="<?= $row->npm; ?>"><i class="far fa-trash-alt"></i></a>
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
<form role="form" action="<?= base_url(''); ?>/Mahasiswa/save" id="formtambahmahasiswa" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NPM</label>
                        <input type="text" class="form-control" required name="npm" id="npm" placeholder="NPM">
                    </div>
                    <div class="form-group">
                        <label>Nama Mahasiwa</label>
                        <input type="text" class="form-control" required name="nama_mahasiswa" id="nama_mahasiswa" placeholder="Nama Mahasiwa">
                    </div>
                    <div class="form-group">
                        <label>NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" class="form-control" required name="ni_kependudukan" id="ni_kependudukan" placeholder="NIK">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" required name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <label>Tanmggal Lahir</label>
                        <input type="date" class="form-control" required name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir">
                    </div>
                    <div class="form-group">
                        <label>No. Telp</label>
                        <input type="text" class="form-control" required name="no_telp" id="kateno_telpgori" placeholder="No. Telp">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control" required name="email" id="email" placeholder="E-mail">
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
<form role="form" action="<?= base_url(''); ?>/Mahasiswa/update" id="formeditmahasiswa" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NPM</label>
                        <input type="text" class="form-control npm" required name="npm" id="npm" placeholder="NPM" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Mahasiwa</label>
                        <input type="text" class="form-control nama_mahasiswa" required name="nama_mahasiswa" id="nama_mahasiswa" placeholder="Nama Mahasiwa">
                    </div>
                    <div class="form-group">
                        <label>NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" class="form-control ni_kependudukan" required name="ni_kependudukan" id="ni_kependudukan" placeholder="NIK">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control tempat_lahir" required name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <label>Tanmggal Lahir</label>
                        <input type="date" class="form-control tanggal_lahir" required name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir">
                    </div>
                    <div class="form-group">
                        <label>No. Telp</label>
                        <input type="text" class="form-control no_telp" required name="no_telp" id="kateno_telpgori" placeholder="No. Telp">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control email" required name="email" id="email" placeholder="E-mail">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="npm" class="npm">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/Mahasiswa/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Yakin untuk menghapus Data Mahasiswa dengan NPM berikut?</h4>
                    <div class="form-group">
                        <label>NPM</label>
                        <input type="text" class="form-control npm" required name="npm" id="npm" placeholder="NPM" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="npm" class="npm">
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

        $('.btn-edit').on('click', function() {
            const npm = $(this).data('npm');
            const nama_mahasiswa = $(this).data('nama_mahasiswa');
            const ni_kependudukan = $(this).data('ni_kependudukan');
            const tempat_lahir = $(this).data('tempat_lahir');
            const tanggal_lahir = $(this).data('tanggal_lahir');
            const no_telp = $(this).data('no_telp');
            const email = $(this).data('email');
            $('.npm').val(npm);
            $('.nama_mahasiswa').val(nama_mahasiswa);
            $('.ni_kependudukan').val(ni_kependudukan);
            $('.tempat_lahir').val(tempat_lahir);
            $('.tanggal_lahir').val(tanggal_lahir);
            $('.no_telp').val(no_telp);
            $('.email').val(email);
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const npm = $(this).data('npm');
            // Set data to Form Edit
            $('.npm').val(npm);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

        $('#formtambahmahasiswa').validate({
            rules: {
                npm: {
                    required: true,
                    numeric: true,
                    remote: {
                        url: "<?= base_url(); ?>/Mahasiswa/cekNpm",
                        type: "post",
                        data: {
                            npm: function() {
                                return $('#npm').val();
                            }
                        }
                    }
                },
                nama_mahasiswa: {
                    required: true,
                    nama: true,
                },
                ni_kependudukan: {
                    required: true,
                    numeric: true,
                },
                tempat_lahir: {
                    required: true,
                },
                tanggal_lahir: {
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
            },
            messages: {
                npm: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid",
                    remote: jQuery.validator.format("{0} Sudah Ada"),
                },
                nama_mahasiswa: {
                    required: "Nama Wajib Diisi",
                    nama: "Nama Harus Valid",
                },
                ni_kependudukan: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid"
                },
                tempat_lahir: {
                    required: "Wajib Diisi",
                },
                tanggal_lahir: {
                    required: "Wajib Diisi",
                },
                no_telp: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid"
                },
                email: {
                    required: "Wajib Diisi",
                    email: "Tidak Valid"
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

        $('#formeditmahasiswa').validate({
            rules: {
                nama_mahasiswa: {
                    required: true,
                    nama: true,
                },
                ni_kependudukan: {
                    required: true,
                    numeric: true,
                },
                tempat_lahir: {
                    required: true,
                },
                tanggal_lahir: {
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
            },
            messages: {
                nama_mahasiswa: {
                    required: "Nama Wajib Diisi",
                    nama: "Nama Harus Valid",
                },
                ni_kependudukan: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid"
                },
                tempat_lahir: {
                    required: "Wajib Diisi",
                },
                tanggal_lahir: {
                    required: "Wajib Diisi",
                },
                no_telp: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid"
                },
                email: {
                    required: "Wajib Diisi",
                    email: "Tidak Valid"
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
            return this.optional(element) || /^[a-z\'\.\s]+$/i.test(value);
        });

        jQuery.validator.addMethod("numeric", function(value, element) {
            return this.optional(element) || /^[0-9-+]+$/.test(value);
        });

    });
</script>

<?= $this->endsection(); ?>