<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DudiModel;
use App\Models\MagangModel;

class DudiController extends BaseController
{
    protected $dudi;
    protected $magang;

    public function __construct()
    {
        $this->dudi = new DudiModel();
        $this->magang = new MagangModel();
    }

    public function index()
    {
        $perPage   = 5;
        $dudiModel = $this->dudi
            ->select('dudi.*, COUNT(magang.id) as total_siswa_magang')
            ->join('magang', 'magang.dudi_id = dudi.id', 'left')
            ->groupBy('dudi.id');
        $dudi = $dudiModel->paginate($perPage, 'dudi');
        $pager = $dudiModel->pager;
        $totalDudi   = $this->dudi->countAllResults();
        $aktif       = $this->dudi->where('status', 'aktif')->countAllResults();
        $nonaktif    = $this->dudi->where('status', 'nonaktif')->countAllResults();
        $pending    = $this->dudi->where('status', 'pending')->countAllResults();
        $totalMagang = $this->magang->countAllResults();
        $data = [
            'title'        => 'Manajemen DUDI',
            'dudi'         => $dudi,
            'pager'        => $pager,
            'per_page'     => $perPage,
            'totalDudi'    => $totalDudi,
            'aktif'        => $aktif,
            'nonaktif'     => $nonaktif,
            'pending'      => $pending,
            'totalMagang'  => $totalMagang,
        ];

        return view('admin/dudi/index', $data);
    }

    public function store()
    {
        $this->dudi->save([
            'nama_perusahaan'       => $this->request->getPost('nama_perusahaan'),
            'alamat'                => $this->request->getPost('alamat'), 
            'telepon'               => $this->request->getPost('telepon'),
            'email'                 => $this->request->getPost('email'),
            'penanggung_jawab'      => $this->request->getPost('penanggung_jawab'),
            'status'                => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/dudi')->with('success', 'Data DUDI berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->dudi->update($id, [
            'nama_perusahaan'       => $this->request->getPost('nama_perusahaan'),
            'alamat'                => $this->request->getPost('alamat'),
            'telepon'               => $this->request->getPost('telepon'),
            'email'                 => $this->request->getPost('email'),
            'penanggung_jawab'      => $this->request->getPost('penanggung_jawab'),
            'status'                => $this->request->getPost('status'),
        ]);

        return redirect()->to('/admin/dudi')->with('success', 'Data DUDI berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->dudi->delete($id);
        return redirect()->to('/admin/dudi')->with('success', 'Data berhasil dihapus');
    }

}
