<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DisposisiModel;
use App\Models\NilaiModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PengajuanModel;
use App\Models\PlotingModel;
use App\Models\SekprodModel;
use App\Models\TopikKuotaModel;

class Ploting extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function plotingKP()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Ploting Dosen";
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
            $model2 = new PlotingModel();
            $data['jenis'] = "KP";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_ploting'] = $model2->getPloting($jenis, $tahun_ajaran, $semester)->getResult();
            $data['jumlah_pembimbing'] = $model2->getJumlahPembimbing($jenis, $tahun_ajaran, $semester)->getResult();
            $data['tb_topik'] = $model2->getTopik()->getResult();
            echo view('ploting', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function plotingTA()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Ploting Dosen";
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
            $model2 = new PlotingModel();
            $data['jenis'] = "TA";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_ploting'] = $model2->getPloting($jenis, $tahun_ajaran, $semester)->getResult();
            $data['jumlah_pembimbing'] = $model2->getJumlahPembimbing($jenis, $tahun_ajaran, $semester)->getResult();
            $data['tb_topik'] = $model2->getTopik()->getResult();
            echo view('ploting', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function rekapPloting()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Rekap Ploting Reviewer";
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
            $model2 = new PlotingModel();
            $data['tb_rekap_ploting'] = $model2->getRekapPloting($tahun_ajaran, $semester)->getResult();
            $data['tb_rekap_ploting2'] = $model2->getRekapPloting2($tahun_ajaran, $semester)->getResult();
            // $data['tb_rekap_ploting3'] = $model2->getRekapPloting3($tahun_ajaran, $semester)->getResult();
            echo view('rekap_ploting', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function updatePembimbing()
    {
        $model = new PlotingModel();
        $no_ploting_pembimbing = $this->request->getPost('no_ploting_pembimbing');
        $data = [
            'nik'        => $this->request->getPost('nik'),
            'id_kaprodi'        => $this->request->getPost('id_kaprodi'),
        ];
        $model->updatePembimbing($data, $no_ploting_pembimbing);

        $model = new DisposisiModel();
        $no_disposisi = $this->request->getPost('no_disposisi');
        $data = [
            'nik'        => $this->request->getPost('nik'),
        ];
        $model->updateDisposisi($data, $no_disposisi);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/ploting/plotingKP');
        } else {
            return redirect()->to('/ploting/plotingTA');
        }
    }

    public function updateReviewer()
    {
        $model = new PlotingModel();
        $no_ploting_reviewer = $this->request->getPost('no_ploting_reviewer');
        $data = [
            'nik'        => $this->request->getPost('nik'),
            'id_kaprodi'        => $this->request->getPost('id_kaprodi'),
        ];
        $model->updateReviewer($data, $no_ploting_reviewer);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/ploting/plotingKP');
        } else {
            return redirect()->to('/ploting/plotingTA');
        }
    }

    public function update()
    {
        $model = new PlotingModel();
        $no_ploting_pembimbing = $this->request->getPost('no_ploting_pembimbing');
        $no_ploting_reviewer = $this->request->getPost('no_ploting_reviewer');

        $data = [
            'status_ploting' => "Diploting",
        ];
        $model->updatePembimbing($data, $no_ploting_pembimbing);

        $data2 = [
            'status_ploting' => "Diploting",
        ];
        $model->updateReviewer($data2, $no_ploting_reviewer);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/ploting/plotingKP');
        } else {
            return redirect()->to('/ploting/plotingTA');
        }
    }

    public function getDosen()
    {
        if ($this->request->isAJAX()) {
            $kode_topik = $this->request->getGet('kode_topik');
            $model = new PlotingModel();
            $session = session();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data = $model->getDosen($kode_topik, $tahun_ajaran, $semester)->getResult();
            return $this->response->setJSON($data);
        }
    }

    public function updateDosen()
    {
        $model = new PengajuanModel();
        $this->session = session();
        $jenis = $this->request->getPost('jenis');
        $no_pengajuan = $this->request->getPost('no_pengajuan');
        if ($jenis == "KP") {
            $kode_detail = $this->request->getPost('kode_detail');
        } else {
            $kode_detail = $this->request->getPost('kode_detail2');
        }
        $kode_detail3 = $this->request->getPost('kode_detail3');

        $kode_detail2 = $model->getKuota($kode_detail)->getResult();
        $count = count($kode_detail2);
        if (!empty($count)) {

            $data = [
                'kode_detail' => $kode_detail,
            ];

            $model->updatePengajuan($data, $no_pengajuan);

            $kuota = $model->getKuota($kode_detail)->getResult();
            foreach ($kuota as $row) {
                $sisa = $row->kuota;
                $sisa--;
                $nik = $row->nik;
            }

            $data4 = [
                'kuota' => $sisa,
            ];

            $model->updateKuota($data4, $kode_detail);

            $kuota2 = $model->getKuota2($kode_detail3)->getResult();
            foreach ($kuota2 as $row2) {
                $sisaa = $row2->kuota;
                $sisaa++;
            }

            $data5 = [
                'kuota' => $sisaa,
            ];

            $model->updateKuota2($data5, $kode_detail3);

            $model = new PlotingModel();
            $no_ploting_pembimbing = $this->request->getPost('no_ploting_pembimbing');
            $data = [
                'nik'        => $nik,
            ];
            $model->updatePembimbing($data, $no_ploting_pembimbing);

            $model = new DisposisiModel();
            $no_disposisi = $this->request->getPost('no_disposisi');
            $data = [
                'nik'        => $nik,
            ];
            $model->updateDisposisi($data, $no_disposisi);

            $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
            if ($jenis == "KP") {
                return redirect()->to('/ploting/plotingKP');
            } else {
                return redirect()->to('/ploting/plotingTA');
            }
        } else {
            $this->session->setFlashdata('errors', ['Maaf Kuota Dosen Yang Anda Pilih Sudah Habis']);
            if ($jenis == "KP") {
                return redirect()->to('/ploting/plotingKP');
            } else {
                return redirect()->to('/ploting/plotingTA');
            }
        }
    }
}
