<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    <?php foreach($data as $item): ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$item->npm?></td>
                        <td><?=$item->nama_mahasiswa?></td>
                        <td>
                            <a href="<?=base_url('admin/pasca/kerjapraktik/show/'.$item->Kode_Data_KP)?>"
                                class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
                            <a href="<?=base_url('admin/pasca/kerjapraktik/delete/'.$item->Kode_Data_KP)?>"
                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <th>NO</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        let table = $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    })
</script>
<?php if (session()->getFlashdata('pesan')) : ?>
<script>
    $(document).ready(function () {
        toastr.info('<?= session()->getFlashdata('
            pesan ') ?>')
    })
</script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
<script>
    $(document).ready(function () {
        toastr.error('<?= session()->getFlashdata('
            error ') ?>')
    })
</script>
<?php endif; ?>
<?= $this->endsection(); ?>