<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="far fa-clock"></i>
                    <span class="float-right text-sm" id="jam"></span>
                </a>
                <div class="dropdown-divider"></div>

                <?php foreach ($user as $row) : ?>
                    <a href="<?= base_url('') ?>/MyProfile" class="dropdown-item">
                        <i class="far fa-smile"></i>
                        <span class="float-right text-sm"><?= $row->username ?></span><br>
                        <span class="float-right text-sm">
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
                            } ?></span>
                    </a>
                <?php endforeach ?>
                <br>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('') ?>/GantiPassword" class="dropdown-item">
                    <i class="fas fa-key"></i>
                    <span class="float-right text-sm">Ganti Password</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('') ?>/Auth/logout" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-power-off"></i>
                    <span class="float-right text-sm">Keluar</span>
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->