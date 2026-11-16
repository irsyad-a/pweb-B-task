<?php
// faq.php - Pertanyaan Umum (FAQ) & Panduan Bantuan
require_once __DIR__ . '/includes/functions.php';

$page_title = 'cologne-education | Frequently Asked Questions';
$active_menu = 'faq';

require_once __DIR__ . '/includes/header.php';
?>

<style>
/* Scoped Styling for FAQ Section */
.faq-section {
    padding: 70px 0 90px 0;
    background: #f8fafc;
}

.faq-section-title {
    margin-bottom: 45px;
}
.faq-section-title h3 {
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
.faq-section-title p {
    font-size: 16px !important;
    line-height: 26px !important;
    font-family: 'Assistant', sans-serif !important;
    color: #666666 !important;
    margin-bottom: 0 !important;
}

/* Accordion Custom Styling */
.faq-accordion .panel {
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    margin-bottom: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    overflow: hidden;
    background: #ffffff;
    transition: all 0.2s ease;
}
.faq-accordion .panel:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 14px rgba(0,0,0,0.06);
}
.faq-accordion .panel-heading {
    padding: 0;
    background: #ffffff;
    border: none;
}
.faq-accordion .panel-title a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    font-size: 15.5px;
    font-weight: 700;
    color: #181d37;
    text-decoration: none !important;
    transition: all 0.2s ease;
}
.faq-accordion .panel-title a:hover {
    color: #f8b239;
    background: #f8fafc;
}
.faq-accordion .panel-title a .faq-q {
    display: inline-flex;
    align-items: center;
    gap: 12px;
}
.faq-accordion .panel-title a .faq-icon {
    color: #f8b239;
    font-size: 16px;
    flex-shrink: 0;
}
.faq-accordion .panel-title a .faq-arrow {
    font-size: 14px;
    color: #94a3b8;
    transition: transform 0.2s ease;
}
.faq-accordion .panel-title a[aria-expanded="true"] {
    background: #f8fafc;
    color: #181d37;
    border-left: 4px solid #f8b239;
}
.faq-accordion .panel-title a[aria-expanded="true"] .faq-arrow {
    transform: rotate(180deg);
    color: #f8b239;
}
.faq-accordion .panel-body {
    padding: 20px 26px 24px 48px;
    font-size: 14.5px;
    line-height: 1.75;
    color: #475569;
    border-top: 1px solid #f1f5f9;
    background: #ffffff;
}
.faq-accordion .panel-body strong {
    color: #181d37;
}

