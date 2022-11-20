<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendaftaranModel;
use App\Models\UjianModel;

class DownloadController extends BaseController
{
    public function beritaacara($no_pengajuan)
    {
        $model = new PendaftaranModel();
        $data['title'] = 'BERITA ACARA';
        $data['detail'] = $model->getId($no_pengajuan)->getRow();
        // dd($data['detail']);
        return view('download/berita_acara',$data);
    }

    public function lembarnilai($no_pengajuan)
    {
        $model = new PendaftaranModel();
        $data['title'] = 'LEMBAR NILAI';
        $data['detail'] = $model->getId($no_pengajuan)->getRow();
        return view('download/lembar_nilai',$data);
    }

    public function lembarnilaita($no_pengajuan)
    {
        $data['title'] = 'LEMBAR NILAI';
        $model = new PendaftaranModel();
        $builder = new UjianModel();
        $data['title'] = 'LEMBAR NILAI';
        $data['detail'] = $model->getId($no_pengajuan)->getRow();
        $pendaftaran = $builder->getId($no_pengajuan)->getRow();
        $ujian = $builder->get($pendaftaran->kd_pendaftaran)->getResult();
        $data['ujian'] = $ujian;
        return view('download/ta/lembar_nilai',$data);
    }

    public function lembarrevisi($no_pengajuan)
    {
        $model = new PendaftaranModel();
        $data['title'] = 'LEMBAR REVISI';
        $data['detail'] = $model->getId($no_pengajuan)->getRow();
        return view('download/lembar_revisi',$data);
    }

    public function lembarrevisita($no_pengajuan)
    {
        $model = new PendaftaranModel();
        $data['title'] = 'LEMBAR REVISI';
        $builder = new UjianModel();
        $data['detail'] = $model->getId($no_pengajuan)->getRow(); 
        $pendaftaran = $builder->getId($no_pengajuan)->getRow();
        $ujian = $builder->get($pendaftaran->kd_pendaftaran)->getResult();
        $data['ujian'] = $ujian;  
        return view('download/ta/lembar_revisi',$data);
    }
}
