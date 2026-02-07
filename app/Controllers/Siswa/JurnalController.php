<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class JurnalController extends BaseController
{
    public function index()
    {
        return view('siswa/jurnal/index');
    }
}
