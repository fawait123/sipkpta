<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?php
$session = session();
$errors = $session->getFlashdata('errors');
$success = $session->getFlashdata('success');
date_default_timezone_set('Asia/Jakarta');
?>
<div class="card-body p-0">
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
</div>
<?php foreach ($tb_perpanjang as $row) : ?>
    <?php if ($semester != $row->semester && $tahun_ajaran != $row->tahun_ajaran && $row->status_perpanjang == "Perpanjang") { ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Mohon Maaf Anda Sudah Pernah Melakukan Perpanjang <?= $row->jenis; ?>
        </div>
    <?php } elseif ($row->status_perpanjang == "Perpanjang") { ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Terimakasih Anda Sudah Melakukan Perpanjang <?= $row->jenis; ?>
        </div>
        <!-- Timelime example  -->
        <div class="row">
            <div class="col-md-12">
                <!-- The time line -->
                <div class="timeline">
                    <!-- timeline time label -->
                    <?php foreach ($tb_berkas_perpanjang as $row2) : ?>
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="#">Perpanjang</a></h3>
                                <div class="timeline-body">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Judul</th>
                                                <td>
                                                    <?= $row2->judul; ?>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Studi Kasus</th>
                                                <td>
                                                    <?= $row2->studi_kasus; ?>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Kartu Bimbingan</th>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-info btn-xs"><?= $row2->kartu_bimbingan; ?></button>
                                                </td>
                                                <td>
                                                    <?php if ($row2->status_berkas_perpanjang == "Belum OK") { ?>
                                                        <a href="#" class="btn btn-info btn-sm btn-kartubimbingan" data-no_berkas_perpanjang="<?= $row2->no_berkas_perpanjang; ?>">
                                                            <i class="far fa-edit"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Bukti Pembayaran SPP Tetap</th>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-info btn-xs"><?= $row2->bukti_spp_tetap; ?></button>
                                                </td>
                                                <td>
                                                    <?php if ($row2->status_berkas_perpanjang == "Belum OK") { ?>
                                                        <a href="#" class="btn btn-info btn-sm btn-buktispptetap" data-no_berkas_perpanjang="<?= $row2->no_berkas_perpanjang; ?>">
                                                            <i class="far fa-edit"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Bukti Pembayaran SPP Variabel</th>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-info btn-xs"><?= $row2->bukti_spp_variabel; ?></button>
                                                </td>
                                                <td>
                                                    <?php if ($row2->status_berkas_perpanjang == "Belum OK") { ?>
                                                        <a href="#" class="btn btn-info btn-sm btn-buktisppvariabel" data-no_berkas_perpanjang="<?= $row2->no_berkas_perpanjang; ?>">
                                                            <i class="far fa-edit"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>KRS</th>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-info btn-xs"><?= $row2->krs; ?></button>
                                                </td>
                                                <td>
                                                    <?php if ($row2->status_berkas_perpanjang == "Belum OK") { ?>
                                                        <a href="#" class="btn btn-info btn-sm btn-krs" data-no_berkas_perpanjang="<?= $row2->no_berkas_perpanjang; ?>">
                                                            <i class="far fa-edit"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Keterangan</th>
                                                <td>
                                                    <?= $row2->keterangan; ?>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Status Berkas Perpanjang</th>
                                                <td>
                                                    <?= $row2->status_berkas_perpanjang; ?>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Catatan Berkas Perpanjang</th>
                                                <td>
                                                    <?= $row2->catatan_berkas_perpanjang; ?>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php foreach ($tb_disposisi as $row3) : ?>
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>Dosen Pembimbing</th>
                                                    <td><?= $row3->nama_dosen; ?></td>
                                                    <td>
                                                        <a href="<?= base_url('') ?>/Perpanjang/downloadKartuBimbingan/KARTU BIMBINGAN/<?= $row3->no_disposisi ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i>&nbsp; Kartu Bimbingan</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="3" align="center">
                                                        <?php if ($row3->jenis == "KP") { ?>
                                                            <a href="<?= $row3->link_kp; ?>" target="_blank" class="btn btn-info btn-sm">Link Grup Bimbingan KP</a>
                                                        <?php } else { ?>
                                                            <a href="<?= $row3->link_ta; ?>" target="_blank" class="btn btn-info btn-sm">Link Grup Bimbingan TA</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
        <?php } elseif ($row->status_perpanjang == "Baru") { ?>
            <?php if ($semester == $row->semester && $tahun_ajaran == $row->tahun_ajaran) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Mohon Maaf Anda Belum Bisa Melakukan Perpanjang <?= $row->jenis; ?> Pada Semester Ini
                </div>
            <?php } else { ?>
                <!-- Default box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?= $title; ?></h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 1%">
                                        #
                                    </th>
                                    <th style="width: 30%">
                                        Judul
                                    </th>
                                    <th style="width: 30%">
                                        Studi Kasus
                                    </th>
                                    <th style="width: 10%">
                                        Batas Bimbingan
                                    </th>
                                    <th style="width: 10%">
                                        Jenis
                                    </th>
                                    <th style="width: 10%">
                                        Status Perpanjang
                                    </th>
                                    <th style="width: 10%">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        #
                                    </td>
                                    <td>
                                        <?= $row->judul; ?>
                                    </td>
                                    <td>
                                        <?= $row->studi_kasus; ?>
                                    </td>
                                    <td>
                                        <?= $row->batas_bimbingan; ?>
                                    </td>
                                    <td>
                                        <?= $row->jenis; ?>
                                    </td>
                                    <td>
                                        <?php if ($row->status_perpanjang == "Baru") { ?>
                                            <span class="badge badge-warning">
                                                <?= $row->status_perpanjang; ?>
                                            </span>
                                        <?php } else { ?>
                                            <span class="badge badge-info">
                                                <?= $row->status_perpanjang; ?>
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm btn-perpanjang" <?php if ($row->status_perpanjang == "Perpanjang") { ?> style="pointer-events: none;" <?php } ?> data-no_pengajuan="<?= $row->no_pengajuan; ?>" data-nik="<?= $row->nik; ?>" data-nama_dosen="<?= $row->nama_dosen; ?>" data-jenis="<?= $row->jenis; ?>">Perpanjang</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            <?php } ?>
        <?php } ?>
    <?php endforeach; ?>

    <!-- Modal Add Product-->
    <form role="form" action="<?= base_url(''); ?>/Perpanjang/update" id="formperpanjang" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="perpanjangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <?php foreach ($tanggal_perpanjang as $row) :
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
                if (($sekarang >= $start2) && ($sekarang <= $end2)) { ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Perpanjang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Penting!</h5>
                                <p>Formulir ini berlaku untuk semua angkatan pada Program Studi Sistem Informasi, Fakultas Sains & Teknologi, Universitas Teknologi Yogyakarta. <br>
                                    sebelum melakukan pendaftaran pastikan anda sudah menyiapkan lampiran yang perlu dimasukkan dalam file PDF antara lain :<br>
                                    1. Bukti Pembayaran SPP Tetap (format nama file : NPM_Nama_BuktiBayarSPP )<br>
                                    2. Bukti Pembayaran Variabel KP / TA (format nama file : NPM_Nama_BuktiBayarKP/TA )<br>
                                    3. Bukti KRS (format nama file : NPM_Nama_KRS )<br>
                                    4. Kartu bimbingan (format nama file : NPM_Nama_Kartu)<br>
                                    #kartu bimbingan masih menggunakan kartu yang sama/kemarin<br>
                                    <br>
                                    kalau ada pertanyaan terkait proses pendaftaran bisa bertanya ke contact person dibawah ini :<br>
                                    CP : ridha (085328882001-WA)<br>
                                    <br>
                                </p>
                            </div>
                            <div class="form-group">
                                <label>
                                    1. Upload Kartu Bimbingan (Format nama file : NIM_Nama_Kartu, jenis file : pdf)<span style="color: red;">*</span></p>
                                </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="kartu_bimbingan" id="kartu_bimbingan">
                                        <label class="custom-file-label" for="kartu_bimbingan">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    2. Upload Bukti Bayar SPP Tetap (Format nama file : NIM_Nama_SPPTetap, jenis file : pdf)</p>
                                </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="bukti_spp_tetap" id="bukti_spp_tetap">
                                        <label class="custom-file-label" for="bukti_spp_tetap">Choose file</label>
                                    </div>
                                    <input type="hidden" name="bukti_spp_tetap2" id="bukti_spp_tetap2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    3. Diisikan jika sudah membayarkan SPP Variabel. Upload bukti bayar SPP Variabel KP (format nama file : NPM_Nama_BuktiSPP, jenis file : PDF)</p>
                                </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="bukti_spp_variabel" id="bukti_spp_variabel">
                                        <label class="custom-file-label" for="bukti_spp_variabel">Choose file</label>
                                    </div>
                                    <input type="hidden" name="bukti_spp_variabel2" id="bukti_spp_variabel2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    4. Upload KRS (Format nama file : NIM_Nama_KRS, jenis file : PDF)</p>
                                </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="krs" id="krs">
                                        <label class="custom-file-label" for="krs">Choose file</label>
                                    </div>
                                    <input type="hidden" name="krs2" id="krs2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    5. Keterangan Tambahan (diisikan jika ada)</p>
                                </label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="..."></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="setuju" name="setuju">
                                    <label class="form-check-label" for="exampleCheck2">Dengan ini saya menyatakan bahwa semua data yang saya isikan adalah BENAR, jika terjadi kekeliruan dan ketidakjujuran maka saya siap menerima 'KONSEKUENSI' yang akan diberikan oleh Prodi kepada saya !</label>
                                </div>
                            </div>
                            <label><span style="color: red;">*</span> = Wajib Diisi</label>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="jenis" class="jenis">
                            <?php foreach ($user as $row) : ?>
                                <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                                <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                            <?php endforeach ?>
                            <input type="hidden" name="no_pengajuan" class="no_pengajuan">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Perpanjang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Mohon Maaf Form Perpanjang Belum Dibuka
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </form>
    <!-- End Modal Add Product-->

    <!-- Modal Edit Product-->
    <form role="form" action="<?= base_url(''); ?>/Perpanjang/updateBerkasPerpanjang2" id="formeditberkasperpanjang" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="editKartuBimbinganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Perpanjang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>
                            Upload Kartu Bimbingan (Format nama file : NIM_Nama_Kartu, jenis file : pdf)</p>
                        </label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="kartu_bimbingan" id="kartu_bimbingan">
                                <label class="custom-file-label" for="kartu_bimbingan">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                        <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                    <?php endforeach ?>
                    <input type="hidden" name="no_berkas_perpanjang" class="no_berkas_perpanjang">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
        </div>
        </form>
        <!-- End Modal Edit Product-->
        <!-- Modal Edit Product-->
        <form role="form" action="<?= base_url(''); ?>/Perpanjang/updateBerkasPerpanjang2" id="formeditberkasperpanjang" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="editSPPTetapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Perpanjang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>
                                    Upload Bukti Bayar SPP Tetap (Format nama file : NIM_Nama_SPPTetap, jenis file : pdf)</p>
                                </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="bukti_spp_tetap" id="bukti_spp_tetap">
                                        <label class="custom-file-label" for="bukti_spp_tetap">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php foreach ($user as $row) : ?>
                                <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                                <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                            <?php endforeach ?>
                            <input type="hidden" name="no_berkas_perpanjang" class="no_berkas_perpanjang">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit Product-->
        <!-- Modal Edit Product-->
        <form role="form" action="<?= base_url(''); ?>/Perpanjang/updateBerkasPerpanjang2" id="formeditberkasperpanjang" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="editSPPVariabelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Perpanjang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>
                                    Diisikan jika sudah membayarkan SPP Variabel. Upload bukti bayar SPP Variabel KP (format nama file : NPM_Nama_BuktiSPP, jenis file : PDF)</p>
                                </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="bukti_spp_variabel" id="bukti_spp_variabel">
                                        <label class="custom-file-label" for="bukti_spp_variabel">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php foreach ($user as $row) : ?>
                                <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                                <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                            <?php endforeach ?>
                            <input type="hidden" name="no_berkas_perpanjang" class="no_berkas_perpanjang">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit Product-->
        <!-- Modal Edit Product-->
        <form role="form" action="<?= base_url(''); ?>/Perpanjang/updateBerkasPerpanjang2" id="formeditberkasperpanjang" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="editKRSModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Perpanjang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>
                                    Upload KRS (Format nama file : NIM_Nama_KRS, jenis file : PDF)</p>
                                </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="krs" id="krs">
                                        <label class="custom-file-label" for="krs">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php foreach ($user as $row) : ?>
                                <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                                <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                            <?php endforeach ?>
                            <input type="hidden" name="no_berkas_perpanjang" class="no_berkas_perpanjang">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal Edit Product-->

        <script>
            $(document).ready(function() {
                bsCustomFileInput.init()
                $('.btn-perpanjang').on('click', function() {
                    const no_pengajuan = $(this).data('no_pengajuan');
                    const nama_dosen = $(this).data('nama_dosen');
                    const jenis = $(this).data('jenis');
                    $('.no_pengajuan').val(no_pengajuan);
                    $('.nama_dosen').val(nama_dosen);
                    $('.jenis').val(jenis);
                    $('#perpanjangModal').modal('show');
                });

                $('#bukti_spp_variabel').on('change', function() {
                    var bukti_spp_variabel = $('#bukti_spp_variabel').val();
                    $("#bukti_spp_variabel2").val(bukti_spp_variabel);
                });

                $('#bukti_spp_tetap').on('change', function() {
                    var bukti_spp_tetap = $('#bukti_spp_tetap').val();
                    $("#bukti_spp_tetap2").val(bukti_spp_tetap);
                });

                $('#krs').on('change', function() {
                    var krs = $('#krs').val();
                    $("#krs2").val(krs);
                });

                // get Edit Product
                $('.btn-kartubimbingan').on('click', function() {
                    // get data from button edit
                    const no_berkas_perpanjang = $(this).data('no_berkas_perpanjang');
                    // Set data to Form Edit
                    $('.no_berkas_perpanjang').val(no_berkas_perpanjang);
                    // Call Modal Edit
                    $('#editKartuBimbinganModal').modal('show');
                });
                // get Edit Product
                $('.btn-buktispptetap').on('click', function() {
                    // get data from button edit
                    const no_berkas_perpanjang = $(this).data('no_berkas_perpanjang');
                    // Set data to Form Edit
                    $('.no_berkas_perpanjang').val(no_berkas_perpanjang);
                    // Call Modal Edit
                    $('#editSPPTetapModal').modal('show');
                });
                // get Edit Product
                $('.btn-buktisppvariabel').on('click', function() {
                    // get data from button edit
                    const no_berkas_perpanjang = $(this).data('no_berkas_perpanjang');
                    // Set data to Form Edit
                    $('.no_berkas_perpanjang').val(no_berkas_perpanjang);
                    // Call Modal Edit
                    $('#editSPPVariabelModal').modal('show');
                });
                // get Edit Product
                $('.btn-krs').on('click', function() {
                    // get data from button edit
                    const no_berkas_perpanjang = $(this).data('no_berkas_perpanjang');
                    // Set data to Form Edit
                    $('.no_berkas_perpanjang').val(no_berkas_perpanjang);
                    // Call Modal Edit
                    $('#editKRSModal').modal('show');
                });

                $('#formperpanjang').validate({
                    rules: {
                        kartu_bimbingan: {
                            required: true,
                            extension: "pdf",
                        },
                        bukti_spp_tetap: {
                            extension: "pdf",
                        },
                        bukti_spp_variabel: {
                            extension: "pdf",
                        },
                        krs: {
                            extension: "pdf",
                        },
                        setuju: {
                            required: true,
                        },
                    },
                    messages: {
                        kartu_bimbingan: {
                            required: "Wajib Diisi",
                            extension: "File Harus PDF",
                        },
                        bukti_spp_tetap: {
                            extension: "File Harus PDF",
                        },
                        bukti_spp_variabel: {
                            extension: "File Harus PDF",
                        },
                        krs: {
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
            });
        </script>
        <?= $this->endsection(); ?>