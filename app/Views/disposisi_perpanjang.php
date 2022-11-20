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

<?php if ($role == "kaprodi") { ?>
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
                    <table id="example2" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Dosen Pilihan</th>
                                <th>Dosen Pembimbing</th>
                                <th>Jumlah</th>
                                <th>Status Disposisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($tb_disposisi_perpanjang_kp as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->npm; ?></td>
                                    <td><?= $row->nama_mahasiswa; ?></td>
                                    <td><?= $row->nama_dosen; ?></td>
                                    <td>
                                        <?= $row->nama_pembimbing; ?>
                                        <br>
                                        <hr>
                                        <form action="<?= base_url(); ?>/Perpanjang/updatePembimbing" method="post">
                                            <div class="form-group">
                                                <select id="nik" name="nik" class="form-control select2" required>
                                                    <option value="">- Pilih Dosen -</option>
                                                    <?php foreach ($jumlah_pembimbing as $row2) : ?>
                                                        <option value="<?= $row2->nik; ?>"><?= $row2->nama_dosen; ?> - <?php if ($row2->jumlah_bimbingan == null) {
                                                                                                                            echo 0;
                                                                                                                        } else {
                                                                                                                            echo $row2->jumlah_bimbingan;
                                                                                                                        } ?>, <?php if ($row2->jumlah_bimbingan2 == null) {
                                                                                                                                    echo 0;
                                                                                                                                } else {
                                                                                                                                    echo $row2->jumlah_bimbingan2;
                                                                                                                                } ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" name="submit" class="btn btn-danger btn-block btn-flat">
                                                    <i class="far fa-edit"></i></button>
                                            </div>
                                            <input type="hidden" name="no_disposisi" id="no_disposisi" value="<?= $row->no_disposisi; ?>">
                                        </form>
                                    </td>
                                    <td>
                                        <?= $row->jumlah_bimbingan; ?>
                                    </td>
                                    <td>
                                        <?= $row->status_disposisi; ?><br>
                                        <a href="#" class="btn btn-info btn-sm btn-disposisi" <?php if ($row->status_disposisi == "Disposisi") { ?> style="pointer-events: none;" <?php } ?> data-no_disposisi="<?= $row->no_disposisi; ?>">Disposisi</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="ta">
                    <table id="example3" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Dosen Pilihan</th>
                                <th>Dosen Pembimbing</th>
                                <th>Jumlah</th>
                                <th>Status Disposisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($tb_disposisi_perpanjang_ta as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->npm; ?></td>
                                    <td><?= $row->nama_mahasiswa; ?></td>
                                    <td><?= $row->nama_dosen; ?></td>
                                    <td>
                                        <?= $row->nama_pembimbing; ?>
                                        <br>
                                        <hr>
                                        <form action="<?= base_url(); ?>/Perpanjang/updatePembimbing" method="post">
                                            <div class="form-group">
                                                <select id="nik" name="nik" class="form-control select2" required>
                                                    <option value="">- Pilih Dosen -</option>
                                                    <?php foreach ($jumlah_pembimbing as $row2) : ?>
                                                        <option value="<?= $row2->nik; ?>"><?= $row2->nama_dosen; ?> - <?php if ($row2->jumlah_bimbingan == null) {
                                                                                                                            echo 0;
                                                                                                                        } else {
                                                                                                                            echo $row2->jumlah_bimbingan;
                                                                                                                        } ?>, <?php if ($row2->jumlah_bimbingan2 == null) {
                                                                                                                                    echo 0;
                                                                                                                                } else {
                                                                                                                                    echo $row2->jumlah_bimbingan2;
                                                                                                                                } ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" name="submit" class="btn btn-danger btn-block btn-flat">
                                                    <i class="far fa-edit"></i></button>
                                            </div>
                                            <input type="hidden" name="no_disposisi" id="no_disposisi" value="<?= $row->no_disposisi; ?>">
                                        </form>
                                    </td>
                                    <td>
                                        <?= $row->jumlah_bimbingan; ?>
                                    </td>
                                    <td>
                                        <?= $row->status_disposisi; ?><br>
                                        <a href="#" class="btn btn-info btn-sm btn-disposisi" <?php if ($row->status_disposisi == "Disposisi") { ?> style="pointer-events: none;" <?php } ?> data-no_disposisi="<?= $row->no_disposisi; ?>">Disposisi</a>
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
<?php } elseif ($role == "dosen") { ?>
    <!-- Default box -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered " style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Dosen Pembimbing</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tb_disposisi_perpanjang2 as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->npm; ?></td>
                            <td><?= $row->nama_mahasiswa; ?></td>
                            <td><?= $row->nama_dosen; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } elseif ($role == "admin" || $role == "sekprod") { ?>
            <table id="example" class="table table-striped table-bordered " style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Dosen Pembimbing</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tb_disposisi4 as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->npm; ?></td>
                            <td><?= $row->nama_mahasiswa; ?></td>
                            <td><?= $row->nama_dosen; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
<?php } ?>

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/Perpanjang/updateDisposisi" method="post">
    <div class="modal fade" id="disposisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Disposisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah Anda Yakin untuk Disposisi?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_disposisi" class="no_disposisi">
                    <input type="hidden" name="tahun_ajaran" class="tahun_ajaran" value="<?= $tahun_ajaran; ?>">
                    <input type="hidden" name="semester" class="semester" value="<?= $semester; ?>">
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
        $('.btn-disposisi').on('click', function() {
            const no_disposisi = $(this).data('no_disposisi');
            $('.no_disposisi').val(no_disposisi);
            $('#disposisiModal').modal('show');
        });
    });
</script>
<?= $this->endsection(); ?>