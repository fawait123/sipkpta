<?php

namespace App\Models;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Model;

class TopikKuotaModel extends Model
{

    public function getTopik()
    {
        $builder = $this->db->table('tb_topik');
        return $builder->get();
    }

    public function getTopik2($nik, $jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_topik');
        $builder->select('*');
        $builder->whereNotIn('kode_topik', function (BaseBuilder $builder) use ($nik, $jenis, $tahun_ajaran, $semester) {
            return $builder->select('kode_topik')->from('tb_detail_topik')->where('nik', $nik)->where('jenis', $jenis)->where('tahun_ajaran', $tahun_ajaran)->where('semester', $semester);
        });
        return $builder->get();
    }

    public function getDetailTopik()
    {
        $builder = $this->db->table('tb_detail_topik');
        return $builder->get();
    }

    public function getDosen()
    {
        $builder = $this->db->table('tb_dosen');
        $builder->select('*');
        $builder->orderBy('nama_dosen', 'ASC');
        return $builder->get();
    }

    public function getDosenTopik($jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_detail_topik');
        $builder->select('*');
        $builder->join('tb_dosen', 'tb_detail_topik.nik = tb_dosen.nik', 'left');
        $builder->join('tb_topik', 'tb_detail_topik.kode_topik = tb_topik.kode_topik', 'left');
        $builder->where('jenis', $jenis);
        $builder->where('tahun_ajaran', $tahun_ajaran);
        $builder->where('semester', $semester);
        return $builder->get();
    }

    public function getDosenTopik2($kode_detail)
    {
        $builder = $this->db->table('tb_detail_topik');
        $builder->select('*');
        $builder->join('tb_dosen', 'tb_detail_topik.nik = tb_dosen.nik', 'left');
        $builder->join('tb_topik', 'tb_detail_topik.kode_topik = tb_topik.kode_topik', 'left');
        $builder->where('kode_detail', $kode_detail);
        return $builder->get();
    }

    public function saveDetailTopik($data)
    {
        $query = $this->db->table('tb_detail_topik')->insert($data);
        return $query;
    }

    public function autoCode()
    {
        $builder = $this->db->table('tb_detail_topik');
        $builder->selectCount('kode_detail');
        return $builder->get();
    }

    public function updateKuota($data, $kode_detail)
    {
        $query = $this->db->table('tb_detail_topik')->update($data, array('kode_detail' => $kode_detail));
        return $query;
    }

    public function deleteDetailTopik($kode_detail)
    {
        $query = $this->db->table('tb_detail_topik')->delete(array('kode_detail' => $kode_detail));
        return $query;
    }
}
