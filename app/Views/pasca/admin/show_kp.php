<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
use App\Libraries\DriveApi;
?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <ul class="list-group">
                    <li class="list-group-item">Judul KP</li>
                    <li class="list-group-item">Abstrak</li>
                    <li class="list-group-item">Naskah</li>
                    <li class="list-group-item">Database</li>
                    <li class="list-group-item">Infografis Editable</li>
                    <li class="list-group-item">Infografis Non Editable</li>
                    <li class="list-group-item">Program</li>
                </ul>
            </div>
            <div class="col-8">
                <ul class="list-group">
                    <li class="list-group-item"><?=$row->Judul_KP?></li>
                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Abstrak)?>" class="text-danger" target="blank"><i class="fa fa-file text-danger"></i>&nbsp; <?=$row->Abstrak?></a></li>
                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Naskah)?>" class="text-danger" target="blank"><i class="fa fa-file text-danger"></i>&nbsp; <?=$row->Naskah?></a></li>
                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Program)?>" class="text-danger" target="blank"><i class="fa fa-file text-danger"></i>&nbsp; <?=$row->Program?></a></li>
                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Database)?>" class="text-danger" target="blank"><i class="fa fa-file text-danger"></i>&nbsp; <?=$row->Database?></a></li>
                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Infografis_e)?>" class="text-danger" target="blank"><i class="fa fa-file text-danger"></i>&nbsp; <?=$row->Infografis_e?></a></li>
                    <li class="list-group-item"><a href="<?=DriveApi::getFile($row->Infografis_n_e)?>" class="text-danger" target="blank"><i class="fa fa-file text-danger"></i>&nbsp; <?=$row->Infografis_n_e?></a></li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <a href="<?=base_url('admin/pasca/kerjapraktik')?>" class="btn btn-warning"><i class="fa fa-reply"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="<?=base_url('pasca/kerjapraktik/status')?>" method="POST">
            <input type="hidden" name="kode_keterangan" value="<?=$row->Kode_Keterangan?>">
            <div class="form-group">
                <label for="kelengkapan_data">Kelengkapan Data</label>
                <select name="kelengkapan_data" id="kelengkapan_data" class="form-control">
                    <option value="">select</option>
                    <option value="Belum diperiksa" <?=$row->Status_Kel_Data == 'Belum diperiksa' ? 'selected':''?>>Belum Diperiksa</option>
                    <option value="Ok,Lengkap" <?=$row->Status_Kel_Data == 'Ok,Lengkap' ? 'selected':''?>>Ok Lengkap</option>
                    <option value="Belum Ok" <?=$row->Status_Kel_Data == 'Belum Ok' ? 'selected':''?>>Belum Ok</option>
                </select>
            </div>
            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea name="catatan" id="catatan" class="form-control" cols="30" rows="10" placeholder="Catatan"><?=$row->Catatan?></textarea>
            </div>
            <div class="form-group">
                <label for="status_cd">Status CD</label>
                <select name="status_cd" id="status_cd" class="form-control">
                    <option value="">select</option>
                    <option value="Belum Mengumpulkan" <?=$row->Status_CD == 'Belum Mengumpulkan' ? 'selected':''?>>Belum Mengumpulkan</option>
                    <option value="Mengumpulkan"  <?=$row->Status_CD == 'Mengumpulkan' ? 'selected':''?>>Mengumpulkan</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?=base_url('admin/pasca/kerjapraktik')?>" class="btn btn-warning">Kembali</a>
            </div>
        </form>
    </div>
</div>
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