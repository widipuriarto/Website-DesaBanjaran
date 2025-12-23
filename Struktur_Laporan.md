# Struktur Laporan Tugas Akhir / UAS

## Judul: Rancang Bangun Website Desa Wisata Banjaran dengan Integrasi Chatbot AI (Gemini API)

---

### BAB I: PENDAHULUAN

**1.1 Latar Belakang**

- Potensi Desa Wisata Banjaran yang perlu dipromosikan secara digital.
- Permasalahan: Kurangnya layanan informasi 24 jam interaktif bagi calon wisatawan.
- Solusi: Pemanfaatan teknologi _Artificial Intelligence_ (AI) berupa Chatbot untuk membantu menjawab pertanyaan pengunjung secara otomatis dan cerdas.

**1.2 Rumusan Masalah**

- Bagaimana membangun website infomasi desa wisata yang dinamis?
- Bagaimana mengintegrasikan API Google Gemini ke dalam website berbasis CodeIgniter 4?
- Bagaimana menyimpan dan menampilkan riwayat percakapan (_chat history_) pengguna?

**1.3 Batasan Masalah**

- Sistem dibangun menggunakan Framework CodeIgniter 4.
- Chatbot menggunakan model AI Google Gemini (Free Tier).
- Data latih chatbot berfokus pada informasi paket wisata dan profil desa (Context/RAG Sederhana).
- Fitur Login menggunakan Google (OAuth).

**1.4 Tujuan Penelitian**

- Menyediakan media informasi desa wisata yang modern.
- Mempermudah wisatawan mendapatkan informasi kapan saja melalui chatbot.
- Menerapkan teknologi AI Generatif dalam skala aplikasi web sederhana.

---

### BAB II: LANDASAN TEORI

**2.1 Sistem Informasi Pariwisata**

- Definisi dan perannya dalam promosi desa.

**2.2 Framework CodeIgniter 4**

- Konsep MVC (Model-View-Controller).
- Keunggulan performa dan keamanan CI4.

**2.3 Artificial Intelligence & Large Language Models (LLM)**

- Penjelasan singkat tentang Generative AI.
- Google Gemini API: Fitur, capabilities, dan cara kerja API.

**2.4 Teknologi Pendukung**

- PHP & MySQL (Database).
- JavaScript (Fetch API untuk Chatbot asinkron).
- Google OAuth 2.0 (Untuk sistem login).

---

### BAB III: ANALISIS DAN PERANCANGAN SISTEM

**3.1 Analisis Kebutuhan Sistem**

- Kebutuhan Fungsional: User bisa melihat paket, User bisa login, User bisa chatting dengan bot, Bot bisa menjawab sesuai konteks.
- Kebutuhan Non-Fungsional: Responsif (Mobile friendly), Waktu respon bot < 3 detik.

**3.2 Perancangan Sistem (UML)**

- **Use Case Diagram:** Aktor (Pengunjung, Admin/Sistem), Use Case (Melihat Info, Login, Chatting).
- **Activity Diagram:** Alur percakapan user dengan bot.

**3.3 Perancangan Database (ERD)**

- Tabel `users` (Menyimpan data login Google).
- Tabel `chat_history` (Menyimpan log chat: id, user_id, message, sender, created_at).
- Tabel `paket_wisata` (Sumber data/konteks untuk Chatbot).

**3.4 Perancangan Antarmuka (UI/UX)**

- Mockup Halaman Beranda.
- Mockup Desain Jendela Chatbot (Floating Button).

---

### BAB IV: IMPLEMENTASI DAN PENGUJIAN

**4.1 Implementasi Lingkungan Kerja**

- Spesifikasi Hardware & Software (Laragon, VS Code, Browser).
- Konfigurasi `.env` dan API Keys.

**4.2 Implementasi Kode Program**

- **Backend (Controller):** Penjelasan logika `ChatbotController.php` (menghubungkan ke Gemini API, teknik _Prompt Engineering_ untuk konteks desa).
- **Frontend (View & JS):** Penjelasan `chatbot.js`, logika AJAX, dan UI `layout.php`.
- **Database Model:** Implementasi `ChatHistoryModel`.

**4.3 Hasil Tampilan Sistem**

- _Screenshot_ Halaman Utama.
- _Screenshot_ Fitur Chatbot Sedang Mengetik & Menjawab.
- _Screenshot_ Riwayat Chat yang tersimpan.

**4.4 Pengujian Sistem (Black Box Testing)**

- Tabel Pengujian Fitur Chat:
  - Input: "Apa ada paket camping?" -> Output: Bot menjelaskan paket camping (Berhasil/Gagal).
  - Input: "Siapa presiden RI?" -> Output: Bot menjawab info umum (jika diizinkan) (Berhasil/Gagal).
  - Input: Klik tombol history -> Output: Chat lama muncul kembali (Berhasil/Gagal).

---

### BAB V: PENUTUP

**5.1 Kesimpulan**

- Sistem berhasil dibangun menggunakan CI4 dan Gemini API.
- Chatbot mampu meningkatkan interaktivitas website dengan menjawab pertanyaan seputar paket wisata.
- Integrasi database berhasil menyimpan riwayat percakapan.

**5.2 Saran**

- Pengembangan lanjut ke model AI yang lebih berbayar untuk performa lebih stabil.
- Penambahan fitur _voice-to-text_.
- Admin panel untuk melihat statistik pertanyaan yang sering diajukan.

---

### DAFTAR PUSTAKA

- Dokumentasi CodeIgniter 4.
- Dokumentasi Google Gemini API.
- Jurnal/Artikel terkait Sistem Informasi Desa Wisata.
