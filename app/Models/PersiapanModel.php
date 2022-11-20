<?php

namespace App\Models;

use CodeIgniter\Model;

class PersiapanModel extends Model
{
    protected $table = 'tanggal_pengajuan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'title', 'start', 'end'];

    public function updatePengumuman($data, $id)
    {
        $query = $this->db->table('pengumuman_pengajuan')->update($data, array('id' => $id));
        return $query;
    }

    public function getPengumumanKP()
    {
        $builder = $this->db->table('pengumuman_pengajuan');
        $builder->select('*');
        $builder->where('jenis', 'KP');
        return $builder->get();
    }

    public function getPengumumanTA()
    {
        $builder = $this->db->table('pengumuman_pengajuan');
        $builder->select('*');
        $builder->where('jenis', 'TA');
        return $builder->get();
    }

    public function getTanggalKP()
    {
        $builder = $this->db->table('tanggal_pengajuan');
        $builder->select('*');
        $builder->orderBy('id');
        $builder->where('jenis', 'KP');
        return $builder->get();
    }

    public function getTanggalTA()
    {
        $builder = $this->db->table('tanggal_pengajuan');
        $builder->select('*');
        $builder->orderBy('id');
        $builder->where('jenis', 'TA');
        return $builder->get();
    }

    public function getTanggalPerpanjang()
    {
        $builder = $this->db->table('tanggal_pengajuan');
        $builder->select('*');
        $builder->orderBy('id');
        $builder->where('jenis', 'Perpanjang');
        return $builder->get();
    }

    public function getTahunAjaran()
    {
        $builder = $this->db->table('tahun_ajaran');
        $builder->select('*');
        return $builder->get();
    }

    function updateTahunAjaran($data, $id)
    {
        $query = $this->db->table('tahun_ajaran')->update($data, array('id_tahun_ajaran' => $id));
        return $query;
    }

    function updateTanggal($data, $id)
    {
        $query = $this->db->table('tanggal_pengajuan')->update($data, array('id' => $id));
        return $query;
    }
}
