<?php
include 'nedmin/netting/process.php';


if (isset($_SESSION['userkullanici_mail'])) {
    $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
    $kullanicisor->execute(array(

        'mail' => $_SESSION['userkullanici_mail']

    ));
    $say = $kullanicisor->rowCount();
    $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
}

$ayarsor = $db->prepare("SELECT * FROM site_ayar");
$ayarsor->execute();

$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);


$footerayarsor = $db->prepare("SELECT * FROM footer");
$footerayarsor->execute();

$footerayarcek = $footerayarsor->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="tr">

<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo @  $ayarcek['ayar_description'] ?>">
    <meta name="keywords" content="<?php echo @$ayarcek['ayar_keywords'] ?>">
    <meta name="author" content="<?php echo @$ayarcek['ayar_author'] ?>">
    <!-- İcon -->
    <link rel="icon" href="<?php echo @$ayarcek['icon_resimyol'] ?>" type="image/icon type">
    <!-- İcon -->
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <!-- Font end -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="aos-by-red.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/girisyap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">

    <title><?php echo @$ayarcek['ayar_title'] ?></title>
    <style>
        body {
            font-family: 'Comfortaa', cursive;

        }

        html {
            font-size: 14px;
        }



        .Links ul li {

            padding: 15px;
        }

        .Links ul li a {
            border: 1px solid white;
            padding: 10px;
            color: red !important;
        }

        .Links ul li a:hover {
            background-color: white;
            color: red;
        }

        p {
            text-align: justify;
        }

        .SosyalMedya ul li a i {
            color: red;
            transition: all 0.6s;
        }

        .SosyalMedya ul li a i:Hover {

            font-size: 40px;
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: red;
            color: wheat;
            cursor: pointer;
            width: 30px;
            height: 30px;
            border-radius: 15px;
        }

        #myBtn:hover {
            background-color: wheat;
            color: red;
        }

        nav.menubar {
            padding: 12px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            transition: all .5s ease-in-out;
        }

        nav.menubar.scrolled {
            padding: 0 0px;

        }

        nav.menubar.scrolled ul li a {
            color: white;
        }

        nav.menubar.scrolled ul li a:hover {
            border-bottom: 2px solid white;
        }

        .logo {
            font-size: 34px;
            color: black;
            font-family: 'Dancing Script', cursive;
        }

        .bilgilermenu {

            transition: all 0.6s;
            border: 1px solid red;
        }

        @media screen and (max-width: 600px) {

            .SosyalMedya ul li a i {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <nav class=" navbar navbar-light navbar-expand-lg bg-white sticky-top menubar">
        <a class="navbar-brand logo pl-2" href="index.php">Eating-Maker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse Links" id="navbarNav">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item active">
                    <a class="nav-link text-danger text-center" href="index">Anasayfa</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link text-danger text-center" href="recipe">Yemek Tarifleri</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-danger text-center" href="malzemeler">Malzemeler</a>
                </li>

            </ul>
            <ul class="navbar-nav ms-auto">
                <hr>
                <?php
                if (!isset($_SESSION['userkullanici_mail'])) {

                ?>
                    <li class="nav-item ">
                        <a href="login" class="nav-link text-danger text-center">Giriş Yap</a>
                    </li>
                    <li class="nav-item ">
                        <a href="register" class="nav-link text-danger text-center">Kayıt Ol</a>
                    </li>
                <?php
                } else { ?>
                    <li class="nav-item">
                        <div class="dropdown p-3 bilgilermenu">
                            <button class="btn dropdown-toggle btn-sm w-100 pl-3 pr-3" type="button" data-toggle="dropdown">Hoşgeldin <?php echo $kullanicicek['kullanici_adsoyad'] ?>
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu w-100">
                                <li><a href="hesap" style="font-size: 16px;">Hesabım</a></li>
                                <li><a href=" logout" style="font-size: 16px;">Güvenli Çıkış</a></li>
                            </ul>
                        </div>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Sosyal Medya Start -->
    <div class="SosyalMedya">
        <ul class="navbar-nav mx-auto ">
            <li class="nav-item active ">
                <a class="nav-link" href="https://<?php echo $footerayarcek['footer_facebook'] ?>/"><i class="fab fa-facebook"></i>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="https://<?php echo $footerayarcek['footer_twitter'] ?>"><i class="fab fa-twitter"></i></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="https://<?php echo $footerayarcek['footer_youtube'] ?>/"><i class="fab fa-youtube"></i></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="https://<?php echo $footerayarcek['footer_instagram'] ?>/"><i class="fab fa-instagram"></i></a>
            </li>
        </ul>
    </div>

    <!-- Sosyal Medya End -->