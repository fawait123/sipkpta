<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php

use App\Libraries\DriveApi;

if (session()->get('role') == "mahasiswa") : ?>
    <?php if ($cek != null) : ?>
        <?php if ($cek->status_perpanjang == "Perpanjang") : ?>
            <?php if ($dosbing != null && $cek->batas_bimbingan_perpanjang >= date('Y-m-d')) : ?>
                <a href="<?= base_url('bimbingan/formta') ?>" class="btn btn-primary btn-sm mb-3">Tambah Bimbingan</a>
            <?php else : ?>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info</h5>
                    Pastikan Anda sudah terdaftar di TA (Tugas Akhir).</br>
                    Catatan
                    <ul>
                        <li>Pastikan anda sudah Terdaftar pada matakuliah TA (Tugas Akhir).</li>
                        <li>Bimbingan hanya bisa dilakukan hanya ketika TA anda sudah di disposisi oleh KAPRODI.</li>
                        <li>Periode Bimbingan sampai dengan tanggal <?= date('d M Y', strtotime($cek->batas_bimbingan)) ?></li>
                    </ul>
                </div>
            <?php endif; ?>
        <?php elseif ($cek->status_perpanjang == "Baru") : ?>
            <?php if ($dosbing != null && $cek->batas_bimbingan >= date('Y-m-d')) : ?>
                <a href="<?= base_url('bimbingan/formta') ?>" class="btn btn-primary btn-sm mb-3">Tambah Bimbingan</a>
            <?php else : ?>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Info</h5>
                    Pastikan Anda sudah terdaftar di TA (Tugas Akhir).</br>
                    Catatan
                    <ul>
                        <li>Pastikan anda sudah Terdaftar pada matakuliah TA (Tugas Akhir).</li>
                        <li>Bimbingan hanya bisa dilakukan hanya ketika TA anda sudah di disposisi oleh KAPRODI.</li>
                        <li>Periode Bimbingan sampai dengan tanggal <?= date('d M Y', strtotime($cek->batas_bimbingan)) ?></li>
                    </ul>
                </div>
            <?php endif; ?>
        <?php elseif ($cek->status_perpanjang == "Selesai") : ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Info</h5>
                Anda Sudah Menyelesaikan Tugas Akhir.</br>
                Catatan
                <ul>
                    <li>Pastikan anda sudah Terdaftar pada matakuliah TA (Tugas Akhir).</li>
                    <li>Bimbingan hanya bisa dilakukan hanya ketika TA anda sudah di disposisi oleh KAPRODI.</li>
                    <li>Periode Bimbingan sampai dengan tanggal <?= date('d M Y', strtotime($cek->batas_bimbingan)) ?></li>
                </ul>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            Pastikan Anda sudah terdaftar di TA (Tugas Akhir).</br>
            Catatan
            <ul>
                <li>Pastikan anda sudah Terdaftar pada matakuliah TA (Tugas Akhir).</li>
                <li>Bimbingan hanya bisa dilakukan hanya ketika TA anda sudah di disposisi oleh KAPRODI.</li>
            </ul>
        </div>
    <?php endif; ?>
<?php endif; ?>
<!-- filter buat prodi -->
<?php if (session()->get('role') != 'mahasiswa' && session()->get('role') != 'dosen') : ?>
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('bimbingan/bimbingankp') ?>">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="form-inline">
                                <label for="dosen" class="mr-5">Dosen</label>
                                <select name="dosen" id="dosen" class="form-control">
                                    <option value="">:: pilih ::</option>
                                    <?php foreach ($dosen as $d) : ?>
                                        <?php if (isset($_GET['dosen']) && $_GET['dosen'] == $d->nik) : ?>
                                            <option value="<?= $d->nik ?>" selected><?= $d->nama_dosen ?></option>
                                        <?php endif ?>
                                        <option value="<?= $d->nik ?>"><?= $d->nama_dosen ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="form-inline">
                                <label for="mahasiswa" class="mr-5">Mahasiswa</label>
                                <select name="mahasiswa" id="mahasiswa" class="form-control">
                                    <option value="">:: pilih ::</option>
                                    <?php foreach ($mahasiswa as $m) : ?>
                                        <?php if (isset($_GET['mahasiswa']) && $_GET['mahasiswa'] == $m->npm) : ?>
                                            <option value="<?= $m->npm ?>" selected><?= $m->nama_mahasiswa ?></option>
                                        <?php endif; ?>
                                        <option value="<?= $m->npm ?>"><?= $m->nama_mahasiswa ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm mt-3">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
