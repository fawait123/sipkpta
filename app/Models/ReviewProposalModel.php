<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewProposalModel extends Model
{

    protected $table = 'tb_detail_review';
    protected $primaryKey = 'no_detail_review';
    protected $allowedFields = ['no_detail_review', 'no_ploting_pembimbing', 'no_ploting_reviewer', 'review', 'jenis', 'status_review', 'jenis', 'tahun_ajaran', 'semester'];

    public function getTanggalReview()
    {
        $builder = $this->db->table('tanggal_review');
        $builder->select('*');
        $builder->where('title', 'Tanggal Review Proposal');
        return $builder->get();
    }

    function updateTanggal($data, $id)
    {
        $query = $this->db->table('tanggal_review')->update($data, array('id' => $id));
        return $query;
    }

    public function getReviewProposal($jenis, $tahun_ajaran, $semester, $username)
    {
        $builder = $this->db->table('tb_detail_review');
        $builder->select('*');
        $builder->join('tb_ploting_pembimbing', 'tb_detail_review.no_ploting_pembimbing = tb_ploting_pembimbing.no_ploting_pembimbing', 'left');
        $builder->join('tb_dosen', 'tb_ploting_pembimbing.nik = tb_dosen.nik', 'left');
        $builder->join('tb_pengajuan', 'tb_ploting_pembimbing.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_proposal', 'tb_pengajuan.no_proposal = tb_proposal.no_proposal', 'left');
        $builder->where('tb_ploting_pembimbing.nik', $username);
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->where('tb_pengajuan.status_pengajuan', 'ACC');
        $builder->where('tb_pengajuan.status_perpanjang', 'Baru');
        $builder->where('tb_ploting_pembimbing.status_ploting', 'Diploting');
        return $builder->get();
    }

    public function getReviewProposal2($jenis, $tahun_ajaran, $semester, $username)
    {
        $builder = $this->db->table('tb_detail_review');
        $builder->select('*');
        $builder->join('tb_ploting_reviewer', 'tb_detail_review.no_ploting_reviewer = tb_ploting_reviewer.no_ploting_reviewer', 'left');
        $builder->join('tb_dosen', 'tb_ploting_reviewer.nik = tb_dosen.nik', 'left');
        $builder->join('tb_pengajuan', 'tb_ploting_reviewer.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_proposal', 'tb_pengajuan.no_proposal = tb_proposal.no_proposal', 'left');
        $builder->where('tb_ploting_reviewer.nik', $username);
        $builder->where('tb_pengajuan.jenis', $jenis);
        $builder->where('tb_pengajuan.tahun_ajaran', $tahun_ajaran);
        $builder->where('tb_pengajuan.semester', $semester);
        $builder->where('tb_pengajuan.status_pengajuan', 'ACC');
        $builder->where('tb_pengajuan.status_perpanjang', 'Baru');
        $builder->where('tb_ploting_reviewer.status_ploting', 'Diploting');
        return $builder->get();
    }

    public function getReviewProposal3($no_detail_review)
    {
        $builder = $this->db->table('tb_detail_review');
        $builder->select('*');
        $builder->join('tb_ploting_pembimbing', 'tb_detail_review.no_ploting_pembimbing = tb_ploting_pembimbing.no_ploting_pembimbing', 'left');
        $builder->join('tb_dosen', 'tb_ploting_pembimbing.nik = tb_dosen.nik', 'left');
        $builder->join('tb_pengajuan', 'tb_ploting_pembimbing.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_proposal', 'tb_pengajuan.no_proposal = tb_proposal.no_proposal', 'left');
        $builder->where('tb_detail_review.no_detail_review', $no_detail_review);
        return $builder->get();
    }

    public function getReviewProposal4($no_detail_review)
    {
        $builder = $this->db->table('tb_detail_review');
        $builder->select('*');
        $builder->join('tb_ploting_reviewer', 'tb_detail_review.no_ploting_reviewer = tb_ploting_reviewer.no_ploting_reviewer', 'left');
        $builder->join('tb_dosen', 'tb_ploting_reviewer.nik = tb_dosen.nik', 'left');
        $builder->join('tb_pengajuan', 'tb_ploting_reviewer.no_pengajuan = tb_pengajuan.no_pengajuan', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->join('tb_proposal', 'tb_pengajuan.no_proposal = tb_proposal.no_proposal', 'left');
        $builder->where('tb_detail_review.no_detail_review', $no_detail_review);
        return $builder->get();
    }

    function updateReview($data, $no_detail_review)
    {
        $query = $this->db->table('tb_detail_review')->update($data, array('no_detail_review' => $no_detail_review));
        return $query;
    }
}
