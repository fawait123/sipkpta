<?php

namespace App\Models;

use CodeIgniter\Model;

class DataDiriModel extends Model
{
    protected $table = 'tb_data_diri';
    protected $primaryKey = 'no_data_diri';
    protected $allowedFields = ['no_data_diri', 'npm', 'ktp', 'kk', 'akte', 'ktm', 'ijazah', 'data_diri'];

    public function autoCode()
    {
        $builder = $this->db->table('tb_data_diri');
        $builder->selectCount('no_data_diri');
        return $builder->get();
    }

    public function saveDataDiri($data)
    {
        $query = $this->db->table('tb_data_diri')->insert($data);
        return $query;
    }

    public function updateDataDiri($data, $no_data_diri)
    {
        $query = $this->db->table('tb_data_diri')->update($data, array('no_data_diri' => $no_data_diri));
        return $query;
    }

    public function getDataDiri($username)
    {
        $builder = $this->db->table('tb_data_diri');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_pengajuan.npm = tb_data_diri.npm', 'left');
        $builder->join('tb_berkas', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->where('tb_data_diri.npm', $username);
        $builder->orderBy('tb_pengajuan.jenis','DESC');
        $builder->limit('1');
        return $builder->get();
    }

    public function cekDataDiri($username)
    {
        $builder = $this->db->table('tb_data_diri');
        $builder->select('*');
        $builder->where('tb_data_diri.npm', $username);
        return $builder->get();
    }
}
