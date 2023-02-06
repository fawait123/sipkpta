<?php

namespace App\Models;

use CodeIgniter\Model;

class UjianModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_ujian';
    protected $primaryKey           = 'kd_ujian';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'kd_ujian',
        'kd_pendaftaran',
        'title',
        'nik'
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

    public function countRow()
    {
        $bulder = $this->db->table($this->table);
        $bulder->get();
        return $bulder->countAllResults();
    }

    public function get($where,$where2)
    {
        $builder = $this->db->table('tb_ujian');
        $builder->join('tb_dosen','tb_ujian.nik=tb_dosen.nik','left');
        $builder->where('tb_ujian.kd_pendaftaran', $where);
        $builder->where('tb_ujian.title', $where2);
        return $builder->get();
    }

    public function get2($where)
    {
        $builder = $this->db->table('tb_ujian');
        $builder->join('tb_dosen','tb_ujian.nik=tb_dosen.nik','left');
        $builder->where('tb_ujian.kd_pendaftaran', $where);
        return $builder->get();
    }

    public function getRow($kode)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->join('tb_ploting_pembimbing', 'tb_pengajuan.no_pengajuan=tb_ploting_pembimbing.no_pengajuan', 'left');
        $builder->where('tb_pengajuan.no_pengajuan',$kode);
        return $builder->get();   
    }

    public function edit($nik,$where)
    {
        $builder = $this->db->table('tb_ujian');
        $builder->set('nik',$nik);
        $builder->where($where);
        return $builder->update();
    }

    public function getId($where)
    {
        $builder = $this->db->table('tb_pendaftaran');
        $builder->where('tb_pendaftaran.no_pengajuan',$where);
        return $builder->get();
    }
}
