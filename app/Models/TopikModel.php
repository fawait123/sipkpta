<?php

namespace App\Models;

use CodeIgniter\Model;

class TopikModel extends Model
{

    public function getTopik()
    {
        $builder = $this->db->table('tb_topik');
        return $builder->get();
    }

    public function cekTopik($nama_topik)
    {
        $builder = $this->db->table('tb_topik');
        $builder->select('nama_topik');
        $builder->where('nama_topik', $nama_topik);
        return $builder->get();
    }

    public function saveTopik($data)
    {
        $query = $this->db->table('tb_topik')->insert($data);
        return $query;
    }

    public function updateTopik($data, $kode)
    {
        $query = $this->db->table('tb_topik')->update($data, array('kode_topik' => $kode));
        return $query;
    }

    public function deleteTopik($kode)
    {
        $query = $this->db->table('tb_topik')->delete(array('kode_topik' => $kode));
        return $query;
    }

    public function autoCode()
    {
        $builder = $this->db->table('tb_topik');
        $builder->selectCount('kode_topik');
        return $builder->get();
    }
}
