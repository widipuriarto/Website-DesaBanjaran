# DOKUMENTASI & MANUAL PENGGUNAAN CHATBOT ASISTEN DESA

---

## 1. Deskripsi Singkat Chatbot

**Asisten Desa (Chatbot AI)** adalah fitur layanan pelanggan cerdas yang terintegrasi dalam Website Desa Wisata Banjaran. Dibangun menggunakan teknologi **Google Gemini AI**, chatbot ini berfungsi sebagai pemandu wisata virtual yang siap sedia 24 jam.

**Keunggulan Utama:**

- **Cerdas & Kontekstual:** Mampu memahami bahasa manusia yang alami dan menjawab pertanyaan spesifik mengenai paket wisata desa (harga, fasilitas, lokasi) menggunakan data terkini dari database.
- **Pengetahuan Luas:** Selain info desa, chatbot juga dapat menjawab pertanyaan umum (General Knowledge) seperti tips traveling, cuaca, atau informasi edukatif lainnya.
- **Riwayat Percakapan (History):** Untuk pengguna yang login (via Google), seluruh riwayat percakapan tersimpan otomatis. Anda bisa menutup browser dan membukanya kembali besok, percakapan Anda tetap ada.
- **Antarmuka Modern:** Desain _floating widget_ yang responsif dan mudah digunakan di HP maupun Laptop.

---

## 2. Tools & Persyaratan Sistem (System Requirements)

Untuk menjalankan atau mengembangkan sistem ini, berikut adalah perangkat lunak dan teknologi yang digunakan:

### A. Environment Server Lokal (Development)

1.  **Web Server & Database:** Laragon (Rekomendasi) atau XAMPP.
2.  **Bahasa Pemrograman:** PHP Versi 8.1 atau lebih baru.
3.  **Database:** MySQL / MariaDB.
4.  **Browser:** Google Chrome, Edge, atau Firefox (Versi Terbaru).

### B. Framework & Library

1.  **CodeIgniter 4:** Framework PHP utama aplikasi.
2.  **Composer:** Dependency manager untuk menginstal library PHP.
3.  **Google Client Library:** Untuk fitur "Login with Google".

### C. API Services

1.  **Google Gemini API Key:** Kunci akses agar Chatbot bisa berpikir (Otak AI).
2.  **Google Cloud Console OAuth:** Kredensial (Client ID & Secret) untuk fitur Login Google.

---

## 3. Tutorial Penggunaan (User Manual)

Berikut adalah panduan langkah demi langkah cara menggunakan fitur Chatbot di website Desa Wisata Banjaran:

### Langkah 1: Akses Website

Buka browser (Chrome/Edge) dan akses alamat website lokal Anda, misalnya:
`http://localhost:8080` atau `http://project-uas.test` (sesuai konfigurasi Laragon Anda).

### Langkah 2: Login Akun (Disarankan)

Fitur **Riwayat Chat** hanya aktif jika Anda login.

1.  Klik tombol **"Login"** atau ikon pengguna di navigasi atas.
2.  Pilih **"Login with Google"**.
3.  Pilih akun Gmail Anda.
4.  Setelah berhasil, Anda akan diarahkan kembali ke beranda dengan status "Logged In".

### Langkah 3: Membuka Chatbot

1.  Perhatikan ikon **Pesan/Komentar** yang melayang di pojok kanan bawah layar.
2.  Klik ikon tersebut.
3.  Jendela chat akan terbuka dengan sapaan awal: _"Halo! Ada yang bisa saya bantu tentang Desa Wisata Banjaran?"_.

### Langkah 4: Berinteraksi dengan Bot

Ketik pertanyaan Anda pada kolom teks di bagian bawah, lalu tekan **Enter** atau klik ikon **Kirim** (pesawat kertas).

**Contoh Pertanyaan yang Bisa Anda Coba:**

- **Info Desa:** _"Ada paket wisata apa saja di sini?"_
- **Detail Paket:** _"Berapa harga paket camping dan apa saja fasilitasnya?"_
- **Pertanyaan Umum:** _"Apa perlengkapan yang wajib dibawa saat mendaki gunung?"_
- **Sapaan:** _"Halo, selamat pagi!"_

Bot akan memproses jawaban (indikator _Sedang mengetik..._) dan membalas dalam beberapa detik.

### Langkah 5: Melihat Riwayat (History)

Jika Anda sudah login:

1.  Coba _refresh_ (muat ulang) halaman website.
2.  Buka kembali ikon Chatbot.
3.  Percakapan Anda sebelumnya akan otomatis dimuat (muncul kembali). Anda bisa melanjutkan obrolan tanpa kehilangan konteks.

### Langkah 6: Menutup Chat

Untuk menutup jendela chat agar tidak menutupi konten website, klik ikon **Silang (X)** pada tombol bulat di pojok kanan bawah, atau klik di area kosong manapun di luar kotak chat.

---

## 4. Troubleshooting (Pemecahan Masalah)

**Q: Chatbot diam saja / tidak membalas / loading terus.**

- **A:** Cek koneksi internet Anda. Chatbot butuh internet untuk menghubungi server Google Gemini.
- **A:** Jika masih error, kemungkinan kuota API Key habis (tunggu 1 menit lalu coba lagi).

**Q: Saya sudah chat panjang, tapi pas refresh hilang.**

- **A:** Pastikan Anda **sudah Login**. Jika Anda mengakses sebagai Tamu (Guest), riwayat chat tidak disimpan di database.

**Q: Bot menjawab "Maaf terjadi kesalahan koneksi".**

- **A:** Ini biasanya masalah jaringan atau API Key server sedang bermasalah. Coba refresh halaman.
