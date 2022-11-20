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
        <table id="example" class="table table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jenis</th>
                    <th>Status</th>
                    <th>Judul <?= $jenis; ?></th>
                    <th>Topik <?= $jenis; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_rekap_pengajuan as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nama_dosen; ?></td>
                        <td><?= $row->npm; ?></td>
                        <td><?= $row->nama_mahasiswa; ?></td>
                        <td><?= $row->jenis; ?></td>
                        <td><?= $row->status_perpanjang; ?></td>
                        <td><?= $row->judul; ?></td>
                        <td><?= $row->nama_topik; ?></td>
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