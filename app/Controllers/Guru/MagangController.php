<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MagangModel;
use App\Models\SiswaModel;
use App\Models\DudiModel;
use App\Models\GuruModel;

class MagangController extends BaseController
{

    protected $magang;
    protected $siswa;
    protected $dudi;
    protected $guru;

    public function __construct()
    {
        $this->magang = new MagangModel();
        $this->siswa  = new SiswaModel();
        $this->dudi   = new DudiModel();
        $this->guru   = new GuruModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        $guru = $this->guru->where('user_id', $userId)->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $guruId = $guru['id'];

        $data['total'] = $this->magang
            ->where('guru_id', $guruId)
            ->countAllResults(true);

        $data['pending'] = $this->magang
            ->where('guru_id', $guruId)
            ->where('status', MagangModel::STATUS_PENDING)
            ->countAllResults(true);

        $data['aktif'] = $this->magang
            ->where('guru_id', $guruId)
            ->whereIn('status', [MagangModel::STATUS_DITERIMA, MagangModel::STATUS_BERLANGSUNG])
            ->countAllResults(true);

        $data['selesai'] = $this->magang
            ->where('guru_id', $guruId)
            ->where('status', MagangModel::STATUS_SELESAI)
            ->countAllResults(true);

        $data['ditolak'] = $this->magang
            ->where('guru_id', $guruId)
            ->where('status', MagangModel::STATUS_DITOLAK)
            ->countAllResults(true);

        $data['dibatalkan'] = $this->magang
            ->where('guru_id', $guruId)
            ->where('status', MagangModel::STATUS_DIBATALKAN)
            ->countAllResults(true);

        $data['magang'] = $this->magang
            ->select('
                magang.*,
                siswa.nama AS nama_siswa,
                siswa.nis,
                siswa.jurusan,
                guru.nama AS nama_guru,
                dudi.nama_perusahaan,
                dudi.alamat AS kota_dudi
            ')
            ->join('siswa', 'siswa.id = magang.siswa_id')
            ->join('guru', 'guru.id = magang.guru_id', 'left')
            ->join('dudi', 'dudi.id = magang.dudi_id', 'left')
            ->orderBy('magang.id', 'DESC')
            ->findAll();

        return view('guru/magang/index', $data);
    }

    public function create()
    {
        return view('guru/magang/create', [
            'siswa' => $this->siswa->findAll(),
            'dudi'  => $this->dudi->where('status', 'aktif')->findAll(),
            'guru'  => $this->guru->findAll(),
        ]);
    }

    public function store()
    {
        $this->magang->insert([
            'siswa_id'        => $this->request->getPost('siswa_id'),
            'dudi_id'         => $this->request->getPost('dudi_id'),
            'guru_id'         => $this->request->getPost('guru_id'),
            'status'          => $this->request->getPost('status'),
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
        ]);

        return redirect()->to('/guru/magang')->with('success', 'Data magang berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('guru/magang/edit', [
            'title'  => 'Edit Magang',
            'magang' => $this->magang->find($id),
            'siswa'  => $this->siswa->findAll(),
            'dudi'   => $this->dudi->where('status', 'aktif')->findAll(),
            'guru'   => $this->guru->findAll(),
        ]);
    }

    public function update($id)
    {
        $this->magang->update($id, [
            'siswa_id'        => $this->request->getPost('siswa_id'),
            'dudi_id'         => $this->request->getPost('dudi_id'),
            'guru_id'         => $this->request->getPost('guru_id'),
            'status'          => $this->request->getPost('status'),
            'nilai_akhir'     => $this->request->getPost('nilai_akhir'),
            'tanggal_mulai'   => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
        ]);

        return redirect()->to('/guru/magang')->with('success', 'Data magang berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->magang->delete($id);
        return redirect()->to('/guru/magang')->with('success', 'Data magang berhasil dihapus');
    }
}
