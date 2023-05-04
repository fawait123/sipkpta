<?php

namespace App\Models;

use CodeIgniter\Model;

class PascaModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'pascas';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
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


    public function getJenis()
    {
        $builder = $this->db->table('jenis_kegiatan');
        return $builder->get();
    }

    public function getPeran($whereIn = null)
    {
        $builder = $this->db->table('peran');
        if($whereIn != null):
            $builder = $builder->whereIn('Kode_Peran',$whereIn);
        endif;
        return $builder->get();
    }

    public function getTingkat($whereIn = null)
    {
        $builder = $this->db->table('tingkat');
        if($whereIn != null):
            $builder = $builder->whereIn('Kode_Tingkat',$whereIn);
        endif;
        return $builder->get();
    }


    public function insertData($table,$data)
    {
        $builder = $this->db->table($table);
        $builder = $builder->insert($data);
        return $builder;
    }

    public function getData($table,$where=null)
    {
        $builder = $this->db->table($table);
        if($where != null):
            foreach($where as $item):
                $builder = $builder->where($item['field'],$item['value']);
            endforeach;
        endif;
        $builder = $builder->get();
        return $builder;
    }

    public function getSertifikat($npm=null)
    {
        $builder = $this->db->table('bukti_sertifikat');
        $builder = $builder->select('bukti_sertifikat.*, tingkat.Tingkat tingkat,peran.Peran peran,jenis_kegiatan.Jenis_Kegiatan kegiatan,detail_poin.Poin poin ');
        $builder = $builder->join('tingkat','tingkat.Kode_Tingkat = bukti_sertifikat.Kode_Tingkat','left');
        $builder = $builder->join('peran','peran.Kode_Peran = bukti_sertifikat.Kode_Peran','left');
        $builder = $builder->join('jenis_kegiatan','jenis_kegiatan.Kode_Kegiatan = bukti_sertifikat.Kode_Kegiatan','left');
        $builder = $builder->join('detail_poin','detail_poin.Kode_Detail_Poin = bukti_sertifikat.Kode_Detail_Poin','left');
        if($npm != null):
            $builder = $builder->where('bukti_sertifikat.npm',$npm);
        endif;
        return $builder->get();
    }

    public function updateData($table,$data,$id)
    {
        $builder = $this->db->table($table);

        $builder = $builder->update($data,$id);

        return $builder;
    }
}
