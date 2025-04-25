<?php
include 'koneksi.php';

// --- CREATE ---
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $gambar = $_POST['gambar'];
    $link = $_POST['link'];

    mysqli_query($koneksi, "INSERT INTO produk (nama, gambar, link) VALUES ('$nama', '$gambar', '$link')");
    header("Location: utama.php");
    exit;
}

// --- UPDATE ---
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $gambar = $_POST['gambar'];
    $link = $_POST['link'];

    mysqli_query($koneksi, "UPDATE produk SET nama='$nama', gambar='$gambar', link='$link' WHERE id=$id");
    header("Location: utama.php");
    exit;
}

// --- DELETE ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM produk WHERE id=$id");
    header("Location: utama.php");
    exit;
}

// --- TAMPILKAN FORM EDIT JIKA ADA PARAMETER EDIT ---
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id");
    $row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="utama.css?v=<?= time(); ?>">
</head>
<body>
<div class="blur-bg">
    <div class="header" style="position: relative; z-index: 1;">
        <div class="header-left">
            <h1>Edit Produk</h1>
        </div>
        <div class="header-right">
        <a href="utama.php" class="btn-kembali">Kembali ke Halaman Utama</a>
        </div>
    </div>

    <div class="container" style="position: relative; z-index: 1; padding: 20px;">
        <div class="data-box login-box">
            <h2>Edit Produk</h2>
            <form action="proses.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <div class="form-group">
                    <input type="text" name="nama" value="<?= $row['nama'] ?>" required placeholder="Nama Produk">
                </div>
                <div class="form-group">
                    <input type="text" name="gambar" value="<?= $row['gambar'] ?>" required placeholder="Nama File Gambar">
                </div>
                <div class="form-group">
                    <input type="text" name="link" value="<?= $row['link'] ?>" required placeholder="Link Produk">
                </div>
                <div class="form-group">
                    <button type="submit" name="update">Update Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

<?php
    exit; // berhenti agar tidak lanjut ke proses lain
}
?>
