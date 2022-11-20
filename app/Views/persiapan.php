<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-body" style="padding-left: 50px;">
                        <?php foreach ($tahun_ajaran as $row) : ?>
                            <form action="<?= base_url(''); ?>/Persiapan/updateTahunAjaran" id="formedittahunajaran" method="post">
                                <label>Tahun Ajaran : <?= $row->tahun_ajaran; ?></label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="input-group date" id="tahun_ajaran" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#tahun_ajaran" id="tahun_ajaran" name="tahun_ajaran" />
                                                <div class="input-group-append" data-target="#tahun_ajaran" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    /
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="input-group date" id="tahun_ajaran2" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#tahun_ajaran2" id="tahun_ajaran2" name="tahun_ajaran2" />
                                                <div class="input-group-append" data-target="#tahun_ajaran2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <br>
                                        <input type="radio" name="semester" value="Ganjil" <?php echo ($row->semester == 'Ganjil' ? ' checked' : ''); ?>> Ganjil
                                        <br>
                                        <input type="radio" name="semester" value="Genap" <?php echo ($row->semester == 'Genap' ? ' checked' : ''); ?>> Genap
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Batas Bimbingan</label>
                                            <div class="input-group date" id="batas_bimbingan" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#batas_bimbingan" name="batas_bimbingan" value="<?= $row->batas_bimbingan; ?>" />
                                                <div class="input-group-append" data-target="#batas_bimbingan" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?= $row->id_tahun_ajaran; ?>">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-kp" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Kerja Praktik</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-ta" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Tugas Akhir</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-perpanjang" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Perpanjang</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-kp" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <form action="<?= base_url(''); ?>/Persiapan/updateTanggalKP" id="formedittanggal" method="post">
                                    <div class="card-body">
                                        <?php foreach ($tanggalkp as $row) : ?>
                                            <div class="form-group">
                                                <label>Tanggal Buka</label>
                                                <div class="input-group date" id="start" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#start" name="start" value="<?= $row->start; ?>" />
                                                    <div class="input-group-append" data-target="#start" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Tutup</label>
                                                <div class="input-group date" id="end" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#end" name="end" value="<?= $row->end; ?>" />
                                                    <div class="input-group-append" data-target="#end" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $row->id; ?>">
                                            <button type="submit" class="btn btn-primary float-right">Update</button>
                                        <?php endforeach; ?>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-ta" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                <form action="<?= base_url(''); ?>/Persiapan/updateTanggalTA" id="formedittanggal" method="post">
                                    <div class="card-body">
                                        <?php foreach ($tanggalta as $row) : ?>
                                            <div class="form-group">
                                                <label>Tanggal Buka</label>
                                                <div class="input-group date" id="start2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#start2" name="start2" value="<?= $row->start; ?>" />
                                                    <div class="input-group-append" data-target="#start2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Tutup</label>
                                                <div class="input-group date" id="end2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#end2" name="end2" value="<?= $row->end; ?>" />
                                                    <div class="input-group-append" data-target="#end2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $row->id; ?>">
                                            <button type="submit" class="btn btn-primary float-right">Update</button>
                                        <?php endforeach; ?>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-perpanjang" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                <form action="<?= base_url(''); ?>/Persiapan/updateTanggalPerpanjang" id="formedittanggal" method="post">
                                    <div class="card-body">
                                        <?php foreach ($tanggalperpanjang as $row) : ?>
                                            <div class="form-group">
                                                <label>Tanggal Buka</label>
                                                <div class="input-group date" id="start3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#start3" name="start3" value="<?= $row->start; ?>" />
                                                    <div class="input-group-append" data-target="#start3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Tutup</label>
                                                <div class="input-group date" id="end3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#end3" name="end3" value="<?= $row->end; ?>" />
                                                    <div class="input-group-append" data-target="#end3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $row->id; ?>">
                                            <button type="submit" class="btn btn-primary float-right">Update</button>
                                        <?php endforeach; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="col-12">
    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-kp2" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Kerja Praktik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-ta2" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Tugas Akhir</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-three-kp2" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <?php foreach ($pengumumankp as $row) : ?>
                        <a href="#" class="btn btn-info btn-sm btn-edit-kp" data-id="<?= $row->id; ?>" data-pengumuman="<?= $row->pengumuman; ?>" data-kode_topik="<?= $row->kode_topik; ?>" data-judul="<?= $row->judul; ?>" data-studi_kasus="<?= $row->studi_kasus; ?>" data-nilai_de="<?= $row->nilai_de; ?>" data-mk_nilai_de="<?= $row->mk_nilai_de; ?>" data-nik="<?= $row->nik; ?>" data-bukti_proposal="<?= $row->bukti_proposal; ?>" data-jumlah_sks="<?= $row->jumlah_sks; ?>" data-ipk="<?= $row->ipk; ?>" data-proposal="<?= $row->proposal; ?>" data-bukti_spp="<?= $row->bukti_spp; ?>" data-sertifikat_sosialisasi="<?= $row->sertifikat_sosialisasi; ?>">
                            <i class="far fa-edit"></i> Edit Pengumuman KP</a>
                        <br>
                        <br>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-">
                                <tbody>
                                    <tr>
                                        <td>Pengumuman</td>
                                        <td>
                                            <p><?= nl2br($row->pengumuman); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Topik</td>
                                        <td>
                                            <p><?= nl2br($row->kode_topik); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Judul</td>
                                        <td>
                                            <p><?= nl2br($row->judul); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Studi Kasus</td>
                                        <td>
                                            <p><?= nl2br($row->studi_kasus); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai D/E</td>
                                        <td>
                                            <p><?= nl2br($row->nilai_de); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MK Nilai DE</td>
                                        <td>
                                            <p><?= nl2br($row->mk_nilai_de); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pilihan Dosen</td>
                                        <td>
                                            <p><?= nl2br($row->nik); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bukti Bayar Proposal</td>
                                        <td>
                                            <p><?= nl2br($row->bukti_proposal); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah SKS</td>
                                        <td>
                                            <p><?= nl2br($row->jumlah_sks); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>IPK</td>
                                        <td>
                                            <p><?= nl2br($row->ipk); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Proposal</td>
                                        <td>
                                            <p><?= nl2br($row->proposal); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bukti Pembayaran SPP</td>
                                        <td>
                                            <p><?= nl2br($row->bukti_spp); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sertifikasi Sosialisasi</td>
                                        <td>
                                            <p><?= nl2br($row->sertifikat_sosialisasi); ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                    <div class="modal fade" id="editModalKP">
                        <form action="<?= base_url(''); ?>/Persiapan/updateKP" id="formeditpengumumankp" method="post">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Pengumuman</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Pengumuman</label>
                                                <textarea class="form-control" name="pengumuman" id="pengumuman" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Topik</label>
                                                <textarea class="form-control" name="kode_topik" id="kode_topik" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <textarea class="form-control" name="judul" id="judul" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Studi Kasus</label>
                                                <textarea class="form-control" name="studi_kasus" id="studi_kasus" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Nilai D/E</label>
                                                <textarea class="form-control" name="nilai_de" id="nilai_de" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>MK Nilai D/E</label>
                                                <textarea class="form-control" name="mk_nilai_de" id="mk_nilai_de" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Pilihan Dosen</label>
                                                <textarea class="form-control" name="nik" id="nik" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Bukti Pembayaran Proposal</label>
                                                <textarea class="form-control" name="bukti_proposal" id="bukti_proposal" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Jumlah SKS</label>
                                                <textarea class="form-control" name="jumlah_sks" id="jumlah_sks" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>IPK</label>
                                                <textarea class="form-control" name="ipk" id="ipk" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Proposal</label>
                                                <textarea class="form-control" name="proposal" id="proposal" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Bukti Pembayaran SPP</label>
                                                <textarea class="form-control" name="bukti_spp" id="bukti_spp" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Sertifikat Sosialisasi</label>
                                                <textarea class="form-control" name="sertifikat_sosialisasi" id="sertifikat_sosialisasi" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="id" class="id">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </form>
                    </div>
                    <!-- /.modal -->
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-ta2" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    <?php foreach ($pengumumanta as $row) : ?>
                        <a href="#" class="btn btn-info btn-sm btn-edit-ta" data-id2="<?= $row->id; ?>" data-pengumuman2="<?= $row->pengumuman; ?>" data-kode_topik2="<?= $row->kode_topik; ?>" data-judul2="<?= $row->judul; ?>" data-studi_kasus2="<?= $row->studi_kasus; ?>" data-nilai_de2="<?= $row->nilai_de; ?>" data-mk_nilai_de2="<?= $row->mk_nilai_de; ?>" data-nik2="<?= $row->nik; ?>" data-bukti_proposal2="<?= $row->bukti_proposal; ?>" data-proposal2="<?= $row->proposal; ?>" data-bukti_spp2="<?= $row->bukti_spp; ?>" data-surat2="<?= $row->surat; ?>" data-sertifikat_sosialisasi2="<?= $row->sertifikat_sosialisasi; ?>">
                            <i class="far fa-edit"></i> Edit Pengumuman TA</a>
                        <br>
                        <br>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-">
                                <tbody>
                                    <tr>
                                        <td>Pengumuman</td>
                                        <td>
                                            <p><?= nl2br($row->pengumuman); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Topik</td>
                                        <td>
                                            <p><?= nl2br($row->kode_topik); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Judul</td>
                                        <td>
                                            <p><?= nl2br($row->judul); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Studi Kasus</td>
                                        <td>
                                            <p><?= nl2br($row->studi_kasus); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai D/E</td>
                                        <td>
                                            <p><?= nl2br($row->nilai_de); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MK Nilai DE</td>
                                        <td>
                                            <p><?= nl2br($row->mk_nilai_de); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pilihan Dosen</td>
                                        <td>
                                            <p><?= nl2br($row->nik); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bukti Pembayaran Proposal</td>
                                        <td>
                                            <p><?= nl2br($row->bukti_proposal); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Proposal</td>
                                        <td>
                                            <p><?= nl2br($row->proposal); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bukti Pembayaran SPP</td>
                                        <td>
                                            <p><?= nl2br($row->bukti_spp); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Surat</td>
                                        <td>
                                            <p><?= nl2br($row->surat); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sertifikasi Sosialisasi</td>
                                        <td>
                                            <p><?= nl2br($row->sertifikat_sosialisasi); ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                    <div class="modal fade" id="editModalTA">
                        <form action="<?= base_url(''); ?>/Persiapan/updateTA" id="formeditpengumumanta" method="post">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Pengumuman</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Pengumuman</label>
                                                <textarea class="form-control" name="pengumuman2" id="pengumuman2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Topik</label>
                                                <textarea class="form-control" name="kode_topik2" id="kode_topik2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <textarea class="form-control" name="judul2" id="judul2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Studi Kasus</label>
                                                <textarea class="form-control" name="studi_kasus2" id="studi_kasus2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Nilai D/E</label>
                                                <textarea class="form-control" name="nilai_de2" id="nilai_de2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>MK Nilai D/E</label>
                                                <textarea class="form-control" name="mk_nilai_de2" id="mk_nilai_de2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Pilihan Dosen</label>
                                                <textarea class="form-control" name="nik2" id="nik2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Bukti Pembayaran Proposal</label>
                                                <textarea class="form-control" name="bukti_proposal2" id="bukti_proposal2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Proposal</label>
                                                <textarea class="form-control" name="proposal2" id="proposal2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Bukti Pembayaran SPP</label>
                                                <textarea class="form-control" name="bukti_spp2" id="bukti_spp2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Surat</label>
                                                <textarea class="form-control" name="surat2" id="surat2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Sertifikat Sosialisasi</label>
                                                <textarea class="form-control" name="sertifikat_sosialisasi2" id="sertifikat_sosialisasi2" rows="3" placeholder="..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="id2" class="id2">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </form>
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#tahun_ajaran').datetimepicker({
            format: 'YYYY',
            autoClose: true,
        });

        $('#tahun_ajaran2').datetimepicker({
            format: 'YYYY',
            autoClose: true,
            useCurrent: false
        });

        $("#tahun_ajaran").on("change.datetimepicker", function(e) {
            $('#tahun_ajaran2').datetimepicker('minDate', e.date);
        });

        $("#tahun_ajaran2").on("change.datetimepicker", function(e) {
            $('#tahun_ajaran').datetimepicker('maxDate', e.date);
        });

        $('#batas_bimbingan').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#start').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true
        });

        $('#end').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true,
            useCurrent: false
        });

        $("#start").on("change.datetimepicker", function(e) {
            $('#end').datetimepicker('minDate', e.date);
        });

        $("#end").on("change.datetimepicker", function(e) {
            $('#start').datetimepicker('maxDate', e.date);
        });

        $('#start2').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true
        });

        $('#end2').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true,
            useCurrent: false
        });

        $("#start2").on("change.datetimepicker", function(e) {
            $('#end2').datetimepicker('minDate', e.date);
        });

        $("#end2").on("change.datetimepicker", function(e) {
            $('#start2').datetimepicker('maxDate', e.date);
        });

        $('#start3').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true
        });

        $('#end3').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true,
            useCurrent: false
        });

        $("#start3").on("change.datetimepicker", function(e) {
            $('#end3').datetimepicker('minDate', e.date);
        });

        $("#end3").on("change.datetimepicker", function(e) {
            $('#start3').datetimepicker('maxDate', e.date);
        });

        // get Edit Product
        $('.btn-edit-kp').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const pengumuman = $(this).data('pengumuman');
            const kode_topik = $(this).data('kode_topik');
            const judul = $(this).data('judul');
            const studi_kasus = $(this).data('studi_kasus');
            const nilai_de = $(this).data('nilai_de');
            const mk_nilai_de = $(this).data('mk_nilai_de');
            const nik = $(this).data('nik');
            const bukti_proposal = $(this).data('bukti_proposal');
            const jumlah_sks = $(this).data('jumlah_sks');
            const ipk = $(this).data('ipk');
            const proposal = $(this).data('proposal');
            const bukti_spp = $(this).data('bukti_spp');
            const sertifikat_sosialisasi = $(this).data('sertifikat_sosialisasi');
            // Set data to Form Edit
            $('.id').val(id);
            $('#pengumuman').val(pengumuman);
            $('#kode_topik').val(kode_topik);
            $('#judul').val(judul);
            $('#studi_kasus').val(studi_kasus);
            $('#nilai_de').val(nilai_de);
            $('#mk_nilai_de').val(mk_nilai_de);
            $('#nik').val(nik);
            $("#bukti_proposal").val(bukti_proposal);
            $('#jumlah_sks').val(jumlah_sks);
            $('#ipk').val(ipk);
            $('#proposal').val(proposal);
            $("#bukti_spp").val(bukti_spp);
            $("#sertifikat_sosialisasi").val(sertifikat_sosialisasi);
            // Call Modal Edit
            $('#editModalKP').modal('show');
        });

        // get Edit Product
        $('.btn-edit-ta').on('click', function() {
            // get data from button edit
            const id2 = $(this).data('id2');
            const pengumuman2 = $(this).data('pengumuman2');
            const kode_topik2 = $(this).data('kode_topik2');
            const judul2 = $(this).data('judul2');
            const studi_kasus2 = $(this).data('studi_kasus2');
            const nilai_de2 = $(this).data('nilai_de2');
            const mk_nilai_de2 = $(this).data('mk_nilai_de2');
            const nik2 = $(this).data('nik2');
            const bukti_proposal2 = $(this).data('bukti_proposal2');
            const proposal2 = $(this).data('proposal2');
            const bukti_spp2 = $(this).data('bukti_spp2');
            const surat2 = $(this).data('surat2');
            const sertifikat_sosialisasi2 = $(this).data('sertifikat_sosialisasi2');
            // Set data to Form Edit
            $('.id2').val(id2);
            $('#pengumuman2').val(pengumuman2);
            $('#kode_topik2').val(kode_topik2);
            $('#judul2').val(judul2);
            $('#studi_kasus2').val(studi_kasus2);
            $('#nilai_de2').val(nilai_de2);
            $('#mk_nilai_de2').val(mk_nilai_de2);
            $('#nik2').val(nik2);
            $("#bukti_proposal2").val(bukti_proposal2);
            $('#proposal2').val(proposal2);
            $("#bukti_spp2").val(bukti_spp2);
            $('#surat2').val(surat2);
            $("#sertifikat_sosisaliasi2").val(sertifikat_sosialisasi2);
            // Call Modal Edit
            $('#editModalTA').modal('show');
        });


        $('#formedittahunajaran').validate({
            rules: {
                tahun_ajaran: {
                    required: true,
                },
                tahun_ajaran2: {
                    required: true,
                },
                semester: {
                    required: true,
                }
            },
            messages: {
                tahun_ajaran: {
                    required: "Wajib Diisi",
                },
                tahun_ajaran2: {
                    required: "Wajib Diisi",
                },
                semmester: {
                    required: "Wajib Diisi",
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
            },
        });

        $('#formeditpengumumankp').validate({
            rules: {
                pengumuman: {
                    required: true,
                },
                kode_topik: {
                    required: true,
                },
                judul: {
                    required: true,
                },
                studi_kasus: {
                    required: true,
                },
                nilai_de: {
                    required: true,
                },
                mk_nilai_de: {
                    required: true,
                },
                nik: {
                    required: true,
                },
                bukti_proposal: {
                    required: true,
                },
                jumlah_sks: {
                    required: true,
                },
                ipk: {
                    required: true,
                },
                proposal: {
                    required: true,
                },
                bukti_spp: {
                    required: true,
                },
                sertifikat_sosialisasi: {
                    required: true,
                },
            },
            messages: {
                pengumuman: {
                    required: "Wajib Diisi",
                },
                kode_topik: {
                    required: "Wajib Diisi",
                },
                judul: {
                    required: "Wajib Diisi",
                },
                studi_kasus: {
                    required: "Wajib Diisi",
                },
                nilai_de: {
                    required: "Wajib Diisi",
                },
                mk_nilai_de: {
                    required: "Wajib Diisi",
                },
                nik: {
                    required: "Wajib Diisi",
                },
                bukti_proposal: {
                    required: "Wajib Diisi",
                },
                jumlah_sks: {
                    required: "Wajib Diisi",
                },
                ipk: {
                    required: "Wajib Diisi",
                },
                proposal: {
                    required: "Wajib Diisi",
                },
                bukti_spp: {
                    required: "Wajib Diisi",
                },
                sertifikat_sosialisasi: {
                    required: "Wajib Diisi",
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
            },
        });

        $('#formeditpengumumanta').validate({
            rules: {
                pengumuman2: {
                    required: true,
                },
                kode_topik2: {
                    required: true,
                },
                judul2: {
                    required: true,
                },
                studi_kasus2: {
                    required: true,
                },
                nilai_de2: {
                    required: true,
                },
                mk_nilai_de2: {
                    required: true,
                },
                nik2: {
                    required: true,
                },
                bukti_proposal2: {
                    required: true,
                },
                proposal2: {
                    required: true,
                },
                bukti_spp2: {
                    required: true,
                },
                surat2: {
                    required: true,
                },
                sertifikat_sosialisasi2: {
                    required: true,
                },
            },
            messages: {
                pengumuman2: {
                    required: "Wajib Diisi",
                },
                kode_topik2: {
                    required: "Wajib Diisi",
                },
                judul2: {
                    required: "Wajib Diisi",
                },
                studi_kasus2: {
                    required: "Wajib Diisi",
                },
                nilai_de2: {
                    required: "Wajib Diisi",
                },
                mk_nilai_de2: {
                    required: "Wajib Diisi",
                },
                nik2: {
                    required: "Wajib Diisi",
                },
                bukti_proposal2: {
                    required: "Wajib Diisi",
                },
                proposal2: {
                    required: "Wajib Diisi",
                },
                bukti_spp2: {
                    required: "Wajib Diisi",
                },
                surat2: {
                    required: "Wajib Diisi",
                },
                sertifikat_sosialisasi2: {
                    required: "Wajib Diisi",
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
            },
        });
    });
</script>

<?= $this->endsection(); ?>