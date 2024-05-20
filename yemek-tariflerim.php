<?php
include 'header.php';

$kullanicisor = $db->prepare("SELECT * FROM kullanici where  kullanici_mail=:mail");
$kullanicisor->execute(array(

    'mail' => $_SESSION['userkullanici_mail']

));
$say = $kullanicisor->rowCount();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

$tarifsor = $db->prepare("SELECT * FROM yemek_tarif");

$tarifsor->execute();

?>

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

    .jumbotron h1,
    h5,
    p {

        font-weight: bold;
        text-align: center;

    }

    .jumbotron {
        position: relative;
        overflow: hidden;
    }

    .jumbotron .container {
        position: relative;
        z-index: 2;
        background: rgba(0, 0, 0, 0.2);

        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 3px;
    }

    .jumbotron-background {
        object-fit: cover;
        font-family: 'object-fit: cover;';
        position: absolute;
        top: 0;
        z-index: 1;
        width: 100%;
        height: 100%;
        opacity: 0.5;
    }

    img.blur {
        -webkit-filter: blur(4px);
        filter: blur(4px);
        filter: progid:DXImageTransform.Microsoft.Blur(PixelRadius='4');
    }

    /* Voting start */
    .likebtn,
    .dislikebtn {
        color: #fff;
        background: none;
        border: none;
        font-size: 20px;
        padding: 0 15px;
        margin: 10px 0;
        margin-left: 20px;
        cursor: pointer;
    }

    ul li {
        list-style-type: none;
    }
</style>
<!-- Navbar Start -->
<div class="container-fluid p-0 m-0">
    <div class=" row p-0 m-0">
        <div class="col-xl-11 col-md-12 p-0 m-0" style="background: #007bff;">
            <div class="container-fluid p-0 m-0 orta">
                <?php
                while ($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)) { ?>
                    <ul id="myUL" class="p-0 m-0">
                        <li>
                            <div class="container-fluid p-0 m-0">
                                <div class="container-fluid background blur p-0 m-0">
                                    <div class="jumbotron jumbotron-fluid bg-dark">
                                        <div class="jumbotron-background">
                                            <img src="<?php $tarifcek['tarif_resimyol'] ?>" class="blur">
                                        </div>

                                        <div class="container text-white">

                                            <h1 class="display-4"><?php echo $tarifcek['tarif_baslik'] ?></h1>
                                            <img src="<?php echo $tarifcek['tarif_resimyol'] ?>" class="img-fluid">
                                            <p class="lead"><?php echo $tarifcek['tarif_aciklama'] ?></p>
                                            <hr class="my-4">
                                            <p class="h5"><?php echo $tarifcek['tarif_footer'] ?> <a href="recipe.php"><button class="btn btn-outline-success btn-sm">Tıklayınız</button></a> <button class="likebtn" id="likebtn">
                                                    <i class="fa fa-thumbs-up"></i>
                                                </button>
                                                <button class="dislikebtn" id="dislikebtn">
                                                    <i class="fa fa-thumbs-down"></i>
                                                </button>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- /.container -->
                                    <!-- /.container -->
                                </div>
                        </li>
                    <?php }
                    ?>
                    </ul>
            </div>
        </div>
        <div class=" col-md-12 col-lg-1 col-xl-1 p-0 m-0">
            <div class=" ms-auto bg-light" style="height:100%">
                <ul class=" mx-auto nav nav-pills nav-flush flex-column text-center">
                    <li class="nav-item"> <a href="hesap.php" class="nav-link  py-3 border-bottom"> <i class="fa fa-home"></i> <small><br>Anasayfa</small> </a> </li>
                    <li> <a href="hesapprofil.php" class="nav-link py-3 border-bottom"> <i class="fa fa-user"></i> <small><br>Profil Bilgilerim</small> </a> </li>

                    <li> <a href="hesappassword.php" class="nav-link py-3 border-bottom"> <i class="fa fa-key"></i> <small><br>Şifremi Güncelle</small> </a> </li>
                    <li> <a href="hesapyemek-tarif.php" class="nav-link py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Yemek Tarifi Paylaş</small> </a> </li>
                    <li> <a href="yemek-tariflerim.php" class="nav-link active py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Yemek Tariflerim</small> </a> </li>
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