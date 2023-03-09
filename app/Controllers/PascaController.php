<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\DataKp;
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
            $data['title'] = "Bimbingan TA";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
            $data['row'] = $dataKp->findOne('data_kp.Npm',session()->get('username'),'tb_pengajuan');
            $data['pengajuan'] = $dataKp->getJudul(session()->get('username'),'KP')->getRow();
            echo view("pasca/kp", $data);
        else :
            return redirect()->to('home');
        endif;
    }

    public function tugasakhir()
    {
        if (session()->get('isLoggedIn')) :
            $model = $this->getRole(session()->get('role'));
            $data['breadcrumbs'] = $this->bread->buildAuto();
            $data['title'] = "Bimbingan TA";
            $data['username'] = session()->get('username');
            $data['role'] = session()->get('role');
            $data['user'] = $model->getUser(session()->get('username'))->getResult();
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
