<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\DudiModel;
use App\Models\MagangModel;

class DudiController extends BaseController
{
    protected $dudiModel;
    protected $magangModel;

    public function __construct()
    {
        $this->dudiModel   = new DudiModel();
        $this->magangModel = new MagangModel();
    }

    public function index()
    {
        $siswaId = session()->get('user_id');

        // Ambil DUDI aktif saja
        $dudiList = $this->dudiModel
            ->where('status', 'aktif')
            ->findAll();

        // Ambil DUDI yang sudah didaftar siswa
        $daftarSiswa = $this->magangModel
            ->where('siswa_id', $siswaId)
            ->findColumn('dudi_id');

        return view('siswa/dudi/index', [
            'dudiList'    => $dudiList,
            'daftarSiswa' => $daftarSiswa ?? []
        ]);
    }

    public function daftar($dudiId)
    {
        $siswaId = session()->get('user_id');

        // Hitung jumlah pendaftaran
        $jumlah = $this->magangModel
            ->where('siswa_id', $siswaId)
            ->countAllResults();

        if ($jumlah >= 3) {
            return redirect()->back()
                ->with('error', 'Maksimal pendaftaran magang adalah 3 DUDI');
        }

        // Cegah daftar ganda
        $cek = $this->magangModel
            ->where('siswa_id', $siswaId)
            ->where('dudi_id', $dudiId)
            ->first();

        if ($cek) {
            return redirect()->back()
                ->with('error', 'Anda sudah mendaftar di DUDI ini');
        }

        $this->magangModel->insert([
            'siswa_id' => $siswaId,
            'dudi_id'  => $dudiId,
            'status'   => 'menunggu'
        ]);

        return redirect()->back()
            ->with('success', 'Pendaftaran magang berhasil diajukan, menunggu verifikasi dari pihak guru');
    }

    public function detail($id)
    {
        $siswaId = session()->get('user_id');

        $dudi = $this->dudiModel->find($id);

        if (!$dudi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('DUDI tidak ditemukan');
        }

        // Cek apakah siswa sudah mendaftar ke DUDI ini
        $pendaftaran = $this->magangModel
            ->where('siswa_id', $siswaId)
            ->where('dudi_id', $id)
            ->first();

        return view('siswa/dudi/detail', [
            'dudi'        => $dudi,
            'pendaftaran' => $pendaftaran // null jika belum daftar
        ]);
    }
}
