<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <h1>Data Diri</h1>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="" enctype="multipart-form-data">
            <div class="form-group">
                <label for="Foto">Foto</label>
                <input type="file" name="foto" class="form-control" placeholder="Foto" />
            </div>
            <div class="form-group">
                <label for="Berita_acara">Scan Berita Acara Ujian Pendadaran</label>
                <input type="file" name="berita_acara" class="form-control" placeholder="Berita_acara" />
            </div>
            <div class="form-group">
                <label for="Database">Scan Surat Rekomendasi Kaprodi</label>
                <input type="file" name="surat_rekomendasi" class="form-control" placeholder="Database" />
            </div>
            <div class="form-group">
                <label for="Inforgrafis Editable">Scan Sertifikat Toefle</label>
                <input type="file" name="sertifikat_toefle" class="form-control" placeholder="Inforgrafis Editable" />
            </div>
            <div class="form-group">
                <input type="checkbox" name="persetujuan">* Data yang diisikan sudah benar
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
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