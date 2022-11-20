<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'tb_mahasiswa';
    protected $primaryKey = 'npm';
    protected $allowedFields = ['npm', 'username', 'nama_mahasiswa', 'no_telp', 'email', 'ni_kependudukan', 'tempat_lahir', 'tanggal_lahir'];

    public function getUser($username)
    {
        $builder = $this->db->table('tb_mahasiswa');
        $builder->where('username', $username);
        return $builder->get();
    }

    public function getMahasiswa()
    {
        $builder = $this->db->table('tb_mahasiswa');
        return $builder->get();
    }

    public function saveMahasiswa($data)
    {
        $query = $this->db->table('tb_mahasiswa')->insert($data);
        return $query;
    }

    public function updateMahasiswa($data, $npm)
    {
        $query = $this->db->table('tb_mahasiswa')->update($data, array('npm' => $npm));
        return $query;
    }

    public function deleteMahasiswa($npm)
    {
        $query = $this->db->table('tb_mahasiswa')->delete(array('npm' => $npm));
        return $query;
    }

    public function cekMahasiswa($npm)
    {
        $builder = $this->db->table('tb_mahasiswa');
        $builder->select('npm');
        $builder->where('npm', $npm);
        return $builder->get();
    }
}
