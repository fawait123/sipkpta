<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<?php

use App\Models\BimbinganModel;

 if (session()->get('role') == "mahasiswa") : ?>
    <?php if ($count >= 10) : ?>
        <?php if ($search == null) : ?>
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('pendaftaran/submitseminar') ?>" method="POST" enctype="multipart/form-data" id="form-seminar">
                        <input type="hidden" name="npm" value="<?= session()->get('username') ?>">
                        <input type="hidden" name="no_pengajuan" value="<?= $pengajuan->no_pengajuan ?>">
                        <input type="hidden" name="nik" value="<?= $pengajuan->nik ?>">
                        <div class="form-group">
                            <input type="hidden" name="email" id="email" value="<?= $mahasiswa->email ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="no_telp" id="no_telp" value="<?= $mahasiswa->no_telp ?>" class="form-control">
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
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#form-seminar').validate({
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
                            berkas_krs: {
                                required: true,
                                extension: "pdf"
                            },
                            berkas_pembayaran: {
                                required: true,
                                extension: "pdf"
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
                                extension: "File yang diijinkan PDF"
                            },
                            berkas_pembayaran: {
                                required: "Berkas Pembayaran Wajib Diisi",
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
                                <h3 class="timeline-header"><a href="">Detail Pendaftaran Seminar</a></h3>

                                <div class="timeline-body">
                                    <ul class="list-group">
                                        <?php
                                        $krs = explode('/', $search->berkas_krs);
                                        $krs = end($krs);
                                        $pembayaran = explode('/', $search->berkas_pembayaran);
                                        $pembayaran = end($pembayaran);
                                        ?>
                                        <li class="list-group-item">Kode Pendaftaran <b>#<?= $search->kd_pendaftaran ?></b></li>
                                        <li class="list-group-item">Nama : <?= $search->nama_mahasiswa ?></li>
                                        <li class="list-group-item">Jenis : <?= $search->jenis ?></li>
                                        <li class="list-group-item">Berkas KRS : <a href="<?= base_url($search->berkas_krs) ?>" target="blank" class="text-danger"><?= $krs ?>&nbsp;<i class="fa fa-file-pdf"></i></a></li>
                                        <li class="list-group-item">Berkas Pembayaran : <a href="<?= base_url($search->berkas_pembayaran) ?>" target="blank" class="text-danger"> <?= $pembayaran ?>&nbsp;<i class="fa fa-file-pdf"></i></a></li>
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
                                    <span class="time"><i class="fas fa-clock"></i> <?= date('H:i', strtotime($search->tgl)) ?></span>
                                    <h3 class="timeline-header"><a href="">Detail Seminar</a> </h3>
                                    <div class="timeline-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Tempat : <?= $search->tempat ?></li>
                                            <li class="list-group-item">Tanggal Ujian Seminar <span class="badge bg-primary"><?= date('d M Y', strtotime($search->tgl)) ?></span></li>
                                            <li class="list-group-item">Waktu search Seminar <span class="badge bg-primary"><?= date('H:i', strtotime($search->tgl)) ?> WIB</span></li>
                                            <li class="list-group-item">Dosen Penguji : <?= $ujian->nama_dosen ?></li>
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
                                    <th>NPM</th>
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
                                        <td><a href="<?= base_url('seminar/' . $p->no_pengajuan) ?>"><?= $p->npm ?></a></td>
                                        <td><?= $p->nama_mahasiswa ?></td>
                                        <?php if (session()->get('role') != "dosen") : ?>
                                            <td><?= $p->nama_dosen ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <?php 
                                             $bimbingan = new BimbinganModel();
                                             $total = $bimbingan->getBimbingan($p->npm,'KP')->getResult();
                                             $total = count($total);
                                             $note = $bimbingan->getBimbingan($p->npm,'KP','DESC')->getRow();
                                             $note = $note ?  $note->keterangan == null ? 'Tidak ada keterangan':$note->keterangan : 'Tidak ada keterangan';
                                             echo 'jumlah : '.$total.', catatan : '.$note;
                                            ?>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-default btn-sm detail-pendaftaran" data-toggle="modal" data-target="#modal-detail-pendaftaran" data-judul="<?= $p->no_perubahan != '' && $p->status_dosen == 'acc' && $p->status_prodi == 'acc' ? $p->judul_perubahan : $p->judul ?>" data-studi-kasus="<?= $p->studi_kasus ?>" data-judul-pendaftaran="<?= $p->judul_pendaftaran ?>"><i class="fa fa-eye"></i></a>
                                        </td>
                                        <td>
                                            <?php if (session()->get('role') == 'sekprod') : ?>
                                                <?= $p->is_entry == 1 ? '<span class="badge badge-success">selesai</span>' : '<span class="badge badge-danger">belum entry ujian</span>' ?>
                                            <?php else : ?>
                                                <?php if ($p->is_entry == 1) : ?>
                                                    <a href="" class="btn btn-primary btn-sm detail-ujian" data-toggle="modal" data-target="#detail-ujian" data-kd-pendaftaran="<?= $p->kd_pendaftaran ?>" data-npm="<?= $p->npm ?>" data-tgl="<?= $p->tgl ?>" data-tempat="<?= $p->tempat ?>"><i class="fa fa-eye"></i></a>
                                                <?php else : ?>
                                                    <span class="badge bg-danger">belum entry ujian</span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <?php if (session()->get('role') == "dosen") : ?>
                                            <td>
                                                <?php
                                                $judul = $p->no_perubahan != '' && $p->status_dosen == 'acc' && $p->status_prodi == 'acc' ? $p->judul_perubahan : $p->judul;
                                                $judul_pendaftaran = $p->judul_pendaftaran;
                                                if (strtolower($judul) != strtolower($judul_pendaftaran)) {
                                                ?>
                                                    <button type="button" class="btn btn-danger konfirmasi" data-id="<?=$p->kd_pendaftaran?>" data-note="<?=$p->note?>" data-status="<?=$p->status?>" data-toggle="modal" data-target="#modal-konfirmasi">Konfirmasi</button>
                                                <?php
                                                } else {
                                                ?>
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
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        <?php endif; ?>
                                        <?php if (session()->get('role') == "sekprod" || session()->get('role') == "admin") : ?>
                                            <td>
                                                <a href="" class="btn btn-primary btn-sm entry-ujian" data-toggle="modal" data-target="#modal-entry-penguji" data-kd-pendaftaran="<?= $p->kd_pendaftaran ?>" data-npm="<?= $p->npm ?>" data-tgl="<?= $p->tgl ?>" data-tempat="<?= $p->tempat ?>" data-no_pengajuan="<?= $p->no_pengajuan ?>">Entry</a>
                                                <?php if ($p->is_entry == 1) : ?>
                                                    <a href="<?= base_url('downloadcontroller/beritaacara/' . $p->no_pengajuan) ?>" target="blank" class="btn btn-warning btn-sm mt-2"><i class="fa fa-download"></i>&nbsp;berita acara</a>
                                                    <a href="<?= base_url('downloadcontroller/lembarnilai/' . $p->no_pengajuan) ?>" target="blank" class="btn btn-success btn-sm mt-2"><i class="fa fa-download"></i>&nbsp;lembar nilai</a>
                                                    <a href="<?= base_url('downloadcontroller/lembarrevisi/' . $p->no_pengajuan) ?>" target="blank" class="btn btn-danger btn-sm mt-2"><i class="fa fa-download"></i>&nbsp;lembar revisi</a>
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
                                    <th>Nama Mahasiswa</th>
                                    <?php if (session()->get('role') != "dosen") : ?>
                                        <th>Nama Dosen</th>
                                    <?php endif; ?>
                                    <th>Detail Bimbingan</th>
                                    <th>Detail</th>
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
<!-- /.modal -->
<!-- modal detail pendaftaran -->
<div class="modal fade" id="modal-detail-pendaftaran">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
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
<form action="<?= base_url('pendaftaran/entryujiankp') ?>" method="POST" id="form-ujian-kp">
    <div class="modal fade" id="modal-entry-penguji">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Entry Ujian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="entry-jadwal-ujian">
                    <input type="hidden" name="kd_pendaftaran" id="kd_pendaftaran">
                    <input type="hidden" name="npm" id="npmentryujian">
                    <input type="hidden" name="no_pengajuan" id="no_pengajuan">
                    <div class="form-group">
                        <label for="penguji">Dosen Penguji</label>
                        <select name="penguji" id="penguji" class="form-control">
                            <option value="">:: pilih ::</option>
                            <?php foreach ($dosen as $d) : ?>
                                <option value="<?= $d->nik ?>"><?= $d->nama_dosen ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <input type="text" name="tempat" id="tempat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Date and time:</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" name="tgl" id="tglujian" class="form-control datetimepicker-input" data-target="#reservationdatetime" />
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
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
    </div>
</form>
<!-- /.modal -->

<script>
    $(document).ready(function() {
        $('#form-ujian-kp').validate({
            rules: {
                penguji: {
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
                penguji: {
                    required: "Dosen Penguji Wajib Diisi",
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
<!-- modal detail ujian -->
<div class="modal fade" id="detail-ujian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Ujian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tbody">
                <p>One fine body&hellip;</p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $(document).ready(function() {
        $(".detail-ujian").on('click', function() {
            let kode = $(this).data('kd-pendaftaran');
            let tgl = $(this).data('tgl');
            let tempat = $(this).data('tempat');
            $.ajax({
                url: '<?= base_url('pendaftaran/getUjianKp') ?>',
                type: 'post',
                async: false,
                dataType: 'json',
                data: {
                    kd_pendaftaran: kode
                },
                success: function(res) {
                    console.log(res)
                    let body = `
                    <ul class="list-group">
                        <li class="list-group-item">Tannggal : ${tgl}</li>
                        <li class="list-group-item">Tempat : ${tempat}</li>
                        <li class="list-group-item">Nik : ${res.nik}</li>
                        <li class="list-group-item">Dosen Penguji : ${res.nama_dosen}</li>
                    </ul>
                    `;

                    $("#tbody").html(body)
                }
            });
        });
        $(".detail-pendaftaran").on('click', function() {
            let judul = $(this).data('judul');
            let studi = $(this).data('studi-kasus');
            let judul_pendaftaran = $(this).data('judul-pendaftaran');
            let check = '';
            let note = '';
            if (judul.toLowerCase() == judul_pendaftaran.toLowerCase()) {
                check = '<i class="fa fa-check text-primary"></i>';
                note = '<i class="fa fa-check text-primary"></i> Judul Proposal dengan judul yang diajukan sama.';
            } else {
                check = '<i class="fa fa-ban text-danger"></i>';
                note = '<i class="fa fa-ban text-danger"></i> Judul Proposal dengan judul yang diajukan tidak sama.';
            }
            let detail = `
            <ul class="list-group">
                <li class="list-group-item">Judul : ${judul} ${check}</li>
                <li class="list-group-item">Judul Pendaftaran : ${judul_pendaftaran} ${check}</li>
                <li class="list-group-item">Catatan : ${note}</li>
                <li class="list-group-item">Studi Kasus : ${studi}</li>
            </ul>
            `;

            $('#modal-body-pendaftaran').html(detail);
        });

        $(".entry-ujian").on('click', function() {
            let kode = $(this).data('kd-pendaftaran');
            let pengajuan = $(this).data('no_pengajuan');
            let npm = $(this).data('npm');
            let tgl = $(this).data('tgl');
            let tempat = $(this).data('tempat');

            $('#npmentryujian').val(npm)
            $('#no_pengajuan').val(pengajuan)
            $("#kd_pendaftaran").val(kode);
            $.ajax({
                url: "<?= base_url('pendaftaran/getUjianKP') ?>",
                method: 'POST',
                data: {
                    kd_pendaftaran: kode
                },
                async: false,
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    $("#penguji").val(res.nik).change();
                    $("#tglujian").val(tgl);
                    $("#tempat").val(tempat);
                }
            });
        });


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
        toastr.info('<?= session()->getFlashdata('pesan') ?>')
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        toastr.error('<?= session()->getFlashdata('error') ?>')
    </script>
<?php endif; ?>
<?= $this->endsection() ?>