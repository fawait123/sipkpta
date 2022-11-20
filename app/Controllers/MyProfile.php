<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;

class MyProfile extends BaseController
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
            $data['title'] = "Profil Saya";
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
            echo view('myprofile', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function update()
    {
        $model = new DosenModel();
        $nik = $this->request->getPost('nik');
        $data = [
            'nik' => $this->request->getPost('nik'),
            'username' => $this->request->getPost('nik'),
            'nama_dosen'        => $this->request->getPost('nama_dosen'),
            'nidn'        => $this->request->getPost('nidn'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'email'        => $this->request->getPost('email'),
            'jabatan_fungsional'        => $this->request->getPost('jabatan_fungsional'),
            'status_homebase'        => $this->request->getPost('status_homebase'),
            'status_menjabat'        => $this->request->getPost('status_menjabat'),
            'link_kp'        => $this->request->getPost('link_kp'),
            'link_ta'        => $this->request->getPost('link_ta'),
        ];
        $model->updateDosen($data, $nik);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/MyProfile');
    }
}
