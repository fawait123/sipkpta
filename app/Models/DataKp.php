<?php

namespace App\Models;

use CodeIgniter\Model;

class DataKp extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'data_kp';
    protected $primaryKey           = 'Kode_Data_KP';
    protected $useAutoIncrement     = false;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'Kode_Data_KP',
        'Npm',
        'Judul_KP',
        'Abstrak',
        'Naskah',
        'Program',
        'Database',
        'Infografis_e',
        'Infografis_n_e',
        'Waktu_Submit',
        'json_e'
    ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'Kode_Data_KP'=>'required',
        'Npm'=>'required',
        'Judul_KP'=>'required',
        'Abstrak'=>'required',
        'Naskah'=>'required',
        'Program'=>'required',
        'Database'=>'required',
        'Infografis_e'=>'required',
        'Infografis_n_e'=>'required',
        'Waktu_Submit'=>'required',
    ];
    protected $validationMessages   = [
        'Kode_Data_KP'=>'This field is required',
        'Npm'=>'This field is required',
        'Judul_KP'=>'This field is required',
        'Abstrak'=>'This field is required',
        'Naskah'=>'This field is required',
        'Program'=>'This field is required',
        'Database'=>'This field is required',
        'Infografis_e'=>'This field is required',
        'Infografis_n_e'=>'This field is required',
        'Waktu_Submit'=>'This field is required',
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];


    public function insertData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function insertDataWithTable($data,$table)
    {
        $query = $this->db->table($table)->insert($data);
        return $query;
    }

    public function updateDataWithTable($table,$id,$data)
    {
        $query = $this->db->table($table)->update($data,$id);
    }


    public function countData()
    {
        $query = $this->db->table($this->table)->countAll();
        return $query;
    }

    public function countDataWithTable($table)
    {
        $query = $this->db->table($table)->countAll();
        return $query;
    }


    public function findOne($key,$value){
        $query = $this->db->table($this->table);
        $query = $query->join('keterangan_kp','data_kp.Kode_Data_Kp = keterangan_kp.Kode_Data_kp', 'left');
        $query = $query->getWhere([
            $key=>$value,
            ])->getRow();
        return $query;
    }

    public function findOneWithTable($where,$table)
    {
        $query = $this->db->table($table);
        $query = $query->getWhere($where)->getRow();
        return $query;
    }


    public function getJudul($username,$jenis)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->join('tb_disposisi', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_dosen', 'tb_disposisi.nik = tb_dosen.nik', 'left');
        $builder->join('tb_perubahan_judul', 'tb_pengajuan.no_perubahan = tb_perubahan_judul.no_perubahan', 'left');
        $builder->where('tb_disposisi.status_disposisi', "Disposisi");
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('tb_disposisi.jenis', $jenis);
        $status_perpanjang = ['Baru', 'Perpanjang', 'Selesai'];
        $builder->whereIn('status_perpanjang', $status_perpanjang);
        return  $builder->get();
    }

    public function get($id=null)
    {
        $builder = $this->db->table($this->table);
        $builder->join('tb_mahasiswa', 'tb_mahasiswa.npm = data_kp.Npm', 'left');
        $builder->join('keterangan_kp', 'keterangan_kp.Kode_Data_Kp = data_kp.Kode_Data_KP', 'left');
        if($id != null){
            $builder = $builder->where('data_kp.Kode_Data_KP',$id);
        }
        return $builder->get();
    }
}