<!-- endfilter -->
<!-- filter dosen -->
<?php if (session()->get('role') == 'dosen') : ?>
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('bimbingan/bimbingankp') ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-inline">
                                <label for="mahasiswa" class="mr-5">Mahasiswa</label>
                                <select name="mahasiswa" id="mahasiswa" class="form-control">
                                    <option value="">:: pilih ::</option>
                                    <?php foreach ($getMahasiswaBimbingan as $m) : ?>
                                        <?php if (isset($_GET['mahasiswa']) && $_GET['mahasiswa'] == $m->npm) : ?>
                                            <option value="<?= $m->npm ?>" selected><?= $m->npm . ' ' . $m->nama_mahasiswa ?></option>
                                        <?php else : ?>
                                            <option value="<?= $m->npm ?>"><?= $m->npm . ' ' . $m->nama_mahasiswa ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
<!-- endfilter -->
<!-- Default box -->
<?php if (session()->get('role') == 'mahasiswa' && $cek != null) : ?>
    <div class="card">
        <div class="card-body">
            <h6>Dosen Pembimbing : <?= $dosbing->nama_dosen ?></h6>
            <?php if ($cek->no_perubahan != null && $cek->status_dosen == 'acc' && $cek->status_prodi == 'acc') : ?>
                <h6>Judul Tugas Akhir : <?= $cek->judul_perubahan ?></h6>
            <?php else : ?>
                <h6>Judul Tugas Akhir : <?= $cek->judul ?></h6>
            <?php endif; ?>
            <h6>Lokasi Tugas Akhir : <?= $cek->studi_kasus ?></h6>
            <h6>Batas Bimbingan : <span class="badge bg-danger"><?= date('d M Y', strtotime($cek->batas_bimbingan)) ?></span></h6>
            <a href="<?= base_url('bimbingan/download/ta') ?>" target="blank" class="btn btn-primary btn-sm">Download Bimbingan</a>
        </div>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <?php if (session()->get('role') != "dosen") : ?>
                            <th>Nama Dosen</th>
                        <?php endif; ?>
                        <th>NPM</th>
                        <?php if (session()->get('role') != "mahasiswa") : ?>
                            <th>Nama Mahasiswa</th>
                        <?php endif; ?>
                        <th>Tanggal Bimbingan</th>
                        <th>Materi</th>
                        <th>Matode</th>
                        <th>File</th>
                        <?php if (session()->get('role') != "dosen") : ?>
                            <th>Status</th>
                            <th>Hasil</th>
                        <?php endif; ?>
                        <?php if (session()->get('role') == "dosen") : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($bimbingan as $b) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <?php if (session()->get('role') != "dosen") : ?>
                                <td><?= $b->nama_dosen ?></td>
                            <?php endif; ?>
                            <td><?= $b->npm ?></td>
                            <?php if (session()->get('role') != "mahasiswa") : ?>
                                <td><?= $b->nama_mahasiswa ?></td>
                            <?php endif; ?>
                            <td><?= date('d M Y', strtotime($b->tgl)) ?></td>
                            <td><?= $b->materi ?></td>
                            <td><?= $b->metode == "online" ? '<span class="badge bg-primary text-white">Online</span>' : '<span class="badge bg-danger text-white">Offline</span>' ?></td>
                            <td>
                                <?php
                                $file = explode('/', $b->file);
                                $file = end($file);
                                ?>
                                <?= $b->metode == "online" ? '<a href="' . DriveApi::getFile($b->drive_id) . '" class="text-danger" target="blank">' . $b->drive_id . '&nbsp;&nbsp;<i class="fa fa-file-pdf"></i></a>' : '<a href="' . DriveApi::getFile($b->drive_id) . '" target="blank">' . $b->drive_id . '&nbsp;&nbsp;<i class="fa fa-image"></i></a>' ?>
                            </td>
                            <?php if (session()->get('role') != "dosen") : ?>
                                <td>
                                    <?php if ($b->status == "acc") : ?>
                                        <span class="badge bg-primary text-white">ACC</span>
                                    <?php elseif ($b->status == "tidak acc") : ?>
                                        <span class="badge bg-warning text-white">belum ACC</span>
                                    <?php elseif ($b->status == "tolak") : ?>
                                        <span class="badge bg-danger text-white">Ditolak</span>
                                    <?php else : ?>
                                        <span class="badge bg-warning text-white">Dalam review</span>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <?php if (session()->get('role') != "dosen") : ?>
                                <td>
                                    <?php if ($b->metode == "online") : ?>
                                        <?php if ($b->keterangan == null) : ?>
                                            <span class="badge bg-primary text-white">Belum Direview</span>
                                        <?php else : ?>
                                            <a href="" class="btn btn-primary btn-sm detail-review" data-toggle="modal" data-target="#modal-detail-review" data-keterangan="<?= $b->keterangan ?>" data-tgl="<?= $b->updated_at ?>"><i class="fa fa-eye"></i></a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if ($b->status == "acc") : ?>
                                            <span class="badge bg-primary text-white">ACC</span>
                                        <?php elseif ($b->status == "tidak acc") : ?>
                                            <span class="badge bg-warning text-white">belum ACC</span>
                                        <?php else : ?>
                                            <span class="badge bg-danger text-white">Ditolak</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <?php if (session()->get('role') == "dosen") : ?>
                                <td>
                                    <?php if ($b->metode == "online") : ?>
                                        <?php if ($b->keterangan == null) : ?>
                                            <a href="" class="btn btn-primary btn-sm review" data-toggle="modal" data-target="#modal-review" data-kd-bimbingan="<?= $b->kd_bimbingan ?>" data-npm="<?= $b->npm ?>">Review</a>
                                        <?php else : ?>
                                            <a href="" class="btn btn-default btn-sm detail-review" data-toggle="modal" data-target="#modal-detail-review" data-keterangan="<?= $b->keterangan ?>" data-tgl="<?= $b->updated_at ?>"><i class="fa fa-eye"></i></a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <form action="<?= base_url('bimbingan/accbimbingan') ?>" method="POST" id="form-acc-bimbingan">
                                            <input type="hidden" name="jenis" value="TA">
                                            <input type="hidden" name="kd_bimbingan" value="<?= $b->kd_bimbingan; ?>">
                                            <input type="hidden" name="npm" value="<?= $b->npm ?>">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="acc<?= $no ?>" value="acc" name="status" <?= $b->status == "acc" ? 'checked' : '' ?>>
                                                <label for="acc<?= $no ?>" class="custom-control-label">ACC</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="tolak<?= $no ?>" value="tolak" name="status" <?= $b->status == "tolak" ? 'checked' : '' ?>>
                                                <label for="tolak<?= $no ?>" class="custom-control-label">Tolak</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="tidak_acc<?= $no ?>" value="tidak acc" name="status" <?= $b->status == "tidak acc" ? 'checked' : '' ?>>
                                                <label for="tidak_acc<?= $no ?>" class="custom-control-label">Belum Acc</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm btn-block mt-2"><i class="fa fa-edit"></i></button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <th>No</th>
                    <?php if (session()->get('role') != "dosen") : ?>
                        <th>Nama Dosen</th>
                    <?php endif; ?>
                    <th>NPM</th>
                    <?php if (session()->get('role') != "mahasiswa") : ?>
                        <th>Nama Mahasiswa</th>
                    <?php endif; ?>
                    <th>Tanggal Bimbingan</th>
                    <th>Materi</th>
                    <th>Matode</th>
                    <th>File</th>
                    <?php if (session()->get('role') != "dosen") : ?>
                        <th>Status</th>
                        <th>Hasil</th>
                    <?php endif; ?>
                    <?php if (session()->get('role') == "dosen") : ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tfoot>
            </table>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- modal review -->
