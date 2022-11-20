<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\BerkasModel;
use App\Models\BerkasPerpanjangModel;
use App\Models\DashboardModel;
use App\Models\DisposisiModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PengajuanModel;
use App\Models\PerpanjangModel;
use App\Models\PersiapanModel;
use App\Models\SekprodModel;
use CodeIgniter\I18n\Time;

class Perpanjang extends BaseController
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
            $data['title'] = "Perpanjang";
            $data['username'] = $session->get('username');
            $data['role'] = $session->get('role');
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
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
            $model2 = new PerpanjangModel();
            $data['tb_perpanjang'] = $model2->getPerpanjang($username)->getResult();
            $data['tb_disposisi'] = $model2->getDisposisiPerpanjang($username)->getResult();
            $data['tb_berkas_perpanjang'] = $model2->getBerkasPerpanjang($username)->getResult();
            $model3 = new PersiapanModel();
            $data['tanggal_perpanjang'] = $model3->getTanggalPerpanjang()->getResult();
            echo view('perpanjang', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function update()
    {
        $model = new perpanjangModel();
        $session = session();
        $jenis = $this->request->getPost('jenis');
        $username = $this->request->getPost('username');
        $no_pengajuan = $this->request->getPost('no_pengajuan');
        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa');

        helper('filesystem'); // Load Helper File System

        $kartu_bimbingan = $this->request->getFile('kartu_bimbingan');
        $nama_kartu_bimbingan_baru = $username . '_' . $nama_mahasiswa . '_Kartu.pdf';
        $size_kartu_bimbingan = $kartu_bimbingan->getSizeByUnit('kb');

        $bukti_spp_tetap2 = $this->request->getPost('bukti_spp_tetap2');
        if (!empty($bukti_spp_tetap2)) {
            $bukti_spp_tetap = $this->request->getFile('bukti_spp_tetap');
            $nama_bukti_spp_tetap_baru = $username . '_' . $nama_mahasiswa . '_SPPTetap.pdf';
            $size_bukti_spp_tetap = $bukti_spp_tetap->getSizeByUnit('kb');
        } else {
            $nama_bukti_spp_tetap_baru = "";
        }

        $bukti_spp_variabel2 = $this->request->getPost('bukti_spp_variabel2');
        if (!empty($bukti_spp_variabel2)) {
            $bukti_spp_variabel = $this->request->getFile('bukti_spp_variabel');
            $nama_bukti_spp_variabel_baru = $username . '_' . $nama_mahasiswa . '_BuktiSPP.pdf';
            $size_bukti_spp_variabel = $bukti_spp_variabel->getSizeByUnit('kb');
        } else {
            $nama_bukti_spp_variabel_baru = "";
        }

        $krs2 = $this->request->getPost('krs2');
        if (!empty($krs2)) {
            $krs = $this->request->getFile('krs');
            $nama_krs_baru = $username . '_' . $nama_mahasiswa . '_KRS.pdf';
            $size_krs = $krs->getSizeByUnit('kb');
        } else {
            $nama_krs_baru = "";
        }

        if (!empty($bukti_spp_variabel2)) {
            if (!empty($bukti_spp_tetap2)) {
                if (!empty($krs2)) {
                    $validation = ($size_kartu_bimbingan < 5000) && ($size_bukti_spp_tetap < 5000) && ($size_bukti_spp_variabel < 5000) &&
                        ($size_krs < 5000);
                } else {
                    $validation = ($size_kartu_bimbingan < 5000) && ($size_bukti_spp_tetap < 5000) && ($size_bukti_spp_variabel < 5000);
                }
            } else {
                if (!empty($krs2)) {
                    $validation = ($size_kartu_bimbingan < 5000) && ($size_bukti_spp_variabel < 5000) && ($size_krs < 5000);
                } else {
                    $validation = ($size_kartu_bimbingan < 5000) && ($size_bukti_spp_variabel < 5000);
                }
            }
        } else {
            if (!empty($bukti_spp_tetap2)) {
                if (!empty($krs2)) {
                    $validation = ($size_kartu_bimbingan < 5000) && ($size_bukti_spp_tetap < 5000) && ($size_krs < 5000);
                } else {
                    $validation = ($size_kartu_bimbingan < 5000) && ($size_bukti_spp_tetap < 5000);
                }
            } else {
                if (!empty($krs2)) {
                    $validation = ($size_kartu_bimbingan < 5000) && ($size_krs < 5000);
                } else {
                    $validation = ($size_kartu_bimbingan < 5000);
                }
            }
        }

        if ($validation) {
            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_kartu_bimbingan_baru) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_kartu_bimbingan_baru");
                }
            }
            $kartu_bimbingan->move("uploads/$username $nama_mahasiswa/", $nama_kartu_bimbingan_baru);

            if (!empty($bukti_spp_tetap2)) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_bukti_spp_tetap_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_bukti_spp_tetap_baru");
                    }
                }
                $bukti_spp_tetap->move("uploads/$username $nama_mahasiswa/", $nama_bukti_spp_tetap_baru);
            }

            if (!empty($bukti_spp_variabel2)) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_bukti_spp_variabel_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_bukti_spp_variabel_baru");
                    }
                }
                $bukti_spp_variabel->move("uploads/$username $nama_mahasiswa/", $nama_bukti_spp_variabel_baru);
            }

            if (!empty($krs2)) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_krs_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_krs_baru");
                    }
                }
                $krs->move("uploads/$username $nama_mahasiswa/", $nama_krs_baru);
            }

            $data = [
                'status_perpanjang' => "Perpanjang",
                'tahun_ajaran' => $session->get('tahun_ajaran'),
                'semester' => $session->get('semester'),
                'batas_bimbingan_perpanjang' => $session->get('batas_bimbingan'),
            ];
            $model->updatePengajuan($data, $no_pengajuan);

            $data2 = [
                'tahun_ajaran' => $session->get('tahun_ajaran'),
                'semester' => $session->get('semester'),
                'status_disposisi' => "Belum Disposisi",
            ];
            $model->updateDisposisi($data2, $no_pengajuan);

            $kode = $model->autoCode()->getResult();
            foreach ($kode as $data) {
                $a = $data->no_berkas_perpanjang;
                $a++;
                $huruf = "BP";
                date_default_timezone_set('Asia/Jakarta');
                $tanggal = date('YmdHs');
                $kode = $huruf . $tanggal . sprintf("%03s", $a);

                $data3 = [
                    'no_berkas_perpanjang' => $kode,
                    'npm' => $this->request->getPost('username'),
                    'jenis' => $this->request->getPost('jenis'),
                    'no_pengajuan' => $this->request->getPost('no_pengajuan'),
                    'kartu_bimbingan' => $nama_kartu_bimbingan_baru,
                    'bukti_spp_tetap' => $nama_bukti_spp_tetap_baru,
                    'bukti_spp_variabel' => $nama_bukti_spp_variabel_baru,
                    'krs' => $nama_krs_baru,
                    'keterangan' => $this->request->getPost('keterangan'),
                    'status_berkas_perpanjang'        => "Belum Dicek",
                ];
            }
            $model->saveBerkasPerpanjang($data3);

            return redirect()->to('/Perpanjang');
        } else {
            $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 100KB Dan Lebih Dari 5MB']);
            return redirect()->to('/Perpanjang');
        }
    }

    public function pengajuanPerpanjang()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Pengajuan Perpanjang";
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
            $model2 = new PerpanjangModel();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_pengajuan_perpanjang'] = $model2->getPengajuanPerpanjang($tahun_ajaran, $semester)->getResult();
            $data['tahun_ajaran2'] = $model2->getTahunAjaran()->getResult();
            echo view('pengajuan_perpanjang', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function updatePengajuanPerpanjang()
    {
        $model = new PerpanjangModel();
        $no_pengajuan = $this->request->getPost('no_pengajuan');

        $data = [
            'status_perpanjang' => "Baru",
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'semester' => $this->request->getPost('semester'),
            'batas_bimbingan_perpanjang' => "",
        ];
        $model->updatePengajuan($data, $no_pengajuan);

        $data2 = [
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'semester' => $this->request->getPost('semester'),
            'status_disposisi' => "Disposisi",
        ];
        $model->updateDisposisi($data2, $no_pengajuan);

        $model->deleteBerkasPerpanjang($no_pengajuan);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/Perpanjang/pengajuanPerpanjang');
    }

    public function disposisi()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Disposisi Perpanjang";
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
            $data['jumlah_pembimbing'] = $model2->getJumlahPembimbing($tahun_ajaran, $semester)->getResult();
            $data['tb_disposisi_perpanjang_kp'] = $model2->getDisposisiPerpanjangKP($tahun_ajaran, $semester)->getResult();
            $data['tb_disposisi_perpanjang_ta'] = $model2->getDisposisiPerpanjangTA($tahun_ajaran, $semester)->getResult();
            echo view('disposisi_perpanjang', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function berkas()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Cek Berkas Perpanjang";
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
            $model2 = new BerkasPerpanjangModel();
            $data['tb_berkas_perpanjang_kp'] = $model2->getBerkasPerpanjangKP($tahun_ajaran, $semester)->getResult();
            $data['tb_berkas_perpanjang_ta'] = $model2->getBerkasPerpanjangTA($tahun_ajaran, $semester)->getResult();
            echo view('berkas_perpanjang', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function detailBerkas($no_berkas_perpanjang)
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
            $model2 = new BerkasPerpanjangModel();
            $request = \Config\Services::request();
            $npm = $request->uri->getSegment(4);
            $data['tb_berkas_detail_perpanjang'] = $model2->getBerkasDetailPerpanjang($no_berkas_perpanjang)->getResult();
            echo view('berkas_detail_perpanjang', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function downloadKartuBimbinganPerpanjang($no_berkas_perpanjang, $username, $nama_mahasiswa)
    {
        $model = new BerkasPerpanjangModel();
        $data = $model->find($no_berkas_perpanjang);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["kartu_bimbingan"], null);
    }

    public function downloadBuktiSPPTetap($no_berkas_perpanjang, $username, $nama_mahasiswa)
    {
        $model = new BerkasPerpanjangModel();
        $data = $model->find($no_berkas_perpanjang);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["bukti_spp_tetap"], null);
    }

    public function downloadBuktiSPPvariabel($no_berkas_perpanjang, $username, $nama_mahasiswa)
    {
        $model = new BerkasPerpanjangModel();
        $data = $model->find($no_berkas_perpanjang);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["bukti_spp_variabel"], null);
    }

    public function downloadKRS($no_berkas_perpanjang, $username, $nama_mahasiswa)
    {
        $model = new BerkasPerpanjangModel();
        $data = $model->find($no_berkas_perpanjang);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["krs"], null);
    }

    public function updateBerkasPerpanjang()
    {
        $model = new BerkasPerpanjangModel();
        $no_berkas_perpanjang = $this->request->getPost('no_berkas_perpanjang');
        $data = [
            'status_berkas_perpanjang'        => $this->request->getPost('status_berkas_perpanjang'),
            'catatan_berkas_perpanjang'        => $this->request->getPost('catatan_berkas_perpanjang'),
            'id_admin'        => $this->request->getPost('id_admin')
        ];
        $model->updateBerkasPerpanjang($data, $no_berkas_perpanjang);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/Perpanjang/berkas');
    }

    public function updateBerkasPerpanjang2()
    {
        $model = new PerpanjangModel();
        $this->session = session();
        $username = $this->request->getPost('username');
        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa');
        $no_berkas_perpanjang = $this->request->getPost('no_berkas_perpanjang');

        helper('filesystem'); // Load Helper File System

        $kartu_bimbingan = $this->request->getFile('kartu_bimbingan');
        $bukti_spp_tetap = $this->request->getFile('bukti_spp_tetap');
        $bukti_spp_variabel = $this->request->getFile('bukti_spp_variabel');
        $krs = $this->request->getFile('krs');

        if (!empty($kartu_bimbingan)) {
            $nama_kartu_bimbingan_baru = $username . '_' . $nama_mahasiswa . '_Kartu.pdf';
            $size_kartu_bimbingan = $kartu_bimbingan->getSizeByUnit('kb');
        }

        if (!empty($bukti_spp_tetap)) {
            $nama_bukti_spp_tetap_baru = $username . '_' . $nama_mahasiswa . '_SPPTetap.pdf';
            $size_bukti_spp_tetap = $bukti_spp_tetap->getSizeByUnit('kb');
        }

        if (!empty($bukti_spp_variabel)) {
            $nama_bukti_spp_variabel_baru = $username . '_' . $nama_mahasiswa . '_BuktiSPP.pdf';
            $size_bukti_spp_variabel = $bukti_spp_variabel->getSizeByUnit('kb');
        }

        if (!empty($krs)) {
            $nama_krs_baru = $username . '_' . $nama_mahasiswa . '_KRS.pdf';
            $size_krs = $krs->getSizeByUnit('kb');
        }

        if (!empty($kartu_bimbingan)) {
            if ($size_kartu_bimbingan < 5000) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_kartu_bimbingan_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_kartu_bimbingan_baru");
                    }
                }
                $kartu_bimbingan->move("uploads/$username $nama_mahasiswa/", $nama_kartu_bimbingan_baru);
                $data3 = [
                    'kartu_bimbingan' => $nama_kartu_bimbingan_baru,
                ];
                $model->updateBerkasPerpanjang($data3, $no_berkas_perpanjang);
                $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
                return redirect()->to('/Perpanjang');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 100KB Dan Lebih Dari 5MB']);
                return redirect()->to('/Perpanjang');
            }
        }

        if (!empty($bukti_spp_tetap)) {
            if ($size_bukti_spp_tetap < 5000) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_bukti_spp_tetap_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_bukti_spp_tetap_baru");
                    }
                }
                $bukti_spp_tetap->move("uploads/$username $nama_mahasiswa/", $nama_bukti_spp_tetap_baru);
                $data3 = [
                    'bukti_spp_tetap' => $nama_bukti_spp_tetap_baru,
                ];
                $model->updateBerkasPerpanjang($data3, $no_berkas_perpanjang);
                $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
                return redirect()->to('/Perpanjang');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 100KB Dan Lebih Dari 5MB']);
                return redirect()->to('/Perpanjang');
            }
        }

        if (!empty($bukti_spp_variabel)) {
            if ($size_bukti_spp_variabel < 5000) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_bukti_spp_variabel_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_bukti_spp_variabel_baru");
                    }
                }
                $bukti_spp_variabel->move("uploads/$username $nama_mahasiswa/", $nama_bukti_spp_variabel_baru);
                $data3 = [
                    'bukti_spp_variabel' => $nama_bukti_spp_variabel_baru,
                ];
                $model->updateBerkasPerpanjang($data3, $no_berkas_perpanjang);
                $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
                return redirect()->to('/Perpanjang');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 100KB Dan Lebih Dari 5MB']);
                return redirect()->to('/Perpanjang');
            }
        }

        if (!empty($krs)) {
            if ($size_krs < 5000) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_krs_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_krs_baru");
                    }
                }
                $krs->move("uploads/$username $nama_mahasiswa/", $nama_krs_baru);
                $data3 = [
                    'krs' => $nama_krs_baru,
                ];
                $model->updateBerkasPerpanjang($data3, $no_berkas_perpanjang);
                $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
                return redirect()->to('/Perpanjang');
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Kurang Dari 100KB Dan Lebih Dari 5MB']);
                return redirect()->to('/Perpanjang');
            }
        }
    }

    public function updatePembimbing()
    {
        $model = new DisposisiModel();
        $no_disposisi = $this->request->getPost('no_disposisi');
        $data = [
            'nik'        => $this->request->getPost('nik'),
        ];
        $model->updateDisposisi($data, $no_disposisi);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/Perpanjang/disposisi');
    }

    public function updateDisposisi()
    {
        $model = new DisposisiModel();
        $no_disposisi = $this->request->getPost('no_disposisi');
        $data = [
            'status_disposisi' => "Disposisi",
        ];
        $model->updateDisposisi($data, $no_disposisi);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/Perpanjang/disposisi');
    }

    public function downloadkartubimbingan()
    {
        $model = new perpanjangModel();
        $request = \Config\Services::request();
        $session = session();
        $data['title'] = $request->uri->getSegment(3);
        $no_disposisi = $request->uri->getSegment(4);
        $data['tb_disposisi'] = $model->getDisposisi3($no_disposisi)->getResult();
        $data['batas_bimbingan'] = $session->get('batas_bimbingan');
        echo view('download_kartu_bimbingan', $data);
    }
}
