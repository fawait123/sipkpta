<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
date_default_timezone_set('Asia/Jakarta');
use App\Libraries\DriveApi;
use App\Helpers\Utils;
?>
<?php if($check && $check->tempat != null): ?>
<?php
            $penutupan = Utils::addDate($check->tgl,51);
            $sekarang = new DateTime(date('Y-m-d H:i:s'));
            $penutupan = new DateTime($penutupan);   
        ?>

<?php if($penutupan >= $sekarang  && $sekarang <= $penutupan): ?>
<?php if($row): ?>
<div class="alert alert-primary" role="alert">
    <ul>
        <li>Terimakasih anda sudah melengkapi data pasca pendadaran tugas akhir</li>
        <li>Pendaftaran pasca pendadaran tugas akhir ditutup pada <?=Utils::addDate($check->tgl,51)?></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- The time line -->
        <div class="timeline">
            <!-- timeline time label -->
            <div class="time-label">
                <span class="bg-red"><?= $row->Waktu_Submit ?></span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-file bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?= date('H:i') ?></span>
                    <h3 class="timeline-header">Data Berkas</h3>
                    <div class="timeline-body">
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Abstrak</li>
                                    <li class="list-group-item">Daftar Pustaka</li>
                                    <li class="list-group-item">Laporan TA</li>
                                    <li class="list-group-item">Lembar Pengesahan</li>
                                    <li class="list-group-item">Naskah Publikasi</li>
                                    <li class="list-group-item">Program</li>
                                    <li class="list-group-item">Database</li>
                                    <li class="list-group-item">Infografis Editable</li>
                                    <li class="list-group-item">Infografis Non Editable</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Abstrak)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp; Abstrak</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Daftar_Pustaka)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Naskah</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Laporan_TA)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Database</a></li>
                                    <li class="list-group-item"><a
                                            href="<?=DriveApi::getFile($row->Lembar_Pengesahan)?>" target="blank"><i
                                                class="fa fa-file"></i>&nbsp;&nbsp;Infografis Editable</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Naskah_Publikasi)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Infografis Non
                                            Editable</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Program)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Program</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Database)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Program</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Infografis_e)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Program</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Infografis_n_e)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Program</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END timeline item -->

            <!-- timeline item -->
            <div>
                <i class="fas fa-clock bg-info"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?= date('H:i') ?></span>
                    <h3 class="timeline-header">Keterangan Berkas</h3>
                    <div class="timeline-body">
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Status Kelengkapan Data</li>
                                    <li class="list-group-item">Catatan</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item"><b><?= $row->Status_Kel_Data ?></b></li>
                                    <li class="list-group-item">
                                        <b><?= $row->Catatan == '' || $row->Catatan == null ? '-' : $row->Catatan ?></b>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Status Pengumpulan CD</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item"><b><?= $row->Status_CD ?></b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END timeline item -->
        </div>
    </div>
    <!-- /.col -->
