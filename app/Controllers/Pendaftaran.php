<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;
use App\Models\AdminModel;
use App\Models\BimbinganModel;
use App\Models\PendaftaranModel;
use App\Models\PengajuanModel;
use App\Models\UjianModel;
use App\Models\UserModel;

class Pendaftaran extends BaseController
{
    public function __construct()
    {
        $this->bread = new LibrariesBreadcrumb();
        helper('filesystem');
    }

    public function seminar()
    {
        if (session()->get('isLoggedIn')) :
            // dd($this->getPendaftaran(session()->get("role"))->getResult());
            $ujian = new UjianModel();
            $dosen = new DosenModel();
            $bimbingan = new BimbinganModel();
            $pendaftaran = new PendaftaranModel();
            $user = new UserModel();
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Seminar Kerja Praktik";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['count'] = $bimbingan->countBimbingan(session()->get('username'), "KP");
            $data['pengajuan'] = $bimbingan->getPengajuan(session('username'), "KP")->getRow();
            $data['search'] = $pendaftaran->search(session('username'), "KP")->getRow();
            // dd($data['search']);
            if (session()->get('role') != "mahasiswa") :
                $data['pendaftaran'] = $this->getPendaftaran(session()->get("role"), "KP")->getResult();
            endif;
            if (session()->get('role') == "mahasiswa") :
                $data['mahasiswa'] = $user->getMahasiswa(session()->get('username'))->getRow();
                if ($data['search'] != null) :
                    $data['ujian'] = $ujian->get($data['search']->kd_pendaftaran)->getRow();
                endif;
            endif;
            $data['dosen'] = $dosen->getDosen()->getResult();
            echo view('pendaftaran/seminar/index', $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function pendadaran()
    {
        if (session()->get('isLoggedIn')) :
            $ujian = new UjianModel();
            $dosen = new DosenModel();
            $user = new UserModel();
            $bimbingan = new BimbinganModel();
            $pendaftaran = new PendaftaranModel();
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Pendadaran Tugas Akhir";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['count'] = $bimbingan->countBimbingan(session()->get('username'), "TA");
            $data['pengajuan'] = $bimbingan->getPengajuan(session('username'), "TA")->getRow();
            $data['search'] = $pendaftaran->search(session('username'), "TA")->getRow();
            // dd($data['search']);
            // dd($data['search']);
            if (session()->get('role') != "mahasiswa") :
                $data['pendaftaran'] = $this->getPendaftaran(session()->get("role"), "TA")->getResult();
            endif;
            if (session()->get('role') == "mahasiswa") :
                $data['mahasiswa'] = $user->getMahasiswa(session()->get('username'))->getRow();
                if ($data['search'] != null) :
                    $data['ujian'] = $ujian->get($data['search']->kd_pendaftaran)->getResult();
                endif;
            endif;
            $data['dosen'] = $dosen->getDosen()->getResult();
            echo view('pendaftaran/pendadaran/index', $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function submitSeminar()
    {
        if ($_POST['email'] == '' || $_POST['no_telp'] == '') {
            session()->setFlashdata('error', 'silahkan lengkapi profile terlebih dahulu');
            return redirect()->to('myprofile');
        } else {
            // sendNotif(session()->get('username'), $_POST['nik'], "Mendaftar seminar kerja praktik", "pendaftaran/seminar");
            // upload file
            $user = $this->getUser(session()->get('username'));
            $krs = $this->request->getFile('berkas_krs');
            $pembayaran = $this->request->getFile('berkas_pembayaran');
            if (!empty($krs)) {
                $new_krs = $user->npm . '_' . $user->nama_mahasiswa . '_KRS.pdf';
                $size = $krs->getSizeByUnit('kb');
            }
            if (!empty($pembayaran)) {
                $new_pembayaran = $user->npm . '_' . $user->nama_mahasiswa . '_BAYAR.pdf';
                $size = $pembayaran->getSizeByUnit('kb');
            }
            // MOVE TO DIRECTORY
            if (!empty($krs)) {
                if ($size <= 5000) {
                    $map = directory_map("uploads/pendaftaran/seminar/$user->npm-$user->nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $new_krs) {
                            delete_files("uploads/pendaftaran/seminar/$user->npm-$user->nama_mahasiswa/", $new_krs);
                        }
                    }
                    $krs->move("uploads/pendaftaran/seminar/$user->npm-$user->nama_mahasiswa/", $new_krs);
                }
            }
            if (!empty($pembayaran)) {
                if ($size <= 5000) {
                    $map = directory_map("uploads/pendaftaran/seminar/$user->npm-$user->nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $new_pembayaran) {
                            delete_files("uploads/pendaftaran/seminar/$user->npm-$user->nama_mahasiswa/", $new_pembayaran);
                        }
                    }
                    $pembayaran->move("uploads/pendaftaran/seminar/$user->npm-$user->nama_mahasiswa/", $new_pembayaran);
                }
            }
            //   end upload file
            $pendaftaran = new PendaftaranModel();
            if ($krs && $pembayaran) {
                $ujian = new UjianModel();
                $penguji = [
                    'kd_pendaftaran' => $this->kodePendaftaran(),
                    'nik' => $_POST['nik'],
                    'title' => 'Dosen Penguji'
                ];
                $ujian->insert($penguji);
                $data = [
                    'kd_pendaftaran' => $this->kodePendaftaran(),
                    'no_pengajuan' => $_POST['no_pengajuan'],
                    'judul_pendaftaran' => $_POST['judul_pendaftaran'],
                    'npm' => $_POST['npm'],
                    'nik' => $_POST['nik'],
                    'jenis' => 'KP',
                    'berkas_krs' => "uploads/pendaftaran/seminar/$user->npm-$user->nama_mahasiswa/" . $new_krs,
                    'berkas_pembayaran' => "uploads/pendaftaran/seminar/$user->npm-$user->nama_mahasiswa/" . $new_pembayaran,
                    'status' => 'tidak acc',
                    'status_pendaftaran'=>'Terdaftar'
                ];
                $pendaftaran->insert($data);
                session()->setFlashdata('pesan', 'Pendaftaran seminar berhasil dikirim');
                return redirect()->to('pendaftaran/seminar');
            } else {
                session()->setFlashdata('error', 'terjadi Error pada saat upload file');
                return redirect()->to('pendaftaran/seminar');
            }
        }
    }
    public function submitPendadaran()
    {
        if ($_POST['email'] == '' || $_POST['no_telp'] == '') {
            session()->setFlashdata('pesan', 'Lengkapi data diri terlebih dahulu');
            return redirect()->to('myprofile');
        } else {
            // sendNotif(session()->get('username'), $_POST['nik'], "Mendaftar pendadaran tugas akhir", "pendaftaran/pendadaran");
            // upload file
            $user = $this->getUser(session()->get('username'));
            $krs = $this->request->getFile('berkas_krs');
            $pembayaran = $this->request->getFile('berkas_pembayaran');
            $toefle = $this->request->getFile('berkas_toefle');
            $rekomendasi = $this->request->getFile('berkas_rekomendasi');
            $sertifikat = $this->request->getFile('berkas_sertifikat');
            $abstrak = $this->request->getFile('berkas_abstrak');
            $pustaka = $this->request->getFile('berkas_pustaka');
            if (!empty($krs)) {
                $new_krs = $user->npm . '_' . $user->nama_mahasiswa . '_KRS.pdf';
                $size = $krs->getSizeByUnit('kb');
            }
            if (!empty($pembayaran)) {
                $new_pembayaran = $user->npm . '_' . $user->nama_mahasiswa . '_BAYAR.pdf';
                $size = $pembayaran->getSizeByUnit('kb');
            }
            if (!empty($toefle)) {
                $new_toefle = $user->npm . '_' . $user->nama_mahasiswa . '_TOEFLE.pdf';
                $size = $toefle->getSizeByUnit('kb');
            }
            if (!empty($rekomendasi)) {
                $new_rekomendasi = $user->npm . '_' . $user->nama_mahasiswa . '_REKOMENDASI.pdf';
                $size = $rekomendasi->getSizeByUnit('kb');
            }
            if (!empty($sertifikat)) {
                $new_sertifikat = $user->npm . '_' . $user->nama_mahasiswa . '_SERTIFIKAT.pdf';
                $size = $sertifikat->getSizeByUnit('kb');
            }
            if (!empty($abstrak)) {
                $new_abstrak = $user->npm . '_' . $user->nama_mahasiswa . '_ABSTRAK.'.$abstrak->getExtension();
                $size = $abstrak->getSizeByUnit('kb');
            }
            if (!empty($pustaka)) {
                $new_pustaka = $user->npm . '_' . $user->nama_mahasiswa . '_PUSTAKA.'.$pustaka->getExtension();
                $size = $pustaka->getSizeByUnit('kb');
            }

            // MOVE TO DIRECTORY
            if (!empty($krs)) {
                if ($size <= 5000) {
                    $map = directory_map("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $new_krs) {
                            delete_files("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_krs);
                        }
                    }
                    $krs->move("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_krs);
                }
            }
            if (!empty($pembayaran)) {
                if ($size <= 5000) {
                    $map = directory_map("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $new_pembayaran) {
                            delete_files("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_pembayaran);
                        }
                    }
                    $pembayaran->move("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_pembayaran);
                }
            }
            if (!empty($toefle)) {
                if ($size <= 5000) {
                    $map = directory_map("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $new_toefle) {
                            delete_files("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_toefle);
                        }
                    }
                    $toefle->move("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_toefle);
                }
            }
            if (!empty($rekomendasi)) {
                if ($size <= 5000) {
                    $map = directory_map("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $new_rekomendasi) {
                            delete_files("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_rekomendasi);
                        }
                    }
                    $rekomendasi->move("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_rekomendasi);
                }
            }
            if (!empty($sertifikat)) {
                if ($size <= 5000) {
                    $map = directory_map("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $new_sertifikat) {
                            delete_files("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_sertifikat);
                        }
                    }
                    $sertifikat->move("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_sertifikat);
                }
            }
            if (!empty($abstrak)) {
                if ($size <= 5000) {
                    $map = directory_map("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $new_abstrak) {
                            delete_files("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_abstrak);
                        }
                    }
                    $abstrak->move("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_abstrak);
                }
            }
            if (!empty($pustaka)) {
                if ($size <= 5000) {
                    $map = directory_map("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $new_pustaka) {
                            delete_files("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_pustaka);
                        }
                    }
                    $pustaka->move("uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/", $new_pustaka);
                }
            }
            // end upload file
            $pendaftaran = new PendaftaranModel();
            $ujian = new UjianModel();
            if ($krs && $pembayaran && $toefle && $rekomendasi && $sertifikat && $abstrak && $pustaka) {

                $ketua_penguji = [
                    'kd_pendaftaran' => $this->kodePendaftaran(),
                    'title' => 'Ketua Penguji',
                    'nik' => ''
                ];

                $penguji_1 = [
                    'kd_pendaftaran' => $this->kodePendaftaran(),
                    'title' => 'Penguji 1',
                    'nik' => ''
                ];

                $penguji_2 = [
                    'kd_pendaftaran' => $this->kodePendaftaran(),
                    'title' => 'Penguji 2',
                    'nik' => $_POST['nik']
                ];

                $ujian->insert($ketua_penguji);
                $ujian->insert($penguji_1);
                $ujian->insert($penguji_2);

                $data = [
                    'kd_pendaftaran' => $this->kodePendaftaran(),
                    'no_pengajuan' => $_POST['no_pengajuan'],
                    'npm' => $_POST['npm'],
                    'nik' => $_POST['nik'],
                    'judul_pendaftaran' => $_POST['judul_pendaftaran'],
                    'jenis' => 'TA',
                    'berkas_krs' => "uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/" . $new_krs,
                    'berkas_pembayaran' => "uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/" . $new_pembayaran,
                    'berkas_toefle' => "uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/" . $new_toefle,
                    'berkas_rekomendasi' => "uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/" . $new_rekomendasi,
                    'berkas_sertifikat' => "uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/" . $new_sertifikat,
                    'berkas_abstrak' => "uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/" . $new_abstrak,
                    'berkas_pustaka' => "uploads/pendaftaran/pendadaran/$user->npm-$user->nama_mahasiswa/" . $new_pustaka,
                    'ukuran_toga' => $_POST['ukuran_toga'],
                    'status' => 'tidak acc',
                    'status_pendaftaran'=>'Terdaftar'
                ];
                $pendaftaran->insert($data);

                session()->setFlashdata('pesan', 'Pendaftaran pendadaran berhasil dikirim');
                return redirect()->to('pendaftaran/pendadaran');
            } else {
                session()->setFlashdata('error', 'terjadi Error pada saat upload file');
                return redirect()->to('pendaftaran/pendadaran');
            }
        }
    }
    public function status()
    {
        $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : 'KP';
        $url = $jenis == "KP" ? 'pendaftaran/seminar' : 'pendaftaran/pendadaran';
        $status = $jenis == "KP" ? "SEMINAR" : "PENDADARAN";
        // if ($_POST['status'] == 'acc') :
        //     sendNotif(session()->get('username'), $_POST['npm'], "ACC pedaftaran $status kamu", $url);
        //     sendNotif($_POST['npm'], "SKP001", "Mendaftar $status, silahkan masukan jadwal ujian", $url);
        // endif;
        $data = [
            'status' => $_POST['status']
        ];
        $kode = [
            'kd_pendaftaran' => $_POST['kd_pendaftaran']
        ];
        $builder = new PendaftaranModel();
        $builder->update($kode, $data);
        if ($jenis == "KP") {
            // $getRow = $builder->getRow($_POST['kd_pendaftaran'])->getRow();
            // $ujian = new UjianModel();
            // $nik = $ujian->getRow($getRow->no_pengajuan)->getRow();
            // $ujian->insert([
            //     'kd_ujian' => $this->kodeUjian(),
            //     'kd_pendaftaran' => $_POST['kd_pendaftaran'],
            //     'nik' => $nik->nik
            // ]);
            session()->setFlashdata('pesan', 'Data berhasil dikirim');
            return redirect()->to('pendaftaran/seminar');
        } else {
            session()->setFlashdata('pesan', 'Data berhasil dikirim');
            return redirect()->to('pendaftaran/pendadaran');
        }
    }

    public function getRole($role)
    {
        switch ($role) {
            case 'admin':
                $model = new AdminModel();
                break;
            case 'sekprod':
                $model = new SekprodModel();
                break;
            case 'kaprodi':
                $model = new KaprodiModel();
                break;
            case 'dosen':
                $model = new DosenModel();
                break;
            case 'mahasiswa':
                $model = new MahasiswaModel();
                break;
            default:
                $model = null;
                break;
        }

        return $model;
    }

    public function kodePendaftaran()
    {
        $builder = new PendaftaranModel();
        $count = $builder->countRow();
        $count = $count + 1;
        $kode = 'PD' . date('YmdHis') . $count;
        return $kode;
    }

    public function kodeUjian()
    {
        $builder = new UjianModel();
        $count = $builder->countRow();
        $count = $count + 1;
        $kode = 'UJ' . date('YmdHis') . $count;
        return $kode;
    }

    public function getPendaftaran($role, $jenis)
    {
        $builder = new PendaftaranModel();

        switch ($role) {
            case 'dosen':
                $pendaftran = $builder->search(session()->get('username'), $jenis, null);
                break;
            case 'kaprodi':
                $pendaftran = $builder->search(null, $jenis, "acc");
                break;
            case 'sekprod':
                $pendaftran = $builder->search(null, $jenis, "acc");
                break;
            case 'admin':
                $pendaftran = $builder->search(null, $jenis, "acc");
                break;

            default:
                $pendaftran = null;
                break;
        }

        return $pendaftran;
    }

    public function entryujian()
    {
        // dd($_POST['tgl']);
        // sendNotif($_POST['npm'], "Seminar Kerja Praktik", "seminar ujian kerja praktik kamu sudah di entry jadwal oleh prodi silahkan untuk mengeceknya", "pendaftaran/seminar");
        $ujian = new UjianModel();
        $pendaftaran_model = new PendaftaranModel();

        $pendaftaran = [
            'tgl' => date('Y-m-d H:i:s', strtotime($_POST['tgl'])),
            'tempat' => $_POST['tempat'],
            'is_entry' => 1,
            'status_pendaftaran'=>'Terjadwal'
        ];
        $id = [
            'kd_pendaftaran' => $_POST['kd_pendaftaran']
        ];
        $pendaftaran_model->update($id, $pendaftaran);

        $getPendaftaran = $ujian->get($_POST['kd_pendaftaran'])->getResult();

        $ujian->update(
            [
                'kd_ujian' => $getPendaftaran[0]->kd_ujian
            ],
            [
                'nik' => $_POST['ketua_penguji']
            ]
        );
        $ujian->update(
            [
                'kd_ujian' => $getPendaftaran[1]->kd_ujian
            ],
            [
                'nik' => $_POST['penguji_1']
            ]
        );
        $ujian->update(
            [
                'kd_ujian' => $getPendaftaran[2]->kd_ujian
            ],
            [
                'nik' => $_POST['penguji_2']
            ]
        );

        $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : 'KP';
        if ($jenis == "KP") {
            session()->setFlashdata('pesan', 'Entry jadwal seminar berhasil');
            return redirect()->to('pendaftaran/seminar');
        } else {
            session()->setFlashdata('pesan', 'Entry jadwal pendadaran berhasil');
            return redirect()->to('pendaftaran/pendadaran');
        }
    }

    public function entryujiankp()
    {
        // dd($_POST['tgl']);
        // sendNotif($_POST['npm'], "Seminar Kerja Praktik", "seminar ujian kerja praktik kamu sudah di entry jadwal oleh prodi silahkan untuk mengeceknya", "pendaftaran/seminar");
        $ujian = new UjianModel();
        $pendaftaran_model = new PendaftaranModel();
        $pengajuan = new PengajuanModel();

        $pendaftaran = [
            'tgl' => date('Y-m-d H:i:s', strtotime($_POST['tgl'])),
            'tempat' => $_POST['tempat'],
            'is_entry' => 1,
            'status_pendaftaran'=>'Terjadwal'
        ];
        $id = [
            'kd_pendaftaran' => $_POST['kd_pendaftaran']
        ];
        $pengajuan->updatePengajuan(['status_perpanjang'=>'selesai'],$_POST['no_pengajuan']);
        $pendaftaran_model->update($id, $pendaftaran);

        $getPendaftaran = $ujian->get($_POST['kd_pendaftaran'])->getRow();

        $ujian->update(
            [
                'kd_ujian' => $getPendaftaran->kd_ujian
            ],
            [
                'nik' => $_POST['penguji']
            ]
        );

        $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : 'KP';
        if ($jenis == "KP") {
            session()->setFlashdata('pesan', 'Entry jadwal seminar berhasil');
            return redirect()->to('pendaftaran/seminar');
        } else {
            session()->setFlashdata('pesan', 'Entry jadwal pendadaran berhasil');
            return redirect()->to('pendaftaran/pendadaran');
        }
    }

    public function getUjian()
    {
        $kd_pendaftaran = $_POST['kd_pendaftaran'];
        $ujian = new UjianModel();
        $cek = $ujian->get($kd_pendaftaran)->getResult();
        return json_encode($cek);
    }

    public function getUjianKP()
    {
        $kd_pendaftaran = $_POST['kd_pendaftaran'];
        $ujian = new UjianModel();
        $cek = $ujian->get($kd_pendaftaran)->getRow();
        return json_encode($cek);
    }

    public function getUser($npm)
    {
        $model = new BimbinganModel();
        return $model->getField($npm)->getRow();
    }

    public function show($no_pengajuan)
    {
            $model = new PengajuanModel();
            $builder = $this->getRole(session()->get('role'));
            $berkas = $model->getPengajuan2($no_pengajuan)->getRow();
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Detail Berkas";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $builder->getUser(session()->get('username'))->getResult();
            $data['berkas'] = $berkas;
            echo view('pendaftaran/pendadaran/show', $data);
    }

    public function detailSeminar($id)
    {
        $model = new PengajuanModel();
        $builder = $this->getRole(session()->get('role'));
        $berkas = $model->getPengajuan2($id)->getRow();
        $data['breadcrumbs'] = $this->bread->buildAuto();
        $data['title'] = "Detail Seminar";
        $data['username'] = session()->get('username');
        $data['role'] = session()->get('role');
        $data['user'] = $builder->getUser(session()->get('username'))->getResult();
        $data['berkas'] = $berkas;
        echo view('pendaftaran/seminar/show', $data);
    }

    public function konfirmasi()
    {
        $pendaftaran = new PendaftaranModel();
        $data = [
            'status'=>$_POST['status'],
            'note'=>$_POST['note']
        ];
        $id = [
            'kd_pendaftaran'=>$_POST['kd_pendaftaran']
        ];

        $pendaftaran->update($id,$data);
        $jenis = isset($_POST['jenis']) ? $_POST['jenis']:'KP';
        if($jenis=='KP'){
            return redirect()->to('pendaftaran/seminar');
        }else{
            return redirect()->to('pendaftaran/pendadaran');
        }
    }
}
