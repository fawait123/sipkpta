<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\BimbinganModel;
use App\Models\DisposisiModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PengajuanModel;
use App\Models\PerubahanJudulModel;
use App\Models\SekprodModel;
use App\Models\TanggalPerubahan;
use App\Models\PersiapanModel;

class PerubahanJudul extends BaseController
{
    public function __construct()
    {
        $this->bread = new LibrariesBreadcrumb();
        $this->perubahan = new TanggalPerubahan();
        $this->model = new PerubahanJudulModel();
        $this->pengajuan = new PengajuanModel();
        helper('filesystem'); // Load Helper File System
    }

    public function kp()
    {
        $check = $this->perubahan->getOne()->getRow();
        $getPerubahan = $this->getPerubahan(session()->get('role'), "KP");
        $data['perubahan'] = $getPerubahan;
        $model = $this->getRole(session()->get('role'));
        $data['breadcrumbs'] = $this->bread->buildAuto();
        $data['title'] = "Perubahan Judul KP";
        $data['username'] = session()->get('username');
        $data['role'] = session()->get('role');
        $data['user'] = $model->getUser(session()->get('username'))->getResult();
        $data['check'] = $check;
        $data['pengajuan'] = $this->pengajuan->findOne(session()->get('username'), "KP")->getRow();
        // dd($data['perubahan']);
        echo view('perubahan/kp/index', $data);
    }
    public function ta()
    {
        $check = $this->perubahan->getOne()->getRow();
        $getPerubahan = $this->getPerubahan(session()->get('role'), "TA");
        $data['perubahan'] = $getPerubahan;
        $model = $this->getRole(session()->get('role'));
        $data['breadcrumbs'] = $this->bread->buildAuto();
        $data['title'] = "Perubahan Judul TA";
        $data['username'] = session()->get('username');
        $data['role'] = session()->get('role');
        $data['user'] = $model->getUser(session()->get('username'))->getResult();
        $data['check'] = $check;
        $data['pengajuan'] = $this->pengajuan->findOne(session()->get('username'), "TA")->getRow();
        // dd($data['perubahan']);
        echo view('perubahan/ta/index', $data);
    }

    public function ubahjudul()
    {
        $data = [
            'judul_perubahan' => $_POST['judul_perubahan'],
        ];

        $id = [
            'no_perubahan' => $_POST['no_perubahan']
        ];
        $model = new PerubahanJudulModel();
        $model->update($id, $data);
        session()->setFlashdata('pesan', 'Review Berhasil');
        if ($_POST['jenis'] == 'KP') {
            return redirect()->to('perubahan/kp');
        } else {
            return redirect()->to('perubahan/ta');
        }
    }
    // public function ta()
    // {
    //     if (session()->get('isLoggedIn')) :
    //         $check = $this->perubahan->check(session()->get('username'), "TA")->getRow();
    //         $getPerubahan = $this->getPerubahan(session()->get('role'), "TA");
    //         // dd($getPerubahan);
    //         if (session()->get('role') != 'mahasiswa') :
    //             $data['perubahan'] = $getPerubahan;
    //         endif;
    //         $model = $this->getRole(session()->get('role'));
    //         $data['breadcrumbs'] = $this->bread->buildAuto();
    //         $data['title'] = "Perubahan Judul TA";
    //         $data['username'] = session()->get('username');
    //         $data['role'] = session()->get('role');
    //         $data['user'] = $model->getUser(session()->get('username'))->getResult();
    //         $data['check'] = $check;
    //         return view('perubahan/ta/index', $data);
    //     else :
    //         return redirect()->to('home');
    //     endif;
    // }

    public function getRole($role)
    {
        switch ($role) {
            case 'admin':
                $model = new AdminModel();
                break;
            case 'sekprod':
                $model = new SekprodModel();
                break;
            case 'kaprodi':
                $model = new KaprodiModel();
                break;
            case 'dosen':
                $model = new DosenModel();
                break;
            case 'mahasiswa':
                $model = new MahasiswaModel();
                break;
            default:
                $model = null;
                break;
        }

        return $model;
    }

