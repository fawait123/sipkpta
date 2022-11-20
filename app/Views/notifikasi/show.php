<?php if(count($notifikasi) > 0): ?>
    <?php foreach ($notifikasi as $notif) : ?>
    <div class="dropdown-divider"></div>
    <a href="<?= $notif->url ?>" class="dropdown-item list-notif" data-id="<?= $notif->id ?>">
        <div class="media">
            <img src="<?= base_url(''); ?>/gambar/logouty.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
                <?php if($notif->transfer=='KPD001'): ?>
                    <h3 class="dropdown-item-title">KAPRODI<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span></h3>
                <?php else: ?>
                    <h3 class="dropdown-item-title"><?= $notif->nama_mahasiswa != '' ? $notif->nama_mahasiswa : $notif->nama_dosen  ?><span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span></h3>
                <?php endif; ?>
                <p class="text-sm"><?= $notif->notif ?></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?= date('d M Y', strtotime($notif->created_at)) ?> <?= date('H:i',strtotime($notif->created_at)) ?> WIB</p>
            </div>
        </div>
    </a>
    <div class="dropdown-divider"></div>
<?php endforeach; ?>
<a href="<?= base_url('notifcontroller/all') ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
<?php else: ?>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <div class="media">
            <img src="<?= base_url(''); ?>/gambar/logouty.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
                <h3 class="dropdown-item-title">Upps...<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span></h3>
                <p class="text-sm">TIdak ada notifikasi</p>
            </div>
        </div>
    </a>
    <div class="dropdown-divider"></div>
<a href="<?= base_url('notifcontroller/all') ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
<?php endif; ?>