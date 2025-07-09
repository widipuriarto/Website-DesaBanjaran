<?php

namespace App\Controllers;

require_once ROOTPATH . 'vendor/autoload.php';

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MemberModel; // Tambahkan model Member
use Google_Client;
use Google_Service_Oauth2;

class AuthGoogle extends BaseController
{
    public function redirect()
    {
        $client = $this->getGoogleClient();
        $authUrl = $client->createAuthUrl();

        return redirect()->to($authUrl);
    }

    public function callback()
    {
        $client = $this->getGoogleClient();

        $code = $this->request->getVar('code');

        if ($code) {
            $token = $client->fetchAccessTokenWithAuthCode($code);

            if (isset($token['error'])) {
                return redirect()->to('/login')->with('error', 'Gagal mendapatkan token Google.');
            }

            $client->setAccessToken($token['access_token']);

            $googleService = new Google_Service_Oauth2($client);
            $googleUser = $googleService->userinfo->get();

            $email = $googleUser->email;
            $name  = $googleUser->name;

            $userModel   = new UserModel();
            $memberModel = new MemberModel();

            $user = $userModel->where('email', $email)->first();

            if (!$user) {
                $username = explode('@', $email)[0];

                // Tambah ke tabel users
                $userId = $userModel->insert([
                    'username' => $username,
                    'email'    => $email,
                    'password' => password_hash('google_auth', PASSWORD_DEFAULT),
                    'role'     => 'member'  // default role member
                ]);

                // Tambah ke tabel members
                $memberModel->insert([
                    'user_id' => $userId,
                    'name'    => $name,
                    'email'   => $email,
                    'phone'   => '', // default kosong
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $user = $userModel->find($userId); // Ambil kembali user
            }

            // Ambil data member
            $member = $memberModel->where('user_id', $user['id'])->first();

            session()->set([
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'email'      => $user['email'],
                'role'       => $user['role'],
                'name'       => $member['name'] ?? $user['username'],
                'member_id'  => $member['id'] ?? null,
                'logged_in'  => true
            ]);

            if ($user['role'] === 'admin') {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/');
            }
        }

        return redirect()->to('/login')->with('error', 'Autentikasi Google gagal.');
    }

    private function getGoogleClient()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(base_url('auth/google-callback'));
        $client->addScope('email');
        $client->addScope('profile');

        return $client;
    }
}
