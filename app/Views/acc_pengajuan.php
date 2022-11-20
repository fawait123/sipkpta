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
        <form action="<?= base_url(); ?>/AccPengajuan/update" method="post">
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Jumlah SKS</th>
                        <th>IPK</th>
                        <th>Status Berkas</th>
                        <th>Status Nilai</th>
                        <th>Status Pengajuan</th>
                        <th>Catatan Pengajuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($acc_pengajuan as $row) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->npm; ?></td>
                            <td><?= $row->nama_mahasiswa; ?></td>
                            <td><?= $row->jumlah_sks; ?></td>
                            <td><?= $row->ipk; ?></td>
                            <td align="center">
                                <?= $row->status_berkas; ?>
                                <a href="#" class="btn btn-info btn-sm btn-berkas" data-berkas="<?= $row->catatan_berkas; ?>"><i class="fas fa-sticky-note"></i></a>
                            </td>
                            <td align="center">
                                <?= $row->status_nilai; ?>
                                <a href="#" class="btn btn-info btn-sm btn-nilai" data-nilai="<?= $row->catatan_nilai; ?>"><i class="fas fa-sticky-note"></i></a>
                            </td>
                            <td align="center">
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
                            <td><?= $row->catatan_pengajuan; ?></td>
                            <td align="center">
                                <a href="#" class="btn btn-info btn-sm btn-edit" data-no_pengajuan3="<?= $row->no_pengajuan; ?>" data-npm="<?= $row->npm; ?>" data-nama_mahasiswa="<?= $row->nama_mahasiswa; ?>" data-catatan_pengajuan="<?= $row->catatan_pengajuan; ?>"><i class=" far fa-edit"></i>&nbsp; Edit Pengajuan</a>
                                <br>
                                <a href="#" class="btn btn-info btn-sm btn-acc" <?php if ($row->status_pengajuan == "ACC") { ?> style="pointer-events: none;" <?php } ?>data-no_pengajuan="<?= $row->no_pengajuan; ?>" data-nik="<?= $row->nik; ?>"><i class="far fa-check-circle"></i>&nbsp; ACC</a>
                                <br>
                                <a href="#" class="btn btn-danger btn-sm btn-tolak" <?php if ($row->status_pengajuan == "Ditolak") { ?> style="pointer-events: none;" <?php } ?>data-no_pengajuan4="<?= $row->no_pengajuan; ?>"><i class="far fa-times-circle"></i>&nbsp; Tolak</a>
                                <br>
                                <a href="#" class="btn btn-warning btn-sm btn-cancel" <?php if ($row->status_pengajuan == "Belum Diacc") { ?> style="pointer-events: none;" <?php } ?>data-no_pengajuan2="<?= $row->no_pengajuan; ?>"><i class="far fa-times-circle"></i>&nbsp; Cancel</a>
                                <br>
                                <a href="#" class="btn btn-danger btn-sm btn-delete" <?php if ($row->status_pengajuan == "ACC") { ?> style="pointer-events: none;" <?php } ?>data-no_pengajuan5="<?= $row->no_pengajuan; ?>" data-no_berkas="<?= $row->no_berkas; ?>" data-no_nilai="<?= $row->no_nilai; ?>" data-no_proposal="<?= $row->no_proposal; ?>"><i class="far fa-trash-alt"></i>&nbsp; Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="hidden" name="jenis" id="jenis" value="<?= $jenis; ?>">
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="modal fade" id="modal-berkas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Catatan Berkas</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control berkas" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-nilai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Catatan Nilai</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control nilai" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/AccPengajuan/update2" id="formeditpengajuan" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NPM</label>
                        <input type="text" class="form-control npm" required name="npm" id="npm" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control nama_mahasiswa" required name="nama_mahasiswa" id="nama_mahasiswa" readonly>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control catatan_pengajuan" name="catatan_pengajuan" id="catatan_pengajuan" rows="3" placeholder="..."></textarea>
                    </div>
                    <p>Berikan tanda "-" jika tidak ada catatan.</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_pengajuan3" class="no_pengajuan3">
                    <input type="hidden" name="jenis" value="<?= $jenis; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/AccPengajuan/update" method="post">
    <div class="modal fade" id="accModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ACC Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah Anda Yakin Untuk ACC Pengajuan ini?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_pengajuan" class="no_pengajuan">
                    <input type="hidden" name="nik" class="nik">
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
<form action="<?= base_url(''); ?>/AccPengajuan/tolak" method="post">
    <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah Anda Yakin Untuk Tolak Pengajuan ini?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_pengajuan4" class="no_pengajuan4">
                    <input type="hidden" name="jenis" class="jenis" value="<?= $jenis; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/AccPengajuan/cancel" method="post">
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah Anda Yakin Untuk Edit Pengajuan ini?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_pengajuan2" class="no_pengajuan2">
                    <input type="hidden" name="jenis" class="jenis" value="<?= $jenis; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<!-- Modal Delete Product-->
