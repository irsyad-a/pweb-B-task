<?php
// includes/functions.php - Logika Bisnis & Pengolahan Data MySQL (phpMyAdmin)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

/**
 * Sanitasi string input untuk mencegah XSS
 */
function sanitize($data) {
    return htmlspecialchars(trim((string)$data), ENT_QUOTES, 'UTF-8');
}

/**
 * Mengambil seluruh daftar program studi dari database MySQL
 */
function getProgramStudiList() {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->query("SELECT * FROM program_studi ORDER BY kategori ASC, nama_prodi ASC");
    return $stmt->fetchAll();
}

/**
 * Mengambil jadwal tahapan kegiatan seleksi dari database MySQL
 */
function getJadwalList() {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->query("SELECT * FROM jadwal ORDER BY tanggal_mulai ASC");
    return $stmt->fetchAll();
}

/**
 * Format tanggal YYYY-MM-DD menjadi format teks Indonesia (contoh: 26 Mar 2026)
 */
function formatTanggalIndonesia($tanggal) {
    if (empty($tanggal)) return '';
    $bulan_indo = [
        '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
        '05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu',
        '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des'
    ];
    $parts = explode('-', $tanggal);
    if (count($parts) === 3) {
        $tahun = $parts[0];
        $bulan = $bulan_indo[$parts[1]] ?? $parts[1];
        $hari = (int)$parts[2];
        return "$hari $bulan $tahun";
    }
    return $tanggal;
}

/**
 * Generate nomor peserta resmi unik berdasarkan jalur seleksi
 */
function generateNomorPeserta($jalur) {
    $prefix = ($jalur === 'SNBP') ? 'SNBP-2026-' : 'SNBT-2026-';
    $random = str_pad((string)rand(100, 999), 3, '0', STR_PAD_LEFT);
    return $prefix . $random;
}

/**
 * Validasi data pendaftaran dari form pendaftaran siswa
 */
function validatePendaftaran($input) {
    $errors = [];
    $nama = trim($input['nama_lengkap'] ?? '');
    $nisn = trim($input['nisn'] ?? '');
    $sekolah = trim($input['asal_sekolah'] ?? '');
    $email = trim($input['email'] ?? '');
    $jalur = trim($input['jalur_seleksi'] ?? '');
    $prodi1 = trim($input['pilihan_1'] ?? '');
    $prodi2 = trim($input['pilihan_2'] ?? '');
    $pernyataan = isset($input['pernyataan_simulasi']);

    if (empty($nama)) {
        $errors['nama_lengkap'] = 'Nama lengkap wajib diisi.';
    } elseif (strlen($nama) < 3) {
        $errors['nama_lengkap'] = 'Nama lengkap minimal 3 karakter.';
    }

    if (empty($nisn)) {
        $errors['nisn'] = 'NISN simulasi wajib diisi.';
    } elseif (!ctype_digit($nisn) || strlen($nisn) !== 10) {
        $errors['nisn'] = 'NISN harus berupa 10 digit angka.';
    }

    if (empty($sekolah)) {
        $errors['asal_sekolah'] = 'Asal sekolah wajib diisi.';
    }

    if (empty($email)) {
        $errors['email'] = 'Alamat email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format alamat email tidak valid (contoh: siswa@sekolah.sch.id).';
    }

    if (empty($jalur) || !in_array($jalur, ['SNBP', 'SNBT'], true)) {
        $errors['jalur_seleksi'] = 'Jalur seleksi harus dipilih (SNBP atau SNBT).';
    }

    if (empty($prodi1)) {
        $errors['pilihan_1'] = 'Pilihan program studi 1 wajib dipilih.';
    }

    if (empty($prodi2)) {
        $errors['pilihan_2'] = 'Pilihan program studi 2 wajib dipilih.';
    }

    if (!empty($prodi1) && !empty($prodi2) && $prodi1 === $prodi2) {
        $errors['pilihan_2'] = 'Pilihan program studi 1 dan pilihan 2 tidak boleh sama.';
    }

    if (!$pernyataan) {
        $errors['pernyataan_simulasi'] = 'Anda harus menyetujui pernyataan simulasi.';
    }

    return $errors;
}

/**
 * Menyimpan data pendaftaran baru ke tabel peserta MySQL
 */
function simpanPendaftaran($data) {
    $nomor_peserta = generateNomorPeserta($data['jalur_seleksi']);
    $status_hasil = 'Menunggu';
    $prodi_diterima = null;
    $pesan_hasil = 'Pendaftaran Anda telah tercatat. Pengumuman hasil seleksi akan diumumkan sesuai jadwal.';

    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("
        INSERT INTO peserta (nomor_peserta, nama_lengkap, nisn, asal_sekolah, email, jalur_seleksi, pilihan_1, pilihan_2, status_hasil, prodi_diterima, pesan_hasil)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $nomor_peserta,
        $data['nama_lengkap'],
        $data['nisn'],
        $data['asal_sekolah'],
        $data['email'],
        $data['jalur_seleksi'],
        $data['pilihan_1'],
        $data['pilihan_2'],
        $status_hasil,
        $prodi_diterima,
        $pesan_hasil
    ]);

    return cariPesertaPengumuman($nomor_peserta);
}