</div>
</div>
<?php else: ?>
<div class="card">
    <div class="card-body">
        <form action="<?=base_url('pasca/kerjapraktik')?>" method="POST" enctype="multipart/form-data" id="form-store">
            <div class="form-group">
                <label for="">Judul Kerja Praktik</label>
                <input type="text"
                    value="<?=$pengajuan->no_perubahan && $pengajuan->status_dosen == 'acc' && $pengajuan->status_prodi == 'acc' ? $pengajuan->judul_perubahan : $pengajuan->judul ?>"
                    name="judul" class="form-control" placeholder="Abstrak" readonly />
            </div>
            <div class="form-group">
                <label for="Abstrak">Abstrak</label>
                <input type="file" name="abstrak" class="form-control" placeholder="Abstrak" />
            </div>
            <div class="form-group">
                <label for="Daftar Pustaka">Daftar Pustaka</label>
                <input type="file" class="form-control" name="daftar_pustaka" placeholder="Daftar Pustaka" />
            </div>
            <div class="form-group">
                <label for="Laporan Ta">Laporan Ta</label>
                <input type="file" class="form-control" name="laporan_ta" placeholder="Laporan Ta" />
            </div>
            <div class="form-group">
                <label for="Lembar Pengesahan">Lembar Pengesahan</label>
                <input type="file" class="form-control" name="lembar_pengesahan" placeholder="Lembar Pengesahan" />
            </div>
            <div class="form-group">
                <label for="Naskah Publikasi">Naskah Publikasi</label>
                <input type="file" class="form-control" name="naskah_publikasi" placeholder="Naskah Publikasi" />
            </div>
            <div class="form-group">
                <label for="Program">Program</label>
                <input type="file" class="form-control" name="program" placeholder="Program" />
            </div>
            <div class="form-group">
                <label for="Database">Database</label>
                <input type="file" class="form-control" name="database" placeholder="Database" />
            </div>
            <div class="form-group">
                <label for="Inforgrafis Editable">Inforgrafis Editable</label>
                <input type="file" class="form-control" name="infografis_e" placeholder="Inforgrafis Editable" />
            </div>
            <div class="form-group">
                <label for="Infografis Non Editable">Infografis Non Editable</label>
                <input type="file" class="form-control" name="infografis_n_e" placeholder="Infografis Non Editable" />
                <!-- <span class="text-secondary">*Tidak Wajib</span> -->
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $("#form-store").validate({
        rules: {
            abstrak: {
                required: true,
                extension: "pdf"
            },
            daftar_pustaka: {
                required: true,
                extension: "pdf"
            },
            laporan_ta: {
                required: true,
                extension: "pdf"
            },
            lembar_pengesahan: {
                required: true,
                extension: "pdf"
            },
            naskah_publikasi: {
                required: true,
                extension: "pdf"
            },
            program: {
                required: true,
                extension: "zip|rar"
            },
            database: {
                required: true,
                extension: "sql"
            },
            infografis_e: {
                required: true,
                extension: "doc|docx"
            },
            infografis_n_e: {
                required: true,
                extension: "pdf"
            }
        },
        messages: {
            abstrak: {
                required: "Inputan Abstrak tidak boleh kosong"
            },
            daftar_pustaka: {
                required: "Inputan Daftar Pustaka tidak boleh kosong"
            },
            laporan_ta: {
                required: "Inputan Database tidak boleh kosong",
                extension: "File Laporan TA extensi PDF"
            },
            lembar_pengesahan: {
                required: "Inputan Lembar Pengesahan tidak boleh kosong",
                extension: "File Bukti Bimbingan JPG|JPEG|PNG"
            },
            naskah_publikasi: {
                required: 'Inputan Naskah Publikasi tidak boleh kosong'
            },
            program: {
                required: 'Inputan Program tidak boleh kosong'
            },
            database: {
                required: 'Inputan Database tidak boleh kosong'
            },
            infografis_e: {
                required: 'Inputan Infografis Editable tidak boleh kosong'
            },
            infografis_n_e: {
                required: 'Inputan Infografis Non Editable tidak boleh kosong'
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            let formData = new FormData($(form)[0]);
            formData.append('abstrak', $("input[name='abstrak']")[0].files[0])
            formData.append('daftar_pustaka', $("input[name='daftar_pustaka']")[0].files[0])
            formData.append('laporan_ta', $("input[name='laporan_ta']")[0].files[0])
            formData.append('lembar_pengesahan', $("input[name='lembar_pengesahan']")[0].files[0])
            formData.append('naskah_publikasi', $("input[name='naskah_publikasi']")[0].files[0])
            formData.append('program', $("input[name='program']")[0].files[0])
            formData.append('database', $("input[name='database']")[0].files[0])
            formData.append('infografis_e', $("input[name='infografis_e']")[0].files[0])
            formData.append('infografis_n_e', $("input[name='infografis_n_e']")[0].files[0])
            console.log(formData)

            $.ajax({
                url: "<?= base_url('pasca/tugasakhir') ?>",
                type: "post",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function () {
                    $("button[type='submit']").attr("disabled", true)
                    $("button[type='submit']").html("Loading...")
                },
                success: function (res) {
                    if (res === "success" || res === 'warning') {
                        window.location.href = "<?= base_url('pasca/tugasakhir') ?>"
                    } else {
                        toastr.info('Terjadi kesalahan saat mengunggah file');
                    }
                },
                error: function (xhr) { // if error occured
                    let err = eval("(" + xhr.responseText + ")");
                    toastr.info(err.message);
                    $("button[type='submit']").attr("disabled", false)
                    $("button[type='submit']").html("Kirim")
                },
            })
        }
    });
</script>
<?php endif; ?>
<?php else: ?>
<?php if($row): ?>
<div class="alert alert-primary" role="alert">
    <ul>
        <li>Terimakasih anda sudah melengkapi data pasca pendadaran tugas akhir</li>
        <li>Pendaftaran pasca pendadaran tugas akhir ditutup pada <?=Utils::addDate($check->tgl,51)?></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- The time line -->
        <div class="timeline">
            <!-- timeline time label -->
            <div class="time-label">
                <span class="bg-red"><?= $row->Waktu_Submit ?></span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
                <i class="fas fa-file bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?= date('H:i') ?></span>
                    <h3 class="timeline-header">Data Berkas</h3>
                    <div class="timeline-body">
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Abstrak</li>
                                    <li class="list-group-item">Daftar Pustaka</li>
                                    <li class="list-group-item">Laporan TA</li>
                                    <li class="list-group-item">Lembar Pengesahan</li>
                                    <li class="list-group-item">Naskah Publikasi</li>
                                    <li class="list-group-item">Program</li>
                                    <li class="list-group-item">Database</li>
                                    <li class="list-group-item">Infografis Editable</li>
                                    <li class="list-group-item">Infografis Non Editable</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Abstrak)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp; Abstrak</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Daftar_Pustaka)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Naskah</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Laporan_TA)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Database</a></li>
                                    <li class="list-group-item"><a
                                            href="<?=DriveApi::getFile($row->Lembar_Pengesahan)?>" target="blank"><i
                                                class="fa fa-file"></i>&nbsp;&nbsp;Infografis Editable</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Naskah_Publikasi)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Infografis Non
                                            Editable</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Program)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Program</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Database)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Program</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Infografis_e)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Program</a></li>
                                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Infografis_n_e)?>"
                                            target="blank"><i class="fa fa-file"></i>&nbsp;&nbsp;Program</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END timeline item -->

            <!-- timeline item -->
            <div>
                <i class="fas fa-clock bg-info"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?= date('H:i') ?></span>
                    <h3 class="timeline-header">Keterangan Berkas</h3>
                    <div class="timeline-body">
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Status Kelengkapan Data</li>
                                    <li class="list-group-item">Catatan</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item"><b><?= $row->Status_Kel_Data ?></b></li>
                                    <li class="list-group-item">
                                        <b><?= $row->Catatan == '' || $row->Catatan == null ? '-' : $row->Catatan ?></b>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Status Pengumpulan CD</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-group">
                                    <li class="list-group-item"><b><?= $row->Status_CD ?></b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END timeline item -->
        </div>
    </div>
    <!-- /.col -->
</div>
</div>
<?php else: ?>
<div class="alert alert-primary" role="alert">
    <ul>
        <li>Pendaftaran pasca pendadaran tugas akhir sudah di tutup</li>
        <li>Pendaftaran Berakhir Pada tanggal <?= Utils::addDate($check->tgl,51) ?></li>
    </ul>
</div>
<?php endif; ?>
<?php endif; ?>
<?php else : ?>
<div class="card">
    <div class="card-body">
        <div class="alert alert-primary" role="alert">
            <ul>
                <li>Anda tidak punya akses halaman pasca pendadaran tugas akhir</li>
                <li>pastikan anda sudah terdaftar pendadaran tugas akhir</li>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('pesan')) : ?>
<script>
    $(document).ready(function () {
        toastr.info('<?= session()->getFlashdata('
            pesan ') ?>')
    })
</script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
<script>
    $(document).ready(function () {
        toastr.error('<?= session()->getFlashdata('
            error ') ?>')
    })
</script>
<?php endif; ?>
<?= $this->endsection(); ?>