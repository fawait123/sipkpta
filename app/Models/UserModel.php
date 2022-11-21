<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user', 'username', 'password', 'role', 'status'];
    protected $returnType = 'App\Entities\User';

    public function deleteUser($username)
    {
        $query = $this->db->table('tb_user')->delete(array('username' => $username));
        return $query;
    }

    public function cekUsername($username)
    {
        $builder = $this->db->table('tb_user');
        $builder->select('username');
        $builder->where('username', $username);
        return $builder->get();
    }

    public function getAllUser()
    {
        $role = ['mahasiswa', 'dosen'];
        $builder = $this->db->table('tb_user');
        $builder->select('*');
        $builder->whereNotIn('role', $role);
        return $builder->get();
    }

    public function getMahasiswa($username)
    {
        $builder = $this->db->table('tb_mahasiswa');
        $builder->where('username', $username);
        return $builder->get();
    }
}