<form action="<?= base_url(''); ?>/AccPengajuan/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah Anda Yakin Untuk Hapus Pengajuan ini?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_pengajuan5" class="no_pengajuan5">
                    <input type="hidden" name="no_nilai" class="no_nilai">
                    <input type="hidden" name="no_berkas" class="no_berkas">
                    <input type="hidden" name="no_proposal" class="no_proposal">
                    <input type="hidden" name="jenis" class="jenis" value="<?= $jenis; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->


<script>
    $(document).ready(function() {
        $('.btn-berkas').on('click', function() {
            const berkas = $(this).data('berkas');
            $('.berkas').val(berkas);
            $('#modal-berkas').modal('show');
        });
        $('.btn-nilai').on('click', function() {
            const nilai = $(this).data('nilai');
            $('.nilai').val(nilai);
            $('#modal-nilai').modal('show');
        });
        $('.btn-edit').on('click', function() {
            const no_pengajuan3 = $(this).data('no_pengajuan3');
            const npm = $(this).data('npm');
            const nama_mahasiswa = $(this).data('nama_mahasiswa');
            const status_pengajuan = $(this).data('status_pengajuan');
            const catatan_pengajuan = $(this).data('catatan_pengajuan');
            $('.no_pengajuan3').val(no_pengajuan3);
            $('.npm').val(npm);
            $('.nama_mahasiswa').val(nama_mahasiswa);
            $('.status_pengajuan').val(status_pengajuan);
            $('#catatan_pengajuan').val(catatan_pengajuan);
            $('#editModal').modal('show');
        });
        $('.btn-acc').on('click', function() {
            const no_pengajuan = $(this).data('no_pengajuan');
            const nik = $(this).data('nik');
            $('.no_pengajuan').val(no_pengajuan);
            $('.nik').val(nik);
            $('#accModal').modal('show');
        });
        $('.btn-tolak').on('click', function() {
            const no_pengajuan4 = $(this).data('no_pengajuan4');
            $('.no_pengajuan4').val(no_pengajuan4);
            $('#tolakModal').modal('show');
        });
        $('.btn-cancel').on('click', function() {
            const no_pengajuan2 = $(this).data('no_pengajuan2');
            $('.no_pengajuan2').val(no_pengajuan2);
            $('#cancelModal').modal('show');
        });
        $('.btn-delete').on('click', function() {
            const no_pengajuan5 = $(this).data('no_pengajuan5');
            const no_berkas = $(this).data('no_berkas');
            const no_nilai = $(this).data('no_nilai');
            const no_proposal = $(this).data('no_proposal');
            $('.no_pengajuan5').val(no_pengajuan5);
            $('.no_berkas').val(no_berkas);
            $('.no_nilai').val(no_nilai);
            $('.no_proposal').val(no_proposal);
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endsection(); ?>