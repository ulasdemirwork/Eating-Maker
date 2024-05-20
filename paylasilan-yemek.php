<?php
include 'header.php';

$tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE paylasan_kullanici=:mail and tarif_durum=2");

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

    ul li {
        list-style-type: none;
    }

    i,
    small {
        color: orange;
    }

    .form-control:focus {
        border-color: orange;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
</style>
<!-- Navbar Start -->
<div class="container-fluid p-0 m-0">
    <div class=" row p-0 m-0">
        <div class="col-xl-11 col-md-12 p-0 m-0 " style="background-color: #e6ecf2;">
            <div class="container">
                <ul id="myUL" class="p-0 m-0">
                    <div class="container mt-4">
                        <div class="p-0 m-0 mt-5 mb-4">
                            <div class="row  p-3">
                                <div class=" col-md-6 mx-auto">
                                    <h1 class=" text-center">Tariflerim</h1>
                                </div>
                                <div class="col-md-6  mt-2">
                                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Yemek Arayın" class="form-control btn ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    while ($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)) { ?>
                        <li>
                            <div class="container-fluid p-0 m-0">
                                <div class="container-fluid background blur p-0 m-0 ">
                                    <div class="div" data-aos="fade-right" style="height:100%; width:100%;">
                                        <div class="jumbotron-fluid">
                                            <div class="jumbotron-background">
                                                <img src="<?php $tarifcek['tarif_resimyol'] ?>" class="blur">
                                            </div>
                                            <div class="container text-center" style="word-wrap: break-word;">

                                                <h6 class="text-dark"><?php echo $tarifcek['tarif_baslik'] ?></h6>
                                                <img src="<?php echo $tarifcek['tarif_resimyol'] ?>" class="img-fluid pb-3" width="100%">
                                                <center>
                                                    <textarea class="form-control bg-transparent " disabled><?php echo $tarifcek['tarif_aciklama'] ?></textarea>
                                                </center>
                                                <hr class="my-4">
                                                <p class="h5 text-center p-3 text-dark"><?php echo $tarifcek['tarif_footer'] ?>
                                                <div class="container text-right m-4">
                                                    <span class="h4">
                                                        <i style="color: red;" class="fa fa-heart m-2 " aria-hidden="true"><span class=" pl-2"><?php echo $tarifcek['begeni_sayisi'] ?></span>
                                                        </i>
                                                        <span>
                                                            <i style="color: red;" class="far fa-comment m-2 " aria-hidden="true"><span class=" pl-2"><?php echo $tarifcek['yorum_sayisi'] ?></span>
                                                            </i>

                                                        </span>
                                                    </span>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.container -->
                                    <!-- /.container -->
                                </div>
                            </div>
                            <div class="container d-flex justify-content-end p-2">
                                <p class="p-2">
                                    <center><a href="paylasilanyemek-duzenle.php?tarif_id=<?php echo $tarifcek['tarif_id'] ?>"><button type="submit" class="btn btn-outline-warning">Düzenle</button></a></center>
                                </p>
                                <p class="p-3">
                                    <a href="nedmin/netting/process.php?tarif_id=<?php echo $tarifcek['tarif_id']; ?>&tarifimisil=ok">
                                        <center><button type="submit" class="btn btn-danger">Sil</button></center>
                                    </a>
                                </p>
                            </div>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
        <div class=" col-md-12 col-lg-1 col-xl-1 p-0 m-0" style="background-color: white;">
            <div class="ms-auto bg-light vh-100">
                <ul class=" mx-auto nav nav-pills nav-flush flex-column text-center">
                    <li class="nav-item"> <a href="hesap" class="nav-link  py-3 border-bottom"> <i class="fa fa-home"></i> <small><br>Anasayfa</small> </a> </li>
                    <li> <a href="hesapprofil" class="nav-link  py-3 border-bottom"> <i class="fa fa-user"></i> <small><br>Profil Bilgilerim</small> </a> </li>
                    <li> <a href="hesappassword" class="nav-link  py-3 border-bottom"> <i class="fa fa-key"></i> <small><br>Şifremi Güncelle</small> </a> </li>
                    <li> <a href="hesapyemek-tarif" class="nav-link  py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Yemek Tarifi Paylaş</small> </a> </li>
                    <li> <a href="paylasilan-yemek" class="nav-link bg-danger py-3 border-bottom"> <i class="fas fa-hat-chef"></i><small><br>Tariflerim</small> </a> </li>
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
    function myFunction() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("h6")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
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