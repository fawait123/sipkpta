<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\BerkasModel;
use App\Models\DataDiriModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\SekprodModel;

class Berkas extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function berkasKP()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Berkas";
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
            $model2 = new BerkasModel();
            $data['jenis'] = "KP";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_berkas'] = $model2->getBerkas($jenis, $tahun_ajaran, $semester)->getResult();
            echo view('berkas', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function berkasTA()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Berkas";
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
            $model2 = new BerkasModel();
            $data['jenis'] = "TA";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_berkas'] = $model2->getBerkas($jenis, $tahun_ajaran, $semester)->getResult();
            echo view('berkas', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function detailKP($no_berkas)
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Berkas";
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
            $model2 = new BerkasModel();
            $data['jenis'] = "KP";
            $jenis = $data['jenis'];
            $request = \Config\Services::request();
            $npm = $request->uri->getSegment(4);
            $data['tb_berkas_detail'] = $model2->getBerkasDetail($no_berkas)->getResult();
            echo view('berkas_detail', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function detailTA($no_berkas)
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Berkas";
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
            $model2 = new BerkasModel();
            $data['jenis'] = "TA";
            $jenis = $data['jenis'];
            $request = \Config\Services::request();
            $npm = $request->uri->getSegment(4);
            $data['tb_berkas_detail'] = $model2->getBerkasDetail($no_berkas)->getResult();
            echo view('berkas_detail', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function downloadBerkasKTP($no_data_diri, $username, $nama_mahasiswa)
    {
        $model = new DataDiriModel();
        $data = $model->find($no_data_diri);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["ktp"], null);
    }
    public function downloadBerkasKK($no_data_diri, $username, $nama_mahasiswa)
    {
        $model = new DataDiriModel();
        $data = $model->find($no_data_diri);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["kk"], null);
    }
    public function downloadBerkasAKTE($no_data_diri, $username, $nama_mahasiswa)
    {
        $model = new DataDiriModel();
        $data = $model->find($no_data_diri);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["akte"], null);
    }
    public function downloadBerkasKTM($no_data_diri, $username, $nama_mahasiswa)
    {
        $model = new DataDiriModel();
        $data = $model->find($no_data_diri);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["ktm"], null);
    }
    public function downloadBerkasIjazah($no_data_diri, $username, $nama_mahasiswa)
    {
        $model = new DataDiriModel();
        $data = $model->find($no_data_diri);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["ijazah"], null);
    }
    public function downloadBerkasDataDiri($no_data_diri, $username, $nama_mahasiswa)
    {
        $model = new DataDiriModel();
        $data = $model->find($no_data_diri);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["data_diri"], null);
    }
    public function downloadBerkasSurat($no_berkas, $username, $nama_mahasiswa)
    {
        $model = new BerkasModel();
        $data = $model->find($no_berkas);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["surat"], null);
    }
    public function downloadBerkasBuktiProposal($no_berkas, $username, $nama_mahasiswa)
    {
        $model = new BerkasModel();
        $data = $model->find($no_berkas);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["bukti_proposal"], null);
    }
    public function downloadBerkasBuktiSPP($no_berkas, $username, $nama_mahasiswa)
    {
        $model = new BerkasModel();
        $data = $model->find($no_berkas);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["bukti_spp"], null);
    }
    public function downloadBerkasSertifikatSosialisasi($no_berkas, $username, $nama_mahasiswa)
    {
        $model = new BerkasModel();
        $data = $model->find($no_berkas);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["sertifikat_sosialisasi"], null);
    }

    public function update()
    {
        $model = new BerkasModel();
        $no_berkas = $this->request->getPost('no_berkas');
        $data = [
            'status_berkas'        => $this->request->getPost('status_berkas'),
            'catatan_berkas'        => $this->request->getPost('catatan_berkas'),
            'id_admin'        => $this->request->getPost('id_admin')
        ];
        $model->updateBerkas($data, $no_berkas);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/berkas/berkasKP');
        } else {
            return redirect()->to('/berkas/berkasTA');
        }
    }
}
