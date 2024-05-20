<?php
include 'header.php';

$kullanicisor = $db->prepare("SELECT * FROM kullanici where  kullanici_mail=:mail");
$kullanicisor->execute(array(

    'mail' => $_SESSION['userkullanici_mail']

));
$say = $kullanicisor->rowCount();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

?>
<style>
    .nav-links {
        border-radius: 0px !important;
        transition: all 0.5s;
        width: 100px;
        display: flex;
        flex-direction: column;
    }

    .nav-links small {
        font-size: 12px
    }

    .nav-links:hover {
        background-color: #52525240 !important
    }

    .nav-links .fa {
        transition: all 1s;
        font-size: 20px
    }

    .nav-links:hover .fa {
        transform: rotate(360deg)
    }

    .orta {
        display: flex;
        height: 80%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    i,
    small {
        color: orange;
    }
</style>
<!-- Navbar Start -->
<div class="container-fluid p-0 m-0">
    <div class=" row p-0 m-0">
        <div class="col-xl-11 col-md-12 p-0 m-0 " style="background-color: #e6ecf2;">
            <div class="container login orta  border border-warning" style="margin-bottom: 50px!important;">
                <main class="login-form rounded " style="background: transparent;">
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

                        <h1 class="h3 mb-3 ">Şifre Değiştirme</h1>
                        <input type="password" class="form-control mb-3" placeholder="Şifrenizi  Giriniz" name="kullanici_passwordone" autofocus required>
                        <input type="password" class="form-control mb-3" placeholder="Şifrenizi Tekrar Giriniz" name="kullanici_passwordtwo" required>
                        <input class="w-100 btn btn-lg btn-outline-warning" name="passwordupdate" type="submit" placeholder="Düzenle" value="Güncelle"></input>
                        <p class="mt-2 mb-3   text-center">2021 Eating-Maker
                        </p>
                    </form>


                </main>
            </div>
        </div>
        <div class=" col-md-12 col-lg-1 col-xl-1 p-0 m-0">
            <div class=" ms-auto bg-light vh-100">
                <ul class=" mx-auto nav nav-pills nav-flush flex-column text-center">
                    <li class="nav-item"> <a href="hesap" class="nav-link  py-3 border-bottom"> <i class="fa fa-home"></i> <small><br>Anasayfa</small> </a> </li>
                    <li> <a href="hesapprofil" class="nav-link  py-3 border-bottom"> <i class="fa fa-user"></i> <small><br>Profil Bilgilerim</small> </a> </li>

                    <li> <a href="hesappassword" class="nav-link bg-danger  py-3 border-bottom"> <i class="fa fa-key"></i> <small><br>Şifremi Güncelle</small> </a> </li>
                    <li> <a href="hesapyemek-tarif" class="nav-link  py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Yemek Tarifi Paylaş</small> </a> </li>
                    <li> <a href="paylasilan-yemek" class="nav-link  py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Tariflerim</small> </a> </li>
                    <li> <a href="sikayet-oneri" class="nav-link  py-3 border-bottom"><i class="fas fa-envelope"></i><small><br>Şikayet Ve Önerileriniz</small> </a> </li>
                    <li> <a href="kuponlarim" class="nav-link  py-3 border-bottom"><i class="fa fa-ticket" aria-hidden="true"></i><small><br>Kuponlarım</small> </a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /#wrapper -->


<!-- Navbar End -->
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up"></i></button>



<!-- Login End -->
<script>
    $(document).ready(function() {
        var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;

        trigger.click(function() {
            hamburger_cross();
        });

        function hamburger_cross() {

            if (isClosed == true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }

        $('[data-toggle="offcanvas"]').click(function() {
            $('#wrapper').toggleClass('toggled');
        });
    });
</script>
<?php include 'footer.php' ?>