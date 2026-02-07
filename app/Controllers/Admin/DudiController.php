<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DudiModel;

class DudiController extends BaseController
{
    protected $dudiModel;

    public function __construct()
    {
        $this->dudiModel = new DudiModel();
    }

    public function index()
    {
        $data['dudi'] = $this->dudiModel->findAll();
        return view('admin/dudi/index', $data);
    }
}
