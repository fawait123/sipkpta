<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php if ($role == "kaprodi") { ?>
    <div class="row">
        <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar User</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="users-list clearfix">
                        <?php foreach ($total_user as $row) : ?>
                            <li>
                                <img src="<?= base_url(''); ?>/foto/profile/profile.png" alt="User Image" class="img-circle elevation-2" height="75" width="75">
                                <a class="users-list-name" href="#"><?= $row->username; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="<?= site_url(''); ?>/Register">Lihat Lainnya</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!--/.card -->
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">ACC Pengajuan</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>No. Pengajuan</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jenis</th>
                                    <th>Status Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tb_pengajuan as $row) : ?>
                                    <tr>
                                        <td><?= $row->no_pengajuan; ?></a></td>
                                        <td><?= $row->npm; ?></td>
                                        <td><?= $row->nama_mahasiswa; ?></td>
                                        <td><?= $row->jenis; ?></td>
                                        <td>
                                            <?php if ($row->status_pengajuan == "ACC") { ?>
                                                <span class="badge badge-success">
                                                    <?= $row->status_pengajuan; ?>
                                                </span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">
                                                    <?= $row->status_pengajuan; ?>
                                                </span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="<?= site_url(''); ?>/AccPengajuan/accKP" class="btn btn-sm btn-info float-left">Lihat Pengajuan KP</a>
                    <a href="<?= site_url(''); ?>/AccPengajuan/accTA" class="btn btn-sm btn-info float-right">Lihat Pengajuan TA</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Ploting Dosen</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>No. Pengajuan</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Pilihan Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tb_ploting as $row) : ?>
                                    <tr>
                                        <td><?= $row->no_pengajuan; ?></a></td>
                                        <td><?= $row->npm; ?></td>
                                        <td><?= $row->nama_mahasiswa; ?></td>
                                        <td><?= $row->nama_dosen; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="<?= site_url(''); ?>/Ploting/plotingKP" class="btn btn-sm btn-info float-left">Lihat Ploting KP</a>
                    <a href="<?= site_url(''); ?>/Ploting/plotingTA" class="btn btn-sm btn-info float-right">Lihat Ploting TA</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Disposisi Dosen</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>No. Pengajuan</th>
                                    <th>NPM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jenis</th>
                                    <th>Dosen Pembimbing/Reviewer 1</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tb_disposisi as $row) : ?>
                                    <tr>
                                        <td><?= $row->no_pengajuan; ?></a></td>
                                        <td><?= $row->npm; ?></td>
                                        <td><?= $row->nama_mahasiswa; ?></td>
                                        <td><?= $row->jenis; ?></td>
                                        <td><?= $row->nama_pembimbing; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="<?= site_url(''); ?>/Disposisi/disposisiKP" class="btn btn-sm btn-info float-left">Lihat Disposisi KP</a>
                    <a href="<?= site_url(''); ?>/Disposisi/disposisiTA" class="btn btn-sm btn-info float-right">Lihat Disposisi TA</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
<?php
} elseif ($role == "admin") { ?>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <?php foreach ($total_topik as $row) : ?>
                            <?= $row->total_topik; ?>
                        <?php endforeach; ?>
                    </h3>

                    <p>Data Topik</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?= site_url(''); ?>/Topik" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>
                        <?php foreach ($total_dosen as $row) : ?>
                            <?= $row->total_dosen; ?>
                        <?php endforeach; ?>
                    </h3>

                    <p>Data Dosen</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= site_url(''); ?>/Dosen" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                        <?php foreach ($total_mahasiswa as $row) : ?>
                            <?= $row->total_mahasiswa; ?>
                        <?php endforeach; ?>
                    </h3>

                    <p>Data Mahasiswa</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= site_url(''); ?>/Mahasiswa" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Topik dan Kuota</h3>
                    <div class="card-tools">
                        <a href="<?= site_url(''); ?>/TopikKuota/kuotaKP" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i>&nbsp; KP</a>
                        <br>
                        <a href="<?= site_url(''); ?>/TopikKuota/kuotaTA" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i>&nbsp; TA</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Nama Dosen</th>
                                <th>Topik</th>
                                <th>Kuota</th>
                                <th>Jenis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tb_topik as $row) : ?>
                                <tr>
                                    <td><?= $row->nama_dosen; ?></td>
                                    <td><?= $row->nama_topik; ?></td>
                                    <td><?= $row->kuota; ?></td>
                                    <td><?= $row->jenis; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Tanggal Pengajuan</h3>
                    <div class="card-tools">
                        <a href="<?= site_url(''); ?>/Persiapan" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i>&nbsp; Tanggal Pengajuan</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php foreach ($tanggalkp as $row) : ?>
                        <label>Kerja Praktik</label>
                        <div class="form-group">
                            <input type="text" class="form-control datetimepicker-input" data-target="#start" name="start" value="<?= $row->start; ?>" disabled />
                            <label>s.d</label>
                            <input type="text" class="form-control datetimepicker-input" data-target="#end" name="end" value="<?= $row->end; ?>" disabled />
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <label>Tugas Akhir</label>
                    <?php foreach ($tanggalta as $row) : ?>
                        <div class="form-group">
                            <input type="text" class="form-control datetimepicker-input" data-target="#start2" name="start2" value="<?= $row->start; ?>" disabled />
                            <label>s.d</label>
                            <input type="text" class="form-control datetimepicker-input" data-target="#end2" name="end2" value="<?= $row->end; ?>" disabled />
                        </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php } ?>
<?= $this->endsection(); ?>