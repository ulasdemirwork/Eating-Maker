<?php
include 'header.php';

?>
<style>
    body {
        background-color: #e6ecf2;
    }
</style>

<!-- Login Start -->
<div class="container-fluid  p-1 backg" style="margin-bottom: 60px;">
    <div class="container login">
        <main class=" rounded" style="background:transparent;">
            <form method="POST" action="nedmin/netting/process.php">
                <p class="text-center"><span class="logo text-center pl-5 pb-4">Eating-Maker</span></p>
                <h1 class="h3 mb-3">Kayıt Olun</h1>
                <?php

                if (isset($_GET['durum'])) {
                    if ($_GET['durum'] == "farklisifre") { ?>
                        <div class="alert alert-danger">
                            <strong>Hata !</strong> Girdiğiniz şifreler eşleşmiyor.
                        </div>
                    <?php  } elseif ($_GET['durum'] == "mukerrerkayit") { ?>
                        <div class="alert alert-danger">
                            <strong>Hata !</strong> Bu kullanıcı daha önce kayıt edilmiş.
                        </div>
                    <?php } elseif ($_GET['durum'] == "basarisiz") { ?>
                        <div class="alert alert-danger">
                            <strong>Hata !</strong> Kayıt yapılamadı yetkiliye danışınız.
                        </div>
                    <?php } elseif ($_GET['durum'] == "sifreuzunluk") { ?>
                        <div class="alert alert-danger">
                            <strong>Hata !</strong> Kayıt yapılamadı şifre 6 karakterden uzun olmalı.
                        </div>
                    <?php } elseif ($_GET['durum'] == "kayitbasarili") { ?>
                        <div class="alert alert-success">
                            <strong class="text-success">Tebrikler</strong> Kayıt başarılı
                        </div>
                    <?php
                    } elseif ($_GET['durum'] == "telhatali") { ?>
                        <div class="alert alert-success">
                            <strong class="text-danger">HATA !</strong> Telefon numarası hatalı veya şifreler eşleşmiyor.
                        </div>
                    <?php
                    } elseif ($_GET['durum'] == "mailhatali") { ?>
                        <div class="alert alert-success">
                            <strong class="text-danger">HATA !</strong> Mail hatalı.
                        </div>
                    <?php
                    } elseif ($_GET['durum'] == "kodhatali") { ?>
                        <div class="alert alert-success">
                            <strong class="text-danger">HATA !</strong> Güvenlik Kodunu yanlış girdiniz.
                        </div>
                <?php
                    }
                } ?>
                <input type="text" class="form-control mb-3" placeholder="Ad Soyad Giriniz..." name="kullanici_adsoyad" required autofocus>
                <input type="email" class="form-control mb-3" placeholder="E-posta Giriniz.." name="kullanici_mail" required>
                <input type="text" class="form-control mb-3" placeholder="Telefon numaranızı başında (0) olmadan giriniz..." name="kullanici_gsm" required>
                <input type="password" class="form-control mb-3" placeholder="Şifre Giriniz..." name="kullanici_passwordone" required>
                <input type="password" class="form-control mb-3" placeholder="Tekrar Şifre Giriniz..." name="kullanici_passwordtwo" required>

                <img src="nedmin/netting/guvenlik-kod.php" height="25" width="100" class="img-fluid mb-2" />
                <input type="text" class="form-control mb-3" placeholder="güvenlik Kodunu Giriniz..." name="guvenlik_kod" style="text-transform:uppercase;">

                <button type="submit" name="usersave" class="w-100 btn btn-lg btn-warning">Kayıt Olun</button>
                <p class="mt-2 mb-2  text-center">2021 Eating-Maker
                </p>
            </form>
        </main>
    </div>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up"></i></button>



<!-- Login End -->

<?php include 'footer.php' ?>