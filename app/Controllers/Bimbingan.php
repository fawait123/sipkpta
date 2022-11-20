<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Controllers\BaseController;
use App\Helpers\NotifikasiHelper;
use App\Libraries\DriveApi;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;
use App\Models\AdminModel;
use App\Models\DriveModel;
use App\Models\BimbinganModel;
use App\Models\NotifikasiModel;
use App\Models\PengajuanModel;
use App\Models\PerubahanJudulModel;

class Bimbingan extends BaseController
{
    public function __construct()
    {
        $this->bread = new LibrariesBreadcrumb();
        helper('filesystem'); // Load Helper File System
    }
    public function bimbingankp()
    {
        if (session()->get('isLoggedIn')) :
            $pengajuan = new PengajuanModel();
            $cek = $pengajuan->getPengajuan(session('username'), "KP")->getRow();
            // dd($cek);
            $nik = isset($_GET['dosen']) ? $_GET['dosen'] : null;
            $npm = isset($_GET['mahasiswa']) ? $_GET['mahasiswa'] : null;
            $dosbing = new BimbinganModel();
            $dosen = new  DosenModel();
            $mahasiswa = new MahasiswaModel();
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Bimbingan KP";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            if (session()->get('role') == "mahasiswa") :
                $data['cek'] = $cek;
            endif;
            $data['dosbing'] = $dosbing->getDosbing(session()->get('username'), "KP")->getRow();
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['bimbingan'] = $this->getBimbingan(session()->get('role'), "KP", $npm, $nik)->getResult();
            $data['dosen'] = $dosen->getDosen()->getResult();
            $data['mahasiswa'] = $mahasiswa->getMahasiswa()->getResult();
            if (session()->get('role') == 'dosen') :
                $data['getMahasiswaBimbingan'] = $dosen->getMahasiswa(session()->get('username'), "KP", session()->get('semester'), session()->get('tahun_ajaran'))->getResult();
            endif;
            $dosbing = new BimbinganModel();
            $dosbing = $dosbing->getDosbing(session()->get('username'), "KP")->getRow();
            $data['dosbing'] = $dosbing;
            echo view("bimbingan/kp/index", $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function bimbinganta()
    {
        if (session()->get('isLoggedIn')) :
            // dd($this->getBimbingan(session()->get('role'), "TA")->getResult());
            $nik = isset($_GET['dosen']) ? $_GET['dosen'] : null;
            $npm = isset($_GET['mahasiswa']) ? $_GET['mahasiswa'] : null;
            $pengajuan = new PengajuanModel();
            $dosbing = new BimbinganModel();
            $dosen = new  DosenModel();
            $mahasiswa = new MahasiswaModel();
            $data['dosen'] = $dosen->getDosen()->getResult();
            $data['mahasiswa'] = $mahasiswa->getMahasiswa()->getResult();
            $cek = $pengajuan->getPengajuan(session('username'), "TA")->getRow();
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Bimbingan TA";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            if (session()->get('role') == "mahasiswa") :
                $data['cek'] = $cek;
            endif;
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['dosbing'] = $dosbing->getDosbing(session()->get('username'), "TA")->getRow();
            $data['bimbingan'] = $this->getBimbingan(session()->get('role'), "TA", $npm, $nik)->getResult();
            if (session()->get('role') == 'dosen') :
                $data['getMahasiswaBimbingan'] = $dosen->getMahasiswa(session()->get('username'), "TA", session()->get('semester'), session()->get('tahun_ajaran'))->getResult();
            endif;
            $dosbing = new BimbinganModel();
            $dosbing = $dosbing->getDosbing(session()->get('username'), "TA")->getRow();
            $data['dosbing'] = $dosbing;
            // dd($dosbing);
            echo view("bimbingan/ta/index", $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function formkp()
    {
        if (session()->get('isLoggedIn')) :
            $dosbing = new BimbinganModel();
            $dosbing = $dosbing->getDosbing(session()->get('username'), "KP")->getRow();
            if ($dosbing == null) :
                return redirect()->to('bimbingan/bimbingankp');
            else :
                $model = $this->getRole(session()->get('role'));
                $data['breadcrumbs'] = $this->bread->buildAuto();
                $data['title'] = "Bimbingan KP";
                $data['username'] = session()->get('username');
                $data['role'] = session()->get('role');
                $data['user'] = $model->getUser(session()->get('username'))->getResult();
                $data['dosbing'] = $dosbing;
                echo view('bimbingan/kp/form', $data);
            endif;
        else :
            return redirect()->to('home');
        endif;
    }


    public function formta()
    {
        if (session()->get('isLoggedIn')) :
            $dosbing = new BimbinganModel();
            $dosbing = $dosbing->getDosbing(session()->get('username'), "TA")->getRow();
            if ($dosbing == null) :
                return redirect()->to('bimbingan/bimbingankp');
            else :
                $model = $this->getRole(session()->get('role'));
                $data['breadcrumbs'] = $this->bread->buildAuto();
                $data['title'] = "Bimbingan TA";
                $data['username'] = session()->get('username');
                $data['role'] = session()->get('role');
                $data['user'] = $model->getUser(session()->get('username'))->getResult();
                $data['dosbing'] = $dosbing;
                echo view('bimbingan/ta/form', $data);
            endif;
        else :
            return redirect()->to('home');
        endif;
    }
    public function submitbimbingankp()
    {
        // dd(APPPATH);
        if ($this->cekBimbingan(session()->get('username'), "KP")) :
            session()->setFlashdata('pesan', 'Menunggu Bimbingan sebelumnya di review');
            return redirect()->to('bimbingan/bimbingankp');
        else :
            // sendNotif(session()->get('username'), $_POST['nik'], " Mengirim bimbingan kerja praktik, " . $_POST['materi'], "bimbingan/bimbingankp");
            // upload file
            $user = $this->getUser(session()->get('username'));
            $online = $this->request->getFile('file');
            $offline = $this->request->getFile('foto');
            // dd($online->getExtension());
            $tanggal = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');
            $hitung = $this->count(session()->get('username'), 'KP');
            $folder_id = $this->exist_folder($user->npm, $user->nama_mahasiswa, 'kp');
            $driveId = '';
            if ($online) {
                $file_path = $online->getTempName();
                $file_type = $online->getMimeType();
                $user = $this->getUser(session()->get('username'));
                $file_name = $user->npm . '_' . $user->nama_mahasiswa . "_bimbingan_$hitung.pdf";
                $driveId = DriveApi::upload($file_name, $file_path, $file_type, $folder_id);
            } else if ($offline) {
                $file_path = $offline->getTempName();
                $file_type = $offline->getMimeType();
                $user = $this->getUser(session()->get('username'));
                $file_name = $user->npm . '_' . $user->nama_mahasiswa . "_bimbingan_$hitung." . $offline->getExtension();
                $driveId = DriveApi::upload($file_name, $file_path, $file_type, $folder_id);
            }

            // dd($driveId);
            // if (!empty($online)) {
            //     $bimbingan_online = $user->npm . '_' . $user->nama_mahasiswa . "_bimbingan_$hitung.pdf";
            //     $size = $online->getSizeByUnit('kb');
            // }

            // if (!empty($offline)) {
            //     $extensi = $offline->getExtension();
            //     $bimbingan_offline = $user->npm . '_' . $user->nama_mahasiswa . "_bimbingan_$hitung.".$extensi;
            //     $size_gambar = $offline->getSizeByUnit('kb');
            // }

            // if (!empty($online)) {
            //     if ($size <= 5000) {
            //         $map = directory_map("uploads/bimbingan/kerja praktik/$user->npm-$user->nama_mahasiswa/", false, true);
            //         foreach ($map as $key) {
            //             if ($key == $bimbingan_online) {
            //                 delete_files("uploads/bimbingan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $bimbingan_online);
            //             }
            //         }
            //         $online->move("uploads/bimbingan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $bimbingan_online);
            //     }
            // }else{
            //     if ($size_gambar <= 5000) {
            //         $map2 = directory_map("uploads/bimbingan/kerja praktik/$user->npm-$user->nama_mahasiswa/", true, true);
            //         foreach ($map2 as $key) {
            //             if ($key == $bimbingan_offline) {
            //                 delete_files("uploads/bimbingan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $bimbingan_offline);
            //             }
            //         }
            //         $offline->move("uploads/bimbingan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $bimbingan_offline);
            //     }
            // }
            // end upload file
            if ($online || $offline) {
                $data = [
                    'kd_bimbingan' => $this->kodeBimbingan(),
                    'npm' => $_POST['npm'],
                    'nik' => $_POST['nik'],
                    'tgl' => $tanggal,
                    'materi' => $_POST['materi'],
                    'metode' => $_POST['metode'],
                    'jenis' => 'KP',
                    'keterangan' => null,
                    'file' => '',
                    'status' => !empty($online) ? null : 'tidak acc',
                    'drive_id' => $driveId

                ];
                $builder = new BimbinganModel();
                $builder->insert($data);
                session()->setFlashdata('pesan', 'Bimbingan berhasil dikirim');
                return redirect()->to('bimbingan/bimbingankp');
            } else {
                session()->setFlashdata('errors', 'Terjadi Kesalahan Pada Saat Upload Gambar');
                return redirect()->to('bimbingan/bimbingankp');
            }
        endif;
    }
    public function submitbimbinganta()
    {
        if ($this->cekBimbingan(session()->get('username'), "TA")) :
            session()->setFlashdata('pesan', 'Menunggu bimbingan sebelumnya direview');
            return redirect()->to('bimbingan/bimbinganta');
        else :
            // sendNotif(session()->get('username'), $_POST['nik'], " Mengirim bimbingan tugas akhir, " . $_POST['materi'], "bimbingan/bimbinganta");
            // upload file
            $user = $this->getUser(session()->get('username'));
            $online = $this->request->getFile('file');
            $offline = $this->request->getFile('foto');
            // dd($online->getExtension());
            $tanggal = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');
            $hitung = $this->count(session()->get('username'), 'KP');
            $folder_id = $this->exist_folder($user->npm, $user->nama_mahasiswa, 'ta');
            $driveId = '';
            if ($online) {
                $file_path = $online->getTempName();
                $file_type = $online->getMimeType();
                $user = $this->getUser(session()->get('username'));
                $file_name = $user->npm . '_' . $user->nama_mahasiswa . "_bimbingan_$hitung.pdf";
                $driveId = DriveApi::upload($file_name, $file_path, $file_type, $folder_id);
            } else if ($offline) {
                $file_path = $offline->getTempName();
                $file_type = $offline->getMimeType();
                $user = $this->getUser(session()->get('username'));
                $file_name = $user->npm . '_' . $user->nama_mahasiswa . "_bimbingan_$hitung." . $offline->getExtension();
                $driveId = DriveApi::upload($file_name, $file_path, $file_type, $folder_id);
            }
            // if (!empty($online)) {
            //     $bimbingan_online = $user->npm . '_' . $user->nama_mahasiswa . "_bimbingan_$hitung.pdf";
            //     $size = $online->getSizeByUnit('kb');
            // }

            // if (!empty($offline)) {
            //     $extensi = $offline->getExtension();
            //     $bimbingan_offline = $user->npm . '_' . $user->nama_mahasiswa . "_bimbingan_$hitung.".$extensi;
            //     $size_gambar = $offline->getSizeByUnit('kb');
            // }

            // if (!empty($online)) {
            //     if ($size <= 5000) {
            //         $map = directory_map("uploads/bimbingan/tugas akhir/$user->npm-$user->nama_mahasiswa/", false, true);
            //         foreach ($map as $key) {
            //             if ($key == $bimbingan_online) {
            //                 delete_files("uploads/bimbingan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $bimbingan_online);
            //             }
            //         }
            //         $online->move("uploads/bimbingan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $bimbingan_online);
            //     }
            // }else{
            //     if ($size_gambar <= 5000) {
            //         $map2 = directory_map("uploads/bimbingan/tugas akhir/$user->npm-$user->nama_mahasiswa/", true, true);
            //         foreach ($map2 as $key) {
            //             if ($key == $bimbingan_offline) {
            //                 delete_files("uploads/bimbingan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $bimbingan_offline);
            //             }
            //         }
            //         $offline->move("uploads/bimbingan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $bimbingan_offline);
            //     }
            // }
            // end upload file
            if ($online || $offline) {
                $data = [
                    'kd_bimbingan' => $this->kodeBimbingan(),
                    'npm' => $_POST['npm'],
                    'nik' => $_POST['nik'],
                    'tgl' => $tanggal,
                    'materi' => $_POST['materi'],
                    'metode' => $_POST['metode'],
                    'jenis' => 'TA',
                    'keterangan' => null,
                    'file' => '',
                    'status' => !empty($online) ? null : 'tidak acc',
                    'drive_id' => $driveId
                ];
                $builder = new BimbinganModel();
                $builder->insert($data);
                session()->setFlashdata('pesan', 'Bimbingan berhasil dikirim');
                return redirect()->to('bimbingan/bimbinganta');
            } else {
                session()->setFlashdata('errors', 'Terjadi Kesalahan Pada Saat Upload Gambar');
                return redirect()->to('bimbingan/bimbinganta');
            }
        endif;
    }


    public function reviewKP()
    {
        $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : 'KP';
        $url = $jenis == 'KP' ? 'bimbingan/bimbingankp' : 'bimbingan/bimbinganta';
        // sendNotif(session()->get('username'), $_POST['npm'], "sudah mereview bimbinganmu", $url);
        $data = [
            'keterangan' => $_POST['keterangan'],
            'status' => 'acc',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $kode = [
            'kd_bimbingan' => $_POST['kd_bimbingan']
        ];
        $builder = new BimbinganModel();
        $builder->update($kode, $data);

        if ($jenis == "TA") {
            session()->setFlashdata('pesan', 'Review TA Berhasil');
            return redirect()->to('bimbingan/bimbinganta');
        } else {
            session()->setFlashdata('pesan', 'Review KP Berhasil');
            return redirect()->to('bimbingan/bimbingankp');
        }
        // session()->setFlashdata('success', 'Review Berhasil');
        // return redirect()->to('bimbingan/bimbingankp');
    }

    public function accbimbingan()
    {
        $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : 'KP';
        if ($jenis == 'KP') {
            $url = 'bimbingan/bimbingankp';
        } else {
            $url = 'bimbingan/bimbinganta';
        }
        // sendNotif(session()->get('username'), $_POST['npm'], strtoupper($_POST['status']) . " bimbinganmu", $url);
        $data = [
            'status' => $_POST['status'],
        ];
        $kode = [
            'kd_bimbingan' => $_POST['kd_bimbingan']
        ];
        $builder = new BimbinganModel();
        $builder->update($kode, $data);

        if ($jenis == "TA") {
            session()->setFlashdata('pesan', 'Acc Berhasil');
            return redirect()->to('bimbingan/bimbinganta');
        } else {
            session()->setFlashdata('pesan', 'Acc Berhasil');
            return redirect()->to('bimbingan/bimbingankp');
        }
    }

    public function getBimbingan($role, $jenis, $npm = null, $nik = null)
    {
        $builder = new BimbinganModel();
        switch ($role) {
            case 'mahasiswa':
                $bimbingan =  $builder->get(session()->get('username'), $jenis);
                break;
            case 'dosen':
                $bimbingan =  $builder->get(session()->get('username'), $jenis, $npm);
                break;
            case 'admin':
                $bimbingan = $builder->get(null, $jenis, $npm, $nik);
                break;
            case 'sekprod':
                $bimbingan =  $builder->get(null, $jenis, $npm, $nik);
                break;
            case 'kaprodi':
                $bimbingan =  $builder->get(null, $jenis, $npm, $nik);
                break;
            default:
                $bimbingan = null;
                break;
        }
        return $bimbingan;
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

    public function kodeBimbingan()
    {
        $model = new BimbinganModel();
        $hitung = $model->countRow();
        $hitung += 1;
        $kode = "BM" . date('YmdHis') . $hitung;
        return $kode;
    }

    public function cekBimbingan($username, $jenis)
    {
        $model = new BimbinganModel();
        $hasil = $model->cekBimbingan($username, $jenis)->getResult();
        if (count($hasil) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getMahasiswa()
    {
        $nik = $_GET['dosen'];
        $jenis = $_GET['jenis'];
        $model = new BimbinganModel();
        $hasil = $model->getMahasiswa1($nik,$jenis)->getResult();
        return json_encode($hasil);
    }

    public function getUser($npm)
    {
        $model = new BimbinganModel();
        return $model->getField($npm)->getRow();
    }

    public function count($npm, $jenis)
    {
        $model = new BimbinganModel();
        return count($model->countDataByUser($npm, $jenis)->getResult()) + 1;
    }

    public function download($jenis)
    {
        $nim = session()->get('username');
        $jenis = strtoupper($jenis);
        $builder = new BimbinganModel();
        $model = new PerubahanJudulModel();
        $dataMahasiswa = $builder->getDisposisi($nim, $jenis)->getRow();
        $bimbingan = $builder->getBimbingan($nim, $jenis)->getResult();
        $session = session();
        $data['tb_disposisi'] = $model->getJudulPerubahan($dataMahasiswa->no_disposisi)->getResult();
        $data['title'] = 'KARTU%20BIMBINGAN%20' . $nim;
        $data['bimbingan'] = $bimbingan;
        $data['pengajuan'] = $dataMahasiswa;
        $data['batas_bimbingan'] = $session->get('batas_bimbingan');
        echo view('bimbingan/cetakkartubimbingan', $data);
    }

    public function exist_folder($username, $name, $jenis)
    {
        $model = new DriveModel();
        $parentFolder = $model->getParentFolder('bimbingan', $jenis);
        $check = $model->getWhere($username, $jenis);
        $driveId = '';
        if ($check == null) {
            $title = $username . ' - ' . $name;
            $driveId = DriveApi::createFolder($title, $parentFolder->drive_id);
            $data = [
                'username' => $username,
                'jenis' => $jenis,
                'drive_id' => $driveId
            ];
            $model->insertData($data);
        } else {
            $driveId = $check->drive_id;
        }

        return $driveId;
    }
}
