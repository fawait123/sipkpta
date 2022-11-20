<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasPerpanjangModel extends Model
{
    protected $table = 'tb_berkas_perpanjang';
    protected $primaryKey = 'no_berkas_perpanjang';
    protected $allowedFields = ['no_berkas_perpanjang', 'npm', 'jenis', 'no_pengajuan', 'kartu_bimbingan', 'bukti_spp_tetap', 'bukti_spp_variabel', 'krs', 'keterangan'];

    public function getBerkasPerpanjangKP($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_berkas_perpanjang');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_pengajuan.no_pengajuan = tb_berkas_perpanjang.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_data_diri', 'tb_mahasiswa.npm = tb_data_diri.npm', 'left');
        $builder->where('tb_pengajuan.jenis', "KP");
        $builder->where('tahun_ajaran', $tahun_ajaran);
        $builder->where('semester', $semester);
        return $builder->get();
    }

    public function getBerkasPerpanjangTA($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_berkas_perpanjang');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_pengajuan.no_pengajuan = tb_berkas_perpanjang.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_data_diri', 'tb_mahasiswa.npm = tb_data_diri.npm', 'left');
        $builder->where('tb_pengajuan.jenis', "TA");
        $builder->where('tahun_ajaran', $tahun_ajaran);
        $builder->where('semester', $semester);
        return $builder->get();
    }

    public function getBerkasDetailPerpanjang($no_berkas_perpanjang)
    {
        $builder = $this->db->table('tb_berkas_perpanjang');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_pengajuan.no_pengajuan = tb_berkas_perpanjang.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->where('tb_berkas_perpanjang.no_berkas_perpanjang', $no_berkas_perpanjang);
        return $builder->get();
    }

    public function updateBerkasPerpanjang($data, $no_berkas_perpanjang)
    {
        $query = $this->db->table('tb_berkas_perpanjang')->update($data, array('no_berkas_perpanjang' => $no_berkas_perpanjang));
        return $query;
    }
}
