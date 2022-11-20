<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PersiapanModel;
use App\Models\SekprodModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function index()
    {
        $model = new PersiapanModel();
        $data['tahun_ajaran'] = $model->getTahunAjaran()->getResult();
        echo view('login', $data);
    }

    public function cekusername()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $username2 = $model->cekUsername($username)->getResult();
        $count2 = count($username2);
        if (empty($count2)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function register()
    {
        if ($this->request->getPost()) {
            $angka = $this->request->getPost('angka1') + $this->request->getPost('angka2');
            $hasil = $this->request->getPost('c');
            $userModel = new \App\Models\UserModel();
            $user = new \App\Entities\User();
            $role = $this->request->getPost('role');

            if ($angka == $hasil) {

                $user->username = $this->request->getPost('username');
                $user->password = $this->request->getPost('password');
                $user->role = $role;

                $userModel->save($user);

                if ($role == "admin") {
                    $model = new AdminModel();
                    $data = [
                        'username'        => $this->request->getPost('username'),
                        'nama_admin'        => $this->request->getPost('nama'),
                    ];
                } elseif ($role == "sekprod") {
                    $model = new SekprodModel();
                    $data = [
                        'username'        => $this->request->getPost('username'),
                        'nama_sekprod'        => $this->request->getPost('nama'),
                    ];
                } elseif ($role == "kaprodi") {
                    $model = new KaprodiModel();
                    $data = [
                        'username'        => $this->request->getPost('username'),
                        'nama_kaprodi'        => $this->request->getPost('nama'),
                    ];
                }
                $model->saveNama($data);

                $this->session->setFlashdata('success', ['User Berhasil Ditambahkan']);
                return redirect()->to(site_url('Register'));
            }
            $this->session->setFlashdata('errors', ['Captcha Salah']);
        }
        return view('register');
    }

    public function login()
    {
        if ($this->request->getPost()) {

            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'login');
            $errors = $this->validation->getErrors();
            $errors2 = $this->validation->getErrors();

            $userModel = new \App\Models\UserModel();

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $tahun_ajaran = $this->request->getPost('tahun_ajaran');
            $semester = $this->request->getPost('semester');
            $batas_bimbingan = $this->request->getPost('batas_bimbingan');

            $user = $userModel->where('username', $username)->first();

            if ($user) {
                $status = $user->status;
                $role = $user->role;
                if ($user->password !== md5($status . $password)) {
                    $this->session->setFlashdata('errors', ['Password Salah']);
                } else {
                    $angka = $this->request->getPost('angka1') + $this->request->getPost('angka2');
                    $hasil = $this->request->getPost('c');
                    if ($angka == $hasil) {
                        $sessData = [
                            'username' => $user->username,
                            'role' => $user->role,
                            'tahun_ajaran' => $tahun_ajaran,
                            'semester' => $semester,
                            'batas_bimbingan' => $batas_bimbingan,
                            'isLoggedIn' => TRUE
                        ];

                        $this->session->set($sessData);
                        if ($role == "admin") {
                            return redirect()->to(site_url('Dashboard'));
                        } elseif ($role == "sekprod") {
                            return redirect()->to(site_url('Nilai/nilaiKP'));
                        } elseif ($role == "kaprodi") {
                            return redirect()->to(site_url('Dashboard'));
                        } elseif ($role == "dosen") {
                            return redirect()->to(site_url('ReviewProposal/reviewKP'));
                        } elseif ($role == "mahasiswa") {
                            return redirect()->to(site_url('Pengajuan/pengajuanKP'));
                        }
                    } else {
                        $this->session->setFlashdata('errors2', ['Captcha Salah']);
                    }
                }
            } else {
                $this->session->setFlashdata('errors', ['User Tidak Ditemukan']);
            }
        }
        return redirect()->to(site_url('Auth'));
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('Auth'));
    }
}
