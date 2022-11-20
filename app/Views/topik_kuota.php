<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$success = $session->getFlashdata('success');
?>
<!-- Default box -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $title; ?> <?= $jenis; ?></h3>
    </div>
    <div class="card-body">
        <form id="clear">
            <div class="form-group" id="filter_col2" data-column="2">
                <label>Nama Dosen</label>
                <select name="filter_nik" class="form-control column_filter" id="col2_filter">
                    <option value="">-Select-</option>
                    <?php foreach ($tb_dosen as $row) : ?>
                        <option><?= $row->nama_dosen; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
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
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle"></i> Tambah Topik dan Kuota Dosen</button>
        <table id="example2" class="table table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Dosen</th>
                    <th>Topik</th>
                    <th>Kuota Awal</th>
                    <th>Kuota Diambil</th>
                    <th>Kuota</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_detail_topik as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nik; ?></td>
                        <td><?= $row->nama_dosen; ?></td>
                        <td><?= $row->nama_topik; ?></td>
                        <td><?= $row->kuota_awal; ?></td>
                        <td>
                            <?php $kuota_diambil = $row->kuota_awal - $row->kuota; ?>
                            <?= $kuota_diambil; ?>
                        </td>
                        <td><?= $row->kuota; ?></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-edit" data-kode_detail="<?= $row->kode_detail; ?>" data-nama_topik="<?= $row->nama_topik; ?>" data-nama_dosen="<?= $row->nama_dosen; ?>" data-kuota="<?= $row->kuota; ?>" data-jenis="<?= $row->jenis; ?>" data-kuota_diambil="<?= $kuota_diambil; ?>">
                                <i class="far fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete" data-kode_detail="<?= $row->kode_detail; ?>"><i class="far fa-trash-alt"></i></a>
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
<form role="form" action="<?= base_url(''); ?>/TopikKuota/save" id="formtambahdetailtopik" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Detail Topik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php
                        foreach ($kode_detail as $data2) :
                            $a = $data2->kode_detail;
                            $a++;
                            date_default_timezone_set('Asia/Jakarta');
                            $tanggal = date('YmdHs');
                            $huruf = "DT";
                            $kode_detail = $huruf . $tanggal . sprintf("%03s", $a);
                        ?>
                            <input type="hidden" class="form-control" name="kode_detail" id="kode_detail" value="<?= $kode_detail; ?>" readonly>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($jenis == "KP") {
                    ?>
                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <select name="nik" id="nik" class="form-control select2">
                                <option value="">-Select-</option>
                                <?php foreach ($tb_dosen as $row) : ?>
                                    <option value="<?= $row->nik; ?>"><?= $row->nama_dosen; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Topik</label>
                            <select id="kode_topik" name="kode_topik" class="form-control select2" required>
                                <option value="">-Select-</option>
                            </select>
                        </div>
                    <?php
                    } else { ?>
                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <select name="nik2" id="nik2" class="form-control select2">
                                <option value="">-Select-</option>
                                <?php foreach ($tb_dosen as $row) : ?>
                                    <option value="<?= $row->nik; ?>"><?= $row->nama_dosen; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Topik</label>
                            <select id="kode_topik2" name="kode_topik2" class="form-control select2" required>
                                <option value="">-Select-</option>
                            </select>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Kuota</label>
                        <input type="number" class="form-control" min="0" max="99" name="kuota" id="kuota" placeholder="Kuota">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control" name="jenis" id="jenis" value="<?= $jenis; ?>">
                    <input type="hidden" class="form-control" name="tahun_ajaran" id="tahun_ajaran" value="<?= $tahun_ajaran; ?>">
                    <input type="hidden" class="form-control" name="semester" id="semester" value="<?= $semester; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Product-->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/TopikKuota/update" id="formeditdetailtopik" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Detail Topik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="text" class="form-control nama_dosen" name="nama_dosen" id="nama_dosen" readonly>
                        </div>
                        <div class="form-group">
                            <label>Topik</label>
                            <input type="text" class="form-control nama_topik" name="nama_topik" id="nama_topik" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <input type="text" class="form-control jenis" required name="jenis" id="jenis" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kuota Awal</label>
                            <input type="number" class="form-control kuota_awal" min="0" max="99" name="kuota_awal" id="kuota_awal" placeholder="Kuota Awal">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="kuota_diambil" name="kuota_diambil" id="kuota_diambil">
                        <input type="hidden" name="kode_detail" class="kode_detail">
                        <input type="hidden" class="form-control" name="jenis" id="jenis" value="<?= $jenis; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/TopikKuota/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Detail Topik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Yakin untuk menghapus Data Detail Topik dengan Kode berikut?</h4>
                    <div class="form-group">
                        <label>Kode Detail Topik</label>
                        <input type="text" class="form-control kode_detail" name="kode_detail" id="kode_detail" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kode_detail" class="kode_detail">
                    <input type="hidden" class="form-control" name="jenis" id="jenis" value="<?= $jenis; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<script type="text/javascript">
    function filterGlobal() {
        $('#example2').DataTable().search(
            $('#global_filter').val(),
        ).draw();
    }

    function filterColumn(i) {
        $('#example2').DataTable().column(i).search(
            $('#col' + i + '_filter').val()
        ).draw();
    }

    $(document).ready(function() {

        $('#ex').DataTable();

        $('select.column_filter').on('change', function() {
            filterColumn($(this).parents('div').attr('data-column'));
        });

        $("#nik").on('change', function() {
            $("#kode_topik").empty();
            var nik = $("#nik").val();
            $.ajax({
                url: "<?= site_url('TopikKuota/getTopikKP') ?>",
                type: 'GET',
                data: {
                    'nik': nik,
                },
                dataType: 'json',
                success: function(data) {
                    var html = '<option value="">- Pilih Topik -</option>';
                    for (var count = 0; count < data.length; count++) {
                        html += '<option value="' + data[count].kode_topik + '">' + data[count].nama_topik + '</option>';
                    }
                    $('#kode_topik').html(html);
                },
            });
        });

        $("#nik2").on('change', function() {
            $("#kode_topik2").empty();
            var nik2 = $("#nik2").val();
            $.ajax({
                url: "<?= site_url('TopikKuota/getTopikTA') ?>",
                type: 'GET',
                data: {
                    'nik2': nik2,
                },
                dataType: 'json',
                success: function(data) {
                    var html = '<option value="">- Pilih Topik -</option>';
                    for (var count = 0; count < data.length; count++) {
                        html += '<option value="' + data[count].kode_topik + '">' + data[count].nama_topik + '</option>';
                    }
                    $('#kode_topik2').html(html);
                },
            });
        });

        $('.btn-edit').on('click', function() {
            const kode_detail = $(this).data('kode_detail');
            const nama_dosen = $(this).data('nama_dosen');
            const nama_topik = $(this).data('nama_topik');
            const jenis = $(this).data('jenis');
            const kuota = $(this).data('kuota');
            const kuota_awal = $(this).data('kuota_awal');
            const kuota_diambil = $(this).data('kuota_diambil');
            $('.kode_detail').val(kode_detail);
            $('.nama_dosen').val(nama_dosen);
            $('.nama_topik').val(nama_topik);
            $('.jenis').val(jenis);
            $('.kuota').val(kuota);
            $('.kuota_awal').val(kuota_awal);
            $('.kuota_diambil').val(kuota_diambil);
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.btn-delete').on('click', function() {
            const kode_detail = $(this).data('kode_detail');
            $('.kode_detail').val(kode_detail);
            $('#deleteModal').modal('show');
        });

        $('#formtambahdetailtopik').validate({
            rules: {
                nik: {
                    required: true,
                },
                kode_topik: {
                    required: true,
                },
                kuota: {
                    required: true,
                    numeric: true,
                },
                jenis: {
                    required: true,
                },
            },
            messages: {
                nik: {
                    required: "Wajib Diisi",
                },
                kode_topik: {
                    required: "Wajib Diisi",
                },
                kuota: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid"
                },
                jenis: {
                    required: "Wajib Diisi",
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

        $('#formeditdetailtopik').validate({
            rules: {
                kuota: {
                    required: true,
                    numeric: true,
                },
            },
            messages: {
                kuota: {
                    required: "Wajib Diisi",
                    numeric: "Tidak Valid"
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

        jQuery.validator.addMethod("numeric", function(value, element) {
            return this.optional(element) || /^[0-9-+]+$/.test(value);
        });
    });
</script>

<?= $this->endsection(); ?>