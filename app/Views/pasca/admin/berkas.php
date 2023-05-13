<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
use App\Libraries\DriveApi;
use App\Helpers\Utils;

?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <ul class="list-group">
                            <li class="list-group-item text-bold">NPM</li>
                            <li class="list-group-item text-bold">Nama</li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-group">
                            <li class="list-group-item text-bold"><?=$mahasiswa->npm?></li>
                            <li class="list-group-item text-bold"><?=$mahasiswa->nama_mahasiswa?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
        <div class="card-header">
            <h6>List Berkas</h6>
        </div>
            <div class="card-body">
            <form action="#" id="form-berkas">
        <input type="hidden" name="npm" value="<?=$npm?>">
        <table class="table table-bordered">
            <tr>
                <td>1.</td>
                <td>Bukti Prosesi Foto dari studio</td>
                <td>
                    <input class="berkas" type="checkbox" name="foto_studio" <?= $berkas && json_decode($berkas->berkas)[0]->status == true ? 'checked':''?> >
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Surat Pernyataan Penulisan Identitas</td>
                <td>
                    <input class="berkas" type="checkbox" name="penulisan_identitas"  <?= $berkas && json_decode($berkas->berkas)[1]->status == true ? 'checked':''?> >
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Ijazah SLTA/ Ijazah D3</td>
                <td>
                    <input class="berkas" type="checkbox" name="ijazah"  <?= $berkas && json_decode($berkas->berkas)[2]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Akte Kelahiran (Legalisir)</td>
                <td>
                    <input class="berkas" type="checkbox" name="akte_kelahiran"  <?= $berkas && json_decode($berkas->berkas)[3]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Data Pribadi & Pas Foto 4x6</td>
                <td>
                    <input class="berkas" type="checkbox" name="data_pribadi"  <?= $berkas && json_decode($berkas->berkas)[4]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Surat Rekomendasi Ka. Prodi (Wisuda)</td>
                <td>
                    <input class="berkas" type="checkbox" name="surat_rekomendasi"  <?= $berkas && json_decode($berkas->berkas)[5]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>7.</td>
                <td>FC Berita Acara Ujian Pendadaran</td>
                <td>
                    <input class="berkas" type="checkbox" name="berita_acara"  <?= $berkas && json_decode($berkas->berkas)[6]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>8.</td>
                <td>CD yang sudah di ttd dosbing</td>
                <td>
                    <input class="berkas" type="checkbox" name="cd"  <?= $berkas && json_decode($berkas->berkas)[7]->status == true ? 'checked':''?>>
                </td>
            </tr>
        </table>
        </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6>List Sertifikat</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Peran</th>
                                <th>Tingkat</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($sertifikat as $item): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$item->kegiatan?></td>
                                <td><?=$item->peran?></td>
                                <td><?=$item->tingkat?></td>
                                <td><a target="blank" href="<?=DriveApi::getFile($item->bukti)?>"><i class="fa fa-pdf"></i>&nbsp; <?=$item->bukti?></a></td>
                                <!-- <td>
                                    <input type="checkbox" name="sertifikat" data-id="<?=$item->id?>" <?=$item->is_approve == 1 ? 'checked' : ''?>>
                                </td> -->
                                <td>
                                    <select name="sertifikat" id="sertifikat" data-id="<?=$item->id?>">
                                        <option value="proses" <?=$item->is_approve == 0 ? 'selected' : ''?>>proses</option>
                                        <option value="disetujui" <?=$item->is_approve == 1 ? 'selected' : ''?>>disetujui</option>
                                        <option value="ditolak" <?=$item->is_approve == 2 ? 'selected' : ''?>>ditolak</option>
                                    </select>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <p class="text-bold">Jumlah Point++ yang diajukan</p>
                        <p class="text-bold">Jumlah Point++ yang diproses</p>
                        <p class="text-bold">Jumlah Point++ yang disetujui</p>
                        <p class="text-bold">Jumlah Point++ yang ditolak</p>
                        <p class="text-bold">Status sertifikat</p>
                    </div>
                    <div class="col-6">
                        <p class="text-bold"><?=array_sum(array_column($sertifikat, 'poin')); ?></p>
                        <p class="text-bold"><?=array_sum(array_column(Utils::accSertifikat($sertifikat,0), 'poin'));?></p>
                        <p class="text-bold"><?=array_sum(array_column(Utils::accSertifikat($sertifikat,1), 'poin'));?></p>
                        <p class="text-bold"><?=array_sum(array_column(Utils::accSertifikat($sertifikat,2), 'poin'));?></p>
                        <p class="text-bold"><?=array_sum(array_column(Utils::accSertifikat($sertifikat,1), 'poin')) >= 10 ? 'Memenuhi Syarat' : 'Belum Memenuhi Syarat' ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".berkas").on('change',function(){
            let form = $("#form-berkas").serialize();
            $.ajax({
                url:'<?=base_url('admin/pasca/yudisium/updateBerkas')?>',
                type:'get',
                data:form,
                success:function(res){
                    toastr.info('Ubah berkas berhasil')
                },
                error:function(err){
                    ctoastr.error('Oops, something wrong!')
                }
            })
        })


        $("select[name='sertifikat']").on('change',function(){
            let id = $(this).data('id')
            let value = $(this).val()

            $.ajax({
                url:'<?=base_url('admin/pasca/yudisium/updateSertifikat')?>',
                type:'get',
                dataType:'json',
                data:{
                    id:id,
                    value:value
                },
                success:function(res){
                    console.log(res)
                    toastr.info('Ubah sertifikat berhasil')
                },
                error:function(err){
                    toastr.error('Oops, something wrong!')
                }
            })
        })
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