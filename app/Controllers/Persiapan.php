<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PersiapanModel;
use App\Models\SekprodModel;
use CodeIgniter\I18n\Time;

class Persiapan extends BaseController
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
            $data['title'] = "Persiapan Pengajuan";
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
            $model2 = new PersiapanModel();
            $data['pengumumankp'] = $model2->getPengumumanKP()->getResult();
            $data['pengumumanta'] = $model2->getPengumumanTA()->getResult();
            $data['tanggalkp'] = $model2->getTanggalKP()->getResult();
            $data['tanggalta'] = $model2->getTanggalTA()->getResult();
            $data['tanggalperpanjang'] = $model2->getTanggalPerpanjang()->getResult();
            $data['tahun_ajaran'] = $model2->getTahunAjaran()->getResult();
            echo view('persiapan', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function updateTahunAjaran()
    {
        $model = new PersiapanModel();
        $id = $this->request->getPost('id');
        $tahun_ajaran = $this->request->getPost('tahun_ajaran') . "/" . $this->request->getPost('tahun_ajaran2');
        $semester = $this->request->getPost('semester');
        $batas_bimbingan = $this->request->getPost('batas_bimbingan');
        $data = [
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'batas_bimbingan' => $batas_bimbingan,
        ];
        $model->updateTahunAjaran($data, $id);

        $sessData = [
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'batas_bimbingan' => $batas_bimbingan,
        ];

        $this->session->set($sessData);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/persiapan');
    }

    public function updateKP()
    {
        $model = new PersiapanModel();
        $id = $this->request->getPost('id');
        $data = [
            'pengumuman'        => $this->request->getPost('pengumuman'),
            'kode_topik'        => $this->request->getPost('kode_topik'),
            'judul'        => $this->request->getPost('judul'),
            'studi_kasus'        => $this->request->getPost('studi_kasus'),
            'nilai_de'        => $this->request->getPost('nilai_de'),
            'mk_nilai_de'        => $this->request->getPost('mk_nilai_de'),
            'nik'        => $this->request->getPost('nik'),
            'bukti_proposal'        => $this->request->getPost('bukti_proposal'),
            'jumlah_sks'        => $this->request->getPost('jumlah_sks'),
            'ipk'        => $this->request->getPost('ipk'),
            'proposal'        => $this->request->getPost('proposal'),
            'sertifikat_sosialisasi'        => $this->request->getPost('sertifikat_sosialisasi'),
        ];
        $model->updatePengumuman($data, $id);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/persiapan');
    }

    public function updateTA()
    {
        $model = new PersiapanModel();
        $id = $this->request->getPost('id2');
        $data = [
            'pengumuman'        => $this->request->getPost('pengumuman2'),
            'kode_topik'        => $this->request->getPost('kode_topik2'),
            'judul'        => $this->request->getPost('judul2'),
            'studi_kasus'        => $this->request->getPost('studi_kasus2'),
            'nilai_de'        => $this->request->getPost('nilai_de2'),
            'mk_nilai_de'        => $this->request->getPost('mk_nilai_de2'),
            'nik'        => $this->request->getPost('nik2'),
            'bukti_proposal'        => $this->request->getPost('bukti_proposal2'),
            'proposal'        => $this->request->getPost('proposal2'),
            'bukti_spp'        => $this->request->getPost('bukti_spp2'),
            'surat'        => $this->request->getPost('surat2'),
            'sertifikat_sosialisasi'        => $this->request->getPost('sertifikat_sosialisasi2'),
        ];
        $model->updatePengumuman($data, $id);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/persiapan');
    }

    function updateTanggalKP()
    {
        $model = new PersiapanModel();
        $id = $this->request->getPost('id');
        if ($this->request->getPost('id')) {
            $data = [
                'start'    =>    $this->request->getPost('start'),
                'end'        =>    $this->request->getPost('end')
            ];
            $model->updateTanggal($data, $id);

            $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
            return redirect()->to('/persiapan');
        }
    }

    function updateTanggalTA()
    {
        $model = new PersiapanModel();
        $id = $this->request->getPost('id');
        if ($this->request->getPost('id')) {
            $data = [
                'start'    =>    $this->request->getPost('start2'),
                'end'        =>    $this->request->getPost('end2')
            ];
            $model->updateTanggal($data, $id);

            $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
            return redirect()->to('/persiapan');
        }
    }

    function updateTanggalPerpanjang()
    {
        $model = new PersiapanModel();
        $id = $this->request->getPost('id');
        if ($this->request->getPost('id')) {
            $data = [
                'start'    =>    $this->request->getPost('start3'),
                'end'        =>    $this->request->getPost('end3')
            ];
            $model->updateTanggal($data, $id);

            $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
            return redirect()->to('/persiapan');
        }
    }
}
