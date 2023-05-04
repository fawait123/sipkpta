<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
use App\Models\PengumpulanBerkasModel;
use App\Helpers\Utils;
use App\Libraries\DriveApi;

$model = new PengumpulanBerkasModel();
$dataBerkas = $berkas ? json_decode($berkas->berkas) : [];  
$dataBerkas = Utils::filter($dataBerkas);
?>
<?php if($pendaftaran && $pendaftaran->tempat != null): ?>
<div class="card">
    <div class="card-header">Status Pengumpulan Berkas</div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <td>1.</td>
                <td>Bukti Prosesi Foto dari studio</td>
                <td>
                    <input type="checkbox" disabled name="foto_studio" <?= $berkas && json_decode($berkas->berkas)[0]->status == true ? 'checked':''?> >
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Surat Pernyataan Penulisan Identitas</td>
                <td>
                    <input type="checkbox" disabled name="penulisan_identitas"  <?= $berkas && json_decode($berkas->berkas)[1]->status == true ? 'checked':''?> >
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Ijazah SLTA/ Ijazah D3</td>
                <td>
                    <input type="checkbox" disabled name="ijazah"  <?= $berkas && json_decode($berkas->berkas)[2]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Akte Kelahiran (Legalisir)</td>
                <td>
                    <input type="checkbox" disabled name="akte_kelahiran"  <?= $berkas && json_decode($berkas->berkas)[3]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Data Pribadi & Pas Foto 4x6</td>
                <td>
                    <input type="checkbox" disabled name="data_pribadi"  <?= $berkas && json_decode($berkas->berkas)[4]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Surat Rekomendasi Ka. Prodi (Wisuda)</td>
                <td>
                    <input type="checkbox" disabled name="surat_rekomendasi"  <?= $berkas && json_decode($berkas->berkas)[5]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>7.</td>
                <td>FC Berita Acara Ujian Pendadaran</td>
                <td>
                    <input type="checkbox" disabled name="berita_acara"  <?= $berkas && json_decode($berkas->berkas)[6]->status == true ? 'checked':''?>>
                </td>
            </tr>
            <tr>
                <td>8.</td>
                <td>CD yang sudah di ttd dosbing</td>
                <td>
                    <input type="checkbox" disabled name="cd"  <?= $berkas && json_decode($berkas->berkas)[7]->status == true ? 'checked':''?>>
                </td>
            </tr>
        </table>
        <table class="table table-bordered mt-4">
            <tr>
                <td>Status Pengumpulan Berkas</td>
                <td>
                    <span class="badge bg-<?=count($dataBerkas) == 8 ? 'primary' : 'danger'?>"><?=count($dataBerkas) == 8 ? 'Lengkap' : 'Tidak Lengkap'?></span>
                </td>
            </tr>
            <tr>
                <td>Jumlah point sertifikat yang diajukan</td>
                <td>
                    <?=array_sum(array_column($sertifikat, 'poin')); ?>
                </td>
            </tr>
            <tr>
                <td>Jumlah point sertifikat yang disetujui</td>
                <td>
                    <?=array_sum(array_column(Utils::accSertifikat($sertifikat), 'poin')); ?>
                </td>
            </tr>
            <tr>
                <td>Status sertifikat</td>
                <td>
                    <?=array_sum(array_column(Utils::accSertifikat($sertifikat), 'poin')) >= 10 ? 'Memenuhi Syarat' : 'Belum Memenuhi Syarat' ?>
                </td>
            </tr>
        </table>
    </div>
</div>

        <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Sertifikat</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Upload Sertifikat</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">List Sertifikat</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                  <form action="<?=base_url('pasca/upload/sertifikat')?>" method="post"  enctype="multipart/form-data" id="form-sertifikat">
        <div class="form-group">
            <label for="jenis">Jenis <span class="text-danger">*</span></label>
            <select name="jenis" id="peran" class="form-control">
                <option value="">pilih</option>
                <?php foreach($jenis as $item): ?>
                    <option value="<?=$item->Kode_Kegiatan?>"><?=$item->Jenis_Kegiatan?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="peran">Peran <span class="text-danger">*</span></label>
            <select name="peran" id="peran" class="form-control">
                <option value="">pilih</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tingkat">Tingkat</label>
            <select name="tingkat" id="peran" class="form-control">
                <option value="">pilih</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bukti">Bukti <span class="text-danger">*</span></label>
            <input type="file" name="bukti" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
        </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <?php foreach($sertifikat as $item): ?>
                            <div class="col-3 text-center">
                                <a href="<?=DriveApi::getFile($item->bukti)?>" target="blank">
                                    <i class="fa fa-file text-center text-danger" style="font-size:24px"></i>
                                    <h6 class="text-bold text-secondary mt-2 text-center"><?=$item->peran?> (<?=$item->poin?>)</h6>
                                    <h6 class="text-bold text-secondary mt-2 text-center"><?=$item->kegiatan?> / <?=$item->tingkat?></h6>
                                    <span class="badge bg-<?=$item->is_approve == 1 ? 'primary' : 'danger'?>"><?=$item->is_approve == 1 ? 'Disetujui' : 'Belum disetujui'?></span>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <script>
            $(document).ready(function(){
                // select peran
                $("select[name='jenis']").on("change",function(){
                    let val = $(this).val()
                    $.ajax({
                        url:'<?=base_url('pasca/getPeran')?>',
                        type:'get',
                        dataType: "json",
                        data:{
                            kode:val
                        },
                        success:function(res){
                            console.log(res)
                            let peran = '<option value="">pilih</option>';
                            let tingkat = '<option value="">pilih</option>';
                            let resPeran = res.peran
                            let resTingkat = res.tingkat

                            if(resPeran.length > 0){
                                resPeran.map((el)=>{
                                    peran += `<option value="${el.Kode_Peran}">${el.Peran}</option>`;
                                })
                            }

                            if(resTingkat.length > 0){
                                resTingkat.map((el)=>{
                                    tingkat += `<option value="${el.Kode_Tingkat}">${el.Tingkat}</option>`;
                                })
                            }

                            $("select[name='peran']").html(peran)
                            $("select[name='tingkat']").html(tingkat)
                        }
                    })
                })
            })
        </script>
<?php else: ?>
<div class="card">
    <div class="card-body">
        <div class="alert alert-primary" role="alert">
            <ul>
                <li>Anda tidak dapat mengakses halaman pasca yudisium</li>
                <li>Halaman hanya bisa diakses ketika anda sudah melakukan pendadaran Tugas Akhir</li>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    $(document).ready(function(){
        $("#form-sertifikat").validate({
            rules: {
                    bukti: {
                        required: true,
                        extension: "pdf",
                    },
                    jenis:{
                        required:true,
                    },
                    peran:{
                        required:true,
                    },
                },
                messages: {
                    bukti: {
                        required: "Wajib Diisi",
                        extension: "File Harus PDF",
                    },
                    jenis: {
                        required: "Wajib Diisi",
                    },
                    peran: {
                        required: "Wajib Diisi",
                    },
                    tingkat: {
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