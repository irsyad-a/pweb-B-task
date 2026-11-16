<?php
// config/database.php - Koneksi Basis Data MySQL (phpMyAdmin / XAMPP / Laragon)

$host     = '127.0.0.1';
$dbname   = 'simulasi_snbp_snbt';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    $pdo = null;
    $db_error = $e->getMessage();
}

function getDatabaseConnection() {
    global $pdo, $db_error;
    if ($pdo === null) {
        die("<div style='font-family:Arial,sans-serif; padding:30px; max-width:650px; margin:60px auto; background:#ffffff; border:2px solid #e2e8f0; border-top:4px solid #b91c1c; border-radius:6px; box-shadow:0 8px 30px rgba(0,0,0,0.08); color:#1e293b;'>
            <h3 style='margin-top:0; color:#b91c1c; font-size:22px;'>Koneksi Database MySQL Belum Aktif</h3>
            <p style='font-size:15px; line-height:1.6;'>Aplikasi ini menggunakan basis data <strong>MySQL</strong> yang dikelola melalui <strong>phpMyAdmin</strong> pada <strong>XAMPP</strong> atau <strong>Laragon</strong>.</p>
            <ol style='font-size:14px; line-height:1.7; padding-left:20px; color:#475569;'>
                <li>Buka control panel <strong>XAMPP</strong> atau <strong>Laragon</strong> Anda.</li>
                <li>Pastikan modul <strong>Apache</strong> dan <strong>MySQL</strong> sudah berstatus <em>Running</em> (aktif).</li>
                <li>Buka browser ke <a href='http://localhost/phpmyadmin' target='_blank' style='color:#2563eb; font-weight:600;'>http://localhost/phpmyadmin</a>.</li>
                <li>Buat database baru dengan nama <code>simulasi_snbp_snbt</code>.</li>
                <li>Pilih menu <strong>Import</strong> dan unggah file <code>database.sql</code> dari folder proyek ini.</li>
            </ol>
            <div style='margin-top:15px; padding:10px 14px; background:#f8fafc; border:1px solid #cbd5e1; border-radius:4px; font-size:12px; color:#64748b;'>
                Pesan teknis MySQL: " . htmlspecialchars($db_error ?? '') . "
            </div>
        </div>");
    }
    return $pdo;
}

function isDatabaseConnected() {
    global $pdo;
    return ($pdo !== null);
}
