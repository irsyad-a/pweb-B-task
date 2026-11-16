<?php
// index.php - Beranda Portal Simulasi SNBP/SNBT 2026
require_once __DIR__ . '/includes/functions.php';

$page_title = 'cologne-education | Portal Simulasi SNBP/SNBT 2026';
$active_menu = 'home';
$prodi_list = getProgramStudiList();
$stats = getStatistikPeserta();

require_once __DIR__ . '/includes/header.php';
?>

    <!--Main Slider-->
    <section class="banner">
        <div class="rev_slider_wrapper">
            <div id="main_slider" class="rev_slider" data-version="5.0">
                <ul>
                    <li data-index='rs-355' class="slide_show slide_1" data-transition='boxslide' data-slotamount='default' data-easein='default' data-easeout='default' data-masterspeed='default' data-rotate='0' data-saveperformance='off' data-title='Slide Boxes' data-description=''>
                        <img src="images/main-slider/1.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">
                        <div class="tp-caption" data-x="center" data-hoffset="0"
                            data-y="center" data-voffset="-180"
                            data-whitespace="nowrap"
                            data-transform_idle="o:1;"
                            data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;s:1000;" 
                            data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                            data-start="2000" 
                            data-splitin="none" 
                            data-splitout="none">
                            <figure>
                                <img src="images/logo-3.png" alt="">
                            </figure>
                        </div>                  
                        <div class="main_heading tp-caption tp-resizeme"
                            data-x="center" data-hoffset="0"
                            data-y="center" data-voffset="-50"
                            data-whitespace="nowrap"
                            data-transform_idle="o:1;"
                            data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;s:1000;" 
                            data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                            data-start="2000" 
                            data-splitin="none" 
                            data-splitout="none">
                            <h1>Portal Seleksi Mahasiswa Baru<br>Simulasi SNBP & SNBT 2026</h1>
                        </div>
                        <div class="tp-caption tp-resizeme" 
                            data-x="center" data-hoffset="-100" 
                            data-y="center" data-voffset="100" 
                            data-transform_idle="o:1;"                         
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            data-start="2300">
                            <div class="slide-content-box">
                                <a class="btn-style-two" href="pendaftaran.php">DAFTAR SEKARANG</a>     
                            </div>
                        </div>
                        <div class="tp-caption tp-resizeme" 
                            data-x="center" data-hoffset="100" 
                            data-y="center" data-voffset="100" 
                            data-transform_idle="o:1;"                         
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            data-start="2600">
                            <div class="slide-content-box">
                                <a class="btn-style-three" href="pengumuman.php">CEK PENGUMUMAN</a>     
                            </div>
                        </div>
                    </li>

                    <li data-index='rs-356' class="slide_show slide_2" data-transition='slotslide-vertical' data-slotamount='default' data-easein='default' data-easeout='default' data-masterspeed='default' data-rotate='0' data-saveperformance='off' data-title='Slide Slots vertical' data-description=''>
                        <img src="images/main-slider/2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">
                        <div class="tp-caption" data-x="center" data-hoffset="0"
                            data-y="center" data-voffset="-180"
                            data-whitespace="nowrap"
                            data-transform_idle="o:1;"
                            data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;s:1000;" 
                            data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                            data-start="2000" 
                            data-splitin="none" 
                            data-splitout="none">
                            <figure>
                                <img src="images/logo-3.png" alt="">
                            </figure>
                        </div>                  
                        <div class="main_heading tp-caption tp-resizeme"
                            data-x="center" data-hoffset="0"
                            data-y="center" data-voffset="-50"
                            data-whitespace="nowrap"
                            data-transform_idle="o:1;"
                            data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;s:1000;" 
                            data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                            data-start="2000" 
                            data-splitin="none" 
                            data-splitout="none">
                            <h1>Seleksi Berdasarkan Prestasi (SNBP)<br>Rapor Semester 1 - 5 & Portofolio</h1>
                        </div>
                        <div class="tp-caption tp-resizeme" 
                            data-x="center" data-hoffset="-100" 
                            data-y="center" data-voffset="100" 
                            data-transform_idle="o:1;"                         
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            data-start="2300">
                            <div class="slide-content-box">
                                <a class="btn-style-two" href="informasi.php">INFORMASI SELEKSI</a>     
                            </div>
                        </div>
                        <div class="tp-caption tp-resizeme" 
                            data-x="center" data-hoffset="100" 
                            data-y="center" data-voffset="100" 
                            data-transform_idle="o:1;"                         
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            data-start="2600">
                            <div class="slide-content-box">
                                <a class="btn-style-three" href="pendaftaran.php">DAFTAR SEKARANG</a>     
                            </div>
                        </div>
                    </li>

                    <li class="slide_show slide_3" data-index='rs-381' data-transition='3dcurtain-vertical' data-slotamount='default' data-easein='default' data-easeout='default' data-masterspeed='default' data-rotate='0' data-saveperformance='off' data-title='3D Curtain Vertical' data-description=''>
                        <img src="images/main-slider/3.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">
                        <div class="tp-caption" data-x="center" data-hoffset="0"
                            data-y="center" data-voffset="-180"
                            data-whitespace="nowrap"
                            data-transform_idle="o:1;"
                            data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;s:1000;" 
                            data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                            data-start="2000" 
                            data-splitin="none" 
                            data-splitout="none">
                            <figure>
                                <img src="images/logo-3.png" alt="">
                            </figure>
                        </div>                  
                        <div class="main_heading tp-caption tp-resizeme"
                            data-x="center" data-hoffset="0"
                            data-y="center" data-voffset="-50"
                            data-whitespace="nowrap"
                            data-transform_idle="o:1;"
                            data-transform_in="z:0;rX:0deg;rY:0;rZ:0;sX:1.5;sY:1.5;skX:0;skY:0;opacity:0;s:2000;e:Power3.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;s:1000;" 
                            data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                            data-start="2000" 
                            data-splitin="none" 
                            data-splitout="none">
                            <h1>Ujian Tulis Berbasis Komputer (SNBT)<br>Tes Skolastik & Literasi Nasional</h1>
                        </div>
                        <div class="tp-caption tp-resizeme" 
                            data-x="center" data-hoffset="-100" 
                            data-y="center" data-voffset="100" 
                            data-transform_idle="o:1;"                         
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            data-start="2300">
                            <div class="slide-content-box">
                                <a class="btn-style-two" href="pendaftaran.php">DAFTAR SNBT</a>     
                            </div>
                        </div>
                        <div class="tp-caption tp-resizeme" 
                            data-x="center" data-hoffset="100" 
                            data-y="center" data-voffset="100" 
                            data-transform_idle="o:1;"                         
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            data-start="2600">
                            <div class="slide-content-box">
                                <a class="btn-style-three" href="pengumuman.php">CEK PENGUMUMAN</a>     
                            </div>
                        </div>
                    </li>                    
                </ul>
            </div>
        </div>
    </section>
    <!--Main Slider End-->

    <!--contact-form Quick Bar-->
    <section class="contact-form">
        <div class="container">
            <div class="form-widght clearfix" style="padding: 25px 35px 20px 35px;">
                <form method="get" action="pengumuman.php">
                    <div class="row clearfix" style="display:flex; align-items:flex-end; flex-wrap:wrap; margin:0;">
                        <div class="col-md-9 col-sm-8 col-xs-12" style="padding:0 15px;">
                            <div class="item" style="width:100%; margin:0;">
                                <h5 style="margin-top:0; margin-bottom:8px;">NOMOR PESERTA / NISN</h5>
                                <div class="form-group" style="margin-bottom:0;">
                                    <input type="text" name="nomor" placeholder="Contoh: SNBP-2026-001 atau NISN 10 digit" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12" style="padding:0 15px;">
                            <div class="item" style="width:100%; margin:0;">
                                <button type="submit" class="btn-style-one" style="height:40px; line-height:40px; width:100%; border:none; cursor:pointer; font-size:14px; text-align:center; padding:0;">
                                    <i class="fa fa-search"></i> CEK HASIL
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--contact-form end-->

    <!--about section-->
    <section class="about-section">
        <div class="container">
            <div class="section-title text-center">
                <h3>JALUR SELEKSI & KEUNGGULAN</h3>
                <p>Mekanisme Seleksi Penerimaan Mahasiswa Baru Berdasarkan Nilai Akademik dan Tes Potensi Skolastik</p>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item border-right border-bottom text-center">
                        <figure>
                            <a href="informasi.php"><img src="images/about/1.png" alt=""></a>
                        </figure>
                        <a href="informasi.php"><h5>JALUR SNBP (PRESTASI)</h5></a>
                        <p>Seleksi siswa eligible berdasarkan nilai rapor semester 1 sampai 5 dan portofolio kejuaraan.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item border-right border-bottom text-center">
                        <figure>
                            <a href="informasi.php"><img src="images/about/2.png" alt=""></a>
                        </figure>
                        <a href="informasi.php"><h5>JALUR SNBT (UTBK)</h5></a>
                        <p>Ujian Tulis Berbasis Komputer mencakup Tes Potensi Skolastik, Literasi Bahasa, dan Penalaran Matematika.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item border-bottom text-center">
                        <figure>
                            <a href="informasi.php"><img src="images/about/3.png" alt=""></a>
                        </figure>
                        <a href="informasi.php"><h5>10 PROGRAM STUDI</h5></a>
                        <p>Tersedia pilihan jenjang Sarjana (S1) bidang Saintek dan Soshum dengan kuota terstandarisasi.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item border-right text-center">
                        <figure>
                            <a href="pendaftaran.php"><img src="images/about/4.png" alt=""></a>
                        </figure>
                        <a href="pendaftaran.php"><h5>PENDAFTARAN ONLINE</h5></a>
                        <p>Pengisian formulir terpadu dengan validasi data nomor identitas NISN dan peminatan jurusan.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item border-right text-center">
                        <figure>
                            <a href="pengumuman.php"><img src="images/about/5.png" alt=""></a>
                        </figure>
                        <a href="pengumuman.php"><h5>PENGUMUMAN INSTAN</h5></a>
                        <p>Sistem pengecekan hasil seleksi secara real-time menggunakan nomor peserta atau NISN terdaftar.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="item text-center">
                        <figure>
                            <a href="faq.php"><img src="images/about/6.png" alt=""></a>
                        </figure>
                        <a href="faq.php"><h5>PUSAT BANTUAN</h5></a>
                        <p>Panduan terperinci, tanya jawab teknis, dan informasi praktikum untuk calon pendaftar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--about section end-->

    <!-- gallery_wrapper / OUR COURSES -->
    <div class="gallery_wrapper">
        <div class="section-title text-center">
            <h3>PROGRAM STUDI TERSEDIA</h3>
            <p>Daftar Pilihan Program Studi Jenjang Sarjana (S1) Saintek & Soshum Tahun 2026</p>
        </div>
        <div class="container menu_wrapper">
            <ul class="gallery_menu">
                <li class="filter active tran3s" data-filter="all">Semua Program Studi</li>
                <li class="filter tran3s" data-filter=".Saintek">Saintek</li>
                <li class="filter tran3s" data-filter=".Soshum">Soshum</li>
            </ul>
        </div>
        <div class="gallery_item_container gallery_style_eight gallery_text container" id="mixitup_list">
            <div class="row">
                
                <!-- Prodi 1 -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mix Saintek">
                    <div class="single_item">
                        <div class="img_holder">
                            <img src="images/gallery/2.jpg" alt="Teknik Informatika" class="img-responsive">
                            <div class="overlay tran3s">
                                <div class="link">
                                    <a href="images/gallery/2.jpg" class="fancybox"><i class="flaticon-plus-symbol"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <a href="pendaftaran.php"><h5>TEKNIK INFORMATIKA</h5></a>
                            <div class="reting-box">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                            <p>Akreditasi: Unggul &bull; Kuota: 60 Mahasiswa.</p>
                            <a href="pendaftaran.php">DAFTAR SEKARANG</a>
                            <div class="price-many">S1</div>
                        </div>
                        <ul class="content-text">
                            <li class="time-duration"><i class="flaticon-time"></i> Durasi: 4 Thn</li>
                            <li class="students"><i class="flaticon-students-cap"></i> Saintek</li>
                        </ul>
                    </div>
                </div>

                <!-- Prodi 2 -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mix Saintek">
                    <div class="single_item">
                        <div class="img_holder">
                            <img src="images/gallery/3.jpg" alt="Kedokteran" class="img-responsive">
                            <div class="overlay tran3s">
                                <div class="link">
                                    <a href="images/gallery/3.jpg" class="fancybox"><i class="flaticon-plus-symbol"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <a href="pendaftaran.php"><h5>KEDOKTERAN</h5></a>
                            <div class="reting-box">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                            <p>Akreditasi: Unggul &bull; Kuota: 45 Mahasiswa.</p>
                            <a href="pendaftaran.php">DAFTAR SEKARANG</a>
                            <div class="price-many">S1</div>
                        </div>
                        <ul class="content-text">
                            <li class="time-duration"><i class="flaticon-time"></i> Durasi: 5 Thn</li>
                            <li class="students"><i class="flaticon-students-cap"></i> Saintek</li>
                        </ul>
                    </div>
                </div>

                <!-- Prodi 3 -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mix Saintek">
                    <div class="single_item">
                        <div class="img_holder">
                            <img src="images/gallery/6.jpg" alt="images" class="img-responsive">
                            <div class="overlay tran3s">
                                <div class="link">
                                    <a href="images/gallery/6.jpg" class="fancybox"><i class="flaticon-plus-symbol"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <a href="pendaftaran.php"><h5>SISTEM INFORMASI</h5></a>
                            <div class="reting-box">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                            </div>
                            <p>Akreditasi: A &bull; Kuota: 50 Mahasiswa.</p>
                            <a href="pendaftaran.php">DAFTAR SEKARANG</a>
                            <div class="price-many">S1</div>
                        </div>
                        <ul class="content-text">
                            <li class="time-duration"><i class="flaticon-time"></i> Durasi: 4 Thn</li>
                            <li class="students"><i class="flaticon-students-cap"></i> Saintek</li>
                        </ul>
                    </div>
                </div>

                <!-- Prodi 4 -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mix Soshum">
                    <div class="single_item">
                        <div class="img_holder">
                            <img src="images/gallery/5.jpg" alt="images" class="img-responsive">
                            <div class="overlay tran3s">
                                <div class="link">
                                    <a href="images/gallery/5.jpg" class="fancybox"><i class="flaticon-plus-symbol"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <a href="pendaftaran.php"><h5>MANAJEMEN</h5></a>
                            <div class="reting-box">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                            <p>Akreditasi: Unggul &bull; Kuota: 75 Mahasiswa.</p>
                            <a href="pendaftaran.php">DAFTAR SEKARANG</a>
                            <div class="price-many">S1</div>
                        </div>
                        <ul class="content-text">
                            <li class="time-duration"><i class="flaticon-time"></i> Durasi: 4 Thn</li>
                            <li class="students"><i class="flaticon-students-cap"></i> Soshum</li>
                        </ul>
                    </div>
                </div>

                <!-- Prodi 5 -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mix Soshum">
                    <div class="single_item">
                        <div class="img_holder">
                            <img src="images/gallery/1.jpg" alt="images" class="img-responsive">
                            <div class="overlay tran3s">
                                <div class="link">
                                    <a href="images/gallery/1.jpg" class="fancybox"><i class="flaticon-plus-symbol"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <a href="pendaftaran.php"><h5>ILMU HUKUM</h5></a>
                            <div class="reting-box">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                            <p>Akreditasi: Unggul &bull; Kuota: 80 Mahasiswa.</p>
                            <a href="pendaftaran.php">DAFTAR SEKARANG</a>
                            <div class="price-many">S1</div>
                        </div>
                        <ul class="content-text">
                            <li class="time-duration"><i class="flaticon-time"></i> Durasi: 4 Thn</li>
                            <li class="students"><i class="flaticon-students-cap"></i> Soshum</li>
                        </ul>
                    </div>
                </div>

                <!-- Prodi 6 -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mix Soshum">
                    <div class="single_item">
                        <div class="img_holder">
                            <img src="images/gallery/4.jpg" alt="images" class="img-responsive">
                            <div class="overlay tran3s">
                                <div class="link">
                                    <a href="images/gallery/4.jpg" class="fancybox"><i class="flaticon-plus-symbol"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <a href="pendaftaran.php"><h5>AKUNTANSI</h5></a>
                            <div class="reting-box">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
                            </div>
                            <p>Akreditasi: Unggul &bull; Kuota: 70 Mahasiswa.</p>
                            <a href="pendaftaran.php">DAFTAR SEKARANG</a>
                            <div class="price-many">S1</div>
                        </div>
                        <ul class="content-text">
                            <li class="time-duration"><i class="flaticon-time"></i> Durasi: 4 Thn</li>
                            <li class="students"><i class="flaticon-students-cap"></i> Soshum</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End gallery_wrapper -->

<?php require_once __DIR__ . '/includes/footer.php'; ?>
