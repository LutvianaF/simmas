<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DudiModel;

class DudiController extends BaseController
{
    protected $dudi;

    public function __construct()
    {
        $this->dudi = new DudiModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Manajemen DUDI',
            'total'     => $this->dudi->countAllResults(),
            'aktif'     => $this->dudi->where('status', 'aktif')->countAllResults(),
            'nonaktif'  => $this->dudi->where('status', 'nonaktif')->countAllResults(),
            'dudi'      => $this->dudi->findAll(),
        ];

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
