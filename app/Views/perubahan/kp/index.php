<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
date_default_timezone_set('Asia/Jakarta');
$start = $check->start;
$end = $check->end;
$sekarang = strtotime(date("Y-m-d H:i:s"));
$start2 = strtotime($start);
$end2 = strtotime($end);
?>
<?php if (session()->get('role') == 'mahasiswa') : ?>
    <?php if (($sekarang >= $start2) && ($sekarang <= $end2)) { ?>
        <?php if ($pengajuan !== null && $pengajuan->status_perpanjang != 'Selesai') : ?>
            <?php if ($pengajuan->no_perubahan == null || $pengajuan->no_perubahan == "") : ?>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info !</h5>
                    Catatan
                    <br>
                    <ul>
                        <li>Perubahan Judul ditutup pada tanggal <?= date('d M Y', strtotime($check->start)) ?> jam <?= date('H:i', strtotime($check->end)) ?></li>
                        <li>Silahkan ajukan perubahan judul jika anda ingin melakukan perubahan</li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('perubahan/kp') ?>" method="post" enctype="multipart/form-data" id="form-perubahan-kp">
                            <input type="hidden" name="no_pengajuan" id="no_pengajuan" value="<?= $pengajuan->no_pengajuan ?>">
                            <div class="form-group">
                                <input type="hidden" name="npm" id="npm" value="<?= $pengajuan->npm ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="judullama">Judul Proposal Lama</label>
                                <input type="text" name="judullama" id="judullama" value="<?= $pengajuan->judul ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="judul">Judul Proposal Baru<span class="text-danger">*</span></label>
                                <input type="text" name="judul" id="judul" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="judul">Studi Kasus Baru (jika ada)</label>
                                <input type="text" name="studi_kasus" id="studi_kasus" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="file">File Proposal<span class="text-danger">*</span></label>
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#form-perubahan-kp').validate({
                            rules: {
                                judul: {
                                    required: true,
                                },
                                file: {
                                    required: true,
                                    extension: "pdf"
                                },
                                // bukti: {
                                //     required: true,
                                //     extension: "pdf"
                                // }
                            },
                            messages: {
                                judul: {
                                    required: "Email Wajib Diisi",
                                },
                                file: {
                                    required: "Proposaal Wajib Diisi",
                                    extension: "File yang diijinkan PDF"
                                },
                                // bukti: {
                                //     required: "Bukti Pernyataan Wajib Diisi",
                                //     extension: "File yang diijinkan PDF"
                                // },
                            },
                            errorElement: 'span',
                            errorPlacement: function(error, element) {
                                error.addClass('invalid-feedback');
                                element.closest('.form-group').append(error);
                            },
                            highlight: function(element, errorClass, validClass) {
                                $(element).addClass('is-invalid');
                            },
                            unhighlight: function(element, errorClass, validClass) {
                                $(element).removeClass('is-invalid');
                            }
                        });
                    });
                </script>
            <?php else : ?>
                <!-- Timelime example  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <div class="timeline">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-red"><?= date('d M Y', strtotime($perubahan->tgl_perubahan)) ?></span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?= date('H:i', strtotime($perubahan->tgl_perubahan)) ?></span>
                                    <h3 class="timeline-header"><a href="#">Detail Perubahan Judul</a></h3>

                                    <div class="timeline-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">NPM : <?= $perubahan->npm ?></li>
                                            <li class="list-group-item">NAMA : <?= $perubahan->nama_mahasiswa ?></li>
                                            <li class="list-group-item">Dosen Pembimbing : <?= $perubahan->nama_dosen ?></li>
                                            <li class="list-group-item">Judul Lama : <?= $perubahan->judul ?></li>
                                            <li class="list-group-item">Judul Baru : <?= $perubahan->judul_perubahan ?>
                                                <?php if ($perubahan->status_dosen == 'revisi') : ?>
                                                    <a href="" data-toggle="modal" data-target="#modal-ubah-judul">ubah <i class="fa fa-edit"></i></a>
                                                <?php endif; ?>
                                            </li>
                                            <li class="list-group-item">Proposal : <a href="<?= base_url('uploads/perubahan/kerja praktik/' . $perubahan->npm . '-' . $perubahan->nama_mahasiswa . '/' . $perubahan->proposal) ?>" target="blannk"><?= $perubahan->proposal ?> &nbsp; <i class="fa fa-file-pdf"></i></a></li>
                                            <?php if ($perubahan->status_dosen == "acc" && $perubahan->status_prodi == "acc") : ?>
                                                <li class="list-group-item">
                                                    <a href="<?= base_url('perubahan/cetak-kartu-bimbingan/' . $perubahan->no_disposisi) ?>" target="blank" class="btn btn-danger text-white btn-sm">Kartu Bimbingan <i class="fa fa-file-pdf"></i></a>
                                                    <a href="<?= base_url('perubahan/cetak-logbook/' . $perubahan->no_disposisi) ?>" target="blank" class="btn btn-danger text-white btn-sm">Logbook <i class="fa fa-file-pdf"></i></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-comments bg-yellow"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                    <h3 class="timeline-header"><a href="#">Review Dosen</a></h3>
                                    <div class="timeline-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Status : <?= $perubahan->status_dosen == null ? '<span class="badge bg-danger">Belum Di review</span>' : '<span class="badge bg-primary">' . $perubahan->status_dosen . '</span>'; ?></li>
                                            <li class="list-group-item">Keterangan : <?= $perubahan->ket_dosen == null ? '-' : $perubahan->ket_dosen ?></li>
                                        </ul>
                                    </div>
                                    <?php if ($perubahan->status_dosen == 'revisi') : ?>
                                        <div class="timeline-footer">
                                            <form action="<?= base_url('perubahan/revisi') ?>" method="post" enctype="multipart/form-data" id="form-revisi-proposal-mahasiswa">
                                                <input type="hidden" name="no_perubahan" value="<?= $perubahan->no_perubahan ?>">
                                                <input type="hidden" name="old" value="<?= $perubahan->proposal ?>">
                                                <input type="hidden" name="npm" value="<?= $perubahan->npm ?>">
                                                <input type="hidden" name="nama" value="<?= $perubahan->nama_mahasiswa ?>">
                                                <div class="input-group mb-3">
                                                    <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Revisi Proposal</button>
                                                </div>
                                            </form>
                                            <script>
                                                $('#form-revisi-proposal-mahasiswa').validate({
                                                    rules: {
                                                        file: {
                                                            required: true,
                                                            extension: "pdf"
                                                        },
                                                    },
                                                    messages: {
                                                        file: {
                                                            required: "Proposaal Wajib Diisi",
                                                            extension: "File yang diijinkan PDF"
                                                        },
                                                    },
                                                    errorElement: 'span',
                                                    errorPlacement: function(error, element) {
                                                        error.addClass('invalid-feedback');
                                                        element.closest('.form-group').append(error);
                                                    },
                                                    highlight: function(element, errorClass, validClass) {
                                                        $(element).addClass('is-invalid');
                                                    },
                                                    unhighlight: function(element, errorClass, validClass) {
                                                        $(element).removeClass('is-invalid');
                                                    }
                                                });
                                            </script>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-comments bg-primary"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                    <h3 class="timeline-header"><a href="#">Review Prodi</a></h3>
                                    <div class="timeline-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Status : <?= $perubahan->status_prodi == null ? '<span class="badge bg-danger">Belum Di review</span>' : '<span class="badge bg-primary">' . $perubahan->status_prodi . '</span>'; ?></li>
                                            <li class="list-group-item">Keterangan : <?= $perubahan->ket_prodi == null ? '-' : $perubahan->ket_prodi ?></li>
                                        </ul>
                                    </div>
                                    <?php if ($perubahan->status_prodi == 'revisi') : ?>
                                        <div class="timeline-footer">
                                            <form action="<?= base_url('perubahan/revisi') ?>" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="no_perubahan" value="<?= $perubahan->no_perubahan ?>">
                                                <input type="hidden" name="old" value="<?= $perubahan->proposal ?>">
                                                <input type="hidden" name="npm" value="<?= $perubahan->npm ?>">
                                                <input type="hidden" name="nama" value="<?= $perubahan->nama_mahasiswa ?>">
                                                <div class="input-group mb-3">
                                                    <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Revisi Proposal</button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- END timeline item -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                </div>
                <!-- modal ubah judul -->
                <form action="<?= base_url('perubahan/ubahjudul') ?>" method="post">
                    <div class="modal fade" id="modal-ubah-judul">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Judul</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" name="no_perubahan" value="<?= $perubahan->no_perubahan ?>">
                                    <input type="text" class="form-control" name="judul_perubahan" value="<?= $perubahan->judul_perubahan ?>">
                                    <input type="hidden" name="jenis" value="KP">
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </form>
                <!-- /.modal -->
            <?php endif; ?>
        <?php else : ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Info !</h5>
                Catatan
                <br>
                <ul>
                    <li>Anda tidak diijinkan mengakses perubahan judul kerja praktik</li>
                </ul>
            </div>
        <?php endif; ?>
    <?php } else { ?>
        <?php if ($pengajuan !== null) : ?>
            <?php if ($pengajuan->no_perubahan != null || $pengajuan->no_perubahan != "") : ?>
                <!-- Timelime example  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <div class="timeline">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-red"><?= date('d M Y', strtotime($perubahan->tgl_perubahan)) ?></span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?= date('H:i', strtotime($perubahan->tgl_perubahan)) ?></span>
                                    <h3 class="timeline-header"><a href="#">Detail Perubahan Judul</a></h3>

                                    <div class="timeline-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">NPM : <?= $perubahan->npm ?></li>
                                            <li class="list-group-item">NAMA : <?= $perubahan->nama_mahasiswa ?></li>
                                            <li class="list-group-item">Dosen Pembimbing : <?= $perubahan->nama_dosen ?></li>
                                            <li class="list-group-item">Judul Lama : <?= $perubahan->judul ?></li>
                                            <li class="list-group-item">Judul Baru : <?= $perubahan->judul_perubahan ?>
                                                <?php if ($perubahan->status_dosen == 'revisi') : ?>
                                                    <a href="" data-toggle="modal" data-target="#modal-ubah-judul">ubah <i class="fa fa-edit"></i></a>
                                                <?php endif; ?>
                                            </li>
                                            <li class="list-group-item">Proposal : <a href="<?= base_url('uploads/perubahan/kerja praktik/' . $perubahan->npm . '-' . $perubahan->nama_mahasiswa . '/' . $perubahan->proposal) ?>" target="blannk"><?= $perubahan->proposal ?> &nbsp; <i class="fa fa-file-pdf"></i></a></li>
                                            <?php if ($perubahan->status_dosen == "acc" && $perubahan->status_prodi == "acc") : ?>
                                                <li class="list-group-item">
                                                    <a href="<?= base_url('perubahan/cetak-kartu-bimbingan/' . $perubahan->no_disposisi) ?>" target="blank" class="btn btn-danger text-white btn-sm">Kartu Bimbingan <i class="fa fa-file-pdf"></i></a>
                                                    <a href="<?= base_url('perubahan/cetak-logbook/' . $perubahan->no_disposisi) ?>" target="blank" class="btn btn-danger text-white btn-sm">Logbook <i class="fa fa-file-pdf"></i></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-comments bg-yellow"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                    <h3 class="timeline-header"><a href="#">Review Dosen</a></h3>
                                    <div class="timeline-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Status : <?= $perubahan->status_dosen == null ? '<span class="badge bg-danger">Belum Di review</span>' : '<span class="badge bg-primary">' . $perubahan->status_dosen . '</span>'; ?></li>
                                            <li class="list-group-item">Keterangan : <?= $perubahan->ket_dosen == null ? '-' : $perubahan->ket_dosen ?></li>
                                        </ul>
                                    </div>
                                    <?php if ($perubahan->status_dosen == 'revisi') : ?>
                                        <div class="timeline-footer">
                                            <form action="<?= base_url('perubahan/revisi') ?>" method="post" enctype="multipart/form-data" id="form-revisi-proposal-mahasiswa">
                                                <input type="hidden" name="no_perubahan" value="<?= $perubahan->no_perubahan ?>">
                                                <input type="hidden" name="old" value="<?= $perubahan->proposal ?>">
                                                <input type="hidden" name="npm" value="<?= $perubahan->npm ?>">
                                                <input type="hidden" name="nama" value="<?= $perubahan->nama_mahasiswa ?>">
                                                <div class="input-group mb-3">
                                                    <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Revisi Proposal</button>
                                                </div>
                                            </form>
                                            <script>
                                                $('#form-revisi-proposal-mahasiswa').validate({
                                                    rules: {
                                                        file: {
                                                            required: true,
                                                            extension: "pdf"
                                                        },
                                                    },
                                                    messages: {
                                                        file: {
                                                            required: "Proposaal Wajib Diisi",
                                                            extension: "File yang diijinkan PDF"
                                                        },
                                                    },
                                                    errorElement: 'span',
                                                    errorPlacement: function(error, element) {
                                                        error.addClass('invalid-feedback');
                                                        element.closest('.form-group').append(error);
                                                    },
                                                    highlight: function(element, errorClass, validClass) {
                                                        $(element).addClass('is-invalid');
                                                    },
                                                    unhighlight: function(element, errorClass, validClass) {
                                                        $(element).removeClass('is-invalid');
                                                    }
                                                });
                                            </script>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-comments bg-primary"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                    <h3 class="timeline-header"><a href="#">Review Prodi</a></h3>
                                    <div class="timeline-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Status : <?= $perubahan->status_prodi == null ? '<span class="badge bg-danger">Belum Di review</span>' : '<span class="badge bg-primary">' . $perubahan->status_prodi . '</span>'; ?></li>
                                            <li class="list-group-item">Keterangan : <?= $perubahan->ket_prodi == null ? '-' : $perubahan->ket_prodi ?></li>
                                        </ul>
                                    </div>
                                    <?php if ($perubahan->status_prodi == 'revisi') : ?>
                                        <div class="timeline-footer">
                                            <form action="<?= base_url('perubahan/revisi') ?>" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="no_perubahan" value="<?= $perubahan->no_perubahan ?>">
                                                <input type="hidden" name="old" value="<?= $perubahan->proposal ?>">
                                                <input type="hidden" name="npm" value="<?= $perubahan->npm ?>">
                                                <input type="hidden" name="nama" value="<?= $perubahan->nama_mahasiswa ?>">
                                                <div class="input-group mb-3">
                                                    <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Revisi Proposal</button>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- END timeline item -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                </div>
                <!-- modal ubah judul -->
                <form action="<?= base_url('perubahan/ubahjudul') ?>" method="post">
                    <div class="modal fade" id="modal-ubah-judul">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Judul</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" name="no_perubahan" value="<?= $perubahan->no_perubahan ?>">
                                    <input type="text" class="form-control" name="judul_perubahan" value="<?= $perubahan->judul_perubahan ?>">
                                    <input type="hidden" name="jenis" value="KP">
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </form>
                <!-- /.modal -->
            <?php else : ?>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info !</h5>
                    Catatan
                    <br>
                    <ul>
                        <li>Pastikan anda sudah terdaftar pada matakuliah kerja praktik</li>
                        <li>Perubahan Judul sudah dibuka pada tanggal <b class="text-danger"><?= date('d M Y', strtotime($check->start)) ?></b> jam <b class="text-danger"><?= date('H:i', strtotime($check->start)) ?></b> WIB dan ditutup pada tanggal <b class="text-danger"><?= date('d M Y', strtotime($check->end)) ?></b> jam <b class="text-danger"><?= date('H:i', strtotime($check->end)) ?></b> WIB</li>
                    </ul>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Info !</h5>
                Catatan
                <br>
                <ul>
                    <li>Anda tidak diijinkan perubahan judul kerja praktik</li>
                </ul>
            </div>
        <?php endif; ?>
    <?php } ?>
