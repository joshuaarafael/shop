<?php
session_start();
include 'koneksi.php';

// Proteksi: hanya user yang sudah login yang boleh akses
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Cek jika ada parameter 'welcome' di query string
$showWelcome = isset($_GET['welcome']) && $_GET['welcome'] == 1;
$username = isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="utama.css?v=<?= time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js?v=<?= time(); ?>"></script>
</head>
<!-- Tambahkan data-show-welcome dan data-username ke body -->
<body data-show-welcome="<?= $showWelcome ? 'true' : 'false' ?>" data-username="<?= $username ?>">

<div class="blur-bg">
    <div class="header" style="position: relative; z-index: 1;">
        <div class="header-left">
            <h1>Produk Saya</h1>
        </div>
        <div class="header-right">
            <button id="logout-btn">Logout</button>
        </div>
    </div>

    <!-- Kotak pesan sambutan -->
    <div class="login-success-message" style="display: none; position: fixed; top: 20px; right: 20px; background-color: #4CAF50; color: white; padding: 15px 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); font-size: 16px; z-index: 9999;">
        Berhasil login, selamat datang <span id="username-placeholder"></span>!
    </div>

    <div class="user-profile-box">
        <h2>Selamat datang, <?= $username ?>!</h2>
    </div>

    <div class="container" style="position: relative; z-index: 1; padding: 20px;">
        <div class="data-box login-box" style="margin-bottom: 30px;">
            <h2>Tambah Produk</h2>
            <form action="proses.php" method="POST">
                <div class="form-group">
                    <input type="text" name="nama" placeholder="Nama Produk" required>
                </div>
                <div class="form-group">
                    <input type="text" name="gambar" placeholder="Nama File Gambar (contoh.jpg)" required>
                </div>
                <div class="form-group">
                    <input type="text" name="link" placeholder="Link Produk" required>
                </div>
                <button type="submit" name="tambah">Tambah</button>
            </form>
        </div>

        <div class="data-box login-box">
            <h2>Daftar Produk</h2>
            <div class="product-grid" style="display: flex; flex-wrap: wrap; gap: 20px;">
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM produk");
                while ($row = mysqli_fetch_assoc($result)):
                ?>
                <div class="product-card" style="background: #ffffffcc; backdrop-filter: blur(4px); padding: 20px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; width: 250px; animation: fadeInUp 1s ease;">
                    <img src="images/<?= $row['gambar'] ?>" alt="<?= $row['nama'] ?>" style="max-width: 100%; border-radius: 8px;">
                    <h3><?= $row['nama'] ?></h3>
                    <a href="<?= $row['link'] ?>" target="_blank">Lihat Detail</a><br><br>
                    <a href="proses.php?edit=<?= $row['id'] ?>">Edit</a> |
                    <a href="proses.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
