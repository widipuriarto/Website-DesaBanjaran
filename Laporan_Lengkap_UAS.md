# LAPORAN TUGAS AKHIR

# RANCANG BANGUN WEBSITE DESA WISATA BANJARAN DENGAN INTEGRASI CHATBOT AI (GOOGLE GEMINI)

---

## BAB I: PENDAHULUAN

### 1.1 Latar Belakang

Di era digitalisasi saat ini, sektor pariwisata dituntut untuk beradaptasi dengan teknologi guna meningkatkan daya tarik dan kemudahan akses informasi bagi wisatawan. Desa Wisata Banjaran, sebagai salah satu destinasi yang memiliki potensi alam dan budaya yang besar, memerlukan media promosi yang tidak hanya informatif tetapi juga interaktif. Website profil desa yang statis seringkali tidak cukup untuk menjawab pertanyaan spesifik calon pengunjung secara _real-time_, seperti ketersediaan paket wisata, harga terkini, atau rekomendasi aktivitas. Keterbatasan sumber daya manusia untuk melayani pertanyaan pelanggan selama 24 jam menjadi kendala utama dalam pelayanan informasi konvensional.

Oleh karena itu, penerapan teknologi _Artificial Intelligence_ (AI) atau Kecerdasan Buatan menjadi solusi yang relevan. Dengan mengintegrasikan fitur Chatbot berbasis _Large Language Model_ (LLM) seperti Google Gemini ke dalam website desa, pengunjung dapat berinteraksi dan bertanya layaknya berbicara dengan pemandu wisata virtual. Proyek ini bertujuan untuk membangun sistem website Desa Wisata Banjaran yang dilengkapi dengan Chatbot cerdas yang mampu memahami konteks wisata desa, memberikan respons yang natural, dan menyimpan riwayat percakapan untuk pengalaman pengguna yang lebih personal.

### 1.2 Rumusan Masalah

Berdasarkan latar belakang di atas, rumusan masalah dalam tugas akhir ini adalah:

1.  Bagaimana merancang dan membangun website informasi Desa Wisata Banjaran yang modern dan responsif menggunakan framework CodeIgniter 4?
2.  Bagaimana cara mengintegrasikan API Google Gemini untuk membuat Chatbot yang mampu menjawab pertanyaan seputar paket wisata secara otomatis?
3.  Bagaimana mekanisme penyimpanan riwayat percakapan (_chat history_) pengguna agar interaksi sebelumnya tidak hilang saat halaman dimuat ulang?

### 1.3 Batasan Masalah

Agar pembahasan lebih terarah, batasan masalah dalam proyek ini adalah:

1.  Sistem dibangun berbasis web menggunakan framework PHP CodeIgniter 4 dan database MySQL.
2.  Chatbot menggunakan layanan API Google Gemini (model _gemini-2.0-flash_ atau _1.5-flash_) versi _Free Tier_.
3.  Chatbot dilatih dengan metode _Retrieval Augmented Generation_ (RAG) sederhana, dimana konteks jawaban dibatasi pada data paket wisata dan profil desa yang tersimpan di database.
4.  Fitur otentikasi pengguna untuk menyimpan riwayat chat menggunakan integrasi Google Login (OAuth 2.0).

### 1.4 Tujuan Penelitian

Tujuan dari pembuatan tugas akhir ini adalah:

1.  Menghasilkan aplikasi website Desa Wisata Banjaran yang dapat diakses secara publik sebagai media promosi digital.
2.  Mengimplementasikan fitur Chatbot AI yang dapat membantu calon wisatawan mendapatkan informasi paket wisata secara cepat dan akurat tanpa menunggu respon admin.
3.  Memberikan pengalaman pengguna (_User Experience_) yang lebih baik melalui antarmuka interaktif dan fitur penyimpanan riwayat percakapan.

---

## BAB II: LANDASAN TEORI

### 2.1 Sistem Informasi Pariwisata

