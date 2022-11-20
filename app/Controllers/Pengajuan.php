<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DisposisiModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PengajuanModel;
use App\Models\PersiapanModel;
use App\Models\PlotingModel;
use App\Models\SekprodModel;
use App\Models\TopikKuotaModel;
use CodeIgniter\I18n\Time;

class Pengajuan extends BaseController
{

    public function __construct()
    {
        $this->session = session();
    }

    public function adminkp()
    {
        $bread = new LibrariesBreadcrumb();
        $data['breadcrumbs'] = $bread->buildAuto();
        $session = session();
        $data['title'] = "Pengajuan Proposal KP";
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
        $model2 = new PengajuanModel();
        $data['pengajuan'] = $model2->getAll()->getResult();
        $data['user'] = $model->getUser($username)->getResult();
        echo view('pengajuan_admin', $data);
    }

    public function pengajuanSekprod()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Tambah Pengajuan";
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
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_pengajuan'] = $model2->getPengajuanSekprod()->getResult();
            $data['tb_mahasiswa'] = $model2->getMahasiswa()->getResult();
            $data['tb_dosen'] = $model2->getDosen2()->getResult();
            $model3 = new TopikKuotaModel();
            $data['tb_topik'] = $model3->getTopik()->getResult();
            echo view('pengajuan_sekprod', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function savePengajuanSekrod()
    {
        $model = new PengajuanModel();
        $kode = $model->autoCode()->getResult();
        $tahun_ajaran = $this->request->getPost('tahun_ajaran') . "/" . $this->request->getPost('tahun_ajaran2');
        $jenis = $this->request->getPost('jenis');
        if ($jenis == "KP") {
            $kode_detail = $this->request->getPost('kode_detail');
        } else {
            $kode_detail = $this->request->getPost('kode_detail2');
        }
        foreach ($kode as $data) {
            $a = $data->no_pengajuan;
            $a++;
            $huruf = "PP";
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('YmdHs');
            $kode = $huruf . $tanggal . sprintf("%03s", $a);
            $now = new Time('now', 'Asia/Jakarta');
            $data = [
                'no_pengajuan' => $kode,
                'npm' => $this->request->getPost('npm'),
                'judul' => $this->request->getPost('judul'),
                'studi_kasus' => $this->request->getPost('studi_kasus'),
                'jenis' => $jenis,
                'kode_detail' => $kode_detail,
                'status_pengajuan' => "ACC",
                'prodi'        => "Sistem Informasi",
                'tanggal_pengajuan'        => $now,
                'status_perpanjang'        => $this->request->getPost('status_perpanjang'),
                'tahun_ajaran'        => $tahun_ajaran,
                'semester'        => $this->request->getPost('semester'),
            ];
        }
        $model->savePengajuan($data);

        $model2 = new PlotingModel();
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
                'no_pengajuan' => $kode,
                'nik' => $this->request->getPost('nik'),
                'jenis' => $this->request->getPost('jenis'),
                'tahun_ajaran'        => $tahun_ajaran,
                'semester' => $this->request->getPost('semester'),
                'status_disposisi' => "Disposisi",
            ];
        }
        $model2->saveDisposisi($data4);

