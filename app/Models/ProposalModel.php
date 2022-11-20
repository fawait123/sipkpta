<?php

namespace App\Models;

use CodeIgniter\Model;

class ProposalModel extends Model
{
    protected $table = 'tb_proposal';
    protected $primaryKey = 'no_proposal';
    protected $allowedFields = ['no_proposal', 'proposal', 'status_proposal'];

    public function getProposal($jenis, $tahun_ajaran, $semester)
    {
        $builder = $this->db->table('tb_pengajuan');
        $builder->select('*');
        $builder->join('tb_proposal', 'tb_pengajuan.no_proposal = tb_proposal.no_proposal', 'left');
        $builder->join('tb_berkas', 'tb_pengajuan.no_berkas = tb_berkas.no_berkas', 'left');
        $builder->join('tb_mahasiswa', 'tb_pengajuan.npm = tb_mahasiswa.npm', 'left');
        $builder->where('jenis', $jenis);
        $builder->where('tahun_ajaran', $tahun_ajaran);
        $builder->where('semester', $semester);
        $builder->where('status_perpanjang', 'Baru');
        return $builder->get();
    }
}
