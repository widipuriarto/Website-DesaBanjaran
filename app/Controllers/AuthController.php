<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MemberModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();
        $memberModel = new MemberModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                // Siapkan session data
                $sessionData = [
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'email'     => $user['email'] ?? '',
                    'role'      => $user['role'],
                    'logged_in' => true,
                ];

                // Jika member, ambil dari tabel member
                if ($user['role'] === 'member') {
                    $member = $memberModel->where('user_id', $user['id'])->first();
                    if ($member) {
                        $sessionData['name'] = $member['name'];
                        $sessionData['member_id'] = $member['id'];
                    } else {
                        $sessionData['name'] = $user['username']; // fallback
                    }
                } else {
                    // Jika admin, pakai nama dari tabel user
                    $sessionData['name'] = $user['name'] ?? $user['username'];
                }

                $session->set($sessionData);

                // Arahkan berdasarkan role
                return ($user['role'] === 'admin') ? redirect()->to('/admin') : redirect()->to('/');
            } else {
                return redirect()->back()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerPost()
    {
        $userModel = new UserModel();
        $memberModel = new MemberModel();

        $username = $this->request->getPost('username');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $name     = $this->request->getPost('name');
        $email    = $this->request->getPost('email');
        $phone    = $this->request->getPost('phone');

        // Simpan ke tabel users
        $userId = $userModel->insert([
            'username' => $username,
            'email'    => $email,
            'password' => $password,
            'role'     => 'member',
        ]);

        // Simpan ke tabel members
        $memberModel->insert([
            'user_id' => $userId,
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
