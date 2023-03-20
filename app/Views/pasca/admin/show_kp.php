<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
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
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">A fourth item</li>
                <li class="list-group-item">And a fifth one</li>
                <li class="list-group-item">And a fifth one</li>
                <li class="list-group-item">And a fifth one</li>
            </ul>
            </div>
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