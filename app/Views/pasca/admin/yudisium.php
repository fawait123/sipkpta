<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
use App\Models\PengumpulanBerkasModel;
use App\Helpers\Utils;

$model = new PengumpulanBerkasModel();
?>
<div class="card">
    <div class="card-body">
    <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Status Berkas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    <?php foreach($data as $item): ?>
                        <?php
                            $berkas = $model->where('npm',$item->npm)->first();
                            $dataBerkas = $berkas ? json_decode($berkas->berkas) : [];  
                            $dataBerkas = Utils::filter($dataBerkas);
                        ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$item->npm?></td>
                            <td><?=$item->nama_mahasiswa?></td>
                            <td><span class="badge bg-<?=count($dataBerkas) == 8 ? 'primary' : 'danger'?> text-white"><?=count($dataBerkas) == 8 ? 'Lengkap' : 'Tidak Lengkap'?></span></td>
                            <td>
                                <a href="<?=base_url('admin/pasca/yudisium/berkas/'.$item->npm)?>" class="btn btn-default btn-sm">&nbsp;&nbsp;<i class="fa fa-info"></i>&nbsp;&nbsp;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                        <th>NO</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Status Berkas</th>
                        <th>Aksi</th>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
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
        $(document).ready(function(){
            toastr.info('<?= session()->getFlashdata('pesan') ?>')
        })
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        $(document).ready(function() {
            toastr.error('<?= session()->getFlashdata('error') ?>')
        })
    </script>
<?php endif; ?>
<?= $this->endsection(); ?>