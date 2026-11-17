-- Database: simulasi_snbp_snbt
-- Dibuat untuk Tugas Pemrograman Web - Simulasi Pendaftaran & Pengumuman SNBP/SNBT

CREATE DATABASE IF NOT EXISTS `simulasi_snbp_snbt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `simulasi_snbp_snbt`;

-- 1. Tabel Admin
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `nama_lengkap` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password default: admin123 (hash bcrypt dari password_hash)
INSERT INTO `admin_users` (`username`, `password`, `nama_lengkap`) VALUES
('admin', '$2y$12$ceOMLrBpXSegiX/6qdnOduJbYAIj3VkcPhJIQe1bp66N.vT0SpXay', 'Admin');

-- 2. Tabel Program Studi
DROP TABLE IF EXISTS `program_studi`;
CREATE TABLE `program_studi` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kode_prodi` VARCHAR(10) NOT NULL UNIQUE,
  `nama_prodi` VARCHAR(100) NOT NULL,
  `jenjang` VARCHAR(10) DEFAULT 'S1',
  `kategori` ENUM('Saintek', 'Soshum') NOT NULL,
  `kuota` INT DEFAULT 50,
  `akreditasi` VARCHAR(10) DEFAULT 'Unggul'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `program_studi` (`kode_prodi`, `nama_prodi`, `jenjang`, `kategori`, `kuota`, `akreditasi`) VALUES
('TIF01', 'Teknik Informatika', 'S1', 'Saintek', 60, 'Unggul'),
('SIF02', 'Sistem Informasi', 'S1', 'Saintek', 50, 'A'),
('KED03', 'Kedokteran', 'S1', 'Saintek', 45, 'Unggul'),
('TS04', 'Teknik Sipil', 'S1', 'Saintek', 55, 'A'),
('FAR05', 'Farmasi', 'S1', 'Saintek', 40, 'A'),
('MAN06', 'Manajemen', 'S1', 'Soshum', 75, 'Unggul'),
('ILK07', 'Ilmu Komunikasi', 'S1', 'Soshum', 65, 'A'),
('HUK08', 'Ilmu Hukum', 'S1', 'Soshum', 80, 'Unggul'),
('AKT09', 'Akuntansi', 'S1', 'Soshum', 70, 'Unggul'),
('PSI10', 'Psikologi', 'S1', 'Soshum', 50, 'A');

-- 3. Tabel Peserta & Pendaftaran
DROP TABLE IF EXISTS `peserta`;
CREATE TABLE `peserta` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nomor_peserta` VARCHAR(30) NOT NULL UNIQUE,
  `nama_lengkap` VARCHAR(120) NOT NULL,
  `nisn` VARCHAR(15) NOT NULL,
  `asal_sekolah` VARCHAR(150) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `jalur_seleksi` ENUM('SNBP', 'SNBT') NOT NULL,
  `pilihan_1` VARCHAR(100) NOT NULL,
  `pilihan_2` VARCHAR(100) NOT NULL,
  `status_hasil` ENUM('Menunggu', 'Lulus', 'Tidak Lulus') DEFAULT 'Menunggu',
  `prodi_diterima` VARCHAR(100) DEFAULT NULL,
  `pesan_hasil` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Contoh Demo (Seed Data) untuk Dosen / Penguji
INSERT INTO `peserta` (`nomor_peserta`, `nama_lengkap`, `nisn`, `asal_sekolah`, `email`, `jalur_seleksi`, `pilihan_1`, `pilihan_2`, `status_hasil`, `prodi_diterima`, `pesan_hasil`) VALUES
('SNBP-2026-001', 'Ahmad Pratama', '0054321980', 'SMAN 1 Surabaya', 'ahmad.pratama@example.com', 'SNBP', 'Teknik Informatika', 'Sistem Informasi', 'Lulus', 'Teknik Informatika', 'Selamat! Anda dinyatakan LULUS Seleksi Nasional Berdasarkan Prestasi (SNBP) Tahun 2026.'),
('SNBT-2026-002', 'Siti Nurhaliza', '0061234567', 'SMAN 3 Malang', 'siti.nurhaliza@example.com', 'SNBT', 'Kedokteran', 'Farmasi', 'Tidak Lulus', NULL, 'Mohon maaf, Anda belum berhasil pada Seleksi Nasional Berdasarkan Tes (SNBT) Tahun 2026. Jangan patah semangat, masih ada seleksi jalur mandiri.'),
('SNBP-2026-003', 'Budi Santoso', '0049876543', 'SMAN 2 Bandung', 'budi.santoso@example.com', 'SNBP', 'Manajemen', 'Ilmu Hukum', 'Menunggu', NULL, 'Hasil seleksi Anda saat ini masih dalam proses verifikasi dan penilaian portofolio/rapor. Harap cek kembali secara berkala.'),
('SNBT-2026-004', 'Dewi Lestari', '0058765432', 'SMA Labschool Jakarta', 'dewi.lestari@example.com', 'SNBT', 'Ilmu Komunikasi', 'Psikologi', 'Lulus', 'Ilmu Komunikasi', 'Selamat! Anda dinyatakan LULUS Seleksi Nasional Berdasarkan Tes (SNBT) Tahun 2026.');

-- 4. Tabel Jadwal Tahapan
DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kegiatan` VARCHAR(150) NOT NULL,
  `jalur` VARCHAR(20) NOT NULL,
  `tanggal_mulai` DATE NOT NULL,
  `tanggal_selesai` DATE NOT NULL,
  `keterangan` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `jadwal` (`kegiatan`, `jalur`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`) VALUES
('Registrasi Akun Siswa Simulasi', 'SNBP & SNBT', '2026-01-08', '2026-02-15', 'Wajib bagi seluruh calon pendaftar'),
('Pengisian Pilihan Program Studi', 'SNBP', '2026-02-14', '2026-02-28', 'Pendaftaran jalur prestasi nilai rapor'),
('Pendaftaran UTBK-SNBT Simulasi', 'SNBT', '2026-03-21', '2026-04-05', 'Pendaftaran tes tulis berbasis komputer'),
('Pengumuman Hasil SNBP Simulasi', 'SNBP', '2026-03-26', '2026-03-26', 'Pengecekan hasil via portal simulasi'),
('Pelaksanaan UTBK Gelombang 1', 'SNBT', '2026-04-30', '2026-05-07', 'Sesi ujian simulasi'),
('Pengumuman Hasil SNBT Simulasi', 'SNBT', '2026-06-13', '2026-06-13', 'Pengecekan hasil skor dan kelulusan');

