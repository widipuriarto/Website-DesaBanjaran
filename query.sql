CREATE DATABASE pwl_project;
USE pwl_project;

-- users (admin & member)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  PASSWORD VARCHAR(255) NOT NULL,
  role ENUM('admin','member') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE users ADD email VARCHAR(255) AFTER username;
ALTER TABLE users ADD NAME VARCHAR(100) AFTER id;


INSERT INTO users (username, PASSWORD, role) VALUES
('admin', MD5('admin123'), 'admin'),
('warga01', MD5('member123'), 'member');

-- members (profil)
CREATE TABLE members (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNIQUE,
  NAME VARCHAR(100),
  email VARCHAR(100),
  phone VARCHAR(20),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO members (user_id, NAME, email, phone) VALUES
(2, 'Siti Nur', 'siti@example.com', '081234567890');

-- paket_wisata
CREATE TABLE paket_wisata (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  description TEXT,
  price INT,
  duration VARCHAR(50),
  min_person INT,
  image VARCHAR(150),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO paket_wisata (title, description, price, duration, min_person, image) VALUES
('Paket Camping', 'Camping di tepi Kali Klawing dengan fasilitas lengkap', 60000, '3D2N', 10, 'camping.jpg'),
('Paket Outbound', 'Outbound menyenangkan untuk grup & anak-anak', 120000, '1D', 20, 'outbound.jpg'),;
('Paket Makrab', 'Malam Keakraban bersama komunitas dengan api unggun', 70000, '3D2N', 30, 'makrab.jpg');


-- galeri
CREATE TABLE galeri (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  image VARCHAR(150),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO galeri (title, image) VALUES
('Sunset di Klawing', 'sunset.jpg'),
('Bendung Slinga', 'bendung.jpg'),
('Kesenian Kuda Lumping', 'kudalumping.jgp');


-- videos
CREATE TABLE videos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  youtube_url VARCHAR(200),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO videos (title, youtube_url) VALUES
('Virtual Tour Desa Banjaran', 'https://youtu.be/NhLC1qXKYfg');


-- pesan
CREATE TABLE pesan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  NAME VARCHAR(100),
  email VARCHAR(100),
  SUBJECT VARCHAR(150),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO pesan (NAME, email, SUBJECT, message) VALUES
('Andi', 'andi@example.com', 'Inquiry Paket', 'Saya ingin tahu harga untuk 15 orang.');


-- transaksi
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    paket_id INT,
    tanggal_pemesanan DATE,
    jumlah_orang INT,
    total_harga INT,
    STATUS ENUM('pending','dibayar','selesai','batal') DEFAULT 'pending',
    metode_pembayaran VARCHAR(50),
    bukti_pembayaran VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (member_id) REFERENCES members(id),
    FOREIGN KEY (paket_id) REFERENCES paket_wisata(id)
);

INSERT INTO transaksi (member_id, paket_id, tanggal_pemesanan, jumlah_orang, total_harga, STATUS, metode_pembayaran)
VALUES
(1, 1, '2025-07-15', 10, 600000, 'pending', 'Transfer Bank');

DROP TABLE users;
DROP TABLE members;
DROP TABLE transaksi;
DROP TABLE galeri;
DROP TABLE paket_wisata;
DROP TABLE pesan;
DROP TABLE videos;
