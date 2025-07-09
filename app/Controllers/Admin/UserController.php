<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Models\MemberModel;

class UserController extends BaseController
{
    public function index()
    {
        $users = (new UserModel())
            ->select('users.*, members.name, members.email')
            ->join('members', 'members.user_id = users.id', 'left')
            ->findAll();

        return view('admin/users', [
            'title' => 'Kelola User',
            'users' => $users,
        ]);
    }

    public function create()
    {
        $userModel = new UserModel();
        $memberModel = new MemberModel();

        $userId = $userModel->insert([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => $this->request->getPost('role')
        ]);

        $memberModel->insert([
            'user_id' => $userId,
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email')
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
}
