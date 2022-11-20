<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PersiapanModel;
use App\Models\SekprodModel;
use App\Models\TopikKuotaModel;

class TopikKuota extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function kuotaKP()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Topik dan Kuota";
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
            $model2 = new TopikKuotaModel();
            $data['user'] = $model->getUser($username)->getResult();
            $data['tb_topik'] = $model2->getTopik()->getResult();
            $data['tb_dosen'] = $model2->getDosen()->getResult();
            $jenis = "KP";
            $data['jenis'] = "KP";
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['kode_detail'] = $model2->autoCode()->getResult();
            $data['tb_detail_topik'] = $model2->getDosenTopik($jenis, $tahun_ajaran, $semester)->getResult();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            echo view('topik_kuota', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function kuotaTA()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Topik dan Kuota";
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
            $model2 = new TopikKuotaModel();
            $data['user'] = $model->getUser($username)->getResult();
            $data['tb_topik'] = $model2->getTopik()->getResult();
            $data['tb_dosen'] = $model2->getDosen()->getResult();
            $jenis = "TA";
            $data['jenis'] = "TA";
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['kode_detail'] = $model2->autoCode()->getResult();
            $data['tb_detail_topik'] = $model2->getDosenTopik($jenis, $tahun_ajaran, $semester)->getResult();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            echo view('topik_kuota', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function save()
    {
        $model = new TopikKuotaModel();
        $jenis = $this->request->getPost('jenis');
        if ($jenis == "KP") {
            $kode_topik = $this->request->getPost('kode_topik');
            $nik = $this->request->getPost('nik');
        } else {
            $kode_topik = $this->request->getPost('kode_topik2');
            $nik = $this->request->getPost('nik2');
        }
        $data = [
            'kode_detail' => $this->request->getPost('kode_detail'),
            'nik' => $nik,
            'kode_topik' => $kode_topik,
            'jenis' => $jenis,
            'kuota_awal'        => $this->request->getPost('kuota'),
            'kuota'        => $this->request->getPost('kuota'),
            'tahun_ajaran'        => $this->request->getPost('tahun_ajaran'),
            'semester'        => $this->request->getPost('semester'),
        ];
        $model->saveDetailTopik($data);
        $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
        if ($jenis == "KP") {
            return redirect()->to('/TopikKuota/kuotaKP');
        } else {
            return redirect()->to('/TopikKuota/kuotaTA');
        }
    }

    public function update()
    {
        $model = new TopikKuotaModel();
        $jenis = $this->request->getPost('jenis');
        $kode_detail = $this->request->getPost('kode_detail');
        $kuota_awal = $this->request->getPost('kuota_awal');
        $kuota_diambil = $this->request->getPost('kuota_diambil');
        $kuota = ((int)$kuota_awal - (int)$kuota_diambil);
        $data = [
            'kuota_awal'        => $kuota_awal,
            'kuota'        => $kuota
        ];
        $model->updateKuota($data, $kode_detail);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/TopikKuota/kuotaKP');
        } else {
            return redirect()->to('/TopikKuota/kuotaTA');
        }
    }

    public function delete()
    {
        $model = new TopikKuotaModel();
        $jenis = $this->request->getPost('jenis');
        $kode_detail = $this->request->getPost('kode_detail');
        $model->deleteDetailTopik($kode_detail);

        $this->session->setFlashdata('success', ['Data Berhasil Dihapus']);
        if ($jenis == "KP") {
            return redirect()->to('/TopikKuota/kuotaKP');
        } else {
            return redirect()->to('/TopikKuota/kuotaTA');
        }
    }

    public function getTopikKP()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $nik = $this->request->getGet('nik');
            $jenis = "KP";
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $model = new TopikKuotaModel();
            $data = $model->getTopik2($nik, $jenis, $tahun_ajaran, $semester)->getResult();
            return $this->response->setJSON($data);
        }
    }

    public function getTopikTA()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $nik = $this->request->getGet('nik2');
            $jenis = "TA";
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $model = new TopikKuotaModel();
            $data = $model->getTopik2($nik, $jenis, $tahun_ajaran, $semester)->getResult();
            return $this->response->setJSON($data);
        }
    }
}
