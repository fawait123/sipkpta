<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?php
$session = session();
$errors = $session->getFlashdata('errors');
$success = $session->getFlashdata('success');
date_default_timezone_set('Asia/Jakarta');
?>
<?php foreach ($tanggal as $row) :
    $start = $row->start;
    $end = $row->end;
//echo $paymentDate; // echos today!
endforeach;
$sekarang = strtotime(date("Y-m-d H:i:s"));
$start2 = strtotime($start);
$end2 = strtotime($end);
// $start2 = date("Y-m-d h:i:s", strtotime($start));
// $end2 = date("Y-m-d h:i:s", strtotime($end));
// $data = [
//     'sekarang'=>$sekarang,
//     'start'=>$start2,
//     'end'=>$end2
// ];
// $cek = $sekarang >= $start2;
// dd($cek);
if (($sekarang >= $start2) && ($sekarang <= $end2)) {
    if ($data_diri == "false") {
        // if ($pengajuankp2 == "true") {} elseif ($pengajuankp2 == "false") {}
        if ($pengajuan == "true") { ?>
            <!-- Default box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= $title; ?></h3>
                </div>
                <!-- form start -->
                <?php if ($errors != null) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php
                        foreach ($errors as $err) {
                            echo $err . '<br>';
                        }
                        ?>
                    </div>
                <?php endif ?>
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
                <form role="form" action="<?= base_url(''); ?>/Pengajuan/save" id="formpengajuan" method="post" enctype="multipart/form-data">
                    <input type="text" name="username" class="form-control" value="<?= $username; ?>" hidden>
                    <input type="text" name="jenis" class="form-control" value="<?= $jenis; ?>" hidden>
                    <div class="card-body">
                        <?php foreach ($pengumuman as $row2) : ?>
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Penting!</h5>
                                <p><?= nl2br($row2->pengumuman); ?></p>
                            </div>
                            <br>
                            <?php if ($jenis == "KP") {
                            ?>
                                <div class="form-group">
                                    <label><?= nl2br($row2->kode_topik); ?><span style="color: red;">*</span></label>
                                    <select id="kode_topik" name="kode_topik" class="form-control select2" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($tb_topik as $row) : ?>
                                            <option value="<?= $row->kode_topik; ?>"><?= $row->nama_topik; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?= nl2br($row2->nik); ?><span style="color: red;">*</span></label>
                                    <select id="kode_detail" name="kode_detail" class="form-control select2" required>
                                        <option value="">-Select-</option>
                                    </select>
                                </div>
                            <?php
                            } else { ?>
                                <br>
                                <div class="form-group">
                                    <label><?= nl2br($row2->kode_topik); ?><span style="color: red;">*</span></label>
                                    <select id="kode_topik2" name="kode_topik2" class="form-control select2" required>
                                        <option value="">-Select-</option>
                                        <?php foreach ($tb_topik as $row) : ?>
                                            <option value="<?= $row->kode_topik; ?>"><?= $row->nama_topik; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?= nl2br($row2->nik); ?><span style="color: red;">*</span></label>
                                    <select id="kode_detail2" name="kode_detail2" class="form-control select2" required>
                                        <option value="">-Select-</option>
                                    </select>
                                </div>
                            <?php } ?>
                            <br>
                            <div class="form-group">
                                <label><?= nl2br($row2->judul); ?><span style="color: red;">*</span></label>
                                <input type="text" name="judul" class="form-control" placeholder="Judul">
                            </div>
                            <br>
                            <div class="form-group">
                                <label><?= nl2br($row2->studi_kasus); ?></label>
                                <input type="text" name="studi_kasus" class="form-control" placeholder="Studi Kasus">
                            </div>
                            <br>
                            <div class="form-group">
                                <label><?= nl2br($row2->nilai_de); ?><span style="color: red;">*</span></label>
                                <select id="nilai_de" name="nilai_de" class="form-control select2" required>
                                    <option value="Iya">Iya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group mk_nilai_de2" id="mk_nilai_de2">
                                <label><?= nl2br($row2->mk_nilai_de); ?></label>
                                <textarea class="form-control mk_nilai_de" name="mk_nilai_de" id="mk_nilai_de" rows="3" placeholder="..."></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label><?= nl2br($row2->bukti_proposal); ?><span style="color: red;">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="bukti_proposal" id="bukti_proposal">
                                        <label class="custom-file-label" for="bukti_proposal">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <?php if ($jenis == "KP") {
                            ?>
                                <br>
                                <div class="form-group">
                                    <label><?= nl2br($row2->jumlah_sks); ?><span style="color: red;">*</span></label>
                                    <input type="text" name="jumlah_sks" class="form-control" placeholder="Jumlah SKS">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label><?= nl2br($row2->ipk); ?><span style="color: red;">*</span></label>
                                    <input type="text" name="ipk" class="form-control" placeholder="IPK">
                                </div>
                            <?php
                            } ?>
                            <br>
                            <div class="form-group">
                                <label><?= nl2br($row2->proposal); ?><span style="color: red;">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="proposal" id="proposal">
                                        <label class="custom-file-label" for="proposal">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <?php if ($jenis == "TA") {
                            ?>
                                <br>
                                <div class="form-group">
                                    <label><?= nl2br($row2->surat); ?></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="surat" id="surat">
                                            <label class="custom-file-label" for="surat">Choose file</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="surat2" id="surat2">
                                </div>
                            <?php } ?>
                            <br>
                            <div class="form-group">
                                <label><?= nl2br($row2->bukti_spp); ?></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="bukti_spp" id="bukti_spp">
                                        <label class="custom-file-label" for="bukti_spp">Choose file</label>
                                    </div>
                                    <input type="hidden" name="bukti_spp2" id="bukti_spp2">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label><?= nl2br($row2->sertifikat_sosialisasi); ?><span style="color: red;">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="sertifikat_sosialisasi" id="sertifikat_sosialisasi">
                                        <label class="custom-file-label" for="sertifikat_sosialisasi">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="setuju" name="setuju">
                                    <label class="form-check-label" for="exampleCheck2">Dengan ini saya menyatakan bahwa semua data yang saya isikan adalah BENAR, jika terjadi kekeliruan dan ketidakjujuran maka saya siap menerima 'KONSEKUENSI' yang akan diberikan oleh Prodi kepada saya !<span style="color: red;">*</span></label>
                                </div>
                            </div>
                            <br>
                            <label><span style="color: red;">*</span> = Wajib Diisi</label>
                    </div>
                    <!-- /.card-body -->
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                        <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                    <?php endforeach ?>
                    <input type="hidden" class="form-control" name="tahun_ajaran" id="tahun_ajaran" value="<?= $tahun_ajaran; ?>">
                    <input type="hidden" class="form-control" name="semester" id="semester" value="<?= $semester; ?>">
                    <input type="hidden" class="form-control" name="batas_bimbingan" id="batas_bimbingan" value="<?= $batas_bimbingan; ?>">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-file-upload"></i>&nbsp; Submit</button>
                    </div>
                <?php endforeach; ?>
                </form>
                <!-- /.card -->
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        <?php } elseif ($pengajuan == "false2") { ?>
            <?php if ($jenis == "TA") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>
                        Maaf Anda Belum Melakukan atau Menyelesaikan Kerja Praktik
                    </p>
                </div>
            <?php }
        } elseif ($pengajuan == "false") {
            ?>
            <div class="alert alert-success alert-dismissiblee">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>
                    Terimakasih, Anda Sudah Melakukan Pengajuan Proposal
                </p>
            </div>
            <!-- form start -->
            <?php if ($errors != null) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php
                    foreach ($errors as $err) {
                        echo $err . '<br>';
                    }
                    ?>
                </div>
            <?php endif ?>
            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline time label -->
                        <?php foreach ($pengajuan2 as $row) : ?>
                            <div class="time-label">
                                <?php $tanggal = $row->tanggal_pengajuan;
                                $tanggal2 = date("d M Y", strtotime($tanggal));
                                $jam = date("H:m", strtotime($tanggal));
                                ?>
                                <span class="bg-red"><?= $tanggal2; ?></span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i><?= $jam; ?></span>
                                    <h3 class="timeline-header"><a href="#">Daftar Pengajuan</a></h3>
                                    <div class="timeline-body">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>Judul</th>
                                                    <td>
                                                        <?= $row->judul; ?>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Studi Kasus</th>
                                                    <td>
                                                        <?= $row->studi_kasus; ?>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Bukti Pembayaran Proposal</th>
                                                    <td>
                                                        <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->bukti_proposal; ?></button>
                                                    </td>
                                                    <td>
                                                        <?php if ($row->status_berkas == "Belum OK") { ?>
                                                            <a href="#" class="btn btn-info btn-sm btn-bukti_proposal" data-no_berkas="<?= $row->no_berkas; ?>">
                                                                <i class="far fa-edit"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Proposal</th>
                                                    <td>
                                                        <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->proposal; ?></button>
                                                    </td>
                                                    <td>
                                                        <?php if ($row->status_berkas == "Belum OK") { ?>
                                                            <a href="#" class="btn btn-info btn-sm btn-proposal" data-no_proposal="<?= $row->no_proposal; ?>">
                                                                <i class="far fa-edit"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php if ($jenis == "TA") {
                                                ?>
                                                    <tr>
                                                        <th>Surat</th>
                                                        <td>
                                                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->surat; ?></button>
                                                        </td>
                                                        <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                                                <a href="#" class="btn btn-info btn-sm btn-surat" data-no_berkas="<?= $row->no_berkas; ?>">
                                                                    <i class="far fa-edit"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th>Bukti Pembayaran SPP</th>
                                                    <td>
                                                        <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->bukti_spp; ?></button>
                                                    </td>
                                                    <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                                            <a href="#" class="btn btn-info btn-sm btn-bukti_spp" data-no_berkas="<?= $row->no_berkas; ?>">
                                                                <i class="far fa-edit"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Sertifikat Sosialisasi</th>
                                                    <td>
                                                        <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->sertifikat_sosialisasi; ?></button>
                                                    </td>
                                                    <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                                            <a href="#" class="btn btn-info btn-sm btn-sertifikat_sosialisasi" data-no_berkas="<?= $row->no_berkas; ?>">
                                                                <i class="far fa-edit"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Status Pengajuan</th>
                                                    <td> <?= $row->status_pengajuan; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Catatan Pengajuan</th>
                                                    <td> <?= $row->catatan_pengajuan; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Status Berkas</th>
                                                    <td> <?= $row->status_berkas; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Catatan Berkas</th>
                                                    <td> <?= $row->catatan_berkas; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Status Nilai</th>
                                                    <td> <?= $row->status_nilai; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Catatan Nilai</th>
                                                    <td> <?= $row->catatan_nilai; ?> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                            <!-- END timeline item -->
                    </div>
                </div>
            <?php
        }
    } else { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>
                    Anda Belum Mengisi Form Data Diri!
                </p>
            </div>
        <?php } ?>
    <?php } else { ?>
        <?php if ($pengajuan == "true" || $pengajuan == "false2") { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Pengajuan Proposal <?= $jenis; ?>
                <?php if ($sekarang < $start2) {
                ?>
                    Belum Dibuka
                <?php
                } else { ?>
                    Sudah Ditutup
                <?php } ?>
            </div>
        <?php } elseif ($pengajuan == "false") {
        ?>
            <div class="alert alert-success alert-dismissiblee">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>
                    Terimakasih, Anda Sudah Melakukan Pengajuan Proposal
                </p>
            </div>
            <!-- form start -->
            <?php if ($errors != null) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php
                    foreach ($errors as $err) {
                        echo $err . '<br>';
                    }
                    ?>
                </div>
            <?php endif ?>
            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline time label -->
                        <?php foreach ($pengajuan2 as $row) : ?>
                            <div class="time-label">
                                <?php $tanggal = $row->tanggal_pengajuan;
                                $tanggal2 = date("d M Y", strtotime($tanggal));
                                $jam = date("H:m", strtotime($tanggal));
                                ?>
                                <span class="bg-red"><?= $tanggal2; ?></span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i><?= $jam; ?></span>
                                    <h3 class="timeline-header"><a href="#">Daftar Pengajuan</a></h3>
                                    <div class="timeline-body">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>Judul</th>
                                                    <td>
                                                        <?= $row->judul; ?>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Studi Kasus</th>
                                                    <td>
                                                        <?= $row->studi_kasus; ?>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Bukti Pembayaran Proposal</th>
                                                    <td>
                                                        <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->bukti_proposal; ?></button>
                                                    </td>
                                                    <td>
                                                        <?php if ($row->status_berkas == "Belum OK") { ?>
                                                            <a href="#" class="btn btn-info btn-sm btn-bukti_proposal" data-no_berkas="<?= $row->no_berkas; ?>">
                                                                <i class="far fa-edit"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Proposal</th>
                                                    <td>
                                                        <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->proposal; ?></button>
                                                    </td>
                                                    <td>
                                                        <?php if ($row->status_berkas == "Belum OK") { ?>
                                                            <a href="#" class="btn btn-info btn-sm btn-proposal" data-no_proposal="<?= $row->no_proposal; ?>">
                                                                <i class="far fa-edit"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php if ($jenis == "TA") {
                                                ?>
                                                    <tr>
                                                        <th>Surat</th>
                                                        <td>
                                                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->surat; ?></button>
                                                        </td>
                                                        <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                                                <a href="#" class="btn btn-info btn-sm btn-surat" data-no_berkas="<?= $row->no_berkas; ?>">
                                                                    <i class="far fa-edit"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th>Bukti Pembayaran SPP</th>
                                                    <td>
                                                        <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->bukti_spp; ?></button>
                                                    </td>
                                                    <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                                            <a href="#" class="btn btn-info btn-sm btn-bukti_spp" data-no_berkas="<?= $row->no_berkas; ?>">
                                                                <i class="far fa-edit"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Sertifikat Sosialisasi</th>
                                                    <td>
                                                        <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->sertifikat_sosialisasi; ?></button>
                                                    </td>
                                                    <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                                            <a href="#" class="btn btn-info btn-sm btn-sertifikat_sosialisasi" data-no_berkas="<?= $row->no_berkas; ?>">
                                                                <i class="far fa-edit"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Status Pengajuan</th>
                                                    <td> <?= $row->status_pengajuan; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Catatan Pengajuan</th>
                                                    <td> <?= $row->catatan_pengajuan; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Status Berkas</th>
                                                    <td> <?= $row->status_berkas; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Catatan Berkas</th>
                                                    <td> <?= $row->catatan_berkas; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Status Nilai</th>
                                                    <td> <?= $row->status_nilai; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Catatan Nilai</th>
                                                    <td> <?= $row->catatan_nilai; ?> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php foreach ($tb_review as $row2) : ?>
                                            <hr>
                                            <div class="callout callout-success">
                                                <label>Lembar Review Naskah Proposal</label>
                                                <br>
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th>Dosen Reviewer 1</th>
                                                            <td><?= $row2->nama_dosen; ?></td>
                                                            <td>
                                                                <?= $row2->review; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($row2->status_review == "Sudah Direview") { ?>
                                                                    <a href="<?= base_url('') ?>/ReviewProposal/downloadReview2/<?= $row2->no_detail_review ?>/<?= $row2->npm ?>/<?= $row2->nama_mahasiswa ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i>Review</a>
                                                                    <?php if ($row2->proposal_review != null) { ?>
                                                                        <a href="<?= base_url('') ?>/ReviewProposal/downloadProposal2/<?= $row2->no_detail_review ?>/<?= $row2->npm ?>/<?= $row2->nama_mahasiswa ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i>Proposal</a>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    Belum Direview
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <?php foreach ($tb_review2 as $row2) : ?>
                                                        <tr>
                                                            <th>Dosen Reviewer 2</th>
                                                            <td><?= $row2->nama_dosen; ?></td>
                                                            <td>
                                                                <?= $row2->review; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($row2->status_review == "Sudah Direview") { ?>
                                                                    <a href="<?= base_url('') ?>/ReviewProposal/downloadReview2/<?= $row2->no_detail_review ?>/<?= $row2->npm ?>/<?= $row2->nama_mahasiswa ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i>Review</a>
                                                                    <?php if ($row2->proposal_review != null) { ?>
                                                                        <a href="<?= base_url('') ?>/ReviewProposal/downloadProposal2/<?= $row2->no_detail_review ?>/<?= $row2->npm ?>/<?= $row2->nama_mahasiswa ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i>Proposal</a>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    Belum Direview
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php foreach ($tb_disposisi as $row2) : ?>
                                            <hr>
                                            <div class="callout callout-success">
                                                <label>Disposisi Pembimbing</label>
                                                <br>
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th>Dosen Pembimbing</th>
                                                            <td><?= $row2->nama_dosen; ?></td>
                                                            <td>
                                                                <a href="<?= base_url('') ?>/Pengajuan/downloadKartuBimbingan/KARTU BIMBINGAN/<?= $row2->no_disposisi ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i>&nbsp; Kartu Bimbingan</a>
                                                            </td>
                                                            <td>
                                                                <a href="<?= base_url('') ?>/Pengajuan/downloadLogbook/LOG BOOK/<?= $row2->no_disposisi ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i>&nbsp; Log Book</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td colspan="3" align="center">
                                                                <?php if ($row2->jenis == "KP") { ?>
                                                                    <a href="<?= $row2->link_kp; ?>" target="_blank" class="btn btn-info btn-sm">Link Grup Bimbingan KP</a>
                                                                <?php } else { ?>
                                                                    <a href="<?= $row2->link_ta; ?>" target="_blank" class="btn btn-info btn-sm">Link Grup Bimbingan TA</a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                            <!-- END timeline item -->
                    </div>
                </div>
            <?php
        } ?>
        <?php } ?>

        <?php foreach ($pengumuman as $row2) : ?>
            <!-- Modal Edit Product-->
            <form role="form" action="<?= base_url(''); ?>/Pengajuan/updateProposal" id="formeditproposal" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="editProposalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Proposal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="callout callout-warning">
                                        <p><?= $row2->proposal; ?></p>
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="proposal" id="proposal">
                                            <label class="custom-file-label" for="proposal">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <?php foreach ($user as $row) : ?>
                                    <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                                    <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                                <?php endforeach ?>
                                <input type="hidden" name="no_proposal" class="no_proposal">
                                <input type="hidden" name="jenis" value="<?= $jenis; ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Edit Product-->

            <!-- Modal Edit Product-->
            <form role="form" action="<?= base_url(''); ?>/Pengajuan/updateBerkas" id="formeditsurat" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="editSuratModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="callout callout-warning">
                                        <p><?= $row2->surat; ?></p>
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="surat" id="surat">
                                            <label class="custom-file-label" for="surat">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <?php foreach ($user as $row) : ?>
                                    <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                                    <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                                <?php endforeach ?>
                                <input type="hidden" name="jenis" value="<?= $jenis; ?>">
                                <input type="hidden" name="no_berkas" class="no_berkas">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Edit Product-->

            <!-- Modal Edit Product-->
            <form role="form" action="<?= base_url(''); ?>/Pengajuan/updateBerkas" id="formeditbuktiproposal" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="editBuktiProposalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="callout callout-warning">
                                        <p><?= $row2->bukti_proposal; ?></p>
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="bukti_proposal" id="bukti_proposal">
                                            <label class="custom-file-label" for="bukti_proposal">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <?php foreach ($user as $row) : ?>
                                    <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                                    <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                                <?php endforeach ?>
                                <input type="hidden" name="jenis" value="<?= $jenis; ?>">
                                <input type="hidden" name="no_berkas" class="no_berkas">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Edit Product-->
            <!-- Modal Edit Product-->
            <form role="form" action="<?= base_url(''); ?>/Pengajuan/updateBerkas" id="formeditbuktispp" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="editBuktiSPPModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="callout callout-warning">
                                        <p><?= $row2->bukti_spp; ?></p>
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="bukti_spp" id="bukti_spp">
                                            <label class="custom-file-label" for="bukti_spp">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <?php foreach ($user as $row) : ?>
                                    <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                                    <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                                <?php endforeach ?>
                                <input type="hidden" name="jenis" value="<?= $jenis; ?>">
                                <input type="hidden" name="no_berkas" class="no_berkas">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Edit Product-->

            <!-- Modal Edit Product-->
            <form role="form" action="<?= base_url(''); ?>/Pengajuan/updateBerkas" id="formeditsertifikatsosialisasi" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="editSertifikatSosialisasiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="callout callout-warning">
                                        <p><?= $row2->sertifikat_sosialisasi; ?></p>
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="sertifikat_sosialisasi" id="sertifikat_sosialisasi">
                                            <label class="custom-file-label" for="sertifikat_sosialisasi">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <?php foreach ($user as $row) : ?>
                                    <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                                    <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                                <?php endforeach ?>
                                <input type="hidden" name="jenis" value="<?= $jenis; ?>">
                                <input type="hidden" name="no_berkas" class="no_berkas">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Modal Edit Product-->
        <?php endforeach; ?>

        <script>
            $(function() {
                bsCustomFileInput.init();
            });

            $("#nilai_de").on('change', function() {
                $("mk_nilai_de2").hide();
                if ($(this).val() == 'Tidak') {
                    $("#mk_nilai_de2").hide();
                } else {
                    $("#mk_nilai_de2").show();
                }
            });

            $("#kode_topik").on('change', function() {
                $("#kode_detail").empty();
                var kode_topik = $("#kode_topik").val();
                $.ajax({
                    url: "<?= site_url('Pengajuan/getDosenKP') ?>",
                    type: 'GET',
                    data: {
                        'kode_topik': kode_topik,
                    },
                    dataType: 'json',
                    success: function(data) {
                        var html = '<option value="">Pilih Dosen</option>';
                        for (var count = 0; count < data.length; count++) {
                            html += '<option value="' + data[count].kode_detail + '">' + data[count].nama_dosen + '</option>';
                        }
                        $('#kode_detail').html(html);
                    },
                });
            });
            $("#kode_topik2").on('change', function() {
                $("#kode_detail2").empty();
                var kode_topik2 = $("#kode_topik2").val();
                $.ajax({
                    url: "<?= site_url('Pengajuan/getDosenTA') ?>",
                    type: 'GET',
                    data: {
                        'kode_topik2': kode_topik2,
                    },
                    dataType: 'json',
                    success: function(data) {
                        var html = '<option value="">Pilih Dosen</option>';
                        for (var count = 0; count < data.length; count++) {
                            html += '<option value="' + data[count].kode_detail + '">' + data[count].nama_dosen + '</option>';
                        }
                        $('#kode_detail2').html(html);
                    },
                });
            });

            $('#bukti_spp').on('change', function() {
                var bukti_spp = $('#bukti_spp').val();
                $("#bukti_spp2").val(bukti_spp);
            });

            $('#surat').on('change', function() {
                var surat = $('#surat').val();
                $("#surat2").val(surat);
            });

            // get Edit Product
            $('.btn-proposal').on('click', function() {
                // get data from button edit
                const no_proposal = $(this).data('no_proposal');
                // Set data to Form Edit
                $('.no_proposal').val(no_proposal);
                // Call Modal Edit
                $('#editProposalModal').modal('show');
            });

            // get Edit Product
            $('.btn-surat').on('click', function() {
                // get data from button edit
                const no_berkas = $(this).data('no_berkas');
                const surat = $(this).data('surat');
                // Set data to Form Edit
                $('.no_berkas').val(no_berkas);
                // Call Modal Edit
                $('#editSuratModal').modal('show');
            });

            // get Edit Product
            $('.btn-bukti_proposal').on('click', function() {
                // get data from button edit
                const no_berkas = $(this).data('no_berkas');
                // Set data to Form Edit
                $('.no_berkas').val(no_berkas);
                // Call Modal Edit
                $('#editBuktiProposalModal').modal('show');
            });

            // get Edit Product
            $('.btn-bukti_spp').on('click', function() {
                // get data from button edit
                const no_berkas = $(this).data('no_berkas');
                // Set data to Form Edit
                $('.no_berkas').val(no_berkas);
                // Call Modal Edit
                $('#editBuktiSPPModal').modal('show');
            });

            // get Edit Product
            $('.btn-sertifikat_sosialisasi').on('click', function() {
                // get data from button edit
                const no_berkas = $(this).data('no_berkas');
                // Set data to Form Edit
                $('.no_berkas').val(no_berkas);
                // Call Modal Edit
                $('#editSertifikatSosialisasiModal').modal('show');
            });

            $('#formpengajuan').validate({
                rules: {
                    judul: {
                        required: true,
                    },
                    nilai_de: {
                        required: true,
                    },
                    jumlah_sks: {
                        required: true,
                    },
                    ipk: {
                        required: true,
                    },
                    kode_detail: {
                        required: true,
                    },
                    kode_topik: {
                        required: true,
                    },
                    proposal: {
                        required: true,
                        extension: "pdf",
                    },
                    surat: {
                        extension: "pdf",
                    },
                    bukti_proposal: {
                        required: true,
                        extension: "pdf",
                    },
                    bukti_spp: {
                        extension: "pdf",
                    },
                    sertifikat_sosialisasi: {
                        required: true,
                        extension: "pdf",
                    },
                    setuju: {
                        required: true,
                    },
                },
                messages: {
                    judul: {
                        required: "Judul Wajib Diisi",
                    },
                    nilai_de: {
                        required: "Wajib Diisi",
                    },
                    jumlah_sks: {
                        required: "Wajib Diisi",
                    },
                    ipk: {
                        required: "Wajib Diisi",
                    },
                    kode_detail: {
                        required: "Wajib Diisi",
                    },
                    kode_topik: {
                        required: "Wajib Diisi",
                    },
                    proposal: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
                    },
                    surat: {
                        extension: "File Harus PDF",
                    },
                    bukti_proposal: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
                    },
                    bukti_spp: {
                        extension: "File Harus PDF",
                    },
                    sertifikat_sosialisasi: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
                    },
                    setuju: {
                        required: "Wajib Dicentang",
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

            $('#formeditproposal').validate({
                rules: {
                    proposal: {
                        required: true,
                        extension: "pdf",
                    },
                },
                messages: {
                    proposal: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
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

            $('#formeditsurat').validate({
                rules: {
                    surat: {
                        required: true,
                        extension: "pdf",
                    },
                },
                messages: {
                    surat: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
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

            $('#formeditktm').validate({
                rules: {
                    ktm: {
                        required: true,
                        extension: "pdf",
                    },
                },
                messages: {
                    ktm: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
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

            $('#formeditbuktiproposal').validate({
                rules: {
                    bukti_proposal: {
                        required: true,
                        extension: "pdf",
                    },
                },
                messages: {
                    bukti_proposal: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
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

            $('#formeditbuktispp').validate({
                rules: {
                    bukti_spp: {
                        required: true,
                        extension: "pdf",
                    },
                },
                messages: {
                    bukti_spp: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
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

            $('#formeditsertifikatsosialisasi').validate({
                rules: {
                    sertifikat_sosialisasi: {
                        required: true,
                        extension: "pdf",
                    },
                },
                sertifikat_sosialisasi: {
                    ktm: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
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

            jQuery.validator.addMethod("judul", function(value, element) {
                return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
            });
        </script>

        <?= $this->endsection(); ?>