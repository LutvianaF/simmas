<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class PenggunaController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $perPage = 10;

        $users = $this->user->paginate($perPage, 'users');

        $data = [
            'users' => $users,
            'pager' => $this->user->pager,
        ];

        return view('admin/pengguna/index', $data);
    }

    public function create()
    {
        return view('admin/pengguna/create');
    }

    public function store()
    {
        $this->user->insert([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role'     => $this->request->getPost('role'),
        ]);

        return redirect()->to('/admin/pengguna')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = $this->user->find($id);

        if (!$data) {
            return redirect()->to('/admin/pengguna')
                ->with('error', 'Pengguna tidak ditemukan');
        }

        return view('admin/pengguna/edit', [
            'user' => $data
        ]);
    }

    public function update($id)
    {
        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role'  => $this->request->getPost('role'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $this->user->update($id, $data);

        return redirect()->to('/admin/pengguna')
            ->with('success', 'Pengguna berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->user->delete($id);

        return redirect()->to('/admin/pengguna')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}
