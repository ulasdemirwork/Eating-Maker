<?php
include 'header.php';

$kullanicisor = $db->prepare("SELECT * FROM kullanici where  kullanici_mail=:mail");
$kullanicisor->execute(array(

    'mail' => $_SESSION['userkullanici_mail']

));
$say = $kullanicisor->rowCount();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

?>
<!-- Login Start -->
<style>
    .backg {
        background: url(images/burger_hamburger_black_burger_juicy_116248_1920x1080.jpg);
        background-size: contain;
    }
</style>
<div class="container-fluid bg-white p-4 backg">
    <div class="container login" style="margin-bottom: 50px!important;">
        <main class="login-form rounded d-flex" style="background: transparent;">
            <form method="POST" action="nedmin/netting/process.php">
                <?php

                if (isset($_GET['durum'])) {
                    if ($_GET['durum'] == "ok") { ?>
                        <div class="alert alert-success">
                            <Strong></Strong>Güncelleme Başarılı..
                        </div>
                    <?php } elseif ($_GET['durum'] == "no") { ?>
                        <div class="alert alert-danger">
                            <Strong></Strong>Güncelleme Başarısız Şifreler Uyuşmuyor..
                        </div>
                    <?php } elseif ($_GET['durum'] == "sifreuzunluk") { ?>
                        <div class="alert alert-danger">
                            <Strong></Strong>Güncelleme Yapılamadı Şifreniz 6 karakterden Uzun Olmalı..
                        </div>
                <?php  }
                } ?>
                <input type="text" class="form-control mb-3" hidden value="<?php echo $kullanicicek['kullanici_id'] ?>" name="kullanici_id">

                <h1 class="h3 mb-3 text-white">Şifre Değiştirme</h1>
                <input type="password" class="form-control mb-3" placeholder="Şifrenizi  Giriniz" name="kullanici_passwordone" autofocus>
                <input type="password" class="form-control mb-3" placeholder="Şifrenizi Tekrar Giriniz" name="kullanici_passwordtwo">
                <input class="w-100 btn btn-lg btn-success" name="passwordupdate" type="submit" placeholder="Düzenle" value="Güncelle"></input>
                <p class="mt-2 mb-3  text-white text-center">2021 PhpProje
                </p>
            </form>


        </main>
    </div>
</div>

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up"></i></button>
<!-- Login End -->
<?php include 'footer.php' ?>