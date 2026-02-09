<?php

namespace App\Controllers\Siswa;

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
        $userId = session()->get('user_id');
        $dudiList = $this->dudiModel->findAll();

        $daftarSiswa = [1, 3];

        return view('siswa/dudi/index', [
            'dudiList'   => $dudiList,
            'daftarSiswa' => $daftarSiswa
        ]);
    }
}
