<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<?php
$session = session();
$success = $session->getFlashdata('success');
?>

<?php if ($success != null) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php
        foreach ($success as $succ) {
            echo $succ . '<br>';
        }
        ?>
    </div>
<?php endif ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-body" style="padding-left: 50px;">
                        <form action="<?= base_url(''); ?>/ReviewProposal/updateTanggalReview" id="formedittanggal" method="post">
                            <?php foreach ($tanggal as $row) : ?>
                                <div class="form-group">
                                    <label>Tanggal Buka</label>
                                    <div class="input-group date" id="start" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#start" name="start" value="<?= $row->start; ?>" />
                                        <div class="input-group-append" data-target="#start" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Tutup</label>
                                    <div class="input-group date" id="end" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#end" name="end" value="<?= $row->end; ?>" />
                                        <div class="input-group-append" data-target="#end" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?= $row->id; ?>">
                                    <button type="submit" class="btn btn-primary float-right">Update</button>
                                </div>
                            <?php endforeach; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {

        $('#start').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true
        });

        $('#end').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD HH:mm:ss',
            sideBySide: true,
            useCurrent: false
        });

        $("#start").on("change.datetimepicker", function(e) {
            $('#end').datetimepicker('minDate', e.date);
        });

        $("#end").on("change.datetimepicker", function(e) {
            $('#start').datetimepicker('maxDate', e.date);
        });
    });
</script>

<?= $this->endsection(); ?>