<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$errors = $session->getFlashdata('errors');
$success = $session->getFlashdata('success');
?>
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
<!-- Default box -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <div class="p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#kp" data-toggle="tab">Kerja Praktik</a></li>
            <li class="nav-item"><a class="nav-link" href="#ta" data-toggle="tab">Tugas Akhir</a></li>
        </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="kp">
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
                        foreach ($tb_berkas_perpanjang_kp as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->npm; ?></td>
                                <td><?= $row->nama_mahasiswa; ?></td>
                                <td><?= $row->status_berkas_perpanjang; ?></td>
                                <td><?= $row->catatan_berkas_perpanjang; ?></td>
                                <td>
                                    <a href="<?= base_url('') ?>/Perpanjang/detailBerkas/<?= $row->no_berkas_perpanjang ?>/<?= $row->npm ?>" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="ta">
                <table id="example3" class="table table-striped table-bordered" style="width:100%">
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
                        foreach ($tb_berkas_perpanjang_ta as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->npm; ?></td>
                                <td><?= $row->nama_mahasiswa; ?></td>
                                <td><?= $row->status_berkas_perpanjang; ?></td>
                                <td><?= $row->catatan_berkas_perpanjang; ?></td>
                                <td>
                                    <a href="<?= base_url('') ?>/Perpanjang/detailBerkas/<?= $row->no_berkas_perpanjang ?>/<?= $row->npm ?>" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>
<!-- /.card -->
<?= $this->endsection(); ?>