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
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus-circle"></i> Tambah Data</button>
        <table id="example2" class="table table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Status Perpanjang</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_pengajuan as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->npm; ?></td>
                        <td><?= $row->nama_mahasiswa; ?></td>
                        <td><?= $row->status_perpanjang; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal Add Product-->
<form role="form" action="<?= base_url(''); ?>/Pengajuan/savePengajuanSekrod" id="formtambahpengajuan" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <select name="npm" id="npm" class="form-control select2">
                            <option value="">-Select-</option>
                            <?php foreach ($tb_mahasiswa as $row) : ?>
                                <option value="<?= $row->npm; ?>"><?= $row->npm; ?> - <?= $row->nama_mahasiswa; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" required name="judul" id="judul" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <label>Studi Kasus</label>
                        <input type="text" class="form-control" name="studi_kasus" id="studi_kasus" placeholder="Studi Kasus">
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="jenis" id="jenis" class="form-control select2">
                            <option value="">-Select-</option>
                            <option value="KP">Kerja Praktik</option>
                            <option value="TA">Tugas Akhir</option>
                        </select>
                    </div>
                    <div class="form-group" class="kp" id="kp">
                        <label>Topik KP</label>
                        <select id="kode_topik" name="kode_topik" class="form-control select2" required>
                            <option value="">-Select-</option>
                            <?php foreach ($tb_topik as $row) : ?>
                                <option value="<?= $row->kode_topik; ?>"><?= $row->nama_topik; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <label>Dosen Pilihan KP</label>
                        <select id="kode_detail" name="kode_detail" class="form-control select2" required>
                            <option value="">-Select-</option>
                        </select>
                    </div>
                    <div class="form-group" class="ta" id="ta">
                        <label>Topik TA</label>
                        <select id="kode_topik2" name="kode_topik2" class="form-control select2" required>
                            <option value="">-Select-</option>
                            <?php foreach ($tb_topik as $row) : ?>
                                <option value="<?= $row->kode_topik; ?>"><?= $row->nama_topik; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <label>Dosen Pilihan TA</label>
                        <select id="kode_detail2" name="kode_detail2" class="form-control select2" required>
                            <option value="">-Select-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Perpanjang</label>
                        <select name="status_perpanjang" id="status_perpanjang" class="form-control select2">
                            <option value="Baru">Baru</option>
                            <option value="Perpanjang">Perpanjang</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
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
                            <input type="radio" name="semester" value="Ganjil"> Ganjil
                            <br>
                            <input type="radio" name="semester" value="Genap"> Genap
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Product-->

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

        $("#jenis").on('change', function() {
            if ($(this).val() == 'KP') {
                $("#kp").show();
                $("#ta").hide();
            } else if ($(this).val() == 'TA') {
                $("#kp").hide();
                $("#ta").show();
            } else {
                $("#kp").hide();
                $("#ta").hide();
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

        $('#formtambahpengajuan').validate({
            rules: {
                npm: {
                    required: true,
                },
                status_perpanjang: {
                    required: true,
                },
            },
            messages: {
                npm: {
                    required: "Wajib Diisi",
                },
                status_perpanjang: {
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