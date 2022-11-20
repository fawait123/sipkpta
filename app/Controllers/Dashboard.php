<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\BimbinganModel;
use App\Models\DashboardModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;

class Dashboard extends BaseController
{

    public function index()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Dashboard";
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
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $model2 = new DashboardModel();
            $data['total_mahasiswa'] = $model2->getMahasiswa()->getResult();
            $data['total_dosen'] = $model2->getDosen()->getResult();
            $data['total_topik'] = $model2->getTopik()->getResult();
            $data['total_pengajuan'] = $model2->getPengajuan($tahun_ajaran, $semester)->getResult();
            $data['tb_topik'] = $model2->getDosenTopik($tahun_ajaran, $semester)->getResult();
            $data['tanggalkp'] = $model2->getTanggalKP()->getResult();
            $data['tanggalta'] = $model2->getTanggalTA()->getResult();
            $data['total_user'] = $model2->getAllUser()->getResult();
            $data['tb_pengajuan'] = $model2->getAccPengajuan($tahun_ajaran, $semester)->getResult();
            $data['tb_ploting'] = $model2->getPloting($tahun_ajaran, $semester)->getResult();
            $data['tb_disposisi'] = $model2->getDisposisi($tahun_ajaran, $semester)->getResult();
            $data['tb_nilai'] = $model2->getNilai($tahun_ajaran, $semester)->getResult();
            echo view('dashboard', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function dosen()
    {
        $bread = new LibrariesBreadcrumb();
        $data['breadcrumbs'] = $bread->buildAuto();
        $session = session();
        $data['title'] = "Dashboard Dosen";
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
        $bimbingan = new BimbinganModel();
        $data['user'] = $model->getUser($username)->getResult();
        $data['bimbingan'] = $bimbingan->getBimbingan2(session()->get('username'))->getResult();
        echo view('dashboard/dosen', $data);
    }
}
