<?php

namespace App\Models;

use CodeIgniter\Model;

class PlotingModel extends Model
{

    protected $table = 'tb_ploting_pembimbing';
    protected $primaryKey = 'no_ploting_pembimbing';
    protected $allowedFields = ['no_ploting_pembimbing', 'nik', 'no_pengajuan', 'no_plkoting_reviewer'];

    public function autoCodePembimbing()
    {
        $builder = $this->db->table('tb_ploting_pembimbing');
        $builder->selectCount('no_ploting_pembimbing');
        return $builder->get();
    }

    public function autoCodeReviewer()
    {
        $builder = $this->db->table('tb_ploting_reviewer');
        $builder->selectCount('no_ploting_reviewer');
        return $builder->get();
    }

    public function autoCodeDisposisi()
    {
        $builder = $this->db->table('tb_disposisi');
        $builder->selectCount('no_disposisi');
        return $builder->get();
    }

    public function autoCodeReview()
    {
        $builder = $this->db->table('tb_detail_review');
        $builder->selectCount('no_detail_review');
        return $builder->get();
    }

    public function getPembimbing($no_pengajuan)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('nama_dosen');
        $builder->join('tb_dosen', 'tb_pengajuan.nik = tb_dosen.nik', 'left');
        $builder->where('no_pengajuan', $no_pengajuan);
        return $builder->get();
    }

    public function getReviewer($no_pengajuan)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('nama_dosen');
        $builder->join('tb_dosen', 'tb_pengajuan.nik = tb_dosen.nik', 'left');
        $builder->where('no_pengajuan', $no_pengajuan);
        return $builder->get();
    }

    public function getTopik()
    {
        $builder = $this->db->table('tb_topik');
        return $builder->get();
    }

    public function savePembimbing($data2)
    {
        $query = $this->db->table('tb_ploting_pembimbing')->insert($data2);
        return $query;
    }

    public function saveReviewer($data3)
    {
        $query = $this->db->table('tb_ploting_reviewer')->insert($data3);
        return $query;
    }

    public function saveDisposisi($data4)
    {
        $query = $this->db->table('tb_disposisi')->insert($data4);
        return $query;
    }

    public function saveReview($data5)
    {
        $query = $this->db->table('tb_detail_review')->insert($data5);
        return $query;
    }

    public function saveReview2($data6)
    {
        $query = $this->db->table('tb_detail_review')->insert($data6);
        return $query;
    }

    public function deletePembimbing($no_pengajuan)
    {
        $query = $this->db->table('tb_ploting_pembimbing')->delete(array('no_pengajuan' => $no_pengajuan));
        return $query;
    }

    public function deleteReviewer($no_pengajuan)
    {
        $query = $this->db->table('tb_ploting_reviewer')->delete(array('no_pengajuan' => $no_pengajuan));
        return $query;
    }

    public function deleteDisposisi($no_pengajuan)
    {
        $query = $this->db->table('tb_disposisi')->delete(array('no_pengajuan' => $no_pengajuan));
        return $query;
    }

    public function deleteReview($no_pengajuan)
    {
        $query = $this->db->table('tb_detail_review')->delete(array('no_pengajuan' => $no_pengajuan));
        return $query;
    }

    public function getPloting($jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.no_pengajuan, tb_pengajuan.npm, nama_mahasiswa, judul, nama_topik, s1.nama_dosen as nama_dosen, tb_pengajuan.kode_detail, tb_ploting_pembimbing.no_ploting_pembimbing, tb_ploting_reviewer.no_ploting_reviewer, s2.nama_dosen as nama_pembimbing, s3.nama_dosen as nama_reviewer, no_disposisi, tb_ploting_pembimbing.status_ploting as status_ploting, r1.status_review as status_review, r2.status_review as status_review2');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_detail_topik', 'tb_pengajuan.kode_detail = tb_detail_topik.kode_detail', 'left');
        $builder->join('tb_topik', 'tb_detail_topik.kode_topik = tb_topik.kode_topik', 'left');
        $builder->join('tb_ploting_pembimbing', 'tb_pengajuan.no_pengajuan = tb_ploting_pembimbing.no_pengajuan', 'left');
        $builder->join('tb_ploting_reviewer', 'tb_pengajuan.no_pengajuan = tb_ploting_reviewer.no_pengajuan', 'left');
        $builder->join('tb_detail_review r1', 'r1.no_ploting_pembimbing = tb_ploting_pembimbing.no_ploting_pembimbing', 'left');
        $builder->join('tb_detail_review r2', 'r2.no_ploting_reviewer = tb_ploting_reviewer.no_ploting_reviewer', 'left');
        $builder->join('tb_disposisi', 'tb_pengajuan.no_pengajuan = tb_disposisi.no_pengajuan', 'left');
        $builder->join('tb_dosen s1', 'tb_detail_topik.nik = s1.nik', 'left');
        $builder->join('tb_dosen s2', 'tb_ploting_pembimbing.nik = s2.nik', 'left');
        $builder->join('tb_dosen s3', 'tb_ploting_reviewer.nik = s3.nik', 'left');
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->where('tb_pengajuan.status_pengajuan', 'ACC');
        $builder->where('tb_pengajuan.status_perpanjang', 'Baru');
        return $builder->get();
    }

    public function getJumlahPembimbing($jenis, $tahun_ajaran, $semester)
    {
        $db = db_connect();
        $query =  $db->query("SELECT tb_dosen.nik, nama_dosen, jumlah_bimbingan, jumlah_review FROM tb_dosen LEFT JOIN (
            SELECT tb_dosen.nik, COUNT(tb_ploting_pembimbing.nik) AS jumlah_bimbingan FROM tb_dosen LEFT JOIN tb_ploting_pembimbing ON 
            tb_dosen.nik=tb_ploting_pembimbing.nik WHERE jenis='$jenis' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb1 ON tb_dosen.nik =tb1.nik LEFT JOIN 
            (SELECT tb_dosen.nik, COUNT(tb_ploting_reviewer.nik) AS jumlah_review FROM tb_dosen LEFT JOIN tb_ploting_reviewer ON 
            tb_dosen.nik=tb_ploting_reviewer.nik WHERE jenis='$jenis' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb2 ON tb_dosen.nik =tb2.nik ORDER BY nama_dosen ASC");
        return $query;
    }

    public function getRekapPloting($tahun_ajaran, $semester)
    {
        $db = db_connect();
        $query =  $db->query("SELECT tb_dosen.nik, nama_dosen, jumlah_bimbingan_kp, jumlah_review_kp, jumlah_bimbingan_ta, jumlah_review_ta FROM tb_dosen LEFT JOIN (
            SELECT tb_dosen.nik, COUNT(tb_ploting_pembimbing.nik) AS jumlah_bimbingan_kp FROM tb_dosen LEFT JOIN tb_ploting_pembimbing ON 
            tb_dosen.nik=tb_ploting_pembimbing.nik WHERE status_ploting='Diploting' AND jenis='KP' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb1 ON tb_dosen.nik =tb1.nik LEFT JOIN 
            (SELECT tb_dosen.nik, COUNT(tb_ploting_reviewer.nik) AS jumlah_review_kp FROM tb_dosen LEFT JOIN tb_ploting_reviewer ON 
            tb_dosen.nik=tb_ploting_reviewer.nik WHERE status_ploting='Diploting' AND jenis='KP' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb2 ON tb_dosen.nik =tb2.nik LEFT JOIN (
            SELECT tb_dosen.nik, COUNT(tb_ploting_pembimbing.nik) AS jumlah_bimbingan_ta FROM tb_dosen LEFT JOIN tb_ploting_pembimbing ON 
            tb_dosen.nik=tb_ploting_pembimbing.nik WHERE status_ploting='Diploting' AND jenis='TA' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb3 ON tb_dosen.nik =tb3.nik LEFT JOIN 
            (SELECT tb_dosen.nik, COUNT(tb_ploting_reviewer.nik) AS jumlah_review_ta FROM tb_dosen LEFT JOIN tb_ploting_reviewer ON 
            tb_dosen.nik=tb_ploting_reviewer.nik WHERE status_ploting='Diploting' AND jenis='TA' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb4 ON tb_dosen.nik =tb4.nik ORDER BY nama_dosen ASC");
        return $query;
    }

    public function getRekapPloting2($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('tb_pengajuan.npm, nama_mahasiswa, judul, tb_pengajuan.jenis, nama_topik, s1.nama_dosen as nama_dosen, s2.nama_dosen as nama_pembimbing, s3.nama_dosen as nama_reviewer');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_detail_topik', 'tb_pengajuan.kode_detail = tb_detail_topik.kode_detail', 'left');
        $builder->join('tb_topik', 'tb_detail_topik.kode_topik = tb_topik.kode_topik', 'left');
        $builder->join('tb_ploting_pembimbing', 'tb_pengajuan.no_pengajuan = tb_ploting_pembimbing.no_pengajuan', 'left');
        $builder->join('tb_ploting_reviewer', 'tb_pengajuan.no_pengajuan = tb_ploting_reviewer.no_pengajuan', 'left');
        $builder->join('tb_detail_review r1', 'r1.no_ploting_pembimbing = tb_ploting_pembimbing.no_ploting_pembimbing', 'left');
        $builder->join('tb_detail_review r2', 'r2.no_ploting_reviewer = tb_ploting_reviewer.no_ploting_reviewer', 'left');
        $builder->join('tb_disposisi', 'tb_pengajuan.no_pengajuan = tb_disposisi.no_pengajuan', 'left');
        $builder->join('tb_dosen s1', 'tb_detail_topik.nik = s1.nik', 'left');
        $builder->join('tb_dosen s2', 'tb_ploting_pembimbing.nik = s2.nik', 'left');
        $builder->join('tb_dosen s3', 'tb_ploting_reviewer.nik = s3.nik', 'left');
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->where('tb_pengajuan.status_pengajuan', 'ACC');
        $builder->where('tb_pengajuan.status_perpanjang', 'Baru');
        return $builder->get();
    }

    // public function getRekapPloting3($tahun_ajaran, $semester)
    // {
    //     $union = $this->db->table('tb_pengajuan')
    //     ->select('nama_dosen, tb_pengajuan.npm, nama_mahasiswa, tb_pengajuan.jenis, tb_pengajuan.judul')
    //     ->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left')
    //     ->join('tb_ploting_pembimbing', 'tb_pengajuan.no_pengajuan = tb_ploting_pembimbing.no_pengajuan', 'left')
    //     ->join('tb_dosen', 'tb_ploting_pembimbing.nik = tb_dosen.nik', 'left')
    //     ->where('tb_ploting_pembimbing.tahun_ajaran', $tahun_ajaran)
    //     ->where('tb_ploting_pembimbing.semester', $semester)
    //     ->where('tb_pengajuan.status_pengajuan', 'ACC')
    //     ->where('tb_pengajuan.status_perpanjang', 'Baru');
    // $builder = $this->db->table('tb_pengajuan')
    //     ->select('nama_dosen, tb_pengajuan.npm, nama_mahasiswa, tb_pengajuan.jenis, tb_pengajuan.judul')
    //     ->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left')
    //     ->join('tb_ploting_reviewer', 'tb_pengajuan.no_pengajuan = tb_ploting_reviewer.no_pengajuan', 'left')
    //     ->join('tb_dosen', 'tb_ploting_reviewer.nik = tb_dosen.nik', 'left')
    //     ->where('tb_ploting_reviewer.tahun_ajaran', $tahun_ajaran)
    //     ->where('tb_ploting_reviewer.semester', $semester)
    //     ->where('tb_pengajuan.status_pengajuan', 'ACC')
    //     ->where('tb_pengajuan.status_perpanjang', 'Baru');
    // return $builder->get();
    // }

    public function updatePembimbing($data, $no_ploting_pembimbing)
    {
        $query = $this->db->table('tb_ploting_pembimbing')->update($data, array('no_ploting_pembimbing' => $no_ploting_pembimbing));
        return $query;
    }

    public function updateReviewer($data2, $no_ploting_reviewer)
    {
        $query = $this->db->table('tb_ploting_reviewer')->update($data2, array('no_ploting_reviewer' => $no_ploting_reviewer));
        return $query;
    }
}
