<?php

namespace App\Models;

use CodeIgniter\Model;

class PerubahanJudulModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_perubahan_judul';
    protected $primaryKey           = 'no_perubahan';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'no_perubahan',
        'judul_perubahan',
        'proposal',
        'bukti_pernyataan',
        'status_dosen',
        'status_prodi',
        'ket_dosen',
        'ket_prodi',
        'studi_kasus',
        'tgl_perubahan',
        'status_mhs'
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

    public function get($role = null, $username = null, $jenis, $start,$end)
    {
        date_default_timezone_set('Asia/Jakarta');
        $builder = $this->db->table('tb_pengajuan');
        $builder->join('tb_perubahan_judul', 'tb_pengajuan.no_perubahan=tb_perubahan_judul.no_perubahan', 'left');
        $builder->join('tb_disposisi', 'tb_pengajuan.no_pengajuan=tb_disposisi.no_pengajuan', 'left');
        $builder->join('tb_ploting_pembimbing', 'tb_pengajuan.no_pengajuan=tb_ploting_pembimbing.no_pengajuan', 'left');
        $builder->join('tb_dosen', 'tb_ploting_pembimbing.nik=tb_dosen.nik', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm=tb_mahasiswa.npm', 'left');
        // $builder->join('tb_perubahan_judul', 'tb_pengajuan.no_perubahan=tb_perubahan_judul.no_perubahan', 'left');
        $builder->where('tb_pengajuan.no_perubahan !=', null);
        $status_perpanjang = ['Baru', 'Perpanjang', 'Selesai'];
        $builder->whereIn('tb_pengajuan.status_perpanjang', $status_perpanjang);
        if ($role != null) :
            if ($username != null) :
                $builder->where('tb_mahasiswa.npm', $username);
            endif;
        else :
            if ($username != null) :
                $builder->where('tb_ploting_pembimbing.nik', $username);
            endif;
        endif;
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->where('tb_perubahan_judul.tgl_perubahan >=',$start.' 00:00:01');
        $builder->where('tb_perubahan_judul.tgl_perubahan <=',$end.' 23:59:59');
        return $builder->get();
    }


    public function getJudulPerubahan($no_disposisi)
    {
        $builder = $this->db->table('tb_disposisi');
        $builder->select('*');
        $builder->join('tb_pengajuan', 'tb_disposisi.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_perubahan_judul', 'tb_pengajuan.no_perubahan = tb_perubahan_judul.no_perubahan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        // $builder->join('tb_ploting_pembimbing', 'tb_disposisi.no_ploting_pembimbing = tb_ploting_pembimbing.no_ploting_pembimbing', 'left');
        $builder->join('tb_dosen', 'tb_disposisi.nik = tb_dosen.nik', 'left');
        $builder->where('tb_disposisi.no_disposisi', $no_disposisi);
        return $builder->get();
    }
}