Sistem Informasi Pariwisata adalah sistem yang memanfaatkan teknologi informasi untuk mengumpulkan, menyimpan, memproses, dan menyebarkan informasi terkait destinasi wisata, atraksi, akomodasi, dan layanan pendukung lainnya. Keberadaan sistem ini krusial bagi desa wisata untuk menjangkau pasar yang lebih luas dan meningkatkan kredibilitas di mata wisatawan modern yang cenderung mencari informasi melalui internet sebelum berkunjung.

### 2.2 Framework CodeIgniter 4

CodeIgniter 4 adalah kerangka kerja (_framework_) pengembangan aplikasi web berbasis PHP yang menggunakan konsep _Model-View-Controller_ (MVC). Berbeda dengan pendahulunya, CodeIgniter 4 menawarkan performa yang lebih cepat, struktur kode yang lebih rapi, dan fitur keamanan bawaan seperti perlindungan terhadap CSRF (_Cross-Site Request Forgery_) dan XSS (_Cross-Site Scripting_). Dalam proyek ini, CI4 digunakan sebagai fondasi utama _backend_ untuk menangani rute URL, logika kontroler, dan interaksi database.

### 2.3 Google Gemini API & Generative AI

Google Gemini adalah keluarga model bahasa besar (_Large Language Model_ atau LLM) multimodal yang dikembangkan oleh Google. Model ini memiliki kemampuan untuk memahami, merangkum, dan men-generate teks dengan sangat natural menyerupai manusia. Melalui Gemini API, pengembang dapat "meminjam" kecerdasan model ini untuk diaplikasikan ke dalam aplikasi sendiri. Dalam konteks Chatbot Desa Wisata, Gemini API berfungsi sebagai "otak" yang memproses pertanyaan user dan menyusun jawaban berdasarkan instruksi sistem yang diberikan.

### 2.4 Prompt Engineering & Context Awareness

Agar Chatbot tidak menjawab sembarangan atau melenceng dari topik, diperlukan teknik _Prompt Engineering_. Ini adalah seni menyusun instruksi (_System Instruction_) kepada AI agar berperilaku sesuai perannya. Dalam sistem ini, instruksi yang diberikan kepada Gemini mencakup peran sebagai "Asisten Desa Wisata" dan penyisipan data dinamis (daftar paket wisata dari database) ke dalam _prompt_, sehingga AI memiliki konteks pengetahuan tentang produk desa terkini.

---

## BAB III: METODOLOGI PENELITIAN & PERANCANGAN

### 3.1 Analisis Kebutuhan

Tahap analisis kebutuhan memetakan fitur-fitur yang harus ada dalam sistem. Kebutuhan fungsional mencakup: (1) Pengunjung dapat melihat daftar paket wisata, (2) Pengunjung dapat login menggunakan akun Google, (3) Pengunjung dapat membuka widget chatbot dan mengirim pesan, (4) Sistem menyimpan riwayat chat ke database, (5) Bot merespon pertanyaan umum dan spesifik wisata. Kebutuhan non-fungsional meliputi antarmuka yang responsif (_mobile-friendly_) dan waktu respon bot yang cepat.

### 3.2 Perancangan Database

Sistem menggunakan database MySQL dengan beberapa tabel utama. Tabel `users` menyimpan data pengguna yang login via Google (email, nama, foto profil). Tabel `paket_wisata` menyimpan data produk wisata (judul, harga, deskripsi) yang akan menjadi "pengetahuan" bagi bot. Tabel `chat_history` dirancang untuk menyimpan log percakapan dengan struktur kolom: `id`, `user_id` (foreign key), `message` (isi pesan), `sender` (pengirim: 'user' atau 'bot'), dan `created_at` (waktu kirim).

### 3.3 Alur Kerja Sistem Chatbot

Alur kerja dimulai ketika pengguna mengetik pesan di antarmuka web. JavaScript (_AJAX Fetch_) akan mengirim pesan tersebut ke server (Controller `ChatbotController`). Controller akan: (1) Menyimpan pesan user ke database, (2) Mengambil data paket wisata terbaru dari Model, (3) Menyusun prompt lengkap berisi instruksi + data wisata + pertanyaan user, (4) Mengirim prompt tersebut ke Google Gemini API, (5) Menerima jawaban AI, (6) Menyimpan jawaban AI ke database, dan (7) Mengembalikan jawaban ke tampilan web untuk dirender.

