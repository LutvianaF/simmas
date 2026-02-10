<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\LogbookModel;
use App\Models\MagangModel;
use Config\Database;

class JurnalController extends BaseController
{
    protected $logbook;
    protected $magang;

    public function __construct()
    {
        $this->logbook = new LogbookModel();
        $this->magang  = new MagangModel();
    }

    public function index()
    {
        $db = Database::connect();
        
        $siswa = $db->table('siswa')
            ->where('user_id', session()->get('user_id'))
            ->get()
            ->getRowArray();

        if (!$siswa) {
            dd('DATA SISWA TIDAK DITEMUKAN');
        }

        $logbook = $this->logbook
            ->select('logbook.*')
            ->join('magang', 'magang.id = logbook.magang_id')
            ->where('magang.siswa_id', $siswa['id'])
            ->orderBy('logbook.tanggal', 'DESC')
            ->findAll();

        $statistik = [
            'total'     => count($logbook),
            'disetujui' => count(array_filter($logbook, fn($l) => $l['status_verifikasi'] === 'disetujui')),
            'pending'   => count(array_filter($logbook, fn($l) => $l['status_verifikasi'] === 'pending')),
            'ditolak'   => count(array_filter($logbook, fn($l) => $l['status_verifikasi'] === 'ditolak')),
        ];

        return view('siswa/jurnal/index', compact(
            'logbook',
            'statistik'
        ));
    }
}
