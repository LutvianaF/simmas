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
        $data = [
            'title'         => 'Manajemen DUDI',
            'totalDudi'     => $this->dudi->countAllResults(),
            'totalMagang'   => $this->magang->countAllResults(),
            'aktif'         => $this->dudi->where('status', 'aktif')->countAllResults(),
            'nonaktif'      => $this->dudi->where('status', 'nonaktif')->countAllResults(),
            'dudi'          => $this->dudi->findAll(),
        ];

        $data['dudi'] = $this->dudi
            ->select('
            dudi.*,
            COUNT(magang.id) as total_siswa_magang
        ')
            ->join('magang', 'magang.dudi_id = dudi.id', 'left')
            ->groupBy('dudi.id')
            ->findAll();

        return view('admin/dudi/index', $data);
    }

    public function store()
    {
        $this->dudi->save([
            'nama'                  => $this->request->getPost('nama_perusahaan'),
            'alamat'                => $this->request->getPost('alamat'),
            'telepon'               => $this->request->getPost('telepon'),
            'email'                 => $this->request->getPost('email'),
            'penanggung_jawab'      => $this->request->getPost('penanggung_jawab'),
            'status'                => 'aktif',
        ]);

        return redirect()->to('/admin/dudi')->with('success', 'Data DUDI berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->dudi->update($id, [
            'nama'                  => $this->request->getPost('nama_perusahaan'),
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
