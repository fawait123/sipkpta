<?php

namespace App\Models;

use CodeIgniter\Model;

class KaprodiModel extends Model
{
    protected $table = 'tb_kaprodi';
    protected $primaryKey = 'username';
    protected $allowedFields = ['username', 'nama_kaprodi'];

    public function getUser($username)
    {
        $builder = $this->db->table('tb_kaprodi');
        $builder->where('username', $username);
        return $builder->get();
    }

    public function saveNama($data)
    {
        $query = $this->db->table('tb_kaprodi')->insert($data);
        return $query;
    }

    public function deleteKaprodi($username)
    {
        $query = $this->db->table('tb_kaprodi')->delete(array('username' => $username));
        return $query;
    }
}
