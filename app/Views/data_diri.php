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
        <!-- form start -->
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
        <?php if ($data_diri == "true") { ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Penting!</h5>
                File Yang Diupload Wajib Terbaca Jelas
            </div>
            <form role="form" action="<?= base_url(''); ?>/DataDiri/save" id="formdatadiri" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>1. Upload scan e-KTP -Kartu Tanda Penduduk (format nama file : NPM_Nama_KTP, jenis file : PDF)<span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="ktp" id="ktp">
                                <label class="custom-file-label" for="ktp">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>2. Upload scan Kartu Keluarga (KK) (format nama file : NPM_Nama_KK, jenis file : PDF)<span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="kk" id="kk">
                                <label class="custom-file-label" for="kk">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>3. Upload scan Akte Kelahiran (format nama file : NPM_Nama_Akte, jenis file : PDF) <span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="akte" id="akte">
                                <label class="custom-file-label" for="akte">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>4. Upload scan Ijazah SMA (format nama file : NPM_Nama_Ijazah, jenis file : PDF) <span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="ijazah" id="ijazah">
                                <label class="custom-file-label" for="ijazah">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>5. Upload scan Kartu Tanda Mahasiswa (KTM) (format nama file : NPM_Nama_KTM, jenis file : PDF). Diperbolehkan menupload KTM yang sudah tidak berlaku.<span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="ktm" id="ktm">
                                <label class="custom-file-label" for="ktm">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>6. Upload screenshot profil data diri mahasiswa dari laman PDDIKTI. (format nama file : NPM_Nama_DataPDDIKTI, jenis file : PDF)<span style="color: red;">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="data_diri" id="data_diri">
                                <label class="custom-file-label" for="data_diri">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="setuju" name="setuju">
                            <label class="form-check-label" for="exampleCheck2">Dengan ini saya menyatakan bahwa semua data yang saya isikan adalah BENAR, jika terjadi kekeliruan dan ketidakjujuran maka saya siap menerima 'KONSEKUENSI' yang akan diberikan oleh Prodi kepada saya !<span style="color: red;">*</span></label>
                        </div>
                    </div>
                    <label><span style="color: red;">*</span> = Wajib Diisi</label>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?php foreach ($user as $row) : ?>
                            <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                            <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                        <?php endforeach ?>
                        <button type="submit" id="saveDataDiri" class="btn btn-primary float-right"><i class="fas fa-file-upload"></i>&nbsp; Submit</button>
                    </div>
            </form>
        <?php } else {
        ?>
            <div class="alert alert-success alert-dismissiblee">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p>
                    Terimakasih, Anda Sudah Melakukan Pengisian Data Diri
                </p>
            </div>
            <?php foreach ($data_diri2 as $row) : ?>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Ijazah</th>
                            <td>
                                <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->ijazah; ?></button>
                            </td>
                            <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                    <a href="#" class="btn btn-info btn-sm btn-ijazah" data-no_data_diri="<?= $row->no_data_diri; ?>">
                                        <i class="far fa-edit"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <th>KK</td>
                            <td>
                                <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->kk; ?></button>
                            </td>
                            <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                    <a href="#" class="btn btn-info btn-sm btn-kk" data-no_data_diri="<?= $row->no_data_diri; ?>">
                                        <i class="far fa-edit"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <th>KTP</th>
                            <td>
                                <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->ktp; ?></button>
                            </td>
                            <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                    <a href="#" class="btn btn-info btn-sm btn-ktp" data-no_data_diri="<?= $row->no_data_diri; ?>">
                                        <i class="far fa-edit"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Akte</th>
                            <td>
                                <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->akte; ?></button>
                            </td>
                            <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                    <a href="#" class="btn btn-info btn-sm btn-akte" data-no_data_diri="<?= $row->no_data_diri; ?>">
                                        <i class="far fa-edit"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <th>KTM</td>
                            <td>
                                <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->ktm; ?></button>
                            </td>
                            <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                    <a href="#" class="btn btn-info btn-sm btn-ktm" data-no_data_diri="<?= $row->no_data_diri; ?>">
                                        <i class="far fa-edit"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Data Diri</td>
                            <td>
                                <button type="button" class="btn btn-block btn-info btn-xs"><?= $row->data_diri; ?></button>
                            </td>
                            <td><?php if ($row->status_berkas == "Belum OK") { ?>
                                    <a href="#" class="btn btn-info btn-sm btn-data_diri" data-no_data_diri="<?= $row->no_data_diri; ?>">
                                        <i class="far fa-edit"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php } ?>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/DataDiri/updateDataDiri" id="formeditktp" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="editKTPModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>1. Upload scan e-KTP -Kartu Tanda Penduduk (format nama file : NPM_Nama_KTP, jenis file : PDF)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="ktp" id="ktp">
                                <label class="custom-file-label" for="ktp">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_data_diri" class="no_data_diri">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                        <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                    <?php endforeach ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/DataDiri/updateDataDiri" id="formeditkk" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="editKKModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Upload scan Kartu Keluarga (KK) (format nama file : NPM_Nama_KK, jenis file : PDF)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="kk" id="kk">
                                <label class="custom-file-label" for="kk">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_data_diri" class="no_data_diri">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                        <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                    <?php endforeach ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/DataDiri/updateDataDiri" id="formeditakte" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="editAkteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>3. Upload scan Akte Kelahiran (format nama file : NPM_Nama_Akte, jenis file : PDF) </label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="akte" id="akte">
                                <label class="custom-file-label" for="akte">Choose file</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_data_diri" class="no_data_diri">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                        <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                    <?php endforeach ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/DataDiri/updateDataDiri" id="formeditktm" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="editKTMModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Upload scan Kartu Tanda Mahasiswa (KTM) (format nama file : NPM_Nama_KTM, jenis file : PDF). Diperbolehkan menupload KTM yang sudah tidak berlaku.</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="ktm" id="ktm">
                                <label class="custom-file-label" for="ktm">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_data_diri" class="no_data_diri">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                        <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                    <?php endforeach ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/DataDiri/updateDataDiri" id="formeditijazah" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="editIjazahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Upload scan Ijazah SMA (format nama file : NPM_Nama_Ijazah, jenis file : PDF) </label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="ijazah" id="ijazah">
                                <label class="custom-file-label" for="ijazah">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_data_diri" class="no_data_diri">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                        <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                    <?php endforeach ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Edit Product-->
<form role="form" action="<?= base_url(''); ?>/DataDiri/updateDataDiri" id="formeditdatadiri" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="editDataDiriModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Upload profil data diri mahasiswa yang sudah ditanda tangani, profil data diri dapat didownload melalui SIA pada menu profil (format nama file : NPM_Nama_DataDiri, jenis file : PDF)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="data_diri" id="data_diri">
                                <label class="custom-file-label" for="data_diri">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="no_data_diri" class="no_data_diri">
                    <?php foreach ($user as $row) : ?>
                        <input type="hidden" name="username" class="form-control" value="<?= $username; ?>">
                        <input type="hidden" name="nama_mahasiswa" class="form-control" value="<?= $row->nama_mahasiswa;; ?>">
                    <?php endforeach ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<script>
    $(function() {
        bsCustomFileInput.init();
    });

    $('.btn-ktp').on('click', function() {
        // get data from button edit
        const no_data_diri = $(this).data('no_data_diri');
        // Set data to Form Edit
        $('.no_data_diri').val(no_data_diri);
        // Call Modal Edit
        $('#editKTPModal').modal('show');
    });

    // get Edit Product
    $('.btn-kk').on('click', function() {
        // get data from button edit
        const no_data_diri = $(this).data('no_data_diri');
        // Set data to Form Edit
        $('.no_data_diri').val(no_data_diri);
        // Call Modal Edit
        $('#editKKModal').modal('show');
    });

    // get Edit Product
    $('.btn-akte').on('click', function() {
        // get data from button edit
        const no_data_diri = $(this).data('no_data_diri');
        // Set data to Form Edit
        $('.no_data_diri').val(no_data_diri);
        // Call Modal Edit
        $('#editAkteModal').modal('show');
    });

    // get Edit Product
    $('.btn-ktm').on('click', function() {
        // get data from button edit
        const no_data_diri = $(this).data('no_data_diri');
        // Set data to Form Edit
        $('.no_data_diri').val(no_data_diri);
        // Call Modal Edit
        $('#editKTMModal').modal('show');
    });

    // get Edit Product
    $('.btn-ijazah').on('click', function() {
        // get data from button edit
        const no_data_diri = $(this).data('no_data_diri');
        // Set data to Form Edit
        $('.no_data_diri').val(no_data_diri);
        // Call Modal Edit
        $('#editIjazahModal').modal('show');
    });

    // get Edit Product
    $('.btn-data_diri').on('click', function() {
        // get data from button edit
        const no_data_diri = $(this).data('no_data_diri');
        // Set data to Form Edit
        $('.no_data_diri').val(no_data_diri);
        // Call Modal Edit
        $('#editDataDiriModal').modal('show');
    });

    $('#formdatadiri').validate({
        rules: {
            ktp: {
                required: true,
                extension: "pdf",
            },
            kk: {
                required: true,
                extension: "pdf",
            },
            akte: {
                required: true,
                extension: "pdf",
            },
            ktm: {
                required: true,
                extension: "pdf",
            },
            ijazah: {
                required: true,
                extension: "pdf",
            },
            data_diri: {
                required: true,
                extension: "pdf",
            },
            setuju: {
                required: true,
            },
        },
        messages: {
            ktp: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
            },
            kk: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
            },
            akte: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
            },
            ktm: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
            },
            ijazah: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
            },
            data_diri: {
                required: "Wajib Diisi",
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

    $('#formeditktp').validate({
        rules: {
            ktp: {
                required: true,
                extension: "pdf",
            },
        },
        messages: {
            ktp: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
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

    $('#formeditkk').validate({
        rules: {
            kk: {
                required: true,
                extension: "pdf",
            },
        },
        messages: {
            kk: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
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

    $('#formeditakte').validate({
        rules: {
            akte: {
                required: true,
                extension: "pdf",
            },
        },
        messages: {
            akte: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
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

    $('#formeditijazah').validate({
        rules: {
            ijazah: {
                required: true,
                extension: "pdf",
            },
        },
        messages: {
            ijazah: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
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

    $('#formeditdatadiri').validate({
        rules: {
            data_diri: {
                required: true,
                extension: "pdf",
            },
        },
        messages: {
            data_diri: {
                required: "Wajib Diisi",
                extension: "File Harus PDF",
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

    jQuery.validator.addMethod("judul", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
    });
</script>

<?= $this->endsection(); ?>