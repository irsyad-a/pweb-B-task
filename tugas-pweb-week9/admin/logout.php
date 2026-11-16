<?php
// admin/logout.php - Logout Admin & Hapus Sesi
require_once __DIR__ . '/../includes/functions.php';

logoutAdmin();

header('Location: login.php?logout=1');
exit;

