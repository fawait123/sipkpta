<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?>&nbsp; <?= $detail->nama_mahasiswa ?></title>

</head>
<?php

use CodeIgniter\I18n\Time; ?>
<style>
    @page {
        size: auto;
        margin: 0mm;
    }
</style>
<?php foreach($ujian as $u): ?>
<br>
<table align="center" width="700">
    <tr>
        <th rowspan="2"><img src="<?= base_url(''); ?>/gambar/logouty.png" width="70" height="70"></th>
        <th align="left">
            <font aria-setsize="4">UNIVERSITAS TEKNOLOGI YOGYAKARTA <br>
                FAKULTAS SAINS & TEKNOLOGI (FST) <br>
            </font>
        </th>
    </tr>
    <tr>
        <td align="left">
            <font aria-setsize="2">Jl. Siliwangi (Ringroad Utara), Jombor, Yogyakarta <br>
                Telp. : (0274) 623310 <br>
                Fax. : (0274) 623306</font>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr>
        </td>
    </tr>
</table>

<table align="center" width="700">
    <tr>
        <th colspan="2">
            LEMBAR REVISI<br>
            <br>
        </th>
    </tr>
    <tr>
        <td width="120">Nama</td>
        <td>: <?= $detail->nama_mahasiswa ?></td>
    </tr>
    <tr>
        <td>NPM</td>
        <td>: <?= $detail->npm ?></td>
    </tr>
    <tr>
        <td>Program Studi</td>
        <td>: Sistem Informasi, Program Sarjana</td>
    </tr>
    <tr>
        <td>Judul KP</td>
        <td>: <?= $detail->no_perubahan != '' && $detail->status_dosen == 'acc' && $detail->status_prodi == 'acc' ? $detail->judul_perubahan : $detail->judul ?></td>
    </tr>
</table>

<table width="700" align="center" style="margin-top: 20px;">
    <tr>
        <th align="left" style="font-weight: normal;">Bagian yang perlu direvisi</th>
        <th align="left" style="font-weight: normal;">Hasil revisi</th>
    </tr>
    <tr>
        <td>
            <?php for ($i = 1; $i <= 1000; $i++) : ?>
                <?php echo '.'; ?>
            <?php endfor; ?>
        </td>
        <td>
            <?php for ($i = 1; $i <= 1000; $i++) : ?>
                <?php echo '.'; ?>
            <?php endfor; ?>
        </td>
    </tr>
</table>
<table width="700" align="center" style="margin-top: 20px;">
    <tr>
        <th align="left" style="font-weight: normal; padding-bottom:80px;">Yogyakarta, <?= date('d M Y') ?> <br>
            Dosen Penguji,
        </th>
        <th align="right" style="font-weight: normal; padding-bottom:80px;">Setelah memeriksa hasil revisi, <br>
        Kerja Praktik atas nama mahasiswa <br>
        tersebut di atas dinyatakan LAYAK
        </th>
    </tr>
    <tr>
        <td align="left"><?= $u->nama_dosen ?></td>
        <td align="right"><?= $u->nama_dosen ?></td>
    </tr>
</table>
<br>
<br>
<br>
<br>
<br>
<?php endforeach; ?>
<script>
    <?php if ($title == "LEMBAR%20REVISI") { ?>
        document.title = "LEMBAR REVISI - <?=$detail->nama_mahasiswa?>";
    <?php } else { ?>
        document.title = "LEMBAR REVISI - <?=$detail->nama_mahasiswa?>";
    <?php } ?>
    window.addEventListener("load", window.print());
    str.replace(/%20/g, " ");
</script>

<body>

</body>

</html>