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
                    <th>Status Berkas</th>
                    <th>Catatan Berkas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_berkas as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->npm; ?></td>
                        <td><?= $row->nama_mahasiswa; ?></td>
                        <td><?= $row->status_berkas; ?></td>
                        <td><?= $row->catatan_berkas; ?></td>
                        <td>
                            <?php if ($jenis == "KP") {
                            ?>
                                <a href="<?= base_url('') ?>/Berkas/detailKP/<?= $row->no_berkas ?>/<?= $row->npm ?>" class="btn btn-info btn-sm">Detail</a>
                            <?php
                            } else { ?>
                                <a href="<?= base_url('') ?>/Berkas/detailTA/<?= $row->no_berkas ?>/<?= $row->npm ?>" class="btn btn-info btn-sm">Detail</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<?= $this->endsection(); ?>