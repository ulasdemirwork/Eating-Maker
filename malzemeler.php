<?php

include 'header.php';

$malzemeurunsor = $db->prepare("SELECT * FROM malzeme_ekle WHERE malzeme_durum=2 ORDER BY malzeme_sira ASC");
$malzemeurunsor->execute();



$memleketsor = $db->prepare("SELECT * FROM memleket_yemek");
$memleketsor->execute();

$memleketyemeksor = $db->prepare("SELECT * FROM memleket_yemek");
$memleketyemeksor->execute();

$memleketyemeksorr = $db->prepare("SELECT * FROM memleket_yemek");
$memleketyemeksorr->execute();

$sehirler = [
    "Adana", "Adıyaman", "Afyon", "Ağrı", "Amasya", "Ankara", "Antalya", "Artvin", "Aydın", "Balıkesir", "Bilecik", "Bingöl", "Bitlis", "Bolu", "Burdur", "Bursa", "Çanakkale", "Çankırı", "Çorum", "Denizli", "Diyarbakır", "Edirne", "Elazığ", "Erzincan", "Erzurum", "Eskişehir", "Gaziantep", "Giresun", "Gümüşhane", "Hakkari", "Hatay", "Isparta", "İçel (Mersin)", "İstanbul", "İzmir", "Kars", "Kastamonu", "Kayseri", "Kırklareli", "Kırşehir", "Kocaeli", "Konya", "Kütahya", "Malatya", "Manisa", "Kahramanmaraş", "Mardin", "Muğla", "Muş", "Nevşehir", "Niğde", "Ordu", "Rize", "Sakarya", "Samsun", "Siirt", "Sinop", "Sivas", "Tekirdağ", "Tokat", "Trabzon", "Tunceli", "Şanlıurfa", "Uşak", "Van", "Yozgat", "Zonguldak", "Aksaray", "Bayburt", "Karaman", "Kırıkkale", "Batman", "Şırnak", "Bartın", "Ardahan", "Iğdır", "Yalova", "Karabük", "Kilis", "Osmaniye", "Düzce"
];

?>
<style>
    body {
        background-color: #e6ecf2;
    }

    input[type='radio']:checked {


        background-color: red;
        border: 1px solid red;
    }

    .card {

        background-color: azure;
        border: 1px solid red;
    }



    .blink {

        animation: blinker 1.5s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }

    ul li {
        list-style-type: none;
    }

    input {
        font-size: 24px;
    }



    ::placeholder {
        color: white;
    }
