<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div>
            <div class="timeline-item">

                <div class="timeline-body">
                    <ul class="list-group">
                        <?php
                        $krs = explode('/', $berkas->berkas_krs ?? '');
                        $krs = end($krs);
                        $pembayaran = explode('/', $berkas->berkas_pembayaran ?? '');
                        $pembayaran = end($pembayaran);
                        $toefle = explode('/', $berkas->berkas_toefle ?? '');
                        $toefle = end($toefle);
                        $rekomendasi = explode('/', $berkas->berkas_rekomendasi ?? '');
                        $rekomendasi = end($rekomendasi);
                        $sertifikat = explode('/', $berkas->berkas_sertifikat ?? '');
                        $sertifikat = end($sertifikat);
                        $abstrak = explode('/', $berkas->berkas_abstrak ?? '');
                        $abstrak = end($abstrak);
                        $pustaka = explode('/', $berkas->berkas_pustaka ?? '');
                        $pustaka = end($pustaka);
                        ?>
                        <li class="list-group-item">Kode Pendaftaran <b>#<?= $berkas->kd_pendaftaran ?? '' ?></b></li>
                        <li class="list-group-item">Nama : <?= $berkas->nama_mahasiswa ?? '' ?></li>
                        <li class="list-group-item">Jenis : <?= $berkas->jenis ?? '' ?></li>
                        <li class="list-group-item">Berkas KRS : <a href="<?= base_url($berkas->berkas_krs ?? '') ?>" target="blank" class="text-danger"><?= $krs ?>&nbsp;<i class="fa fa-file-pdf"></i></a></li>
                        <li class="list-group-item">Berkas Pembayaran : <a href="<?= base_url($berkas->berkas_pembayaran ?? '') ?>" target="blank" class="text-danger"> <?= $pembayaran ?>&nbsp;<i class="fa fa-file-pdf"></i></a></li>
                        <li class="list-group-item">Status : <?= $berkas->status ?? '' == "acc" ? '<span class="badge bg-primary">ACC</span>' : '<span class="badge bg-danger">Belum ACC</span>' ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>