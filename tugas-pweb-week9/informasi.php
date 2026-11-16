<?php
// informasi.php - Informasi Lengkap Seleksi SNBP & SNBT 2026
require_once __DIR__ . '/includes/functions.php';

$page_title = 'cologne-education | Informasi Seleksi SNBP & SNBT 2026';
$active_menu = 'informasi';
$prodi_list = getProgramStudiList();
$jadwal_list = getJadwalList();

// Hitung total daya tampung
$total_kuota = 0;
foreach ($prodi_list as $pr) {
    $total_kuota += (int)($pr['kuota'] ?? 50);
}

require_once __DIR__ . '/includes/header.php';
?>

<style>
/* Scoped Styling for Informasi Seleksi */
.info-section-title {
    margin-bottom: 45px;
}
.info-section-title h3 {
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
.info-section-title p {
    font-size: 16px !important;
    line-height: 26px !important;
    font-family: 'Assistant', sans-serif !important;
    color: #666666 !important;
    margin-bottom: 0 !important;
}

/* Mechanism Cards */
.mech-card {
    background: #ffffff;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #edf2f7;
}
.mech-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.12);
}
.mech-card figure {
    position: relative;
    overflow: hidden;
    height: 230px;
    margin: 0;
}
.mech-card figure img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.mech-card:hover figure img {
    transform: scale(1.05);
}
.mech-card .content-text {
    padding: 30px 25px 25px;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 235px;
}
.mech-card .content-text i {
    position: absolute;
    background: #f8b239;
    height: 54px;
    width: 54px;
    text-align: center;
    line-height: 54px;
    top: -54px;
    left: 20px;
    color: #ffffff;
    font-size: 24px;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.15);
}
.mech-card .content-text i:before {
    margin: 0;
    line-height: 54px;
}
.mech-card .content-text h5 {
    font-family: 'Rasa', serif;
    font-size: 21px;
    font-weight: 700;
    color: #181d37;
    margin-top: 5px;
    margin-bottom: 12px;
    line-height: 1.3;
    letter-spacing: 0.3px;
}
.mech-card .content-text p {
    font-size: 14.5px;
    line-height: 23px;
    color: #555555;
    margin-bottom: 20px;
    flex-grow: 1;
}
.mech-card .link-btn a {
    font-family: 'Rasa', serif;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    color: #181d37;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    letter-spacing: 0.5px;
    transition: color 0.3s ease;
}
.mech-card .link-btn a:hover {
    color: #f8b239;
}

/* Statistics Ribbon */
.stats-ribbon {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    padding: 20px 25px;
    margin-bottom: 30px;
}
.stats-item {
    text-align: center;
    padding: 10px 0;
}
.stats-item .stats-num {
    font-family: 'Rasa', serif;
    font-size: 30px;
    font-weight: 700;
    color: #181d37;
    line-height: 1;
    margin-bottom: 5px;
}
.stats-item .stats-label {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    font-weight: 600;
}

