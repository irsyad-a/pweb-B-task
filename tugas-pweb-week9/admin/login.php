<?php
// admin/login.php - Halaman Masuk Administrator
require_once __DIR__ . '/../includes/functions.php';

// Jika sudah login, langsung alihkan ke dashboard
if (isAdminLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error_message = '';
$username_input = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_input = sanitize($_POST['username'] ?? '');
    $password_input = $_POST['password'] ?? '';

    if (empty($username_input) || empty($password_input)) {
        $error_message = 'Username dan kata sandi wajib diisi.';
    } else {
        if (loginAdmin($username_input, $password_input)) {
            header('Location: index.php');
            exit;
        } else {
            $error_message = 'Kombinasi username atau kata sandi tidak valid.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Login Administrator | Simulasi SNBP/SNBT</title>

<!-- Stylesheets -->
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../css/responsive.css" rel="stylesheet">

<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<link rel="icon" href="../images/favicon.ico" type="image/x-icon">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&family=Rasa:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

<style>
body {
    background-color: #181D37;
    font-family: 'Assistant', sans-serif;
    color: #1E293B;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px 15px;
}
.login-box {
    width: 100%;
    max-width: 440px;
    background: #FFFFFF;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    border-top: 5px solid #F8B239;
}
.login-header {
    background: #FFFFFF;
    padding: 35px 30px 20px 30px;
    text-align: center;
    border-bottom: 1px solid #F1F5F9;
}
.login-header img {
    max-height: 48px;
    margin-bottom: 12px;
}
.login-header h2 {
    font-family: 'Rasa', serif;
    font-size: 26px;
    font-weight: 700;
    color: #181D37;
    margin: 0 0 4px 0;
}
.login-header p {
    font-size: 13px;
    color: #64748B;
    margin: 0;
}
.login-body {
    padding: 30px;
}
.form-group label {
    font-weight: 600;
    font-size: 14px;
    color: #181D37;
    margin-bottom: 6px;
    display: block;
}
.form-control {
    height: 46px;
    border: 1px solid #CBD5E1;
    border-radius: 6px;
    padding: 0 14px;
    font-size: 14px;
    box-shadow: none;
    transition: border-color 0.2s ease;
}
.form-control:focus {
    border-color: #F8B239;
    box-shadow: 0 0 0 3px rgba(248, 178, 57, 0.2);
}
.demo-badge {
    background: #EFF6FF;
    border: 1px dashed #93C5FD;
    padding: 12px 14px;
    border-radius: 6px;
    font-size: 12.5px;
    color: #1E3A8A;
    margin-top: 20px;
}
.demo-badge code {
    background: #DBEAFE;
    color: #1E40AF;
    padding: 2px 5px;
    border-radius: 3px;
}
.btn-login-submit {
    width: 100%;
    height: 48px;
    background: #F8B239;
    color: #181D37;
    font-family: 'Rasa', serif;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.btn-login-submit:hover {
    background: #181D37;
    color: #FFFFFF;
}
</style>
</head>
<body>

<div class="login-box">
    <div class="login-header">
        <a href="../index.php">
            <img src="../images/logo.png" alt="Logo SNBP SNBT">
        </a>
        <h2>Masuk Administrator</h2>
        <p>Panel Manajemen Simulasi Pendaftaran & Pengumuman</p>
    </div>

    <div class="login-body">
        
        <?php if (isset($_GET['logout'])): ?>
            <div style="background:#DCFCE7; border-left:4px solid #15803D; padding:12px 14px; border-radius:4px; margin-bottom:20px; font-size:13.5px; color:#166534;">
                <i class="fa fa-check-circle"></i> Anda telah berhasil keluar dari sistem.
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div style="background:#FEE2E2; border-left:4px solid #B91C1C; padding:12px 14px; border-radius:4px; margin-bottom:20px; font-size:13.5px; color:#991B1B;">
                <i class="fa fa-exclamation-circle"></i> <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group" style="margin-bottom:20px;">
                <label for="username"><i class="fa fa-user" style="color:#64748B; margin-right:6px;"></i> Username</label>
                <input type="text" id="username" name="username" class="form-control" 
                       placeholder="Masukkan username admin" required autofocus
                       value="<?php echo htmlspecialchars($username_input); ?>">
            </div>

            <div class="form-group" style="margin-bottom:25px;">
                <label for="password"><i class="fa fa-lock" style="color:#64748B; margin-right:6px;"></i> Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control" 
                       placeholder="Masukkan kata sandi" required>
            </div>

            <button type="submit" class="btn-login-submit">
                <i class="fa fa-sign-in"></i> MASUK KE PANEL
            </button>
        </form>

        <!-- Akun Demo untuk Penguji -->
        <div class="demo-badge">
            <strong style="display:block; margin-bottom:4px;"><i class="fa fa-key"></i> Kredensial Pengujian (Demo):</strong>
            Username: <code>admin</code> &bull; Password: <code>admin123</code>
        </div>

        <div style="text-align:center; margin-top:24px; font-size:13px;">
            <a href="../index.php" style="color:#64748B; text-decoration:none;">
                &larr; Kembali ke Beranda Simulasi
            </a>
        </div>
    </div>
</div>

</body>
</html>

