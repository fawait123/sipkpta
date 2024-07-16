<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?php

use App\Models\BimbinganModel;

 if (session()->get('role') == "mahasiswa") : ?>
    <?php if ($count >= 10) : ?>
        <?php if ($search == null) : ?>
            <div class="card">
                <div class="card-body">
                    <!-- <form action="<?= base_url('pendaftaran/submitpendadaran') ?>" method="POST" enctype="multipart/form-data" id="form-pendadaran">
                        <input type="hidden" name="npm" value="<?= session()->get('username') ?>">
                        <input type="hidden" name="no_pengajuan" value="<?= $pengajuan->no_pengajuan ?>">
                        <input type="hidden" name="nik" value="<?= $pengajuan->nik ?>">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?= $mahasiswa->email ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="telp">Nomor Telphone</label>
                            <input type="text" name="no_telp" id="no_telp" value="<?= $mahasiswa->no_telp ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="judul_pendaftaran">Judul Pendaftaran</label>
                            <input type="text" name="judul_pendaftaran" id="judul_pendaftaran" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="berkas_krs">Upload KRS</label>
                            <input type="file" name="berkas_krs" id="berkas_krs" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="berkas_pembayaran">Bukti Pembayaran</label>
                            <input type="file" name="berkas_pembayaran" id="berkas_pembayaran" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="berkas_toefle">Sertifikat Toefle</label>
                            <input type="file" name="berkas_toefle" id="berkas_toefle" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="berkas_rekomendasi">Rekomendasi Ujian</label>
                            <input type="file" name="berkas_rekomendasi" id="berkas_rekomendasi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="berkas_sertifikat">Sertifikat Kompetensi 10 ++</label>
                            <input type="file" name="berkas_sertifikat" id="berkas_sertifikat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="berkas_abstrak">Abstrak Laporan</label>
                            <input type="file" name="berkas_abstrak" id="berkas_abstrak" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="berkas_pustaka">Daftar Pustaka</label>
                            <input type="file" name="berkas_pustaka" id="berkas_pustaka" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ukuran_toga">Ukuran Toga</label>
                            <div class="form-group">
                                <input type="radio" value="S" id="s" name="ukuran_toga"> <label for="s">S</label> 
                            </div>
                            <div class="form-group">
                                <input type="radio" value="M" id="m" name="ukuran_toga"> <label for="m">M</label> 
                            </div>
                            <div class="form-group">
                                <input type="radio" value="L" name="ukuran_toga" id="l"> <label for="l">L</label> 
                            </div>
                            <div class="form-group">
                                <input type="radio" value="XL" name="ukuran_toga" id="xl"> <label for="xl">XL</label> 
                            </div>
                            <div class="form-group">
                                <input type="radio" value="XXL" name="ukuran_toga" id="xxl"> <label for="xxl">XXL</label> 
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="btn-submit">Kirim</button>
                        </div>
                    </form> -->
                    <h1>UNTUK SEMENTARA PENDAFTARAN PENDADARAN SEDANG DI TUTUP, MOHON MENUNGGU INFO SELANJUTNYA DARI ADMIN PRODI</h1>
                    <h1>TERIMA KASIH</h1>
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    $('#form-pendadaran').validate({
                            rules: {
                                email: {
                                    required: true,
                                },
                                no_telp: {
                                    required: true,
                                },
                                judul_pendaftaran: {
                                    required: true,
                                },
                                berkas_krs:{
                                    required:true,
                                    extension: "pdf"
                                },
                                berkas_pembayaran:{
                                    required:true,
                                    extension: "pdf"
                                },
                                berkas_toefle:{
                                    required:true,
                                    extension: "pdf"
                                },
                                berkas_rekomendasi:{
                                    required:true,
                                    extension: "pdf"
                                },
                                berkas_sertifikat:{
                                    required:true,
                                    extension: "pdf"
                                },
                                berkas_abstrak:{
                                    required:true,
                                    extension: "doc|docx"
                                },
                                berkas_pustaka:{
                                    required:true,
                                    extension: "doc|docx"
                                },
                                ukuran_toga:{
                                    required:true,
                                }
                            },
                            messages: {
                                email: {
                                    required: "Email Wajib Diisi",
                                },
                                no_telp: {
                                    required: "Nomor Telephone Wajib Diisi",
                                },
                                judul_pendaftaran: {
                                    required: "Judul Pendaftaran Wajib Diisi",
                                },
                                berkas_krs: {
                                    required: "Berkas KRS Wajib Diisi",
                                    extension:"File yang diijinkan PDF"
                                },
                                berkas_pembayaran: {
                                    required: "Berkas Pembayaran Wajib Diisi",
                                    extension:"File yang diijinkan PDF"
                                },
                                berkas_toefle: {
                                    required: "Berkas Toefle Wajib Diisi",
                                    extension:"File yang diijinkan PDF"
                                },
                                berkas_rekomendasi: {
                                    required: "Berkas Rekomendasi Wajib Diisi",
                                    extension:"File yang diijinkan PDF"
                                },
                                berkas_sertifikat: {
                                    required: "Berkas Sertifikat Wajib Diisi",
                                    extension:"File yang diijinkan PDF"
                                },
                                berkas_abstrak: {
                                    required: "Berkas Abstrak Wajib Diisi",
                                    extension:"File yang diijinkan DOC,DOCX"
                                },
                                berkas_pustaka: {
                                    required: "Berkas Pustaka Wajib Diisi",
                                    extension:"File yang diijinkan DOC,DOCX"
                                },
                                ukuran_toga:{
                                    required:"Ukuran toga wajib di isi"
                                }
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
                    $('#form-pendadaran').on('submit', function(event){
                        event.preventDefault();
                        let postData = new FormData($(this)[0]);
                        postData.append('berkas_krs', $('input[name=berkas_krs]')[0].files[0]);
                        postData.append('berkas_pembayaran', $('input[name=berkas_pembayaran]')[0].files[0]);
                        postData.append('berkas_krs', $('input[name=berkas_krs]')[0].files[0]);
                        postData.append('berkas_pembayaran', $('input[name=berkas_pembayaran]')[0].files[0]);
                        postData.append('berkas_toefle', $('input[name=berkas_toefle]')[0].files[0]);
                        postData.append('berkas_rekomendasi', $('input[name=berkas_rekomendasi]')[0].files[0]);
                        postData.append('berkas_sertifikat', $('input[name=berkas_sertifikat]')[0].files[0]);
                        postData.append('berkas_abstrak', $('input[name=berkas_abstrak]')[0].files[0]);
                        postData.append('berkas_pustaka', $('input[name=berkas_pustaka]')[0].files[0]);
                        $.ajax({
                            url:"<?= base_url('pendaftaran/submitpendadaran') ?>",
                            type:"post",
                            processData: false,
                            contentType: false,
                            data:postData,
                            beforeSend: function() {
                                $("#btn-submit").attr("disabled",true)
                                $("#btn-submit").html("Loading...")
                            },
                            success:function(res){
                                console.log(res)
                                if(res == "success"){
                                    window.location.reload()
                                }else{
                                    toastr.info('Terjadi kesalahan saat mengunggah file');
                                }
                            },
                            error: function(xhr) { // if error occured
                                let err = eval("(" + xhr.responseText + ")");
                                toastr.info(err.message);
                                $("#btn-submit").attr("disabled",false)
                                $("#btn-submit").html("Kirim")
                            },
                            // complete: function() {
                            //     $("#btn-submit").attr("disabled",false)
                            //     $("#btn-submit").html("Kirim")
                            // },
                        })
                        
                    });
                });
            </script>
        <?php else : ?>
            <!-- timeline -->
            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-red"><?= date('d M Y', strtotime($search->tgl)) ?></span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                <h3 class="timeline-header"><a href="">Detail Pendaftaran Pendadaran</a></h3>

                                <div class="timeline-body">
                                    <ul class="list-group">
                                        <?php
                                        $krs = explode('/', $search->berkas_krs);
                                        $krs = end($krs);
                                        $pembayaran = explode('/', $search->berkas_pembayaran);
                                        $pembayaran = end($pembayaran);
                                        $toefle = explode('/',$search->berkas_toefle);
                                        $toefle = end($toefle);
                                        $rekomendasi = explode('/',$search->berkas_rekomendasi);
                                        $rekomendasi = end($rekomendasi);
                                        $sertifikat = explode('/',$search->berkas_sertifikat);
                                        $sertifikat = end($sertifikat);
                                        $abstrak = explode('/',$search->berkas_abstrak);
                                        $abstrak = end($abstrak);
                                        $pustaka = explode('/',$search->berkas_pustaka);
                                        $pustaka = end($pustaka);
                                        ?>
                                        <li class="list-group-item">Kode Pendaftaran <b>#<?= $search->kd_pendaftaran ?></b></li>
                                        <li class="list-group-item">Nama : <?= $search->nama_mahasiswa ?></li>
                                        <li class="list-group-item">Jenis : <?= $search->jenis ?></li>
                                        <li class="list-group-item">Berkas KRS : <a href="<?= base_url($search->berkas_krs) ?>" target="blank" class="text-danger"><?= $krs ?>&nbsp;<i class="fa fa-file-pdf"></i></a></li>
                                        <li class="list-group-item">Berkas Pembayaran : <a href="<?= base_url($search->berkas_pembayaran) ?>" target="blank" class="text-danger"> <?= $pembayaran ?>&nbsp;<i class="fa fa-file-pdf"></i></a></li>
                                        <li class="list-group-item">Berkas Toefle : <a href="<?= base_url($search->berkas_toefle) ?>" target="blank" class="text-danger"><?= $toefle ?> &nbsp;<i class="fa fa-file-pdf"></i></a></li>
                                        <li class="list-group-item">Berkas Rekomendasi : <a href="<?= base_url($search->berkas_rekomendasi) ?>" target="blank" class="text-danger"><?= $rekomendasi ?> &nbsp;<i class="fa fa-file-pdf"></i></a></li>
                                        <li class="list-group-item">Berkas Sertifikat : <a href="<?= base_url($search->berkas_sertifikat) ?>" target="blank" class="text-danger"><?= $sertifikat ?> &nbsp;<i class="fa fa-file-pdf"></i></a></li>
                                        <li class="list-group-item">Berkas Abstrak : <a href="<?= base_url($search->berkas_abstrak) ?>" target="blank" class="text-danger"><?= $abstrak ?> &nbsp;<i class="fa fa-file-pdf"></i></a></li>
                                        <li class="list-group-item">Berkas Pustaka : <a href="<?= base_url($search->berkas_pustaka) ?>" target="blank" class="text-danger"><?= $pustaka ?> &nbsp;<i class="fa fa-file-pdf"></i></a></li>
                                        <li class="list-group-item">Ukuran Toga : <a target="blank" class="text-danger"> <?= $search->ukuran_toga ?>&nbsp;</li>
                                        <li class="list-group-item">Dosen Pembimbing : <?= $search->nama_dosen ?></li>
                                        <li class="list-group-item">Status : <?= $search->status == "acc" ? '<span class="badge bg-primary">ACC</span>' : '<span class="badge bg-danger">Belum ACC</span>' ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <?php if ($search->is_entry == 1) : ?>
                            <div>
                                <i class="fa fa-list bg-yellow"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="">Detail Seminar</a> </h3>
                                    <div class="timeline-body">
                                    <ul class="list-group mb-3">
                                    <li class="list-group-item">Tempat : <?= $search->tempat?></li>
                                        <li class="list-group-item">Tanggal : <?= date('d M Y',strtotime($search->tgl)) ?> </li>
                                        <li class="list-group-item">Waktu : <?= date('H:i',strtotime($search->tgl)) ?> WIB</li>
                                        <li class="list-group-item">Judul : <?= $search->no_perubahan != '' && $search->status_dosen=='acc' && $search->status_prodi=='acc'?$search->judul_perubahan : $search->judul ?> </li>
                                        <li class="list-group-item">Judul Pendaftaran : <?= $search->judul_pendaftaran ?> </li>
                                    </ul>
                                        <ul class="list-group">
                                            <div class="row">
                                                <?php foreach ($ujian as $u) : ?>
                                                    <div class="col-md-4">
                                                        <li class="list-group-item">Title : <?= $u->title ?> </li>
                                                        <li class="list-group-item">Nik : <?= $u->nik ?> </li>
                                                        <li class="list-group-item">Nama : <?= $u->nama_dosen ?> </li>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
                        <?php else : ?>
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Info</h5>
                                <br>
                                Catatan :
                                <ul>
                                    <li>Pendaftaran Sudah Dikirim untuk kemudian di acc oleh dosen pembimbing</li>
                                    <li>Tanggal Ujian Seminar akan Muncul ketika KAPRODI sudah menginputkan Tanggal dan waktu ujian</li>
                                    <li>Penguji Seminar akan Muncul ketika KAPRODI sudah menginputkan Dosen Penguji</li>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            </div>
            <!-- /.timeline -->
            <!-- endtimeline -->
        <?php endif ?>
    <?php else : ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <br>
            Catatan :
            <ul>
                <li>Pendaftaran seminar hanya bisa dilakukan ketika anda sudah menyelesaikan KP (Kerja Praktik)</li>
                <li>Pendaftaran seminar hanya bisa dilakukan ketika anda sudah melakukan bimbingan minimal 10 kali</li>
                <li>Status Bimbingan sudah ACC oleh Dosen Pembimbing</li>
            </ul>
        </div>
    <?php endif; ?>
<?php else : ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <?php if (session()->get('role') != "dosen") : ?>
                                        <th>Nama Dosen</th>
                                    <?php endif; ?>
                                    <th>Detail Bimbingan</th>
                                    <th>Detail Judul</th>
                                    <th>Detail Ujian</th>
                                    <?php if (session()->get('role') == "dosen") : ?>
                                        <th>Status ACC</th>
                                    <?php endif; ?>
                                    <?php if (session()->get('role') == "sekprod" || session()->get('role') == "admin") : ?>
                                        <th>Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($pendaftaran as $p) : ?>
                                    <?php
                                    $krs = explode('/', $p->berkas_krs);
                                    $krs = end($krs);
                                    $pembayaran = explode('/', $p->berkas_pembayaran);
                                    $pembayaran = end($pembayaran);
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><a href="<?=base_url('pendaftaran/show/'.$p->no_pengajuan)?>"><?= $p->nama_mahasiswa ?></a></td>
                                        <?php if (session()->get('role') != "dosen") : ?>
                                            <td><?= $p->nama_dosen ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <?php 
                                             $bimbingan = new BimbinganModel();
                                             $total = $bimbingan->getBimbingan($p->npm,'TA')->getResult();
                                             $total = count($total);
                                             $note = $bimbingan->getBimbingan($p->npm,'TA','DESC')->getRow();
                                             $note = $note ? $note->keterangan == null ? 'Tidak ada keterangan':$note->keterangan : 'Tidak ada keterangan';
                                             echo 'jumlah : '.$total.', catatan : '.$note;
                                            ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-sm detail-pendaftaran" data-toggle="modal" data-target="#modal-detail-pendaftaran" data-judul="<?= $p->no_perubahan != '' && $p->status_dosen == 'acc' && $p->status_prodi == 'acc' ? $p->judul_perubahan : $p->judul ?>" data-judul-pendaftaran="<?= $p->judul_pendaftaran ?>" data-studi-kasus="<?= $p->studi_kasus ?>"><i class="fa fa-eye"></i></button>
                                        </td>
                                        <td>
                                            <?= $p->is_entry == 1 ? '<span class="badge badge-success">Selesai</span>' : '<span class="badge badge-danger">belum entry ujian</span>' ?>
                                        </td>
                                        <?php if (session()->get('role') == "dosen") : ?>
                                            <td>
                                            <?php
                                                $judul = $p->no_perubahan != '' && $p->status_dosen == 'acc' && $p->status_prodi == 'acc' ? $p->judul_perubahan : $p->judul;
                                                $judul_pendaftaran = $p->judul_pendaftaran;
                                                $judul = explode(' ',$judul);
                                                $judul = join('',$judul);
                                                $judul_pendaftaran = $p->judul_pendaftaran;
                                                $judul_pendaftaran = explode(' ',$judul_pendaftaran);
                                                $judul_pendaftaran = join('',$judul_pendaftaran);
                                                if (trim(strtolower($judul)) != trim(strtolower($judul_pendaftaran))) {
                                                ?>
                                                <?php if($p->status == 'acc'): ?>
                                                        <form action="<?= base_url('pendaftaran/status') ?>" method="post">
                                                        <input type="hidden" name="npm" value="<?= $p->npm ?>">
                                                        <input type="hidden" name="kd_pendaftaran" value="<?= $p->kd_pendaftaran ?>">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio" id="acc<?= $no ?>" name="status" value="acc" <?= $p->status == "acc" ? 'checked' : '' ?>>
                                                            <label for="acc<?= $no ?>" class="custom-control-label">ACC</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio" id="tidak-acc<?= $no ?>" name="status" value="tidak acc" <?= $p->status == "tidak acc" ? 'checked' : '' ?>>
                                                            <label for="tidak-acc<?= $no ?>" class="custom-control-label">Tidak ACC</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-edit"></i></button>
                                                        </div>
                                                    </form>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-danger konfirmasi" data-id="<?=$p->kd_pendaftaran?>" data-note="<?=$p->note?>" data-status="<?=$p->status?>" data-toggle="modal" data-target="#modal-konfirmasi">Konfirmasi</button>
                                                    <?php endif; ?>
                                                <?php
                                                } else {
                                                    ?>
                                                <form action="<?= base_url('pendaftaran/status') ?>" method="post">
                                                    <input type="hidden" name="jenis" value="TA">
                                                    <input type="hidden" name="npm" value="<?= $p->npm ?>">
                                                    <input type="hidden" name="kd_pendaftaran" value="<?= $p->kd_pendaftaran ?>">
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="acc<?= $no ?>" name="status" value="acc" <?= $p->status == "acc" ? 'checked' : '' ?>>
                                                        <label for="acc<?= $no ?>" class="custom-control-label">ACC</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input" type="radio" id="tidak-acc<?= $no ?>" name="status" value="tidak acc" <?= $p->status == "tidak acc" ? 'checked' : '' ?>>
                                                        <label for="tidak-acc<?= $no ?>" class="custom-control-label">Tidak ACC</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-edit"></i></button>
                                                    </div>
                                                </form>
                                               <?php } ?>
                                            </td>
                                        <?php endif; ?>
                                        <?php if (session()->get('role') == "sekprod" || session()->get('role') == "admin") : ?>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm entry-ujian" data-toggle="modal" data-target="#modal-entry-penguji" data-kd-pendaftaran="<?= $p->kd_pendaftaran ?>" data-tgl="<?= $p->tgl ?>" data-tempat="<?= $p->tempat ?>" data-npm="<?= $p->npm ?>"  data-nik="<?= $p->nik ?>">Entry</button>
                                                <?php if($p->is_entry==1): ?>
                                                    <a href="<?= base_url('downloadcontroller/beritaacara/'.$p->no_pengajuan) ?>" target="blank" class="btn btn-warning btn-sm mt-2"><i class="fa fa-download"></i>&nbsp;berita acara</a>
                                                    <a href="<?= base_url('downloadcontroller/lembarnilaita/'.$p->no_pengajuan) ?>" target="blank" class="btn btn-success btn-sm mt-2"><i class="fa fa-download"></i>&nbsp;lembar nilai</a>
                                                    <a href="<?= base_url('downloadcontroller/lembarrevisita/'.$p->no_pengajuan) ?>" target="blank" class="btn btn-danger btn-sm mt-2"><i class="fa fa-download"></i>&nbsp;lembar revisi</a>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <?php if (session()->get('role') != "dosen") : ?>
                                        <th>Nama Dosen</th>
                                    <?php endif; ?>
                                    <th>Detail Bimbingan</th>
                                    <th>Detail Judul</th>
                                    <th>Detail Ujian</th>
                                    <?php if (session()->get('role') == "dosen") : ?>
                                        <th>
                                            Status ACC
                                        </th>
                                    <?php endif; ?>
                                    <?php if (session()->get('role') == "sekprod" || session()->get('role') == "admin") : ?>
                                        <th>Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- modal konfirmasi -->
<div class="modal fade" id="modal-konfirmasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi Pendaftaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <form action="<?= base_url('seminar/konfirmasi') ?>" id="form-konfirmasi" method="post">
                <input type="hidden" id="id-konfirmasi" name="kd_pendaftaran">
                <input type="hidden" name="jenis" value="TA">
                    <div class="form-group">
                        <label for="status">status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">:: pilih ::</option>
                            <option value="acc">ACC</option>
                            <option value="tidak acc">Tidak Acc</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-submit" disabled>kirim</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- modal detail pendaftaran -->
<div class="modal fade" id="modal-detail-pendaftaran">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pendaftaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body-pendaftaran">
                <p>One fine body&hellip;</p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- modal entry penguji -->
<div class="modal fade" id="modal-entry-penguji">
    <form action="<?= base_url('pendaftaran/entryujian') ?>" method="POST" id="form-ujian-ta">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Entry Ujian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="entry-jadwal-ujian">
                    <input type="hidden" name="jenis" value="TA">
                    <input type="text" name="kd_pendaftaran" id="kd_pendaftaran" readonly class="form-control">
                    <input type="hidden" name="npm" id="npmentryujian">
                    <div class="form-group">
                        <label>Date and time:</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" name="tgl" id="tgl" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <input type="text" name="tempat" id="tempat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ketua_penguji">Ketua Penguji</label>
                        <select name="ketua_penguji" id="ketua_penguji" class="form-control">
                            <option value="">:: pilih ::</option>
                            <?php foreach ($dosen as $d) : ?>
                                <option value="<?= $d->nik ?>"><?= $d->nama_dosen ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penguji_1">Penguji 1</label>
                        <select name="penguji_1" id="penguji_1" class="form-control">
                            <option value="">:: pilih ::</option>
                            <?php foreach ($dosen as $d) : ?>
                                <option value="<?= $d->nik ?>"><?= $d->nama_dosen ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penguji_2">Penguji 2</label>
                        <select name="penguji_2" id="penguji_2" class="form-control">
                            <option value="">:: pilih ::</option>
                            <?php foreach ($dosen as $d) : ?>
                                <option value="<?= $d->nik ?>"><?= $d->nama_dosen ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-row">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->
<script>
                $(document).ready(function(){
                    $('#form-ujian-ta').validate({
                            rules: {
                                ketua_penguji: {
                                    required: true,
                                },
                                penguji_1: {
                                    required: true,
                                },
                                penguji_2: {
                                    required: true,
                                },
                                tempat: {
                                    required: true,
                                },
                                tgl: {
                                    required: true,
                                },
                            },
                            messages: {
                                ketua_penguji: {
                                    required: "Ketua Penguji Wajib Diisi",
                                },
                                penguji_1: {
                                    required: "Penguji 1 Wajib Diisi",
                                },
                                penguji_2: {
                                    required: "Penguji 2 Wajib Diisi",
                                },
                                tempat: {
                                    required: "Tempat Wajib Diisi",
                                },
                                tgl: {
                                    required: "Tanggal Wajib Diisi",
                                }
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
<script>
    $(document).ready(function() {
        // $(".detail-pendaftaran").on('click', function() {
        //     let judul = $(this).data('judul');
        //     let studi = $(this).data('studi-kasus');
        //     let judul_pendaftaran = $(this).data('judul-pendaftaran')

        //     let detail = `
        //     <ul class="list-group">
        //         <li class="list-group-item">Judul Pendaftaran : ${judul_pendaftaran}</li>
        //         <li class="list-group-item">Judul : ${judul}</li>
        //         <li class="list-group-item">Studi Kasus : ${studi}</li>
        //     </ul>
        //     `;

        //     $('#modal-body-pendaftaran').html(detail);
        // });

        $('#modal-detail-pendaftaran').on('show.bs.modal', function (event) {
            var target = $(event.relatedTarget)
            let judul = $(target).data('judul');
            let judul_ori = $(target).data('judul');
            let studi = $(target).data('studi-kasus');
            let judul_pendaftaran = $(target).data('judul-pendaftaran');
            let judul_pendaftaran_ori = $(target).data('judul-pendaftaran');
            let check = '';
            let note = '';
            judul = judul.split(' ')
            judul = judul.join('').toLowerCase();
            judul_pendaftaran = judul_pendaftaran.split(' ')
            judul_pendaftaran = judul_pendaftaran.join('').toLowerCase();
            if (judul.includes(judul_pendaftaran)) {
                check = '<i class="fa fa-check text-primary"></i>';
                note = '<i class="fa fa-check text-primary"></i> Judul Proposal dengan judul yang diajukan sama.';
            } else {
                check = '<i class="fa fa-ban text-danger"></i>';
                note = '<i class="fa fa-ban text-danger"></i> Judul Proposal dengan judul yang diajukan tidak sama.';
            }
            let detail = `
            <ul class="list-group">
                <li class="list-group-item">Judul : ${judul_ori} ${check}</li>
                <li class="list-group-item">Judul Pendaftaran : ${judul_pendaftaran_ori} ${check}</li>
                <li class="list-group-item">Catatan : ${note}</li>
                <li class="list-group-item">Studi Kasus : ${studi}</li>
            </ul>
            `;

            $('#modal-body-pendaftaran').html(detail);
        })

        // $(".entry-ujian").on('click', function() {
        //     let kode = $(this).data('kd-pendaftaran');
        //     let npm = $(this).data('npm');
        //     let tgl = $(this).data('tgl');
        //     let tempat = $(this).data('tempat');

        //     $("#kd_pendaftaran").val(kode);
        //     $('#npmentryujian').val(npm)
        //     $("#tgl").val(tgl);
        //     $("#tempat").val(tempat);
        //     console.log('tempat',tempat)


        //     $.ajax({
        //         url: "<?= base_url('pendaftaran/getUjian') ?>",
        //         method: 'POST',
        //         data: {
        //             kd_pendaftaran: kode
        //         },
        //         async: false,
        //         dataType: 'json',
        //         success: function(res) {
        //             console.log(res)
        //             res.forEach(function(data) {
        //                 if (data.title == 'Ketua Penguji') {
        //                     if (data.nik == '') {
        //                         $("#ketua_penguji").val('').change();
        //                     } else {
        //                         $("#ketua_penguji").val(data.nik).change();
        //                     }
        //                 } else if (data.title == 'Penguji 1') {
        //                     if (data.nik == '') {
        //                         $("#penguji_1").val('').change();
        //                     } else {
        //                         $("#penguji_1").val(data.nik).change();
        //                     }
        //                 } else {
        //                     if (data.nik == '') {
        //                         $("#penguji_2").val('').change();
        //                     } else {
        //                         $("#penguji_2").val(data.nik).change();
        //                     }
        //                 }
        //             });
        //         }
        //     });
        // });

        $('#modal-entry-penguji').on('show.bs.modal', function (e) {
            let target = e.relatedTarget // do something...
            let kode = $(target).data('kd-pendaftaran');
            let npm = $(target).data('npm');
            let nik = $(target).data('nik');
            let tgl = $(target).data('tgl');
            let tempat = $(target).data('tempat');
            $("#kd_pendaftaran").val(kode);
            $('#npmentryujian').val(npm)
            $("#tgl").val(tgl);
            $("#tempat").val(tempat);


            $.ajax({
                url: "<?= base_url('pendaftaran/getUjian') ?>",
                method: 'POST',
                data: {
                    kd_pendaftaran: kode
                },
                async: false,
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    if(res.length > 0){
                        res.forEach(function(data) {
                            if (data.title == 'Ketua Penguji') {
                                if (data.nik == '') {
                                    $("#ketua_penguji").val('').change();
                                } else {
                                    $("#ketua_penguji").val(data.nik).change();
                                }
                            } else if (data.title == 'Penguji 1') {
                                if (data.nik == '') {
                                    $("#penguji_1").val('').change();
                                } else {
                                    $("#penguji_1").val(data.nik).change();
                                }
                            } else {
                                if (data.nik == '') {
                                    $("#penguji_2").val(nik).change();
                                } else {
                                    $("#penguji_2").val(data.nik).change();
                                }
                            }
                        });
                    }else{
                        $("#ketua_penguji").val('').change();
                        $("#penguji_1").val('').change();
                        $("#penguji_2").val(nik).change();
                    }
                }
            });
        })


        //Date and time picker
        $('#reservationdatetime').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss',
        });
        //Date range picker with time picker
        // $('#reservationdatetime').daterangepicker({
        //     timePicker: true,
        //     timePickerIncrement: 30,
        //     locale: {
        //         format: 'YYYY-MM-DD hh:mm A'
        //     }
        // })

        var table = $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        const params = new URLSearchParams(window.location.search);
        let search = params.get('search');
        let id = params.get('id');
        console.log(search)
        if (search != null && id != null) {
            table.search(search).draw();
            $.ajax({
                url: "<?= base_url('notifcontroller/update') ?>",
                method: 'POST',
                data: {
                    id: id
                },
                success: function(res) {
                    console.log(res)
                }
            });
        }

           // disabled
           $("#status").on('change',function(){
            if($(this).val()==''){
                $("#btn-submit").attr('disabled',true);
            }else{
                if($("#note").val()==''){
                    $("#btn-submit").attr('disabled',true);
                }else{
                    $("#btn-submit").attr('disabled',false);
                }
            }
        });

        $("#note").on('keyup',function(){
            if($(this).val()==''){
                $("#btn-submit").attr('disabled',true);
            }else{
                $("#btn-submit").attr('disabled',false);
            }
        });
        // ambil kode pendaftaran 
        $(".konfirmasi").on('click',function(){
            let kd = $(this).data('id');
            let status = $(this).data('status');
            let note = $(this).data('note');
            $("#id-konfirmasi").val(kd)
            $("#status").val(status).change();
            $("#note").val(note);
        });
    });
</script>
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        $(document).ready(function(){
            toastr.info('<?=session()->getFlashdata('pesan')?>')
        })
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        $(document).ready(function(){
            toastr.error('<?=session()->getFlashdata('error')?>')
        })
    </script>
<?php endif; ?>
<?= $this->endsection() ?>