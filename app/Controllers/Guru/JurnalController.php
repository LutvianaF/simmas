<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\LogbookModel;
use App\Models\MagangModel;

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
        $guruId = session()->get('guru_id');

        $data['total'] = $this->logbook
            ->join('magang', 'magang.id = logbook.magang_id')
            ->where('magang.guru_id', $guruId)
            ->countAllResults();

        $data['belum'] = $this->logbook
            ->join('magang', 'magang.id = logbook.magang_id')
            ->where('magang.guru_id', $guruId)
            ->where('status_verifikasi', 'pending')
            ->countAllResults();

        $data['disetujui'] = $this->logbook
            ->join('magang', 'magang.id = logbook.magang_id')
            ->where('magang.guru_id', $guruId)
            ->where('status_verifikasi', 'disetujui')
            ->countAllResults();

        $data['ditolak'] = $this->logbook
            ->join('magang', 'magang.id = logbook.magang_id')
            ->where('magang.guru_id', $guruId)
            ->where('status_verifikasi', 'ditolak')
            ->countAllResults();

        $data['logbook'] = $this->logbook
            ->select('
                logbook.*,
                siswa.nama AS nama_siswa,
                siswa.nis,
                magang.id AS magang_id
            ')
            ->join('magang', 'magang.id = logbook.magang_id')
            ->join('siswa', 'siswa.id = magang.siswa_id')
            ->where('magang.guru_id', $guruId)
            ->orderBy('logbook.tanggal', 'DESC')
            ->findAll();

        return view('guru/jurnal/index', $data);
    }

    public function verifikasi($id)
    {
        $this->logbook->update($id, [
            'status_verifikasi' => $this->request->getPost('status'),
            'catatan_guru'      => $this->request->getPost('catatan_guru'),
        ]);

        return redirect()->back()->with('success', 'Logbook berhasil diverifikasi');
    }
}
