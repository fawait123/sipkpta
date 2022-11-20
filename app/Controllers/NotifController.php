<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\NotifBimbinganModel;
use App\Models\NotifikasiModel;
use App\Models\SekprodModel;

class NotifController extends BaseController
{
    public function __construct()
    {
        $this->bread = new LibrariesBreadcrumb();
    }
    public function get()
    {
        $builder = new NotifikasiModel();
        $hasil = $builder->getNotif()->getResult();
        $data['notifikasi'] = $hasil;
        return view('notifikasi/show',$data);
    }

    public function count()
    {
        $builder = new NotifikasiModel();
        $hasil = $builder->getNotif()->getResult();
        echo count($hasil);
    }

   public function all()
   {
        if(isset($_GET['withmsg'])){
            session()->setFlashdata('pesan', 'Data berhasil di update');
            return redirect()->to('notifcontroller/all');
        }
        $builder = new NotifikasiModel();
        $model = $this->getRole(session()->get('role'));
        $data['breadcrumbs'] = $this->bread->buildAuto();
        $data['title'] = "Perubahan Judul KP";
        $data['username'] = session()->get('username');
        $data['role'] = session()->get('role');
        $data['user'] = $model->getUser(session()->get('username'))->getResult();
        $data['notifikasi'] = $builder->get()->getResult();
       return view('notifikasi/index',$data);
   }

   public function update()
   {
       $id = $_POST['id'];

       $model = new NotifikasiModel();
       $data = [
           'status'=>'read'
       ];
       $where = [
           'id'=>$id
       ];
       $model->update($where,$data);
       echo 'berhasil';
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

    public function destroy($id)
    {
        $model = new NotifikasiModel();

        $model->delete(['id'=>$id]);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('notifcontroller/all');
    }

    public function updatestatus()
    {
        $id = $_POST['id'];
        $model = new NotifikasiModel();
        $model->update(
        [
            'id'=>$id
        ],
        [
            'status'=>'read'
        ]
    );
    echo 'berhasil';
    }
}
