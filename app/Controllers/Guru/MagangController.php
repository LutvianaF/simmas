<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MagangController extends BaseController
{
    public function index()
    {
        return view('guru/magang/index');
    }
}
