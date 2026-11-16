<?php
// pendaftaran.php - Formulir Pendaftaran Seleksi SNBP & SNBT 2026
require_once __DIR__ . '/includes/functions.php';

$page_title = 'cologne-education | Formulir Pendaftaran SNBP & SNBT 2026';
$active_menu = 'pendaftaran';
$prodi_list = getProgramStudiList();

$errors = [];
$form_data = [
    'nama_lengkap' => '',
    'nisn' => '',
    'asal_sekolah' => '',
    'email' => '',
    'jalur_seleksi' => 'SNBP',
    'pilihan_1' => '',
    'pilihan_2' => '',
    'pernyataan_simulasi' => false,
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_data['nama_lengkap'] = sanitize($_POST['nama_lengkap'] ?? '');
    $form_data['nisn'] = sanitize($_POST['nisn'] ?? '');
    $form_data['asal_sekolah'] = sanitize($_POST['asal_sekolah'] ?? '');
    $form_data['email'] = sanitize($_POST['email'] ?? '');
    $form_data['jalur_seleksi'] = sanitize($_POST['jalur_seleksi'] ?? '');
    $form_data['pilihan_1'] = sanitize($_POST['pilihan_1'] ?? '');
    $form_data['pilihan_2'] = sanitize($_POST['pilihan_2'] ?? '');
    $form_data['pernyataan_simulasi'] = isset($_POST['pernyataan_simulasi']);

    $errors = validatePendaftaran($form_data);

    if (empty($errors)) {
        $saved = simpanPendaftaran($form_data);
        if ($saved) {
            $_SESSION['last_registered_nomor'] = $saved['nomor_peserta'];
            header('Location: ringkasan.php?nomor=' . urlencode($saved['nomor_peserta']));
            exit;
        } else {
            $errors['system'] = 'Terjadi kesalahan sistem saat menyimpan pendaftaran.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<style>
/* Scoped Styling for Formulir Pendaftaran */
.reg-section {
    padding: 70px 0 90px 0;
    background: #f8fafc;
}

.reg-section-title {
    margin-bottom: 45px;
}
.reg-section-title h3 {
    position: relative !important;
    background: url(images/icons/bd2.png) scroll center bottom no-repeat !important;
    font-size: 34px !important;
    color: #222222 !important;
    font-family: 'Rasa', serif !important;
    line-height: 44px !important;
    font-weight: 700 !important;
    padding-bottom: 25px !important;
    margin-top: 0 !important;
    margin-bottom: 15px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}
.reg-section-title p {
    font-size: 16px !important;
    line-height: 26px !important;
    font-family: 'Assistant', sans-serif !important;
    color: #666666 !important;
    margin-bottom: 0 !important;
}

/* Registration Form Card */
.reg-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 30px;
}

.reg-card-header {
    background: #181d37;
    color: #ffffff;
    padding: 24px 30px;
    display: flex;
    align-items: center;
    gap: 18px;
    border-bottom: 3px solid #f8b239;
}
.reg-card-header .header-icon {
    width: 48px;
    height: 48px;
    background: #f8b239;
    color: #181d37;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}
.reg-card-header .header-title h4 {
    font-family: 'Rasa', serif;
    font-size: 22px;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 4px 0;
    line-height: 1.2;
}
.reg-card-header .header-title p {
    font-size: 13.5px;
    color: #cbd5e1;
    margin: 0;
    line-height: 1.4;
}

.reg-card-body {
    padding: 35px 35px 40px 35px;
}

/* Form Grouping & Legend */
.reg-form-step {
    margin-bottom: 30px;
    padding-bottom: 25px;
    border-bottom: 1px solid #edf2f7;
}
.reg-form-step:last-of-type {
    border-bottom: none;
    margin-bottom: 15px;
    padding-bottom: 0;
}
.reg-step-title {
    font-family: 'Rasa', serif;
    font-size: 18px;
    font-weight: 700;
    color: #181d37;
    margin-top: 0;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.reg-step-badge {
    background: #181d37;
    color: #f8b239;
    font-size: 12px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 3px;
    font-family: 'Assistant', sans-serif;
    letter-spacing: 0.5px;
}

/* Form Controls */
.reg-card .form-group {
    margin-bottom: 20px;
}
.reg-card .form-group label {
    display: block;
    font-size: 13.5px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 7px;
    font-family: 'Assistant', sans-serif;
}
.reg-card .form-group label .required-mark {
    color: #dc2626;
    font-weight: 700;
    margin-left: 2px;
}
.reg-card .form-control {
    height: 46px;
    border: 1px solid #cbd5e1;
    border-radius: 3px;
    padding: 10px 14px;
    font-size: 14.5px;
    color: #1e293b;
    background: #ffffff;
    box-shadow: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.reg-card .form-control:focus {
    border-color: #f8b239;
    box-shadow: 0 0 0 3px rgba(248, 178, 57, 0.18);
    outline: none;
}
.reg-card select.form-control {
    cursor: pointer;
}
.reg-card .field-helper {
    font-size: 12px;
    color: #64748b;
    margin-top: 5px;
    display: block;
    line-height: 1.4;
}

/* Statement Checkbox Box */
.confirm-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-left: 4px solid #f8b239;
    padding: 16px 20px;
    border-radius: 3px;
    margin-top: 10px;
    margin-bottom: 25px;
}
.confirm-box label {
    margin: 0;
    color: #334155;
    font-size: 13.5px;
    font-weight: 400;
    line-height: 1.5;
    cursor: pointer;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}
.confirm-box input[type="checkbox"] {
    margin-top: 3px;
    cursor: pointer;
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

/* Submit Button */
.btn-submit-reg {
    background: #f8b239;
    color: #181d37;
    font-family: 'Rasa', serif;
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    padding: 14px 30px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(248, 178, 57, 0.25);
}
.btn-submit-reg:hover {
    background: #181d37;
    color: #ffffff;
    box-shadow: 0 6px 16px rgba(24, 29, 55, 0.25);
}

/* Sidebar Informative Cards */
.sidebar-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    padding: 24px 22px;
    margin-bottom: 25px;
}
.sidebar-card h5 {
    font-family: 'Rasa', serif;
    font-size: 19px;
    font-weight: 700;
    color: #181d37;
    margin-top: 0;
    margin-bottom: 18px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f8b239;
    display: flex;
    align-items: center;
    gap: 8px;
}

.step-flow {
    list-style: none;
    padding: 0;
    margin: 0;
}
.step-flow li {
    display: flex;
    gap: 14px;
    margin-bottom: 18px;
    align-items: flex-start;
}
.step-flow li:last-child {
    margin-bottom: 0;
}
.step-num {
    width: 28px;
    height: 28px;
    background: #181d37;
    color: #f8b239;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 13px;
    flex-shrink: 0;
}
.step-desc strong {
    display: block;
    font-size: 14px;
    color: #1e293b;
    margin-bottom: 2px;
}
.step-desc p {
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.45;
    margin: 0;
}

.quick-stats-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 3px;
    padding: 12px 14px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.quick-stats-box span {
    font-size: 13px;
    color: #475569;
    font-weight: 600;
}
.quick-stats-box strong {
    font-family: 'Rasa', serif;
    font-size: 18px;
    color: #181d37;
}

/* FAQ Button in Dark Sidebar Card */
.btn-faq-help {
    display: block;
    text-align: center;
    padding: 11px 18px;
    font-size: 13.5px;
    font-weight: 700;
    font-family: 'Rasa', serif;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    background: #f8b239;
    color: #181d37 !important;
    border: 1px solid #f8b239;
    border-radius: 3px;
    transition: all 0.3s ease;
    text-decoration: none !important;
}
.btn-faq-help:hover {
    background: #ffffff !important;
    color: #181d37 !important;
    border-color: #ffffff !important;
    text-decoration: none !important;
    box-shadow: 0 4px 14px rgba(255, 255, 255, 0.25);
}

@media (max-width: 767px) {
    .reg-card-body {
        padding: 25px 20px 30px 20px;
    }
    .reg-card-header {
        padding: 20px;
    }
}
</style>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/4.jpg);">
        <div class="container">
            <div class="title-text" style="background-image:url(images/icons/page-title.png);">
                <h1>PENDAFTARAN PESERTA</h1>
                <ul class="title-menu clearfix">
                    <li><a href="index.php">home</a></li>
                    <li>Pendaftaran SNBP / SNBT</li>
                </ul>
            </div>           
        </div>
    </section>
    <!--End Page Title-->

    <!--Registration Section-->
    <section class="reg-section">
        <div class="container">
            
            <div class="reg-section-title text-center">
                <h3>FORMULIR PENDAFTARAN SELEKSI 2026</h3>
                <p>Lengkapi Data Diri dan Pilihan Program Studi untuk Memperoleh Nomor Peserta Resmi</p>
            </div>

            <div class="row clearfix">
                
                <!-- Left Column: Registration Form Card -->
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="reg-card">
                        
                        <div class="reg-card-header">
                            <div class="header-icon">
                                <i class="fa fa-pencil-square-o"></i>
                            </div>
                            <div class="header-title">
                                <h4>FORMULIR PENDAFTARAN SELEKSI MAHASISWA BARU</h4>
                                <p>Silakan isi data identitas Anda dengan benar sesuai berkas rapor dan identitas kependudukan.</p>
                            </div>
                        </div>

                        <div class="reg-card-body">
                            
                            <?php if (!empty($errors)): ?>
                                <div class="alert alert-danger" style="border-radius:3px; margin-bottom:25px; border-left:4px solid #dc2626;">
                                    <strong style="font-size:14.5px;"><i class="fa fa-exclamation-triangle"></i> Mohon lengkapi atau perbaiki formulir Anda:</strong>
                                    <ul style="margin-top:8px; margin-bottom:0; padding-left:20px; font-size:13.5px;">
                                        <?php foreach ($errors as $field => $msg): ?>
                                            <li><?php echo htmlspecialchars($msg); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <form id="form_pendaftaran" action="pendaftaran.php" method="post">
                                
                                <!-- Bagian 1: Identitas Peserta -->
                                <div class="reg-form-step">
                                    <h5 class="reg-step-title">
                                        <span class="reg-step-badge">BAGIAN 1</span>
                                        DATA IDENTITAS CALON PESERTA
                                    </h5>

                                    <div class="row clearfix">
                                        <!-- Nama Lengkap -->
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="nama_lengkap">
                                                    Nama Lengkap Siswa <span class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($form_data['nama_lengkap']); ?>" placeholder="Nama lengkap sesuai rapor / ijazah" required>
                                                <span class="field-helper">Gunakan huruf kapital pada awal kata</span>
                                            </div>
                                        </div>

                                        <!-- NISN -->
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="nisn">
                                                    NISN Simulasi (10 Digit) <span class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="nisn" name="nisn" maxlength="10" class="form-control" value="<?php echo htmlspecialchars($form_data['nisn']); ?>" placeholder="Contoh: 0051234567" required>
                                                <span class="field-helper">Tepat 10 digit angka tanpa spasi</span>
                                            </div>
                                        </div>

                                        <!-- Asal Sekolah -->
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="asal_sekolah">
                                                    Asal Sekolah (SMA / SMK / MA) <span class="required-mark">*</span>
                                                </label>
                                                <input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control" value="<?php echo htmlspecialchars($form_data['asal_sekolah']); ?>" placeholder="Contoh: SMAN 1 Jakarta" required>
                                                <span class="field-helper">Sebutkan nama sekolah asal secara lengkap</span>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="email">
                                                    Alamat Email Aktif <span class="required-mark">*</span>
                                                </label>
                                                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($form_data['email']); ?>" placeholder="contoh.siswa@email.com" required>
                                                <span class="field-helper">Konfirmasi bukti tanda peserta akan dikirim ke email ini</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bagian 2: Jalur Seleksi & Pilihan Program Studi -->
                                <div class="reg-form-step">
                                    <h5 class="reg-step-title">
                                        <span class="reg-step-badge">BAGIAN 2</span>
                                        JALUR SELEKSI &amp; PROGRAM STUDI
                                    </h5>

                                    <div class="form-group">
                                        <label for="jalur_seleksi">
                                            Pilih Jalur Seleksi <span class="required-mark">*</span>
                                        </label>
                                        <select id="jalur_seleksi" name="jalur_seleksi" class="form-control" required>
                                            <option value="SNBP" <?php echo ($form_data['jalur_seleksi'] === 'SNBP') ? 'selected' : ''; ?>>
                                                Jalur SNBP (Seleksi Nasional Berdasarkan Prestasi Rapor &amp; Portofolio)
                                            </option>
                                            <option value="SNBT" <?php echo ($form_data['jalur_seleksi'] === 'SNBT') ? 'selected' : ''; ?>>
                                                Jalur SNBT (Seleksi Nasional Berdasarkan Tes UTBK Skolastik)
                                            </option>
                                        </select>
                                        <span class="field-helper">Pilih salah satu jalur seleksi yang Anda ikuti</span>
                                    </div>

                                    <div class="row clearfix">
                                        <!-- Pilihan Prodi 1 -->
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="pilihan_1">
                                                    Pilihan Program Studi 1 (Prioritas) <span class="required-mark">*</span>
                                                </label>
                                                <select id="pilihan_1" name="pilihan_1" class="form-control" required>
                                                    <option value="">-- Pilih Program Studi 1 --</option>
                                                    <?php foreach ($prodi_list as $p): ?>
                                                        <option value="<?php echo htmlspecialchars($p['nama_prodi']); ?>" <?php echo ($form_data['pilihan_1'] === $p['nama_prodi']) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($p['nama_prodi'] . ' (' . $p['jenjang'] . ' - ' . $p['kategori'] . ')'); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="field-helper">Prioritas utama program studi yang diminati</span>
                                            </div>
                                        </div>

                                        <!-- Pilihan Prodi 2 -->
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="pilihan_2">
                                                    Pilihan Program Studi 2 <span class="required-mark">*</span>
                                                </label>
                                                <select id="pilihan_2" name="pilihan_2" class="form-control" required>
                                                    <option value="">-- Pilih Program Studi 2 --</option>
                                                    <?php foreach ($prodi_list as $p): ?>
                                                        <option value="<?php echo htmlspecialchars($p['nama_prodi']); ?>" <?php echo ($form_data['pilihan_2'] === $p['nama_prodi']) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($p['nama_prodi'] . ' (' . $p['jenjang'] . ' - ' . $p['kategori'] . ')'); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="field-helper">Harus berbeda dari pilihan program studi 1</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bagian 3: Pernyataan & Konfirmasi -->
                                <div class="reg-form-step">
                                    <h5 class="reg-step-title">
                                        <span class="reg-step-badge">BAGIAN 3</span>
                                        PERNYATAAN &amp; KONFIRMASI
                                    </h5>

                                    <div class="confirm-box">
                                        <label for="pernyataan_simulasi">
                                            <input type="checkbox" id="pernyataan_simulasi" name="pernyataan_simulasi" value="1" <?php echo !empty($form_data['pernyataan_simulasi']) ? 'checked' : ''; ?> required>
                                            <span>
                                                Saya menyatakan dengan sesungguhnya bahwa data yang saya isikan di atas adalah benar dan sah untuk keperluan simulasi pendaftaran Seleksi Nasional Penerimaan Mahasiswa Baru Tahun 2026.
                                            </span>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn-submit-reg">
                                        <i class="fa fa-paper-plane"></i>
                                        KIRIM PENDAFTARAN &amp; DAPATKAN NOMOR PESERTA
                                    </button>

                                    <p class="text-center" style="margin-top:14px; font-size:12.5px; color:#64748b; margin-bottom:0;">
                                        <i class="fa fa-lock" style="color:#f8b239; margin-right:4px;"></i>
                                        Data pendaftaran langsung divalidasi dan tersimpan secara aman dalam sistem seleksi.
                                    </p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar Guides & Cards -->
                <div class="col-md-4 col-sm-12 col-xs-12">
                    
                    <!-- 1. Alur Pendaftaran -->
                    <div class="sidebar-card">
                        <h5><i class="fa fa-list-ol" style="color:#f8b239;"></i> ALUR PENDAFTARAN</h5>
                        <ul class="step-flow">
                            <li>
                                <div class="step-num">1</div>
                                <div class="step-desc">
                                    <strong>Isi Identitas Lengkap</strong>
                                    <p>Pastikan NISN 10 digit aktif dan email aktif yang sering Anda gunakan.</p>
                                </div>
                            </li>
                            <li>
                                <div class="step-num">2</div>
                                <div class="step-desc">
                                    <strong>Tentukan 2 Program Studi</strong>
                                    <p>Pilih prioritas 1 dan 2 dengan program studi yang berbeda jenjang S1.</p>
                                </div>
                            </li>
                            <li>
                                <div class="step-num">3</div>
                                <div class="step-desc">
                                    <strong>Dapatkan Nomor Peserta</strong>
                                    <p>Sistem otomatis menerbitkan Nomor Peserta unik untuk cek kelulusan.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- 2. Ringkasan Kuota Seleksi -->
                    <div class="sidebar-card">
                        <h5><i class="fa fa-university" style="color:#f8b239;"></i> DAYA TAMPUNG 2026</h5>
                        <p style="font-size:13px; color:#64748b; margin-bottom:15px;">
                            Ringkasan kapasitas kursi mahasiswa baru yang tersedia pada jalur SNBP dan SNBT:
                        </p>

                        <div class="quick-stats-box">
                            <span>Program Studi S1</span>
                            <strong>10 Prodi</strong>
                        </div>
                        <div class="quick-stats-box">
                            <span>Total Daya Tampung</span>
                            <strong>580 Kursi</strong>
                        </div>
                        <div class="quick-stats-box">
                            <span>Jalur Penerimaan</span>
                            <strong style="color:#d97706;">SNBP &amp; SNBT</strong>
                        </div>

                        <a href="informasi.php" style="display:inline-flex; align-items:center; gap:6px; font-weight:700; color:#181d37; font-size:13px; text-transform:uppercase; margin-top:10px;">
                            Lihat Rincian Kuota Prodi <i class="fa fa-arrow-circle-right" style="color:#f8b239;"></i>
                        </a>
                    </div>

                    <!-- 3. Pusat Bantuan Card -->
                    <div class="sidebar-card" style="background:#181d37; color:#ffffff; border-color:#272d4b;">
                        <h5 style="color:#ffffff; border-bottom-color:#f8b239;">
                            <i class="fa fa-question-circle" style="color:#f8b239;"></i> PUSAT BANTUAN
                        </h5>
                        <p style="font-size:13px; color:#cbd5e1; line-height:1.6; margin-bottom:18px;">
                            Mengalami kendala saat pengisian NISN atau pemilihan program studi? Pelajari panduan tanya-jawab teknis seleksi 2026.
                        </p>
                        <a href="faq.php" class="btn-faq-help">
                            <i class="fa fa-question-circle" style="margin-right:6px;"></i> BUKA HALAMAN FAQ
                        </a>
                    </div>

                </div>

            </div>

        </div>                  
    </section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
