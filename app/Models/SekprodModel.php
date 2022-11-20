<?php

namespace App\Models;

use CodeIgniter\Model;

class SekprodModel extends Model
{
    protected $table = 'tb_sekprod';
    protected $primaryKey = 'username';
    protected $allowedFields = ['username', 'nama_sekprod'];

    public function getUser($username)
    {
        $builder = $this->db->table('tb_sekprod');
        $builder->where('username', $username);
        return $builder->get();
    }

    public function saveNama($data)
    {
        $query = $this->db->table('tb_sekprod')->insert($data);
        return $query;
    }

    public function deleteSekprod($username)
    {
        $query = $this->db->table('tb_sekprod')->delete(array('username' => $username));
        return $query;
    }
}
