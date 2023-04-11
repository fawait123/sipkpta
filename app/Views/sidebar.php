<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link elevation-4">
        <img src="<?= base_url(''); ?>/gambar/logouty.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIP KPTA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <?php foreach ($user as $row) : ?>
                <div class="image">
                    <img src="<?= base_url(''); ?>/foto/profile/profile.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= $row->username ?><br>
                        <?php if ($role == "kaprodi") {
                            echo $row->nama_kaprodi;
                        } elseif ($role == "sekprod") {
                            echo $row->nama_sekprod;
                        } elseif ($role == "admin") {
                            echo $row->nama_admin;
                        } elseif ($role == "dosen") {
                            echo $row->nama_dosen;
                        } elseif ($role == "mahasiswa") {
                            echo $row->nama_mahasiswa;
                        } ?>
                    </a>
                </div>
            <?php endforeach ?>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <?php if ($role == "kaprodi") {
                ?>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>dashboard" class="nav-link">
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>register" class="nav-link">
                            <p>
                                Data User
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Acc Pengajuan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>accpengajuan/acckp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>accpengajuan/accta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perpanjang/pengajuanperpanjang" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Perpanjang</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Ploting Dosen Reviewer
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>reviewProposal/tanggalreview" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tanggal Review</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>ploting/plotingkp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>ploting/plotingta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Disposisi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>disposisi/disposisikp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>disposisi/disposisita" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perpanjang/disposisi" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Perpanjang</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Rekap Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pengajuan/rekappengajuankp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rekap Pengajuan KP</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pengajuan/rekappengajuanta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rekap Pengajuan TA</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>ploting/rekapploting" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rekap Ploting</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>disposisi/rekappembimbing" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rekap Disposisi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Bimbingan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbingankp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbinganta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pendaftaran
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/seminar" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/pendadaran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendadaran Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Perubahan Judul
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/review-tanggal" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tanggal Perubahan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/ta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                } elseif ($role == "sekprod") {
                ?>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>pengajuan/pengajuansekprod" class="nav-link">
                            <p>
                                Tambah Pengajuan KP
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Cek Nilai
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>nilai/nilaikp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>nilai/nilaita" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Cek Proposal
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>proposal/proposalkp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>proposal/proposalta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Rekap Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>disposisi/disposisi" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Rekap Disposisi
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pendaftaran
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/seminar" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/pendadaran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendadaran Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Perubahan Judul
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/PerubahanJudul/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/PerubahanJudul/ta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Bimbingan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbingankp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbinganta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Perubahan Judul
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/ta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                } elseif ($role == "admin") { ?>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>dashboard" class="nav-link">
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>mahasiswa" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Mahasiswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>dosen" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Dosen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>topik" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Topik</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Topik dan Kuota
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>topikkuota/kuotakp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>topikkuota/kuotata" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>persiapan" class="nav-link">
                            <p>
                                Persiapan Pengajuan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Cek Berkas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>berkas/berkaskp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>berkas/berkasta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perpanjang/berkas" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Perpanjang</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('admin/pengajuan/kp'); ?>" class="nav-link">
                            <p>
                                Ubah Status Pengajuan
                            </p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pengajuan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('admin/pengajuan/kp'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Pengajuan/pengajuanTA" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Rekap Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>disposisi/disposisi" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Rekap Disposisi
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Bimbingan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbingankp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbinganta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Perubahan Judul
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/ta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pendaftaran
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/seminar" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/pendadaran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendadaran Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pasca
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('admin/pasca/kerjapraktik'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('admin/pasca/tugasakhir'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ujian Pendadaran Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('admin/pasca/yudisium'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendaftaran Yudisium</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } elseif ($role == "dosen") {
                ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Review Proposal
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>reviewProposal/reviewkp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>reviewProposal/reviewta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Rekap Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>disposisi/disposisi" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Rekap Disposisi
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Bimbingan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbingankp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbinganta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pendaftaran
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/seminar" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/pendadaran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendadaran Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a href="#" class="nav-link">-->
                    <!--        <p>-->
                    <!--            Perubahan Judul-->
                    <!--            <i class="right fas fa-angle-left"></i>-->
                    <!--        </p>-->
                    <!--    </a>-->
                    <!--    <ul class="nav nav-treeview">-->
                    <!--        <li class="nav-item">-->
                    <!--            <a href="<?= site_url(''); ?>/PerubahanJudul/kp" class="nav-link">-->
                    <!--                <i class="far fa-circle nav-icon"></i>-->
                    <!--                <p>Kerja Praktik</p>-->
                    <!--            </a>-->
                    <!--        </li>-->
                    <!--        <li class="nav-item">-->
                    <!--            <a href="<?= site_url(''); ?>/PerubahanJudul/ta" class="nav-link">-->
                    <!--                <i class="far fa-circle nav-icon"></i>-->
                    <!--                <p>Tugas Akhir</p>-->
                    <!--            </a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Perubahan Judul
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/ta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                } elseif ($role == "mahasiswa") {
                ?>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>datadiri" class="nav-link">
                            <p>
                                Data Diri
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pengajuan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pengajuan/pengajuankp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pengajuan/pengajuanta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Bimbingan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbingankp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>bimbingan/bimbinganta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pendaftaran
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/seminar" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>pendaftaran/pendadaran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendadaran Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Perubahan Judul
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>perubahan/ta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>perpanjang" class="nav-link">
                            <p>
                                Perpanjang
                            </p>
                        </a>
                    </li>
                    <?php if(getEnv('CI_ENVIRONMENT') == 'development') : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pasca
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('pasca/kerjapraktik'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('pasca/tugasakhir'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ujian Pendadaran Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('pasca/yudisium'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendaftaran Yudisium</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                <?php
                } ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>