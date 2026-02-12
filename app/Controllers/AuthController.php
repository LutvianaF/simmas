<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function prosesLogin()
    {
        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $this->request->getPost('email'))
            ->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau password salah');
        }

        session()->regenerate(true);
        session()->set([
            'user_id'    => $user['id'],
            'name'       => $user['name'],
            'email'      => $user['email'],
            'role'       => $user['role'],
            'isLoggedIn' => true,
        ]);

        $redirect = [
            'admin' => 'admin/dashboard',
            'guru'  => 'guru/dashboard',
            'siswa' => 'siswa/dashboard',
        ];

        return redirect()->to(base_url($redirect[$user['role']] ?? 'login'));
    }

    public function register()
    {
        return view('register');
    }

    public function store()
    {
        $userModel = new UserModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => 'siswa', // default role
        ];

        $userModel->insert($data);

        return redirect()->to(base_url('login'))
            ->with('success', 'Registrasi berhasil, silakan login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'Anda telah logout');
    }
}
