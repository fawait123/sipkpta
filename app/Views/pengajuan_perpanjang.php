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
        <form action="<?= base_url(); ?>/AccPengajuan/update" method="post">
            <table id="example2" class="table table-striped table-bordered " style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Status Perpanjang</th>
                        <th>Tahun Ajaran</th>
                        <th>Semester</th>
                        <th>Batas Bimbingan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tb_pengajuan_perpanjang as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->npm; ?></td>
                            <td><?= $row->nama_mahasiswa; ?></td>
                            <td><?= $row->jenis; ?></td>
                            <td><?= $row->status_perpanjang; ?></td>
                            <td><?= $row->tahun_ajaran; ?></td>
                            <td><?= $row->semester; ?></td>
                            <td><?= $row->batas_bimbingan; ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-cancel" data-no_pengajuan="<?= $row->no_pengajuan; ?>"><i class="far fa-times-circle"></i>&nbsp; Cancel</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/Perpanjang/updatePengajuanPerpanjang" method="post">
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Apakah Anda Yakin Untuk Batalkan Perpanjang?</h4>
                    <br>
                    <div class="form-group">
                        <label>Tahun Ajaran Awal</label>
                        <select id="tahun_ajaran" name="tahun_ajaran" class="form-control select2" required>
                            <option value="">-Select-</option>
                            <?php foreach ($tahun_ajaran2 as $row) : ?>
                                <option value="<?= $row->tahun_ajaran; ?>"><?= $row->tahun_ajaran; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semester Awal</label>
                        <select id="semester" name="semester" class="form-control select2" required>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Batas Bimbingan Awal</label>
                                <div class="input-group date" id="batas_bimbingan" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#batas_bimbingan" name="batas_bimbingan" value="<?= $row->batas_bimbingan; ?>" />
                                    <div class="input-group-append" data-target="#batas_bimbingan" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_pengajuan" class="no_pengajuan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<script>
    $(document).ready(function() {
        $('#batas_bimbingan').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('.btn-cancel').on('click', function() {
            const no_pengajuan = $(this).data('no_pengajuan');
            const no_berkas_perpanjang = $(this).data('no_berkas_perpanjang');
            $('.no_pengajuan').val(no_pengajuan);
            $('.no_berkas_perpanjang').val(no_berkas_perpanjang);
            $('#cancelModal').modal('show');
        });
    });
</script>
<?= $this->endsection(); ?>