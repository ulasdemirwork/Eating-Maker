<?php
ob_start();
session_start();
include 'connection.php';

if (isset($_POST['adminlogin'])) {

    $kullanici_mail =  htmlspecialchars($_POST['kullanici_mail']);
    $kullanici_password = md5($_POST['kullanici_password']);

    $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:passwordd and kullanici_yetki=:yetki");
    $kullanicisor->execute(array(

        'yetki' => 5,
        'mail' => $kullanici_mail,
        'passwordd' => md5($kullanici_password)
    ));
    $say = $kullanicisor->rowCount();
    if ($say == 1) {

        $_SESSION['kullanici_mail'] = $kullanici_mail;
        header("location:../production/index.php?durum=ok");
    } else {
        header("location:../production/login.php?durum=no");
    }
}
if (isset($_POST['edituser'])) {

    $kullanici_id = $_POST['kullanici_id'];
    $ayarkaydet = $db->prepare("UPDATE kullanici SET
    kullanici_tc=:kullanici_tc,
    kullanici_adsoyad=:kullanici_adsoyad,
    kullanici_il=:kullanici_il,
    kullanici_ilce=:kullanici_ilce,
    kullanici_adres=:kullanici_adres,
    kullanici_yetki=:kullanici_yetki,
    kullanici_gsm=:kullanici_gsm,
    kullanici_durum=:kullanici_durum
    WHERE kullanici_id={$_POST['kullanici_id']}");

    $update = $ayarkaydet->execute(array(
        'kullanici_tc' => $_POST['kullanici_tc'],
        'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
        'kullanici_il' => $_POST['kullanici_il'],
        'kullanici_ilce' => $_POST['kullanici_ilce'],
        'kullanici_adres' => $_POST['kullanici_adres'],
        'kullanici_yetki' => $_POST['kullanici_yetki'],
        'kullanici_gsm' => $_POST['kullanici_gsm'],
        'kullanici_durum' => $_POST['kullanici_durum']
    ));
    if ($update) {
        header("location:../production/edit-user.php?kullanici_id=$kullanici_id&durum=ok");
    } else {

        header("location:../produciton/edit-user.php?kullanici_id=$kullanici_id&durum=no");
    }
}

if (isset($_POST['yemekduzenle'])) {


    $uploads_dir = '../../dimg/yemekler';
    @$tmp_name = $_FILES['tarif_resimyol']["tmp_name"];
    @$name = $_FILES['tarif_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


    $tarif_id = $_POST['tarif_id'];
    $ayarkaydet = $db->prepare("UPDATE yemek_tarif SET
    tarif_baslik=:tarif_baslik,
    tarif_aciklama=:tarif_aciklama,
    tarif_footer=:tarif_footer,
    tarif_durum=:tarif_durum,
    tarif_resimyol=:tarif_resimyol,
    yemek_tur=:yemek_tur,
    yemek_icerik=:yemek_icerik
    WHERE tarif_id={$_POST['tarif_id']}");

    $update = $ayarkaydet->execute(array(
        'tarif_baslik' => $_POST['tarif_baslik'],
        'tarif_aciklama' => $_POST['tarif_aciklama'],
        'tarif_footer' => $_POST['tarif_footer'],
        'tarif_durum' => $_POST['tarif_durum'],
        'tarif_resimyol' => $refimgyol,
        'yemek_tur' => $_POST['yemek_tur'],
        'yemek_icerik' => $_POST['yemek_icerik']
    ));
    if ($update) {
        header("location:../production/yemekler.php?tarif_id=$tarif_id&durum=ok");
    } else {

        header("location:../produciton/yemek-duzenle.php?tarif_id=$tarif_id&durum=no");
    }
}

if (isset($_POST['malzemeurunduzenle'])) {


    $uploads_dir = '../../dimg/urunler';
    @$tmp_name = $_FILES['malzeme_resimyol']["tmp_name"];
    @$name = $_FILES['malzeme_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


    $malzeme_id = $_POST['malzeme_id'];
    $ayarkaydet = $db->prepare("UPDATE malzeme_ekle SET
    malzeme_isim=:malzeme_isim,
    malzeme_sira=:malzeme_sira,
    malzeme_durum=:malzeme_durum,
    malzeme_resimyol=:malzeme_resimyol
    WHERE malzeme_id={$_POST['malzeme_id']}");

    $update = $ayarkaydet->execute(array(
        'malzeme_isim' => $_POST['malzeme_isim'],
        'malzeme_sira' => $_POST['malzeme_sira'],
        'malzeme_durum' => $_POST['malzeme_durum'],
        'malzeme_resimyol' => $refimgyol
    ));
    if ($update) {
        header("location:../production/malzeme-urun.php?malzeme_id=$malzeme_id&durum=ok");
    } else {
        header("location:../produciton/malzeme-urun-duzenle.php?malzeme_id=$malzeme_id&durum=no");
    }
}



if (isset($_POST['anasayfayemekduzenle'])) {

    $yemek_id = $_POST['yemek_id'];
    $ayarkaydet = $db->prepare("UPDATE anasayfa_yemek SET
    yemek_baslik=:yemek_baslik,
    yemek_aciklama=:yemek_aciklama,
    yemek_footer=:yemek_footer,
    yemek_durum=:yemek_durum
    WHERE yemek_id={$_POST['yemek_id']}");

    $update = $ayarkaydet->execute(array(
        'yemek_baslik' => $_POST['yemek_baslik'],
        'yemek_aciklama' => $_POST['yemek_aciklama'],
        'yemek_footer' => $_POST['yemek_footer'],
        'yemek_durum' => $_POST['yemek_durum']
    ));
    if ($update) {
        header("location:../production/anasayfa-yemekler.php?yemek_id=$yemek_id&durum=ok");
    } else {

        header("location:../produciton/anasayfa-yemek-duzenle.php?yemek_id=$yemek_id&durum=no");
    }
}

if (isset($_POST['paylasilanyemekduzenle'])) {

    $uploads_dir = '../../dimg/yemekler';
    @$tmp_name = $_FILES['tarif_resimyol']["tmp_name"];
    @$name = $_FILES['tarif_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


    $tarif_id = $_POST['tarif_id'];
    $ayarkaydet = $db->prepare("UPDATE yemek_tarif SET
    tarif_baslik=:tarif_baslik,
    tarif_aciklama=:tarif_aciklama,
    tarif_footer=:tarif_footer,
    tarif_resimyol=:tarif_resimyol,
    yemek_tur=:yemek_tur,
    yemek_icerik=:yemek_icerik
    WHERE tarif_id={$_POST['tarif_id']}");

    $update = $ayarkaydet->execute(array(
        'tarif_baslik' => $_POST['tarif_baslik'],
        'tarif_aciklama' => $_POST['tarif_aciklama'],
        'tarif_footer' => $_POST['tarif_footer'],
        'tarif_resimyol' => $refimgyol,
        'yemek_tur' => $_POST['yemek_tur'],
        'yemek_icerik' => $_POST['yemek_icerik']
    ));
    if ($update) {
        header("location:../../paylasilanyemek-duzenle.php?tarif_id=$tarif_id&durum=ok");
    } else {
        header("location:../../paylasilanyemek-duzenle.php?tarif_id=$tarif_id&durum=no");
    }
}

if (isset($_POST['sliderkaydet'])) {

    $uploads_dir = '../../dimg/slider';
    @$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
    @$name = $_FILES['slider_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


    $sliderkaydet = $db->prepare("INSERT INTO slider SET
    slider_ad=:slider_ad,
    slider_sira=:slider_sira,
    slider_link=:slider_link,
    slider_resimyol=:slider_resimyol
    ");

    $insert = $sliderkaydet->execute(array(
        'slider_ad' => $_POST['slider_ad'],
        'slider_sira' => $_POST['slider_sira'],
        'slider_link' => $_POST['slider_link'],
        'slider_resimyol' => $refimgyol
    ));
    if ($insert) {
        header("location:../production/slider-listele.php?durum=ok");
    } else {
        header("location:../production/slider-listele.php?durum=no");
    }
}

if (isset($_POST['sliderduzenle'])) {

    $uploads_dir = '../../dimg/slider';
    @$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
    @$name = $_FILES['slider_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


    $slider_id = $_POST['slider_id'];
    $sliderkaydet = $db->prepare("UPDATE slider SET
    slider_ad=:slider_ad,
    slider_sira=:slider_sira,
    slider_link=:slider_link,
    slider_resimyol=:slider_resimyol,
    slider_durum=:slider_durum
    WHERE slider_id={$_POST['slider_id']}");

    $update = $sliderkaydet->execute(array(
        'slider_ad' => $_POST['slider_ad'],
        'slider_sira' => $_POST['slider_sira'],
        'slider_link' => $_POST['slider_link'],
        'slider_durum' => $_POST['slider_durum'],
        'slider_resimyol' => $refimgyol
    ));
    if ($update) {
        header("location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");
    } else {
        header("location:../production/slider-duzenle.php?slider_id=$slider_id&durum=no");
    }
}


if (isset($_GET['kullanicisil']) == "ok") {
    $sil = $db->prepare("DELETE  FROM kullanici where kullanici_id=:id");
    $kontrol = $sil->execute(array(

        'id' => $_GET['kullanici_id']
    ));
    if ($kontrol) {
        header("Location:../production/user.php?sil=ok");
    } else {
        header("Location:../production/user.php?sil=no");
    }
}


if (isset($_GET['tarifsil']) == "ok") {
    $sil = $db->prepare("DELETE  FROM yemek_tarif where tarif_id=:id");
    $kontrol = $sil->execute(array(

        'id' => $_GET['tarif_id']
    ));
    if ($kontrol) {
        header("Location:../production/yemekler.php?sil=ok");
    } else {
        header("Location:../production/yemekler.php?sil=no");
    }
}

if (isset($_GET['slidersil']) == "ok") {
    $sil = $db->prepare("DELETE  FROM slider where slider_id=:id");
    $kontrol = $sil->execute(array(

        'id' => $_GET['slider_id']
    ));
    if ($kontrol) {
        header("Location:../production/slider-listele.php?sil=ok");
    } else {
        header("Location:../production/slider-listele.php?sil=no");
    }
}


if (isset($_GET['yemeksil']) == "ok") {
    $sil = $db->prepare("DELETE  FROM anasayfa_yemek where yemek_id=:id");
    $kontrol = $sil->execute(array(

        'id' => $_GET['yemek_id']
    ));
    if ($kontrol) {
        header("Location:../production/anasayfa-yemekler.php?sil=ok");
    } else {
        header("Location:../production/anasayfa-yemekler.php?sil=no");
    }
}


if (isset($_GET['tarifimisil']) == "ok") {
    $sil = $db->prepare("DELETE  FROM yemek_tarif where tarif_id=:tarif_id");
    $kontrol = $sil->execute(array(

        'tarif_id' => $_GET['tarif_id']
    ));
    if ($kontrol) {
        header("Location:../../paylasilan-yemek.php?sil=ok");
    } else {
        header("Location:../../paylasilan-yemek.php?sil=no");
    }
}




if (isset($_POST['usersave'])) {

    $kullanici_mail = htmlspecialchars($_POST['kullanici_mail']);
    $kullanici_adsoyad = htmlspecialchars($_POST['kullanici_adsoyad']);
    $kullanici_passwordone = $_POST['kullanici_passwordone'];
    $kullanici_passwordtwo = $_POST['kullanici_passwordtwo'];
    $kullanici_gsm = $_POST['kullanici_gsm'];
    $guvenlik_kod = $_POST['guvenlik_kod'];
    if (strtoupper($_POST['guvenlik_kod']) == $_SESSION['dogrulamakodu']) {

        $MailAdresi = $_POST["kullanici_mail"];
        $patternmail = '/^[a-z]+[A-z0-9\-_\.]+@[A-z0-9\-]+\.[A-z0-9\-]+/';
        $eslesmemail = preg_match($patternmail, $MailAdresi);
        if ($eslesmemail == 1) {

            $TelefonNumarasi = $_POST["kullanici_gsm"];
            $telUzunluk = strlen($TelefonNumarasi);
            $pattern = "/5[0,3,4,5,6][0-9]\d\d\d\d\d\d\d$/";
            $eslesme = preg_match($pattern, $TelefonNumarasi);
            if ($eslesme == 1 && $telUzunluk == 10) {

                if ($kullanici_passwordone == $kullanici_passwordtwo) {
                    if (strlen($kullanici_passwordone >= 6)) {

                        $kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_mail=:mail and kullanici_gsm=:gsm");
                        $kullanicisor->execute(array(
                            'mail' => $kullanici_mail,
                            'gsm' => $kullanici_gsm
                        ));


                        $say = $kullanicisor->rowCount();

                        if ($say == 0) {

                            $kullanici_yetki = 1;
                            $kullanici_password = $_POST['kullanici_passwordone'];

                            $passwordhash = password_hash($kullanici_password, PASSWORD_DEFAULT);

                            $kullanicikaydet = $db->prepare("INSERT INTO kullanici SET
                kullanici_adsoyad=:kullanici_adsoyad,
                kullanici_mail=:kullanici_mail,
                kullanici_password=:kullanici_password,
                kullanici_yetki=:kullanici_yetki,
                kullanici_gsm=:kullanici_gsm

            ");
                            $insert = $kullanicikaydet->execute(array(
                                'kullanici_adsoyad' => $kullanici_adsoyad,
                                'kullanici_mail' => $kullanici_mail,
                                'kullanici_password' => $passwordhash,
                                'kullanici_yetki' => $kullanici_yetki,
                                'kullanici_gsm' => $kullanici_gsm
                            ));

                            if ($insert) {
                                echo $_SESSION['userkullanici_mail'] = $kullanici_mail;
                                header("Location:../../hesap.php?durum=kayitbasarili");
                            } else {
                                header("Location:../../register.php?durum=basarisiz");
                            }
                        } else {
                            header("Location:../../register.php?durum=mukerrerkayit");
                        }
                    } else {
                        header("Location:../../register.php?durum=sifreuzunluk");
                    }
                } else {
                    header("Location:../../register.php?durum=farklisifre");
                }
            } else {
                header("Location:../../register.php?durum=telhatali");
            }
        } else {
            header("Location:../../register.php?durum=mailhatali");
        }
    } else {
        header("Location:../../register.php?durum=kodhatali");
    }
}

if (isset($_POST['userlogin'])) {


    $benihatirla = @intval($_POST['hatirla']);
    $kullanici_mail =  htmlspecialchars($_POST['kullanici_mail']);
    $kullanici_password = $_POST['kullanici_password'];

    $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_yetki=:yetki");

    $kullanicisor->execute(array(

        'mail' => $kullanici_mail,
        'yetki' => 1
    ));

    $say = $kullanicisor->rowCount();

    $kullanicicek = $kullanicisor->fetch();
    $hashpassword = $kullanicicek['kullanici_password'];

    if ($say == 1) {
        if (password_verify($kullanici_password, $hashpassword)) {

            if ($benihatirla == 1) {
                $cookieArray = array("kullanici_mail" => $kullanici_mail, "kullanici_sifre" => $kullanici_password);
                $cookieArray = json_encode($cookieArray);
                setcookie("hatirla", $cookieArray, time() + 60 * 60 * 24, '/index.php');
            }

            $_SESSION['userkullanici_mail'] = $kullanici_mail;
            header("location:../../hesap.php?durum=ok");
        } else {
            header("location:../../login.php?durum=no");
        }
    }
}






if (isset($_POST['userupdate'])) {

    $kullanici_id = $_POST['kullanici_id'];


    $TelefonNumarasi = $_POST["kullanici_gsm"];
    $telUzunluk = strlen($TelefonNumarasi);
    $pattern = "/5[0,3,4,5,6][0-9]\d\d\d\d\d\d\d$/";
    $eslesme = preg_match($pattern, $TelefonNumarasi);
    if ($eslesme == 1 && $telUzunluk == 10) {
        $ayarkaydet = $db->prepare("UPDATE kullanici SET
    
    kullanici_adsoyad=:kullanici_adsoyad,
    kullanici_gsm=:kullanici_gsm,
    kullanici_password=:kullanici_password
    
    WHERE kullanici_id={$_POST['kullanici_id']}");

        $update = $ayarkaydet->execute(array(

            'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
            'kullanici_gsm' => $_POST['kullanici_gsm'],
            'kullanici_password' => password_hash($_POST['kullanici_password'], PASSWORD_DEFAULT)
        ));

        if ($update) {
            header("location:../../hesapprofil.php?kullanici_id=$kullanici_id&durum=ok");
        }
    } else {

        header("location:../../hesapprofil.php?kullanici_id=$kullanici_id&durum=no");
    }
}


if (isset($_POST['passwordupdate'])) {

    $kullanici_passwordone = md5($_POST['kullanici_passwordone']);
    $kullanici_passwordtwo = md5($_POST['kullanici_passwordtwo']);


    if ($kullanici_passwordone == $kullanici_passwordtwo) {
        if (strlen($kullanici_passwordone >= 6)) {

            $kullanici_password = md5($kullanici_passwordone);
            $kullanici_id = $_POST['kullanici_id'];

            $ayarkaydet = $db->prepare("UPDATE kullanici SET
            
            kullanici_password=:kullanici_password 
            
            WHERE kullanici_id={$_POST['kullanici_id']}");

            $update = $ayarkaydet->execute(array(

                'kullanici_password' => $kullanici_password

            ));

            if ($update) {
                header("location:../../hesappassword.php?kullanici_id=$kullanici_id&durum=ok");
            } else {
                header("location:../../hesappassword.php?kullanici_id=$kullanici_id&durum=no");
            }
        } else {
            header("location:../../hesappassword.php?kullanici_id=$kullanici_id&durum=sifreuzunluk");
        }
    } else {
        header("Location:../../hesappassword.php?kullanici_id=$kullanici_id&durum=no");
    }
}


if (isset($_POST['yemektarifkaydet'])) {

    $uploads_dir = '../../dimg/yemekler';
    @$tmp_name = $_FILES['tarif_resimyol']["tmp_name"];
    @$name = $_FILES['tarif_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



    $kaydet = $db->prepare("INSERT INTO yemek_tarif SET
		tarif_baslik=:tarif_baslik,
		tarif_aciklama=:tarif_aciklama,
        tarif_footer=:tarif_footer,
		tarif_durum=:tarif_durum,
		tarif_resimyol=:tarif_resimyol
		");
    $insert = $kaydet->execute(array(
        'tarif_baslik' => $_POST['tarif_baslik'],
        'tarif_aciklama' => $_POST['tarif_aciklama'],
        'tarif_footer' => $_POST['tarif_footer'],
        'tarif_durum' => $_POST['tarif_durum'],
        'tarif_resimyol' => $refimgyol
    ));

    if ($insert) {

        Header("Location:../production/yemekler.php?durum=ok");
    } else {

        Header("Location:../production/yemek-ekle.php?durum=no");
    }
}


if (isset($_POST['malzemeurunkaydet'])) {

    $uploads_dir = '../../dimg/urunler';
    @$tmp_name = $_FILES['malzeme_resimyol']["tmp_name"];
    @$name = $_FILES['malzeme_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



    $kaydet = $db->prepare("INSERT INTO malzeme_ekle SET
		malzeme_isim=:malzeme_isim,
		malzeme_sira=:malzeme_sira,
        malzeme_durum=:malzeme_durum,
		malzeme_resimyol=:malzeme_resimyol
		");
    $insert = $kaydet->execute(array(
        'malzeme_isim' => $_POST['malzeme_isim'],
        'malzeme_sira' => $_POST['malzeme_sira'],
        'malzeme_durum' => $_POST['malzeme_durum'],
        'malzeme_resimyol' => $refimgyol
    ));

    if ($insert) {
        Header("Location:../production/malzeme-urun.php?durum=ok");
    } else {

        Header("Location:../production/malzeme-urun-ekle.php?durum=no");
    }
}


if (isset($_POST['anasayfayemekkaydet'])) {


    $kaydet = $db->prepare("INSERT INTO anasayfa_yemek SET
		yemek_baslik=:yemek_baslik,
		yemek_aciklama=:yemek_aciklama,
        yemek_footer=:yemek_footer,
		yemek_durum=:yemek_durum
		");
    $insert = $kaydet->execute(array(
        'yemek_baslik' => $_POST['yemek_baslik'],
        'yemek_aciklama' => $_POST['yemek_aciklama'],
        'yemek_footer' => $_POST['yemek_footer'],
        'yemek_durum' => $_POST['yemek_durum']
    ));

    if ($insert) {

        Header("Location:../production/anasayfa-yemekler.php?durum=ok");
    } else {

        Header("Location:../production/anasayfa-yemek-ekle.php?durum=no");
    }
}


if (isset($_POST['malzemeyemekkaydet'])) {


    $kaydet = $db->prepare("INSERT INTO malzemeler_yemek SET
		malzemeler_yemek_baslik=:malzemeler_yemek_baslik,
		malzemeler_yemek_aciklama=:malzemeler_yemek_aciklama,
        malzemeler_yemek_video=:malzemeler_yemek_video,
		ana_malzeme=:ana_malzeme
		");
    $insert = $kaydet->execute(array(
        'malzemeler_yemek_baslik' => $_POST['malzemeler_yemek_baslik'],
        'malzemeler_yemek_aciklama' => $_POST['malzemeler_yemek_aciklama'],
        'malzemeler_yemek_video' => $_POST['malzemeler_yemek_video'],
        'ana_malzeme' => $_POST['ana_malzeme']
    ));

    if ($insert) {

        Header("Location:../production/malzemeler.php?durum=ok");
    } else {

        Header("Location:../production/malzemeler.php?durum=no");
    }
}




if (isset($_POST['hesapyemektarifkaydet'])) {

    $uploads_dir = '../../dimg/yemekler';
    @$tmp_name = $_FILES['tarif_resimyol']["tmp_name"];
    @$name = $_FILES['tarif_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



    $kaydet = $db->prepare("INSERT INTO yemek_tarif SET
		tarif_baslik=:tarif_baslik,
		tarif_aciklama=:tarif_aciklama,
        tarif_footer=:tarif_footer,
		tarif_resimyol=:tarif_resimyol,
        paylasan_kullanici=:paylasan_kullanici,
        yemek_tur=:yemek_tur,
        yemek_icerik=:yemek_icerik
		");
    $insert = $kaydet->execute(array(
        'tarif_baslik' => $_POST['tarif_baslik'],
        'tarif_aciklama' => $_POST['tarif_aciklama'],
        'tarif_footer' => $_POST['tarif_footer'],
        'tarif_resimyol' => $refimgyol,
        'paylasan_kullanici' => $_POST['paylasan_kullanici'],
        'yemek_tur' => $_POST['yemek_tur'],
        'yemek_icerik' => $_POST['yemek_icerik']
    ));

    if ($insert) {

        Header("Location:../../hesapyemek-tarif.php?durum=ok");
    } else {

        Header("Location:../../hesapyemek-tarif.php?durum=no");
    }
}


if (isset($_POST['memleketyemekekle'])) {

    $uploads_dir = '../../dimg/yemekler';
    @$tmp_name = $_FILES['memleket_resimyol']["tmp_name"];
    @$name = $_FILES['memleket_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



    $kaydet = $db->prepare("INSERT INTO memleket_yemek SET
		memleket_isim=:memleket_isim,
		memleket_yemek_isim=:memleket_yemek_isim,
        memleket_icerik=:memleket_icerik,
		memleket_resimyol=:memleket_resimyol,
        memleket_videoyol=:memleket_videoyol,
        memleket_durum=:memleket_durum
		");
    $insert = $kaydet->execute(array(
        'memleket_isim' => $_POST['memleket_isim'],
        'memleket_yemek_isim' => $_POST['memleket_yemek_isim'],
        'memleket_icerik' => $_POST['memleket_icerik'],
        'memleket_resimyol' => $refimgyol,
        'memleket_videoyol' => $_POST['memleket_videoyol'],
        'memleket_durum' => $_POST['memleket_durum']
    ));

    if ($insert) {
        Header("Location:../production/memleket-listele.php?durum=ok");
    } else {

        Header("Location:../production/memleket-listele.php?durum=no");
    }
}

if (isset($_POST['memleketduzenle'])) {

    $uploads_dir = '../../dimg/yemekler';
    @$tmp_name = $_FILES['memleket_resimyol']["tmp_name"];
    @$name = $_FILES['memleket_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



    $kaydet = $db->prepare("UPDATE memleket_yemek SET
		memleket_isim=:memleket_isim,
		memleket_yemek_isim=:memleket_yemek_isim,
        memleket_resimyol=:memleket_resimyol,
        memleket_videoyol=:memleket_videoyol,
        memleket_icerik=:memleket_icerik,
        memleket_durum=:memleket_durum
		");
    $insert = $kaydet->execute(array(
        'memleket_isim' => $_POST['memleket_isim'],
        'memleket_yemek_isim' => $_POST['memleket_yemek_isim'],
        'memleket_resimyol' => $refimgyol,
        'memleket_videoyol' => $_POST['memleket_videoyol'],
        'memleket_icerik' => $_POST['memleket_icerik'],
        'memleket_durum' => $_POST['memleket_durum']
    ));

    if ($insert) {
        Header("Location:../production/memleket-listele.php?durum=ok");
    } else {

        Header("Location:../production/memleket-listele.php?durum=no");
    }
}


if (isset($_POST['yorumduzenle'])) {

    $yorum_id = $_POST['yorum_id'];
    $yorumkaydet = $db->prepare("UPDATE yorumlar SET
    yorumlar_adsoyad=:yorumlar_adsoyad,
    yorum_detay=:yorum_detay
    WHERE yorum_id={$_POST['yorum_id']}");

    $update = $yorumkaydet->execute(array(
        'yorumlar_adsoyad' => $_POST['yorumlar_adsoyad'],
        'yorum_detay' => $_POST['yorum_detay']
    ));
    if ($update) {
        header("location:../production/yorum-duzenle.php?yorum_id=$yorum_id&durum=ok");
    } else {

        header("location:../produciton/yorum-duzenle.php?yorum_id=$yorum_id&durum=no");
    }
}

if (isset($_POST['kuponduzenle'])) {

    $tarif_id = $_POST['tarif_id'];
    $yorumkaydet = $db->prepare("UPDATE yemek_tarif SET
    tarif_baslik=:tarif_baslik,
    begeni_sayisi=:begeni_sayisi,
    kupon_numarasi=:kupon_numarasi,
    kupon_miktari=:kupon_miktari,
    kupon_durum=:kupon_durum
    WHERE tarif_id={$_POST['tarif_id']}");

    $update = $yorumkaydet->execute(array(
        'tarif_baslik' => $_POST['tarif_baslik'],
        'begeni_sayisi' => $_POST['begeni_sayisi'],
        'kupon_numarasi' => $_POST['kupon_numarasi'],
        'kupon_miktari' => $_POST['kupon_miktari'],
        'kupon_durum' => $_POST['kupon_durum']
    ));
    if ($update) {
        header("location:../production/kuponlar-duzenle.php?tarif_id=$tarif_id&durum=ok");
    } else {

        header("location:../produciton/kuponlar-duzenle.php?tarif_id=$tarif_id&durum=no");
    }
}




if (isset($_POST['malzemeyemekduzenle'])) {

    $malzeme_id = $_POST['malzemeler_yemek_id'];
    $malzemeguncelle = $db->prepare("UPDATE malzemeler_yemek SET
    malzemeler_yemek_baslik=:malzemeler_yemek_baslik,
    malzemeler_yemek_aciklama=:malzemeler_yemek_aciklama,
    malzemeler_yemek_video=:malzemeler_yemek_video,
    ana_malzeme=:ana_malzeme
    WHERE malzemeler_yemek_id={$_POST['malzemeler_yemek_id']}");

    $update = $malzemeguncelle->execute(array(
        'malzemeler_yemek_baslik' => $_POST['malzemeler_yemek_baslik'],
        'malzemeler_yemek_aciklama' => $_POST['malzemeler_yemek_aciklama'],
        'malzemeler_yemek_video' => $_POST['malzemeler_yemek_video'],
        'ana_malzeme' => $_POST['ana_malzeme']
    ));
    if ($update) {
        header("location:../production/malzemeler-duzenle.php?malzemeler_yemek_id=$malzeme_id&durum=ok");
    } else {

        header("location:../produciton/malzemeler-duzenle.php?malzemeler_yemek_id=$malzeme_id&durum=no");
    }
}


if (isset($_POST['siteayarguncelle'])) {

    $uploads_dir = '../../dimg/icon';
    @$tmp_name = $_FILES['icon_resimyol']["tmp_name"];
    @$name = $_FILES['icon_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



    $kaydet = $db->prepare("UPDATE site_ayar SET
		ayar_title=:ayar_title,
		ayar_keywords=:ayar_keywords,
        ayar_description=:ayar_description,
		icon_resimyol=:icon_resimyol,
        ayar_author=:ayar_author
		");
    $insert = $kaydet->execute(array(
        'ayar_title' => $_POST['ayar_title'],
        'ayar_keywords' => $_POST['ayar_keywords'],
        'ayar_description' => $_POST['ayar_description'],
        'icon_resimyol' => $refimgyol,
        'ayar_author' => $_POST['ayar_author']
    ));
    if ($insert) {
        Header("Location:../production/site-ayar.php?durum=ok");
    } else {

        Header("Location:../production/site-ayar.php?durum=no");
    }
}

if (isset($_POST['footerayarguncelle'])) {

    $ayarguncelle = $db->prepare("UPDATE footer SET
    footer_facebook=:footer_facebook,
    footer_twitter=:footer_twitter,
    footer_youtube=:footer_youtube,
    footer_instagram=:footer_instagram,
    footer_aciklama=:footer_aciklama,
    footer_li_1=:footer_li_1,
    footer_li_2=:footer_li_2,
    footer_li_3=:footer_li_3,
    footer_li_4=:footer_li_4
    ");
    $update = $ayarguncelle->execute(array(
        'footer_facebook' => $_POST['footer_facebook'],
        'footer_twitter' => $_POST['footer_twitter'],
        'footer_youtube' => $_POST['footer_youtube'],
        'footer_instagram' => $_POST['footer_instagram'],
        'footer_aciklama' => $_POST['footer_aciklama'],
        'footer_li_1' => $_POST['footer_li_1'],
        'footer_li_2' => $_POST['footer_li_2'],
        'footer_li_3' => $_POST['footer_li_3'],
        'footer_li_4' => $_POST['footer_li_4']
    ));
    if ($update) {
        header("location:../production/footer-ayar.php?durum=ok");
    } else {
        header("location:../produciton/footer-ayar.php?durum=no");
    }
}


if (isset($_GET['yorumsil']) == "ok") {
    $sil = $db->prepare("DELETE  FROM yorumlar where yorum_id=:yorum_id");
    $kontrol = $sil->execute(array(

        'yorum_id' => $_GET['yorum_id']
    ));
    if ($kontrol) {
        header("Location:../production/yorumlar.php?sil=ok");
    } else {
        header("Location:../production/yorumlar.php?sil=no");
    }
}

if (isset($_GET['kuponsil']) == "ok") {
    $sil = $db->prepare("DELETE  FROM yemek_tarif where tarif_id=:tarif_id");
    $kontrol = $sil->execute(array(

        'tarif_id' => $_GET['tarif_id']
    ));
    if ($kontrol) {
        header("Location:../production/kuponlar.php?sil=ok");
    } else {
        header("Location:../production/kuponlar.php?sil=no");
    }
}



if (isset($_GET['malzemeleryemeksil']) == "ok") {
    $sil = $db->prepare("DELETE  FROM malzemeler_yemek where malzemeler_yemek_id=:malzemeler_yemek_id");
    $kontrol = $sil->execute(array(

        'malzemeler_yemek_id' => $_GET['malzemeler_yemek_id']
    ));
    if ($kontrol) {
        header("Location:../production/malzemeler.php?sil=ok");
    } else {
        header("Location:../production/malzemeler.php?sil=no");
    }
}

if (isset($_GET['malzemeurunsil']) == "ok") {
    $sil = $db->prepare("DELETE  FROM malzeme_ekle where malzeme_id=:malzeme_id");
    $kontrol = $sil->execute(array(

        'malzeme_id' => $_GET['malzeme_id']
    ));
    if ($kontrol) {
        header("Location:../production/malzeme-urun.php?sil=ok");
    } else {
        header("Location:../production/malzeme-urun.php?sil=no");
    }
}

if (isset($_POST['sirala'])) {

    $deger = $_POST['deger'];
    $yemek_tur = $_POST['yemek_tur'];

    if ($deger == "azalan") {

        header("Location:../../recipe.php?siralama=azalan");
    }
    if ($deger == "artan") {

        header("Location:../../recipe.php?siralama=artan");
    }
    if ($yemek_tur == "glutenli") {

        header("Location:../../recipe.php?siralama=glutenli");
    }

    if ($yemek_tur == "glutensiz") {

        header("Location:../../recipe.php?siralama=glutensiz");
    }
    if ($yemek_tur == "salata") {

        header("Location:../../recipe.php?siralama=salata");
    }
    if ($yemek_tur == "sicak-yemek") {

        header("Location:../../recipe.php?siralama=sicak-yemek");
    }
    if ($yemek_tur == "soguk-yemek") {

        header("Location:../../recipe.php?siralama=soguk-yemek");
    }
    if ($yemek_tur == "tatli") {

        header("Location:../../recipe.php?siralama=tatli");
    }
    if ($yemek_tur == "glutenli" and $deger == "artan") {

        header("Location:../../recipe.php?siralama=glutenli-artan");
    }
    if ($yemek_tur == "glutenli" and $deger == "azalan") {

        header("Location:../../recipe.php?siralama=glutenli-azalan");
    }

    if ($yemek_tur == "glutensiz" and $deger == "artan") {

        header("Location:../../recipe.php?siralama=glutensiz-artan");
    }
    if ($yemek_tur == "glutensiz" and $deger == "azalan") {

        header("Location:../../recipe.php?siralama=glutensiz-azalan");
    }

    if ($yemek_tur == "tatli" and $deger == "artan") {

        header("Location:../../recipe.php?siralama=tatli-artan");
    }
    if ($yemek_tur == "tatli" and $deger == "azalan") {

        header("Location:../../recipe.php?siralama=tatli-azalan");
    }

    if ($yemek_tur == "salata" and $deger == "artan") {

        header("Location:../../recipe.php?siralama=salata-artan");
    }
    if ($yemek_tur == "salata" and $deger == "azalan") {

        header("Location:../../recipe.php?siralama=salata-azalan");
    }


    if ($yemek_tur == "soguk-yemek" and $deger == "artan") {

        header("Location:../../recipe.php?siralama=sogukyemek-artan");
    }
    if ($yemek_tur == "soguk-yemek" and $deger == "azalan") {

        header("Location:../../recipe.php?siralama=sogukyemek-azalan");
    }


    if ($yemek_tur == "sicak-yemek" and $deger == "artan") {

        header("Location:../../recipe.php?siralama=sicakyemek-artan");
    }
    if ($yemek_tur == "sicak-yemek" and $deger == "azalan") {

        header("Location:../../recipe.php?siralama=sicakyemek-azalan");
    }
    if ($yemek_tur == "no" and $deger == "no") {
        header("Location:../../recipe.php?siralama=tumyemekler");
    }
}
