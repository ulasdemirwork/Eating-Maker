<?php
include 'header.php';

$yemeksor = $db->prepare("SELECT * FROM anasayfa_yemek WHERE yemek_durum=2");

$yemeksor->execute();
?>
<style>
    body {
        background-color: #e6ecf2;
    }

    li {
        list-style-type: none;
    }

    .jumbotron {
        background: transparent;
    }

    .reklam {
        background: url("img/reklam/gorsel1.jpg");
        background-position: center;

    }
</style>


<a href="hediye-ceki.php">
    <div class="container-fluid mt-4 bg-white p-4 text-dark reklam">
        <p class="p-3"></p>
    </div>
</a>
<div class="container mt-4  text-dark rounded bg-white ">
    <?php include 'slider.php'; ?>
    <hr class="text-white">
    <!-- Button trigger modal -->

    <!-- Start -->
    <div class="container-fluid text-dark" style=" border-top-left-radius:15px; border-top-right-radius:15px">
        <div class="container-fluid bg-white ">
            <div class="container">
                <div class="row ">
                    <div class="col-md-4">
                        <img src="images/ykvmayiswebsite23.jpg" alt=" " class="img-fluid " style="border-radius: 25px; padding: 10px; ">
                    </div>

                    <div class="col-md-8">
                        <p class="text-justify text-dark" style="font-size: 17px; ">
                            Evde tek misiniz, misafir mi bekliyorsunuz veya hep ayni yemekleri yapmaktan sıkıldınız mı ? artık ne yemek yapacağım diye düşünmeye son ! Yapmanız gereken tek şey elinizde ki malzemeleri girmek ve oluşturduğumuz çeşitli menülerden size uygun yemeğin tarifine ulaşmak. Hadi tıkla ve dene :)
                        </p>

                        <a href="recipe.php"> <button class="btn btn-danger mb-3 mx-auto w-100">Hemen Deneyin</button>
                            <a href="kalori-incele.php"> <button class="btn btn-outline-danger mb-3 mx-auto w-100">Kalori İncele</button>
                            </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End -->

        <ul id="myUL">
            <div class="container">
                <div class="p-0 m-0 mt-4 mb-4">
                    <div class="row  p-2 ">
                        <div class="col-md-6">
                            <h1 class=" text-center text-dark ">Günün Yemekleri</h1>
                        </div>
                        <div class="col-md-6 mx-auto mt-2">

                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Yemek Arayın" class="form-control btn pl-3 border border-dark bg-white">

                        </div>
                    </div>
                </div>
            </div>
            <?php while ($yemekcek = $yemeksor->fetch(PDO::FETCH_ASSOC)) { ?>
                <li>
                    <div class="container-fluid p-0 m-0  mb-2 rounded" style="background-color: f0f8ff;">
                        <!------------------------------------------------------------>
                        <div class="row">
                            <div class="col-md-12 d-flex mb-4 mt-4 ">
                                <div class="border border-danger div" data-aos="fade-right" style="height:100%; width:100%;">
                                    <div class="jumbotron text-dark " style="width:100%;">
                                        <h1 class="display-4 text-center"><?php echo $yemekcek['yemek_baslik'] ?></h1>
                                        <hr class="text-red">
                                        <p class="lead text-center"><?php echo $yemekcek['yemek_aciklama'] ?></p>
                                        <hr class="my-4">
                                        <p class="text-center"><?php echo $yemekcek['yemek_footer'] ?></p>
                                        <p class="lead">
                                            <center> <a class="btn btn-outline-danger btn-sm" href="recipe.php" role="button">Yemeklere Gitmek İçin</a></center>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php  } ?>
        </ul>
    </div>

</div>

<hr class="text-white">
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
            a = li[i].getElementsByTagName("h1")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>
<?php include 'footer.php' ?>