<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\NilaiModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;

class Nilai extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function nilaiKP()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Nilai";
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
            $model2 = new NilaiModel();
            $data['jenis'] = "KP";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_nilai'] = $model2->getNilai($jenis, $tahun_ajaran, $semester)->getResult();
            echo view('nilai', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function nilaiTA()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Nilai";
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
            $model2 = new NilaiModel();
            $data['jenis'] = "TA";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_nilai'] = $model2->getNilai($jenis, $tahun_ajaran, $semester)->getResult();
            echo view('nilai', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function update()
    {
        $model = new NilaiModel();
        $no_nilai = $this->request->getPost('no_nilai');
        $data = [
            'nilai_de'        => $this->request->getPost('nilai_de'),
            'mk_nilai_de'        => $this->request->getPost('mk_nilai_de'),
            'jumlah_sks'        => $this->request->getPost('jumlah_sks'),
            'ipk'        => $this->request->getPost('ipk'),
            'status_nilai'        => $this->request->getPost('status_nilai'),
            'catatan_nilai'        => $this->request->getPost('catatan_nilai'),
            'id_sekprod'        => $this->request->getPost('id_sekprod')
        ];
        $model->updateNilai($data, $no_nilai);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/nilai/nilaikp');
        } else {
            return redirect()->to('/nilai/nilaita');
        }
    }
}
