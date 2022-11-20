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

        <a href="#" class="btn btn-info btn-block btn-sm btn-disposisi_all">Disposisi All</a>
        <br>
        <hr>
        <br>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_disposisi as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->npm; ?></td>
                        <td><?= $row->nama_mahasiswa; ?></td>
                        <td><?= $row->nama_dosen; ?></td>
                        <td>
                            <?= $row->nama_pembimbing; ?>
                            <br>
                            <hr>
                            <form action="<?= base_url(); ?>/Disposisi/updatePembimbing" method="post">
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
                                <input type="hidden" name="no_ploting_pembimbing" id="no_ploting_pembimbing" value="<?= $row->no_ploting_pembimbing; ?>">
                                <input type="hidden" name="no_disposisi" id="no_disposisi" value="<?= $row->no_disposisi; ?>">
                                <input type="hidden" name="jenis" id="jenis" value="<?= $jenis; ?>">
                            </form>
                        </td>
                        <td>
                            <?= $row->jumlah_bimbingan; ?>
                        </td>
                        <td align="center">
                            <?php if ($row->status_disposisi == "Disposisi") { ?>
                                <span class="badge badge-success">
                                    <?= $row->status_disposisi; ?>
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-danger">
                                    <?= $row->status_disposisi; ?>
                                </span>
                            <?php } ?>
                        </td>
                        <td align="center">
                            <a href="#" class="btn btn-info btn-sm btn-disposisi" <?php if ($row->status_disposisi == "Disposisi") { ?> style="pointer-events: none;" <?php } ?> data-no_disposisi="<?= $row->no_disposisi; ?>">Disposisi</a>
                            <a href="#" class="btn btn-warning btn-sm btn-cancel" <?php if ($row->status_pengajuan == "Belum Disposisi") { ?> style="pointer-events: none;" <?php } ?>data-no_disposisi2="<?= $row->no_disposisi; ?>"><i class="far fa-times-circle"></i>&nbsp; Cancel</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal Delete Product-->
        <form action="<?= base_url(''); ?>/Disposisi/update" method="post">
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
                            <input type="hidden" name="jenis" class="jenis" value="<?= $jenis; ?>">
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

        <!-- Modal Delete Product-->
        <form action="<?= base_url(''); ?>/Disposisi/updateAll" method="post">
            <div class="modal fade" id="disposisiAllModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Disposisi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>Apakah Anda Yakin untuk Disposisi Semua Pengajuan <?= $jenis; ?> Pada Semester <?= $semester; ?> <?= $tahun_ajaran; ?>?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="jenis" class="jenis" value="<?= $jenis; ?>">
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

        <!-- Modal Delete Product-->
        <form action="<?= base_url(''); ?>/Disposisi/cancel" method="post">
            <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Disposisi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h4>Apakah Anda Yakin untuk Batalkan Disposisi?</h4>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="no_disposisi" class="no_disposisi2">
                            <input type="hidden" name="jenis" class="jenis" value="<?= $jenis; ?>">
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
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
    $(document).ready(function() {
        $('.btn-disposisi').on('click', function() {
            const no_disposisi = $(this).data('no_disposisi');
            $('.no_disposisi').val(no_disposisi);
            $('#disposisiModal').modal('show');
        });
        $('.btn-disposisi_all').on('click', function() {
            $('#disposisiAllModal').modal('show');
        });
        $('.btn-cancel').on('click', function() {
            const no_disposisi2 = $(this).data('no_disposisi2');
            $('.no_disposisi2').val(no_disposisi2);
            $('#cancelModal').modal('show');
        });
    });
</script>
<?= $this->endsection(); ?>