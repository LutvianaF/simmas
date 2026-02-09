<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SiswaModel;
use App\Models\DudiModel;
use App\Models\MagangModel;
use App\Models\LogbookModel;

class DashboardController extends BaseController
{
    protected $siswaModel;
    protected $dudiModel;
    protected $magangModel;
    protected $logbookModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->dudiModel = new DudiModel();
        $this->magangModel = new MagangModel();
        $this->logbookModel = new LogbookModel();
    }

    public function index()
    {
        $data = [
            'totalSiswa'   => $this->siswaModel->countAllResults(),
            'totalDudi'    => $this->dudiModel->countAllResults(),
            'totalMagang'  => $this->magangModel->countAllResults(),
            'totalLogbook' => $this->logbookModel->countAllResults(),
        ];

        $data['magangTerbaru'] = $this->magangModel
            ->select('magang.*, siswa.nama as nama_siswa, dudi.nama_perusahaan')
            ->join('siswa', 'siswa.id = magang.siswa_id')
            ->join('dudi', 'dudi.id = magang.dudi_id')
            ->orderBy('magang.id', 'DESC')
            ->limit(2)
            ->findAll();

        $data['dudiAktif'] = $this->dudiModel
            ->where('status', 'aktif')
            ->findAll();

        $data['logbookTerbaru'] = $this->logbookModel
            ->select('logbook.*, magang.id as magang_id')
            ->join('magang', 'magang.id = logbook.magang_id')
            ->orderBy('logbook.tanggal', 'DESC')
            ->limit(3)
            ->findAll();

        return view('guru/dashboard/index', $data);
    }
}
