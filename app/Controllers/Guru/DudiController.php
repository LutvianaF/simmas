<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DudiModel;
use App\Models\MagangModel;

class DudiController extends BaseController
{
    protected $dudi;
    protected $magang;

    public function __construct()
    {
        $this->dudi = new DudiModel();
        $this->magang = new MagangModel();
    }

    public function index()
    {
        $data = [
            'title'         => 'Manajemen DUDI',
            'totalDudi'     => $this->dudi->countAllResults(),
            'totalMagang'   => $this->magang->countAllResults(),
            'dudi'          => $this->dudi->findAll(),
        ];

        $data['dudi'] = $this->dudi
            ->select('
            dudi.*,
            COUNT(magang.id) as total_siswa_magang
        ')
            ->join('magang', 'magang.dudi_id = dudi.id', 'left')
            ->groupBy('dudi.id')
            ->findAll();

        return view('guru/dudi/index', $data);
    }
}