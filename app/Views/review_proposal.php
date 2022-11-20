<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$errors = $session->getFlashdata('errors');
$success = $session->getFlashdata('success');
date_default_timezone_set('Asia/Jakarta');
?>
<?php foreach ($tanggal as $row) :
    $start = $row->start;
    $end = $row->end;
endforeach;
$sekarang = strtotime(date("Y-m-d H:i:s"));
$start2 = strtotime($start);
$end2 = strtotime($end);
if (($sekarang >= $start2) && ($sekarang <= $end2)) {
?>
    <!-- Default box -->
    <div class="card card-primary">
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
        <div class="p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#pembimbing" data-toggle="tab">Review Proposal Reviewer 1</a></li>
                <li class="nav-item"><a class="nav-link" href="#reviewer" data-toggle="tab">Review Proposal Reviewer 2</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="pembimbing">
                    <table id="example2" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($tb_review_proposal as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->npm; ?></td>
                                    <td><?= $row->nama_mahasiswa; ?></td>
                                    <td><?= $row->judul; ?></td>
                                    <td>
                                        <?php if ($row->status_review == "Belum Direview") { ?>
                                            <span class="badge badge-danger">
                                                <?= $row->status_review; ?>
                                            </span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">
                                                <?= $row->status_review; ?>
                                            </span>
                                            <a href="<?= base_url('') ?>/ReviewProposal/downloadReview2/<?= $row->no_detail_review ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i> &nbsp; Review</a>
                                        <?php } ?>
                                    </td>
                                    <td style="width: 100px;" align="center">
                                        <a href="<?= base_url('') ?>/ReviewProposal/downloadProposal/<?= $row->no_proposal ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i> &nbsp; Proposal</a>
                                        <br>
                                        <a href="<?= base_url('') ?>/ReviewProposal/downloadReviewer/<?= $jenis; ?>/<?= $row->no_detail_review ?>/<?= $row->nama_mahasiswa; ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-file-download"></i>&nbsp; Review</a>
                                        <br>
                                        <a href="#" class="btn btn-info btn-sm btn-edit" data-no_detail_review="<?= $row->no_detail_review; ?>" data-no_proposal="<?= $row->no_proposal; ?>" data-npm="<?= $row->npm; ?>" data-nama_mahasiswa="<?= $row->nama_mahasiswa; ?>" data-nama_dosen="<?= $row->nama_dosen; ?>" data-judul="<?= $row->judul; ?>" data-review="<?= $row->review; ?>" data-proposal_review="<?= $row->proposal_review; ?>"> <i class="far fa-edit"></i></a>
                                        <br>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="modal fade" id="editModal">
                        <form action="<?= base_url(''); ?>/ReviewProposal/update" id="formeditreview" method="post" enctype="multipart/form-data">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Review Proposal</h4>
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
                                            <label>Judul</label>
                                            <input type="text" class="form-control judul" required name="judul" id="judul" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Lembar Review</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="review" id="review">
                                                    <label class="custom-file-label" for="review">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Proposal Hasil Review</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="proposal_review" id="proposal_review">
                                                    <label class="custom-file-label" for="proposal_review">Choose file</label>
                                                </div>
                                                <input type="hidden" name="proposal_review21" id="proposal_review21">
                                            </div>
                                            <p>Apabila Dosen Reviewer memberikan koreksian pada file proposal dapat unggah file proposal tersebut pada bagian ini</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="no_detail_review" class="no_detail_review">
                                        <input type="hidden" name="no_proposal" class="no_proposal">
                                        <input type="hidden" name="nama_mahasiswa" class="nama_mahasiswa">
                                        <input type="hidden" name="nama_dosen" class="nama_dosen">
                                        <input type="hidden" name="npm" class="npm">
                                        <input type="hidden" name="jenis" value="<?= $jenis; ?>">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </form>
                    </div>
                    <!-- /.modal -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="reviewer">
                    <table id="example3" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($tb_review_proposal2 as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->npm; ?></td>
                                    <td><?= $row->nama_mahasiswa; ?></td>
                                    <td><?= $row->judul; ?></td>
                                    <td>
                                        <?php if ($row->status_review == "Belum Direview") { ?>
                                            <span class="badge badge-danger">
                                                <?= $row->status_review; ?>
                                            </span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">
                                                <?= $row->status_review; ?>
                                            </span>
                                            <a href="<?= base_url('') ?>/ReviewProposal/downloadReview2/<?= $row->no_detail_review ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i> &nbsp; Review</a>
                                        <?php } ?>
                                    </td>
                                    <td style="width: 100px;" align="center">
                                        <a href="<?= base_url('') ?>/ReviewProposal/downloadProposal/<?= $row->no_proposal ?>/<?= $row->npm; ?>/<?= $row->nama_mahasiswa; ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-file-download"></i> &nbsp; Proposal</a>
                                        <br>
                                        <a href="<?= base_url('') ?>/ReviewProposal/downloadReviewer2/<?= $jenis; ?>/<?= $row->no_detail_review ?>/<?= $row->nama_mahasiswa ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-file-download"></i>&nbsp; Review</a>
                                        <br>
                                        <a href="#" class="btn btn-info btn-sm btn-edit2" data-no_detail_review2="<?= $row->no_detail_review; ?>" data-no_proposal2="<?= $row->no_proposal; ?>" data-npm2="<?= $row->npm; ?>" data-nama_mahasiswa2="<?= $row->nama_mahasiswa; ?>" data-nama_dosen2="<?= $row->nama_dosen; ?>" data-judul2="<?= $row->judul; ?>" data-review2="<?= $row->review; ?>" data-proposal_review2="<?= $row->proposal_review; ?>"> <i class="far fa-edit"></i></a>
                                        <br>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="modal fade" id="editModal2">
                        <form action="<?= base_url(''); ?>/ReviewProposal/update2" id="formeditreview2" method="post" enctype="multipart/form-data">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Review Proposal</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>NPM</label>
                                            <input type="text" class="form-control npm2" required name="npm2" id="npm2" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control nama_mahasiswa2" required name="nama_mahasiswa2" id="nama_mahasiswa2" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" class="form-control judul2" required name="judul2" id="judul2" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Lembar Review</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="review2" id="review2">
                                                    <label class="custom-file-label" for="review2">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Proposal Hasil Review</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="proposal_review2" id="proposal_review2">
                                                    <label class="custom-file-label" for="proposal_review2">Choose file</label>
                                                </div>
                                                <input type="hidden" name="proposal_review22" id="proposal_review22">
                                            </div>
                                            <p>Apabila Dosen Reviewer memberikan koreksian pada file proposal dapat unggah file proposal tersebut pada bagian ini</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="no_detail_review2" class="no_detail_review2">
                                        <input type="hidden" name="no_proposal2" class="no_proposal2">
                                        <input type="hidden" name="npm2" class="npm2">
                                        <input type="hidden" name="nama_mahasiswa2" class="nama_mahasiswa2">
                                        <input type="hidden" name="nama_dosen2" class="nama_dosen2">
                                        <input type="hidden" name="jenis2" value="<?= $jenis; ?>">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </form>
                    </div>
                    <!-- /.modal -->
                </div>
                <!-- /.tab-pane -->
            <?php } else { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>
                        Maaf, Waktu Review Proposal Sudah Habis
                    </p>
                </div>
            <?php } ?>
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <script>
        $(document).ready(function() {
            bsCustomFileInput.init()
            // get Edit Product
            $('.btn-edit').on('click', function() {
                // get data from button edit
                const no_detail_review = $(this).data('no_detail_review');
                const no_proposal = $(this).data('no_proposal');
                const npm = $(this).data('npm');
                const nama_mahasiswa = $(this).data('nama_mahasiswa');
                const nama_dosen = $(this).data('nama_dosen');
                const judul = $(this).data('judul');
                const review = $(this).data('review');
                const proposal_review = $(this).data('proposal_review');

                // Set data to Form Edit
                $('.no_detail_review').val(no_detail_review);
                $('.no_proposal').val(no_proposal);
                $('.npm').val(npm);
                $('.nama_mahasiswa').val(nama_mahasiswa);
                $('.nama_dosen').val(nama_dosen);
                $('.judul').val(judul);
                $('.review').val(review);
                $('.proposal_review').val(proposal_review);
                // Call Modal Edit
                $('#editModal').modal('show');
            });

            $('.btn-edit2').on('click', function() {
                // get data from button edit
                const no_detail_review2 = $(this).data('no_detail_review2');
                const no_proposal2 = $(this).data('no_proposal2');
                const npm2 = $(this).data('npm2');
                const nama_mahasiswa2 = $(this).data('nama_mahasiswa2');
                const nama_dosen2 = $(this).data('nama_dosen2');
                const judul2 = $(this).data('judul2');
                const review2 = $(this).data('review2');
                const proposal_review2 = $(this).data('proposal_review2');

                // Set data to Form Edit
                $('.no_detail_review2').val(no_detail_review2);
                $('.no_proposal2').val(no_proposal2);
                $('.npm2').val(npm2);
                $('.nama_mahasiswa2').val(nama_mahasiswa2);
                $('.nama_dosen2').val(nama_dosen2);
                $('.judul2').val(judul2);
                $('.review2').val(review2);
                $('.proposal_review2').val(proposal_review2);
                // Call Modal Edit
                $('#editModal2').modal('show');
            });

            $('#proposal_review').on('change', function() {
                var proposal_review = $('#proposal_review').val();
                $("#proposal_review21").val(krs);
            });

            $('#proposal_review2').on('change', function() {
                var proposal_review2 = $('#proposal_review2').val();
                $("#proposal_review22").val(krs);
            });

            $('#formeditreview').validate({
                rules: {
                    review: {
                        required: true,
                        extension: "pdf",
                    }
                },
                messages: {
                    review: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
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

            $('#formeditreview2').validate({
                rules: {
                    review2: {
                        required: true,
                        extension: "pdf",
                    }
                },
                messages: {
                    review2: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
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
    <?= $this->endsection(); ?>