<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SchoolSettingModel;

class PengaturanController extends BaseController
{
    protected $schoolSettingModel;

    public function __construct()
    {
        $this->schoolSettingModel = new SchoolSettingModel();
    }

    public function index()
    {
        $data['setting'] = $this->schoolSettingModel->findAll();
        return view('admin/pengaturan/index', $data);
    }
}
