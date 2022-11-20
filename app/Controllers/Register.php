<?php

namespace App\Controllers;

use App\Entities\User;
use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;
use App\Models\UserModel;

class Register extends BaseController
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
            $data['title'] = "Data User";
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
            $model2 = new UserModel();
            $data['tb_user'] = $model2->getAllUser()->getResult();
            echo view('register', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function delete()
    {
        $role = $this->request->getPost('role');
        $username = $this->request->getPost('username2');
        if ($role == "admin") {
            $model = new AdminModel();
            $model->deleteAdmin($username);
        } elseif ($role == "sekprod") {
            $model = new SekprodModel();
            $model->deleteSekprod($username);
        } elseif ($role == "kaprodi") {
            $model = new KaprodiModel();
            $model->deleteKaprodi($username);
        }

        $model2 = new UserModel();
        $model2->deleteUser($username);

        $this->session->setFlashdata('success', ['Data Berhasil Dihapus']);
        return redirect()->to('/register');
    }
}