        $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
        return redirect()->to('/Pengajuan/pengajuanSekprod');
    }

    public function updatePengajuanAdmin()
    {
        $model = new PengajuanModel();
        $no_pengajuan = $this->request->getPost('no_pengajuan');
        $data = [
            'status_perpanjang' => $this->request->getPost('status'),
        ];
        $model->updateAll($data, $no_pengajuan);
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/pengajuan/adminkp');
    }

    public function pengajuanKP()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Pengajuan Proposal KP";
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
            $model2 = new TopikKuotaModel();
            $data['tb_topik'] = $model2->getTopik()->getResult();
            $data['jenis'] = "KP";
            $jenis = $data['jenis'];
            $model3 = new PersiapanModel();
            $data['pengumuman'] = $model3->getPengumumanKP()->getResult();
            $data['tanggal'] = $model3->getTanggalKP()->getResult();
            $model4 = new PengajuanModel();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['batas_bimbingan'] = $session->get('batas_bimbingan');
            $data['data_diri'] = $model4->cekDataDiri($username)->getResult();
            $data['pengajuan2'] = $model4->cekPengajuan($username, $jenis)->getResult();
            $data['tb_berkas'] = $model4->getBerkas($username, $jenis)->getResult();
            $data['tb_review'] = $model4->getReview($username, $jenis, $tahun_ajaran, $semester)->getResult();
            $data['tb_review2'] = $model4->getReview2($username, $jenis, $tahun_ajaran, $semester)->getResult();
            $data['tb_disposisi'] = $model4->getDisposisi($username, $jenis)->getResult();
            $pengajuan = $data['pengajuan2'];
            $count = count($pengajuan);
            if (empty($count)) {
                $data['pengajuan'] = "true";
            } else {
                $data['pengajuan'] = "false";
            }
            $data['data_diri'] = $model4->cekDataDiri($username)->getResult();
            $data_diri = $data['data_diri'];
            $count = count($data_diri);
            if (empty($count)) {
                $data['data_diri'] = "true";
            } else {
                $data['data_diri'] = "false";
            }
            echo view('pengajuan', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function pengajuanTA()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Pengajuan Proposal TA";
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
            $model2 = new TopikKuotaModel();
            $data['tb_topik'] = $model2->getTopik()->getResult();
            $data['jenis'] = "TA";
            $jenis = $data['jenis'];
            $model3 = new PersiapanModel();
            $data['pengumuman'] = $model3->getPengumumanTA()->getResult();
            $data['tanggal'] = $model3->getTanggalTA()->getResult();
            $model4 = new PengajuanModel();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['batas_bimbingan'] = $session->get('batas_bimbingan');
            $data['data_diri'] = $model4->cekDataDiri($username)->getResult();
            $data['pengajuan2'] = $model4->cekPengajuan($username, $jenis)->getResult();
            $data['tb_berkas'] = $model4->getBerkas($username, $jenis)->getResult();
            $data['tb_review'] = $model4->getReview($username, $jenis, $tahun_ajaran, $semester)->getResult();
            $data['tb_review2'] = $model4->getReview2($username, $jenis, $tahun_ajaran, $semester)->getResult();
            $data['tb_disposisi'] = $model4->getDisposisi($username, $jenis)->getResult();
            $pengajuan = $data['pengajuan2'];
            $count = count($pengajuan);
            if (empty($count)) {
                $data['pengajuankp'] = $model4->cekPengajuanKP($username)->getResult();
                $pengajuankp = $data['pengajuankp'];
                $count2 = count($pengajuankp);
                if (empty($count2)) {
                    $data['pengajuan'] = "false2";
                } else {
                    $data['pengajuan'] = "true";
                }
            } else {
                $data['pengajuan'] = "false";
            }
            $data['data_diri'] = $model4->cekDataDiri($username)->getResult();
            $data_diri = $data['data_diri'];
            $count = count($data_diri);
            if (empty($count)) {
                $data['data_diri'] = "true";
            } else {
                $data['data_diri'] = "false";
            }
            echo view('pengajuan', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function rekapPengajuanKP()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Rekap Pengajuan Kerja Praktik";
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
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $data['jenis'] = "KP";
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $jenis = $data['jenis'];
            $data['tb_rekap_pengajuan'] = $model2->getRekapPengajuan($jenis, $tahun_ajaran, $semester)->getResult();
            echo view('rekap_pengajuan', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function rekapPengajuanTA()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Rekap Pengajuan Tugas Akhir";
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
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $data['jenis'] = "TA";
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $jenis = $data['jenis'];
            $data['tb_rekap_pengajuan'] = $model2->getRekapPengajuan($jenis, $tahun_ajaran, $semester)->getResult();
            echo view('rekap_pengajuan', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function getDosenKP()
    {
        if ($this->request->isAJAX()) {
            $kode_topik = $this->request->getGet('kode_topik');
            $jenis = "KP";
            $model = new PengajuanModel();
            $session = session();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data = $model->getDosen($kode_topik, $jenis, $tahun_ajaran, $semester)->getResult();
            return $this->response->setJSON($data);
        }
    }

    public function getDosenTA()
    {
        if ($this->request->isAJAX()) {
            $kode_topik = $this->request->getGet('kode_topik2');
            $jenis = "TA";
            $model = new PengajuanModel();
            $session = session();
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data = $model->getDosen($kode_topik, $jenis, $tahun_ajaran, $semester)->getResult();
            return $this->response->setJSON($data);
        }
    }

    public function save()
    {
        $model = new PengajuanModel();
        $this->session = session();
        $jenis = $this->request->getPost('jenis');
        $username = $this->request->getPost('username');
        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa');

        helper('filesystem'); // Load Helper File System

        if ($jenis == "KP") {
            $kode_detail = $this->request->getPost('kode_detail');
        } else {
            $kode_detail = $this->request->getPost('kode_detail2');
        }

        $kode_detail2 = $model->getKuota($kode_detail)->getResult();
        $count = count($kode_detail2);
        if (!empty($count)) {

            $proposal = $this->request->getFile('proposal');
            $nama_proposal = $proposal->getClientName();
            if ($jenis == "TA") {
                $nama_proposal_baru = $username . '_' . $nama_mahasiswa . '_PropTA.pdf';
            } else {
                $nama_proposal_baru = $username . '_' . $nama_mahasiswa . '_PropKP.pdf';
            }
            $size_proposal = $proposal->getSizeByUnit('kb');

            if ($jenis == "TA") {
                $surat2 = $this->request->getPost('surat2');
                if (!empty($surat2)) {
                    $surat = $this->request->getFile('surat');
                    $nama_surat = $surat->getClientName();
                    $nama_surat_baru = $username . '_' . $nama_mahasiswa . '_Surat.pdf';
                    $size_surat = $surat->getSizeByUnit('kb');
                } else {
                    $nama_surat_baru = "";
                }
            }

            $bukti_proposal = $this->request->getFile('bukti_proposal');
            $nama_bukti_proposal = $bukti_proposal->getClientName();
            if ($jenis == "TA") {
                $nama_bukti_proposal_baru = $username . '_' . $nama_mahasiswa . '_BuktiBayarTA.pdf';
            } else {
                $nama_bukti_proposal_baru = $username . '_' . $nama_mahasiswa . '_BuktiBayarKP.pdf';
            }
            $size_bukti_proposal = $bukti_proposal->getSizeByUnit('kb');

            $bukti_spp2 = $this->request->getPost('bukti_spp2');
            if (!empty($bukti_spp2)) {
                $bukti_spp = $this->request->getFile('bukti_spp');
                $nama_bukti_spp = $bukti_spp->getClientName();
                if ($jenis == "TA") {
                    $nama_bukti_spp_baru = $username . '_' . $nama_mahasiswa . '_BuktiSPPTA.pdf';
                } else {
                    $nama_bukti_spp_baru = $username . '_' . $nama_mahasiswa . '_BuktiSPPKP.pdf';
                }
                $size_bukti_spp = $bukti_spp->getSizeByUnit('kb');
            } else {
                $nama_bukti_spp_baru = "";
            }

            $sertifikat_sosialisasi = $this->request->getFile('sertifikat_sosialisasi');
            $nama_sertifikat_sosialisasi = $sertifikat_sosialisasi->getClientName();
            if ($jenis == "TA") {
                $nama_sertifikat_sosialisasi_baru = $username . '_' . $nama_mahasiswa . '_SertifikatSosialisasiTA.pdf';
            } else {
                $nama_sertifikat_sosialisasi_baru = $username . '_' . $nama_mahasiswa . '_SertifikatSosialisasiKP.pdf';
            }
            $size_sertifikat_sosialisasi = $sertifikat_sosialisasi->getSizeByUnit('kb');

            if ($jenis == "TA") {
                if (!empty($bukti_spp2)) {
                    if (!empty($surat2)) {
                        $validation = ($size_proposal < 5000) && ($size_surat < 5000) && ($size_bukti_proposal < 5000) && ($size_bukti_spp < 5000) && ($size_sertifikat_sosialisasi < 5000);
                    } else {
                        $validation = ($size_proposal < 5000) && ($size_bukti_proposal < 5000) && ($size_bukti_spp < 5000) && ($size_sertifikat_sosialisasi < 5000);
                    }
                } else {
                    if (!empty($surat2)) {
                        $validation = ($size_proposal < 5000) && ($size_surat < 5000) && ($size_bukti_proposal < 5000) && ($size_sertifikat_sosialisasi < 5000);
                    } else {
                        $validation = ($size_proposal < 5000) && ($size_bukti_proposal < 5000) && ($size_sertifikat_sosialisasi < 5000);
                    }
                }
            } else {
                if (!empty($bukti_spp2)) {
                    $validation = ($size_proposal < 5000) && ($size_bukti_proposal < 5000) && ($size_bukti_spp < 5000) && ($size_sertifikat_sosialisasi < 5000);
                } else {
                    $validation = ($size_proposal < 5000) && ($size_bukti_proposal < 5000) && ($size_sertifikat_sosialisasi < 5000);
                }
            }

            if ($validation) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_proposal_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_proposal_baru");
                    }
                }
                $proposal->move("uploads/$username $nama_mahasiswa/", $nama_proposal_baru);

                if ($jenis == "TA") {
                    if (!empty($surat2)) {
                        $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                        foreach ($map as $key) {
                            if ($key == $nama_surat_baru) {
                                unlink("uploads/$username $nama_mahasiswa/$nama_surat_baru");
                            }
                        }
                        $surat->move("uploads/$username $nama_mahasiswa/", $nama_surat_baru);
                    }
                }

                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_bukti_proposal_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_bukti_proposal_baru");
                    }
                }
                $bukti_proposal->move("uploads/$username $nama_mahasiswa/", $nama_bukti_proposal_baru);

                if (!empty($bukti_spp2)) {
                    $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                    foreach ($map as $key) {
                        if ($key == $nama_bukti_spp_baru) {
                            unlink("uploads/$username $nama_mahasiswa/$nama_bukti_spp_baru");
                        }
                    }
                    $bukti_spp->move("uploads/$username $nama_mahasiswa/", $nama_bukti_spp_baru);
                }

                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_sertifikat_sosialisasi_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_sertifikat_sosialisasi_baru");
                    }
                }
                $sertifikat_sosialisasi->move("uploads/$username $nama_mahasiswa/", $nama_sertifikat_sosialisasi_baru);

                $model = new PengajuanModel();

                $kode2 = $model->autoCodeProposal()->getResult();
                foreach ($kode2 as $data2) {
                    $a2 = $data2->no_proposal;
                    $a2++;
                    $huruf2 = "P";
                    date_default_timezone_set('Asia/Jakarta');
                    $tanggal2 = date('YmdHs');
                    $kode2 = $huruf2 . $tanggal2 . sprintf("%03s", $a2);
                    $data2 = [
                        'no_proposal' => $kode2,
                        'proposal'        => $nama_proposal_baru,
                    ];
                }
                $model->saveProposal($data2);

                $kode3 = $model->autoCodeBerkas()->getResult();
                foreach ($kode3 as $data3) {
                    $a3 = $data3->no_berkas;
                    $a3++;
                    $huruf3 = "B";
                    date_default_timezone_set('Asia/Jakarta');
                    $tanggal3 = date('YmdHs');
                    $kode3 = $huruf3 . $tanggal3 . sprintf("%03s", $a3);
                    if ($jenis == "KP") {
                        $data3 = [
                            'npm' => $this->request->getPost('username'),
                            'no_berkas' => $kode3,
                            'bukti_proposal' => $nama_bukti_proposal_baru,
                            'bukti_spp' => $nama_bukti_spp_baru,
                            'sertifikat_sosialisasi' => $nama_sertifikat_sosialisasi_baru,
                            'status_berkas'        => 'Belum Diperiksa'
                        ];
                    } else {
                        $data3 = [
                            'npm' => $this->request->getPost('username'),
                            'no_berkas' => $kode3,
                            'surat' => $nama_surat_baru,
                            'bukti_proposal' => $nama_bukti_proposal_baru,
                            'bukti_spp' => $nama_bukti_spp_baru,
                            'sertifikat_sosialisasi' => $nama_sertifikat_sosialisasi_baru,
                            'status_berkas'        => 'Belum Diperiksa'
                        ];
                    }
                }
                $model->saveBerkas($data3);

                $kode4 = $model->autoCodeNilai()->getResult();
                foreach ($kode4 as $data4) {
                    $a4 = $data4->no_nilai;
                    $a4++;
                    $huruf4 = "N";
                    date_default_timezone_set('Asia/Jakarta');
                    $tanggal4 = date('YmdHs');
                    $kode4 = $huruf4 . $tanggal4 . sprintf("%03s", $a4);
                    $data4 = [
                        'no_nilai' => $kode4,
                        'status_nilai'        => 'Belum Diperiksa',
                        'nilai_de' => $this->request->getPost('nilai_de'),
                        'mk_nilai_de' => $this->request->getPost('mk_nilai_de'),
                        'jumlah_sks' => $this->request->getPost('jumlah_sks'),
                        'ipk' => $this->request->getPost('ipk'),
                    ];
                }
                $model->saveNilai($data4);

                $kode = $model->autoCode()->getResult();
                foreach ($kode as $data) {
                    $a = $data->no_pengajuan;
                    $a++;
                    $huruf = "PP";
                    date_default_timezone_set('Asia/Jakarta');
                    $tanggal = date('YmdHs');
                    $kode = $huruf . $tanggal . sprintf("%03s", $a);
                    $now = new Time('now', 'Asia/Jakarta');
                    $data = [
                        'no_pengajuan' => $kode,
                        'npm' => $this->request->getPost('username'),
                        'kode_detail' => $kode_detail,
                        'no_proposal'        => $kode2,
                        'no_nilai'        => $kode4,
                        'no_berkas'        => $kode3,
                        'tanggal_pengajuan'        => $now,
                        'jenis'        => $jenis,
                        'judul'        => $this->request->getPost('judul'),
                        'prodi'        => "Sistem Informasi",
                        'status_pengajuan'        => "Belum Diverifikasi Kaprodi",
                        'studi_kasus'        => $this->request->getPost('studi_kasus'),
                        'tahun_ajaran'        => $this->request->getPost('tahun_ajaran'),
                        'semester'        => $this->request->getPost('semester'),
                        'batas_bimbingan'        => $this->request->getPost('batas_bimbingan'),
                        'status_perpanjang'        => "Baru",
                    ];
                }
                $model->savePengajuan($data);

                $kuota = $model->getKuota($kode_detail)->getResult();
                foreach ($kuota as $row) {
                    $sisa = $row->kuota;
                    $sisa--;
                }

                $data4 = [
                    'kuota' => $sisa,
                ];

                $model->updateKuota($data4, $kode_detail);

                $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            } else {
                $this->session->setFlashdata('errors', ['File Tidak Boleh Lebih Dari 5MB']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            }
        } else {
            $this->session->setFlashdata('errors', ['Maaf Kuota Dosen Yang Anda Pilih Sudah Habis']);
            if ($jenis == "KP") {
                return redirect()->to('/pengajuan/pengajuanKP');
            } else {
                return redirect()->to('/pengajuan/pengajuanTA');
            }
        }
    }

    public function updateProposal()
    {
        $model = new PengajuanModel();
        $this->session = session();
        $username = $this->request->getPost('username');
        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa');
        $no_proposal = $this->request->getPost('no_proposal');
        $jenis = $this->request->getPost('jenis');

        helper('filesystem'); // Load Helper File System

        $proposal = $this->request->getFile('proposal');
        $nama_proposal = $proposal->getClientName();
        if ($jenis == "TA") {
            $nama_proposal_baru = $username . '_' . $nama_mahasiswa . '_PropTA.pdf';
        } else {
            $nama_proposal_baru = $username . '_' . $nama_mahasiswa . '_PropKP.pdf';
        }
        $size_proposal = $proposal->getSizeByUnit('kb');

        if ($size_proposal < 5000) {
            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_proposal_baru) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_proposal_baru");
                }
            }
            $proposal->move("uploads/$username $nama_mahasiswa/", $nama_proposal_baru);

            $model = new PengajuanModel();

            $data2 = [
                'proposal'        => $nama_proposal_baru,
            ];
            $model->updateProposal($data2, $no_proposal);

            $jenis = $this->request->getPost('jenis');
            $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
            if ($jenis == "KP") {
                return redirect()->to('/pengajuan/pengajuanKP');
            } else {
                return redirect()->to('/pengajuan/pengajuanTA');
            }
        } else {
            $jenis = $this->request->getPost('jenis');
            $this->session->setFlashdata('errors', ['File Tidak Boleh Lebih Dari 5MB']);
            if ($jenis == "KP") {
                return redirect()->to('/pengajuan/pengajuanKP');
            } else {
                return redirect()->to('/pengajuan/pengajuanTA');
            }
        }
    }

    public function updateBerkas()
    {
        $model = new PengajuanModel();
        $this->session = session();
        $username = $this->request->getPost('username');
        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa');
        $no_berkas = $this->request->getPost('no_berkas');
        $jenis = $this->request->getPost('jenis');

        helper('filesystem'); // Load Helper File System


        $surat = $this->request->getFile('surat');
        $bukti_proposal = $this->request->getFile('bukti_proposal');
        $bukti_spp = $this->request->getFile('bukti_spp');
        $sertifikat_sosialisasi = $this->request->getFile('sertifikat_sosialisasi');

        if (!empty($surat)) {
            $nama_surat_baru = $username . '_' . $nama_mahasiswa . '_Surat.pdf';
            $size_surat = $surat->getSizeByUnit('kb');
        }

        if (!empty($bukti_proposal)) {
            if ($jenis == "TA") {
                $nama_bukti_proposal_baru = $username . '_' . $nama_mahasiswa . '_BuktiBayarTA.pdf';
            } else {
                $nama_bukti_proposal_baru = $username . '_' . $nama_mahasiswa . '_BuktiBayarKP.pdf';
            }
            $size_bukti_proposal = $bukti_proposal->getSizeByUnit('kb');
        }

        if (!empty($bukti_spp)) {
            if ($jenis == "TA") {
                $nama_bukti_spp_baru = $username . '_' . $nama_mahasiswa . '_BuktiSPPTA.pdf';
            } else {
                $nama_bukti_spp_baru = $username . '_' . $nama_mahasiswa . '_BuktiSPPKP.pdf';
            }
            $size_bukti_spp = $bukti_spp->getSizeByUnit('kb');
        }

        if (!empty($sertifikat_sosialisasi)) {
            if ($jenis == "TA") {
                $nama_sertifikat_sosialisasi_baru = $username . '_' . $nama_mahasiswa . '_SertifikatSosialisasiTA.pdf';
            } else {
                $nama_sertifikat_sosialisasi_baru = $username . '_' . $nama_mahasiswa . '_SertifikatSosialisasiKP.pdf';
            }
            $size_sertifikat_sosialisasi = $sertifikat_sosialisasi->getSizeByUnit('kb');
        }

        if (!empty($surat)) {
            if ($size_surat < 5000) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_surat_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_surat_baru");
                    }
                }
                $surat->move("uploads/$username $nama_mahasiswa/", $nama_surat_baru);
                $data3 = [
                    'surat' => $nama_surat_baru,
                ];
                $model->updateBerkas($data3, $no_berkas);

                $jenis = $this->request->getPost('jenis');
                $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            } else {
                $jenis = $this->request->getPost('jenis');
                $this->session->setFlashdata('errors', ['File Tidak Boleh Lebih Dari 5MB']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            }
        }

        if (!empty($bukti_proposal)) {
            if ($size_bukti_proposal < 5000) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_bukti_proposal_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_bukti_proposal_baru");
                    }
                }
                $bukti_proposal->move("uploads/$username $nama_mahasiswa/", $nama_bukti_proposal_baru);
                $data3 = [
                    'bukti_proposal' => $nama_bukti_proposal_baru,
                ];
                $model->updateBerkas($data3, $no_berkas);

                $jenis = $this->request->getPost('jenis');
                $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            } else {
                $jenis = $this->request->getPost('jenis');
                $this->session->setFlashdata('errors', ['File Tidak Boleh Lebih Dari 5MB']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            }
        }

        if (!empty($bukti_spp)) {
            if ($size_bukti_spp < 5000) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_bukti_spp_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_bukti_spp_baru");
                    }
                }
                $bukti_spp->move("uploads/$username $nama_mahasiswa/", $nama_bukti_spp_baru);
                $data3 = [
                    'bukti_spp' => $nama_bukti_spp_baru,
                ];
                $model->updateBerkas($data3, $no_berkas);

                $jenis = $this->request->getPost('jenis');
                $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            } else {
                $jenis = $this->request->getPost('jenis');
                $this->session->setFlashdata('errors', ['File Tidak Boleh Lebih Dari 5MB']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            }
        }

        if (!empty($sertifikat_sosialisasi)) {
            if ($size_sertifikat_sosialisasi < 5000) {
                $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $nama_sertifikat_sosialisasi_baru) {
                        unlink("uploads/$username $nama_mahasiswa/$nama_sertifikat_sosialisasi_baru");
                    }
                }
                $sertifikat_sosialisasi->move("uploads/$username $nama_mahasiswa/", $nama_sertifikat_sosialisasi_baru);
                $data3 = [
                    'sertifikat_sosialisasi' => $nama_sertifikat_sosialisasi_baru,
                ];
                $model->updateBerkas($data3, $no_berkas);

                $jenis = $this->request->getPost('jenis');
                $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            } else {
                $jenis = $this->request->getPost('jenis');
                $this->session->setFlashdata('errors', ['File Tidak Boleh Lebih Dari 5MB']);
                if ($jenis == "KP") {
                    return redirect()->to('/pengajuan/pengajuanKP');
                } else {
                    return redirect()->to('/pengajuan/pengajuanTA');
                }
            }
        }
    }

    public function downloadkartubimbingan()
    {
        $model = new DisposisiModel();
        $request = \Config\Services::request();
        $session = session();
        $data['title'] = $request->uri->getSegment(3);
        $no_disposisi = $request->uri->getSegment(4);
        $data['tb_disposisi'] = $model->getDisposisi3($no_disposisi)->getResult();
        $data['batas_bimbingan'] = $session->get('batas_bimbingan');
        echo view('download_kartu_bimbingan', $data);
    }

    public function downloadlogbook()
    {
        $model = new DisposisiModel();
        $request = \Config\Services::request();
        $data['title'] = $request->uri->getSegment(3);
        $no_disposisi = $request->uri->getSegment(4);
        $data['tb_disposisi'] = $model->getDisposisi3($no_disposisi)->getResult();
        echo view('download_logbook', $data);
    }
}
