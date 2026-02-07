<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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
            'totalSiswa' => $this->siswaModel->countAllResults(),
            'totalDudi' => $this->dudiModel->countAllResults(),
            'totalMagang' => $this->magangModel->countAllResults(),
            'totalLogbook' => $this->logbookModel->countAllResults(),
        ];

        return view('admin/dashboard/index', $data);
    }
}
