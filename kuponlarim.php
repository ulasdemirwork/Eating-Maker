<?php
include 'header.php';

$kullanicisor = $db->prepare("SELECT * FROM kullanici where  kullanici_mail=:mail");
$kullanicisor->execute(array(

    'mail' => $_SESSION['userkullanici_mail']

));
$say = $kullanicisor->rowCount();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);


$tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE paylasan_kullanici=:paylasan_kullanici and begeni_sayisi >= 10");
$tarifsor->execute(array(

    'paylasan_kullanici' => $_SESSION['userkullanici_mail']

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
            <div class="container login border  text-center mx-auto d-flex justify-content-center " style="margin-bottom: 50px!important; margin-top:50px;">
                <main class="rounded " style="background: transparent;">
                    <?php $i = 1;
                    while ($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)) { ?>


                        <div class="card mb-2 w-100 mt-2" style="width: 18rem;">

                            <div class="card-body">
                                <h6 class="card-title ">Tarif Başlık :<?php echo $tarifcek['tarif_baslik'] ?></h6>
                                <hr>
                                <h6 class="card-subtitle mb-2 ">Beğeni Sayisi :<?php echo $tarifcek['begeni_sayisi'] ?></h6>
                                <hr>
                                <p class="card-text text-center"><?php echo $tarifcek['kupon_miktari'] ?> ₺ Değerinde ki Hediye Çekinizi Güle Güle Kullanın</p>
                            </div>
                        </div>

                        <form action="process.php" method="POST">
                            <button type="button" class="btn btn-outline-warning mb-2" data-toggle="modal" data-target="#exampleModal<?php echo $i ?>">
                                Kuponumu Görüntüle
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Kupon </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php if ($tarifcek['kupon_durum'] == 0) { ?>Kupon Tanımlama Durumu : <span class="text-danger">Pasif <br></span>24 Saat içerisinde tanımlanacaktır. <?php } else { ?>Kupon Tanımlama Durumu : <span class="text-success">Aktif<br></span><?php } ?>
                                        <?php if ($tarifcek['kupon_durum'] == 1) { ?>
                                            <span>Kuponunuz : </span><?php echo $tarifcek['kupon_numarasi'] ?>
                                        <?php } ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php $i++;
                    }
                    ?>
                    <div class="container-fluid">
                        <span class="h5">
                            Kuponumu nerede harcayabilirim ? <i class="fa fa-angle-down" aria-hidden="true" style="font-size:34px; color:red;"></i>
                        </span>
                        <hr>
                        <a href="https://www.pelitkirtasiye.com/"> <button class="btn btn-danger mb-3 mx-auto w-100">Kırtasiye Ürünleri</button></a>
                        <a href="https://receppelit.myideasoft.com/"> <button class="btn btn-danger mb-3 mx-auto w-100">Yiyecek Ürünleri</button></a>
                        <span class="h5">
                            Hediye çekini nasıl kazanabilirim ? Detaylı Bilgi İçin <i class="fa fa-angle-down" aria-hidden="true" style="font-size:34px;"></i>
                        </span>
                        <hr>
                        <a href="hediye-ceki.php"> <button class="btn btn-warning mb-3 mx-auto w-100">Hediye Çeki</button></a>
                    </div>
                </main>

            </div>

        </div>

        <div class=" col-md-12 col-lg-1 col-xl-1 p-0 m-0">
            <div class=" ms-auto bg-light vh-100">
                <ul class=" mx-auto nav nav-pills nav-flush flex-column text-center">
                    <li class="nav-item"> <a href="hesap" class="nav-link  py-3 border-bottom"> <i class="fa fa-home"></i> <small><br>Anasayfa</small> </a> </li>
                    <li> <a href="hesapprofil" class="nav-link  py-3 border-bottom"> <i class="fa fa-user"></i> <small><br>Profil Bilgilerim</small> </a> </li>

                    <li> <a href="hesappassword" class="nav-link   py-3 border-bottom"> <i class="fa fa-key"></i> <small><br>Şifremi Güncelle</small> </a> </li>
                    <li> <a href="hesapyemek-tarif" class="nav-link  py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Yemek Tarifi Paylaş</small> </a> </li>
                    <li> <a href="paylasilan-yemek" class="nav-link  py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Tariflerim</small> </a> </li>
                    <li> <a href="sikayet-oneri" class="nav-link  py-3 border-bottom"><i class="fas fa-envelope"></i><small><br>Şikayet Ve Önerileriniz</small> </a> </li>
                    <li> <a href="kuponlarim" class="nav-link bg-danger py-3 border-bottom"><i class="fa fa-ticket" aria-hidden="true"></i><small><br>Kuponlarım</small> </a> </li>
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