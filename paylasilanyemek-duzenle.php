<?php
include 'header.php';

$tarifsor = $db->prepare("SELECT * FROM yemek_tarif where tarif_id=:id ");
$tarifsor->execute(array(
    'id' => $_GET['tarif_id']
));

$tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC);

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
        color: black;
        font-size: 24px;
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
            <div class="container border border-warning mb-4" style="margin-top: 50px">
                <br />
                <form action="nedmin/netting/process.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">


                        <div class="col-md-6 col-sm-6 col-xs-12 mx-auto">
                            <small>
                                <?php
                                if (isset($_GET['durum'])) {
                                    if ($_GET['durum'] == "ok") { ?>
                                        <div class="alert alert-success" role="alert">
                                            Tarifinizi revize ettiğinizi farkettik. Kontrol edildikten sonra paylaşım yapılacaktır.<br> Artık daha lezzetli...
                                        </div>
                                    <?php } elseif ($_GET['durum'] == "no") { ?>
                                        <div class="alert alert-danger" role="alert">
                                            Tarifiniz Paylaşılamadı :( Tekrar Denemek İster misin.
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </small>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Resmi Tekrardan Seçiniz !<span class="required">*</span>
                            </label>
                            <img width="200" src="<?php echo $tarifcek['tarif_resimyol'] ?>" class="pb-3">
                            <input type="file" id="first-name" name="tarif_resimyol" class="form-control col-md-12 col-xs-12" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 mx-auto">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Yemek Ad<span class="required">*</span>
                            </label>
                            <input type="text" id="" name="tarif_baslik" value="<?php echo $tarifcek['tarif_baslik'] ?>" class="w-100 form-control" required>
                        </div>
                    </div>


                    <div class="form-group">

                        <div class="col-md-6 col-sm-6 col-xs-12 mx-auto">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Yemek Açıklama <span class="required">*</span>
                            </label>
                            <textarea class="w-100 form-control" name="tarif_aciklama" id="" cols="30" rows="10" required><?php echo $tarifcek['tarif_aciklama'] ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-6 col-sm-6 col-xs-12 mx-auto">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Yemek Slogan <span class="required">*</span>
                            </label>
                            <input type="text" id="" name="tarif_footer" value="<?php echo $tarifcek['tarif_footer'] ?>" class="w-100 form-control" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-6 col-sm-6 col-xs-12 mx-auto">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name" required>Yemek Türünü Seçiniz <span class="required">*</span>
                            </label>
                            <select name="yemek_tur" id="" class="form-control">
                                <option value="<?php echo $tarifcek['yemek_tur'] ?>"><?php echo $tarifcek['yemek_tur'] ?></option>
                                <option value="Sıcak Yemek">Sıcak Yemek</option>
                                <option value="Soğuk Yemek">Soğuk Yemek</option>
                                <option value="Salata">Salata</option>
                                <option value="Tatlı">Tatlı</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-6 col-sm-6 col-xs-12 mx-auto">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name" required>Yemek Türünü Seçiniz <span class="required">*</span>
                            </label>
                            <select name="yemek_icerik" id="" class="form-control">
                                <option value="<?php echo $tarifcek['yemek_icerik'] ?>"><?php echo $tarifcek['yemek_icerik'] ?></option>
                                <option value="Glütenli">Glütenli</option>
                                <option value="Glütensiz">Glütensiz</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="tarif_id" value="<?php echo $tarifcek['tarif_id'] ?>"> </input>

                    <div class="form-group">
                        <div align="right" class="col-md-9 col-sm-9 col-xs-10 col-md-offset-3">
                            <button type="submit" name="paylasilanyemekduzenle" class="btn btn-outline-warning">Güncelle</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        <div class=" col-md-12 col-lg-1 col-xl-1 p-0 m-0">
            <div class=" ms-auto bg-light vh-100">
                <ul class=" mx-auto nav nav-pills nav-flush flex-column text-center">
                    <li class="nav-item"> <a href="hesap" class="nav-link  py-3 border-bottom"> <i class="fa fa-home"></i> <small><br>Anasayfa</small> </a> </li>
                    <li> <a href="hesapprofil" class="nav-link  py-3 border-bottom"> <i class="fa fa-user"></i> <small><br>Profil Bilgilerim</small> </a> </li>

                    <li> <a href="hesappassword" class="nav-link  py-3 border-bottom"> <i class="fa fa-key"></i> <small><br>Şifremi Güncelle</small> </a> </li>
                    <li> <a href="hesapyemek-tarif" class="nav-link  py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Yemek Tarifi Paylaş</small> </a> </li>
                    <li> <a href="paylasilan-yemek" class="nav-link  py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Tariflerim</small> </a> </li>
                    <li> <a href="sikayet-oneri.php" class="nav-link  py-3 border-bottom"><i class="fas fa-envelope"></i><small><br>Şikayet Ve Önerileriniz</small> </a> </li>
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