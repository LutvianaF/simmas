<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\DudiModel;
use App\Models\MagangModel;
use App\Models\SiswaModel;

class DudiController extends BaseController
{
    protected $dudiModel;
    protected $magangModel;
    protected $siswaModel;
    protected $db;

    public function __construct()
    {
        $this->dudiModel   = new DudiModel();
        $this->magangModel = new MagangModel();
        $this->siswaModel  = new SiswaModel();
        $this->db          = \Config\Database::connect();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        // Ambil data siswa berdasarkan user_id
        $siswa = $this->siswaModel
            ->where('user_id', $userId)
            ->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Ambil DUDI aktif
        $dudiList = $this->dudiModel
            ->where('status', 'aktif')
            ->findAll();

        // Ambil semua pendaftaran berdasarkan siswa.id (bukan user_id)
        $magang = $this->magangModel
            ->where('siswa_id', $siswa['id'])
            ->findAll();

        $statusMagang = [];

        foreach ($magang as $m) {
            $statusMagang[$m['dudi_id']] = $m['status'];
        }

        return view('siswa/dudi/index', [
            'dudiList'     => $dudiList,
            'statusMagang' => $statusMagang
        ]);
    }

    public function daftar($dudi_id)
    {
        $magangModel = new MagangModel();
        $siswaModel  = new SiswaModel();
        $guruModel = new \App\Models\GuruModel();
        $guru = $guruModel->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Guru belum tersedia');
        }

        $user_id = session()->get('user_id');

        $siswa = $siswaModel->where('user_id', $user_id)->first();
        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $data = [
            'siswa_id'   => $siswa['id'],
            'dudi_id'    => $dudi_id,
            'guru_id'    => $guru['id'],
            'status'     => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($magangModel->insert($data)) {
            return redirect()->to(base_url('siswa/dudi'))->with('success', 'Pendaftaran magang berhasil.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mendaftar.');
        }
    }

    public function detail($id)
    {
        $siswaId = session()->get('user_id');

        $dudi = $this->dudiModel->find($id);

        if (!$dudi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('DUDI tidak ditemukan');
        }

        // Cek apakah siswa sudah mendaftar
        $pendaftaran = $this->magangModel
            ->where('siswa_id', $siswaId)
            ->where('dudi_id', $id)
            ->first();

        return view('siswa/dudi/detail', [
            'dudi'        => $dudi,
            'pendaftaran' => $pendaftaran
        ]);
    }
}
