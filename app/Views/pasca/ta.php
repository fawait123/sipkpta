<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <form action="" enctype="multipart-form-data">
            <div class="form-group">
                <label for="Abstrak">Abstrak</label>
                <input type="file" class="form-control" placeholder="Abstrak" />
            </div>
            <div class="form-group">
                <label for="Daftar Pustaka">Daftar Pustaka</label>
                <input type="file" class="form-control" placeholder="Daftar Pustaka" />
            </div>
            <div class="form-group">
                <label for="Laporan TA">Laporan TA</label>
                <input type="file" class="form-control" placeholder="Laporan TA" />
            </div>
            <div class="form-group">
                <label for="Lembar Pengesahan">Lembar Pengesahan</label>
                <input type="file" class="form-control" placeholder="Lembar Pengesahan" />
            </div>
            <div class="form-group">
                <label for="Program">Program</label>
                <input type="file" class="form-control" placeholder="Program" />
            </div>
            <div class="form-group">
                <label for="Database">Database</label>
                <input type="file" class="form-control" placeholder="Database" />
            </div>
            <div class="form-group">
                <label for="Inforgrafis">Inforgrafis Editable</label>
                <input type="file" class="form-control" placeholder="Inforgrafis" />
            </div>
            <div class="form-group">
                <label for="Infografis Non Editable">Infografis Non Editable</label>
                <input type="file" class="form-control" placeholder="Infografis Non Editable" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Simpan</button>
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