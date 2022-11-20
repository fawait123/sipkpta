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
                        <a href="<?= site_url(''); ?>/Dashboard" class="nav-link">
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>/Register" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/AccPengajuan/accKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/AccPengajuan/accTA" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Perpanjang/pengajuanPerpanjang" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/ReviewProposal/tanggalReview" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tanggal Review</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Ploting/plotingKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Ploting/plotingTA" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Disposisi/disposisiKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Disposisi/disposisiTA" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Perpanjang/disposisi" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Pengajuan/rekapPengajuanKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rekap Pengajuan KP</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Pengajuan/rekapPengajuanTA" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rekap Pengajuan TA</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Ploting/rekapPloting" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Rekap Ploting</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Disposisi/rekapPembimbing" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganTA" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/pendaftaran/seminar" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/pendaftaran/pendadaran" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/perubahan/review-tanggal" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tanggal Perubahan</p>
                                </a>
                            </li>
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
                    </li>
                <?php
                } elseif ($role == "sekprod") {
                ?>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>/Pengajuan/pengajuanSekprod" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Nilai/nilaiKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Nilai/nilaiTA" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Proposal/proposalKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Proposal/proposalTA" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Disposisi/disposisi" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/pendaftaran/seminar" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/pendaftaran/pendadaran" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganTA" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/perubahan/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/perubahan/ta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                } elseif ($role == "admin") { ?>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>/Dashboard" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Mahasiswa" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Mahasiswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Dosen" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Dosen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Topik" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/TopikKuota/kuotaKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/TopikKuota/kuotaTA" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>/Persiapan" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Berkas/berkasKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Berkas/berkasTA" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Perpanjang/berkas" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Disposisi/disposisi" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganTA" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/perubahan/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/perubahan/ta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
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
                                <a href="<?= site_url(''); ?>/ReviewProposal/reviewKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/ReviewProposal/reviewTA" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Disposisi/disposisi" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganTA" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pendaftaran
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/pendaftaran/seminar" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/pendaftaran/pendadaran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendadaran Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->
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
                                <a href="<?= site_url(''); ?>/perubahan/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/perubahan/ta" class="nav-link">
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
                        <a href="<?= site_url(''); ?>/DataDiri" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Pengajuan/pengajuanKP" class="nav-link">
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
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganKP" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/Bimbingan/bimbinganTA" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Pendaftaran
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/pendaftaran/seminar" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seminar Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/pendaftaran/pendadaran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pendadaran Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>
                                Perubahan Judul
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/perubahan/kp" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kerja Praktik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url(''); ?>/perubahan/ta" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url(''); ?>/Perpanjang" class="nav-link">
                            <p>
                                Perpanjang
                            </p>
                        </a>
                    </li>
                <?php
                } ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>