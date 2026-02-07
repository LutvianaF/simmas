<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MagangController extends BaseController
{
    public function index()
    {
        return view('siswa/magang/index');
    }
}
