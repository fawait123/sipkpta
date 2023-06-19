<?php
$routes->group('accpengajuan', ['filter' => 'authfilter', 'filter' => 'role:kaprodi'], function ($routes) {
    $routes->get('kp', 'AccPengajuan::acckp');
    $routes->get('ta', 'AccPengajuan::accta');
});
$routes->group('berkas', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kp', 'Berkas::berkaskp');
    $routes->get('ta', 'Berkas::berkasta');
});
$routes->get('datadiri', 'DataDiri', ['filter' => 'authfilter']);
$routes->group('disposisi', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kp', 'Disposisi::disposisikp');
    $routes->get('ta', 'Disposisi::disposisita');
});
$routes->get('dosen', 'Dosen', ['filter' => 'authfilter']);
$routes->get('dosen', 'Dosen', ['filter' => 'authfilter']);
$routes->get('gantipassword', 'GantiPassword', ['filter' => 'authfilter']);
$routes->get('mahasiswa', 'Mahasiswa', ['filter' => 'authfilter']);
$routes->get('myprofile', 'MyProfile', ['filter' => 'authfilter']);
$routes->group('nilai', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kp', 'Nilai::nilaikp');
    $routes->get('ta', 'Nilai::nilaita');
});
$routes->group('pengajuan', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kp', 'Pengajuan::pengajuankp');
    $routes->get('ta', 'Pengajuan::pengajuanta');
});

$routes->group('admin/pengajuan', ['filter' => 'authfilter', 'filter' => 'role:admin'], function () use ($routes) {
    $routes->get('kp', 'Pengajuan::adminkp');
});
$routes->get('perpanjang', 'Perpanjang', ['filter' => 'authfilter']);
$routes->get('persiapan', 'Persiapan', ['filter' => 'authfilter']);
$routes->group('ploting', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kp', 'Ploting::plotingkp');
    $routes->get('ta', 'Ploting::plotingta');
});
$routes->get('register', 'Register', ['filter' => 'authfilter']);
$routes->group('reviewproposal', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kp', 'ReviewProposal::reviewkp');
    $routes->get('ta', 'ReviewProposal::reviewta');
});
$routes->get('topik', 'Topik', ['filter' => 'authfilter']);
$routes->group('topikkuota', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kp', 'TopikKuota::kuotakp');
    $routes->get('ta', 'TopikKuota::kuotata');
});
// route dashboard dosen
$routes->get('dashboard-dosen', 'Dashboard::dosen', ['filter' => 'authfilter', 'filter' => 'role:dosen']);
// route untuk bimbingan
$routes->group('bimbingan', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kp', 'Bimbingan::bimbingankp');
    $routes->get('ta', 'Bimbingan::bimbinganta');
});
// route pendaftaran seminar
$routes->get('seminar/(:segment)', 'Pendaftaran::detailSeminar/$1');
$routes->post('seminar/konfirmasi', 'Pendaftaran::konfirmasi');

// route tanggal perubahan judul
$routes->group('perubahan', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('review-tanggal', 'TanggalPerubahanJudul::index');
    $routes->post('update-tanggal-review', 'TanggalPerubahanJudul::update');
    $routes->get('kp', 'PerubahanJudul::kp');
    $routes->post('kp', 'PerubahanJudul::submitkp');
    $routes->post('review-perubahan-dosen', 'PerubahanJudul::reviewdosen');
    $routes->post('revisi', 'PerubahanJudul::revisi');
    $routes->post('review-perubahan-prodi', 'PerubahanJudul::reviewprodi');
    $routes->get('cetak-logbook/(:segment)', 'PerubahanJudul::cetaklogbook/$1');
    $routes->get('cetak-kartu-bimbingan/(:segment)', 'PerubahanJudul::cetakkartubimbingan/$1');
    // perubahan ta
    $routes->get('ta', 'PerubahanJudul::ta');
    $routes->post('ta', 'PerubahanJudul::submitta');
    $routes->post('review-perubahan-dosen-ta', 'PerubahanJudul::reviewdosenta');
    $routes->post('revisi-ta', 'PerubahanJudul-ta::revisita');
    $routes->post('review-perubahan-prodi-ta', 'PerubahanJudul::reviewprodita');
    // route ubah judul
    $routes->post('ubahjudul', 'PerubahanJudul::ubahjudul');
});


$routes->group('pasca', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kerjapraktik', 'PascaController::kerjapraktik');
    $routes->post('kerjapraktik', 'PascaController::storeKp');
    $routes->post('kerjapraktik/status', 'PascaController::statusKp');
    $routes->get('tugasakhir', 'PascaController::tugasakhir');
    $routes->post('tugasakhir', 'PascaController::storeTa');
    $routes->post('tugasakhir/status', 'PascaController::statusTa');
    $routes->get('yudisium', 'PascaController::yudisium');
    $routes->post('upload/sertifikat', 'PascaController::uploadSertifikat');
    $routes->get('getPeran','PascaController::getPeran');
});

// route admin pasca pendadaran
$routes->group('admin/pasca', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('kerjapraktik', 'PascaController::adminkerjapraktik');
    $routes->get('kerjapraktik/show/(:any)', 'PascaController::adminshow/$1');
    $routes->get('tugasakhir', 'PascaController::admintugasakhir');
    $routes->get('yudisium', 'PascaController::adminYudisium');
    $routes->get('yudisium/berkas/(:any)', 'PascaController::adminBerkas/$1');
    $routes->get('yudisium/updateBerkas', 'PascaController::updateBerkas');
    $routes->get('yudisium/updateSertifikat', 'PascaController::updateSertifikat');
    $routes->get('tugasakhir/show/(:any)', 'PascaController::adminshowta/$1');
    $routes->get('kerjapraktik/delete/(:any)', 'PascaController::admindeletekp/$1');
    $routes->get('tugasakhir/delete/(:any)', 'PascaController::admindeleteta/$1');
});