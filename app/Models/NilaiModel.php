<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'tb_nilai';
    protected $primaryKey = 'no_nilai';
    protected $allowedFields = ['no_nilai', 'status_nilai', 'catatan_nilai', 'nilai_de', 'mk_nilai_de', 'jumlah_sks', 'ipk'];

    public function getNilai($jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_nilai', 'tb_pengajuan.no_nilai = tb_nilai.no_nilai', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->where('jenis', $jenis);
        $builder->where('tahun_ajaran', $tahun_ajaran);
        $builder->where('semester', $semester);
        $builder->where('status_perpanjang', 'Baru');
        return $builder->get();
    }

    public function updateNilai($data, $no_nilai)
    {
        $query = $this->db->table('tb_nilai')->update($data, array('no_nilai' => $no_nilai));
        return $query;
    }
}