---

## BAB IV: IMPLEMENTASI DAN PEMBAHASAN

### 4.1 Implementasi Backend (ChatbotController)

Logika utama chatbot terdapat pada `ChatbotController.php`. Fungsi kunci dalam controller ini adalah `callGemini()`, yang bertugas melakukan permintaan HTTP (cURL) ke endpoint API Google Gemini. Di dalam fungsi ini, sistem menyisipkan "System Instruction" yang berbunyi: _"Kamu adalah Asisten Cerdas untuk Website Desa Wisata Banjaran. Prioritaskan menjawab pertanyaan tentang PAKET WISATA menggunakan data berikut..."_. Hal ini memastikan bahwa meskipun Gemini memiliki pengetahuan umum, ia akan memprioritaskan data lokal desa.

### 4.2 Implementasi Frontend (User Interface)

Antarmuka Chatbot dibangun menggunakan HTML dan CSS murni untuk memastikan desain yang ringan dan estetik. Jendela chat didesain melayang (_floating widget_) di pojok kanan bawah agar mudah diakses tanpa mengganggu konten utama. Logika interaktivitas ditangani oleh `chatbot.js`, yang mengatur fitur seperti: efek _typing_ (sedang mengetik), _auto-scroll_ ke pesan terakhir, rendering format teks (bold/paragraf) dari jawaban Markdown AI, dan pemuatan riwayat chat lama (`loadHistory`) saat widget dibuka.

### 4.3 Hasil Pengujian Chatbot

Pengujian dilakukan dengan metode _Black Box Testing_.

1.  **Skenario Tanya Paket:** Ketika pengguna bertanya _"Ada paket apa saja?"_, chatbot berhasil merespon dengan daftar paket wisata yang diambil real-time dari database, lengkap dengan harga.
2.  **Skenario Pengetahuan Umum:** Ketika pengguna bertanya _"Siapa penemu lampu?"_, chatbot berhasil menjawab dengan pengetahuan umumnya karena instruksi telah diatur untuk memperbolehkan pertanyaan umum.
3.  **Skenario Riwayat Chat:** Setelah pengguna me-refresh halaman, riwayat percakapan sebelumnya berhasil dimuat kembali secara utuh, membuktikan fitur _History Persistence_ berjalan dengan baik.
4.  **Handling Error:** Ketika API Key tidak valid atau kuota habis, sistem berhasil menampilkan pesan error yang informatif kepada pengguna alih-alih _crash_.

---

## BAB V: PENUTUP

### 5.1 Kesimpulan

Berdasarkan hasil perancangan dan implementasi, dapat disimpulkan bahwa:

1.  Website Desa Wisata Banjaran berhasil dibangun dengan fitur modern yang memadukan promosi pariwisata dan teknologi AI.
2.  Integrasi Google Gemini API terbukti efektif dalam menciptakan asisten virtual yang cerdas, responsif, dan kontekstual terhadap data wisata desa.
3.  Penyimpanan riwayat percakapan memberikan nilai tambah signifikan pada pengalaman pengguna (_User Experience_), menjadikan interaksi terasa lebih bersambung dan personal.

### 5.2 Saran

Untuk pengembangan sistem di masa depan, penulis menyarankan beberapa hal:

1.  Mengimplementasikan model AI berbayar (_Paid Tier_) untuk menghindari batasan kuota (_rate limit_) saat trafik pengguna tinggi.
2.  Menambahkan fitur input suara (_Voice Recognition_) agar interaksi dengan chatbot menjadi lebih mudah bagi pengguna mobile.
3.  Mengembangkan panel admin khusus untuk memantau transkrip percakapan bot guna mengevaluasi pertanyaan yang sering diajukan wisatawan.
