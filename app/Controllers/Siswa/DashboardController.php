<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SiswaModel;

class DashboardController extends BaseController
{
    protected $siswa;

    public function __construct()
    {
        $this->siswa = new SiswaModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        $siswa = $this->siswa
            ->where('user_id', $userId)
            ->first();

        return view('siswa/dashboard/index', [
            'namaSiswa' => $siswa['nama'] ?? 'Siswa'
        ]);
    }
}
