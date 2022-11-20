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
        <?php if ($role == "dosen") { ?>
            <table id="example" class="table table-striped table-bordered " style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Judul</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tb_disposisi2 as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->npm; ?></td>
                            <td><?= $row->nama_mahasiswa; ?></td>
                            <td><?= $row->jenis; ?> <?= $row->status_perpanjang; ?></td>
                            <td><?= $row->judul; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } elseif ($role == "admin" || $role == "sekprod") { ?>
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
        <?php } ?>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
</script>
<?= $this->endsection(); ?>