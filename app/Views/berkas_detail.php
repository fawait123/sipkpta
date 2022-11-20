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
                <?php if ($jenis == "KP") {
                ?>
                    <a href="<?= base_url('') ?>/Berkas/berkasKP" class="btn btn-warning"><i class="fas fa-arrow-circle-left">&nbsp;</i>Kembali</a>
                <?php
                } else { ?>
                    <a href="<?= base_url('') ?>/Berkas/berkasTA" class="btn btn-warning"><i class="fas fa-arrow-circle-left">&nbsp;</i>Kembali</a>
                <?php } ?>
            </div>
        </div>
        <br>

        <?php foreach ($tb_berkas_detail as $row) : ?>
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
                        <th>Bukti Pembayaran Proposal</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->bukti_proposal; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Berkas/downloadberkasbuktiproposal/<?= $row->no_berkas ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Ijazah</td>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->ijazah; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Berkas/downloadberkasijazah/<?= $row->no_data_diri ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>KK</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->kk; ?></button>
                        </td>
                        <td><a href="<?= base_url('') ?>/Berkas/downloadberkaskk/<?= $row->no_data_diri ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>KTP</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->ktp; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Berkas/downloadberkasktp/<?= $row->no_data_diri ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Akte</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->akte; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Berkas/downloadberkasakte/<?= $row->no_data_diri ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>KTM</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->ktm; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Berkas/downloadberkasktm/<?= $row->no_data_diri ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Data Diri</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->data_diri; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Berkas/downloadberkasdatadiri/<?= $row->no_data_diri ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <?php if ($jenis == "TA") {
                    ?>
                        <tr>
                            <th>Surat</th>
                            <td>
                                <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->surat; ?></button>
                            </td>
                            <td>
                                <a href="<?= base_url('') ?>/Berkas/downloadberkassurat/<?= $row->no_berkas ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>Bukti Pembayaran SPP</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->bukti_spp; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Berkas/downloadberkasbuktispp/<?= $row->no_berkas ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm" <?php if ($row->bukti_spp == null) { ?> style="pointer-events: none;" <?php } ?>><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Sertifikat Sosialisasi</th>
                        <td>
                            <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->sertifikat_sosialisasi; ?></button>
                        </td>
                        <td>
                            <a href="<?= base_url('') ?>/Berkas/downloadberkassertifikatsosialisasi/<?= $row->no_berkas ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?= $row->status_berkas; ?>
                        </td>
                        <td rowspan="2" style="vertical-align : middle;">
                            <a href="#" class="btn btn-info btn-sm btn-edit" data-no_berkas="<?= $row->no_berkas; ?>" data-npm="<?= $row->npm; ?>" data-nama_mahasiswa="<?= $row->nama_mahasiswa; ?>" data-status_berkas="<?= $row->status_berkas; ?>" data-catatan_berkas="<?= $row->catatan_berkas; ?>" data-jenis="<?= $jenis; ?>">
                                <i class=" far fa-edit"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>
                            <?= $row->catatan_berkas; ?>
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
<form role="form" action="<?= base_url(''); ?>/Berkas/update" id="formeditberkas" method="post">
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
                        <label>Status</label>
                        <select class="form-control status_berkas" required name="status_berkas" id="status_berkas">
                            <option value="Belum Diperiksa">Belum Diperiksa</option>
                            <option value="Belum OK">Belum OK</option>
                            <option value="OK Lengkap">OK Lengkap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control catatan_berkas" name="catatan_berkas" id="catatan_berkas" rows="3" placeholder="..."></textarea>
                    </div>
                    <p>Berikan tanda "-" jika tidak ada catatan.</p>
                </div>
                <div class="modal-footer">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="id_admin" value="<?= $row->id_admin; ?>">
                    <?php endforeach ?>
                    <input type="hidden" name="no_berkas" class="no_berkas">
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
            const no_berkas = $(this).data('no_berkas');
            const npm = $(this).data('npm');
            const nama_mahasiswa = $(this).data('nama_mahasiswa');
            const status_berkas = $(this).data('status_berkas');
            const catatan_berkas = $(this).data('catatan_berkas');
            const jenis = $(this).data('jenis');
            // Set data to Form Edit
            $('.no_berkas').val(no_berkas);
            $('.npm').val(npm);
            $('.nama_mahasiswa').val(nama_mahasiswa);
            $('.status_berkas').val(status_berkas);
            $('#catatan_berkas').val(catatan_berkas);
            $('#jenis').val(jenis);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        $('#formeditberkas').validate({
            rules: {
                status_berkas: {
                    required: true,
                },
                catatan_berkas: {
                    required: true,
                },
            },
            messages: {
                status_berkas: {
                    required: "Wajib Diisi",
                },
                catatan_berkas: {
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