<?php else : ?>
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <?php if (session()->get('role') != 'dosen') : ?>
                        <th>Nama Dosen</th>
                    <?php endif; ?>
                    <th>Judul Lama</th>
                    <th>Judul Baru</th>
                    <th>Proposal</th>
                    <?php if (session()->get('role') == 'dosen' || session()->get('role') == 'kaprodi') : ?>
                        <th>Status Dosen</th>
                        <th>Status Prodi</th>
                        <th>Status Mahasiswa</th>
                    <?php endif; ?>
                    <?php if (session()->get('role') == 'dosen') : ?>
                        <th>Aksi Dosen</th>
                    <?php endif ?>
                    <?php if (session()->get('role') == 'kaprodi') : ?>
                        <th>Aksi Prodi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($perubahan as $p) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p->npm ?></td>
                        <td><?= $p->nama_mahasiswa ?></td>
                        <?php if (session()->get('role') != 'dosen') : ?>
                            <td><?= $p->nama_dosen ?></td>
                        <?php endif; ?>
                        <td><?= $p->judul ?></td>
                        <td><?= $p->judul_perubahan ?></td>
                        <td><a href="<?= base_url('uploads/perubahan/kerja praktik/' . $p->npm . '-' . $p->nama_mahasiswa . '/' . $p->proposal) ?>" target="blank"><?= $p->proposal ?> &nbsp;<i class="fa fa-file-pdf"></i></a></td>
                        <td><?= $p->status_dosen == null ? '<span class="badge bg-danger text-white">Belum di review</span>' : '<span class="badge bg-danger text-white">' . $p->status_dosen . '</span>' ?></td>
                        <td><?= $p->status_prodi == null ? '<span class="badge bg-danger text-white">Belum di review</span>' : '<span class="badge bg-danger text-white">' . $p->status_prodi . '</span>' ?></td>
                        <td><?= $p->status_mhs == null ? '<span class="badge bg-danger text-white">Tidak ada Aksi</span>' : '<span class="badge bg-danger text-white">' . $p->status_mhs . '</span>' ?></td>
                        <?php if (session()->get('role') == 'dosen') : ?>
                            <td>
                                <a href="" class="btn btn-primary btn-sm review-dosen" data-toggle="modal" data-target="#modal-review-dosen" data-no-perubahan="<?= $p->no_perubahan ?>" data-status-dosen="<?= $p->status_dosen ?>" data-ket-dosen="<?= $p->ket_dosen ?>" data-npm="<?= $p->npm ?>" data-nik="<?= $p->nik ?>">Review</a>
                            </td>
                        <?php endif; ?>
                        <?php if (session()->get('role') == 'kaprodi') : ?>
                            <td>
                                <?php if ($p->status_dosen == "revisi") : ?>
                                    <span class="badge bg-primary">Revisi Dosen</span>
                                <?php elseif ($p->status_dosen == "tolak") : ?>
                                    <span class="badge bg-danger">Ditolak Dosen</span>
                                <?php elseif ($p->status_dosen == "acc") : ?>
                                    <a href="" class="btn btn-primary btn-sm review-prodi" data-toggle="modal" data-target="#modal-review-prodi" data-no-perubahan="<?= $p->no_perubahan ?>" data-status-prodi="<?= $p->status_prodi ?>" data-ket-prodi="<?= $p->ket_prodi ?>" data-npm="<?= $p->npm ?>">Review</a>
                                <?php else : ?>
                                    <span class="badge bg-primary">Belum direview Dosen</span>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <?php if (session()->get('role') != 'dosen') : ?>
                        <th>Nama Dosen</th>
                    <?php endif; ?>
                    <th>Judul Lama</th>
                    <th>Judul Baru</th>
                    <th>Proposal</th>
                    <?php if (session()->get('role') == 'dosen' || session()->get('role') == 'kaprodi') : ?>
                        <th>Status Dosen</th>
                        <th>Status Prodi</th>
                    <?php endif; ?>
                    <?php if (session()->get('role') == 'dosen') : ?>
                        <th>Aksi Dosen</th>
                    <?php endif; ?>
                    <?php if (session()->get('role') == 'kaprodi') : ?>
                        <th>Aksi Prodi</th>
                    <?php endif; ?>
                </tr>
            </tfoot>
        </table>
    </div>