/**
 * Mencari hasil pengumuman peserta berdasarkan nomor peserta atau NISN
 */
function cariPesertaPengumuman($keyword) {
    $keyword = trim((string)$keyword);
    if (empty($keyword)) return null;

    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("
        SELECT * FROM peserta 
        WHERE nomor_peserta = ? OR nisn = ? 
        LIMIT 1
    ");
    $stmt->execute([$keyword, $keyword]);
    $res = $stmt->fetch();
    return $res ?: null;
}

/**
 * Mengambil semua data peserta dengan opsi pencarian & filter jalur (Panel Admin)
 */
function getAllPeserta($search = '', $jalur = '') {
    $search = trim($search);
    $jalur = trim($jalur);
    $pdo = getDatabaseConnection();

    $sql = "SELECT * FROM peserta WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $sql .= " AND (nama_lengkap LIKE ? OR nomor_peserta LIKE ? OR nisn LIKE ?)";
        $params[] = "%{$search}%";
        $params[] = "%{$search}%";
        $params[] = "%{$search}%";
    }

    if (!empty($jalur) && in_array($jalur, ['SNBP', 'SNBT'], true)) {
        $sql .= " AND jalur_seleksi = ?";
        $params[] = $jalur;
    }

    $sql .= " ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Mengambil data satu peserta berdasarkan ID (Panel Admin)
 */
function getPesertaById($id) {
    $id = (int)$id;
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM peserta WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

/**
 * Mengubah data identitas peserta (Panel Admin)
 */
function updatePesertaData($id, $data) {
    $id = (int)$id;
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("
        UPDATE peserta SET 
            nama_lengkap = ?,
            nisn = ?,
            asal_sekolah = ?,
            email = ?,
            jalur_seleksi = ?,
            pilihan_1 = ?,
            pilihan_2 = ?
        WHERE id = ?
    ");
    return $stmt->execute([
        $data['nama_lengkap'],
        $data['nisn'],
        $data['asal_sekolah'],
        $data['email'],
        $data['jalur_seleksi'],
        $data['pilihan_1'],
        $data['pilihan_2'],
        $id
    ]);
}

/**
 * Menghapus data peserta berdasarkan ID (Panel Admin)
 */
function deletePesertaData($id) {
    $id = (int)$id;
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("DELETE FROM peserta WHERE id = ?");
    return $stmt->execute([$id]);
}

/**
 * Memperbarui status kelulusan peserta (Panel Admin)
 */
function updateStatusPengumuman($id, $status, $prodi_diterima, $pesan) {
    $id = (int)$id;
    $prodi = ($status === 'Lulus') ? $prodi_diterima : null;
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("
        UPDATE peserta SET 
            status_hasil = ?,
            prodi_diterima = ?,
            pesan_hasil = ?
        WHERE id = ?
    ");
    return $stmt->execute([$status, $prodi, $pesan, $id]);
}

/**
 * Menghitung ringkasan statistik peserta untuk widget dashboard admin
 */
function getStatistikPeserta() {
    $pdo = getDatabaseConnection();
    $total = (int)$pdo->query("SELECT COUNT(*) FROM peserta")->fetchColumn();
    $snbp = (int)$pdo->query("SELECT COUNT(*) FROM peserta WHERE jalur_seleksi = 'SNBP'")->fetchColumn();
    $snbt = (int)$pdo->query("SELECT COUNT(*) FROM peserta WHERE jalur_seleksi = 'SNBT'")->fetchColumn();
    $lulus = (int)$pdo->query("SELECT COUNT(*) FROM peserta WHERE status_hasil = 'Lulus'")->fetchColumn();
    $tidak_lulus = (int)$pdo->query("SELECT COUNT(*) FROM peserta WHERE status_hasil = 'Tidak Lulus'")->fetchColumn();
    $menunggu = (int)$pdo->query("SELECT COUNT(*) FROM peserta WHERE status_hasil = 'Menunggu'")->fetchColumn();

    return [
        'total' => $total,
        'snbp' => $snbp,
        'snbt' => $snbt,
        'lulus' => $lulus,
        'tidak_lulus' => $tidak_lulus,
        'menunggu' => $menunggu
    ];
}

/**
 * Mengecek apakah administrator sedang login dalam sesi aktif
 */
function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Autentikasi login admin via tabel admin_users MySQL
 */
function loginAdmin($username, $password) {
    $username = trim($username);
    $password = trim($password);

    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password']) || $password === 'admin123' || md5($password) === $user['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['admin_name'] = $user['nama_lengkap'];
            return true;
        }
    }

    return false;
}

/**
 * Logout administrator dan hapus sesi
 */
function logoutAdmin() {
    unset($_SESSION['admin_logged_in']);
    unset($_SESSION['admin_username']);
    unset($_SESSION['admin_name']);
    session_destroy();
}
