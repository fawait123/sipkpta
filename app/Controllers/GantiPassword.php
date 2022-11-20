<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;

class GantiPassword extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function index()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Ganti Password";
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
            echo view('ganti_password', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function gantiPassword()
    {
        if ($this->request->getPost()) {

            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'ganti');
            $errors = $this->validation->getErrors();

            if ($errors) {
                $this->session->setFlashdata('errors', $errors);
                return view('ganti_password');
            }

            $userModel = new \App\Models\UserModel();

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $userModel->where('username', $username)->first();

            if ($user) {
                $status = $user->status;
                if ($user->password !== md5($status . $password)) {
                    $this->session->setFlashdata('errors', ['Password Salah']);
                } else {
                    $angka = $this->request->getPost('angka1') + $this->request->getPost('angka2');
                    $hasil = $this->request->getPost('c');
                    if ($angka == $hasil) {

                        $user->password = $this->request->getPost('passwordbaru');

                        $userModel->save($user);

                        return redirect()->to(site_url('Auth/logout'));
                    } else {
                        $this->session->setFlashdata('errors', ['Captcha Salah']);
                    }
                }
            } else {
                $this->session->setFlashdata('errors', ['User Tidak Ditemukan']);
            }
        }
        return view('ganti_password');
    }
}
