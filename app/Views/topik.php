<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$success = $session->getFlashdata('success');
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
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle"></i> Tambah Topik</button>
        <table id="example2" class="table table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Topik</th>
                    <th>Topik</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_topik as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->kode_topik; ?></td>
                        <td><?= $row->nama_topik; ?></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-edit" data-kode_topik="<?= $row->kode_topik; ?>" data-nama_topik="<?= $row->nama_topik; ?>">
                                <i class="far fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-kode_topik="<?= $row->kode_topik; ?>"><i class="far fa-trash-alt"></i></a>
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
<form role="form" action="<?= base_url(''); ?>/Topik/save" id="formtambahtopik" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Topik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php
                        foreach ($kode as $data) :
                            $a = $data->kode_topik;
                            $a++;
                            date_default_timezone_set('Asia/Jakarta');
                            $tanggal = date('YmdHs');
                            $huruf = "T";
                            $kode = $huruf . $tanggal . sprintf("%03s", $a);
                        ?>
                            <input type="hidden" class="form-control" required name="kode_topik" id="kode_topik" value="<?= $kode; ?>" readonly>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label>Topik</label>
                        <input type="text" class="form-control" required name="nama_topik" id="nama_topik" placeholder="Nama Topik">
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
<form role="form" action="<?= base_url(''); ?>/Topik/update" id="formedittopik" method="post">
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
                        <label>Kode Topik</label>
                        <input type="text" class="form-control kode_topik" required name="kode_topik" id="kode_topik" placeholder="Kode Topik" readonly>
                    </div>
                    <div class="form-group">
                        <label>Topik</label>
                        <input type="text" class="form-control nama_topik" required name="nama_topik" id="nama_topik" placeholder="Nama Topik">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kode_topik" class="kode_topik">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/Topik/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Topik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Yakin untuk menghapus Data Topik dengan Kode Topik berikut?</h4>
                    <div class="form-group">
                        <label>Kode Topik</label>
                        <input type="text" class="form-control kode_topik" required name="kode_topik" id="kode_topik" placeholder="Kode Topik" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kode_topik" class="kode_topik">
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

        $('.btn-edit').on('click', function() {
            const kode_topik = $(this).data('kode_topik');
            const nama_topik = $(this).data('nama_topik');
            $('.kode_topik').val(kode_topik);
            $('.nama_topik').val(nama_topik);
            $('#editModal').modal('show');
        });

        $('.btn-delete').on('click', function() {
            const kode_topik = $(this).data('kode_topik');
            $('.kode_topik').val(kode_topik);
            $('#deleteModal').modal('show');
        });

        $('#formtambahtopik').validate({
            rules: {
                nama_topik: {
                    required: true,
                    nama: true,
                    remote: {
                        url: "<?= base_url(); ?>/Topik/cekTopik",
                        type: "post",
                        data: {
                            nama_topik: function() {
                                return $('#nama_topik').val();
                            }
                        }
                    }
                },
            },
            messages: {
                nama_topik: {
                    required: "Topik Wajib Diisi",
                    nama: "Topik Harus Valid",
                    remote: jQuery.validator.format("{0} Sudah Ada"),
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

        $('#formedittopik').validate({
            rules: {
                nama_topik: {
                    required: true,
                    nama: true,
                    remote: {
                        url: "<?= base_url(); ?>/Topik/cekTopik",
                        type: "post",
                        data: {
                            nama_topik: function() {
                                return $('#nama_topik').val();
                            }
                        }
                    }
                },
            },
            messages: {
                nama_topik: {
                    required: "Topik Wajib Diisi",
                    nama: "Topik Harus Valid",
                    remote: jQuery.validator.format("{0} Sudah Ada"),
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

    });
</script>

<?= $this->endsection(); ?>