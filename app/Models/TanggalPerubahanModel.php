<?php

namespace App\Models;

use CodeIgniter\Model;

class TanggalPerubahanModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tanggal_perubahan';
    protected $primaryKey           = 'kd_perubahan';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'kd_perubahan',
        'no_pengajuan',
        'start',
        'end'
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

    public function check($username,$jenis)
    {
        date_default_timezone_set('Asia/Jakarta');
        $builder = $this->db->table($this->table);
        $builder->join('tb_pengajuan','tanggal_perubahan.no_pengajuan=tb_pengajuan.no_pengajuan','left');
        $builder->join('tb_disposisi','tb_pengajuan.no_pengajuan=tb_disposisi.no_pengajuan','left');
        $builder->join('tb_ploting_pembimbing','tb_disposisi.no_ploting_pembimbing=tb_ploting_pembimbing.no_ploting_pembimbing','left');
        $builder->join('tb_dosen','tb_ploting_pembimbing.nik=tb_dosen.nik','left');
        $builder->join('tb_mahasiswa','tb_pengajuan.npm=tb_mahasiswa.npm','left');
        $builder->join('tb_perubahan_judul','tb_pengajuan.no_perubahan=tb_perubahan_judul.no_perubahan','left');
        $builder->where('tanggal_perubahan.end >=',date('Y-m-d H:i:s'));
        $builder->where('tb_pengajuan.npm',$username);
        $builder->where('tb_pengajuan.jenis',$jenis);
        return $builder->get();
    }
}
