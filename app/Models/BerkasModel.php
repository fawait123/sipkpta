<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
    protected $table = 'tb_berkas';
    protected $primaryKey = 'no_berkas';
    protected $allowedFields = ['no_berkas', 'surat', 'bukti_proposal', 'bukti_spp', 'sertifikat_sosialisasi'];

    public function getBerkas($jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_berkas', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_data_diri', 'tb_mahasiswa.npm = tb_data_diri.npm', 'left');
        $builder->where('status_perpanjang', 'Baru');
        $builder->where('jenis', $jenis);
        $builder->where('tahun_ajaran', $tahun_ajaran);
        $builder->where('semester', $semester);
        return $builder->get();
    }

    public function getBerkasDetail($no_berkas)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_berkas', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_data_diri', 'tb_mahasiswa.npm = tb_data_diri.npm', 'left');
        $builder->where('tb_berkas.no_berkas', $no_berkas);
        return $builder->get();
    }

    public function updateBerkas($data, $no_berkas)
    {
        $query = $this->db->table('tb_berkas')->update($data, array('no_berkas' => $no_berkas));
        return $query;
    }
}
