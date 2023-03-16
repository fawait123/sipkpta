<?php

namespace App\Models;

use CodeIgniter\Model;

class DataTa extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'data_ta';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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
        $query = $query->join('keterangan_ta','data_ta.Kode_Data_Ta = keterangan_ta.Kode_Data_ta', 'left');
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
}
