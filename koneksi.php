<?php
$host = "localhost";
$user = "admin"; // Ubah sesuai konfigurasi MySQL kamu
$pass = "";
$db = "shop";

// Koneksi ke server
$koneksi = new mysqli($host, $user, $pass);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Buat database jika belum ada
$koneksi->query("CREATE DATABASE IF NOT EXISTS $db");

// Gunakan database
$koneksi->select_db($db);

// Buat tabel produk
$koneksi->query("CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255),
    gambar VARCHAR(255),
    link VARCHAR(255)
)");

// Buat tabel users
$koneksi->query("CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
)");

// Tambahkan akun admin jika belum ada
$cekAdmin = $koneksi->query("SELECT * FROM user WHERE username = 'admin'");
if ($cekAdmin->num_rows === 0) {
    $koneksi->query("INSERT INTO user (username, password, role)
                     VALUES ('admin', MD5('admin123'), 'admin')");
}
?>
