<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public string $clientID;
    public string $clientSecret;
    public string $redirectURI;

    public function __construct()
    {
        // Mengambil dari .env agar tidak hardcoded
        $this->clientID     = env('GOOGLE_CLIENT_ID');
        $this->clientSecret = env('GOOGLE_CLIENT_SECRET');
        $this->redirectURI  = env('GOOGLE_REDIRECT_URI');
    }
}
