<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
    <div class="table-responsive">
        <form action="#" id="form-berkas">
        <input type="hidden" name="npm" value="<?=$npm?>">
        <table class="table table-bordered">
            <tr>
                <td>1.</td>
                <td>Bukti Prosesi Foto dari studio</td>
                <td>
                    <input type="checkbox" name="foto_studio" <?= $berkas && json_decode($berkas->berkas)[0]->status == true ? 'checked':''?> >
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Surat Pernyataan Penulisan Identitas</td>
                <td>
                    <input type="checkbox" name="penulisan_identitas"  <?= $berkas && json_decode($berkas->berkas)[1]->status == true ? 'checked':''?> >
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Ijazah SLTA/ Ijazah D3</td>
                <td>
                    <input type="checkbox" name="ijazah"  <?= $berkas && json_decode($berkas->berkas)[2]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Akte Kelahiran (Legalisir)</td>
                <td>
                    <input type="checkbox" name="akte_kelahiran"  <?= $berkas && json_decode($berkas->berkas)[3]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Data Pribadi & Pas Foto 4x6</td>
                <td>
                    <input type="checkbox" name="data_pribadi"  <?= $berkas && json_decode($berkas->berkas)[4]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Surat Rekomendasi Ka. Prodi (Wisuda)</td>
                <td>
                    <input type="checkbox" name="surat_rekomendasi"  <?= $berkas && json_decode($berkas->berkas)[5]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>7.</td>
                <td>FC Berita Acara Ujian Pendadaran</td>
                <td>
                    <input type="checkbox" name="berita_acara"  <?= $berkas && json_decode($berkas->berkas)[6]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>8.</td>
                <td>CD yang sudah di ttd dosbing</td>
                <td>
                    <input type="checkbox" name="cd"  <?= $berkas && json_decode($berkas->berkas)[7]->status == true ? 'checked':''?>>
                </td>
            </tr>
        </table>
        </form>
    </div>
    <a href="<?=base_url('admin/pasca/yudisium')?>" class="btn btn-warning text-white">Kembali <i class="fa fa-reply"></i></a>
</div>

<script>
    $(document).ready(function(){
        $("input[type=checkbox]").on('change',function(){
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