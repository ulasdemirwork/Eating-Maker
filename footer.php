<!-- Footer -->
<style>
    .footersocial section a {
        background-color: red;
    }

    .footersocial section a:hover {
        background: red;
        color: white;
    }

    .footersocial section i {
        color: white;
        padding-right: 5px;
    }
</style>
<footer class="text-center  bg-white" style="font-size: 18px; ">
    <!-- Grid container -->
    <div class="container p-4 justify-content-center ">
        <!-- Section: Social media -->

        <div class="container footersocial">
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-outline-light" href="https://<?php echo $footerayarcek['footer_facebook'] ?>/" role="button "><i class="fab fa-facebook-f"></i></a>
                <!-- Twitter -->
                <a class="btn btn-outline-light" href="https://<?php echo $footerayarcek['footer_twitter'] ?>" role="button "><i class="fab fa-twitter "></i></a>
                <!-- Youtube -->
                <a class="btn btn-outline-light btn-floating m-1 " href="https://<?php echo $footerayarcek['footer_youtube'] ?>/" role="button "><i class="fab fa-youtube "></i></a>
                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1 " href="https://<?php echo $footerayarcek['footer_instagram'] ?>/" role="button "><i class="fab fa-instagram "></i></a>

            </section>
        </div>

        <!-- Section: Social media -->



        <!-- Section: Form -->
        <!-- Section: Text -->
        <section class="mb-4 ">
            <p class="text-center">

                <?php echo $footerayarcek['footer_aciklama'] ?>
            </p>
        </section>
        <!-- Section: Text -->

        <!-- Section: Links -->
        <section class=" ">
            <!--Grid row-->
            <div class="row ">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0 ">
                    <h5 class="text-uppercase "><?php echo $footerayarcek['footer_li_1'] ?></h5>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0 ">
                    <h5 class="text-uppercase ">
                        <?php echo $footerayarcek['footer_li_2'] ?>
                    </h5>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0 ">
                    <h5 class="text-uppercase ">
                        <?php echo $footerayarcek['footer_li_3'] ?>
                    </h5>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0 ">
                    <h5 class="text-uppercase ">
                        <?php echo $footerayarcek['footer_li_4'] ?>
                    </h5>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3 ">
        © 2021 Copyright:
        <a class="text-danger " href="index.php"><?php echo @$ayarcek['ayar_title'] ?></a> <span class="h5 text-danger">/</span><a href="about.php" class="text-danger"> Hakkımızda</a>
    </div>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up"></i></button>
</footer>
<!-- Footer End -->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"> </script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js "></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js "></script>
<script src="https://unpkg.com/aos@next/dist/aos.js "></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js " integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN " crossorigin="anonymous "></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js " integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl " crossorigin="anonymous "></script> -->
<script>
    $('.carousel').carousel({
        interval: 2000
    });
    AOS.init({
        duration: 2000,
        once: true,
    });
</script>
<script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }


    $(document).on('scroll', function() {
        if ($(document).scrollTop() > 0) {
            $('nav.menubar').addClass('scrolled');
        } else {
            $('nav.menubar').removeClass('scrolled');
        }
    });

    $('body').css('padding-top', $('nav.menubar').height() + 10);

    $(function() {
        objectFitImages()
    });
</script>

</body>

</html>