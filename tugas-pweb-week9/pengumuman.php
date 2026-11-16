<?php
// pengumuman.php - Pengecekan Hasil Pengumuman SNBP & SNBT 2026
require_once __DIR__ . '/includes/functions.php';

$page_title = 'cologne-education | Pengumuman Hasil Seleksi 2026';
$active_menu = 'pengumuman';

$keyword = trim($_GET['nomor'] ?? ($_GET['nomor_peserta'] ?? ($_POST['nomor'] ?? ($_POST['nomor_peserta'] ?? ''))));
$searched = false;
$hasil = null;

if (!empty($keyword)) {
    $searched = true;
    $hasil = cariPesertaPengumuman($keyword);
}

require_once __DIR__ . '/includes/header.php';
?>

<style>
/* Scoped Styling for Pengumuman Hasil */
.announce-section {
    padding: 70px 0 90px 0;
    background: #f8fafc;
}

.announce-section-title {
    margin-bottom: 40px;
}
.announce-section-title h3 {
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
.announce-section-title p {
    font-size: 16px !important;
    line-height: 26px !important;
    font-family: 'Assistant', sans-serif !important;
    color: #666666 !important;
    margin-bottom: 0 !important;
}

/* Search Card Container */
.search-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 35px;
}

.search-card-header {
    background: #181d37;
    color: #ffffff;
    padding: 22px 30px;
    display: flex;
    align-items: center;
    gap: 16px;
    border-bottom: 3px solid #f8b239;
}
.search-card-header .header-icon {
    width: 44px;
    height: 44px;
    background: #f8b239;
    color: #181d37;
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.search-card-header .header-title h4 {
    font-family: 'Rasa', serif;
    font-size: 21px;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 4px 0;
    line-height: 1.2;
}
.search-card-header .header-title p {
    font-size: 13px;
    color: #cbd5e1;
    margin: 0;
    line-height: 1.4;
}

.search-card-body {
    padding: 30px 32px;
}

/* Integrated Search Input Group */
.search-input-group {
    display: flex;
    align-items: stretch;
    width: 100%;
}
.search-input-group input[type="text"] {
    flex: 1;
    height: 50px;
    border: 2px solid #cbd5e1;
    border-right: none;
    border-radius: 4px 0 0 4px;
    padding: 10px 18px;
    font-size: 15px;
    color: #1e293b;
    background: #ffffff;
    transition: border-color 0.2s ease;
}
.search-input-group input[type="text"]:focus {
    border-color: #f8b239;
    outline: none;
    box-shadow: none;
}
.search-input-group .btn-submit-search {
    background: #f8b239;
    color: #181d37;
    font-family: 'Rasa', serif;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    padding: 0 28px;
    border: 2px solid #f8b239;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
    white-space: nowrap;
}
.search-input-group .btn-submit-search:hover {
    background: #181d37;
    color: #ffffff;
    border-color: #181d37;
}

/* Result Card */
.result-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-top: 15px;
}
.result-banner {
    padding: 30px 25px;
    text-align: center;
    border-bottom: 1px solid rgba(0,0,0,0.06);
}
.result-banner i {
    font-size: 46px;
    margin-bottom: 12px;
    display: block;
}
.result-banner h3 {
    font-family: 'Rasa', serif;
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 6px 0;
    line-height: 1.25;
}
.result-banner p {
    font-size: 14.5px;
    margin: 0;
    color: #475569;
}

.result-body {
    padding: 35px 40px;
}
.result-table {
    margin-bottom: 25px;
    font-size: 14px;
}
.result-table th {
    background: #f8fafc;
    color: #475569;
    font-weight: 600;
    width: 35%;
    vertical-align: middle !important;
    padding: 12px 16px !important;
}
.result-table td {
    color: #1e293b;
    vertical-align: middle !important;
    padding: 12px 16px !important;
}

