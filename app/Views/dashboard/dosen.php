<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h4>Data Bimbingan Belum Di Acc atau Review</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($bimbingan as $b) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $b->npm ?></td>
                                        <td><?= $b->nama_mahasiswa ?></td>
                                        <td><?= $b->jenis == 'KP' ? 'Kerja Praktik' : 'Tugas Akhir' ?></td>
                                        <td><span class="badge bg-danger"><?= $b->status ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
</section>
<!-- /.content -->

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
<?= $this->endsection(); ?>