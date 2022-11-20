<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;
use App\Models\TopikKuotaModel;
use App\Models\TopikModel;

class Topik extends BaseController
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
            $data['title'] = "Data Topik";
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
            $model2 = new TopikModel();
            $data['user'] = $model->getUser($username)->getResult();
            $data['tb_topik'] = $model2->getTopik()->getResult();
            $data['kode'] = $model2->autoCode()->getResult();
            echo view('topik', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function cektopik()
    {
        $model = new TopikModel();
        $nama_topik = $this->request->getPost('nama_topik');
        $nama_topik2 = $model->cekTopik($nama_topik)->getResult();
        $count2 = count($nama_topik2);
        if (empty($count2)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function save()
    {
        $model = new TopikModel();
        $data = [
            'kode_topik' => $this->request->getPost('kode_topik'),
            'nama_topik'        => $this->request->getPost('nama_topik')
        ];
        $model->saveTopik($data);

        $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
        return redirect()->to('/topik');
    }

    public function update()
    {
        $model = new TopikModel();
        $kode = $this->request->getPost('kode_topik');
        $data = [
            'kode_topik' => $this->request->getPost('kode_topik'),
            'nama_topik'        => $this->request->getPost('nama_topik')
        ];
        $model->updateTopik($data, $kode);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/topik');
    }

    public function delete()
    {
        $model = new TopikModel();
        $kode = $this->request->getPost('kode_topik');
        $model->deleteTopik($kode);

        $this->session->setFlashdata('success', ['Data Berhasil Dihapus']);
        return redirect()->to('/topik');
    }
}
