<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?>&nbsp;<?php $nama_mahasiswa ?></title>

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
<?php foreach ($tb_detail_review as $row) :
    $nama_mahasiswa2 = $row->nama_mahasiswa;
    $nama_dosen2 = $row->nama_dosen;
?>
    <table align="center" width="700">
        <tr>
            <th colspan="2">
                LEMBAR REVIEW PROPOSAL <?= $jenis; ?><br>
                <br>
            </th>
        </tr>
        <tr>
            <td width="120">Nama</td>
            <td>: <?= $row->nama_mahasiswa; ?></td>
        </tr>
        <tr>
            <td>NPM</td>
            <td>: <?= $row->npm; ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: Sistem Informasi, Program Sarjana</td>
        </tr>
        <tr>
            <td>Judul <?= $row->jenis; ?></td>
            <td>: <?= $row->judul; ?><?php if ($row->studi_kasus != null) { ?>
                &nbsp;(Studi Kasus:&nbsp;<?= $row->studi_kasus; ?>)
            <?php } ?></td>
        </tr>
    </table>
    <br>
    <table align="center" width="700">
        <tr>
            <th width="100" align="left">Bagian Awal</th>
            <td align="left"> (Cover s.d Daftar Istilah)</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <textarea cols="88" rows="5" style="resize: none;"></textarea>
            </td>
        </tr>
    </table>
    <table align="center" width="700">
        <tr>
            <th width="140" align="left">Bab I Pendahuluan</th>
            <td align="left"> (Latar Belakang s.d Manfaat Penelitian)</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <textarea cols="88" rows="5" style="resize: none;"></textarea>
            </td>
        </tr>
    </table>
    <table align="center" width="700">
        <tr>
            <th align="left">Bab II Kajian Hasil Penelitian & Landasan Teori</th>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <textarea cols="88" rows="5" style="resize: none;"></textarea>
            </td>
        </tr>
    </table>
    <table align="center" width="700">
        <tr>
            <th width="210" align="left">Bab III Metodologi Penelitian</th>
            <td align="left"> (Metodologi Penelitian, Jadwal)</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <textarea cols="88" rows="5" style="resize: none;"></textarea>
            </td>
        </tr>
    </table>
    <table align="center" width="700">
        <tr>
            <th width="100" align="left">Bagian Akhir</th>
            <td align="left"> (Daftar Pustaka & Lampiran)</td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <textarea cols="88" rows="5" style="resize: none;"></textarea>
            </td>
        </tr>
    </table>
    <table align="center" width="700">
        <tr>
            <td width="225"></td>
            <td width="225"></td>
            <td align="center">
                <?php
                $now = date('Y'); ?>
                Yogyakarta, .................... <?= $now; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td height="75" width="300" align="center" style="vertical-align: top;">Dosen Reviewer</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center"><?= $row->nama_dosen; ?></td>
        </tr>
    </table>
<?php endforeach; ?>
<script>
    document.title = "LEMBAR REVIEW <?= $nama_mahasiswa2; ?> - <?= $nama_dosen2; ?>";
    window.addEventListener("load", window.print());
    str.replace(/%20/g, " ");
</script>

<body>

</body>

</html>