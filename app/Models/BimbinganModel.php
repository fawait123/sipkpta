<?php

namespace App\Models;

use CodeIgniter\Model;

class BimbinganModel extends Model
{

    protected $DBGroup              = 'default';
    protected $table                = 'tb_bimbingan';
    protected $primaryKey           = 'kd_bimbingan';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'kd_bimbingan',
        'npm',
        'nik',
        'tgl',
        'materi',
        'metode',
        'jenis',
        'keterangan',
        'file',
        'status',
        'updated_at',
        'drive_id'
    ];
    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];


    public function getDosbing($username, $jenis)
    {
        $builder = $this->db->table('tb_pengajuan');
        // $builder->select('tb_dosen.nik as nik');
        // $builder->select('tb_dosen.nama_dosen as nama_dosen');
        // $builder->join('tb_ploting_pembimbing', 'tb_ploting_pembimbing.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_disposisi', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_dosen', 'tb_disposisi.nik = tb_dosen.nik', 'left');
        $builder->where('tb_disposisi.status_disposisi', "Disposisi");
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('tb_disposisi.jenis', $jenis);
        $status_perpanjang = ['Baru', 'Perpanjang', 'Selesai'];
        $builder->whereIn('status_perpanjang', $status_perpanjang);
        return  $builder->get();
    }

    public function countBimbingan($username, $jenis)
    {
        $builder = $this->db->table($this->table);
        $builder->where('tb_bimbingan.npm', $username);
        $builder->where('tb_bimbingan.jenis', $jenis);
        $builder->where('tb_bimbingan.status', 'acc');
        return $builder->countAllResults();
    }

    public function countRow()
    {
        $bulder = $this->db->table('tb_bimbingan');
        $bulder->get();
        return $bulder->countAllResults();
    }

    public function get($username = null, $jenis, $npm = null, $nik = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('tb_mahasiswa', 'tb_bimbingan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_dosen', 'tb_bimbingan.nik = tb_dosen.nik', 'left');
        $builder->where('tb_bimbingan.jenis', $jenis);
        if ($npm != null) :
            $builder->where('tb_bimbingan.npm', $npm);
        endif;
        if ($nik != null) :
            $builder->where('tb_bimbingan.nik', $nik);
        endif;
        if ($username != null) :
            if (session()->get('role') == "mahasiswa") :
                $builder->where('tb_bimbingan.npm', $username);
            else :
                $builder->where('tb_bimbingan.nik', $username);
            endif;
        endif;
        $builder->orderBy('kd_bimbingan', 'desc');
        return $builder->get();
    }

    public function getPengajuan($username, $jenis)
    {
        $status_perpanjang = ['Baru','Perpanjang'];
        $builder = $this->db->table('tb_pengajuan');
        $builder->join('tb_disposisi', 'tb_pengajuan.no_pengajuan=tb_disposisi.no_pengajuan', 'left');
        $builder->where('tb_pengajuan.npm', $username);
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->whereIn('tb_pengajuan.status_perpanjang',$status_perpanjang);
        return $builder->get();
    }

    public function cekBimbingan($username, $jenis)
    {
        $builder = $this->db->table($this->table);
        $builder->where('npm', $username);
        $builder->where('jenis', $jenis);
        $builder->where('status', null);
        return $builder->get();
    }

    public function getMahasiswa($nik,$jenis=null)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->join('tb_ploting_pembimbing', 'tb_pengajuan.no_pengajuan=tb_ploting_pembimbing.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm=tb_mahasiswa.npm', 'left');
        $builder->where('tb_ploting_pembimbing.nik', $nik);
        return $builder->get();
    }

    public function getMahasiswa1($nik,$jenis=null)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->join('tb_ploting_pembimbing', 'tb_pengajuan.no_pengajuan=tb_ploting_pembimbing.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm=tb_mahasiswa.npm', 'left');
        $builder->where('tb_ploting_pembimbing.nik', $nik);
        if($jenis != null){
            $builder->where('tb_pengajuan.jenis',$jenis);
        }
        $status_perpanjang = ['Baru','Perpanjang'];
        $builder->whereIn('tb_pengajuan.status_perpanjang',$status_perpanjang);
        return $builder->get();
    }

    public function getField($value)
    {
        $builder = $this->db->table('tb_mahasiswa');
        $builder->where('npm', $value);
        return $builder->get();
    }

    public function countDataByUser($value)
    {
        $builder = $this->db->table('tb_bimbingan');
        $builder->where('npm', $value);
        return $builder->get();
    }

    public function getBimbingan($npm, $jenis, $order = null)
    {
        $builder = $this->db->table('tb_bimbingan');
        $builder->where('npm', $npm);
        $builder->where('jenis', $jenis);
        if ($order != null) {
            $builder->orderBy('kd_bimbingan', $order);
        }
        return $builder->get();
    }


    public function getDisposisi($npm, $jenis)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->join('tb_disposisi', 'tb_pengajuan.no_pengajuan=tb_disposisi.no_pengajuan', 'left');
        $status_perpanjang = ['Baru', 'Perpanjang', 'Selesai'];
        $builder->whereIn('tb_pengajuan.status_perpanjang', $status_perpanjang);
        $builder->where('tb_pengajuan.npm', $npm);
        $builder->where('tb_pengajuan.jenis', $jenis);
        return $builder->get();
    }

    public function getBimbingan2($nik)
    {
        $builder = $this->db->table('tb_bimbingan');
        $builder->join('tb_mahasiswa', 'tb_bimbingan.npm=tb_mahasiswa.npm', 'left');
        $builder->where('tb_bimbingan.status', 'tidak acc');
        return $builder->get();
    }
}
