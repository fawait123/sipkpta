<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiModel extends Model
{

    protected $table = 'tb_ploting_pembimbing';
    protected $primaryKey = 'no_ploting_pembimbing';
    protected $allowedFields = ['no_ploting_pembimbing', 'nik', 'no_pengajuan', 'no_plkoting_reviewer'];

    public function getDisposisi($jenis, $tahun_ajaran, $semester)
    {
        $db = db_connect();
        $query =  $db->query("SELECT no_disposisi, tb_pengajuan.npm, nama_mahasiswa, s1.nama_dosen AS nama_dosen, tb_disposisi.no_ploting_pembimbing, 
        s2.nama_dosen AS nama_pembimbing, status_disposisi, jumlah_bimbingan
        FROM tb_disposisi LEFT JOIN tb_pengajuan ON tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan
        LEFT JOIN tb_mahasiswa ON tb_pengajuan.npm = tb_mahasiswa.npm
        LEFT JOIN tb_detail_topik ON tb_pengajuan.kode_detail = tb_detail_topik.kode_detail
        LEFT JOIN tb_dosen s1 ON tb_detail_topik.nik = s1.nik
        LEFT JOIN tb_dosen s2 ON tb_disposisi.nik = s2.nik 
        LEFT JOIN (SELECT tb_dosen.nik, COUNT(tb_disposisi.nik) AS jumlah_bimbingan FROM tb_dosen LEFT JOIN tb_disposisi ON 
        tb_dosen.nik=tb_disposisi.nik WHERE jenis='$jenis' AND tb_disposisi.tahun_ajaran='$tahun_ajaran' AND 
        tb_disposisi.semester='$semester' GROUP BY nik) AS tb1 ON s2.nik =tb1.nik
        WHERE tb_disposisi.jenis='$jenis' AND tb_disposisi.tahun_ajaran='$tahun_ajaran' AND tb_disposisi.semester='$semester' AND tb_pengajuan.status_perpanjang='Baru'");
        return $query;
    }

    public function getDisposisi2($username, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_disposisi');
        $builder->select('no_disposisi, tb_pengajuan.npm, nama_mahasiswa, judul,tb_disposisi.no_ploting_pembimbing, nama_dosen, status_disposisi, tb_pengajuan.jenis as jenis, status_perpanjang');
        $builder->join('tb_pengajuan', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_dosen', 'tb_disposisi.nik = tb_dosen.nik', 'left');
        $builder->where('tb_disposisi.nik', $username);
        $builder->where('tb_disposisi.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_disposisi.semester', $semester);
        $builder->orderBy('jenis', 'DESC');
        $builder->orderBy('status_perpanjang', 'ASC');
        $builder->where('status_disposisi', 'Disposisi');
        return $builder->get();
    }

    public function getDisposisiPerpanjangKP($tahun_ajaran, $semester)
    {
        $db = db_connect();
        $query =  $db->query("SELECT no_disposisi, tb_pengajuan.npm, nama_mahasiswa, s1.nama_dosen AS nama_dosen, tb_disposisi.no_ploting_pembimbing, 
        s2.nama_dosen AS nama_pembimbing, status_disposisi, jumlah_bimbingan
        FROM tb_disposisi LEFT JOIN tb_pengajuan ON tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan
        LEFT JOIN tb_mahasiswa ON tb_pengajuan.npm = tb_mahasiswa.npm
        LEFT JOIN tb_detail_topik ON tb_pengajuan.kode_detail = tb_detail_topik.kode_detail
        LEFT JOIN tb_dosen s1 ON tb_detail_topik.nik = s1.nik
        LEFT JOIN tb_dosen s2 ON tb_disposisi.nik = s2.nik 
        LEFT JOIN (SELECT tb_dosen.nik, COUNT(tb_disposisi.nik) AS jumlah_bimbingan FROM tb_dosen LEFT JOIN tb_disposisi ON 
        tb_dosen.nik=tb_disposisi.nik WHERE jenis='KP' AND tb_disposisi.tahun_ajaran='$tahun_ajaran' AND 
        tb_disposisi.semester='$semester' GROUP BY nik) AS tb1 ON s2.nik =tb1.nik
        WHERE tb_disposisi.jenis='KP' AND tb_disposisi.tahun_ajaran='$tahun_ajaran' AND tb_disposisi.semester='$semester' AND tb_pengajuan.status_perpanjang='Perpanjang'");
        return $query;
    }

    public function getDisposisiPerpanjangTA($tahun_ajaran, $semester)
    {
        $db = db_connect();
        $query =  $db->query("SELECT no_disposisi, tb_pengajuan.npm, nama_mahasiswa, s1.nama_dosen AS nama_dosen, tb_disposisi.no_ploting_pembimbing, 
        s2.nama_dosen AS nama_pembimbing, status_disposisi, jumlah_bimbingan
        FROM tb_disposisi LEFT JOIN tb_pengajuan ON tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan
        LEFT JOIN tb_mahasiswa ON tb_pengajuan.npm = tb_mahasiswa.npm
        LEFT JOIN tb_detail_topik ON tb_pengajuan.kode_detail = tb_detail_topik.kode_detail
        LEFT JOIN tb_dosen s1 ON tb_detail_topik.nik = s1.nik
        LEFT JOIN tb_dosen s2 ON tb_disposisi.nik = s2.nik 
        LEFT JOIN (SELECT tb_dosen.nik, COUNT(tb_disposisi.nik) AS jumlah_bimbingan FROM tb_dosen LEFT JOIN tb_disposisi ON 
        tb_dosen.nik=tb_disposisi.nik WHERE jenis='TA' AND tb_disposisi.tahun_ajaran='$tahun_ajaran' AND 
        tb_disposisi.semester='$semester' GROUP BY nik) AS tb1 ON s2.nik =tb1.nik
        WHERE tb_disposisi.jenis='TA' AND tb_disposisi.tahun_ajaran='$tahun_ajaran' AND tb_disposisi.semester='$semester' AND tb_pengajuan.status_perpanjang='Perpanjang'");
        return $query;
    }

    public function getDisposisi3($no_disposisi)
    {
        $builder = $this->db->table('tb_disposisi');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_dosen', 'tb_disposisi.nik = tb_dosen.nik', 'left');
        $builder->where('tb_disposisi.no_disposisi', $no_disposisi);
        return $builder->get();
    }

    public function getDisposisi4($tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_disposisi');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_dosen', 'tb_disposisi.nik = tb_dosen.nik', 'left');
        $builder->where('status_disposisi', 'Disposisi');
        $builder->where('tb_disposisi.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_disposisi.semester', $semester);
        $builder->orderBy('tb_pengajuan.jenis', 'DESC');
        $builder->orderBy('status_perpanjang', 'ASC');
        $builder->orderBy('nama_dosen', 'ASC');
        return $builder->get();
    }

    public function getJumlahPembimbing($tahun_ajaran, $semester)
    {
        $db = db_connect();
        $query =  $db->query("SELECT tb_dosen.nik, nama_dosen, jumlah_bimbingan, jumlah_bimbingan2 FROM tb_dosen LEFT JOIN (
            SELECT tb_disposisi.nik, COUNT(tb_disposisi.nik) AS jumlah_bimbingan FROM tb_disposisi LEFT JOIN tb_dosen ON 
            tb_dosen.nik=tb_disposisi.nik WHERE jenis='KP' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb1 ON tb_dosen.nik =tb1.nik LEFT JOIN 
            (SELECT tb_disposisi.nik, COUNT(tb_disposisi.nik) AS jumlah_bimbingan2 FROM tb_disposisi LEFT JOIN tb_dosen ON 
            tb_dosen.nik=tb_disposisi.nik WHERE jenis='TA' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb2 ON tb_dosen.nik =tb2.nik ORDER BY nama_dosen ASC");
        return $query;
    }

    public function getRekapPembimbing($tahun_ajaran, $semester)
    {
        $db = db_connect();
        $query =  $db->query("SELECT tb_dosen.nik, nama_dosen, jumlah_bimbingan, jumlah_bimbingan2, jumlah_bimbingan3 FROM tb_dosen LEFT JOIN (
            SELECT tb_disposisi.nik, COUNT(tb_disposisi.nik) AS jumlah_bimbingan FROM tb_disposisi LEFT JOIN tb_dosen ON 
            tb_dosen.nik=tb_disposisi.nik WHERE status_disposisi='Disposisi' AND jenis='KP' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb1 ON tb_dosen.nik =tb1.nik LEFT JOIN 
            (SELECT tb_disposisi.nik, COUNT(tb_disposisi.nik) AS jumlah_bimbingan2 FROM tb_disposisi LEFT JOIN tb_dosen ON 
            tb_dosen.nik=tb_disposisi.nik WHERE status_disposisi='Disposisi' AND jenis='TA' AND 
        tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb2 ON tb_dosen.nik =tb2.nik LEFT JOIN (
            SELECT tb_disposisi.nik, COUNT(tb_disposisi.nik) AS jumlah_bimbingan3 FROM tb_disposisi LEFT JOIN tb_dosen ON 
            tb_dosen.nik=tb_disposisi.nik WHERE status_disposisi='Disposisi' AND tahun_ajaran='$tahun_ajaran' AND semester='$semester' GROUP BY nik) AS tb3 ON 
            tb_dosen.nik =tb3.nik ORDER BY nama_dosen ASC");
        return $query;
    }

    public function updatePembimbing($data, $no_ploting_pembimbing)
    {
        $query = $this->db->table('tb_ploting_pembimbing')->update($data, array('no_ploting_pembimbing' => $no_ploting_pembimbing));
        return $query;
    }

    public function updateDisposisi($data, $no_disposisi)
    {
        $query = $this->db->table('tb_disposisi')->update($data, array('no_disposisi' => $no_disposisi));
        return $query;
    }

    public function updateDisposisiAll($data, $semester, $tahun_ajaran, $jenis)
    {
        $query = $this->db->table('tb_disposisi')->update($data, array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran, 'jenis' => $jenis));
        return $query;
    }
}
