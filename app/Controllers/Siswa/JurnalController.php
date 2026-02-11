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
    protected $db;

    public function __construct()
    {
        $this->logbook = new LogbookModel();
        $this->magang  = new MagangModel();
        $this->db      = Database::connect();
    }

    public function index()
    {
        $siswa = $this->getSiswaLogin();

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

        return view('siswa/jurnal/index', compact('logbook', 'statistik'));
    }

    public function create()
    {
        $siswa = $this->getSiswaLogin();

        $magang = $this->magang
            ->where('siswa_id', $siswa['id'])
            ->first();

        if (!$magang) {
            return redirect()->back()->with('error', 'Magang tidak ditemukan.');
        }

        return view('siswa/jurnal/create', [
            'magang_id' => $magang['id']
        ]);
    }

    public function store()
    {
        $rules = [
            'tanggal'  => 'required',
            'kegiatan' => 'required|min_length[50]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $fileName = null;
        $file = $this->request->getFile('file');

        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/jurnal', $fileName);
        }

        $this->logbook->save([
            'magang_id' => $this->request->getPost('magang_id'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'kegiatan'  => $this->request->getPost('kegiatan'),
            'kendala'   => $this->request->getPost('kendala'),
            'file'      => $fileName,
            'status_verifikasi' => 'pending'
        ]);

        return redirect()->to('/siswa/jurnal')
            ->with('success', 'Jurnal berhasil disimpan dan menunggu verifikasi.');
    }

    public function detail($id)
    {
        $siswa = $this->getSiswaLogin();

        $jurnal = $this->logbook
            ->select('
            logbook.*,
            siswa.nama as nama_siswa,
            siswa.nis,
            siswa.kelas,
            dudi.nama_perusahaan,
            dudi.alamat,
            dudi.penanggung_jawab
        ')
            ->join('magang', 'magang.id = logbook.magang_id')
            ->join('siswa', 'siswa.id = magang.siswa_id')
            ->join('dudi', 'dudi.id = magang.dudi_id')
            ->where('logbook.id', $id)
            ->where('magang.siswa_id', $siswa['id'])
            ->first();

        if (!$jurnal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view('siswa/jurnal/detail', compact('jurnal'));
    }

    public function edit($id)
    {
        $jurnal = $this->logbook->find($id);

        if (!$jurnal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        if ($jurnal['status_verifikasi'] === 'disetujui') {
            return redirect()->back()
                ->with('error', 'Jurnal yang sudah disetujui tidak bisa diubah.');
        }

        return view('siswa/jurnal/edit', [
            'jurnal' => $jurnal
        ]);
    }

    public function update($id)
    {
        $rules = [
            'tanggal'  => 'required',
            'kegiatan' => 'required|min_length[50]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'tanggal'  => $this->request->getPost('tanggal'),
            'kegiatan' => $this->request->getPost('kegiatan'),
            'kendala'  => $this->request->getPost('kendala'),
            'status_verifikasi' => 'pending'
        ];

        $file = $this->request->getFile('file');

        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/jurnal', $fileName);
            $data['file'] = $fileName;
        }

        $this->logbook->update($id, $data);

        return redirect()->to('/siswa/jurnal')
            ->with('success', 'Jurnal berhasil diperbarui.');
    }

    public function delete($id)
    {
        $jurnal = $this->logbook->find($id);

        if (!$jurnal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        if ($jurnal['status_verifikasi'] === 'disetujui') {
            return redirect()->back()
                ->with('error', 'Jurnal yang sudah disetujui tidak bisa dihapus.');
        }

        if ($jurnal['file'] && file_exists('uploads/jurnal/' . $jurnal['file'])) {
            unlink('uploads/jurnal/' . $jurnal['file']);
        }

        $this->logbook->delete($id);

        return redirect()->back()
            ->with('success', 'Jurnal berhasil dihapus.');
    }

    private function getSiswaLogin()
    {
        $siswa = $this->db->table('siswa')
            ->where('user_id', session()->get('user_id'))
            ->get()
            ->getRowArray();

        if (!$siswa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return $siswa;
    }
}
