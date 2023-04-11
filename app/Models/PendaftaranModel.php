<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_pendaftaran';
    protected $primaryKey           = 'kd_pendaftaran';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'kd_pendaftaran',
        'no_pengajuan',
        'judul_pendaftaran',
        'npm',
        'nik',
        'tgl',
        'jenis',
        'berkas_krs',
        'berkas_pembayaran',
        'status',
        'tempat',
        'is_entry',
        'berkas_toefle',
        'berkas_rekomendasi',
        'berkas_sertifikat',
        'berkas_abstrak',
        'berkas_pustaka',
        'ukuran_toga',
        'note'
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

    public function countRow()
    {
        $bulder = $this->db->table($this->table);
        $bulder->get();
        return $bulder->countAllResults();
    }

    public function search($username = null, $jenis, $status = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('tb_dosen.*');
        $builder->select('tb_mahasiswa.*');
        $builder->select('tb_pendaftaran.*');
        $builder->select('tb_perubahan_judul.*');
        $builder->select('tb_pengajuan.judul as judul,tb_pengajuan.studi_kasus as studi_kasus');
        $builder->join('tb_mahasiswa', 'tb_pendaftaran.npm=tb_mahasiswa.npm', 'left');
        $builder->join('tb_dosen', 'tb_pendaftaran.nik=tb_dosen.nik', 'left');
        $builder->join('tb_pengajuan', 'tb_pengajuan.no_pengajuan=tb_pendaftaran.no_pengajuan', 'left');
        $builder->join('tb_perubahan_judul', 'tb_pengajuan.no_perubahan=tb_perubahan_judul.no_perubahan', 'left');
        if ($username != null) :
            if (session()->get('role') == "mahasiswa") :
                $builder->where('tb_pendaftaran.npm', $username);
            else :
                $builder->where('tb_pendaftaran.nik', $username);
            endif;
        endif;
        if ($status != null) :
            $builder->where('tb_pendaftaran.status', $status);
        endif;
        $builder->where('tb_pendaftaran.jenis', $jenis);
        $builder->orderBy('kd_pendaftaran','desc');
        return $builder->get();
    }

    public function getRow($kode)
    {
        $builder = $this->db->table($this->table);
        $builder->where('kd_pendaftaran',$kode);
        return $builder->get();
    }

    public function getId($no_pengajuan)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->join('tb_disposisi','tb_disposisi.no_pengajuan=tb_pengajuan.no_pengajuan','left');
        $builder->join('tb_ploting_pembimbing','tb_ploting_pembimbing.no_ploting_pembimbing = tb_disposisi.no_ploting_pembimbing','left');
        $builder->join('tb_dosen','tb_dosen.nik=tb_ploting_pembimbing.nik','left');
        $builder->join('tb_mahasiswa','tb_mahasiswa.npm=tb_pengajuan.npm','left');
        $builder->join('tb_perubahan_judul','tb_perubahan_judul.no_perubahan=tb_pengajuan.no_perubahan','left');
        $builder->where('tb_pengajuan.no_pengajuan',$no_pengajuan);
        return $builder->get();
    }

    public function getWithRelation($jenis=null,$status = null,$npm = null)
    {
        $builder = $this->db->table($this->table);
        $builder->join('tb_mahasiswa','tb_mahasiswa.npm=tb_pendaftaran.npm','left');
        if($jenis != null):
            $builder = $builder->where('tb_pendaftaran.jenis',$jenis);
        endif;
        if($status != null):
            $builder = $builder->where('tb_pendaftaran.status_pendaftaran',$status);
        endif;
        if($npm != null):
            $builder = $builder->where('tb_pendaftaran.npm',$npm);
        endif;
        return $builder->get();
    }
}