<?php endif; ?>
<!-- modal reviwe dosen -->
<form action="<?= base_url('perubahan/review-perubahan-dosen') ?>" method="post">
    <div class="modal fade" id="modal-review-dosen">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="no_perubahan" id="no_perubahan">
                    <input type="hidden" name="jenis" value="KP">
                    <input type="hidden" name="npm" id="npm">
                    <input type="hidden" name="nik" id="nik">
                    <div class="form-group">
                        <label for="status_dosen">Status</label>
                        <select name="status_dosen" id="status_dosen" class="form-control">
                            <option value="">:: pilih ::</option>
                            <option value="acc">Acc</option>
                            <option value="revisi">Revisi</option>
                            <option value="tolak">Tolak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ket_dosen">Keterangan</label>
                        <textarea name="ket_dosen" id="ket_dosen" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
<!-- /.modal -->

<!-- modal reviwe prodi -->
<form action="<?= base_url('perubahan/review-perubahan-prodi') ?>" method="post">
    <div class="modal fade" id="modal-review-prodi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="no_perubahan" id="no_perubahanp">
                    <input type="hidden" name="jenis" value="KP">
                    <input type="hidden" name="npm" id="npmp">
                    <div class="form-group">
                        <label for="status_prodi">Status</label>
                        <select name="status_prodi" id="status_prodi" class="form-control">
                            <option value="">:: pilih ::</option>
                            <option value="acc">Acc</option>
                            <option value="revisi">Revisi</option>
                            <option value="tolak">Tolak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ket_prodi">Keterangan</label>
                        <textarea name="ket_prodi" id="ket_prodi" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
