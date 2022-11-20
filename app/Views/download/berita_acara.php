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
            LEMBAR BERITA ACARA <?= $detail->jenis ?><br>
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
        <td>: <?= $detail->jenis ?>&nbsp;(Studi Kasus:<?= $detail->no_perubahan != '' && $detail->status_dosen == 'acc' && $detail->status_prodi == 'acc' ? $detail->judul_perubahan : $detail->judul ?>&nbsp;<?= $detail->studi_kasus ?>)</td>
    </tr>
</table>
<br>
<table align="center">
    <tr>
        <td align="center" style="padding:10px ; border:1px solid black;">Revisi s/d Tanggal........</td>
    </tr>
    <tr>
        <td align="center" style="padding:10px; border:1px solid black;"><i>Jika revisi melewati tanggal tersebut maka wajib <u>seminar ulang</u></i></td>
    </tr>
</table>
<table align="left" style="margin-top: 80px;margin-left: 20%;">
    <tr>
        <th style="padding-bottom:60px; font-weight: normal;">Dosen Pembimbing</th>
    </tr>
    <tr>
        <td align="center">Umar Zaky</td>
    </tr>
</table>
<table align="right" style="margin-top: 80px; margin-right: 20%;">
    <tr>
        <th style="padding-bottom:60px ;font-weight: normal;">Yogyakarta, <?= date('d M Y') ?> <br>Mahasiswa</th>
    </tr>
    <tr>
        <td align="center"><?= $detail->nama_mahasiswa ?></td>
    </tr>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<h6 style="text-align: right; margin-right: 26%;">1. Untuk Mhs</h6>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
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
            LEMBAR BERITA ACARA <?= $detail->jenis ?><br>
            <br>
        </th>
    </tr>
    <tr>
        <td colspan="5">
            <p>Pada hari ini 25 Maret 2022 dilaksanakan Seminar Kerja Praktik bagi Mahasiswa:</p>
        </td>
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
        <td>Program Pendidikan</td>
        <td>: Sarjana</td>
    </tr>
    <tr>
        <td>Fakultas</td>
        <td>: Sains & Teknologi</td>
    </tr>
    <tr>
        <td>Judul</td>
        <td>: <?= $detail->no_perubahan != '' && $detail->status_dosen == 'acc' && $detail->status_prodi == 'acc' ? $detail->judul_perubahan : $detail->judul ?></td>
    </tr>
    <tr>
        <td colspan="5">
            <p>dengan hasil nilai huruf :</p>
        </td>
    </tr>
    <tr>
        <td colspan="5" style="padding-left: 20px;">1. Lulus Tanpa Syarat (Nilai A)</td>
    </tr>
    <tr>
        <td colspan="5" style="padding-left: 20px;">2. Lulus Bersyarat (Nilai B/C)</td>
    </tr>
    <tr>
        <td colspan="5" style="padding-left: 20px;">3. Lulus Lulus/Mengulang (Nilai D)</td>
    </tr>
</table>
<table align="left" style="margin-top: 80px;margin-left: 20%;">
    <tr>
        <th style="padding-bottom:60px; font-weight: normal;">Dosen Pembimbing</th>
    </tr>
    <tr>
        <td align="center"><?= $detail->nama_dosen ?></td>
    </tr>
</table>
<table align="right" style="margin-top: 80px; margin-right: 20%;">
    <tr>
        <th style="padding-bottom:60px ;font-weight: normal;">Yogyakarta, <?= date('d M Y') ?> <br>Mahasiswa</th>
    </tr>
    <tr>
        <td align="center"><?= $detail->nama_mahasiswa ?></td>
    </tr>
</table>
<table align="center" style="margin-top: 30%;">
    <tr>
        <th style="padding-bottom:60px ;font-weight: normal;">Mengetahui <br>Kaprodi Sistem Informasi</th>
    </tr>
    <tr>
        <td align="center">Umar Zaky, S.Kom., M.Cs</td>
    </tr>
</table>
<h6 style="text-align: right; margin-right: 26%;">2. Arsip Prodi</h6>
<br>
<br>
<br>
<br>
<br>
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
            LEMBAR BERITA ACARA <?= $detail->jenis ?><br>
            <br>
        </th>
    </tr>
    <tr>
        <td colspan="5">
            <p>Pada hari ini 25 Maret 2022 dilaksanakan Seminar Kerja Praktik bagi Mahasiswa:</p>
        </td>
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
        <td>Program Pendidikan</td>
        <td>: Sarjana</td>
    </tr>
    <tr>
        <td>Fakultas</td>
        <td>: Sains & Teknologi</td>
    </tr>
    <tr>
        <td>Judul</td>
        <td>: <?= $detail->no_perubahan != '' && $detail->status_dosen == 'acc' && $detail->status_prodi == 'acc' ? $detail->judul_perubahan : $detail->judul ?></td>
    </tr>
    <tr>
        <td colspan="5">
            <p>dengan hasil nilai huruf :</p>
        </td>
    </tr>
    <tr>
        <td colspan="5" style="padding-left: 20px;">1. Lulus Tanpa Syarat (Nilai A)</td>
    </tr>
    <tr>
        <td colspan="5" style="padding-left: 20px;">2. Lulus Bersyarat (Nilai B/C)</td>
    </tr>
    <tr>
        <td colspan="5" style="padding-left: 20px;">3. Lulus Lulus/Mengulang (Nilai D)</td>
    </tr>
</table>
<table align="left" style="margin-top: 80px;margin-left: 20%;">
    <tr>
        <th style="padding-bottom:60px; font-weight: normal;">Dosen Pembimbing</th>
    </tr>
    <tr>
        <td align="center"><?= $detail->nama_dosen ?></td>
    </tr>
</table>
<table align="right" style="margin-top: 80px; margin-right: 20%;">
    <tr>
        <th style="padding-bottom:60px ;font-weight: normal;">Yogyakarta, <?= date('d M Y') ?><br>Mahasiswa</th>
    </tr>
    <tr>
        <td align="center"><?= $detail->nama_mahasiswa ?></td>
    </tr>
</table>
<table align="center" style="margin-top: 30%;">
    <tr>
        <th style="padding-bottom:60px ;font-weight: normal;">Mengetahui <br>Kaprodi Sistem Informasi</th>
    </tr>
    <tr>
        <td align="center">Umar Zaky, S.Kom., M.Cs</td>
    </tr>
</table>
<h6 style="text-align: right; margin-right: 26%;">3. Arsip BO</h6>
<script>
    <?php if ($title == "BERITA%20ACARA") { ?>
        document.title = "BERITA ACARA - <?= $detail->nama_mahasiswa ?>";
    <?php } else { ?>
        document.title = "BERITA ACARA - <?= $detail->nama_mahasiswa ?>";
    <?php } ?>
    window.addEventListener("load", window.print());
    str.replace(/%20/g, " ");
</script>

<body>

</body>

</html>