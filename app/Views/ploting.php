<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$errors = $session->getFlashdata('errors');
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
        <table id="example2" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Topik</th>
                    <th>Dosen Dipilih</th>
                    <th>Reviewer 1 / Dosen Pembimbing</th>
                    <th>Reviewer 2</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_ploting as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->npm; ?></td>
                        <td><?= $row->nama_mahasiswa; ?></td>
                        <td><?= $row->judul; ?></td>
                        <td><?= $row->nama_topik; ?></td>
                        <td align="center">
                            <?= $row->nama_dosen; ?>
                            <hr>
                            <a href="#" class="btn btn-danger btn-sm btn-edit_dosen" data-no_pengajuan="<?= $row->no_pengajuan; ?>" data-no_ploting_pembimbing="<?= $row->no_ploting_pembimbing; ?>" data-no_disposisi="<?= $row->no_disposisi; ?>" data-kode_detail3="<?= $row->kode_detail; ?>" data-nama_dosen="<?= $row->nama_dosen; ?>" data-nama_topik="<?= $row->nama_topik; ?>"><i class="far fa-edit"></i></a>
                        </td>
                        <td>
                            <?= $row->nama_pembimbing; ?>
                            <br>
                            <?php if ($row->status_review == "Sudah Direview") { ?>
                                <span class="badge badge-success">
                                    <?= $row->status_review; ?>
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-danger">
                                    <?= $row->status_review; ?>
                                </span>
                            <?php } ?>
                            <br>
                            <hr>
                            <form action="<?= base_url(); ?>/Ploting/updatePembimbing" method="post">
                                <div class="form-group">
                                    <select id="nik" name="nik" class="form-control select2" required>
                                        <option value="">- Pilih Dosen -</option>
                                        <?php foreach ($jumlah_pembimbing as $row2) : ?>
                                            <option value="<?= $row2->nik; ?>"><?= $row2->nama_dosen; ?> - <?php if ($row2->jumlah_bimbingan == null) {
                                                                                                                echo 0;
                                                                                                            } else {
                                                                                                                echo $row2->jumlah_bimbingan;
                                                                                                            } ?>, <?php if ($row2->jumlah_review == null) {
                                                                                                                        echo 0;
                                                                                                                    } else {
                                                                                                                        echo $row2->jumlah_review;
                                                                                                                    } ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" name="submit" class="btn btn-danger btn-block btn-flat">
                                        <i class="far fa-edit"></i></button>
                                </div>
                                <?php foreach ($user as $row3) : ?>
                                    <input type="hidden" name="id_kaprodi" value="<?= $row3->id_kaprodi; ?>">
                                <?php endforeach ?>
                                <input type="hidden" name="no_ploting_pembimbing" id="no_ploting_pembimbing" value="<?= $row->no_ploting_pembimbing; ?>">
                                <input type="hidden" name="no_disposisi" id="no_disposisi" value="<?= $row->no_disposisi; ?>">
                                <input type="hidden" name="jenis" id="jenis" value="<?= $jenis; ?>">
                            </form>
                        </td>
                        <td>
                            <?= $row->nama_reviewer; ?>
                            <br>
                            <?php if ($row->status_review2 == "Sudah Direview") { ?>
                                <span class="badge badge-success">
                                    <?= $row->status_review2; ?>
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-danger">
                                    <?= $row->status_review2; ?>
                                </span>
                            <?php } ?>
                            <br>
                            <hr>
                            <form action="<?= base_url(); ?>/Ploting/updateReviewer" method="post">
                                <div class="form-group">
                                    <select id="nik" name="nik" class="form-control select2" required>
                                        <option value="">- Pilih Dosen -</option>
                                        <?php foreach ($jumlah_pembimbing as $row2) : ?>
                                            <option value="<?= $row2->nik; ?>"><?= $row2->nama_dosen; ?> - <?php if ($row2->jumlah_bimbingan == null) {
                                                                                                                echo 0;
                                                                                                            } else {
                                                                                                                echo $row2->jumlah_bimbingan;
                                                                                                            } ?>, <?php if ($row2->jumlah_review == null) {
                                                                                                                        echo 0;
                                                                                                                    } else {
                                                                                                                        echo $row2->jumlah_review;
                                                                                                                    } ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" name="submit" class="btn btn-danger btn-block btn-flat">
                                        <i class="far fa-edit"></i></button>
                                </div>
                                <?php foreach ($user as $row3) : ?>
                                    <input type="hidden" name="id_kaprodi" value="<?= $row3->id_kaprodi; ?>">
                                <?php endforeach ?>
                                <input type="hidden" name="no_ploting_reviewer" id="no_ploting_reviewer" value="<?= $row->no_ploting_reviewer; ?>">
                                <input type="hidden" name="jenis" id="jenis" value="<?= $jenis; ?>">
                            </form>
                        </td>
                        <td>
                            <?= $row->status_ploting; ?><br>
                            <a href="#" class="btn btn-info btn-sm btn-ploting" <?php if ($row->status_ploting == "Diploting") { ?> style="pointer-events: none;" <?php } ?> data-no_ploting_pembimbing="<?= $row->no_ploting_pembimbing; ?>" data-no_ploting_reviewer="<?= $row->no_ploting_reviewer; ?>">Ploting</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/Ploting/updateDosen" id="formeditdosen" method="post">
    <div class="modal fade" id="editDosenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Dosen Pilihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Topik Awal</label>
                        <input type="text" class="form-control nama_topik" required name="nama_topik" id="nama_topik" readonly>
                    </div>
                    <div class="form-group">
                        <label>Dosen Pilihan Awal</label>
                        <input type="text" class="form-control nama_dosen" required name="nama_dosen" id="nama_dosen" readonly>
                    </div>
                    <hr>
                    <?php if ($jenis == "KP") {
                    ?>
                        <div class="form-group">
                            <label>Topik</label>
                            <select id="kode_topik" name="kode_topik" class="form-control select2" required>
                                <option value="">-Select-</option>
                                <?php foreach ($tb_topik as $row) : ?>
                                    <option value="<?= $row->kode_topik; ?>"><?= $row->nama_topik; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Dosen Pilihan</label>
                            <select id="kode_detail" name="kode_detail" class="form-control select2" required>
                                <option value="">-Select-</option>
                            </select>
                        </div>
                    <?php
                    } else { ?>
                        <br>
                        <div class="form-group">
                            <label>Topik</label>
                            <select id="kode_topik2" name="kode_topik2" class="form-control select2" required>
                                <option value="">-Select-</option>
                                <?php foreach ($tb_topik as $row) : ?>
                                    <option value="<?= $row->kode_topik; ?>"><?= $row->nama_topik; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Dosen Pilihan</label>
                            <select id="kode_detail2" name="kode_detail2" class="form-control select2" required>
                                <option value="">-Select-</option>
                            </select>
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_ploting_pembimbing" class="no_ploting_pembimbing">
                    <input type="hidden" name="no_disposisi" class="no_disposisi">
                    <input type="hidden" name="kode_detail3" class="kode_detail3">
                    <input type="hidden" name="no_pengajuan" class="no_pengajuan">
                    <input type="hidden" name="jenis" id="jenis" value="<?= $jenis; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/Ploting/update" method="post">
    <div class="modal fade" id="plotingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ploting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah Anda Yakin untuk Ploting?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_ploting_pembimbing" class="no_ploting_pembimbing">
                    <input type="hidden" name="no_ploting_reviewer" class="no_ploting_reviewer">
                    <input type="hidden" name="jenis" class="jenis" value="<?= $jenis; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<script>
    $(document).ready(function() {
        $('.btn-ploting').on('click', function() {
            const no_ploting_pembimbing = $(this).data('no_ploting_pembimbing');
            const no_ploting_reviewer = $(this).data('no_ploting_reviewer');
            $('.no_ploting_pembimbing').val(no_ploting_pembimbing);
            $('.no_ploting_reviewer').val(no_ploting_reviewer);
            $('#plotingModal').modal('show');
        });
        $('.btn-edit_dosen').on('click', function() {
            const kode_detail3 = $(this).data('kode_detail3');
            const no_pengajuan = $(this).data('no_pengajuan');
            const no_ploting_pembimbing = $(this).data('no_ploting_pembimbing');
            const no_disposisi = $(this).data('no_disposisi');
            const nama_dosen = $(this).data('nama_dosen');
            const nama_topik = $(this).data('nama_topik');
            $('.kode_detail3').val(kode_detail3);
            $('.no_pengajuan').val(no_pengajuan);
            $('.no_ploting_pembimbing').val(no_ploting_pembimbing);
            $('.no_disposisi').val(no_disposisi);
            $('.nama_dosen').val(nama_dosen);
            $('.nama_topik').val(nama_topik);
            $('#editDosenModal').modal('show');
        });
        $("#kode_topik").on('change', function() {
            $("#kode_detail").empty();
            var kode_topik = $("#kode_topik").val();
            $.ajax({
                url: "<?= site_url('Pengajuan/getDosenKP') ?>",
                type: 'GET',
                data: {
                    'kode_topik': kode_topik,
                },
                dataType: 'json',
                success: function(data) {
                    var html = '<option value="">Pilih Dosen</option>';
                    for (var count = 0; count < data.length; count++) {
                        html += '<option value="' + data[count].kode_detail + '">' + data[count].nama_dosen + '</option>';
                    }
                    $('#kode_detail').html(html);
                },
            });
        });
        $("#kode_topik2").on('change', function() {
            $("#kode_detail2").empty();
            var kode_topik2 = $("#kode_topik2").val();
            $.ajax({
                url: "<?= site_url('Pengajuan/getDosenTA') ?>",
                type: 'GET',
                data: {
                    'kode_topik2': kode_topik2,
                },
                dataType: 'json',
                success: function(data) {
                    var html = '<option value="">Pilih Dosen</option>';
                    for (var count = 0; count < data.length; count++) {
                        html += '<option value="' + data[count].kode_detail + '">' + data[count].nama_dosen + '</option>';
                    }
                    $('#kode_detail2').html(html);
                },
            });
        });

        $('#formeditdosen').validate({
            rules: {
                kode_topik: {
                    required: true,
                },
                kode_detail: {
                    required: true,
                },
                kode_topik2: {
                    required: true,
                },
                kode_detail2: {
                    required: true,
                },
            },
            messages: {
                kode_topik: {
                    required: "Wajib Diisi",
                },
                kode_detail: {
                    required: "Wajib Diisi",
                },
                kode_topik2: {
                    required: "Wajib Diisi",
                },
                kode_detail2: {
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
    });
</script>
<?= $this->endsection(); ?>