<form action="<?= base_url('bimbingan/reviewkp') ?>" method="post" id="form-review">
    <div class="modal fade" id="modal-review">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Review Bimbingan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="jenis" value="TA">
                    <input type="hidden" name="kd_bimbingan" id="kd_bimbingan">
                    <input type="hidden" name="npm" id="npm">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan"></textarea>
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

<div class="modal fade" id="modal-detail-review">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Review</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Timelime example  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <div class="timeline">
                            <!-- timeline time label -->
                            <!-- <div class="time-label">
                                <span class="bg-red">10 Feb. 2014</span>
                            </div> -->
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                    <h3 class="timeline-header"><a href="#">Review Bimbingan</a></h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.timeline -->
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $(document).ready(function() {
        // select 2
        $("#dosen").select2({
            placeholder: 'Select an option'
        });
        $("#mahasiswa").select2({
            placeholder: 'Select an option'
        });
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        // summernote
        $('#keterangan').summernote()
        // button review click
        $('#modal-review').on('show.bs.modal', function(e) {
            const target = e.relatedTarget
            let kd = $(target).data('kd-bimbingan');
            let npm = $(target).data('npm');
            // let judul = $(target).data('materi');
            console.log(npm);
            $("#kd_bimbingan").val(kd);
            $("#npm").val(npm);
            // $("#judulreview").val(judul)
        })
        // $(".review").on('click', function() {
        //     let kd = $(this).data('kd-bimbingan');
        //     let npm = $(this).data('npm');
        //     // console.log(kd);
        //     $("#kd_bimbingan").val(kd);
        //     $("#npm").val(npm);
        // });

        // form review validasi
        $("#form-review").submit(function(e) {
            if ($("#keterangan").val() == "") {
                Toast.fire({
                    icon: 'warning',
                    title: 'Inputan Keterangan wajib diisi'
                });
                e.preventDefault();
            }
        });

        // detail review
        $('#modal-detail-review').on('show.bs.modal', function(e) {
            let target = e.relatedTarget
            let ket = $(target).data('keterangan');
            let tgl = $(target).data('tgl');
            let display = '<i class="fas fa-clock"></i> ' + tgl;
            $(".timeline-body").html(ket);
            $(".time").html(display);
        })
        // $(".detail-review").on('click', function() {
        //     let ket = $(this).data('keterangan');
        //     let tgl = $(this).data('tgl');
        //     let display = '<i class="fas fa-clock"></i> ' + tgl;
        //     $(".timeline-body").html(ket);
        //     $(".time").html(display);
        // });

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
        // console.log(id)
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
        // change mahasiswa dengan dosen yang bersangkutan
        $("#dosen").on('change', function() {
            let dosen = $(this).find(':selected').val();
            $.ajax({
                url: "<?= base_url('bimbingan/getMahasiswa') ?>",
                method: 'get',
                data: {
                    dosen: dosen,
                    jenis:'TA'
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    let option = '';
                    res.forEach(function(data) {
                        option += "<option value=''>:: pilih ::</option>";
                        option += "<option value='" + data.npm + "'>" + data.nama_mahasiswa + "</option>";
                    });
                    $("#mahasiswa").html(option);
                }
            })
        });

        // mengambil parameter url
        getMahasiswa();

        function getMahasiswa() {
            let url = new URLSearchParams(window.location.search);
            const dosen = url.get('dosen');
            const mahasiswa = url.get('mahasiswa');

            if (dosen != null) {
                $.ajax({
                    url: "<?= base_url('bimbingan/getMahasiswa') ?>",
                    method: 'get',
                    data: {
                        dosen: dosen
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res)
                        let option = '';
                        res.forEach(function(data) {
                            option += "<option value=''>:: pilih ::</option>";
                            if (mahasiswa == data.npm) {
                                option += "<option value='" + data.npm + "' selected>" + data.nama_mahasiswa + "</option>";
                            } else {
                                option += "<option value='" + data.npm + "'>" + data.nama_mahasiswa + "</option>";
                            }
                        });
                        $("#mahasiswa").html(option);
                    }
                });
            }
        }

    });
</script>
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        $(document).ready(function(){
            toastr.info('<?= session()->getFlashdata('pesan') ?>')
        })
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        $(document).ready(function(){
            toastr.error('<?= session()->getFlashdata('error') ?>')
        })
    </script>
<?php endif; ?>
<?= $this->endsection(); ?>