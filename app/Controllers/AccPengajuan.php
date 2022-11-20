<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\NilaiModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PengajuanModel;
use App\Models\PlotingModel;
use App\Models\SekprodModel;

class AccPengajuan extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function accKP()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "ACC Pengajuan";
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
            $model2 = new PengajuanModel();
            $data['jenis'] = "KP";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['acc_pengajuan'] = $model2->getAccPengajuan($jenis, $tahun_ajaran, $semester)->getResult();
            echo view('acc_pengajuan', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function accTA()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Acc Pengajuan";
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
            $model2 = new PengajuanModel();
            $data['jenis'] = "TA";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['acc_pengajuan'] = $model2->getAccPengajuan($jenis, $tahun_ajaran, $semester)->getResult();
            echo view('acc_pengajuan', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function update()
    {
        $model = new PengajuanModel();
        $no_pengajuan = $this->request->getPost('no_pengajuan');
        $nik = $this->request->getPost('nik');
        $data = [
            'status_pengajuan' => "ACC",
        ];
        $model->updatePengajuan($data, $no_pengajuan);

        $model2 = new PlotingModel();

        $kode3 = $model2->autoCodeReviewer()->getResult();
        foreach ($kode3 as $data3) {
            $a3 = $data3->no_ploting_reviewer;
            $a3++;
            $huruf3 = "PR";
            date_default_timezone_set('Asia/Jakarta');
            $tanggal3 = date('YmdHs');
            $kode3 = $huruf3 . $tanggal3 . sprintf("%03s", $a3);

            $data3 = [
                'no_ploting_reviewer' => $kode3,
                'no_pengajuan' => $no_pengajuan,
                'nik' => null,
                'status_ploting' => "Belum Diploting",
                'jenis' => $this->request->getPost('jenis'),
                'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
                'semester' => $this->request->getPost('semester'),
            ];
        }
        $model2->saveReviewer($data3);

        $kode2 = $model2->autoCodePembimbing()->getResult();
        foreach ($kode2 as $data2) {
            $a2 = $data2->no_ploting_pembimbing;
            $a2++;
            $huruf2 = "PP";
            date_default_timezone_set('Asia/Jakarta');
            $tanggal2 = date('YmdHs');
            $kode2 = $huruf2 . $tanggal2 . sprintf("%03s", $a2);

            $data2 = [
                'no_ploting_pembimbing' => $kode2,
                'no_pengajuan' => $no_pengajuan,
                'nik' => $nik,
                'status_ploting' => "Belum Diploting",
                'jenis' => $this->request->getPost('jenis'),
                'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
                'semester' => $this->request->getPost('semester'),
            ];
        }
        $model2->savePembimbing($data2);

        $kode4 = $model2->autoCodeDisposisi()->getResult();
        foreach ($kode4 as $data4) {
            $a4 = $data4->no_disposisi;
            $a4++;
            $huruf4 = "DP";
            date_default_timezone_set('Asia/Jakarta');
            $tanggal4 = date('YmdHs');
            $kode4 = $huruf4 . $tanggal4 . sprintf("%03s", $a4);

            $data4 = [
                'no_disposisi' => $kode4,
                'no_ploting_pembimbing' => $kode2,
                'no_pengajuan' => $no_pengajuan,
                'nik' => $nik,
                'jenis' => $this->request->getPost('jenis'),
                'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
                'semester' => $this->request->getPost('semester'),
                'status_disposisi' => "Belum Disposisi",
            ];
        }
        $model2->saveDisposisi($data4);

        $kode5 = $model2->autoCodeReview()->getResult();
        foreach ($kode5 as $data5) {
            $a5 = $data5->no_detail_review;
            $a5++;
            $huruf5 = "RP";
            date_default_timezone_set('Asia/Jakarta');
            $tanggal5 = date('YmdHs');
            $kode5 = $huruf5 . $tanggal5 . sprintf("%03s", $a5);

            $data5 = [
                'no_detail_review' => $kode5,
                'no_ploting_pembimbing' => $kode2,
                'jenis' => $this->request->getPost('jenis'),
                'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
                'semester' => $this->request->getPost('semester'),
                'no_pengajuan' => $no_pengajuan,
                'status_review' => "Belum Direview",
            ];
        }
        $model2->saveReview($data5);

        $kode6 = $model2->autoCodeReview()->getResult();
        foreach ($kode6 as $data6) {
            $a6 = $data6->no_detail_review;
            $a6++;
            $huruf6 = "RP";
            date_default_timezone_set('Asia/Jakarta');
            $tanggal6 = date('YmdHs');
            $kode6 = $huruf6 . $tanggal6 . sprintf("%03s", $a6);

            $data6 = [
                'no_detail_review' => $kode6,
                'no_ploting_reviewer' => $kode3,
                'jenis' => $this->request->getPost('jenis'),
                'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
                'semester' => $this->request->getPost('semester'),
                'no_pengajuan' => $no_pengajuan,
                'status_review' => "Belum Direview",
            ];
        }
        $model2->saveReview2($data6);


        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/AccPengajuan/accKP');
        } else {
            return redirect()->to('/AccPengajuan/accTA');
        }
    }

    public function cancel()
    {
        $model = new PengajuanModel();
        $no_pengajuan = $this->request->getPost('no_pengajuan2');
        $data = [
            'status_pengajuan' => "Belum Diverifikasi Kaprodi",
        ];
        $model->updatePengajuan($data, $no_pengajuan);

        $model2 = new PlotingModel();

        $model2->deleteReviewer($no_pengajuan);

        $model2->deletePembimbing($no_pengajuan);

        $model2->deleteDisposisi($no_pengajuan);

        $model2->deleteReview($no_pengajuan);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/AccPengajuan/accKP');
        } else {
            return redirect()->to('/AccPengajuan/accTA');
        }
    }

    public function delete()
    {
        $model = new PengajuanModel();
        $no_pengajuan = $this->request->getPost('no_pengajuan5');
        $no_berkas = $this->request->getPost('no_berkas');
        $no_nilai = $this->request->getPost('no_nilai');
        $no_proposal = $this->request->getPost('no_proposal');

        $model->deletePengajuan($no_pengajuan);
        $model->deleteBerkas($no_berkas);
        $model->deleteNilai($no_nilai);
        $model->deleteProposal($no_proposal);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/AccPengajuan/accKP');
        } else {
            return redirect()->to('/AccPengajuan/accTA');
        }
    }

    public function update2()
    {
        $model = new PengajuanModel();
        $no_pengajuan = $this->request->getPost('no_pengajuan3');
        $data = [
            'catatan_pengajuan'        => $this->request->getPost('catatan_pengajuan')
        ];
        $model->updatePengajuan($data, $no_pengajuan);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/AccPengajuan/accKP');
        } else {
            return redirect()->to('/AccPengajuan/accTA');
        }
    }

    public function tolak()
    {
        $model = new PengajuanModel();
        $no_pengajuan = $this->request->getPost('no_pengajuan4');

        $data = [
            'status_pengajuan'        => "Ditolak"
        ];
        $model->updatePengajuan($data, $no_pengajuan);

        $model2 = new PlotingModel();

        $model2->deleteReviewer($no_pengajuan);

        $model2->deletePembimbing($no_pengajuan);

        $model2->deleteDisposisi($no_pengajuan);

        $model2->deleteReview($no_pengajuan);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/AccPengajuan/accKP');
        } else {
            return redirect()->to('/AccPengajuan/accTA');
        }
    }
}