</style>
<div class="container bg-white mt-4 rounded">
    <form action="" method="post">
        <div class="row">
            <div class="col-md-12 text-center mt-2">
                <h3>İstediğin Memleketin Yemek Tarifini Seçebilirsiniz</h3>
            </div>
            <div class="col-md-6 mt-2">
                <select name="memleket" id="" class="form-control">
                    <?php
                    foreach ($sehirler as $anahtar => $deger) {  ?>
                        <option value="<?php echo  $deger ?>"><?php echo $deger ?></option>
                    <?php } ?>
                </select>
            </div>
            <?php if (isset($_POST['yemeklistele'])) {
                @$memleket = $_POST['memleket'];
            } ?>
            <div class="col-md-6 mt-2">
                <select name="memleket-yemek" id="" class="form-control">
                    <?php
                    while ($memleketcek = $memleketsor->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $memleketcek['memleket_yemek_isim']; ?>"><?php echo $memleketcek['memleket_yemek_isim']; ?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="col-md-12">
                <button type="submit" class="w-100  btn btn-outline-danger mt-2" name="yemeklistele">Listele</button>
            </div>
        </div>
    </form>
    <?php if (isset($_POST['yemeklistele'])) {
        @$memleket_yemek  = $_POST['memleket-yemek'];
    } ?>
    <?php while ($memleketyemekcek = $memleketyemeksor->fetch(PDO::FETCH_ASSOC)) {
        if (@$memleketyemekcek['memleket_yemek_isim'] == @$memleket_yemek && $memleketyemekcek['memleket_isim'] == $memleket) {

            $yemeklistele = $db->prepare("SELECT * FROM memleket_yemek WHERE memleket_isim = $memleket and memleket_yemek_isim = $memleket_yemek"); ?>
            <div class="container p-0 m-0">
                <div class="row">
                    <h4 class="text-center pt-2 pb-4"><?php echo $memleketyemekcek['memleket_isim'] ?> / <?php echo $memleketyemekcek['memleket_yemek_isim'] ?></h4>
                    <div class="col-md-6 pb-2">
                        <img src="<?php echo $memleketyemekcek['memleket_resimyol'] ?>" width="100%" data-aos="fade-right " alt="" style="border-radius: 10px;">
                    </div>
                    <div class="col-md-6 text-left ">
                        <p> <?php echo $memleketyemekcek['memleket_icerik'] ?></p>
                    </div>
                    <div class="col-md-12 p-0 m-0 embed-responsive embed-responsive-16by9">
                        <iframe class=" embed-responsive-item pt-2" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $memleketyemekcek['memleket_videoyol'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

    <?php }
    }

    ?>
    <form action="malzemeler.php" method="post">
        <div class="container bg-white rounded p-4 text-center" style="margin-top: 100px;">
            <label class=" h2 pb-5
        ">Ana Malzeme Seçiniz</label>
            <div class="row ">
                <?php while ($malzemeuruncek = $malzemeurunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="col-md-5 col-6 col-lg-2 mb-2">
                        <input class="form-check-input" type="radio" value="<?php echo $malzemeuruncek['malzeme_isim'] ?>" name="malzemeler[]">
                        <div class="card" style="width: 11rem;">
                            <img class="card-img-top" src="<?php echo $malzemeuruncek['malzeme_resimyol'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <input class="form-check-input" type="radio" value="<?php echo $malzemeuruncek['malzeme_isim'] ?>" name="malzemeler[]">
                                <label class="form-check-label  pl-3 pt-1" for="flexCheckDefault">
                                    <span class="h6" style=" font-family:Arial, Helvetica, sans-serif;"><?php echo $malzemeuruncek['malzeme_isim'] ?></span>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-md-12 text-left ">
                    <button class="btn btn-danger mt-2" name="listele">Listele</button>
                </div>
            </div>
        </div>
        <div class="container p-4 bg-white  rounded mt-4">
            <label class=" h6 ">Seçtiğiniz Ana Malzeme :</label><span class=" pl-3 "><?php if (isset($_POST['listele'])) {
                                                                                            @$malzemeler = $_POST['malzemeler'];
                                                                                            if ($malzemeler) {
                                                                                                foreach (@$malzemeler as $key => $value) {
                                                                                                    if (!$malzemeler) {
                                                                                                    } else {
                                                                                                        $malzemeyemeksor = $db->prepare("SELECT * FROM malzemeler_yemek WHERE ana_malzeme=:ana_malzeme");
                                                                                                        $malzemeyemeksor->execute(array(
                                                                                                            'ana_malzeme' => $value
                                                                                                        ));
                                                                                                        echo   @$value;
                                                                                                    }
                                                                                                }
                                                                                            } else { ?>
                        <span class="h5 text-warning blink pt-2">Malzeme seçmeniz gerekli !</span>
                <?php }
                                                                                        } ?></span>

        </div>
    </form>
    <div class="container p-0">
        <ul id="myUL" class="p-0 m-0">
            <div class="container mt-4">
                <div class="p-0 m-0 mt-5 mb-4">
                    <div class="row border border-white p-3">
                        <div class=" col-md-6 mx-auto">
                            <h1 class=" text-center"><?php if (@$value) {
                                                            echo @$value;
                                                        } else {
                                                            echo "Ana Malzeme";
                                                        } ?> ile Yapılacak Yemekler</h1>
                        </div>
                        <div class="col-md-6  mt-2">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Yemek Arayın" class="form-control btn  ">
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['listele'])) {
                if ($malzemeler) {
                    while (@$malzemeyemekcek = @$malzemeyemeksor->fetch(PDO::FETCH_ASSOC)) { ?>
                        <li>
                            <div class="container-fluid p-0 m-0 ">
                                <div class="container-fluid background blur p-0 m-0 ">
                                    <div class="div bg-white" data-aos="zoom-out" style="height:100%; width:80%;">
                                        <div class="jumbotron-fluid  p-3 mb-2 rounded ">
                                            <h6 class="text-center text-dark"><?php echo $malzemeyemekcek['malzemeler_yemek_baslik'] ?></h6>
                                            <div class="jumbotron-background">
                                                <div class="p-0 m-0 embed-responsive embed-responsive-16by9">
                                                    <iframe style="border-radius: 10px;" class=" embed-responsive-item pt-2" width="300" height="300" src="https://www.youtube.com/embed/<?php echo $malzemeyemekcek['malzemeler_yemek_video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                            <div class="container text-white text-center " style="word-wrap: break-word;">
                                                <center>
                                                    <textarea class="form-control bg-transparent   mt-4 " disabled style="resize: none;">Gerekli Malzemeler : <?php echo $malzemeyemekcek['malzemeler_yemek_aciklama'] ?></textarea>
                                                </center>
                                                <hr class="my-4">

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
            <?php }
                }
            } ?>
        </ul>
    </div>
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
    </script>
    <?php

    include 'footer.php'; ?>