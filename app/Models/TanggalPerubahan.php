<?php

namespace App\Models;

use CodeIgniter\Model;

class TanggalPerubahan extends Model
{
    protected $table = 'tanggal_perubahan_judul';
    protected $primaryKey = 'id';
    protected $allowedFields = ['start', 'end'];

    public function getOne()
    {
        $builder = $this->db->table($this->table);
        return $builder->get();
    }

    function updateTanggal($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }
}
