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
        $perPage = 5;

        $builder = $this->dudi
            ->select('
            dudi.*,
            COUNT(magang.id) as total_siswa_magang
        ')
            ->join('magang', 'magang.dudi_id = dudi.id', 'left')
            ->groupBy('dudi.id');

        $dudi  = $builder->paginate($perPage, 'dudi');
        $pager = $this->dudi->pager;

        $data = [
            'dudi'        => $dudi,
            'pager'       => $pager,
            'per_page'    => $perPage,
            'title'       => 'Manajemen DUDI',
            'totalDudi'   => $this->dudi->countAll(),
            'totalMagang' => $this->magang->countAll(),
        ];

        return view('guru/dudi/index', $data);
    }
}