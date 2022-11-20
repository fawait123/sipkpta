<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<!-- Default box -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <a href="<?= base_url('') ?>/Perpanjang/berkas" class="btn btn-warning"><i class="fas fa-arrow-circle-left">&nbsp;</i>Kembali</a>
            </div>
        </div>
        <br>

        <?php foreach ($tb_berkas_detail_perpanjang as $row) : ?>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>NPM</th>
                        <td>
                            <?= $row->npm; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>
                            <?= $row->nama_mahasiswa; ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Kartu Bimbingan</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->kartu_bimbingan; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Perpanjang/downloadKartuBimbinganPerpanjang/<?= $row->no_berkas_perpanjang ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Bukti Pembayaran SPP Tetap</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->bukti_spp_tetap; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Perpanjang/downloadBuktiSPPTetap/<?= $row->no_berkas_perpanjang ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Bukti Pembayaran SPP Variabel</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->bukti_spp_variabel; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Perpanjang/downloadBuktiSPPVariabel/<?= $row->no_berkas_perpanjang ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm" <?php if ($row->bukti_spp_variabel == null) { ?> style="pointer-events: none;" <?php } ?>><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>KRS</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->krs; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Perpanjang/downloadKRS/<?= $row->no_berkas_perpanjang ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Keterangan Perpanjang</th>
                        <td>
                            <?= $row->keterangan; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Status Berkas Perpanjang</th>
                        <td>
                            <?= $row->status_berkas_perpanjang; ?>
                        </td>
                        <td rowspan="2" style="vertical-align : middle;">
                            <a href="#" class="btn btn-info btn-sm btn-edit" data-no_berkas_perpanjang="<?= $row->no_berkas_perpanjang; ?>" data-npm="<?= $row->npm; ?>" data-nama_mahasiswa="<?= $row->nama_mahasiswa; ?>" data-status_berkas_perpanjang="<?= $row->status_berkas_perpanjang; ?>" data-catatan_berkas_perpanjang="<?= $row->catatan_berkas_perpanjang; ?>" data-jenis="<?= $row->jenis; ?>">
                                <i class=" far fa-edit"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Catatan Berkas Perpanjang</th>
                        <td>
                            <?= $row->catatan_berkas_perpanjang; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/Perpanjang/updateBerkasPerpanjang" id="formeditberkasperpanjang" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Berkas Perpanjang</h5>
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
                        <label>Status Berkas Perpanjang</label>
                        <select class="form-control status_berkas_perpanjang" required name="status_berkas_perpanjang" id="status_berkas_perpanjang">
                            <option value="Belum Diperiksa">Belum Diperiksa</option>
                            <option value="Belum OK">Belum OK</option>
                            <option value="OK Lengkap">OK Lengkap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Catatan Berkas Perpanjang</label>
                        <textarea class="form-control catatan_berkas_perpanjang" name="catatan_berkas_perpanjang" id="catatan_berkas_perpanjang" rows="3" placeholder="..."></textarea>
                    </div>
                    <p>Berikan tanda "-" jika tidak ada catatan.</p>
                </div>
                <div class="modal-footer">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="id_admin" value="<?= $row->id_admin; ?>">
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

<script type="text/javascript">
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const no_berkas_perpanjang = $(this).data('no_berkas_perpanjang');
            const npm = $(this).data('npm');
            const nama_mahasiswa = $(this).data('nama_mahasiswa');
            const status_berkas_perpanjang = $(this).data('status_berkas_perpanjang');
            const catatan_berkas_perpanjang = $(this).data('catatan_berkas_perpanjang');
            const jenis = $(this).data('jenis');
            // Set data to Form Edit
            $('.no_berkas_perpanjang').val(no_berkas_perpanjang);
            $('.npm').val(npm);
            $('.nama_mahasiswa').val(nama_mahasiswa);
            $('.status_berkas_perpanjang').val(status_berkas_perpanjang);
            $('#catatan_berka_perpanjang').val(catatan_berkas_perpanjang);
            $('#jenis').val(jenis);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        $('#formeditberkasperpanjang').validate({
            rules: {
                status_berkas_perpanjang: {
                    required: true,
                },
                catatan_berkas_perpanjang: {
                    required: true,
                },
            },
            messages: {
                status_berkas_perpanjang: {
                    required: "Wajib Diisi",
                },
                catatan_berkas_perpanjang: {
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