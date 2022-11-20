<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

</head>
<?php

use CodeIgniter\I18n\Time; ?>
<style>
    @page {
        size: auto;
        margin: 0mm;
    }
</style>
<?php foreach ($tb_disposisi as $row) : $nama_mahasiswa2 = $row->nama_mahasiswa; ?>
    <br>
    <table align="center" width="700">
        <tr>
            <th rowspan="2"><img src="<?= base_url(''); ?>/gambar/logouty.png" width="70" height="70"></th>
            <th align="left">
                <font aria-setsize="4">UNIVERSITAS TEKNOLOGI YOGYAKARTA <br>
                    FAKULTAS SAINS & TEKNOLOGI (FST) <br>
                </font>
            </th>
            <th>
                LOG BOOK
            </th>
        </tr>
        <tr>
            <td align="left">
                <font aria-setsize="2">Jl. Siliwangi (Ringroad Utara), Jombor, Yogyakarta <br>
                    Telp. : (0274) 623310 <br>
                    Fax. : (0274) 623306</font>
            </td>
            <th>
                KEGIATAN <br>
                KERJA PRAKTIK/ <br>
                PROYEK TUGAS Akhir <br>
                S1 Sistem Informasi <br>
            </th>
        </tr>
        <tr>
            <td colspan="3">
                <hr style="border: 1px solid black;">
            </td>
        </tr>
    </table>
    <table align="center" width="700">
        <tr>
            <th width="200" align="left" style="padding: 5px;">Nama Perusahaan/Instansi</th>
            <td>: _____________________________</td>
        </tr>
        <tr>
            <th align="left" style="padding: 5px;">No. Pokok Mahasiswa</th>
            <td>: <?= $row->npm; ?></td>
        </tr>
        <tr>
            <th align="left" style="padding: 5px;">Nama Mahasiswa</th>
            <td>: <?= $row->nama_mahasiswa; ?></td>
        </tr>
    </table>
    <br>
    <table align="center" width="700" border="1" style="border-collapse: collapse;">
        <tr>
            <th style="padding: 10px;" width="30px">No.</th>
            <th style="padding: 10px;" width="130px">Tanggal</th>
            <th style="padding: 10px;" width="300px">Kegiatan</th>
            <th style="padding: 10px;">Tandatangan & Cap Instansi</th>
        </tr>
        <tr>
            <td style="padding: 10px; text-align: center; height: 650px;"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
<?php endforeach; ?>
<script>
    <?php if ($title == "LOG%20BOOK") { ?>
        document.title = "LOG BOOK - <?= $nama_mahasiswa2; ?>";
    <?php } ?>
    window.addEventListener("load", window.print());
    str.replace(/%20/g, " ");
</script>

<body>

</body>

</html>