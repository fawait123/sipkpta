<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$errors = $session->getFlashdata('errors');
$success = $session->getFlashdata('success');
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
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
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Judul</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th style="width:20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php $no = 1;
                                    foreach ($pengajuan as $p) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $p->npm ?></td>
                                            <td><?= $p->nama_mahasiswa ?></td>
                                            <td><?= $p->judul ?></td>
                                            <td><?= $p->jenis ?></td>
                                            <td><?= $p->status_perpanjang ?></td>
                                            <td>
                                                <form action="<?= base_url(); ?>/Pengajuan/updatePengajuanAdmin" method="post">
                                                    <div class="form-group">
                                                        <input type="radio" name="status" id="perpanjang" value="Perpanjang" <?= $p->status_perpanjang == 'Perpanjang' ? 'checked' : '' ?>>
                                                        <label for="perpanjang">Perpanjang</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="radio" name="status" id="baru" value="Baru" <?= $p->status_perpanjang == 'Baru' ? 'checked' : '' ?>>
                                                        <label for="baru">Baru</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="radio" name="status" id="selesai" value="Selesai" <?= $p->status_perpanjang == 'Selesai' ? 'checked' : '' ?>>
                                                        <label for="selesai">Selesai</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="radio" name="status" id="usang" value="usang" <?= $p->status_perpanjang == 'Usang' ? 'checked' : '' ?>>
                                                        <label for="usang">Usang</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-outline-secondary" type="submit"><i class="far fa-edit"></i></button>
                                                    </div>
                                                    <!-- </div> -->
                                                    <input type="hidden" name="no_pengajuan" id="no_pengajuan" value="<?= $p->no_pengajuan; ?>">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
</section>
<!-- /.content -->
<?= $this->endsection(); ?>