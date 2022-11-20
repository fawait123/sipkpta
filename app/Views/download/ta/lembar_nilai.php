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
            LEMBAR REVIEW TUGAS AKHIR<br>
            <br>
        </th>
    </tr>
    <tr>
        <td colspan="5">Pada hari ini Jumat, 25 Maret 2022 dilaksanakan Seminar Tugas Akhir bagi Mahasiswa :</td>
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
        <td>Judul TA</td>
        <td>: <?= $detail->no_perubahan != '' && $detail->status_dosen == 'acc' && $detail->status_prodi == 'acc' ? $detail->judul_perubahan : $detail->judul ?></td>
    </tr>
</table>
<table border="1" width="700" align="center" style="margin-top: 40px;">
    <tr>
        <td style="padding: 5px; text-align: center;" colspan="3">Nilai Tugas Akhir</td>
    </tr>
    <tr>
        <td style="padding: 5px; text-align: center;" colspan="3">Beri nilai tanpa melebihi nilai maksimum</td>
    </tr>
    <tr>
        <td>Penyajian Materi Presenstasi</td>
        <td>Max : 15</td>
        <td>
            <?php for ($i = 1; $i <= 30; $i++) : ?>
                &nbsp;
            <?php endfor; ?>
        </td>
    </tr>
    <tr>
        <td>Kemampuan Interaksi</td>
        <td>Max : 25</td>
        <td>
            <?php for ($i = 1; $i <= 30; $i++) : ?>
                &nbsp;
            <?php endfor; ?>
        </td>
    </tr>
    <tr>
        <td>Kerapian Berpenampilan</td>
        <td>Max : 15</td>
        <td>
            <?php for ($i = 1; $i <= 30; $i++) : ?>
                &nbsp;
            <?php endfor; ?>
        </td>
    </tr>
    <tr>
        <td>Format Penulisan</td>
        <td>Max : 20</td>
        <td>
            <?php for ($i = 1; $i <= 30; $i++) : ?>
                &nbsp;
            <?php endfor; ?>
        </td>
    </tr>
    <tr>
        <td>Kualitas Hasil Penelitian</td>
        <td>Max : 25</td>
        <td>
            <?php for ($i = 1; $i <= 30; $i++) : ?>
                &nbsp;
            <?php endfor; ?>
        </td>
    </tr>
    <tr>
        <td>Jumlah Total</td>
        <td></td>
        <td>
            <?php for ($i = 1; $i <= 30; $i++) : ?>
                &nbsp;
            <?php endfor; ?>
        </td>
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
<table width="200" align="left" style="margin-left: 24%; margin-top: 20px;">
    <tr>
        <td style="text-align: center;"><?= $u->title ?></td>
    </tr>
    <tr>
        <td style="padding-top: 80px; text-align:center"><?= $u->nama_dosen ?></td>
    </tr>
</table>
<table border="1" align="right" style="margin-right: 25%; margin-top: 20px;">
    <tr>
        <td>100 - 81&nbsp;&nbsp;&nbsp;</td>
        <td>A&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td>80 - 61&nbsp;&nbsp;&nbsp;</td>
        <td>B&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td>60 - 41&nbsp;&nbsp;&nbsp;</td>
        <td>C&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td>
            < 41&nbsp;&nbsp;&nbsp;</td>
        <td>D&nbsp;&nbsp;&nbsp;</td>
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
<br>
<br>
<br>
<br>
<table width="700" align="center" style="margin-top: 80px;">
    <tr>
        <td>
            Catatan : <br>
            <ol>
                <li>
                    Penyajian Materi Meliputi : <br>
                    <ol type="a">
                        <li>Media : Komputer (misal : Power Point / Flash)</li>
                        <li>
                            Ringkasan Meliputi : <br>
                            <ol type="i">
                                <li>Ruang Lingkup / Batasan Masalah</li>
                                <li>Permasalahan</li>
                                <li>Pemecahan dengan teknik-teknik yang digunakan dengan memberikan contoh kasus.</li>
                                <li>Kesimpulan dari Tugas Akhir yang dibuat.</li>
                            </ol>
                        </li>
                    </ol>
                </li>
                <li>Kemampuan Interaksi Tanya Jawab dengan Peserta Seminar</li>
                <li>Kerapian Berpenampilan (lihat tata tertib).</li>
                <li>
                    Format Penulisan meliputi : <br>
                    <ol type="a">
                        <li>Kelengkapan penulisan dari lembar judul sampai lampiran.</li>
                        <li>Format penulisan yang berlaku (termasuk spasi dan jumlah halaman).</li>
                    </ol>
                </li>
                <li>
                    Kualitas Hasil Penulisan meliputi : <br>
                    <ol type="a">
                        <li>Penguasaan permasalahan yang dihadapi.</li>
                        <li>Cara penyelesaian masalah dengan contoh-contoh.</li>
                        <li>Bobot materi Tugas Akhir.</li>
                    </ol>
                </li>
            </ol>
        </td>
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
<?php endforeach; ?>
<script>
    <?php if ($title == "LEMBAR%20NILAI") { ?>
        document.title = "LEMBAR NILAI - <?=$detail->nama_mahasiswa?>";
    <?php } else { ?>
        document.title = "LEMBAR NILAI - <?=$detail->nama_mahasiswa?>";
    <?php } ?>
    window.addEventListener("load", window.print());
    str.replace(/%20/g, " ");
</script>

<body>

</body>

</html>