<?php
if (!isset($page_title)) {
    $page_title = 'cologne-education | Portal Simulasi SNBP/SNBT 2026';
}
if (!isset($active_menu)) {
    $active_menu = 'home';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo htmlspecialchars($page_title); ?></title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/revolution-slider.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!--Favicon-->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="css/responsive.css" rel="stylesheet">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
<style>
/* Header Upper Alignment & Spacing */
.header-upper {
    padding: 26px 0 !important;
    background: #ffffff;
    border-bottom: 3px solid #f8b239;
}
.header-upper .header-upper-bg {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    position: relative !important;
}
.header-upper .main-logo {
    float: none !important;
    display: flex !important;
    align-items: center !important;
    margin: 0 !important;
    flex-shrink: 0 !important;
}
.header-upper .main-logo figure {
    margin: 0 !important;
}
.header-upper .main-logo figure a {
    display: inline-block !important;
}
.header-upper .main-logo img {
    max-height: 52px !important;
    width: auto !important;
    display: block !important;
}
.header-upper .top-info {
    float: none !important;
    margin: 0 !important;
    flex-shrink: 0 !important;
}
.header-upper .top-info ul {
    display: flex !important;
    align-items: center !important;
    margin: 0 !important;
    padding: 0 !important;
    list-style: none !important;
    gap: 32px !important;
}
.header-upper ul li.single-info-box {
    margin: 0 !important;
    top: 0 !important;
    padding-left: 54px !important;
    position: relative !important;
    display: flex !important;
    align-items: center !important;
}
.header-upper ul li.single-info-box .icon-holder {
    position: absolute !important;
    left: 0 !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    width: 42px !important;
    height: 42px !important;
    border: 1px solid #f8b239 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
}
.header-upper ul li.single-info-box .icon-holder span:before {
    color: #f8b239 !important;
    font-size: 22px !important;
    line-height: 40px !important;
    margin: 0 !important;
    display: inline-block !important;
}
.header-upper ul li.single-info-box .text-holder {
    margin: 0 !important;
    text-align: left !important;
}
.header-upper ul li.single-info-box .text-holder a {
    text-decoration: none !important;
    color: inherit !important;
}
.header-upper ul li.single-info-box .text-holder p {
    font-size: 15px !important;
    color: #222222 !important;
    font-family: 'Assistant', sans-serif !important;
    font-weight: 600 !important;
    line-height: 20px !important;
    margin: 0 !important;
}
.header-upper ul li.single-info-box .text-holder p span {
    color: #777777 !important;
    font-weight: 600 !important;
    font-family: 'Rasa', serif !important;
    font-size: 13px !important;
    line-height: 16px !important;
    display: block !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    margin-bottom: 2px !important;
}
.header-upper ul li.link_btn {
    margin: 0 !important;
    margin-left: 8px !important;
    display: flex !important;
    align-items: center !important;
}
.header-upper ul li.link_btn .btn-style-one {
    position: relative !important;
    width: auto !important;
    min-width: 180px !important;
    height: 42px !important;
    line-height: 42px !important;
    padding: 0 24px !important;
    margin: 0 !important;
    bottom: 0 !important;
    top: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-family: 'Rasa', serif !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    letter-spacing: 0.5px !important;
    text-transform: uppercase !important;
    background: #181d37 !important;
    color: #ffffff !important;
    border: 1px solid #181d37 !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.08) !important;
    transition: all 300ms ease !important;
}
.header-upper ul li.link_btn .btn-style-one:hover {
    background: #f8b239 !important;
    border-color: #f8b239 !important;
    color: #181d37 !important;
}

@media (max-width: 991px) {
    .header-upper .header-upper-bg {
        flex-direction: column !important;
        gap: 20px !important;
        text-align: center !important;
    }
    .header-upper .main-logo {
        justify-content: center !important;
    }
    .header-upper .top-info ul {
        flex-wrap: wrap !important;
        justify-content: center !important;
        gap: 20px !important;
    }
}
@media (max-width: 650px) {
    .header-upper .top-info ul {
        flex-direction: column !important;
        align-items: center !important;
        gap: 16px !important;
    }
    .header-upper ul li.single-info-box {
        width: 100% !important;
        max-width: 280px !important;
        justify-content: flex-start !important;
    }
    .header-upper ul li.link_btn .btn-style-one {
        width: 100% !important;
    }
}

/* Header Lower / Menu Bar Alignment Fix */
.menu-bar {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 0 15px !important;
}
.main-menu {
    float: none !important;
    display: inline-block !important;
}
.main-menu .navigation > li {
    margin-right: 18px !important;
}
.nav_right_area {
    float: none !important;
    display: inline-flex !important;
    align-items: center !important;
    margin: 0 !important;
}
.nav_right_area .login-option {
    margin-right: 0 !important;
    padding: 0 !important;
}
.nav_right_area .login-option a {
    color: #ffffff;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    font-family: 'Rasa', serif;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}
.nav_right_area .login-option a:hover {
    color: #181d37;
}
</style>
</head>

<body>
<div class="page-wrapper"> 	
    <!-- Preloader -->
    <div class="preloader"></div>

    <header class="main-header">
        <!-- Main Header-->
        <div class="header-upper">
            <div class="container">
                <div class="header-upper-bg clearfix">
                    <div class="main-logo">
                        <figure>
                            <a href="index.php"><img src="images/logo.png" alt="cologne-education"></a>
                        </figure>                        
                    </div>
                    <div class="top-info">
                        <ul>
                            <li class="single-info-box">
                                <div class="icon-holder">
                                    <span class="flaticon-phone-call"></span>
                                </div>
                                <div class="text-holder">
                                    <p><span>LAYANAN TELEPON:</span>+62 (021) 500-SNBP</p>
                                </div>
                            </li>
                            <li class="single-info-box">
                                <div class="icon-holder">
                                    <span class="flaticon-envelope"></span>
                                </div>
                                <div class="text-holder">
                                    <a href="mailto:snbp.snbt@kemdikbud.go.id"><p><span>EMAIL SIMULASI:</span>snbp.snbt@kemdikbud.go.id</p></a>
                                </div>
                            </li>
                            <li class="link_btn">
                               <a href="pendaftaran.php" class="btn-style-one">DAFTAR SEKARANG</a>
                            </li>
                        </ul>    
                    </div> 
                </div>                    
            </div>
        </div>
                    
        <div class="header-lower">
            <div class="container menu-bg">
                <div class="row menu-bar clearfix">
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="<?php echo ($active_menu === 'home') ? 'current' : ''; ?>">
                                    <a href="index.php"><i class="fa fa-home"></i>Home</a>
                                </li>
                                <li class="<?php echo ($active_menu === 'informasi') ? 'current' : ''; ?>">
                                    <a href="informasi.php">Informasi Seleksi</a>
                                </li>
                                <li class="<?php echo ($active_menu === 'pendaftaran') ? 'current' : ''; ?>">
                                    <a href="pendaftaran.php">Pendaftaran</a>
                                </li>
                                <li class="<?php echo ($active_menu === 'pengumuman') ? 'current' : ''; ?>">
                                    <a href="pengumuman.php">Pengumuman</a>
                                </li>
                                <li class="<?php echo ($active_menu === 'faq') ? 'current' : ''; ?>">
                                    <a href="faq.php">Bantuan / FAQ</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <ul class="nav_right_area">
                        <li class="login-option">
                            <a href="admin/login.php"><i class="flaticon-login"></i>
                            <span>Admin</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Sticky Header-->
        <div class="sticky-header">
            <div class="container menu-bg">
                <div class="row menu-bar clearfix">
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="<?php echo ($active_menu === 'home') ? 'current' : ''; ?>">
                                    <a href="index.php"><i class="fa fa-home"></i>Home</a>
                                </li>
                                <li class="<?php echo ($active_menu === 'informasi') ? 'current' : ''; ?>">
                                    <a href="informasi.php">Informasi Seleksi</a>
                                </li>
                                <li class="<?php echo ($active_menu === 'pendaftaran') ? 'current' : ''; ?>">
                                    <a href="pendaftaran.php">Pendaftaran</a>
                                </li>
                                <li class="<?php echo ($active_menu === 'pengumuman') ? 'current' : ''; ?>">
                                    <a href="pengumuman.php">Pengumuman</a>
                                </li>
                                <li class="<?php echo ($active_menu === 'faq') ? 'current' : ''; ?>">
                                    <a href="faq.php">Bantuan / FAQ</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <ul class="nav_right_area">
                        <li class="login-option">
                            <a href="admin/login.php"><i class="flaticon-login"></i>
                            <span>Admin</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!--End Sticky Header-->
