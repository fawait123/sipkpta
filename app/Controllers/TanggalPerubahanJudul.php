<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;
use App\Models\TanggalPerubahan;

class TanggalPerubahanJudul extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $bread = new LibrariesBreadcrumb();
        $data['breadcrumbs'] = $bread->buildAuto();
        $session = session();
        $data['title'] = "Tanggal Perubahan Judul";
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
        $model2 = new TanggalPerubahan();
        $data['jenis'] = "KP";
        $data['tahun_ajaran'] = $session->get('tahun_ajaran');
        $data['semester'] = $session->get('semester');
        $data['tanggal'] = $model2->getOne()->getRow();
        echo view('perubahan/index', $data);
    }

    public function update()
    {
        $model = new TanggalPerubahan();
        $id = $this->request->getPost('id');
        if ($this->request->getPost('id')) {
            $data = [
                'start'    =>    $this->request->getPost('start'),
                'end'        =>    $this->request->getPost('end')
            ];
            $model->updateTanggal($data, $id);

            $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
            return redirect()->to('/perubahan/review-tanggal');
        }
    }
}
