<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="col-md-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Kelola Notifikasi</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Search Mail">
                    <div class="input-group-append">
                        <div class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <tbody>
                        <?php if(count($notifikasi)>0): ?>
                        <?php foreach ($notifikasi as $notif) : ?>
                            <tr>
                                <td>
                                    <div class="">
                                        <input class="status" data-id="<?=$notif->id?>" type="checkbox" value="" id="check<?= $notif->id ?>" <?= $notif->status == 'read' ? 'checked' : '' ?> <?= $notif->status == 'read' ? 'disabled' : '' ?>>
                                        <label for="check1"></label>
                                    </div>
                                </td>
                                <?php if ($notif->status == 'read') : ?>
                                    <td class="mailbox-star"><a href="#"><i class="fas fa-eye-slash text-secondary"></i></a></td>
                                <?php else : ?>
                                    <td class="mailbox-star"><a href="#"><i class="fas fa-eye text-dark"></i></a></td>
                                <?php endif; ?>
                                <td class="mailbox-name">
                                    <?php if ($notif->transfer == 'KPD001') : ?>
                                        <span class="<?= $notif->status == 'read' ? 'text-secondary' : 'text-dark' ?>">KAPRODI</span>
                                    <?php else : ?>
                                        <span class="<?= $notif->status == 'read' ? 'text-secondary' : 'text-dark' ?>"><?= $notif->nama_mahasiswa != '' ? $notif->nama_mahasiswa : $notif->nama_dosen  ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="mailbox-subject"><?= $notif->notif ?>
                                </td>
                                <td class="mailbox-attachment"></td>
                                <td class="mailbox-date"><?= date('d M Y', strtotime($notif->created_at)) ?>, <?= date('H:i', strtotime($notif->created_at)) ?> WIB</td>
                                <td>
                                    <div class="btn-group">
                                        <a onclick="return confirm('apakah anda yakin ?')" href="<?= base_url('notifcontroller/destroy/'.$notif->id) ?>" class="btn btn-default btn-sm">
                                            <i class="far fa-trash-alt"></i>
                                    </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" align="center">Tidak ada notifikasi</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->

<script>
    $(document).on('change','.status',function(){
        let id = $(this).data('id');
        $.ajax({
            url:'<?=base_url('notifcontroller/updatestatus')?>',
            type:'post',
            data:{
                id:id
            },
            success:function(res){
                if(res=='berhasil'){
                    window.location.href='<?=base_url('notifcontroller/all')?>?withmsg=1';
                }
            }
        });
    });
</script>
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        toastr.info('<?= session()->getFlashdata('pesan') ?>')
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <script>
        toastr.error('<?= session()->getFlashdata('error') ?>')
    </script>
<?php endif; ?>
<?= $this->endsection(); ?>