/* Helpdesk CTA Card */
.faq-cta-card {
    background: #181d37;
    border-radius: 4px;
    padding: 28px 32px;
    color: #ffffff;
    margin-top: 35px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    border-top: 3px solid #f8b239;
}
.faq-cta-card h4 {
    font-family: 'Rasa', serif;
    font-size: 20px;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 6px 0;
}
.faq-cta-card p {
    margin: 0;
    color: #cbd5e1;
    font-size: 13.5px;
}
</style>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/4.jpg);">
        <div class="container">
            <div class="title-text" style="background-image:url(images/icons/page-title.png);">
                <h1>FREQUENTLY ASKED QUESTIONS</h1>
                <ul class="title-menu clearfix">
                    <li><a href="index.php">home</a></li>
                    <li>FAQ / Bantuan</li>
                </ul>
            </div>           
        </div>
    </section>
    <!--End Page Title-->

    <section class="faq-section">
        <div class="container">
            <div class="faq-section-title text-center">
                <h3>PUSAT INFORMASI &amp; TANYA JAWAB</h3>
                <p>Panduan Lengkap Pendaftaran, Verifikasi Data, Pengumuman, dan FAQ Seleksi 2026</p>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="panel-group faq-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                        
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="h1">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#c1" aria-expanded="true" aria-controls="c1">
                                        <span class="faq-q">
                                            <i class="fa fa-question-circle faq-icon"></i>
                                            1. Apa perbedaan utama antara jalur seleksi SNBP dan SNBT?
                                        </span>
                                        <i class="fa fa-chevron-down faq-arrow"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="c1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="h1">
                                <div class="panel-body">
                                    <strong>SNBP (Seleksi Nasional Berdasarkan Prestasi)</strong> didasarkan pada prestasi akademik siswa menggunakan nilai rapor semester 1 sampai dengan semester 5, serta portofolio prestasi lainnya. Sedangkan <strong>SNBT (Seleksi Nasional Berdasarkan Tes)</strong> didasarkan pada hasil Ujian Tulis Berbasis Komputer (UTBK) yang mengukur potensi skolastik dan literasi.
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="h2">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#c2" aria-expanded="false" aria-controls="c2">
                                        <span class="faq-q">
                                            <i class="fa fa-question-circle faq-icon"></i>
                                            2. Bagaimana alur pendaftaran dalam sistem simulasi ini?
                                        </span>
                                        <i class="fa fa-chevron-down faq-arrow"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="c2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h2">
                                <div class="panel-body">
                                    Buka menu <strong>Pendaftaran</strong>, masukkan data diri seperti Nama Lengkap, NISN (10 digit), Asal Sekolah, dan Email. Pilih jalur seleksi (SNBP atau SNBT), tentukan 2 program studi pilihan yang berbeda, centang persetujuan, lalu klik <strong>Kirim Pendaftaran</strong>. Anda akan menerima Nomor Peserta resmi pada halaman Bukti Pendaftaran yang dapat langsung dicetak.
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="h3">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#c3" aria-expanded="false" aria-controls="c3">
                                        <span class="faq-q">
                                            <i class="fa fa-question-circle faq-icon"></i>
                                            3. Bagaimana cara mengecek hasil kelulusan peserta?
                                        </span>
                                        <i class="fa fa-chevron-down faq-arrow"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="c3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h3">
                                <div class="panel-body">
                                    Akses menu <strong>Pengumuman</strong>, masukkan Nomor Peserta Anda (contoh: <code>SNBP-2026-001</code>) atau nomor NISN 10 digit yang didaftarkan, lalu klik tombol <strong>Cari Hasil</strong>. Sistem akan langsung menampilkan status kelulusan (Lulus, Tidak Lulus, atau Menunggu) beserta opsi Cetak Surat Keterangan Hasil Seleksi (SKHS).
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="h4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#c4" aria-expanded="false" aria-controls="c4">
                                        <span class="faq-q">
                                            <i class="fa fa-question-circle faq-icon"></i>
                                            4. Di mana data pendaftaran disimpan dan apakah aman?
                                        </span>
                                        <i class="fa fa-chevron-down faq-arrow"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="c4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h4">
                                <div class="panel-body">
                                    Data pendaftaran dan hasil seleksi disimpan secara terpusat dan aman ke dalam basis data MySQL (<code>simulasi_snbp_snbt</code>) yang dikelola langsung melalui phpMyAdmin pada web server lokal XAMPP atau Laragon.
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="h5">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#c5" aria-expanded="false" aria-controls="c5">
                                        <span class="faq-q">
                                            <i class="fa fa-question-circle faq-icon"></i>
                                            5. Bagaimana cara login ke Panel Administrator?
                                        </span>
                                        <i class="fa fa-chevron-down faq-arrow"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="c5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h5">
                                <div class="panel-body">
                                    Klik tombol <strong>Admin</strong> di pojok kanan atas bilah navigasi, kemudian gunakan kredensial bawaan: Username: <code>admin</code> dan Password: <code>admin123</code> untuk mengelola data pendaftar dan status pengumuman.
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Helpdesk CTA Card -->
                    <div class="faq-cta-card">
                        <div>
                            <h4>
                                <i class="fa fa-life-ring" style="color:#f8b239; margin-right:8px;"></i>
                                Butuh Bantuan Lebih Lanjut?
                            </h4>
                            <p>
                                Hubungi Helpdesk SNPMB 2026 melalui telepon <strong>+62 (021) 500-SNBP</strong> atau email <strong>snbp.snbt@kemdikbud.go.id</strong>.
                            </p>
                        </div>
                        <div>
                            <a href="pendaftaran.php" class="btn-style-one" style="padding:10px 22px; font-size:13px; text-decoration:none !important;">
                                <i class="fa fa-pencil"></i> DAFTAR SEKARANG
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
