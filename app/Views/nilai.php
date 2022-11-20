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
        <table id="example2" class="table table-striped table-bordered " style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Jumlah SKS</th>
                    <th>IPK</th>
                    <th>Nilai D/E</th>
                    <th>MK Nilai D/E</th>
                    <th>Status Nilai</th>
                    <th>Catatan Nilai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($tb_nilai as $row) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->npm; ?></td>
                        <td><?= $row->nama_mahasiswa; ?></td>
                        <td><?= $row->jumlah_sks; ?></td>
                        <td><?= $row->ipk; ?></td>
                        <td><?= $row->nilai_de; ?></td>
                        <td><?= $row->mk_nilai_de; ?></td>
                        <td><?= $row->status_nilai; ?></td>
                        <td><?= $row->catatan_nilai; ?></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-edit" data-no_nilai="<?= $row->no_nilai; ?>" data-npm="<?= $row->npm; ?>" data-nama_mahasiswa="<?= $row->nama_mahasiswa; ?>" data-nilai_de="<?= $row->nilai_de; ?>" data-mk_nilai_de="<?= $row->mk_nilai_de; ?>" data-jumlah_sks="<?= $row->jumlah_sks; ?>" data-ipk="<?= $row->ipk; ?>" data-status_nilai="<?= $row->status_nilai; ?>" data-catatan_nilai="<?= $row->catatan_nilai; ?>" data-jenis="<?= $jenis; ?>">
                                <i class=" far fa-edit"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/Nilai/update" id="formeditnilai" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Nilai</h5>
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
                        <label>Nilai D/E</label>
                        <select id="nilai_de" name="nilai_de" class="form-control select2" required>
                            <option value="Iya">Iya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>MK Nilai D/E</label>
                        <textarea class="form-control mk_nilai_de" name="mk_nilai_de" id="mk_nilai_de" rows="3" placeholder="..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Jumlah SKS</label>
                        <input type="text" class="form-control jumlah_sks" required name="jumlah_sks" id="jumlah_sks">
                    </div>
                    <div class="form-group">
                        <label>IPK</label>
                        <input type="text" class="form-control ipk" required name="ipk" id="ipk">
                    </div>
                    <div class="form-group">
                        <label>Status Cek Nilai</label>
                        <select class="form-control status_nilai" required name="status_nilai" id="status_nilai">
                            <option value="Belum Diperiksa">Belum Diperiksa</option>
                            <option value="Belum OK">Belum OK</option>
                            <option value="OK Lengkap">OK Lengkap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control catatan_nilai" name="catatan_nilai" id="catatan_nilai" rows="3" placeholder="..."></textarea>
                    </div>
                    <p>Berikan tanda "-" jika tidak ada catatan.</p>
                </div>
                <div class="modal-footer">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="id_sekprod" value="<?= $row->id_sekprod; ?>">
                    <?php endforeach ?>
                    <input type="hidden" name="no_nilai" class="no_nilai">
                    <input type="hidden" name="jenis" value="<?= $jenis; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<script type="text/javascript">
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const no_nilai = $(this).data('no_nilai');
            const npm = $(this).data('npm');
            const nama_mahasiswa = $(this).data('nama_mahasiswa');
            const nilai_de = $(this).data('nilai_de');
            const mk_nilai_de = $(this).data('mk_nilai_de');
            const jumlah_sks = $(this).data('jumlah_sks');
            const ipk = $(this).data('ipk');
            const status_nilai = $(this).data('status_nilai');
            const catatan_nilai = $(this).data('catatan_nilai');
            const jenis = $(this).data('jenis');
            // Set data to Form Edit
            $('.no_nilai').val(no_nilai);
            $('.npm').val(npm);
            $('.nama_mahasiswa').val(nama_mahasiswa);
            $('.nilai_de').val(nilai_de);
            $('#mk_nilai_de').val(mk_nilai_de);
            $('.jumlah_sks').val(jumlah_sks);
            $('.ipk').val(ipk);
            $('.status_nilai').val(status_nilai);
            $('#catatan_nilai').val(catatan_nilai);
            $('#jenis').val(jenis);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        $('#formeditnilai').validate({
            rules: {
                nilai_de: {
                    required: true,
                },
                mk_nilai_de: {
                    required: true,
                },
                jumlah_sks: {
                    required: true,
                },
                ipk: {
                    required: true,
                },
                status_nilai: {
                    required: true,
                },
                catatan_nilai: {
                    required: true,
                },
            },
            messages: {
                nilai_de: {
                    required: "Wajib Diisi",
                },
                mk_nilai_de: {
                    required: "Wajib Diisi",
                },
                jumlah_sks: {
                    required: "Wajib Diisi",
                },
                ipk: {
                    required: "Wajib Diisi",
                },
                status_nilai: {
                    required: "Wajib Diisi",
                },
                catatan_nilai: {
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