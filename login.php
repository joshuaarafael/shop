<?php
session_start();
include 'koneksi.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $_SESSION['user'] = mysqli_fetch_assoc($result);
        // Redirect ke utama.php dengan pesan sambutan di query string
        header('Location: utama.php?welcome=1&username=' . urlencode($username));
        exit;
    } else {
        $_SESSION['login_error'] = true;
        $error = "Username atau Password salah!";
    }
}

$hasError = false;
if (isset($_SESSION['login_error'])) {
    $hasError = true;
    unset($_SESSION['login_error']);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Admin</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js?v=<?= time(); ?>"></script>
</head>
<body data-error="<?= $hasError ? 'true' : 'false' ?>">
<div class="blur-bg"></div>

<div class="login-container">
    <div class="login-box<?= !$hasError ? ' animated' : '' ?>">
        <h2>Login Akun</h2>
        <?php if ($error): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="" id="loginForm">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group password-wrapper">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <img src="img/eye.png" id="togglePassword" class="toggle-password" alt="Tampilkan Password">
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
