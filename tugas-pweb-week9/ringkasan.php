<?php
// ringkasan.php - Bukti Ringkasan Tanda Peserta Seleksi
require_once __DIR__ . '/includes/functions.php';

$page_title = 'cologne-education | Bukti Ringkasan Pendaftaran';
$active_menu = 'pendaftaran';

$nomor_peserta = trim($_GET['nomor'] ?? ($_SESSION['last_registered_nomor'] ?? ''));
$peserta = null;

if (!empty($nomor_peserta)) {
    $peserta = cariPesertaPengumuman($nomor_peserta);
}

require_once __DIR__ . '/includes/header.php';
?>

    <!--Page Title-->
    <section class="page-title no-print" style="background-image:url(images/background/4.jpg);">
        <div class="container">
            <div class="title-text" style="background-image:url(images/icons/page-title.png);">
                <h1>BUKTI PENDAFTARAN</h1>
                <ul class="title-menu clearfix">
                    <li><a href="index.php">home</a></li>
                    <li>Ringkasan Peserta</li>
                </ul>
            </div>           
        </div>
    </section>
    <!--End Page Title-->

    <style>
    .card-section-title h3 {
        margin-top: 0 !important;
        background: url(images/icons/bd2.png) scroll center bottom no-repeat !important;
        font-family: 'Rasa', serif !important;
        font-size: 28px !important;
        font-weight: 700 !important;
        color: #181d37 !important;
        padding-bottom: 20px !important;
        margin-bottom: 12px !important;
        line-height: 1.3 !important;
        letter-spacing: 0.5px !important;
    }
    .card-section-title p {
        font-family: 'Assistant', sans-serif !important;
        font-size: 15px !important;
        color: #64748b !important;
        margin-bottom: 0 !important;
    }

    /* Print Kop Header */
    .print-kop-header {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 15px;
        margin-bottom: 25px;
        border-bottom: 3px double #181d37;
    }
    .print-kop-header img {
        height: 58px;
        width: auto;
    }
    .print-kop-text h4 {
        font-family: 'Rasa', serif;
        font-size: 17px;
        font-weight: 700;
        color: #181d37;
        margin: 0 0 2px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .print-kop-text h5 {
        font-size: 13.5px;
        font-weight: 700;
        color: #181d37;
        margin: 0 0 2px 0;
        letter-spacing: 0.5px;
    }
    .print-kop-text p {
        font-size: 12px;
        color: #64748b;
        margin: 0;
    }

    /* Photo Frame Box */
    .photo-frame {
        width: 110px;
        height: 145px;
        border: 2px dashed #cbd5e1;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 10px;
        border-radius: 4px;
        color: #94a3b8;
    }
    .photo-frame i {
        font-size: 38px;
        margin-bottom: 6px;
        color: #cbd5e1;
    }
    .photo-frame span {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.2;
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
        height: 65px;
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
        .main-footer,
        .footer-bottom,
        .scroll-to-top,
        .no-print,
        .btn-style-one,
        .btn-style-two {
            display: none !important;
        }
        .about-section {
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
        .card-section-title h3 {
            background: none !important;
            padding-bottom: 5px !important;
            font-size: 22px !important;
        }
        table {
            border: 1px solid #1e293b !important;
        }
        table th, table td {
            border: 1px solid #cbd5e1 !important;
            padding: 6px 10px !important;
            font-size: 10.5pt !important;
        }
        .print-kop-header {
            border-bottom: 3px double #000000 !important;
        }
    }
    </style>

    <section class="about-section" style="padding: 70px 0 90px 0; background:#f8fafc;">
        <div class="container">
            <?php if ($peserta): ?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-12">
                        
                        <!-- Printable Card Container -->
                        <div style="background:#FFFFFF; border:1px solid #E2E8F0; padding:40px; box-shadow:0 6px 24px rgba(0,0,0,0.06); border-radius:4px;" id="printArea">
                            
                            <!-- Kop Resmi Kartu -->
                            <div class="print-kop-header">
                                <img src="images/logo.png" alt="Logo Kemdikbudristek">
                                <div class="print-kop-text">
                                    <h4>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h4>
                                    <h5>PANITIA SELEKSI NASIONAL PENERIMAAN MAHASISWA BARU (SNPMB) 2026</h5>
                                    <p>Gedung D, Kemendikbudristek, Jalan Jenderal Sudirman, Senayan, Jakarta Pusat 10270</p>
                                </div>
                            </div>

                            <div class="card-section-title text-center" style="margin-bottom:25px;">
                                <h3>KARTU TANDA PESERTA SELEKSI</h3>
                                <p>Simulasi Seleksi Nasional Penerimaan Mahasiswa Baru Tahun Akademik 2026/2027</p>
                            </div>

                            <!-- Header Box with Participant Number & Photo -->
                            <div style="display:flex; justify-content:space-between; align-items:center; background:#F8FAFC; border:2px solid #E2E8F0; padding:18px 22px; border-radius:4px; margin-bottom:25px; gap:20px;">
                                <div style="flex:1;">
                                    <span style="font-size:12px; text-transform:uppercase; color:#64748B; font-weight:700; display:block; letter-spacing:0.5px;">
                                        NOMOR PESERTA RESMI:
                                    </span>
                                    <h2 style="font-size:32px; color:#181D37; margin:6px 0; font-weight:700; letter-spacing:1px; font-family:'Rasa',serif;">
                                        <?php echo htmlspecialchars($peserta['nomor_peserta']); ?>
                                    </h2>
                                    <span style="font-size:12.5px; color:#D97706; font-weight:600; display:inline-block;">
                                        <i class="fa fa-info-circle"></i> Jalur Seleksi: <strong><?php echo htmlspecialchars($peserta['jalur_seleksi']); ?></strong> &bull; Harap simpan nomor ini untuk cek pengumuman hasil.
                                    </span>
                                </div>
                                <div class="photo-frame">
                                    <i class="fa fa-user"></i>
                                    <span>PAS FOTO<br>3 X 4</span>
                                </div>
                            </div>

                            <!-- Candidate Identification Table -->
                            <table class="table table-bordered" style="font-size:14px; margin-bottom:25px;">
                                <tbody>
                                    <tr>
                                        <th style="width:35%; background:#F8FAFC;">Nama Lengkap Siswa</th>
                                        <td><strong><?php echo htmlspecialchars($peserta['nama_lengkap']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <th style="background:#F8FAFC;">Nomor Induk Siswa Nasional (NISN)</th>
                                        <td><?php echo htmlspecialchars($peserta['nisn']); ?></td>
                                    </tr>
                                    <tr>
                                        <th style="background:#F8FAFC;">Asal Sekolah</th>
                                        <td><?php echo htmlspecialchars($peserta['asal_sekolah']); ?></td>
                                    </tr>
                                    <tr>
                                        <th style="background:#F8FAFC;">Alamat Email Terdaftar</th>
                                        <td><?php echo htmlspecialchars($peserta['email']); ?></td>
                                    </tr>
                                    <tr>
                                        <th style="background:#F8FAFC;">Jalur Seleksi</th>
                                        <td>
                                            <span class="label label-primary" style="font-size:12px; padding:4px 10px;">
                                                <?php echo htmlspecialchars($peserta['jalur_seleksi']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="background:#F8FAFC;">Pilihan Program Studi 1 (Prioritas)</th>
                                        <td><strong><?php echo htmlspecialchars($peserta['pilihan_1']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <th style="background:#F8FAFC;">Pilihan Program Studi 2</th>
                                        <td><strong><?php echo htmlspecialchars($peserta['pilihan_2']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <th style="background:#F8FAFC;">Waktu Pendaftaran Tercatat</th>
                                        <td><?php echo htmlspecialchars($peserta['created_at'] ?? date('Y-m-d H:i:s')); ?> WIB</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Official Verification & Signature Row -->
                            <div class="print-signature-row">
                                <div class="sig-box">
                                    <div style="font-size:12px; color:#475569; margin-bottom:4px;">Tanda Tangan Peserta,</div>
                                    <div class="sig-space"></div>
                                    <strong style="font-size:13px; color:#181d37; display:block;"><?php echo htmlspecialchars($peserta['nama_lengkap']); ?></strong>
                                    <span style="font-size:11px; color:#64748b;">NISN: <?php echo htmlspecialchars($peserta['nisn']); ?></span>
                                </div>
                                <div style="text-align:center; flex:1; padding:0 20px;">
                                    <div style="display:inline-block; border:1px dashed #cbd5e1; padding:8px 14px; border-radius:4px; background:#f8fafc;">
                                        <i class="fa fa-qrcode" style="font-size:32px; color:#181d37; display:block; margin-bottom:4px;"></i>
                                        <span style="font-size:10px; font-weight:700; color:#64748b; letter-spacing:0.5px;">VALIDASI RESMI SISTEM</span>
                                    </div>
                                </div>
                                <div class="sig-box">
                                    <div style="font-size:12px; color:#475569; margin-bottom:4px;">Jakarta, <?php echo formatTanggalIndonesia(date('Y-m-d')); ?></div>
                                    <div style="font-size:12px; color:#475569;">Panitia Seleksi Nasional,</div>
                                    <div class="sig-space" style="border-bottom:1px solid #181d37;">
                                        <div style="padding-top:20px; font-size:11px; color:#15803d; font-weight:700; text-transform:uppercase;">
                                            <i class="fa fa-check-circle"></i> Tervalidasi Sistem
                                        </div>
                                    </div>
                                    <strong style="font-size:13px; color:#181d37; display:block;">TIM PELAKSANA SNPMB</strong>
                                    <span style="font-size:11px; color:#64748b;">Kemendikbudristek RI</span>
                                </div>
                            </div>

                        </div>

                        <!-- On-Screen Action Buttons (Excluded from Print) -->
                        <div class="row no-print" style="margin-top:25px;">
                            <div class="col-sm-6 text-left">
                                <button type="button" onclick="window.print()" class="btn-style-one" style="padding:12px 24px; border:none; cursor:pointer;">
                                    <i class="fa fa-print"></i> CETAK KARTU PESERTA
                                </button>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="pengumuman.php?nomor=<?php echo urlencode($peserta['nomor_peserta']); ?>" class="btn-style-two">
                                    CEK PENGUMUMAN HASIL &rarr;
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-12 text-center" style="padding:60px 0;">
                        <div class="section-title text-center">
                            <h3>DATA TIDAK DITEMUKAN</h3>
                            <p>Nomor peserta tidak tersedia dalam sesi ini. Silakan mendaftar terlebih dahulu.</p>
                        </div>
                        <a href="pendaftaran.php" class="btn-style-one">MENUJU FORM PENDAFTARAN</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
