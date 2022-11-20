<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function getMahasiswa()
    {
        $builder = $this->db->table('tb_mahasiswa');
        $builder->selectCount('npm', 'total_mahasiswa');
        return $builder->get();
    }

    public function getDosen()
    {
        $builder = $this->db->table('tb_dosen');
        $builder->selectCount('nik', 'total_dosen');
        return $builder->get();
    }

    public function getTopik()
    {
        $builder = $this->db->table('tb_topik');
        $builder->selectCount('kode_topik', 'total_topik');
        return $builder->get();
    }

    public function getPengajuan($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('jenis');
        $builder->selectCount('no_pengajuan', 'total_jenis');
        $builder->where('tahun_ajaran', $tahun_ajaran);
        $builder->where('semester', $semester);
        $builder->groupBy('jenis');
        return $builder->get();
    }

    public function getDosenTopik($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_detail_topik');
        $builder->select('*');
        $builder->join('tb_dosen', 'tb_detail_topik.nik = tb_dosen.nik', 'left');
        $builder->join('tb_topik', 'tb_detail_topik.kode_topik = tb_topik.kode_topik', 'left');
        $builder->where('tahun_ajaran', $tahun_ajaran);
        $builder->where('semester', $semester);
        $builder->limit('6');
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

    public function getAllUser()
    {
        $role = ['mahasiswa', 'dosen'];
        $builder = $this->db->table('tb_user');
        $builder->select('*');
        $builder->whereNotIn('role', $role);
        $builder->limit('16');
        return $builder->get();
    }

    public function getAccPengajuan($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('no_pengajuan, tb_pengajuan.npm, nama_mahasiswa, tb_pengajuan.jenis, status_pengajuan');
        $builder->join('tb_berkas', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->join('tb_nilai', 'tb_pengajuan.no_nilai = tb_nilai.no_nilai', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_detail_topik', 'tb_pengajuan.kode_detail = tb_detail_topik.kode_detail', 'left');
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->limit('6');
        return $builder->get();
    }

    public function getPloting($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('no_pengajuan, tb_pengajuan.npm, nama_mahasiswa, tb_pengajuan.jenis, nama_dosen');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_detail_topik', 'tb_pengajuan.kode_detail = tb_detail_topik.kode_detail', 'left');
        $builder->join('tb_topik', 'tb_detail_topik.kode_topik = tb_topik.kode_topik', 'left');
        $builder->join('tb_dosen', 'tb_detail_topik.nik = tb_dosen.nik', 'left');
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->where('tb_pengajuan.status_pengajuan', 'ACC');
        $builder->limit('6');
        return $builder->get();
    }

    public function getDisposisi($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_disposisi');
        $builder->select('tb_pengajuan.no_pengajuan, tb_pengajuan.npm, tb_pengajuan.jenis,  nama_mahasiswa, s1.nama_dosen as nama_dosen, tb_disposisi.no_ploting_pembimbing, s2.nama_dosen as nama_pembimbing');
        $builder->join('tb_pengajuan', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_ploting_pembimbing', 'tb_disposisi.no_ploting_pembimbing = tb_ploting_pembimbing.no_ploting_pembimbing', 'left');
        $builder->join('tb_detail_topik', 'tb_pengajuan.kode_detail = tb_detail_topik.kode_detail', 'left');
        $builder->join('tb_dosen s1', 'tb_detail_topik.nik = s1.nik', 'left');
        $builder->join('tb_dosen s2', 'tb_ploting_pembimbing.nik = s2.nik', 'left');
        $builder->where('tb_disposisi.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_disposisi.semester', $semester);
        $builder->limit('6');
        return $builder->get();
    }

    public function getNilai($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_nilai', 'tb_pengajuan.no_nilai = tb_nilai.no_nilai', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->limit('6');
        return $builder->get();
    }
}
