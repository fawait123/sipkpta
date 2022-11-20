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
                    <th rowspan="2" style="vertical-align : middle;text-align:center;">No</th>
                    <th rowspan="2" style="vertical-align : middle;text-align:center;">Nama Dosen</th>
                    <th colspan="2" style="text-align:center;">KP</th>
                    <th colspan="2" style="text-align:center;">TA</th>
                    <th rowspan="2" style="vertical-align : middle;text-align:center;">Total</th>
                </tr>
                <tr>
                    <th style="text-align:center;">Reviewer 1</th>
                    <th style="text-align:center;">Reviewer 2</th>
                    <th style="text-align:center;">Reviewer 1</th>
                    <th style="text-align:center;">Reviewer 2</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_rekap_ploting as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nama_dosen; ?></td>
                        <td>
                            <?php if ($row->jumlah_bimbingan_kp == null) {
                                echo 0;
                            } else {
                                echo $row->jumlah_bimbingan_kp;
                            } ?>
                        </td>
                        <td>
                            <?php if ($row->jumlah_review_kp == null) {
                                echo 0;
                            } else {
                                echo $row->jumlah_review_kp;
                            } ?>
                        </td>
                        <td>
                            <?php if ($row->jumlah_bimbingan_ta == null) {
                                echo 0;
                            } else {
                                echo $row->jumlah_bimbingan_ta;
                            } ?>
                        </td>
                        <td>
                            <?php if ($row->jumlah_review_ta == null) {
                                echo 0;
                            } else {
                                echo $row->jumlah_review_ta;
                            } ?>
                        </td>
                        <td>
                            <?php $total = $row->jumlah_bimbingan_kp + $row->jumlah_review_kp + $row->jumlah_bimbingan_ta + $row->jumlah_review_ta; ?>
                            <?= $total; ?>
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
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jenis</th>
                    <th>Judul</th>
                    <th>Penguji 1</th>
                    <th>Penguji 2</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_rekap_ploting2 as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->npm; ?></td>
                        <td><?= $row->nama_mahasiswa; ?></td>
                        <td><?= $row->jenis; ?></td>
                        <td><?= $row->judul; ?></td>
                        <td><?= $row->nama_pembimbing; ?></td>
                        <td><?= $row->nama_reviewer; ?></td>
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