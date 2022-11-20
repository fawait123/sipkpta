<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\MahasiswaModel;
use App\Models\UserModel;

class Mahasiswa extends BaseController
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
            $data['title'] = "Data Mahasiswa";
            $data['username'] = $session->get('username');
            $data['role'] = $session->get('role');
            $username = $data['username'];
            $model = new AdminModel();
            $data['user'] = $model->getUser($username)->getResult();
            $model2 = new MahasiswaModel();
            $data['tb_mahasiswa'] = $model2->getMahasiswa()->getResult();
            echo view('mahasiswa', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function ceknpm()
    {
        $model = new MahasiswaModel();
        $npm = $this->request->getPost('npm');
        $npm2 = $model->cekMahasiswa($npm)->getResult();
        $count2 = count($npm2);
        if (empty($count2)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function save()
    {
        $model = new MahasiswaModel();
        $data = [
            'npm' => $this->request->getPost('npm'),
            'username' => $this->request->getPost('npm'),
            'nama_mahasiswa'        => $this->request->getPost('nama_mahasiswa'),
            'ni_kependudukan'        => $this->request->getPost('ni_kependudukan'),
            'tempat_lahir'        => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'        => $this->request->getPost('tanggal_lahir'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'email'        => $this->request->getPost('email')
        ];
        $model->saveMahasiswa($data);

        $userModel = new \App\Models\UserModel();
        $user = new \App\Entities\User();
        $user->username = $this->request->getPost('npm');
        $password = date('Ymd',strtotime($this->request->getPost('tanggal_lahir')));
        $user->password = $password;
        $user->role = "mahasiswa";

        $userModel->save($user);

        $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
        return redirect()->to('/mahasiswa');
    }

    public function update()
    {
        $model = new MahasiswaModel();
        $npm = $this->request->getPost('npm');
        $data = [
            'nama_mahasiswa'        => $this->request->getPost('nama_mahasiswa'),
            'ni_kependudukan'        => $this->request->getPost('ni_kependudukan'),
            'tempat_lahir'        => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'        => $this->request->getPost('tanggal_lahir'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'email'        => $this->request->getPost('email')
        ];
        $model->updateMahasiswa($data, $npm);

        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        return redirect()->to('/mahasiswa');
    }

    public function delete()
    {
        $model = new MahasiswaModel();
        $npm = $this->request->getPost('npm');
        $model->deleteMahasiswa($npm);

        $model2 = new UserModel();
        $model2->deleteUser($npm);

        $this->session->setFlashdata('success', ['Data Berhasil Dihapus']);
        return redirect()->to('/mahasiswa');
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
            $npm = $row[0];
            $nama_mahasiswa = $row[1];
            $ni_kependudukan = $row[2];
            $no_telp = $row[3];
            $email = $row[4];
            $tempat_lahir = $row[5];
            $tanggal_lahir = $row[6];

            $db = \Config\Database::connect();

            $cekNpm = $db->table('tb_mahasiswa')->getWhere(['npm' => $npm])->getResult();

            if (count($cekNpm) > 0) {
                session()->setFlashdata('message', '<b style="color:red"> Data Gagal di Import NPM ada yang sama</b>');
            } else {
                $simpanData = [
                    'npm' => $npm,
                    'username' => $npm,
                    'nama_mahasiswa' => $nama_mahasiswa,
                    'ni_kependudukan' => $ni_kependudukan,
                    'no_telp' => $no_telp,
                    'email' => $email,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                ];
                
                $db->table('tb_mahasiswa')->insert($simpanData);

                $userModel = new \App\Models\UserModel();
                $user = new \App\Entities\User();
                $user->username = $npm;
                $password = date('Ymd',strtotime($tanggal_lahir));
                $user->password = $password;
                $user->role = "mahasiswa";

                $userModel->save($user);

                $this->session->setFlashdata('success', ['Data Berhasil Ditambahkan']);
            }
        }
        return redirect()->to('/mahasiswa');
    }
}