<!-- /.modal -->
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        // summernote
        $("#ket_dosen").summernote();
        $("#ket_prodi").summernote();
        // $("#ket_dosen").code('asdfafsd');
        // review dosen
        $('#modal-review-dosen').on('show.bs.modal', function(e) {
            console.log(e.relatedTarget)
            let target = e.relatedTarget
            let no_perubahan = $(target).data('no-perubahan');
            let status = $(target).data('status-dosen');
            let npm = $(target).data('npm');
            let ket = $(target).data('ket-dosen');
            let nik = $(target).data('nik');
            console.log(npm, nik)
            $("#no_perubahan").val(no_perubahan)
            $("#ket_dosen").summernote('code', ket);
            $("#npm").val(npm)
            $("#nik").val(nik)

            let option = '<option value="">:: pilih ::</option>';
            if (status == 'revisi') {
                option += '<option value="revisi" selected>Revisi</option>' +
                    '<option value="acc">Acc</option>' +
                    '<option value="tolak">Tolak</option>';
            } else if (status == 'acc') {
                option += '<option value="acc" selected>Acc</option>' +
                    '<option value="revisi">Revisi</option>' +
                    '<option value="tolak">Tolak</option>';
            } else if (status == 'tolak') {
                option += ' <option value="tolak" selected>Tolak</option>' +
                    '<option value="acc">Acc</option>' +
                    '<option value="revisi">Revisi</option>';
            } else {
                option += '<option value="acc">Acc</option>' +
                    '<option value="revisi">Revisi</option>' +
                    '<option value="tolak">Tolak</option>';
            }

            $("#status_dosen").html(option);
        });
        // $(".review-dosen").click(function() {
        //     let no_perubahan = $(this).data('no-perubahan');
        //     let status = $(this).data('status-dosen');
        //     let npm = $(this).data('npm');
        //     let ket = $(this).data('ket-dosen');
        //     let nik = $(this).data('nik');
        //     console.log(npm, nik)
        //     $("#no_perubahan").val(no_perubahan)
        //     $("#ket_dosen").summernote('code', ket);
        //     $("#npm").val(npm)
        //     $("#nik").val(nik)

        //     let option = '<option value="">:: pilih ::</option>';
        //     if (status == 'revisi') {
        //         option += '<option value="revisi" selected>Revisi</option>' +
        //             '<option value="acc">Acc</option>' +
        //             '<option value="tolak">Tolak</option>';
        //     } else if (status == 'acc') {
        //         option += '<option value="acc" selected>Acc</option>' +
        //             '<option value="revisi">Revisi</option>' +
        //             '<option value="tolak">Tolak</option>';
        //     } else if (status == 'tolak') {
        //         option += ' <option value="tolak" selected>Tolak</option>' +
        //             '<option value="acc">Acc</option>' +
        //             '<option value="revisi">Revisi</option>';
        //     } else {
        //         option += '<option value="acc">Acc</option>' +
        //             '<option value="revisi">Revisi</option>' +
        //             '<option value="tolak">Tolak</option>';
        //     }

        //     $("#status_dosen").html(option);
        // });
        // review prodi
        $('#modal-review-prodi').on('show.bs.modal', function(e) {
            console.log(e.relatedTarget)
            let target = e.relatedTarget
            let no_perubahan = $(target).data('no-perubahan');
            let status = $(target).data('status-prodi');
            let ket = $(target).data('ket-prodi');
            let npm = $(target).data('npm');
            console.log(npm)
            $("#no_perubahanp").val(no_perubahan)
            $("#ket_prodi").summernote('code', ket);
            $("#npmp").val(npm);
            let option = '<option value="">:: pilih ::</option>';
            if (status == 'revisi') {
                option += '<option value="revisi" selected>Revisi</option>' +
                    '<option value="acc">Acc</option>' +
                    '<option value="tolak">Tolak</option>';
            } else if (status == 'acc') {
                option += '<option value="acc" selected>Acc</option>' +
                    '<option value="revisi">Revisi</option>' +
                    '<option value="tolak">Tolak</option>';
            } else if (status == 'tolak') {
                option += ' <option value="tolak" selected>Tolak</option>' +
                    '<option value="acc">Acc</option>' +
                    '<option value="revisi">Revisi</option>';
            } else {
                option += '<option value="acc">Acc</option>' +
                    '<option value="revisi">Revisi</option>' +
                    '<option value="tolak">Tolak</option>';
            }
            $("#status_prodi").html(option);
        })
        // $(".review-prodi").click(function() {
        //     alert(1)
        //     let no_perubahan = $(this).data('no-perubahan');
        //     let status = $(this).data('status-prodi');
        //     let ket = $(this).data('ket-prodi');
        //     let npm = $(this).data('npm');
        //     console.log(npm)
        //     $("#no_perubahanp").val(no_perubahan)
        //     $("#ket_prodi").summernote('code', ket);
        //     $("#npmp").val(npm);
        //     let option = '<option value="">:: pilih ::</option>';
        //     if (status == 'revisi') {
        //         option += '<option value="revisi" selected>Revisi</option>' +
        //             '<option value="acc">Acc</option>' +
        //             '<option value="tolak">Tolak</option>';
        //     } else if (status == 'acc') {
        //         option += '<option value="acc" selected>Acc</option>' +
        //             '<option value="revisi">Revisi</option>' +
        //             '<option value="tolak">Tolak</option>';
        //     } else if (status == 'tolak') {
        //         option += ' <option value="tolak" selected>Tolak</option>' +
        //             '<option value="acc">Acc</option>' +
        //             '<option value="revisi">Revisi</option>';
        //     } else {
        //         option += '<option value="acc">Acc</option>' +
        //             '<option value="revisi">Revisi</option>' +
        //             '<option value="tolak">Tolak</option>';
        //     }
        //     $("#status_prodi").html(option);
        // });
    });
</script>
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        toastr.info('<?= session()->getFlashdata('pesan') ?>')
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        toastr.error('<?= session()->getFlashdata('error') ?>')
    </script>
<?php endif; ?>
<?= $this->endSection() ?>