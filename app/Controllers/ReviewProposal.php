<?php

namespace App\Controllers;

use App\Libraries\Breadcrumb as LibrariesBreadcrumb;
use App\Models\AdminModel;
use App\Models\DisposisiModel;
use App\Models\NilaiModel;
use App\Models\DosenModel;
use App\Models\KaprodiModel;
use App\Models\MahasiswaModel;
use App\Models\PlotingModel;
use App\Models\ProposalModel;
use App\Models\ReviewProposalModel;
use App\Models\SekprodModel;

class ReviewProposal extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function tanggalReview()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Tanggal Review Proposal";
            $data['username'] = $session->get('username');
            $data['role'] = $session->get('role');
            $username = $data['username'];
            $role = $data['role'];
            if ($role == "admin") {
                $model = new AdminModel();
            } elseif ($role == "sekprod") {
                $model = new SekprodModel();
            } elseif ($role == "kaprodi") {
                $model = new KaprodiModel();
            } elseif ($role == "dosen") {
                $model = new DosenModel();
            } elseif ($role == "mahasiswa") {
                $model = new MahasiswaModel();
            }
            $data['user'] = $model->getUser($username)->getResult();
            $model2 = new ReviewProposalModel();
            $data['jenis'] = "KP";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tanggal'] = $model2->getTanggalReview()->getResult();
            echo view('tanggal_review', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    function updateTanggalReview()
    {
        $model = new ReviewProposalModel();
        $id = $this->request->getPost('id');
        if ($this->request->getPost('id')) {
            $data = [
                'start'    =>    $this->request->getPost('start'),
                'end'        =>    $this->request->getPost('end')
            ];
            $model->updateTanggal($data, $id);

            $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
            return redirect()->to('/ReviewProposal/TanggalReview');
        }
    }

    public function reviewKP()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Review Proposal";
            $data['username'] = $session->get('username');
            $data['role'] = $session->get('role');
            $username = $data['username'];
            $role = $data['role'];
            if ($role == "admin") {
                $model = new AdminModel();
            } elseif ($role == "sekprod") {
                $model = new SekprodModel();
            } elseif ($role == "kaprodi") {
                $model = new KaprodiModel();
            } elseif ($role == "dosen") {
                $model = new DosenModel();
            } elseif ($role == "mahasiswa") {
                $model = new MahasiswaModel();
            }
            $data['user'] = $model->getUser($username)->getResult();
            $model2 = new ReviewProposalModel();
            $data['jenis'] = "KP";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_review_proposal'] = $model2->getReviewProposal($jenis, $tahun_ajaran, $semester, $username)->getResult();
            $data['tb_review_proposal2'] = $model2->getReviewProposal2($jenis, $tahun_ajaran, $semester, $username)->getResult();
            $data['tanggal'] = $model2->getTanggalReview()->getResult();
            echo view('review_proposal', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function reviewTA()
    {
        if (session()->get('isLoggedIn')) :
            $bread = new LibrariesBreadcrumb();
            $data['breadcrumbs'] = $bread->buildAuto();
            $session = session();
            $data['title'] = "Review Proposal";
            $data['username'] = $session->get('username');
            $data['role'] = $session->get('role');
            $username = $data['username'];
            $role = $data['role'];
            if ($role == "admin") {
                $model = new AdminModel();
            } elseif ($role == "sekprod") {
                $model = new SekprodModel();
            } elseif ($role == "kaprodi") {
                $model = new KaprodiModel();
            } elseif ($role == "dosen") {
                $model = new DosenModel();
            } elseif ($role == "mahasiswa") {
                $model = new MahasiswaModel();
            }
            $data['user'] = $model->getUser($username)->getResult();
            $model2 = new ReviewProposalModel();
            $data['jenis'] = "TA";
            $jenis = $data['jenis'];
            $data['tahun_ajaran'] = $session->get('tahun_ajaran');
            $data['semester'] = $session->get('semester');
            $tahun_ajaran = $data['tahun_ajaran'];
            $semester = $data['semester'];
            $data['tb_review_proposal'] = $model2->getReviewProposal($jenis, $tahun_ajaran, $semester, $username)->getResult();
            $data['tb_review_proposal2'] = $model2->getReviewProposal2($jenis, $tahun_ajaran, $semester, $username)->getResult();
            $data['tanggal'] = $model2->getTanggalReview()->getResult();
            echo view('review_proposal', $data);
        else :
            return redirect()->to(site_url('Home'));
        endif;
    }

    public function downloadProposal($no_proposal, $username, $nama_mahasiswa)
    {
        $model = new ProposalModel();
        $data = $model->find($no_proposal);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["proposal"], null);
    }

    public function downloadReviewer()
    {
        $model = new ReviewProposalModel();
        $request = \Config\Services::request();
        $data['jenis2'] = $request->uri->getSegment(3);
        $no_detail_review = $request->uri->getSegment(4);
        $data['nama_mahasiswa'] = $request->uri->getSegment(5);
        $data['title'] = "LEMBAR REVIEW";
        if ($request->uri->getSegment(3) == "KP") {
            $data['jenis'] = "KERJA PRAKTIK (KP)";
            $data['tb_detail_review'] = $model->getReviewProposal3($no_detail_review)->getResult();
        } else {
            $data['jenis'] = "TUGAS AKHIR (TA)";
            $data['tb_detail_review'] = $model->getReviewProposal3($no_detail_review)->getResult();
        }
        echo view('download_review', $data);
    }

    public function downloadReviewer2()
    {
        $model = new ReviewProposalModel();
        $request = \Config\Services::request();
        $data['jenis2'] = $request->uri->getSegment(3);
        $no_detail_review = $request->uri->getSegment(4);
        $data['nama_mahasiswa'] = $request->uri->getSegment(5);
        $data['title'] = "LEMBAR REVIEW";
        if ($request->uri->getSegment(3) == "KP") {
            $data['jenis'] = "KERJA PRAKTIK (KP)";
            $data['tb_detail_review'] = $model->getReviewProposal4($no_detail_review)->getResult();
        } else {
            $data['tb_detail_review'] = $model->getReviewProposal4($no_detail_review)->getResult();
            $data['jenis'] = "TUGAS AKHIR (TA)";
        }
        echo view('download_review', $data);
    }

    public function downloadReviewKP()
    {
        $model = new ReviewProposalModel();
        $request = \Config\Services::request();
        $data['title'] = $request->uri->getSegment(3);
        $no_detail_review = $request->uri->getSegment(4);
        $data['nama_mahasiswa'] = $request->uri->getSegment(5);
        $data['jenis'] = "KERJA PRAKTIK (KP)";
        if ($request->uri->getSegment(3) == "LEMBAR%20REVIEW") {
            $data['tb_detail_review'] = $model->getReviewProposal3($no_detail_review)->getResult();
        } else {
            $data['tb_detail_review'] = $model->getReviewProposal4($no_detail_review)->getResult();
        }
        echo view('download_review', $data);
    }

    public function downloadReviewTA()
    {
        $model = new ReviewProposalModel();
        $request = \Config\Services::request();
        $data['title'] = $request->uri->getSegment(3);
        $no_detail_review = $request->uri->getSegment(4);
        $data['nama_mahasiswa'] = $request->uri->getSegment(5);
        $data['jenis'] = "TUGAS AKHIR (TA)";
        if ($request->uri->getSegment(3) == "LEMBAR%20REVIEW") {
            $data['tb_detail_review'] = $model->getReviewProposal3($no_detail_review)->getResult();
        } else {
            $data['tb_detail_review'] = $model->getReviewProposal4($no_detail_review)->getResult();
        }
        echo view('download_review', $data);
    }

    public function downloadReview2($no_detail_review, $username, $nama_mahasiswa)
    {
        $model = new ReviewProposalModel();
        $data = $model->find($no_detail_review);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["review"], null);
    }

    public function downloadProposal2($no_detail_review, $username, $nama_mahasiswa)
    {
        $model = new ReviewProposalModel();
        $data = $model->find($no_detail_review);
        return $this->response->download("uploads/$username $nama_mahasiswa/" . $data["proposal_review"], null);
    }

    public function update()
    {
        $model = new ReviewProposalModel();
        $no_detail_review = $this->request->getPost('no_detail_review');
        $username = $this->request->getPost('npm');
        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa');
        $nama_dosen = $this->request->getPost('nama_dosen');
        $jenis = $this->request->getPost('jenis');

        helper('filesystem'); // Load Helper File System

        $review = $this->request->getFile('review');
        $nama_review = "LEMBAR REVIEW $nama_mahasiswa - $nama_dosen.pdf";
        $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
        foreach ($map as $key) {
            if ($key == $nama_review) {
                unlink("uploads/$username $nama_mahasiswa/$nama_review");
            }
        }
        $review->move("uploads/$username $nama_mahasiswa/", $nama_review);

        $proposal_review21 = $this->request->getPost('proposal_review21');
        if (!empty($proposal_review21)) {
            $proposal_review = $this->request->getFile('proposal_review');
            if ($jenis == "TA") {
                $nama_proposal_review = $username . '_' . $nama_mahasiswa . '_PropTAReview.pdf';
            } else {
                $nama_proposal_review = $username . '_' . $nama_mahasiswa . '_PropKPReview.pdf';
            }
        } else {
            $nama_proposal_review = "";
        }

        $proposal_review21 = $this->request->getPost('proposal_review21');
        if (!empty($proposal_review21)) {
            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_proposal_review) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_proposal_review");
                }
            }
            $proposal_review->move("uploads/$username $nama_mahasiswa/", $nama_proposal_review);
        }

        $data = [
            'review'        => $nama_review,
            'proposal_review'        => $nama_proposal_review,
            'status_review'        => 'Sudah Direview',
        ];
        $model->updateReview($data, $no_detail_review);

        $jenis = $this->request->getPost('jenis');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/ReviewProposal/reviewKP');
        } else {
            return redirect()->to('/ReviewProposal/reviewTA');
        }
    }

    public function update2()
    {
        $model = new ReviewProposalModel();
        $no_detail_review = $this->request->getPost('no_detail_review2');
        $username = $this->request->getPost('npm2');
        $nama_mahasiswa = $this->request->getPost('nama_mahasiswa2');
        $nama_dosen = $this->request->getPost('nama_dosen2');
        $jenis = $this->request->getPost('jenis2');

        helper('filesystem'); // Load Helper File System

        $review = $this->request->getFile('review2');
        $nama_review = "LEMBAR REVIEW $nama_mahasiswa - $nama_dosen.pdf";
        $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
        foreach ($map as $key) {
            if ($key == $nama_review) {
                unlink("uploads/$username $nama_mahasiswa/$nama_review");
            }
        }
        $review->move("uploads/$username $nama_mahasiswa/", $nama_review);

        $proposal_review22 = $this->request->getPost('proposal_review22');
        if (!empty($proposal_review22)) {
            $proposal_review = $this->request->getFile('proposal_review2');
            if ($jenis == "TA") {
                $nama_proposal_review = $username . '_' . $nama_mahasiswa . '_PropTAReview.pdf';
            } else {
                $nama_proposal_review = $username . '_' . $nama_mahasiswa . '_PropKPReview.pdf';
            }
        } else {
            $nama_proposal_review = "";
        }

        $proposal_review22 = $this->request->getPost('proposal_review22');
        if (!empty($proposal_review22)) {
            $map = directory_map("uploads/$username $nama_mahasiswa/", false, true);
            foreach ($map as $key) {
                if ($key == $nama_proposal_review) {
                    unlink("uploads/$username $nama_mahasiswa/$nama_proposal_review");
                }
            }
            $proposal_review->move("uploads/$username $nama_mahasiswa/", $nama_proposal_review);
        }

        $data = [
            'review'        => $nama_review,
            'proposal_review'        => $nama_proposal_review,
            'status_review'        => 'Sudah Direview',
        ];
        $model->updateReview($data, $no_detail_review);

        $jenis = $this->request->getPost('jenis2');
        $this->session->setFlashdata('success', ['Data Berhasil Diubah']);
        if ($jenis == "KP") {
            return redirect()->to('/ReviewProposal/reviewKP');
        } else {
            return redirect()->to('/ReviewProposal/reviewTA');
        }
    }
}