/* Modernized Tables */
.custom-table-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    box-shadow: 0 6px 22px rgba(0, 0, 0, 0.05);
    padding: 25px 30px;
}
.custom-table-card table {
    margin-bottom: 0;
    font-size: 14.5px;
}
.custom-table-card table thead th {
    background: #181d37 !important;
    color: #ffffff !important;
    border-color: #272d4b !important;
    font-family: 'Rasa', serif;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
    padding: 13px 15px !important;
    vertical-align: middle !important;
}
.custom-table-card table tbody td {
    padding: 13px 15px !important;
    vertical-align: middle !important;
    border-color: #edf2f7 !important;
    color: #333333;
}
.custom-table-card table tbody tr:hover {
    background-color: #f8fafc !important;
}
</style>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/4.jpg);">
        <div class="container">
            <div class="title-text" style="background-image:url(images/icons/page-title.png);">
                <h1>INFORMASI SELEKSI</h1>
                <ul class="title-menu clearfix">
                    <li><a href="index.php">home</a></li>
                    <li>Informasi Jalur & Kuota</li>
                </ul>
            </div>           
        </div>
    </section>
    <!--End Page Title-->

    <!--1. Mekanisme Jalur Penerimaan Section-->
    <section class="about-us" style="padding: 70px 0 50px 0;">
        <div class="container">
            <div class="info-section-title text-center">
                <h3>MEKANISME JALUR PENERIMAAN</h3>
                <p>Kriteria dan Ketentuan Seleksi Penerimaan Mahasiswa Baru Tahun 2026</p>                        
            </div>
            <div class="row clearfix">
                
                <!-- Jalur SNBP -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="mech-card">
                        <figure>
                            <img src="images/resource/8.jpg" alt="Jalur SNBP Prestasi">
                        </figure>
                        <div class="content-text">
                            <i class="flaticon-books-stack-of-three"></i>
                            <h5>JALUR SNBP (PRESTASI)</h5>
                            <p>Penilaian berdasarkan nilai rapor semester 1 sampai dengan 5 bagi siswa eligible sekolah, serta portofolio prestasi akademik maupun non-akademik.</p>
                            <div class="link-btn">
                                <a href="pendaftaran.php">DAFTAR SNBP <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jalur SNBT -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="mech-card">
                        <figure>
                            <img src="images/resource/9.jpg" alt="Jalur SNBT UTBK">
                        </figure>
                        <div class="content-text">
                            <i class="flaticon-note-1"></i>
                            <h5>JALUR SNBT (UTBK)</h5>
                            <p>Ujian Tulis Berbasis Komputer standar nasional menguji Tes Potensi Skolastik (TPS), penalaran matematika, literasi bahasa Indonesia dan bahasa Inggris.</p>
                            <div class="link-btn">
                                <a href="pendaftaran.php">DAFTAR SNBT <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Syarat & Ketentuan -->
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="mech-card">
                        <figure>
                            <img src="images/resource/10.jpg" alt="Syarat dan Ketentuan">
                        </figure>
                        <div class="content-text">
                            <i class="flaticon-note"></i>
                            <h5>SYARAT & KETENTUAN</h5>
                            <p>Memiliki NISN 10 digit aktif, lulusan SMA/SMK/MA sederajat tahun berjalan atau dua tahun sebelumnya, serta memilih 2 program studi yang diminati.</p>
                            <div class="link-btn">
                                <a href="faq.php">BACA PANDUAN <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--End Mekanisme Section-->

    <!--2. Daftar Program Studi Table Section-->
    <section class="about-us" style="padding: 70px 0; background:#F8FAFC; border-top:1px solid #E2E8F0; border-bottom:1px solid #E2E8F0;">
        <div class="container">
            <div class="info-section-title text-center">
                <h3>DAFTAR PROGRAM STUDI & KUOTA DAYA TAMPUNG</h3>
                <p>10 Program Studi Sarjana (S1) Tersedia pada Jalur Seleksi Nasional 2026</p>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    
                    <!-- Stats Ribbon -->
                    <div class="stats-ribbon">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12 stats-item" style="border-right: 1px solid #e2e8f0;">
                                <div class="stats-num">10</div>
                                <div class="stats-label">Program Studi Sarjana (S1)</div>
                            </div>
                            <div class="col-sm-4 col-xs-12 stats-item" style="border-right: 1px solid #e2e8f0;">
                                <div class="stats-num"><?php echo htmlspecialchars($total_kuota); ?></div>
                                <div class="stats-label">Total Daya Tampung (Kursi)</div>
                            </div>
                            <div class="col-sm-4 col-xs-12 stats-item">
                                <div class="stats-num" style="color:#d97706;">2 Jalur</div>
                                <div class="stats-label">SNBP (Prestasi) &amp; SNBT (Tes)</div>
                            </div>
                        </div>
                    </div>

                    <!-- Program Studi Table -->
                    <div class="custom-table-card table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:50px; text-align:center;">No</th>
                                    <th style="width:90px; text-align:center;">Kode</th>
                                    <th>Nama Program Studi</th>
                                    <th style="width:90px; text-align:center;">Jenjang</th>
                                    <th style="width:110px; text-align:center;">Kategori</th>
                                    <th style="width:130px; text-align:center;">Daya Tampung</th>
                                    <th style="width:110px; text-align:center;">Akreditasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($prodi_list as $pr): ?>
                                    <tr>
                                        <td style="text-align:center; font-weight:600; color:#64748b;"><?php echo $no++; ?></td>
                                        <td style="text-align:center;">
                                            <code style="background:#f1f5f9; color:#0f172a; padding:3px 7px; font-weight:700; border-radius:3px; font-size:13px;">
                                                <?php echo htmlspecialchars($pr['kode_prodi'] ?? ($pr['kode'] ?? ('PRD0' . $no))); ?>
                                            </code>
                                        </td>
                                        <td>
                                            <strong style="color:#181d37; font-size:15px;">
                                                <?php echo htmlspecialchars($pr['nama_prodi'] ?? ($pr['nama'] ?? 'Program Studi')); ?>
                                            </strong>
                                        </td>
                                        <td style="text-align:center;">
                                            <span class="label label-default" style="background:#475569; font-size:12px; font-weight:600; padding:4px 8px;">
                                                <?php echo htmlspecialchars($pr['jenjang'] ?? 'S1'); ?>
                                            </span>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php $is_saintek = (($pr['kategori'] ?? '') === 'Saintek'); ?>
                                            <span class="label <?php echo $is_saintek ? 'label-primary' : 'label-success'; ?>" style="font-size:12px; font-weight:600; padding:4px 10px;">
                                                <?php echo htmlspecialchars($pr['kategori'] ?? 'Saintek'); ?>
                                            </span>
                                        </td>
                                        <td style="text-align:center; font-weight:700; color:#1e293b;">
                                            <?php echo htmlspecialchars($pr['kuota'] ?? 50); ?> <span style="font-size:12px; font-weight:400; color:#64748b;">Kursi</span>
                                        </td>
                                        <td style="text-align:center;">
                                            <span class="badge" style="background:#f8b239; color:#181d37; font-weight:700; padding:5px 12px; font-size:12px;">
                                                <?php echo htmlspecialchars($pr['akreditasi'] ?? 'Unggul'); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--End Prodi Table Section-->

    <!--3. Jadwal Kegiatan Section-->
    <section class="about-us" style="padding: 70px 0 90px 0;">
        <div class="container">
            <div class="info-section-title text-center">
                <h3>JADWAL KEGIATAN SELEKSI 2026</h3>
                <p>Tahapan Pendaftaran, Ujian Tulis, dan Pengumuman Kelulusan</p>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="custom-table-card table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tahapan Kegiatan</th>
                                    <th style="width:110px; text-align:center;">Jalur</th>
                                    <th style="width:230px;">Jadwal Pelaksanaan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jadwal_list as $j): ?>
                                    <tr>
                                        <td>
                                            <strong style="color:#181d37; font-size:15px;"><?php echo htmlspecialchars($j['kegiatan']); ?></strong>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php 
                                            $badge_class = 'label-warning';
                                            $bg_color = '#f8b239';
                                            $text_color = '#181d37';
                                            if (($j['jalur'] ?? '') === 'SNBP') {
                                                $badge_class = 'label-primary';
                                                $bg_color = '#2563eb';
                                                $text_color = '#ffffff';
                                            } elseif (($j['jalur'] ?? '') === 'SNBT') {
                                                $badge_class = 'label-info';
                                                $bg_color = '#0284c7';
                                                $text_color = '#ffffff';
                                            }
                                            ?>
                                            <span class="label <?php echo $badge_class; ?>" style="background:<?php echo $bg_color; ?>; color:<?php echo $text_color; ?>; font-weight:700; font-size:12px; padding:4px 10px;">
                                                <?php echo htmlspecialchars($j['jalur']); ?>
                                            </span>
                                        </td>
                                        <td style="white-space:nowrap; font-weight:600; color:#334155;">
                                            <?php 
                                            $tgl_mulai = $j['tanggal_mulai'] ?? ($j['mulai'] ?? '');
                                            $tgl_selesai = $j['tanggal_selesai'] ?? ($j['selesai'] ?? '');
                                            if ($tgl_mulai === $tgl_selesai || empty($tgl_selesai)) {
                                                $tgl_display = formatTanggalIndonesia($tgl_mulai);
                                            } else {
                                                $tgl_display = formatTanggalIndonesia($tgl_mulai) . ' &ndash; ' . formatTanggalIndonesia($tgl_selesai);
                                            }
                                            ?>
                                            <i class="fa fa-calendar" style="color:#f8b239; margin-right:6px;"></i>
                                            <?php echo $tgl_display; ?>
                                        </td>
                                        <td style="color:#555555; font-size:13.5px; line-height:1.5;">
                                            <?php echo htmlspecialchars($j['keterangan']); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Bottom CTA Box -->
                    <div style="background:#181d37; color:#ffffff; padding:35px 30px; border-radius:4px; margin-top:40px; text-align:center; box-shadow:0 10px 25px rgba(24,29,55,0.15);">
                        <h4 style="font-family:'Rasa',serif; font-size:24px; color:#ffffff; margin-top:0; margin-bottom:10px;">
                            Siap Mengikuti Seleksi Nasional Mahasiswa Baru 2026?
                        </h4>
                        <p style="color:#cbd5e1; font-size:15px; margin-bottom:20px; max-width:650px; margin-left:auto; margin-right:auto;">
                            Segera lakukan simulasi pendaftaran Anda untuk mendapatkan Nomor Peserta dan memverifikasi pilihan program studi secara langsung.
                        </p>
                        <a href="pendaftaran.php" class="btn-style-two" style="padding:10px 30px; margin-right:10px; display:inline-block;">
                            DAFTAR SEKARANG
                        </a>
                        <a href="pengumuman.php" class="btn-style-three" style="padding:10px 30px; display:inline-block;">
                            CEK HASIL PENGUMUMAN
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--End Jadwal Section-->

<?php require_once __DIR__ . '/includes/footer.php'; ?>
