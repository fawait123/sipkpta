<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tb_admin';
    protected $primaryKey = 'username';
    protected $allowedFields = ['username', 'nama_admin'];

    public function getUser($username)
    {
        $builder = $this->db->table('tb_admin');
        $builder->where('username', $username);
        return $builder->get();
    }

    public function saveNama($data)
    {
        $query = $this->db->table('tb_admin')->insert($data);
        return $query;
    }

    public function deleteAdmin($username)
    {
        $query = $this->db->table('tb_admin')->delete(array('username' => $username));
        return $query;
    }
}
