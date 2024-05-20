<?php
include 'header.php';

$tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE paylasan_kullanici=:mail");

$tarifsor->execute(array(

    'mail' => $_SESSION['userkullanici_mail']
));
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
        height: 100%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    label {
        color: red;
    }

    textarea {
        resize: none;
    }

    .fa-angle-down {
        color: orange;
    }

    .fa-angle-down:hover {
        color: red;
    }

    .blink {

        animation: blinker 3s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }

    i,
    small {
        color: orange;
    }

    .form-control:focus {
        border: none;
    }
</style>
<!-- Navbar Start -->
<div class="container-fluid p-0 m-0 ">
    <div class=" row p-0 m-0">
        <div class="col-xl-11 col-md-12 p-0 m-0" style="background-color: #e6ecf2;">
            <div class="container text-center rounded border border-warning" style="margin-top: 100px; margin-bottom:100px;">
                <?php if (isset($_GET['durum']) == "ok") { ?>
                    <span class="text-success h2 mb-4 blink">Mailiniz bizlere ulaştı. Görüşleriniz için teşekkür ederiz.</span>
                    <hr>
                <?php } else if (isset($_GET['durum']) == "no") { ?>
                    <span class="text-danger h2 mb-4 blink">Mailiniz bizlere ulaşamadı başka zaman tekrar deneyiniz</span>
                <?php } ?>
                <h4 class=" pt-2 ">Şikayet ve önerilerinizi bize mail atarak iletebilirsiniz.</h4>
                <form action="nedmin/netting/sikayet-oneri-mail.php" method="post">
                    <div class="container-fluid  rounded p-4 text-dark">
                        <div class="row text-left">
                            <div class="col-md-6"><input type="text" class="btn  form-control bg-white w-100 mb-3" placeholder="İsminizi Giriniz..." name="isim" required></div>
                            <div class="col-md-6"><input type="text" class="btn  form-control bg-white w-100 mb-3" placeholder="Soyisim Giriniz..." name="soyisim" required></div>
                            <div class="col-md-12"><input type="email" class="btn  form-control bg-white w-100 mb-3 " placeholder="Mail Giriniz..." name="email" required></div>
                            <div class="col-md-12"><span class=" h4 ">Mesajınız <i class="fa fa-angle-down" aria-hidden="true"></i></span><textarea name="mesaj" id="" cols="30" rows="10" class="form-control w-100 mt-2" name="mesaj"></textarea></div>
                            <div class="col-md-12 text-right"><button class="btn btn-warning mt-2" name="mesajgonder">Gönder</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class=" col-md-12 col-lg-1 col-xl-1 p-0 m-0">
            <div class=" ms-auto bg-light vh-100">
                <ul class=" mx-auto nav nav-pills nav-flush flex-column text-center">
                    <li class="nav-item"> <a href="hesap" class="nav-link  py-3 border-bottom"> <i class="fa fa-home"></i> <small><br>Anasayfa</small> </a> </li>
                    <li> <a href="hesapprofil" class="nav-link  py-3 border-bottom"> <i class="fa fa-user"></i> <small><br>Profil Bilgilerim</small> </a> </li>

                    <li> <a href="hesappassword" class="nav-link  py-3 border-bottom"> <i class="fa fa-key"></i> <small><br>Şifremi Güncelle</small> </a> </li>
                    <li> <a href="hesapyemek-tarif" class="nav-link  py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Yemek Tarifi Paylaş</small> </a> </li>
                    <li> <a href="paylasilan-yemek" class="nav-link  py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Tariflerim</small> </a> </li>
                    <li> <a href="sikayet-oneri" class="nav-link bg-danger py-3 border-bottom"><i class="fas fa-envelope"></i><small><br>Şikayet Ve Önerileriniz</small> </a> </li>
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