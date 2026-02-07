<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DudiController extends BaseController
{
    public function index()
    {
        return view('siswa/dudi/index');
    }
}
