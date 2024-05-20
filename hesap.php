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
    body {
        background-color: #e6ecf2;
    }

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
        height: 100%;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }

    @media screen and (max-width: 600px) {

        .orta h1,
        h3,
        h4,
        h5 {
            font-size: 14px;
        }
    }

    i,
    small {
        color: orange;
    }
</style>
<!-- Navbar Start -->
<div class="container-fluid p-0 m-0 " style="position: relative;">
    <div class="row p-0 m-0">
        <div class="col-xl-11 col-md-12 p-0 mt-4 mb-4" style="background-color: #e6ecf2;">
            <div class="container-fluid p-0 m-0 orta">
                <h1 class="text-center">Hoşgeldin <?php echo $kullanicicek['kullanici_adsoyad'] ?></h1>
                <h3 class="text-center">
                    Menü aracılığı ile işlemlerini gerçekleştirebilirsin.
                </h3>
                <h4 class="text-center pt-3">
                    Kendi ürettiğin tarifi detaylı şekilde başkalarıyla paylaşabilirsin.
                </h4>
                <h4 class="text-center pt-3">
                    Profil bilgilerini güncelleyebilir ve şifreni değiştirebilirsin.
                </h4>
                <h5 class="text-center pt-3">
                    Haydi sende insanlarla kendi tarifini paylaş !
                </h5>
            </div>
        </div>
        <div class=" col-md-12 col-lg-1 col-xl-1 p-0 m-0">
            <div class=" ms-auto bg-light vh-100">
                <ul class=" mx-auto nav nav-pills nav-flush flex-column text-center">
                    <li class="nav-item"> <a href="hesap" class="nav-link bg-danger py-3 border-bottom"> <i class="fa fa-home"></i> <small><br>Anasayfa</small> </a> </li>
                    <li> <a href="hesapprofil" class="nav-link  py-3 border-bottom"> <i class="fa fa-user"></i> <small><br>Profil Bilgilerim</small> </a> </li>

                    <li> <a href="hesappassword" class="nav-link  py-3 border-bottom"> <i class="fa fa-key"></i> <small><br>Şifremi Güncelle</small> </a> </li>
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