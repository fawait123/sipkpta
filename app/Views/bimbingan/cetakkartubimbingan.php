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
                KARTU BIMBINGAN
            </th>
        </tr>
        <tr>
            <td align="left">
                <font aria-setsize="2">Jl. Siliwangi (Ringroad Utara), Jombor, Yogyakarta <br>
                    Telp. : (0274) 623310 <br>
                    Fax. : (0274) 623306</font>
            </td>
            <th>
                S1- Sistem Informasi
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
            <th colspan="2" style="font-size: 24px; padding-bottom: 20px;">
                <?php if ($row->jenis == "KP") { ?>
                    KERJA PRAKTIK
                <?php } elseif ($row->jenis == "TA") { ?>
                    PROYEK TUGAS AKHIR
                <?php } ?>
                <br>
            </th>
        </tr>
    </table>
    <table align="center" width="700" border="1" style="border-collapse: collapse;">
        <tr>
            <th width="300" align="left" style="padding: 5px;">Nama Mahasiswa</th>
            <td style="text-transform: uppercase;  padding: 5px;"> <?= $row->nama_mahasiswa; ?></td>
        </tr>
        <tr>
            <th align="left" style="padding: 5px;">NPM</th>
            <td style="padding: 5px;"> <?= $row->npm; ?></td>
        </tr>
        <tr>
            <th align="left" style="padding: 5px;" height="60">Judul <?php if ($row->jenis == "KP") { ?>
                    Kerja Praktik
                <?php } elseif ($row->jenis == "TA") { ?>
                    Proyek Tugas Akhir
                <?php } ?></th>
            <td style="padding: 5px;"> <?= $row->judul_perubahan; ?>&nbsp;(Studi Kasus:&nbsp;<?= $row->studi_kasus; ?>)</td>
        </tr>
        <tr>
            <th align="left" style="padding: 5px;">Nama Dosen Pembimbing</th>
            <td style="padding: 5px;"> <?= $row->nama_dosen; ?></td>
        </tr>
        <?php $batas_bimbingan2 = date("d F Y", strtotime($row->batas_bimbingan)); ?>
        <tr>
            <th align="left" style="padding: 5px;">Terdaftar Pertama Kali</th>
            <td style="padding: 5px;"> Sampai dengan <?= $batas_bimbingan2; ?></td>
        </tr>
        <?php $batas_bimbingan_perpanjang2 = date("d F Y", strtotime($row->batas_bimbingan_perpanjang)); ?>
        <tr>
            <th align="left" style="padding: 5px;">Perpanjangan</th>
            <td style="padding: 5px;">
                <?php if ($row->status_perpanjang == "Perpanjang") { ?>
                    Sampai dengan <?= $batas_bimbingan_perpanjang2; ?>
                <?php } ?>
            </td>
        </tr>
    </table>
    <br>
    <table align="center" width="700">
        <tr>
            <th colspan="2">
                Catatan Bimbingan
            </th>
        </tr>
    </table>
    <br>
    <table align="center" width="700" border="1" style="border-collapse: collapse;">
        <tr>
            <th style="padding: 10px;">No.</th>
            <th style="padding: 10px;">Tanggal</th>
            <th style="padding: 10px;">Materi Bimbingan</th>
            <th style="padding: 10px;">Paraf</th>
        </tr>
        <?php $no=1; foreach($bimbingan as $b): ?>
            <tr>
                <td style="padding: 10px; text-align: center; height: 50px;"><?= $no++; ?></td>
                <td><?= date('d M Y',strtotime($b->tgl)) ?></td>
                <td><?= $b->materi ?></td>
                <td>&nbsp;&nbsp;&nbsp;</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <br>
    <br>
    <br>
    <?php if ($row->jenis == "KP") { ?>
        <table align="center" width="700">
            <tr>
                <th colspan="3" style="padding-bottom: 20px;">SEMINAR</th>
            </tr>
            <tr>
                <td colspan="3" style="padding: 10px; padding-bottom: 25px;">Dengan ini dinyatakan bimbingan Kerja Praktik telah selesai dan Laporan Kerja Praktik telah layak
                    diseminarkan. </td>
            </tr>
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
                <td height="75" width="350" align="center" style="vertical-align: top;">Dosen Pembimbing Kerja Praktik</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td align="center"><?= $row->nama_dosen; ?></td>
            </tr>
        </table>
    <?php } elseif ($row->jenis == "TA") { ?>
        <table align="center" width="700">
            <tr>
                <th colspan="3" style="padding-bottom: 20px;">UJIAN PENDADARAN</th>
            </tr>
            <tr style="padding-bottom: 50px;">
                <td colspan="3" style="padding: 10px; padding-bottom: 25px;">Dengan ini dinyatakan bimbingan Proyek Tugas Akhir telah selesai dan Laporan Proyek Tugas Akhir
                    telah layak untuk dilakukan ujian pendadaran.</td>
            </tr>
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
                <td height="75" width="350" align="center" style="vertical-align: top;">Dosen Pembimbing Proyek Tugas Akhir</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td align="center"><?= $row->nama_dosen; ?></td>
            </tr>
        </table>
    <?php } ?>
<?php endforeach; ?>
<script>
    <?php if ($title == "KARTU%20BIMBINGAN") { ?>
        document.title = "KARTU BIMBINGAN - <?= $nama_mahasiswa2; ?>";
    <?php } ?>
    window.addEventListener("load", window.print());
    str.replace(/%20/g, " ");
</script>

<body>

</body>

</html>