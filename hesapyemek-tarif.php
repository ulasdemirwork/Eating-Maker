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
        height: 100%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }



    textarea {
        resize: none;
    }

    i,
    small {
        color: orange;
    }



    .SosyalMedya ul li a i {
        color: orange;
        transition: all 0.6s;
    }

    .SosyalMedya ul li a i:Hover {
        font-size: 40px;
    }
</style>
<!-- Navbar Start -->
<div class="container-fluid p-0 m-0">
    <div class=" row p-0 m-0">
        <div class="col-xl-11 col-md-12 p-0 m-0 " style="background-color: #e6ecf2;">
            <div class="container-fluid   p-4" style="margin-top: 50px; margin-bottom:50px;">
                <main class="rounded " style="background: transparent;">
                    <form method="POST" enctype="multipart/form-data" action="nedmin/netting/process.php">


                        <div class="container text-left mt-4" ">
                            <div class=" row">
                            <div class="col-md-12">
                                <small>
                                    <?php
                                    if (isset($_GET['durum'])) {
                                        if ($_GET['durum'] == "ok") { ?>
                                            <div class="alert alert-warning" role="alert">
                                                Tarifiniz bizlere ulaştı kontrol edildikten sonra paylaşım yapılacaktır. :)<br> Lezzetli görünüyor...
                                            </div>
                                        <?php } elseif ($_GET['durum'] == "no") { ?>
                                            <div class="alert alert-warning" role="alert">
                                                Tarifiniz Paylaşılamadı :( Tekrar Denemek İster misin.
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </small>
                            </div>
                            <div class="col-md-12 text-center ">
                                <span class="h4 ">Tariflerinizi bizler ile paylaşın !</span>
                            </div>
                            <div class="col-md-12">

                                <label class="control-label" for="first-name" required>Resim Seç<span class="required">*</span>
                                </label>
                                <input type="file" id="first-name" name="tarif_resimyol" class="form-control w-100" required>

                            </div>

                            <div class="col-md-12">
                                <label class="control-label " for="first-name" required>Yemek Adı Ekle <span class="required">*</span>
                                </label>
                                <input type="text" id="" name="tarif_baslik" placeholder="Yemek Adı Ekleyin" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="control-label " for="first-name" required>Yemek Tarifi Ekleyin <span class="required">*</span>
                                </label>
                                <textarea id="" name="tarif_aciklama" placeholder="Yemek Açıklaması Ekleyin" class="form-control" rows="10" cols="10" required></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="control-label " for="first-name" required>Yemek Slogan ekleyin <span class="required">*</span>
                                </label>
                                <input type="text" id="" name="tarif_footer" placeholder="Yemek Sloganı Ekleyin" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="control-label " for="first-name" required>Yemek Türünü Seçiniz <span class="required">*</span>
                                </label>
                                <select name="yemek_tur" id="" class="form-control">
                                    <option value="sicak-yemek">Sıcak Yemek</option>
                                    <option value="soguk-yemek">Soğuk Yemek</option>
                                    <option value="salata">Salata</option>
                                    <option value="tatli">Tatlı</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="control-label " for="first-name" required>İçeriğini Seçiniz<span class="required">*</span>
                                </label>
                                <select name="yemek_icerik" id="" class="form-control">
                                    <option value="Glutenli">Glütenli</option>
                                    <option value="Glutensiz">Glütensiz</option>
                                </select>
                            </div>


                            <div class="col-md-12 text-right">
                                <input type="submit" name="hesapyemektarifkaydet" class="btn btn-outline-danger mt-2" value="Kaydet">
                            </div>
                        </div>

            </div>

            <div class="form-group ">
                <input type="text" id="" hidden name="paylasan_kullanici" value="<?php echo  $kullanicicek['kullanici_mail'] ?>" class="form-control" required>
            </div>

            </form>
            </main>
        </div>
    </div>
    <div class=" col-md-12 col-lg-1 col-xl-1 p-0 m-0">
        <div class=" ms-auto bg-light vh-100">
            <ul class=" mx-auto nav nav-pills nav-flush flex-column text-center">
                <li class="nav-item"> <a href="hesap" class="nav-link  py-3 border-bottom"> <i class="fa fa-home"></i> <small><br>Anasayfa</small> </a> </li>
                <li> <a href="hesapprofil" class="nav-link  py-3 border-bottom"> <i class="fa fa-user"></i> <small><br>Profil Bilgilerim</small> </a> </li>

                <li> <a href="hesappassword" class="nav-link  py-3 border-bottom"> <i class="fa fa-key"></i> <small><br>Şifremi Güncelle</small> </a> </li>
                <li> <a href="hesapyemek-tarif" class="nav-link bg-danger py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Yemek Tarifi Paylaş</small> </a> </li>
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