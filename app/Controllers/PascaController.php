<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\AdminModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\DataKp;
use App\Models\DataTa;
use App\Helpers\Utils;
use App\Libraries\DriveApi;

class PascaController extends BaseController
{
    public function __construct()
    {
        $this->bread = new LibrariesBreadcrumb();
        helper('filesystem'); // Load Helper File System
    }


    public function kerjapraktik()
    {
        if (session()->get('isLoggedIn')) :
            $dataKp = new DataKp();
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Pasca Seminar Kerja Praktik";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['row'] = $dataKp->findOne('data_kp.Npm',session()->get('username'),'tb_pengajuan');
            $data['pengajuan'] = $dataKp->getJudul(session()->get('username'),'KP')->getRow();
            $data['check'] = $dataKp->getPendaftaran(session()->get('username'))->getRow();
            echo view("pasca/kp", $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function adminkerjapraktik()
    {
        if (session()->get('isLoggedIn')) :
            $datakp = new DataKp();
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Pasca Seminar Kerja Praktik";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['data'] = $datakp->get()->getResult();
            echo view("pasca/admin/kp", $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function admintugasakhir()
    {
        if (session()->get('isLoggedIn')) :
            $datata = new DataTa();
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Pasca Pendadaran Tugas Akhir";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['data'] = $datata->get()->getResult();
            echo view("pasca/admin/ta", $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function adminshow($id)
    {
        if (session()->get('isLoggedIn')) :
            $model = $this->getRole(session()->get('role'));
            $model2 = new DataKp();
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Bimbingan TA";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['row'] = $model2->get($id)->getRow();
            echo view("pasca/admin/show_kp", $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function adminshowta($id)
    {
        if (session()->get('isLoggedIn')) :
            $model = $this->getRole(session()->get('role'));
            $model2 = new DataTa();
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Bimbingan TA";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['row'] = $model2->get($id)->getRow();
            echo view("pasca/admin/show_ta", $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function tugasakhir()
    {
        if (session()->get('isLoggedIn')) :
            $dataTa = new DataTa();
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Pasca Pendadaran Tugas Akhir";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['row'] = $dataTa->findOne('data_ta.Npm',session()->get('username'),'tb_pengajuan');
            $data['pengajuan'] = $dataTa->getJudul(session()->get('username'),'TA')->getRow();
            $data['check'] = $dataTa->getPendaftaran(session()->get('username'))->getRow();
            // dd($data);
            echo view("pasca/ta", $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function yudisium()
    {
        if (session()->get('isLoggedIn')) :
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Bimbingan TA";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            echo view("pasca/kp", $data);
        else :
            return redirect()->to('home');
        endif;
    }


    public function storeKp()
    {
        try {
            // dd($_FILES);
            $model = new DataKp();

            $abstrak = $this->request->getFile('abstrak');
            $naskah = $this->request->getFile('naskah');
            $database = $this->request->getFile('database');
            $infografis_e = $this->request->getFile('infografis_e');
            $infografis_n_e = $this->request->getFile('infografis_n_e');
            $program = $this->request->getFile('program');
            $user = Utils::getUser(session()->get('username'));
            $folder_id = Utils::exist_folder($user->npm, $user->nama_mahasiswa, 'kp','pasca');
            $driveIdAbstrak = '';
            $driveIdNaskah = '';
            $driveIdDatabase = '';
            $driveIdProgram = '';
            $driveIdInfografisE = '';
            $driveIdInfografisNE = '';
            // abstrak
            if ($abstrak) {
                $file_path_abstrak = $abstrak->getTempName();
                $file_type_abstrak = $abstrak->getMimeType();
                $file_name_abstrak = $user->npm . '_' . $user->nama_mahasiswa . "_abstrak.".$abstrak->getExtension();
                $driveIdAbstrak = DriveApi::upload($file_name_abstrak, $file_path_abstrak, $file_type_abstrak, $folder_id);
            }

            // naskah
            if ($naskah) {
                $file_path_naskah = $naskah->getTempName();
                $file_type_naskah = $naskah->getMimeType();
                $file_name_naskah = $user->npm . '_' . $user->nama_mahasiswa . "_naskah.".$naskah->getExtension();
                $driveIdNaskah = DriveApi::upload($file_name_naskah, $file_path_naskah, $file_type_naskah, $folder_id);
            }

            // database
            if ($database) {
                $file_path_database = $database->getTempName();
                $file_type_database = $database->getMimeType();
                $file_name_database = $user->npm . '_' . $user->nama_mahasiswa . "_database.".$database->getExtension();
                $driveIdDatabase = DriveApi::upload($file_name_database, $file_path_database, $file_type_database, $folder_id);
            }

            // database
            if ($program) {
                $file_path_program = $program->getTempName();
                $file_type_program = $program->getMimeType();
                $file_name_program = $user->npm . '_' . $user->nama_mahasiswa . "_program.".$database->getExtension();
                $driveIdProgram = DriveApi::upload($file_name_program, $file_path_program, $file_type_program, $folder_id);
            }

            // infografis e
            if ($infografis_e) {
                $file_path_infoE = $infografis_e->getTempName();
                $file_type_infoE = $infografis_e->getMimeType();
                $file_name_infoE = $user->npm . '_' . $user->nama_mahasiswa . "_infografisE.".$infografis_e->getExtension();
                $driveIdInfografisE = DriveApi::upload($file_name_infoE, $file_path_infoE, $file_type_infoE, $folder_id);
            }

            // infografis n e
            if ($infografis_n_e) {
                $file_path_infoNE = $infografis_n_e->getTempName();
                $file_type_infoNE = $infografis_n_e->getMimeType();
                $file_name_infoNE = $user->npm . '_' . $user->nama_mahasiswa . "_infografisNE.".$infografis_n_e->getExtension();
                $driveIdInfografisNE = DriveApi::upload($file_name_infoNE, $file_path_infoNE, $file_type_infoNE, $folder_id);
            }

            $data_id = Utils::generateCode('DK',$model->countData());
            $data = [
                'Kode_Data_KP'=>$data_id,
                'Npm'=>$user->username,
                'Judul_KP'=>$_POST['judul'],
                'Abstrak'=>$driveIdAbstrak,
                'Naskah'=>$driveIdNaskah,
                'Program'=>$driveIdProgram,
                'Database'=>$driveIdDatabase,
                'Infografis_e'=>$driveIdInfografisE,
                'Infografis_n_e'=>$driveIdInfografisNE,
                'waktu_submit'=>date('Y-m-d'),
            ];

            $model->insertData($data);
            $data2 = [
                'Kode_Keterangan'=>Utils::generateCode('KT',$model->countDataWithTable('keterangan_kp')),
                'Kode_Data_kp'=>$data_id,
                'Npm'=>session()->get('username'),
                'Status_Kel_Data'=>'Belum diperiksa',
                'Status_CD'=>'Belum mengumpulkan',
                'catatan'=>''
            ];

            $model->insertDataWithTable($data2,'keterangan_kp');

            session()->setFlashdata('pesan', 'Pendaftaran Pasca kerja praktik berhasil dikirim');
            // return redirect()->to('pasca/kerjapraktik');
            return 'success';
        } catch (\Throwable $th) {
            session()->setFlashdata('pesan', $th->getMessage());
            // return redirect()->to('pasca/kerjapraktik');
            return 'warning';
        }
    }

    public function storeTa()
    {
        try {
            // dd($_FILES);
            $model = new DataTa();

            $abstrak = $this->request->getFile('abstrak');
            $daftar_pustaka = $this->request->getFile('daftar_pustaka');
            $laporan_ta = $this->request->getFile('laporan_ta');
            $lembar_pengesahan = $this->request->getFile('lembar_pengesahan');
            $naskah_publikasi = $this->request->getFile('naskah_publikasi');
            $program = $this->request->getFile('program');
            $database = $this->request->getFile('database');
            $infografis_e = $this->request->getFile('infografis_e');
            $infografis_n_e = $this->request->getFile('infografis_n_e');
            // 
            $user = Utils::getUser(session()->get('username'));
            $folder_id = Utils::exist_folder($user->npm, $user->nama_mahasiswa, 'ta','pasca');
            // abstrak
            if ($abstrak) {
                $file_path_abstrak = $abstrak->getTempName();
                $file_type_abstrak = $abstrak->getMimeType();
                $file_name_abstrak = $user->npm . '_' . $user->nama_mahasiswa . "_abstrak.".$abstrak->getExtension();
                $drive_id_abstrak = DriveApi::upload($file_name_abstrak, $file_path_abstrak, $file_type_abstrak, $folder_id);
            }

            // naskah
            if ($daftar_pustaka) {
                $file_path_daftar_pustaka = $daftar_pustaka->getTempName();
                $file_type_daftar_pustaka = $daftar_pustaka->getMimeType();
                $file_name_daftar_pustaka = $user->npm . '_' . $user->nama_mahasiswa . "_daftar_pustaka.".$daftar_pustaka->getExtension();
                $drive_id_daftar_pustaka = DriveApi::upload($file_name_daftar_pustaka, $file_path_daftar_pustaka, $file_type_daftar_pustaka, $folder_id);
            }

            // database
            if ($laporan_ta) {
                $file_path_laporan_ta = $laporan_ta->getTempName();
                $file_type_laporan_ta = $laporan_ta->getMimeType();
                $file_name_laporan_ta = $user->npm . '_' . $user->nama_mahasiswa . "_laporan_ta.".$laporan_ta->getExtension();
                $drive_id_laporan_ta = DriveApi::upload($file_name_laporan_ta, $file_path_laporan_ta, $file_type_laporan_ta, $folder_id);
            }

            // database
            if ($lembar_pengesahan) {
                $file_path_lembar_pengesahan = $lembar_pengesahan->getTempName();
                $file_type_lembar_pengesahan = $lembar_pengesahan->getMimeType();
                $file_name_lembar_pengesahan = $user->npm . '_' . $user->nama_mahasiswa . "_lembar_pengesahan.".$lembar_pengesahan->getExtension();
                $drive_id_lembar_pengesahan = DriveApi::upload($file_name_lembar_pengesahan, $file_path_lembar_pengesahan, $file_type_lembar_pengesahan, $folder_id);
            }

            // infografis e
            if ($naskah_publikasi) {
                $file_path_naskah_publikasi = $naskah_publikasi->getTempName();
                $file_type_naskah_publikasi = $naskah_publikasi->getMimeType();
                $file_name_naskah_publikasi = $user->npm . '_' . $user->nama_mahasiswa . "_naskah_publikasi.".$naskah_publikasi->getExtension();
                $drive_id_naskah_publikasi = DriveApi::upload($file_name_naskah_publikasi, $file_path_naskah_publikasi, $file_type_naskah_publikasi, $folder_id);
            }

            // infografis n e
            if ($program) {
                $file_path_program = $program->getTempName();
                $file_type_program = $program->getMimeType();
                $file_name_program = $user->npm . '_' . $user->nama_mahasiswa . "_program.".$program->getExtension();
                $drive_id_program = DriveApi::upload($file_name_program, $file_path_program, $file_type_program, $folder_id);
            }

            // infografis n e
            if ($database) {
                $file_path_database = $database->getTempName();
                $file_type_database = $database->getMimeType();
                $file_name_database = $user->npm . '_' . $user->nama_mahasiswa . "_database.".$database->getExtension();
                $drive_id_database = DriveApi::upload($file_name_database, $file_path_database, $file_type_database, $folder_id);
            }
            // infografis n e
            if ($infografis_e) {
                $file_path_infografis_e = $infografis_e->getTempName();
                $file_type_infografis_e = $infografis_e->getMimeType();
                $file_name_infografis_e = $user->npm . '_' . $user->nama_mahasiswa . "_infografis_e.".$infografis_e->getExtension();
                $drive_id_infografis_e = DriveApi::upload($file_name_infografis_e, $file_path_infografis_e, $file_type_infografis_e, $folder_id);
            }
            // infografis n e
            if ($infografis_n_e) {
                $file_path_infografis_n_e = $infografis_n_e->getTempName();
                $file_type_infografis_n_e = $infografis_n_e->getMimeType();
                $file_name_infografis_n_e = $user->npm . '_' . $user->nama_mahasiswa . "_infografis_n_e.".$infografis_n_e->getExtension();
                $drive_id_infografis_n_e = DriveApi::upload($file_name_infografis_n_e, $file_path_infografis_n_e, $file_type_infografis_n_e, $folder_id);
            }

            $data_id = Utils::generateCode('DK',$model->countData());
            $data = [
                'Kode_Data_TA'=>$data_id,
                'Npm'=>$user->username,
                'Abstrak'=>$drive_id_abstrak,
                'Daftar_Pustaka'=>$drive_id_daftar_pustaka,
                'Laporan_TA'=>$drive_id_laporan_ta,
                'Lembar_Pengesahan'=>$drive_id_lembar_pengesahan,
                'Naskah_Publikasi'=>$drive_id_naskah_publikasi,
                'Program'=>$drive_id_program,
                'Database'=>$drive_id_database,
                'Infografis_e'=>$drive_id_infografis_e,
                'Infografis_n_e'=>$drive_id_infografis_n_e,
                'Waktu_Submit'=>date('Y-m-d')
            ];

            $model->insertData($data);
            $data2 = [
                'Kode_Keterangan_ta'=>Utils::generateCode('KT',$model->countDataWithTable('keterangan_kp')),
                'Kode_Data_ta'=>$data_id,
                'Npm'=>session()->get('username'),
                'Status_Kel_Data'=>'Belum diperiksa',
                'Status_CD'=>'Belum mengumpulkan',
                'Catatan'=>''
            ];

            $model->insertDataWithTable($data2,'keterangan_ta');

            session()->setFlashdata('pesan', 'Pendaftaran Pasca tugas akhir berhasil dikirim');
            return 'success';
        } catch (\Throwable $th) {
            session()->setFlashdata('pesan', $th->getMessage());
            return 'warning';
        }
    }

    public function statusTa()
    {
        $model = new DataTa();

        $model->updateDataWithTable('keterangan_ta',[
            'Kode_Keterangan_ta'=>$this->request->getVar('kode_keterangan')
        ],[
            'Catatan'=>$this->request->getVar('catatan'),
            'Status_Kel_Data'=>$this->request->getVar('kelengkapan_data'),
            'Status_CD'=>$this->request->getVar('status_cd'),
        ]);

        session()->setFlashdata('pesan', 'Update status pasca tugas akhir berhasil');
        return redirect('admin/pasca/tugasakhir');
    }

    public function statusKp()
    {
        $model = new DataKp();

        $model->updateDataWithTable('keterangan_kp',[
            'Kode_Keterangan'=>$this->request->getVar('kode_keterangan')
        ],[
            'Catatan'=>$this->request->getVar('catatan'),
            'Status_Kel_Data'=>$this->request->getVar('kelengkapan_data'),
            'Status_CD'=>$this->request->getVar('status_cd'),
        ]);

        session()->setFlashdata('pesan', 'Update status pasca kerja praktik berhasil');
        return redirect('admin/pasca/kerjapraktik');
    }


    public function template()
    {
        if (session()->get('isLoggedIn')) :
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Bimbingan TA";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            echo view("pasca/kp", $data);
        else :
            return redirect()->to('home');
        endif;
    }


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

}
