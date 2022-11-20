<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_notifikasi';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'transfer',
        'receive',
        'notif',
        'url',
        'status',
        'created_at'
    ];

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

    public function getNotif()
    {
        $builder = $this->db->table($this->table);
        $builder->join('tb_mahasiswa','tb_notifikasi.transfer=tb_mahasiswa.npm','left');
        $builder->join('tb_dosen','tb_notifikasi.transfer=tb_dosen.nik','left');
        $builder->where('receive', session()->get('username'));
        $builder->where('status', 'unread');
        $builder->orderBy('tb_notifikasi.id','desc');
        return $builder->get();
    }

    public function get()
    {
        $builder = $this->db->table($this->table);
        $builder->join('tb_mahasiswa','tb_notifikasi.transfer=tb_mahasiswa.npm','left');
        $builder->join('tb_dosen','tb_notifikasi.transfer=tb_dosen.nik','left');
        $builder->where('receive', session()->get('username'));
        return $builder->get();
    }
}
