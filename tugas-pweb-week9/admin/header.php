<?php
// admin/header.php - Template Header Khusus Panel Admin
require_once __DIR__ . '/../includes/functions.php';

if (!isAdminLoggedIn()) {
    header('Location: login.php');
    exit;
}

if (!isset($admin_title)) {
    $admin_title = 'Panel Administrator | Simulasi SNBP/SNBT';
}
if (!isset($admin_active)) {
    $admin_active = 'dashboard';
}

$admin_user = $_SESSION['admin_name'] ?? 'Administrator';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title><?php echo htmlspecialchars($admin_title); ?></title>

<!-- Stylesheets -->
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../css/responsive.css" rel="stylesheet">

<!-- Favicon -->
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<link rel="icon" href="../images/favicon.ico" type="image/x-icon">

<!-- Responsive Meta -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&family=Rasa:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

<style>
/* Admin Custom Styles */
body {
    background-color: #F1F5F9;
    font-family: 'Assistant', sans-serif;
    color: #1E293B;
}
.admin-navbar {
    background-color: #181D37;
    border-bottom: 3px solid #F8B239;
    padding: 12px 0;
}
.admin-brand {
    display: flex;
    align-items: center;
    color: #FFFFFF;
    text-decoration: none;
}
.admin-brand:hover {
    color: #FFFFFF;
    text-decoration: none;
}
.admin-brand img {
    max-height: 40px;
    margin-right: 12px;
}
.admin-brand-text h4 {
    margin: 0;
    font-family: 'Rasa', serif;
    font-size: 20px;
    color: #FFFFFF;
    font-weight: 700;
}
.admin-brand-text span {
    font-size: 11px;
    color: #F8B239;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    font-weight: 600;
}
.admin-nav {
    display: flex;
    align-items: center;
    gap: 8px;
    list-style: none;
    margin: 0;
    padding: 0;
}
.admin-nav a {
    color: #CBD5E1;
    font-size: 14px;
    font-weight: 600;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.admin-nav a:hover, .admin-nav a.active {
    color: #181D37;
    background-color: #F8B239;
}
.admin-user-pill {
    background: rgba(255, 255, 255, 0.1);
    color: #E2E8F0;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.admin-card {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    margin-bottom: 24px;
    overflow: hidden;
}
.admin-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid #E2E8F0;
    background: #FFFFFF;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.admin-card-header h3 {
    margin: 0;
    font-family: 'Rasa', serif;
    font-size: 22px;
    color: #181D37;
    font-weight: 700;
}
.admin-card-body {
    padding: 20px;
}
.table-admin {
    width: 100%;
    margin-bottom: 0;
    font-size: 13.5px;
}
.table-admin th {
    background-color: #F8FAFC;
    color: #475569;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 0.03em;
    padding: 12px 14px;
    border-bottom: 2px solid #CBD5E1;
}
.table-admin td {
    padding: 12px 14px;
    vertical-align: middle;
    border-bottom: 1px solid #E2E8F0;
}
.table-admin tr:hover td {
    background-color: #F8FAFC;
}
.badge-status {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 700;
    text-align: center;
}
.badge-lulus {
    background-color: #DCFCE7;
    color: #15803D;
    border: 1px solid #86EFAC;
}
.badge-tidak-lulus {
    background-color: #FEE2E2;
    color: #B91C1C;
    border: 1px solid #FCA5A5;
}
.badge-menunggu {
    background-color: #FEF3C7;
    color: #B45309;
    border: 1px solid #FDE68A;
}
.badge-snbp {
    background-color: #EFF6FF;
    color: #1D4ED8;
    border: 1px solid #BFDBFE;
}
.badge-snbt {
    background-color: #FAF5FF;
    color: #7E22CE;
    border: 1px solid #E9D5FF;
}

/* Custom Cologne-Themed Admin Buttons */
.btn-admin-primary {
    background-color: #181D37;
    color: #FFFFFF !important;
    border: 1px solid #181D37;
    font-weight: 600;
    border-radius: 4px;
    padding: 8px 16px;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none !important;
}
.btn-admin-primary:hover, .btn-admin-primary:focus {
    background-color: #F8B239;
    color: #181D37 !important;
    border-color: #F8B239;
}
.btn-admin-warning {
    background-color: #F8B239;
    color: #181D37 !important;
    border: 1px solid #F8B239;
    font-weight: 700;
    border-radius: 4px;
    padding: 8px 16px;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none !important;
}
.btn-admin-warning:hover, .btn-admin-warning:focus {
    background-color: #181D37;
    color: #FFFFFF !important;
    border-color: #181D37;
}
</style>
</head>
<body>

<!-- Admin Navbar -->
<nav class="admin-navbar">
    <div class="container-fluid" style="padding: 0 30px;">
        <div class="row" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;">
            
            <!-- Brand -->
            <div class="col-md-4 col-sm-6">
                <a href="index.php" class="admin-brand">
                    <img src="../images/logo.png" alt="Logo">
                    <div class="admin-brand-text">
                        <h4>PANEL ADMINISTRATOR</h4>
                        <span>Simulasi SNBP & SNBT 2026</span>
                    </div>
                </a>
            </div>

            <!-- Nav Menus -->
            <div class="col-md-5 col-sm-6 text-center">
                <ul class="admin-nav" style="justify-content:center; flex-wrap:wrap;">
                    <li>
                        <a href="index.php" class="<?php echo ($admin_active === 'dashboard') ? 'active' : ''; ?>">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="peserta.php" class="<?php echo ($admin_active === 'peserta') ? 'active' : ''; ?>">
                            <i class="fa fa-users"></i> Kelola Peserta
                        </a>
                    </li>
                    <li>
                        <a href="pengumuman.php" class="<?php echo ($admin_active === 'pengumuman') ? 'active' : ''; ?>">
                            <i class="fa fa-bullhorn"></i> Kelola Pengumuman
                        </a>
                    </li>
                </ul>
            </div>

            <!-- User Info & Action -->
            <div class="col-md-3 col-sm-12 text-right">
                <div style="display:inline-flex; align-items:center; gap:12px;">
                    <a href="../index.php" target="_blank" class="btn btn-sm btn-default" title="Buka website publik di tab baru" style="border-radius:4px; font-size:12px;">
                        <i class="fa fa-external-link"></i> Web Publik
                    </a>
                    <a href="logout.php" class="btn btn-sm btn-danger" style="border-radius:4px; font-size:12px; font-weight:600;" onclick="return confirm('Apakah Anda yakin ingin keluar dari panel admin?');">
                        <i class="fa fa-sign-out"></i> Logout
                    </a>
                </div>
            </div>

        </div>
    </div>
</nav>

<!-- Page Header Bar -->
<div style="background:#FFFFFF; border-bottom:1px solid #E2E8F0; padding:18px 0; margin-bottom:25px;">
    <div class="container-fluid" style="padding: 0 30px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
            <div>
                <span style="font-size:12px; color:#64748B; text-transform:uppercase; font-weight:700; letter-spacing:0.04em;">Manajemen Simulasi SNBP/SNBT</span>
                <h2 style="font-family:'Rasa',serif; font-size:26px; color:#181D37; margin:2px 0 0 0; font-weight:700;">
                    <?php echo htmlspecialchars($admin_heading ?? $admin_title); ?>
                </h2>
            </div>
        </div>
    </div>
</div>