    public function getPerubahan($role, $jenis)
    {
        $model = new PersiapanModel();
        $getAjaran = $model->getTahunAjaran()->getRow();
        switch ($role) {
            case 'dosen':
                $hasil = $this->model->get(null, session()->get('username'), $jenis,$getAjaran->awal_bimbingan,$getAjaran->batas_bimbingan)->getResult();
                break;
            case 'kaprodi':
                $hasil = $this->model->get(null, null, $jenis,$getAjaran->awal_bimbingan,$getAjaran->batas_bimbingan)->getResult();
                break;
            case 'sekprod':
                $hasil = $this->model->get(null, null, $jenis,$getAjaran->awal_bimbingan,$getAjaran->batas_bimbingan)->getResult();
                break;
            case 'admin':
                $hasil = $this->model->get(null, null, $jenis,$getAjaran->awal_bimbingan,$getAjaran->batas_bimbingan)->getResult();
                break;
            case 'mahasiswa':
                $hasil = $this->model->get($role, session()->get('username'), $jenis,$getAjaran->awal_bimbingan,$getAjaran->batas_bimbingan)->getRow();
                break;
            default:
                $hasil = null;
                break;
        }

        return $hasil;
    }

    public function submitkp()
    {
        // sendNotif(session()->get('username'), $_POST['nik'], " Mengirim perubahan judul kerja praktik", "perubahanjudul/kp");
        // upload file
        $user = $this->getUser(session()->get('username'));
        $proposal = $this->request->getFile('file');
        // $bukti = $this->request->getFile('bukti');

        if (!empty($proposal)) {
            $new_proposal = $user->npm . '_' . $user->nama_mahasiswa . "_Perubahan_Judul.pdf";
            $size = $proposal->getSizeByUnit('kb');
        }

        // if (!empty($bukti)) {
        //     $extensi = $bukti->getExtension();
        //     $new_bukti = $user->npm . '_' . $user->nama_mahasiswa . "_Perubahan_Judul." . $extensi;
        //     $size = $bukti->getSizeByUnit('kb');
        // }

        if (!empty($proposal)) {
            if ($size <= 5000) {
                $map = directory_map("uploads/perubahan/kerja praktik/$user->npm-$user->nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $new_proposal) {
                        delete_files("uploads/perubahan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $new_proposal);
                    }
                }
                $proposal->move("uploads/perubahan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $new_proposal);
            }
        }
        // if (!empty($bukti)) {
        //     if ($size <= 5000) {
        //         $map2 = directory_map("uploads/perubahan/kerja praktik/$user->npm-$user->nama_mahasiswa/", true, true);
        //         foreach ($map2 as $key) {
        //             if ($key == $new_bukti) {
        //                 delete_files("uploads/peruabahan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $new_bukti);
        //             }
        //         }
        //         $bukti->move("uploads/perubahan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $new_bukti);
        //     }
        // }
        // end upload file

        if ($proposal) {
            $dataUpdate = [
                'no_perubahan' => $this->kodePerubahan()
            ];
            $pengajuan = new PengajuanModel();
            $pengajuan->updatePengajuan($dataUpdate, $_POST['no_pengajuan']);
            $data = [
                'no_perubahan' => $this->kodePerubahan(),
                'judul_perubahan' => $_POST['judul'],
                'proposal' => $new_proposal,
                'studi_kasus' => $_POST['studi_kasus'],
                'status_dosen' => null,
                'status_prodi' => null
            ];
            $model = new PerubahanJudulModel();
            $model->insert($data);
            session()->setFlashdata('pesan', 'Perubahan Judul Berhasil diajukan');
            // return redirect()->to('perubahan/kp');
            return 'success';
        } else {
            session()->setFlashdata('error', 'Error');
            // return redirect()->to('perubahan/kp');
            return 'warning';
        }
    }

    public function submitta()
    {
        // sendNotif(session()->get('username'), $_POST['nik'], " Mengirim perubahan judul kerja praktik", "perubahanjudul/kp");
        // upload file
        $user = $this->getUser(session()->get('username'));
        $proposal = $this->request->getFile('file');
        // $bukti = $this->request->getFile('bukti');

        if (!empty($proposal)) {
            $new_proposal = $user->npm . '_' . $user->nama_mahasiswa . "_Perubahan_Judul.pdf";
            $size = $proposal->getSizeByUnit('kb');
        }

        // if (!empty($bukti)) {
        //     $extensi = $bukti->getExtension();
        //     $new_bukti = $user->npm . '_' . $user->nama_mahasiswa . "_Perubahan_Judul." . $extensi;
        //     $size = $bukti->getSizeByUnit('kb');
        // }

        if (!empty($proposal)) {
            if ($size <= 5000) {
                $map = directory_map("uploads/perubahan/tugas akhir/$user->npm-$user->nama_mahasiswa/", false, true);
                foreach ($map as $key) {
                    if ($key == $new_proposal) {
                        delete_files("uploads/perubahan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $new_proposal);
                    }
                }
                $proposal->move("uploads/perubahan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $new_proposal);
            }
        }
        // if (!empty($bukti)) {
        //     if ($size <= 5000) {
        //         $map2 = directory_map("uploads/perubahan/kerja praktik/$user->npm-$user->nama_mahasiswa/", true, true);
        //         foreach ($map2 as $key) {
        //             if ($key == $new_bukti) {
        //                 delete_files("uploads/peruabahan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $new_bukti);
        //             }
        //         }
        //         $bukti->move("uploads/perubahan/kerja praktik/$user->npm-$user->nama_mahasiswa/", $new_bukti);
        //     }
        // }
        // end upload file

        if ($proposal) {
            $dataUpdate = [
                'no_perubahan' => $this->kodePerubahan()
            ];
            $pengajuan = new PengajuanModel();
            $pengajuan->updatePengajuan($dataUpdate, $_POST['no_pengajuan']);
            $data = [
                'no_perubahan' => $this->kodePerubahan(),
                'judul_perubahan' => $_POST['judul'],
                'proposal' => $new_proposal,
                'studi_kasus' => $_POST['studi_kasus'],
                'status_dosen' => null,
                'status_prodi' => null
            ];
            $model = new PerubahanJudulModel();
            $model->insert($data);
            session()->setFlashdata('pesan', 'Perubahan Judul Berhasil diajukan');
            // return redirect()->to('perubahan/ta');
            return 'success';
        } else {
            session()->setFlashdata('error', 'Error');
            // return redirect()->to('perubahan/ta');
            return 'warning';
        }
    }

    // public function submitta()
    // {
    //     sendNotif(session()->get('username'), $_POST['nik'], " Mengirim perubahan judul tugas akhir", "perubahanjudul/ta");
    //     // upload file
    //     $user = $this->getUser(session()->get('username'));
    //     $proposal = $this->request->getFile('file');
    //     $bukti = $this->request->getFile('bukti');

    //     if (!empty($proposal)) {
    //         $new_proposal = $user->npm . '_' . $user->nama_mahasiswa . "_Perubahan_Judul.pdf";
    //         $size = $proposal->getSizeByUnit('kb');
    //     }

    //     if (!empty($bukti)) {
    //         $extensi = $bukti->getExtension();
    //         $new_bukti = $user->npm . '_' . $user->nama_mahasiswa . "_Perubahan_Judul." . $extensi;
    //         $size = $bukti->getSizeByUnit('kb');
    //     }

    //     if (!empty($proposal)) {
    //         if ($size <= 5000) {
    //             $map = directory_map("uploads/perubahan/tugas akhir/$user->npm-$user->nama_mahasiswa/", false, true);
    //             foreach ($map as $key) {
    //                 if ($key == $new_proposal) {
    //                     delete_files("uploads/perubahan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $new_proposal);
    //                 }
    //             }
    //             $proposal->move("uploads/perubahan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $new_proposal);
    //         }
    //     }
    //     if (!empty($bukti)) {
    //         if ($size <= 5000) {
    //             $map2 = directory_map("uploads/perubahan/tugas akhir/$user->npm-$user->nama_mahasiswa/", true, true);
    //             foreach ($map2 as $key) {
    //                 if ($key == $new_bukti) {
    //                     delete_files("uploads/peruabahan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $new_bukti);
    //                 }
    //             }
    //             $bukti->move("uploads/perubahan/tugas akhir/$user->npm-$user->nama_mahasiswa/", $new_bukti);
    //         }
    //     }
    //     // end upload file
    //     if ($proposal && $bukti) {
    //         $dataUpdate = [
    //             'no_perubahan' => $this->kodePerubahan()
    //         ];
    //         $pengajuan = new PengajuanModel();
    //         $pengajuan->updatePengajuan($dataUpdate, $_POST['no_pengajuan']);
    //         $data = [
    //             'no_perubahan' => $this->kodePerubahan(),
    //             'judul_perubahan' => $_POST['judul'],
    //             'proposal' => $new_proposal,
    //             'bukti_pernyataan' => $new_bukti,
    //             'status_dosen' => null,
    //             'status_prodi' => null
    //         ];
    //         $model = new PerubahanJudulModel();
    //         $model->insert($data);
    //         session()->setFlashdata('pesan', 'Perubahan Judul Berhasil diajukan');
    //         return redirect()->to('perubahanjudul/ta');
    //     } else {
    //         session()->setFlashdata('error', 'Error');
    //         return redirect()->to('perubahanjudul/kp');
    //     }
    // }

    public function reviewdosen()
    {
        $jenis = $_POST['jenis'] == 'KP' ? 'Kerja Praktik' : 'Tugas Akhir';
        $url = $_POST['jenis'] == 'KP' ? 'perubahan/kp' : 'perubahan/ta';
        // if ($_POST['status_dosen'] == 'acc') :
        //     sendNotif($_POST['npm'], 'KPD001', "Mengirim perubahan judul $jenis", $url);
        // endif;
        // sendNotif($_POST['nik'], $_POST['npm'], "Dosen Kamu sudah mereview perubahan judul $jenis", $url);
        $data = [
            'status_dosen' => $_POST['status_dosen'],
            'ket_dosen' => $_POST['ket_dosen'],
            'status_mhs' => null
        ];

        $id = [
            'no_perubahan' => $_POST['no_perubahan']
        ];
        $model = new PerubahanJudulModel();
        $model->update($id, $data);
        session()->setFlashdata('pesan', 'Review Berhasil');
        return redirect()->to('perubahan/kp');
    }

    public function reviewdosenta()
    {
        $jenis = $_POST['jenis'] == 'KP' ? 'Kerja Praktik' : 'Tugas Akhir';
        $url = $_POST['jenis'] == 'KP' ? 'perubahan/kp' : 'perubahan/ta';
        // if ($_POST['status_dosen'] == 'acc') :
        //     sendNotif($_POST['npm'], 'KPD001', "Mengirim perubahan judul $jenis", $url);
        // endif;
        // sendNotif($_POST['nik'], $_POST['npm'], "Dosen Kamu sudah mereview perubahan judul $jenis", $url);
        $data = [
            'status_dosen' => $_POST['status_dosen'],
            'ket_dosen' => $_POST['ket_dosen'],
            'status_mhs' => null
        ];

        $id = [
            'no_perubahan' => $_POST['no_perubahan']
        ];
        $model = new PerubahanJudulModel();
        $model->update($id, $data);
        session()->setFlashdata('pesan', 'Review Berhasil');
        return redirect()->to('perubahan/ta');
    }
    public function reviewprodi()
    {
        // dd($_POST['ket_dosen']);
        // sendNotif('KPD001', $_POST['npm'], "Kaprodi sudah melakukan review untuk perubahan judul kamu", "perubahanjudul/kp");
        $data = [
            'status_prodi' => $_POST['status_prodi'],
            'ket_prodi' => $_POST['ket_prodi'],
            'status_mhs' => null
        ];

        $id = [
            'no_perubahan' => $_POST['no_perubahan']
        ];

        $model = new PerubahanJudulModel();
        $model->update($id, $data);
        session()->setFlashdata('pesan', 'Review Berhasil');
        return redirect()->to('perubahan/kp');
    }

    public function reviewprodita()
    {
        // dd($_POST['ket_dosen']);
        // sendNotif('KPD001', $_POST['npm'], "Kaprodi sudah melakukan review untuk perubahan judul kamu", "perubahanjudul/kp");
        $data = [
            'status_prodi' => $_POST['status_prodi'],
            'ket_prodi' => $_POST['ket_prodi'],
            'status_mhs' => null
        ];

        $id = [
            'no_perubahan' => $_POST['no_perubahan']
        ];

        $model = new PerubahanJudulModel();
        $model->update($id, $data);
        session()->setFlashdata('pesan', 'Review Berhasil');
        return redirect()->to('perubahan/ta');
    }

    public function revisi()
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/perubahan/kerja praktik/' . $_POST['npm'] . '-' . $_POST['nama'] . '/' . $_POST['old'];
        if (file_exists($path)) {
            unlink($path);
        }
        // dd('oke');
        $file = $this->request->getFile('file');
        if (!empty($file)) {
            $new_file = $_POST['npm'] . '_' . $_POST['nama'] . "_Perubahan_Judul.pdf";
            $size = $file->getSizeByUnit('kb');
        }
        if ($file->move('uploads/perubahan/kerja praktik/' . $_POST['npm'] . '-' . $_POST['nama'] . '/', $new_file)) {
            $data = [
                'proposal' => $new_file,
                'status_mhs' => 'sudah revisi'
            ];

            $id = [
                'no_perubahan' => $_POST['no_perubahan']
            ];
            $model = new PerubahanJudulModel();
            $model->update($id, $data);
            session()->setFlashdata('pesan', 'Data Berhasil di kirim');
            return redirect()->to('perubahan/kp');
        }
    }

    public function revisita()
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/perubahan/tugas akhir/' . $_POST['npm'] . '-' . $_POST['nama'] . '/' . $_POST['old'];
        if (file_exists($path)) {
            unlink($path);
        }
        // dd('oke');
        $file = $this->request->getFile('file');
        if (!empty($file)) {
            $new_file = $_POST['npm'] . '_' . $_POST['nama'] . "_Perubahan_Judul.pdf";
            $size = $file->getSizeByUnit('kb');
        }
        if ($file->move('uploads/perubahan/tugas akhir/' . $_POST['npm'] . '-' . $_POST['nama'] . '/', $new_file)) {
            $data = [
                'proposal' => $new_file,
                'status_mhs' => 'sudah revisi'
            ];

            $id = [
                'no_perubahan' => $_POST['no_perubahan']
            ];
            $model = new PerubahanJudulModel();
            $model->update($id, $data);
            session()->setFlashdata('pesan', 'Data Berhasil di kirim');
            return redirect()->to('perubahan/ta');
        }
    }

    public function kodePerubahan()
    {
        $model = new PerubahanJudulModel();
        $count = $model->countRow();
        $count += 1;
        $kode = date('YmdHis') . $count;
        return $kode;
    }

    public function cetakkartubimbingan($no_disposisi)
    {
        // if (session()->get('isLoggedIn')) :
        $model = new PerubahanJudulModel();
        $session = session();
        $data['title'] = 'KARTU%20BIMBINGAN';
        $data['tb_disposisi'] = $model->getJudulPerubahan($no_disposisi)->getResult();
        $data['batas_bimbingan'] = $session->get('batas_bimbingan');
        echo view('perubahan/cetakkartubimbingan', $data);
        // else :
        //     return redirect()->to('home');
        // endif;
    }

    public function cetaklogbook($no_disposisi)
    {
        if (session()->get('isLoggedIn')) :
            $model = new PerubahanJudulModel();
            $session = session();
            $data['title'] = 'LOG%20BOOK';
            $data['tb_disposisi'] = $model->getJudulPerubahan($no_disposisi)->getResult();
            $data['batas_bimbingan'] = $session->get('batas_bimbingan');
            echo view('perubahan/cetaklogbook', $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function getUser($npm)
    {
        $model = new BimbinganModel();
        return $model->getField($npm)->getRow();
    }
}
