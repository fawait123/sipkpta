<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DosenModel;

class Dosen extends BaseController
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
            $data['title'] = "Data Dosen";
            $data['username'] = $session->get('username');
            $data['role'] = $session->get('role');
            $username = $data['username'];
            $model = new AdminModel();
            $data['user'] = $model->getUser($username)->getResult();
            $model2 = new DosenModel();
            $data['tb_dosen'] = $model2->getDosen()->getResult();
            echo view('dosen', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function ceknik()
    {
        $model = new DosenModel();
        $nik = $this->request->getPost('nik');
        $nik2 = $model->cekNik($nik)->getResult();
        $count2 = count($nik2);
        if (empty($count2)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function ceknidn()
    {
        $model = new DosenModel();
        $nidn = $this->request->getPost('nidn');
        $nidn2 = $model->cekNik($nidn)->getResult();
        $count3 = count($nidn2);
        if (empty($count3)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function save()
    {
        $model = new DosenModel();
        $data = [
            'nik' => $this->request->getPost('nik'),
            'username' => $this->request->getPost('nik'),
            'nama_dosen'        => $this->request->getPost('nama_dosen'),
            'nidn'        => $this->request->getPost('nidn'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'email'        => $this->request->getPost('email'),
            'jabatan_fungsional'        => $this->request->getPost('jabatan_fungsional'),
            'status_homebase'        => $this->request->getPost('status_homebase'),
            'status_menjabat'        => $this->request->getPost('status_menjabat'),
            'link_kp'        => $this->request->getPost('link_kp'),
            'link_ta'        => $this->request->getPost('link_ta'),
        ];
        $model->saveDosen($data);

        $userModel = new \App\Models\UserModel();
        $user = new \App\Entities\User();
        $user->username = $this->request->getPost('nik');
        $password = $this->request->getPost('nik');
        $user->password = $password;
        $user->role = "dosen";

        $userModel->save($user);

        $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
        return redirect()->to('/dosen');
    }

    public function importExcel()
    {
        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();

        \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder(new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder());

        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();;
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $render->load($file_excel);
        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $x => $row) {
            if ($x == 0) {
                continue;
            }
            $nik = $row[0];
            $nama_dosen = $row[1];
            $nidn = $row[2];
            $no_telp = $row[3];
            $email = $row[4];
            $jabatan_fungsional = $row[5];
            $status_homebase = $row[6];
            $status_menjabat = $row[7];
            $link_kp = $row[8];
            $link_ta = $row[9];

            $db = \Config\Database::connect();

            $cekNik = $db->table('tb_dosen')->getWhere(['nik' => $nik])->getResult();

            if (count($cekNik) > 0) {
                session()->setFlashdata('message', '<b style="color:red"> Data Gagal di Import NIK ada yang sama</b>');
            } else {
                $simpanData = [
                    'username' => $nik,
                    'nama_dosen' => $nama_dosen,
                    'nik' => $nik,
                    'nidn' => $nidn,
                    'no_telp' => $no_telp,
                    'email' => $email,
                    'jabatan_fungsional' => $jabatan_fungsional,
                    'status_homebase' => $status_homebase,
                    'status_menjabat' => $status_menjabat,
                    'link_kp'        => $link_kp,
                    'link_ta'        => $link_ta,
                ];

                $db->table('tb_dosen')->insert($simpanData);

                $userModel = new \App\Models\UserModel();
                $user = new \App\Entities\User();
                $user->username = $nik;
                $password = $nik;
                $user->password = $password;
                $user->role = "dosen";

                $userModel->save($user);

                $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
            }
        }
        return redirect()->to('/Dosen');
    }

    public function update()
    {
        $model = new DosenModel();
        $nik = $this->request->getPost('nik');
        $data = [
            'nik' => $this->request->getPost('nik'),
            'username' => $this->request->getPost('nik'),
            'nama_dosen'        => $this->request->getPost('nama_dosen'),
            'nidn'        => $this->request->getPost('nidn'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'email'        => $this->request->getPost('email'),
            'jabatan_fungsional'        => $this->request->getPost('jabatan_fungsional'),
            'status_homebase'        => $this->request->getPost('status_homebase'),
            'status_menjabat'        => $this->request->getPost('status_menjabat'),
            'link_kp'        => $this->request->getPost('link_kp'),
            'link_ta'        => $this->request->getPost('link_ta'),
        ];
        $model->updateDosen($data, $nik);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/dosen');
    }

    public function delete()
    {
        $model = new DosenModel();
        $nik = $this->request->getPost('nik');
        $model->deleteDosen($nik);
        $this->session->setFlashdata('success', ['Data Berhasil Dihapus']);
        return redirect()->to('/dosen');
    }
}
