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
        <table id="example2" class="table table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>KP</th>
                    <th>TA</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_rekap_pembimbing as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nama_dosen; ?></td>
                        <td>
                            <?php if ($row->jumlah_bimbingan == null) {
                                echo 0;
                            } else {
                                echo $row->jumlah_bimbingan;
                            } ?>
                        </td>
                        <td>
                            <?php if ($row->jumlah_bimbingan2 == null) {
                                echo 0;
                            } else {
                                echo $row->jumlah_bimbingan2;
                            } ?>
                        </td>
                        <td>
                            <?php if ($row->jumlah_bimbingan3 == null) {
                                echo 0;
                            } else {
                                echo $row->jumlah_bimbingan3;
                            } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <hr>
        <br>
        <table id="example" class="table table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dosen Pembimbing</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_disposisi4 as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nama_dosen; ?></td>
                        <td><?= $row->npm; ?></td>
                        <td><?= $row->nama_mahasiswa; ?></td>
                        <td><?= $row->jenis; ?> <?= $row->status_perpanjang; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<script>
    $(document).ready(function() {

    });
</script>
<?= $this->endsection(); ?>