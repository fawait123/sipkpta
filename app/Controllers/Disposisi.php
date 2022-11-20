<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DisposisiModel;
use App\Models\NilaiModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PlotingModel;
use App\Models\SekprodModel;

class Disposisi extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function disposisi()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Rekap Mahasiswa Bimbingan";
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
            $model2 = new DisposisiModel();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_disposisi2'] = $model2->getDisposisi2($username, $tahun_ajaran, $semester)->getResult();
            $data['tb_disposisi4'] = $model2->getDisposisi4($tahun_ajaran, $semester)->getResult();
            echo view('rekap_disposisi', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function rekapPembimbing()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Rekap Dosen Pembimbing";
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
            $model2 = new DisposisiModel();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_rekap_pembimbing'] = $model2->getRekapPembimbing($tahun_ajaran, $semester)->getResult();
            $data['tb_disposisi4'] = $model2->getDisposisi4($tahun_ajaran, $semester)->getResult();
            echo view('rekap_pembimbing', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function disposisiKP()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Disposisi";
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
            $model2 = new DisposisiModel();
            $data['jenis'] = "KP";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_disposisi'] = $model2->getDisposisi($jenis, $tahun_ajaran, $semester)->getResult();
            $data['jumlah_pembimbing'] = $model2->getJumlahPembimbing($tahun_ajaran, $semester)->getResult();
            echo view('disposisi', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function disposisiTA()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Disposisi";
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
            $model2 = new DisposisiModel();
            $data['jenis'] = "TA";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_disposisi'] = $model2->getDisposisi($jenis, $tahun_ajaran, $semester)->getResult();
            $data['jumlah_pembimbing'] = $model2->getJumlahPembimbing($tahun_ajaran, $semester)->getResult();
            echo view('disposisi', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function updatePembimbing()
    {
        $model = new DisposisiModel();
        $no_disposisi = $this->request->getPost('no_disposisi');
        $data = [
            'nik'        => $this->request->getPost('nik'),
        ];
        $model->updateDisposisi($data, $no_disposisi);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/disposisi/disposisiKP');
        } else {
            return redirect()->to('/disposisi/disposisiTA');
        }
    }

    public function update()
    {
        $model = new DisposisiModel();
        $no_disposisi = $this->request->getPost('no_disposisi');
        $data = [
            'status_disposisi' => "Disposisi",
        ];
        $model->updateDisposisi($data, $no_disposisi);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/disposisi/disposisiKP');
        } else {
            return redirect()->to('/disposisi/disposisiTA');
        }
    }

    public function updateAll()
    {
        $model = new DisposisiModel();
        $semester = $this->request->getPost('semester');
        $tahun_ajaran = $this->request->getPost('tahun_ajaran');
        $jenis = $this->request->getPost('jenis');
        $data = [
            'status_disposisi' => "Disposisi",
        ];
        $model->updateDisposisiAll($data, $semester, $tahun_ajaran, $jenis);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/disposisi/disposisiKP');
        } else {
            return redirect()->to('/disposisi/disposisiTA');
        }
    }

    public function cancel()
    {
        $model = new DisposisiModel();
        $no_disposisi = $this->request->getPost('no_disposisi2');
        $data = [
            'status_disposisi' => "Belum Disposisi",
        ];
        $model->updateDisposisi($data, $no_disposisi);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/disposisi/disposisiKP');
        } else {
            return redirect()->to('/disposisi/disposisiTA');
        }
    }
}
