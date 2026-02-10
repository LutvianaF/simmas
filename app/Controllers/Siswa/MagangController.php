<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use Config\Database;
use App\Models\MagangModel;

class MagangController extends BaseController
{
    protected $magang;

    public function __construct()
    {
        $this->magang  = new MagangModel();
    }
    
    public function index()
    {
        $db = Database::connect();

        // ambil data siswa dari user login
        $siswa = $db->table('siswa')
            ->where('user_id', session()->get('user_id'))
            ->get()
            ->getRowArray();

        if (!$siswa) {
            dd('DATA SISWA TIDAK DITEMUKAN');
        }

        // ambil data magang siswa + relasi
        $magang = $db->table('magang')
            ->select('
                magang.*,
                siswa.nama,
                siswa.nis,
                siswa.kelas,
                siswa.jurusan,
                dudi.nama_perusahaan,
                dudi.alamat
            ')
            ->join('siswa', 'siswa.id = magang.siswa_id')
            ->join('dudi', 'dudi.id = magang.dudi_id')
            ->where('magang.siswa_id', $siswa['id'])
            ->orderBy('magang.id', 'DESC')
            ->get()
            ->getRowArray();

        return view('siswa/magang/index', [
            'magang' => $magang
        ]);
    }
}
