<?php

namespace App\Models;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Model;

class PengajuanModel extends Model
{
    public function getDosen($kode_topik, $jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_detail_topik');
        $builder->select('*');
        $builder->join('tb_dosen', 'tb_detail_topik.nik = tb_dosen.nik', 'left');
        $builder->join('tb_topik', 'tb_detail_topik.kode_topik = tb_topik.kode_topik', 'left');
        $builder->where('tb_detail_topik.kode_topik', $kode_topik);
        $builder->where('tb_detail_topik.jenis', $jenis);
        $builder->where('tahun_ajaran', $tahun_ajaran);
        $builder->where('semester', $semester);
        $builder->where('kuota > 0');
        $builder->orderBy('nama_dosen', 'ASC');
        return $builder->get();
    }

    public function autoCode()
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->selectCount('no_pengajuan');
        return $builder->get();
    }

    public function autoCodeProposal()
    {
        $builder = $this->db->table('tb_proposal');
        $builder->selectCount('no_proposal');
        return $builder->get();
    }

    public function autoCodeBerkas()
    {
        $builder = $this->db->table('tb_berkas');
        $builder->selectCount('no_berkas');
        return $builder->get();
    }

    public function autoCodeNilai()
    {
        $builder = $this->db->table('tb_nilai');
        $builder->selectCount('no_nilai');
        return $builder->get();
    }

    public function savePengajuan($data)
    {
        $query = $this->db->table('tb_pengajuan')->insert($data);
        return $query;
    }

    public function saveProposal($data2)
    {
        $query = $this->db->table('tb_proposal')->insert($data2);
        return $query;
    }

    public function saveBerkas($data3)
    {
        $query = $this->db->table('tb_berkas')->insert($data3);
        return $query;
    }

    public function saveNilai($data4)
    {
        $query = $this->db->table('tb_nilai')->insert($data4);
        return $query;
    }

    public function getKuota($kode_detail)
    {
        $builder = $this->db->table('tb_detail_topik');
        $builder->select('*');
        $builder->where('kode_detail', $kode_detail);
        $builder->where('kuota > 0');
        return $builder->get();
    }

    public function getKuota2($kode_detail3)
    {
        $builder = $this->db->table('tb_detail_topik');
        $builder->select('*');
        $builder->where('kode_detail', $kode_detail3);
        return $builder->get();
    }

    public function updatePengajuan($data, $no_pengajuan)
    {
        $query = $this->db->table('tb_pengajuan')->update($data, array('no_pengajuan' => $no_pengajuan));
        return $query;
    }

    public function updateProposal($data2, $no_proposal)
    {
        $query = $this->db->table('tb_proposal')->update($data2, array('no_proposal' => $no_proposal));
        return $query;
    }

    public function updateBerkas($data3, $no_berkas)
    {
        $query = $this->db->table('tb_berkas')->update($data3, array('no_berkas' => $no_berkas));
        return $query;
    }

    public function updateKuota($data4, $kode_detail)
    {
        $query = $this->db->table('tb_detail_topik')->update($data4, array('kode_detail' => $kode_detail));
        return $query;
    }

    public function updateKuota2($data5, $kode_detail3)
    {
        $query = $this->db->table('tb_detail_topik')->update($data5, array('kode_detail' => $kode_detail3));
        return $query;
    }

    public function pengumuman()
    {
        $builder = $this->db->table('pengumuman');
        $builder->select('*');
        return $builder->get();
    }

    public function cekPengajuan($username, $jenis)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_proposal', 'tb_pengajuan.no_proposal = tb_proposal.no_proposal', 'left');
        $builder->join('tb_berkas', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->join('tb_nilai', 'tb_pengajuan.no_nilai = tb_nilai.no_nilai', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('tb_pengajuan.jenis', $jenis);
        $status_perpanjang = ['Baru', 'Perpanjang', 'Selesai'];
        $builder->whereIn('status_perpanjang', $status_perpanjang);
        return $builder->get();
    }

    public function getPengajuanSekprod()
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->where('tb_pengajuan.jenis', 'KP');
        $status_perpanjang = ['Baru', 'Perpanjang', 'Selesai'];
        $builder->whereIn('status_perpanjang', $status_perpanjang);
        return $builder->get();
    }

    public function getMahasiswa()
    {
        $builder = $this->db->table('tb_mahasiswa');
        $builder->select('*');
        $builder->whereNotIn('npm', static fn (BaseBuilder $builder) => $builder->select('npm')->from('tb_pengajuan'));
        $builder->orderBy('npm', 'ASC');
        return $builder->get();
    }

    public function cekPengajuanKP($username)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_proposal', 'tb_pengajuan.no_proposal = tb_proposal.no_proposal', 'left');
        $builder->join('tb_berkas', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->join('tb_nilai', 'tb_pengajuan.no_nilai = tb_nilai.no_nilai', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('tb_pengajuan.jenis', 'KP');
        $builder->where('tb_pengajuan.status_perpanjang', 'Selesai');
        return $builder->get();
    }

    public function getDosen2()
    {
        $builder = $this->db->table('tb_dosen');
        $builder->select('*');
        return $builder->get();
    }

    public function cekDataDiri($username)
    {
        $builder = $this->db->table('tb_data_diri');
        $builder->select('*');
        $builder->where('tb_data_diri.npm', $username);
        return $builder->get();
    }

    public function getBerkas($username, $jenis)
    {
        $builder = $this->db->table('tb_berkas');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->where('tb_berkas.npm', $username);
        $builder->where('tb_pengajuan.jenis', $jenis);
        return $builder->get();
    }

    public function getPengajuan($username, $jenis)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.*');
        $builder->select('tb_proposal.*');
        $builder->select('tb_berkas.*');
        $builder->select('tb_perubahan_judul.judul_perubahan as judul_perubahan');
        $builder->select('tb_perubahan_judul.proposal as proposal');
        $builder->select('tb_perubahan_judul.bukti_pernyataan as bukti_pernyataan');
        $builder->select('tb_perubahan_judul.status_dosen as status_dosen');
        $builder->select('tb_perubahan_judul.status_prodi as status_prodi');
        $builder->select('tb_perubahan_judul.ket_prodi as ket_prodi');
        $builder->select('tb_perubahan_judul.ket_dosen as ket_dosen');
        $builder->select('tb_perubahan_judul.tgl_perubahan as tgl_perubahan');
        $builder->select('tb_perubahan_judul.studi_kasus as studi_kasus_baru');
        $builder->join('tb_proposal', 'tb_pengajuan.no_proposal = tb_proposal.no_proposal', 'left');
        $builder->join('tb_berkas', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->join('tb_perubahan_judul', 'tb_pengajuan.no_perubahan = tb_perubahan_judul.no_perubahan', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('tb_pengajuan.jenis', $jenis);
        $status_perpanjang = ['Baru', 'Perpanjang', 'Selesai'];
        $builder->whereIn('tb_pengajuan.status_perpanjang', $status_perpanjang);
        return $builder->get();
    }

    public function getRekapPengajuan($jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('nama_dosen, tb_pengajuan.npm,nama_mahasiswa,tb_pengajuan.jenis,tb_pengajuan.status_perpanjang,tb_pengajuan.judul,nama_topik');
        $builder->join('tb_disposisi', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_dosen', 'tb_disposisi.nik = tb_dosen.nik', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_detail_topik', 'tb_pengajuan.kode_detail = tb_detail_topik.kode_detail', 'left');
        $builder->join('tb_topik', 'tb_topik.kode_topik = tb_detail_topik.kode_topik', 'left');
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->where('tb_pengajuan.status_pengajuan', 'ACC');
        $builder->orderBy('nama_dosen', 'ASC');
        $builder->orderBy('tb_pengajuan.jenis', 'DESC');
        $builder->orderBy('status_perpanjang', 'ASC');
        return $builder->get();
    }

    public function getAccPengajuan($jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_berkas', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->join('tb_nilai', 'tb_pengajuan.no_nilai = tb_nilai.no_nilai', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_detail_topik', 'tb_pengajuan.kode_detail = tb_detail_topik.kode_detail', 'left');
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->where('tb_pengajuan.status_perpanjang', 'Baru');
        return $builder->get();
    }

    public function getReview($username, $jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_detail_review');
        $builder->select('*');
        $builder->join('tb_ploting_pembimbing', 'tb_detail_review.no_ploting_pembimbing = tb_ploting_pembimbing.no_ploting_pembimbing', 'left');
        $builder->join('tb_pengajuan', 'tb_ploting_pembimbing.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_dosen', 'tb_ploting_pembimbing.nik = tb_dosen.nik', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->where('tb_detail_review.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_detail_review.semester', $semester);
        return $builder->get();
    }
    public function getReview2($username, $jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_detail_review');
        $builder->select('*');
        $builder->join('tb_ploting_reviewer', 'tb_detail_review.no_ploting_reviewer = tb_ploting_reviewer.no_ploting_reviewer', 'left');
        $builder->join('tb_pengajuan', 'tb_ploting_reviewer.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_dosen', 'tb_ploting_reviewer.nik = tb_dosen.nik', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->where('tb_detail_review.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_detail_review.semester', $semester);
        return $builder->get();
    }

    public function getDisposisi($username, $jenis)
    {
        $builder = $this->db->table('tb_disposisi');
        $builder->select('nama_dosen, no_disposisi, tb_disposisi.jenis, link_kp, link_ta');
        $builder->join('tb_pengajuan', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_dosen', 'tb_disposisi.nik = tb_dosen.nik', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->where('status_disposisi', 'Disposisi');
        $builder->where('tb_pengajuan.status_perpanjang', 'Baru');
        return $builder->get();
    }

    public function getAll()
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        return $builder->get();
    }

    public function updateAll($data, $no_pengajuan)
    {
        $query = $this->db->table('tb_pengajuan')->update($data, array('no_pengajuan' => $no_pengajuan));
        return $query;
    }

    public function deletePengajuan($no_pengajuan)
    {
        $query = $this->db->table('tb_pengajuan')->delete(array('no_pengajuan' => $no_pengajuan));
        return $query;
    }

    public function deleteBerkas($no_berkas)
    {
        $query = $this->db->table('tb_berkas')->delete(array('no_berkas' => $no_berkas));
        return $query;
    }

    public function deleteProposal($no_proposal)
    {
        $query = $this->db->table('tb_proposal')->delete(array('no_proposal' => $no_proposal));
        return $query;
    }
    public function deleteNilai($no_nilai)
    {
        $query = $this->db->table('tb_nilai')->delete(array('no_nilai' => $no_nilai));
        return $query;
    }

    public function findOne($npm, $jenis)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->where('tb_pengajuan.npm', $npm);
        $builder->where('tb_pengajuan.jenis', $jenis);
        $status_perpanjang = ['Baru', 'Perpanjang', 'Selesai'];
        $builder->whereIn('tb_pengajuan.status_perpanjang', $status_perpanjang);
        return $builder->get();
    }
}