/* Print Kop Header */
.print-kop-header {
    display: flex;
    align-items: center;
    gap: 20px;
    padding-bottom: 15px;
    margin-bottom: 20px;
    border-bottom: 3px double #181d37;
}
.print-kop-header img {
    height: 56px;
    width: auto;
}
.print-kop-text h4 {
    font-family: 'Rasa', serif;
    font-size: 16.5px;
    font-weight: 700;
    color: #181d37;
    margin: 0 0 2px 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.print-kop-text h5 {
    font-size: 13px;
    font-weight: 700;
    color: #181d37;
    margin: 0 0 2px 0;
    letter-spacing: 0.5px;
}
.print-kop-text p {
    font-size: 11.5px;
    color: #64748b;
    margin: 0;
}

/* Print Verification Signature Block */
.print-signature-row {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}
.sig-box {
    text-align: center;
    width: 220px;
}
.sig-space {
    height: 60px;
    border-bottom: 1px dotted #94a3b8;
    margin-bottom: 6px;
}

/* Print Media Rules */
@media print {
    @page {
        size: A4 portrait;
        margin: 12mm 15mm;
    }
    body {
        background: #ffffff !important;
        color: #000000 !important;
        padding: 0 !important;
        margin: 0 !important;
        font-size: 11pt !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    .main-header,
    .page-title,
    .announce-section-title,
    .search-card,
    .main-footer,
    .footer-bottom,
    .scroll-to-top,
    .no-print,
    .btn-style-one,
    .btn-style-two {
        display: none !important;
    }
    .announce-section {
        padding: 0 !important;
        background: transparent !important;
    }
    .container {
        width: 100% !important;
        max-width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .col-md-8, .col-md-offset-2 {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    #printArea {
        border: 2px solid #181d37 !important;
        box-shadow: none !important;
        padding: 25px 30px !important;
        margin: 0 !important;
        border-radius: 0 !important;
        page-break-inside: avoid !important;
    }
    .result-banner {
        border: 2px solid #181d37 !important;
        padding: 14px 20px !important;
        margin-bottom: 20px !important;
    }
    .result-banner i {
        font-size: 28px !important;
        margin-bottom: 6px !important;
    }
    .result-banner h3 {
        font-size: 19px !important;
    }
    .result-body {
        padding: 0 !important;
    }
    table {
        border: 1px solid #1e293b !important;
    }
    table th, table td {
        border: 1px solid #cbd5e1 !important;
        padding: 6px 10px !important;
        font-size: 10pt !important;
    }
    .print-kop-header {
        border-bottom: 3px double #000000 !important;
    }
}

@media (max-width: 767px) {
    .search-input-group {
        flex-direction: column;
        gap: 10px;
    }
    .search-input-group input[type="text"] {
        border-right: 2px solid #cbd5e1;
        border-radius: 4px;
        width: 100%;
    }
    .search-input-group .btn-submit-search {
        border-radius: 4px;
        height: 48px;
        width: 100%;
    }
    .search-card-body {
        padding: 22px 20px;
    }
    .result-body {
        padding: 25px 20px;
    }
}
</style>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/4.jpg);">
        <div class="container">
            <div class="title-text" style="background-image:url(images/icons/page-title.png);">
                <h1>PENGUMUMAN HASIL</h1>
                <ul class="title-menu clearfix">
                    <li><a href="index.php">home</a></li>
                    <li>Pengumuman Hasil Seleksi</li>
                </ul>
            </div>           
        </div>
    </section>
    <!--End Page Title-->

    <!--Main Announcement Section-->
    <section class="announce-section">
        <div class="container">
            
            <div class="announce-section-title text-center">
                <h3>PENGECEKAN KELULUSAN MAHASISWA BARU</h3>
                <p>Portal Resmi Pengecekan Hasil Seleksi Nasional Berdasarkan Prestasi &amp; Tes Tahun 2026</p>
            </div>

            <!-- Central Search Card -->
            <div class="row clearfix">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    
                    <div class="search-card">
                        
                        <div class="search-card-header">
                            <div class="header-icon">
                                <i class="fa fa-search"></i>
                            </div>
                            <div class="header-title">
                                <h4>PENCARIAN DATA KELULUSAN PESERTA</h4>
                                <p>Gunakan Nomor Peserta resmi (contoh: SNBP-2026-001) atau 10 digit NISN terdaftar.</p>
                            </div>
                        </div>

                        <div class="search-card-body">
                            <form method="get" action="pengumuman.php">
                                <label for="nomor" style="font-size:13.5px; font-weight:600; color:#1e293b; margin-bottom:8px; display:block;">
                                    <i class="fa fa-id-card-o" style="color:#f8b239; margin-right:6px;"></i>
                                    NOMOR PESERTA / NISN SISWA:
                                </label>
                                
                                <div class="search-input-group">
                                    <input type="text" id="nomor" name="nomor" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Contoh: SNBP-2026-001 atau NISN 10 digit" required autofocus>
                                    <button type="submit" class="btn-submit-search">
                                        <i class="fa fa-search"></i>
                                        CARI HASIL
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <!-- RESULT DISPLAY OR INITIAL GUIDANCE -->
            <div class="row clearfix">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    
                    <?php if ($searched && $hasil): ?>
                        <?php 
                        $status = $hasil['status_hasil'] ?? 'Menunggu'; 
                        $status_bg = '#f0fdf4';
                        $status_border = '#86efac';
                        $status_color = '#15803d';
                        $status_icon = 'fa-check-circle';
                        $status_title = 'SELAMAT! ANDA DINYATAKAN LULUS';

                        if ($status === 'Tidak Lulus') {
                            $status_bg = '#fef2f2';
                            $status_border = '#fca5a5';
                            $status_color = '#b91c1c';
                            $status_icon = 'fa-times-circle';
                            $status_title = 'MOHON MAAF, ANDA DINYATAKAN TIDAK LULUS';
                        } elseif ($status === 'Menunggu') {
                            $status_bg = '#fffbeb';
                            $status_border = '#fde68a';
                            $status_color = '#b45309';
                            $status_icon = 'fa-clock-o';
                            $status_title = 'HASIL SELEKSI SEDANG DALAM PROSES VERIFIKASI';
                        }
                        ?>

                        <div class="result-card" id="printArea">
                            
                            <!-- Kop Resmi Surat Keterangan Pengumuman -->
                            <div style="padding: 30px 35px 15px 35px;">
                                <div class="print-kop-header">
                                    <img src="images/logo.png" alt="Logo Kemdikbudristek">
                                    <div class="print-kop-text">
                                        <h4>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h4>
                                        <h5>PANITIA SELEKSI NASIONAL PENERIMAAN MAHASISWA BARU (SNPMB) 2026</h5>
                                        <p>Gedung D, Kemendikbudristek, Jalan Jenderal Sudirman, Senayan, Jakarta Pusat 10270</p>
                                    </div>
                                </div>

                                <div class="text-center" style="margin-bottom: 20px;">
                                    <h3 style="font-family:'Rasa',serif; font-size:24px; font-weight:700; color:#181d37; margin:0 0 5px 0; text-transform:uppercase; letter-spacing:0.5px;">
                                        SURAT KETERANGAN HASIL SELEKSI (SKHS)
                                    </h3>
                                    <p style="font-size:13.5px; color:#64748b; margin:0;">
                                        Simulasi Seleksi Nasional Penerimaan Mahasiswa Baru Tahun Akademik 2026/2027
                                    </p>
                                </div>
                            </div>

                            <!-- Banner Status Kelulusan -->
                            <div class="result-banner" style="background:<?php echo $status_bg; ?>; border-color:<?php echo $status_border; ?>;">
                                <i class="fa <?php echo $status_icon; ?>" style="color:<?php echo $status_color; ?>;"></i>
                                <h3 style="color:<?php echo $status_color; ?>;">
                                    <?php echo $status_title; ?>
                                </h3>
                                <p>
                                    Jalur Seleksi <strong><?php echo htmlspecialchars($hasil['jalur_seleksi']); ?></strong> &bull; Tahun Akademik 2026/2027
                                </p>
                            </div>

                            <!-- Body Detail Peserta -->
                            <div class="result-body">
                                
                                <table class="table table-bordered result-table">
                                    <tbody>
                                        <tr>
                                            <th>Nomor Peserta</th>
                                            <td><strong style="color:#181d37; font-size:15px;"><?php echo htmlspecialchars($hasil['nomor_peserta']); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Lengkap Siswa</th>
                                            <td><strong><?php echo htmlspecialchars($hasil['nama_lengkap']); ?></strong></td>
                                        </tr>
                                        <tr>
                                            <th>NISN Siswa</th>
                                            <td><?php echo htmlspecialchars($hasil['nisn']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Asal Sekolah</th>
                                            <td><?php echo htmlspecialchars($hasil['asal_sekolah']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jalur Seleksi</th>
                                            <td>
                                                <span class="label label-primary" style="font-size:12px; padding:4px 10px;">
                                                    <?php echo htmlspecialchars($hasil['jalur_seleksi']); ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php if ($status === 'Lulus' && !empty($hasil['prodi_diterima'])): ?>
                                            <tr style="background:#f0fdf4;">
                                                <th style="color:#15803d; font-weight:700;">DITERIMA PADA PROGRAM STUDI</th>
                                                <td style="color:#15803d; font-weight:700; font-size:16px;">
                                                    <i class="fa fa-graduation-cap" style="margin-right:6px;"></i>
                                                    <?php echo htmlspecialchars($hasil['prodi_diterima']); ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <th>Pilihan Program Studi 1</th>
                                            <td><?php echo htmlspecialchars($hasil['pilihan_1']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pilihan Program Studi 2</th>
                                            <td><?php echo htmlspecialchars($hasil['pilihan_2']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Waktu Pengecekan</th>
                                            <td><?php echo date('d-m-Y H:i:s'); ?> WIB</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Pesan Keterangan Panitia -->
                                <?php if (!empty($hasil['pesan_hasil'])): ?>
                                    <div style="background:#f8fafc; border-left:4px solid #181d37; padding:16px 20px; border-radius:3px; margin-bottom:25px; font-size:14px; line-height:1.6; color:#334155;">
                                        <strong style="color:#181d37; display:block; margin-bottom:4px;">
                                            <i class="fa fa-info-circle" style="color:#f8b239;"></i> Catatan Resmi Panitia Seleksi:
                                        </strong>
                                        <?php echo htmlspecialchars($hasil['pesan_hasil']); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Official Verification & Signature Row -->
                                <div class="print-signature-row">
                                    <div class="sig-box">
                                        <div style="font-size:12px; color:#475569; margin-bottom:4px;">Tanda Tangan Peserta,</div>
                                        <div class="sig-space"></div>
                                        <strong style="font-size:13px; color:#181d37; display:block;"><?php echo htmlspecialchars($hasil['nama_lengkap']); ?></strong>
                                        <span style="font-size:11px; color:#64748b;">NISN: <?php echo htmlspecialchars($hasil['nisn']); ?></span>
                                    </div>
                                    <div style="text-align:center; flex:1; padding:0 20px;">
                                        <div style="display:inline-block; border:1px dashed #cbd5e1; padding:8px 14px; border-radius:4px; background:#f8fafc;">
                                            <i class="fa fa-qrcode" style="font-size:32px; color:#181d37; display:block; margin-bottom:4px;"></i>
                                            <span style="font-size:10px; font-weight:700; color:#64748b; letter-spacing:0.5px;">DOKUMEN RESMI TERVERIFIKASI</span>
                                        </div>
                                    </div>
                                    <div class="sig-box">
                                        <div style="font-size:12px; color:#475569; margin-bottom:4px;">Jakarta, <?php echo formatTanggalIndonesia(date('Y-m-d')); ?></div>
                                        <div style="font-size:12px; color:#475569;">Ketua Panitia SNPMB 2026,</div>
                                        <div class="sig-space" style="border-bottom:1px solid #181d37;">
                                            <div style="padding-top:20px; font-size:11px; color:#15803d; font-weight:700; text-transform:uppercase;">
                                                <i class="fa fa-check-circle"></i> Sah Secara Elektronik
                                            </div>
                                        </div>
                                        <strong style="font-size:13px; color:#181d37; display:block;">TIM PELAKSANA SNPMB</strong>
                                        <span style="font-size:11px; color:#64748b;">Kemendikbudristek RI</span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- Action Buttons (Excluded from Print) -->
                        <div class="row no-print" style="margin-top:25px;">
                            <div class="col-sm-7 text-left">
                                <button type="button" onclick="window.print()" class="btn-style-one" style="padding:12px 22px; border:none; cursor:pointer;">
                                    <i class="fa fa-print"></i> CETAK PENGUMUMAN
                                </button>
                                <a href="ringkasan.php?nomor=<?php echo urlencode($hasil['nomor_peserta']); ?>" class="btn-style-two" style="margin-left:8px; display:inline-block; padding:12px 20px;">
                                    <i class="fa fa-id-card-o"></i> KARTU PESERTA
                                </a>
                            </div>
                            <div class="col-sm-5 text-right">
                                <a href="pengumuman.php" class="btn-style-two" style="padding:12px 22px;">
                                    CARI NOMOR LAIN &rarr;
                                </a>
                            </div>
                        </div>

                    <?php elseif ($searched && !$hasil): ?>
                        
                        <!-- Not Found Card -->
                        <div class="result-card" style="padding:45px 30px; text-align:center;">
                            <div style="width:64px; height:64px; background:#fef3c7; color:#b45309; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:28px; margin-bottom:18px;">
                                <i class="fa fa-search"></i>
                            </div>
                            <h3 style="font-family:'Rasa',serif; font-size:24px; color:#181d37; margin:0 0 10px 0; font-weight:700;">
                                DATA PESERTA TIDAK DITEMUKAN
                            </h3>
                            <p style="color:#64748b; font-size:14.5px; max-width:550px; margin:0 auto 25px auto; line-height:1.5;">
                                Nomor peserta atau NISN <strong>"<?php echo htmlspecialchars($keyword); ?>"</strong> tidak terdaftar dalam pangkalan data seleksi 2026. Harap periksa kembali format penulisan nomor atau lakukan pendaftaran baru.
                            </p>
                            <div>
                                <a href="pengumuman.php" class="btn-style-one" style="margin-right:10px; display:inline-block;">
                                    <i class="fa fa-refresh"></i> CARI ULANG
                                </a>
                                <a href="pendaftaran.php" class="btn-style-two" style="display:inline-block;">
                                    <i class="fa fa-user-plus"></i> DAFTAR PESERTA BARU
                                </a>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>

        </div>                  
    </section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
