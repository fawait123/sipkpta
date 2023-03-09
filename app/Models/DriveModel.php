<?php

namespace App\Models;

use CodeIgniter\Model;

class DriveModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_drive';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['username','jenis','drive_id','keterangan'];

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


    public function getWhere($username,$jenis){
        $query = $this->db->table($this->table);
        $query = $query->getWhere([
            'username'=>$username,
            'jenis'   =>$jenis
            ])->getRow();
        return $query;
    }

    public function getWhere2($username,$jenis,$search){
        $query = $this->db->table($this->table);
        $query = $query->getWhere([
            'username'=>$username,
            'jenis'   =>$jenis,
            'keterangan'=>$search,
            ])->getRow();
        return $query;
    }

    public function insertData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function getParentFolder($username,$jenis)
    {
        $query =  $this->db->table($this->table);
        $query = $query->getWhere([
            'username'=>$username,
            'jenis'=>$jenis
        ])->getRow();
        return $query;
    }

    public function getParentFolder2($username,$jenis)
    {
        $query =  $this->db->table($this->table);
        $query = $query->getWhere([
            'username'=>$username,
            'jenis'=>$jenis,
        ])->getRow();
        return $query;
    }
}
