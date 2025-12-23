<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ChatbotController extends BaseController
{
    public function send()
    {
        try {
            if (!$this->request->isAJAX()) {
                return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
            }

            $message = $this->request->getPost('message');
            $session = session();
            $isLoggedIn = $session->get('logged_in');
            $userId = $session->get('user_id');

            // 1. Simpan pesan user (jika login)
            if ($isLoggedIn) {
                // Gunakan insert() agar pasti membuat baris baru
                $chatModel = new \App\Models\ChatHistoryModel();
                $chatModel->insert([
                    'user_id' => $userId,
                    'message' => $message,
                    'sender'  => 'user'
                ]);
            }

            // 2. Bangun Konteks (Data Wisata)
            $context = $this->buildContext();

            // 3. Kirim ke Gemini
            $botReply = $this->callGemini($message, $context);

            // 4. Simpan balasan bot (jika login)
            if ($isLoggedIn) {
                // Pastikan insert baru lagi untuk jawaban bot
                $chatModel = new \App\Models\ChatHistoryModel();
                $chatModel->insert([
                    'user_id' => $userId,
                    'message' => $botReply,
                    'sender'  => 'bot'
                ]);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'reply' => $botReply
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'reply'  => "System Error: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine()
            ]);
        }
    }

    public function loadHistory()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON([]);
        }

        $userId = session()->get('user_id');
        $chatModel = new \App\Models\ChatHistoryModel();

        $history = $chatModel->where('user_id', $userId)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return $this->response->setJSON($history);
    }

    private function buildContext()
    {
        // Ambil data Paket Wisata
        $paketModel = new \App\Models\PaketWisataModel();
        $pakets = $paketModel->findAll();

        $textPaket = "Daftar Paket Wisata Tersedia:\n";
        foreach ($pakets as $p) {
            // FIX: Gunakan 'title' sesuai kolom database, bukan 'name'
            $textPaket .= "- {$p['title']} (Harga: Rp " . number_format($p['price'], 0, ',', '.') . "). Deskripsi: {$p['description']}\n";
        }

        return "Kamu adalah Asisten Cerdas untuk Website Desa Wisata Banjaran. 
        Tugasmu:
        1. Prioritaskan menjawab pertanyaan tentang PAKET WISATA menggunakan data berikut:
        " . $textPaket . "
        
        2. Jika pengguna bertanya hal umum (pengetahuan umum, sapaan, tips travel, cuaca, dll), JAWABLAH dengan pengetahuan luasmu yang cerdas. JANGAN menolak pertanyaan umum.
        3. Gunakan Bahasa Indonesia yang ramah, santai, dan membantu. Gunakan emoji sesekali.";
    }

    private function callGemini($userMessage, $systemInstruction)
    {
        $apiKey = getenv('GEMINI_API_KEY');
        if (!$apiKey) return "Error: API Key missing";

        // MENGGUNAKAN MODEL models/gemini-2.0-flash (Sesuai List Akun User)
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=" . $apiKey;

        $payload = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $systemInstruction . "\n\nUser bertanya: " . $userMessage]
                    ]
                ]
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        // SSL Verify false untuk localhost jika diperlukan
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return "Koneksi Error: " . $error;
        }

        curl_close($ch);

        $data = json_decode($response, true);

        // Cek jika API mengembalikan error
        if (isset($data['error'])) {
            return "Gemini Error (" . $data['error']['code'] . "): " . $data['error']['message'];
        }

        // Ambil teks jawaban
        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return $data['candidates'][0]['content']['parts'][0]['text'];
        } else {
            return "Maaf, tidak ada respon valid. Raw: " . substr($response, 0, 100);
        }
    }
}
