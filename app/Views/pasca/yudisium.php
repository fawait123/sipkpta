<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
use App\Models\PengumpulanBerkasModel;
use App\Helpers\Utils;

$model = new PengumpulanBerkasModel();
$dataBerkas = $berkas ? json_decode($berkas->berkas) : [];  
$dataBerkas = Utils::filter($dataBerkas);
?>
<?php if($pendaftaran): ?>
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
                <td>Jumlah Point Sertifikat</td>
                <td>
                    10
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header">Upload Sertifikat Point 10 ++</div>
    <div class="card-body">
        <div class="form-group">
            <label for="peran">Peran</label>
            <select name="perant" id="peran" class="form-control">
                <option value="">pilih</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jenis">Jenis</label>
            <select name="perant" id="peran" class="form-control">
                <option value="">pilih</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tingkat">Tingkat</label>
            <select name="perant" id="peran" class="form-control">
                <option value="">pilih</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bukti">Bukti</label>
            <input type="file" name="bukti" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Simpan</button>
        </div>
    </div>
</div>
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