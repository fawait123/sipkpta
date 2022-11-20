<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DataDiriModel;
use App\Models\DisposisiModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PengajuanModel;
use App\Models\PersiapanModel;
use App\Models\SekprodModel;
use App\Models\TopikKuotaModel;
use CodeIgniter\I18n\Time;

class DataDiri extends BaseController
{

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Form Data Diri";
            $data['username'] = $session->get('username');
            $data['role'] = $session->get('role');
            $username = $data['username'];
            $role = $data['role'];
            if ($role == "admin") {
                $model = new AdminModel();
            } elseif ($role == "sekprod") {
                $model = new SekprodModel();
            } elseif ($role == "kaprodi") {
                $model = new KaprodiModel();
            } elseif ($role == "dosen") {
                $model = new DosenModel();
            } elseif ($role == "mahasiswa") {
                $model = new MahasiswaModel();
            }
            $data['user'] = $model->getUser($username)->getResult();
            $model2 = new DataDiriModel();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $data['data_diri'] = $model2->cekDataDiri($username)->getResult();
            $data['data_diri2'] = $model2->getDataDiri($username)->getResult();
            $data_diri = $data['data_diri'];
            $count = count($data_diri);
            if (empty($count)) {
                $data['data_diri'] = "true";
            } else {
                $data['data_diri'] = "false";
            }
            echo view('data_diri', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function save()
    {
        $model = new DataDiriModel();
        $this->session = session();
        $username = $this->request->getPost('username');
        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa');

        helper('filesystem'); // Load Helper File System

        $ktp = $this->request->getFile('ktp');
        $nama_ktp = $ktp->getClientName();
        $nama_ktp_baru = $username . '_' . $nama_mahasiswa . '_KTP.pdf';
        $size_ktp = $ktp->getSizeByUnit('kb');

        $kk = $this->request->getFile('kk');
        $nama_kk = $kk->getClientName();
        $nama_kk_baru = $username . '_' . $nama_mahasiswa . '_KK.pdf';
        $size_kk = $kk->getSizeByUnit('kb');

        $akte = $this->request->getFile('akte');
        $nama_akte = $akte->getClientName();
        $nama_akte_baru = $username . '_' . $nama_mahasiswa . '_AKTE.pdf';
        $size_akte = $akte->getSizeByUnit('kb');

        $ktm = $this->request->getFile('ktm');
        $nama_ktm = $ktm->getClientName();
        $nama_ktm_baru = $username . '_' . $nama_mahasiswa . '_KTM.pdf';
        $size_ktm = $ktm->getSizeByUnit('kb');

        $ijazah = $this->request->getFile('ijazah');
        $nama_ijazah = $ijazah->getClientName('');
        $nama_ijazah_baru = $username . '_' . $nama_mahasiswa . '_Ijazah.pdf';
        $size_ijazah = $ijazah->getSizeByUnit('kb');

        $data_diri = $this->request->getFile('data_diri');
        $nama_data_diri = $data_diri->getClientName();
        $nama_data_diri_baru = $username . '_' . $nama_mahasiswa . '_DataPDDIKTI.pdf';
        $size_data_diri = $data_diri->getSizeByUnit('kb');


        if (($size_ktp < 5000) && ($size_kk < 5000) && ($size_akte < 5000) &&
            ($size_ktm < 5000) && ($size_ijazah < 5000) && ($size_data_diri < 5000)
        ) {
            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_ktp_baru) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_ktp_baru");
                }
            }
            $ktp->move("uploads/$username $nama_mahasiswa/", $nama_ktp_baru);

            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_kk_baru) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_kk_baru");
                }
            }
            $kk->move("uploads/$username $nama_mahasiswa/", $nama_kk_baru);

            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_akte_baru) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_akte_baru");
                }
            }
            $akte->move("uploads/$username $nama_mahasiswa/", $nama_akte_baru);

            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_ktm_baru) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_ktm_baru");
                }
            }
            $ktm->move("uploads/$username $nama_mahasiswa/", $nama_ktm_baru);

            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_ijazah_baru) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_ijazah_baru");
                }
            }
            $ijazah->move("uploads/$username $nama_mahasiswa/", $nama_ijazah_baru);

            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_data_diri_baru) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_data_diri_baru");
                }
            }
            $data_diri->move("uploads/$username $nama_mahasiswa/", $nama_data_diri_baru);

            $model = new DataDiriModel();

            $kode = $model->autoCode()->getResult();
            foreach ($kode as $data) {
                $a = $data->no_data_diri;
                $a++;
                $huruf = "DD";
                date_default_timezone_set('Asia/Jakarta');
                $tanggal = date('YmdHs');
                $kode = $huruf . $tanggal . sprintf("%03s", $a);
                $now = new Time('now', 'Asia/Jakarta');
                $data = [
                    'no_data_diri' => $kode,
                    'npm' => $username,
                    'ktp' => $nama_ktp_baru,
                    'kk' => $nama_kk_baru,
                    'akte' => $nama_akte_baru,
                    'ktm'        => $nama_ktm_baru,
                    'ijazah'        => $nama_ijazah_baru,
                    'data_diri'        => $nama_data_diri_baru,
                ];
            }
            $model->saveDataDiri($data);

            $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
            return redirect()->to('/DataDiri');
        } else {
            $this->session->setFlashdata('errors', ['File Tidak Boleh Lebih Dari 5MB']);
            return redirect()->to('/DataDiri');
        }
    }

    public function updateDataDiri()
    {
        $model = new DataDiriModel();
        $this->session = session();
        $username = $this->request->getPost('username');
        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa');
        $no_data_diri = $this->request->getPost('no_data_diri');

        helper('filesystem'); // Load Helper File System
        $ktp = $this->request->getFile('ktp');
        $kk = $this->request->getFile('kk');
        $akte = $this->request->getFile('akte');
        $ktm = $this->request->getFile('ktm');
        $ijazah = $this->request->getFile('ijazah');
        $data_diri = $this->request->getFile('data_diri');

        if (!empty($ktp)) {
            $nama_ktp_baru = $username . '_' . $nama_mahasiswa . '_KTP.pdf';
            $size_ktp = $ktp->getSizeByUnit('kb');
        }
        if (!empty($kk)) {
            $nama_kk_baru = $username . '_' . $nama_mahasiswa . '_KK.pdf';
            $size_kk = $kk->getSizeByUnit('kb');
        }
        if (!empty($akte)) {
            $nama_akte_baru = $username . '_' . $nama_mahasiswa . '_AKTE.pdf';
            $size_akte = $akte->getSizeByUnit('kb');
        }
        if (!empty($ktm)) {
            $nama_ktm_baru = $username . '_' . $nama_mahasiswa . '_KTM.pdf';
            $size_ktm = $ktm->getSizeByUnit('kb');
        }
        if (!empty($ijazah)) {
            $nama_ijazah_baru = $username . '_' . $nama_mahasiswa . '_Ijazah.pdf';
            $size_ijazah = $ijazah->getSizeByUnit('kb');
        }
        if (!empty($data_diri)) {
            $nama_data_diri_baru = $username . '_' . $nama_mahasiswa . '_DataPDDIKTI.pdf';
            $size_data_diri = $data_diri->getSizeByUnit('kb');
        }

        if (!empty($ktp)) {
            if (($size_ktp > 150) && ($size_ktp < 5000)) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_ktp_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_ktp_baru");
                    }
                }
                $ktp->move("uploads/$username $nama_mahasiswa/", $nama_ktp_baru);
                $data = [
                    'ktp' => $nama_ktp_baru,
                ];

                $model->updateDataDiri($data, $no_data_diri);

                $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
                return redirect()->to('/DataDiri');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 150KB Dan Lebih Dari 5MB']);
                return redirect()->to('/DataDiri');
            }
        }
        if (!empty($kk)) {
            if (($size_kk > 150) && ($size_kk < 5000)) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_kk_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_kk_baru");
                    }
                }
                $kk->move("uploads/$username $nama_mahasiswa/", $nama_kk_baru);
                $data = [
                    'kk' => $nama_kk_baru,
                ];


                $model->updateDataDiri($data, $no_data_diri);

                $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
                return redirect()->to('/DataDiri');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 150KB Dan Lebih Dari 5MB']);
                return redirect()->to('/DataDiri');
            }
        }
        if (!empty($akte)) {
            if (($size_akte > 150) && ($size_akte < 5000)) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_akte_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_akte_baru");
                    }
                }
                $akte->move("uploads/$username $nama_mahasiswa/", $nama_akte_baru);
                $data = [
                    'akte' => $nama_akte_baru,
                ];

                $model->updateDataDiri($data, $no_data_diri);

                $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
                return redirect()->to('/DataDiri');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 150KB Dan Lebih Dari 5MB']);
                return redirect()->to('/DataDiri');
            }
        }
        if (!empty($ktm)) {
            if (($size_ktm > 150) && ($size_ktm < 5000)) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_ktm_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_ktm_baru");
                    }
                }
                $ktm->move("uploads/$username $nama_mahasiswa/", $nama_ktm_baru);
                $data = [
                    'ktm' => $nama_ktm_baru,
                ];

                $model->updateDataDiri($data, $no_data_diri);

                $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
                return redirect()->to('/DataDiri');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 150KB Dan Lebih Dari 5MB']);
                return redirect()->to('/DataDiri');
            }
        }
        if (!empty($ijazah)) {
            if (($size_ijazah > 150) && ($size_ijazah < 5000)) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_ijazah_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_ijazah_baru");
                    }
                }
                $ijazah->move("uploads/$username $nama_mahasiswa/", $nama_ijazah_baru);
                $data = [
                    'ijazah' => $nama_ijazah_baru,
                ];


                $model->updateDataDiri($data, $no_data_diri);

                $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
                return redirect()->to('/DataDiri');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 150KB Dan Lebih Dari 5MB']);
                return redirect()->to('/DataDiri');
            }
        }
        if (!empty($data_diri)) {
            if (($size_data_diri > 150) && ($size_data_diri < 5000)) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_data_diri_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_data_diri_baru");
                    }
                }
                $data_diri->move("uploads/$username $nama_mahasiswa/", $nama_data_diri_baru);
                $data = [
                    'data_diri' => $nama_data_diri_baru,
                ];

                $model->updateDataDiri($data, $no_data_diri);

                $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
                return redirect()->to('/DataDiri');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 150KB Dan Lebih Dari 5MB']);
                return redirect()->to('/DataDiri');
            }
        }
    }
}
