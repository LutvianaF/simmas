<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SchoolSettingModel;

class PengaturanController extends BaseController
{
    protected $sekolah;

    public function __construct()
    {
        $this->sekolah = new SchoolSettingModel();
    }

    private function getPengaturan()
    {
        $data = $this->sekolah->first();

        if (!$data) {
            $id = $this->sekolah->insert([
                'logo_url'       => null,
                'nama_sekolah'   => '-',
                'alamat'         => '-',
                'telepon'        => '-',
                'email'          => '-',
                'website'        => '-',
                'kepala_sekolah' => '-',
                'npsn'           => '-'
            ]);

            $data = $this->sekolah->find($id);
        }

        return $data;
    }

    public function index()
    {
        return view('admin/pengaturan/index', [
            'sekolah' => $this->getPengaturan()
        ]);
    }

    public function update($id)
    {
        $sekolah = $this->getPengaturan();

        if (!$sekolah) {
            return redirect()->back()->with('error', 'Data pengaturan tidak ditemukan');
        }

        $data = [
            'nama_sekolah'   => $this->request->getPost('nama_sekolah'),
            'alamat'         => $this->request->getPost('alamat'),
            'telepon'        => $this->request->getPost('telepon'),
            'email'          => $this->request->getPost('email'),
            'website'        => $this->request->getPost('website'),
            'kepala_sekolah' => $this->request->getPost('kepala_sekolah'),
            'npsn'           => $this->request->getPost('npsn'),
        ];

        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            if (!empty($sekolah['logo_url']) && file_exists($sekolah['logo_url'])) {
                unlink($sekolah['logo_url']);
            }

            $name = $logo->getRandomName();
            $logo->move('uploads/logo', $name);
            $data['logo_url'] = 'uploads/logo/' . $name;
        }

        $this->sekolah->update($sekolah['id'], $data);

        return redirect()->back()->with('success', 'Pengaturan sekolah berhasil diperbarui');
    }
}
