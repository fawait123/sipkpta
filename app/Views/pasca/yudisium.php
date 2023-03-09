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
                <label for="Naskah">Naskah</label>
                <input type="file" class="form-control" placeholder="Naskah" />
            </div>
            <div class="form-group">
                <label for="Database">Database</label>
                <input type="file" class="form-control" placeholder="Database" />
            </div>
            <div class="form-group">
                <label for="Inforgrafis Editable">Inforgrafis Editable</label>
                <input type="file" class="form-control" placeholder="Inforgrafis Editable" />
            </div>
            <div class="form-group">
                <label for="Database">Infografis Non Editable</label>
                <input type="file" class="form-control" placeholder="Database" />
            </div>
            <div class="form-group">
                <label for="Program">Program</label>
                <input type="file" class="form-control" placeholder="Program" />
                <span class="text-secondary">*Tidak Wajib</span>
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