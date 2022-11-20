<?php

use App\Models\NotifikasiModel;


function sendNotif($transfer, $receive, $notifikasi, $url)
{
    $data = [
        'transfer' => $transfer,
        'receive' => $receive,
        'notif' => $notifikasi,
        'url' => base_url($url),
        'status'=>'unread'
    ];
    $notif = new NotifikasiModel();
    $notif->insert($data);
}
