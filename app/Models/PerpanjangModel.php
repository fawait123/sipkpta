<?php

namespace App\Models;

use CodeIgniter\Model;

class PerpanjangModel extends Model
{
    public function getPerpanjang($username)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.no_pengajuan, status_perpanjang, judul, studi_kasus, batas_bimbingan, tb_ploting_pembimbing.nik as nik, nama_dosen, tb_pengajuan.jenis, tb_pengajuan.tahun_ajaran, tb_pengajuan.semester');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_data_diri', 'tb_mahasiswa.npm = tb_data_diri.npm', 'left');
        $builder->join('tb_disposisi', 'tb_pengajuan.no_pengajuan = tb_disposisi.no_pengajuan', 'left');
        $builder->join('tb_ploting_pembimbing', 'tb_disposisi.no_ploting_pembimbing = tb_ploting_pembimbing.no_ploting_pembimbing', 'left');
        $builder->join('tb_dosen', 'tb_ploting_pembimbing.nik = tb_dosen.nik', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        $status_perpanjang = ['Baru', 'Perpanjang', 'Selesai'];
        $builder->whereIn('status_perpanjang', $status_perpanjang);
        $builder->orderBy('tb_pengajuan.jenis', 'DESC');
        $builder->limit('1');
        return $builder->get();
    }

    public function getPengajuanPerpanjang($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->where('tb_pengajuan.status_perpanjang', 'Perpanjang');
        return $builder->get();
    }

    public function getBerkasPerpanjang($username)
    {
        $builder = $this->db->table('tb_berkas_perpanjang');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_berkas_perpanjang.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        return $builder->get();
    }

    public function getDisposisiPerpanjang($username)
    {
        $builder = $this->db->table('tb_disposisi');
        $builder->select('nama_dosen, no_disposisi, tb_disposisi.jenis, link_kp, link_ta');
        $builder->join('tb_pengajuan', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_dosen', 'tb_disposisi.nik = tb_dosen.nik', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('status_disposisi', 'Disposisi');
        $builder->where('tb_pengajuan.status_perpanjang', 'Perpanjang');
        return $builder->get();
    }

    public function updatePengajuan($data, $no_pengajuan)
    {
        $query = $this->db->table('tb_pengajuan')->update($data, array('no_pengajuan' => $no_pengajuan));
        return $query;
    }

    public function updateDisposisi($data2, $no_pengajuan)
    {
        $query = $this->db->table('tb_disposisi')->update($data2, array('no_pengajuan' => $no_pengajuan));
        return $query;
    }

    public function getDisposisi3($no_disposisi)
    {
        $builder = $this->db->table('tb_disposisi');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_ploting_pembimbing', 'tb_disposisi.no_ploting_pembimbing = tb_ploting_pembimbing.no_ploting_pembimbing', 'left');
        $builder->join('tb_dosen', 'tb_ploting_pembimbing.nik = tb_dosen.nik', 'left');
        $builder->where('tb_disposisi.no_disposisi', $no_disposisi);
        return $builder->get();
    }

    public function getTahunAjaran()
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tahun_ajaran');
        $builder->groupBy('tahun_ajaran');
        return $builder->get();
    }

    public function saveBerkasPerpanjang($data3)
    {
        $query = $this->db->table('tb_berkas_perpanjang')->insert($data3);
        return $query;
    }

    public function updateBerkasPerpanjang($data3, $no_berkas_perpanjang)
    {
        $query = $this->db->table('tb_berkas_perpanjang')->update($data3, array('no_berkas_perpanjang' => $no_berkas_perpanjang));
        return $query;
    }

    public function autoCode()
    {
        $builder = $this->db->table('tb_berkas_perpanjang');
        $builder->selectCount('no_berkas_perpanjang');
        return $builder->get();
    }

    public function deleteBerkasPerpanjang($no_pengajuan)
    {
        $query = $this->db->table('tb_berkas_perpanjang')->delete(array('no_pengajuan' => $no_pengajuan));
        return $query;
    }
}
