<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DudiController extends BaseController
{
    public function index()
    {
        return view('guru/dudi/index');
    }
}
