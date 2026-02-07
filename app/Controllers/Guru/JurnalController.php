<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class JurnalController extends BaseController
{
    public function index()
    {
        return view('guru/jurnal/index');
    }
}
