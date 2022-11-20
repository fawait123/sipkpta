<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{

    protected $table = 'tb_dosen';
    protected $primaryKey = 'nik';
    protected $allowedFields = ['nik', 'username', 'nama_dosen', 'nidn', 'jabatan_fungsional', 'status_homebase', 'no_telp', 'status_menjabat', 'email', 'kode_detail_topik'];

    public function getUser($username)
    {
        $builder = $this->db->table('tb_dosen');
        $builder->where('username', $username);
        return $builder->get();
    }

    public function getDosen()
    {
        $builder = $this->db->table('tb_dosen');
        return $builder->get();
    }

    public function saveDosen($data)
    {
        $query = $this->db->table('tb_dosen')->insert($data);
        return $query;
    }

    public function updateDosen($data, $nik)
    {
        $query = $this->db->table('tb_dosen')->update($data, array('nik' => $nik));
        return $query;
    }

    public function deleteDosen($nik)
    {
        $query = $this->db->table('tb_dosen')->delete(array('nik' => $nik));
        return $query;
    }

    public function cekNik($nik)
    {
        $builder = $this->db->table('tb_dosen');
        $builder->select('nik');
        $builder->where('nik', $nik);
        return $builder->get();
    }

    public function cekNidn($nidn)
    {
        $builder = $this->db->table('tb_dosen');
        $builder->select('nidn');
        $builder->where('nidn', $nidn);
        return $builder->get();
    }

    public function getMahasiswa($username, $type, $semester, $tahun_ajaran)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->join('tb_disposisi', 'tb_pengajuan.no_pengajuan = tb_disposisi.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->where('tb_disposisi.nik', $username);
        $builder->where('tb_pengajuan.jenis', $type);
        $status_perpanjang = ['Baru', 'Perpanjang'];
        $builder->whereIn('tb_pengajuan.status_perpanjang', $status_perpanjang);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        return $builder->get();
    }
}
