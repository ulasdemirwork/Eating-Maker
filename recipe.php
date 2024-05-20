<?php include 'header.php';
$tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE tarif_durum=2");

$tarifsor->execute();

$kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail");

$kullanicisor->execute(array(

    'mail' => @$_SESSION['userkullanici_mail']

));


$say = $kullanicisor->rowCount();


$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

$yorumlar = $db->prepare("SELECT * FROM yorumlar ");
$yorumlar->execute();

$yorumlarcek = $yorumlar->fetch(PDO::FETCH_ASSOC);






//veri tabanından ortalama sonuç ve kaç adet oylama yapılmış verisini alıyoruz.

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<style>
    select {
        border: none;
        outline: none;
        scroll-behavior: smooth;
    }

    .cooklist a {
        color: black;
    }

    .cooklist a:hover {
        color: red;
    }

    .jumbotron {

        color: red;
        font-weight: bold;
        font-size: 24px;
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
    textarea {
        resize: none;
    }

    button {
        cursor: pointer;
        outline: 0;
        color: #AAA;
    }

    .btn:focus {
        outline: none;
    }

    a {
        text-decoration: none;
        color: blue;
    }

    a:hover {
        text-decoration: none;
        color: blue;
    }

    .logina {
        text-decoration: none;
        color: red;
    }

    .logina:hover {
        text-decoration: none;
        color: red;
    }

    .oyla {
        color: white;

    }

    .oyla:hover {
        color: yellow;
    }

    .oyla:active {
        color: yellow;
    }

    .star {
        font-size: 24px;
    }

    @media screen and (max-width: 327px) {
        .star {
            font-size: 19px;

        }

        .icon {
            font-size: 20px;
        }
    }

    @media screen and (min-width: 430px) {
        .yildiz {
            display: flex;
            justify-content: end;

        }
    }



    body {
        background-color: #e6ecf2;
    }
</style>

<body>
    <hr class="text-white mt-3">
    <ul id="myUL" class="p-0 m-0">
        <div class="container mt-4">
            <div class="p-0 m-0 mt-5 mb-4">
                <div class="row p-3">
                    <div class=" col-md-6 mx-auto">
                        <h1 class="text-dark text-center">Üye Yemekleri</h1>
                    </div>
                    <div class="col-md-6  mt-2">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Yemek Arayın" class="form-control btn  ">
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['userkullanici_mail'])) { ?>

            <form action="nedmin/netting/process.php" method="post">

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="deger" class="form-control mb-2 ">
                                <option value="no">Yemek içeriğini seçiniz</option>
                                <option value="artan">Beğeni Sayisi(Artan)</option>
                                <option value="azalan">Beğeni Sayisi (Azalan)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="yemek_tur" class="form-control mb-2">
                                <option value="no">Yemek türünü seçiniz</option>
                                <option value="sicak-yemek">Sıcak yemek</option>
                                <option value="soguk-yemek">Soğuk Yemek </option>
                                <option value="tatli">Tatlı</option>
                                <option value="salata">Salata</option>
                                <option value="glutenli">Glütenli</option>
                                <option value="glutensiz">Glütensiz</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <input type="submit" name="sirala" class="btn btn-outline-danger w-100 mb-2" name="sirala" value="sirala">
                        </div>
                    </div>
                </div>
            </form>

        <?php } ?>


        <?php




        if (@$_GET['siralama'] == "azalan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE tarif_durum=2 ORDER BY begeni_sayisi DESC");
            $tarifsor->execute();
        } else if (@$_GET['siralama'] == "artan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE tarif_durum=2 ORDER BY begeni_sayisi ASC ");
            $tarifsor->execute();
        } else if (@$_GET['siralama'] == "glutenli") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_icerik=:yemek_icerik and  tarif_durum=2");
            $tarifsor->execute(array(
                'yemek_icerik' => 'Glutenli'
            ));
        } else if (@$_GET['siralama'] == "glutensiz") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_icerik=:yemek_icerik and  tarif_durum=2");
            $tarifsor->execute(array(
                'yemek_icerik' => 'Glutensiz'
            ));
        } else if (@$_GET['siralama'] == "tatli") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2 ");
            $tarifsor->execute(array(
                'yemek_tur' => 'tatli'
            ));
        } else if (@$_GET['siralama'] == "salata") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2 ");
            $tarifsor->execute(array(
                'yemek_tur' => 'salata'
            ));
        } else if (@$_GET['siralama'] == "sicak-yemek") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2");
            $tarifsor->execute(array(
                'yemek_tur' => 'sicak-yemek'
            ));
        } else if (@$_GET['siralama'] == "soguk-yemek") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2");
            $tarifsor->execute(array(
                'yemek_tur' => 'soguk-yemek'
            ));
        } else if (@$_GET['siralama'] == "glutenli-artan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_icerik=:yemek_icerik and  tarif_durum=2 GROUP by begeni_sayisi  ORDER BY begeni_sayisi ASC");
            $tarifsor->execute(array(
                'yemek_icerik' => 'Glutenli'
            ));
        } else if (@$_GET['siralama'] == "glutenli-azalan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_icerik=:yemek_icerik and  tarif_durum=2 GROUP by begeni_sayisi ORDER BY begeni_sayisi DESC");
            $tarifsor->execute(array(
                'yemek_icerik' => 'Glutenli'
            ));
        } else if (@$_GET['siralama'] == "glutensiz-artan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_icerik=:yemek_icerik and  tarif_durum=2   GROUP by begeni_sayisi  ORDER BY begeni_sayisi ASC");
            $tarifsor->execute(array(
                'yemek_icerik' => 'Glutensiz'
            ));
        } else if (@$_GET['siralama'] == "glutensiz-azalan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_icerik=:yemek_icerik and  tarif_durum=2   GROUP by begeni_sayisi ORDER BY begeni_sayisi DESC");
            $tarifsor->execute(array(
                'yemek_icerik' => 'Glutensiz'
            ));
        } else if (@$_GET['siralama'] == "tatli-artan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2   GROUP by begeni_sayisi ORDER BY begeni_sayisi  ASC");
            $tarifsor->execute(array(
                'yemek_tur' => 'tatli'
            ));
        } else if (@$_GET['siralama'] == "tatli-azalan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2   GROUP by begeni_sayisi ORDER BY begeni_sayisi  DESC");
            $tarifsor->execute(array(
                'yemek_tur' => 'tatli'
            ));
        } else if (@$_GET['siralama'] == "salata-artan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2   GROUP by begeni_sayisi ORDER BY begeni_sayisi  ASC");
            $tarifsor->execute(array(
                'yemek_tur' => 'salata'
            ));
        } else if (@$_GET['siralama'] == "salata-azalan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2   GROUP by begeni_sayisi ORDER BY begeni_sayisi  DESC");
            $tarifsor->execute(array(
                'yemek_tur' => 'salata'
            ));
        } else if (@$_GET['siralama'] == "sogukyemek-artan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2   GROUP by begeni_sayisi ORDER BY begeni_sayisi  ASC");
            $tarifsor->execute(array(
                'yemek_tur' => 'soguk-yemek'
            ));
        } else if (@$_GET['siralama'] == "sogukyemek-azalan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur  and  tarif_durum=2  GROUP by begeni_sayisi ORDER BY begeni_sayisi  DESC");
            $tarifsor->execute(array(
                'yemek_tur' => 'soguk-yemek'
            ));
        } else if (@$_GET['siralama'] == "sicakyemek-artan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2   GROUP by begeni_sayisi ORDER BY begeni_sayisi  ASC");
            $tarifsor->execute(array(
                'yemek_tur' => 'sicak-yemek'
            ));
        } else if (@$_GET['siralama'] == "sicakyemek-azalan") {

            $tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE yemek_tur=:yemek_tur and  tarif_durum=2   GROUP by begeni_sayisi ORDER BY begeni_sayisi  DESC");
            $tarifsor->execute(array(
                'yemek_tur' => 'sicak-yemek'
            ));
        }

        while ($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)) { ?>
            <li>
                <div class="container mx-auto p-0 m-0  rounded">
                    <div class="container-fluid p-0 m-0 bg-white rounded p-4">

                        <div class="div " data-aos="fade-up-right" style="height:100%; width:90%;">
                            <div class="jumbotron jumbotron-fluid  rounded p-2">
                                <div class="jumbotron-background">
                                    <img src="<?php $tarifcek['tarif_resimyol'] ?>" class="blur">
                                </div>
                                <div class="container text-white " style="word-wrap:break-word">
                                    <h6 class=" pb-2 text-center pt-2"><?php echo $tarifcek['tarif_baslik'] ?></h6>
                                    <img src="<?php echo $tarifcek['tarif_resimyol'] ?>" class="img-fluid pb-3" width="100%">
                                    <center> <textarea class="form-control bg-transparent text-white" disabled><?php echo $tarifcek['tarif_aciklama'] ?></textarea></center>

                                    <p class="h5 pt-3"><?php echo $tarifcek['tarif_footer'] ?>

                                    </p>

                                    <?php
                                    $begenisor = $db->prepare("SELECT * FROM begeniler WHERE begenen_mail=:begenen_mail and begenilen_id=:begenilen_id");

                                    $begenisor->execute(array(
                                        'begenen_mail' => @$_SESSION['userkullanici_mail'],
                                        'begenilen_id' => $tarifcek['tarif_id']
                                    ));

                                    $sor = $begenisor->rowCount();
                                    if ($sor == 1) { ?>
                                        <div class="container-fluid yildiz rounded">

                                            <div class="d-flex justify-content-start ">
                                                <a href="javascript:;" class="like" id="<?php echo $tarifcek['tarif_id'] ?>">
                                                    <i style="color: red;" class="fa fa-heart m-2  d-flex justify-content-start icon" aria-hidden="true"><span class="begen pl-2"><?php echo $tarifcek['begeni_sayisi'] ?><span></span></span>
                                                    </i>
                                                </a>
                                            </div>

                                            <div class="col-md-11 col-sm-6 d-flex justify-content-end  pt-2 ">

                                                <?php
                                                $ortalama = $tarifcek['ortalama_puan'];

                                                ?>

                                                <?php if ($ortalama >= 0 and $ortalama < 2) {  ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color: :yellow;"> 1
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 5

                                                        </i>
                                                    </a>
                                                <?php } elseif ($ortalama >= 2 and $ortalama < 3) { ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow;"> 1

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 5

                                                        </i>
                                                    </a>
                                                <?php } elseif ($ortalama >= 3 and $ortalama < 4) { ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow;"> 1

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 5

                                                        </i>
                                                    </a>
                                                <?php } elseif ($ortalama >= 4 and $ortalama < 5) { ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow;"> 1

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 5

                                                        </i>
                                                    </a>
                                                <?php } elseif ($ortalama >= 5) { ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow;"> 1

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 5

                                                        </i>
                                                    </a>
                                                <?php } ?>
                                            </div>

                                        </div>

                                        <div class="row bg-white rounded  mt-2 mb-2 ">
                                            <div class="col-md-6 col-sm-6 ">
                                                <span class="text-dark m-4"> <i class="fas fa-comments text-danger"></i> <span class="h4">(<?php echo $tarifcek['yorum_sayisi'] ?>)</span></span>
                                            </div>
                                            <div class="col-md-6 col-sm-6 text-right ">
                                                <span class="text-dark h6" style="text-transform: capitalize;">Tarif Sahibi-> <?php echo $kullanicicek['kullanici_adsoyad'] ?></span></span>
                                            </div>
                                        </div>
                                    <?php  } elseif (@$_SESSION['userkullanici_mail']) { ?>
                                        <div class="container-fluid yildiz ">


                                            <div class=" d-flex justify-content-start ">
                                                <a href="javascript:;" class="like" id="<?php echo $tarifcek['tarif_id'] ?>">
                                                    <i style="color: azure;" class="fa fa-heart m-2  d-flex justify-content-start icon" aria-hidden="true"><span class="begen pl-2"><?php echo $tarifcek['begeni_sayisi'];
                                                                                                                                                                                    ?></span>
                                                    </i>
                                                </a>
                                            </div>

                                            <div class="col-md-11 col-sm-6 d-flex justify-content-end pt-2">

                                                <?php
                                                $ortalama = $tarifcek['ortalama_puan'];
                                                ?>

                                                <?php if ($ortalama >= 0 and $ortalama < 2) {  ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color: :yellow;"> 1

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 5

                                                        </i>
                                                    </a>
                                                <?php } elseif ($ortalama >= 2 and $ortalama < 3) { ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow;"> 1

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 5

                                                        </i>
                                                    </a>
                                                <?php } elseif ($ortalama >= 3 and $ortalama < 4) { ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow;"> 1

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 5

                                                        </i>
                                                    </a>
                                                <?php } elseif ($ortalama >= 4 and $ortalama < 5) { ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow;"> 1

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>"> 5

                                                        </i>
                                                    </a>
                                                <?php } elseif ($ortalama >= 5) { ?>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="1">
                                                        <i class=" fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow;"> 1

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="2">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 2
                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="3">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 3

                                                        </i>
                                                    </a>

                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="4">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 4

                                                        </i>
                                                    </a>
                                                    <a href="javascript:;" class="oyla" id="<?php echo $tarifcek['tarif_id'] ?>" data-id="5">
                                                        <i class="fa fa-star start star" aria-hidden="true" id="<?php echo $tarifcek['tarif_id'] ?>" style="color:yellow"> 5

                                                        </i>
                                                    </a>
                                                <?php } ?>

                                            </div>

                                            <input hidden type="text" value="<?php echo @$_SESSION['userkullanici_mail'] ?>" name="kullanici_mail">
                                            <input hidden type="text" name="tarif_id" value="<?php echo $tarifcek['tarif_id'] ?>">
                                            <input hidden type="text" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
                                            </form>
                                        </div>



                                        <div class="row bg-white rounded  mt-2">
                                            <div class="col-md-6">
                                                <span class="text-dark m-4"> <i class="fas fa-comments text-danger"></i> <span class="h4">(<?php echo $tarifcek['yorum_sayisi'] ?>)</span></span>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <span class="text-dark h6" style="text-transform: capitalize;">Tarif Sahibi-> <?php echo $kullanicicek['kullanici_adsoyad'] ?></span></span>
                                            </div>
                                        </div>

                                </div>
                            <?php } ?>




                            <?php

                            @$tarif_id = $tarifcek['tarif_id'];
                            @$kulllanici_id = $kullanicicek['kullanici_id'];

                            $yorumsor = $db->prepare("SELECT * FROM yorumlar  WHERE tarif_id=:tarif_id");

                            $yorumsor->execute(array(
                                'tarif_id' => $tarif_id
                            ));

                            if (@$_SESSION['userkullanici_mail'] == '') { ?>
                                <div class="container mb-2 mt-2 bg-white">
                                    <span class="text-dark h5">Yorumları görebilmeniz için kayıt olmanız veya giriş yapmanız gerekli. <a href="register.php" class="h5 text-danger">Kayıt Ol</a>
                                        | <a href="login.php" class="logina h5">Giriş Yap</a>
                                    </span>
                                    <?php } else {
                                    while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) {
                                    ?>

                                        <div class="container  bg-white rounded mb-2 mt-2  " id="yorumlar">
                                            <i class="fas fa-comments text-danger"></i>
                                            <span style="text-transform: capitalize;" class="h6 text-dark"><button type="text" class="btn btn-white">İsim Soyisim -> <?php echo @$yorumcek['yorumlar_adsoyad'] ?></button></span>

                                            <p class="text-left  h6 text-dark" style="word-wrap:break-word;"><span class="h6"></span><textarea name="" id="" cols="30" rows="5" class="form-control" disabled> <?php echo $yorumcek['yorum_detay'] ?></textarea></p>

                                            <?php if ($kullanicicek['kullanici_id'] == $yorumcek['kullanici_id']) { ?>
                                                <div class="container  pt-2 pb-2  text-right mb-2 bg-white">
                                                    <a class="btn btn-danger   yorumsil w-100 btn-sm" href="javascript:;" id="<?php echo $yorumcek['yorum_id']; ?>" data-id="<?php echo $tarifcek['tarif_id'] ?>">
                                                        Yorumu sil
                                                    </a>
                                                </div>

                                            <?php } ?>
                                        </div>

                                <?php }
                                }
                                ?>

                                </div>
                            </div>

                            <?php if (@$_SESSION['userkullanici_mail'] == '') { ?>

                            <?php } else { ?>
                                <form action="" method="post" id="yorumyap">
                                    <div class="container text-right mt-4">
                                        <textarea name="yorum_detay" id="" cols="30" rows="5" class="form-control mt-4" placeholder="Yorumunuzu Giriniz" required></textarea>
                                        <button type="submit" class="btn mt-3 mb-3 submit" name="yorumkaydet" id="<?php echo $tarifcek['tarif_id'] ?>" style="background-color: azure;">Yorum Yap</button>
                                        <input type="text" hidden name="tarif_id" value="<?php echo $tarifcek['tarif_id'] ?>">
                                        <input type="text" hidden name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
                                        <input type="text" hidden name="yorumlar_adsoyad" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>">
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </li>

        <?php }
        ?>
    </ul>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up"></i></button>
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
        $(function() {

            $("a.like").click(function() {

                var nesne = $(this);
                var id = nesne.attr("id");

                var veri = "id=" + id + "&durum=1";
                $.ajax({

                    url: "ajaxbegen.php",
                    data: veri,
                    type: "post",
                    dataType: "json",
                    success: function(e) {
                        if (e.hata) {
                            swal({
                                title: "BEĞENİ GERİ ÇEKİLDİ",
                                text: "Beğeniyi geri çektiniz...",
                                icon: "warning",
                                button: false
                            });
                            setInterval(function() {
                                window.location.reload(1);
                            }, 1500);

                            $.ajax({
                                url: "ajaxbegenme.php",
                                data: veri,
                                type: "post",
                                dataType: "json",

                            });

                            var c = $("#" + id + ".begen").html();
                            var sayi = parseInt(c) - 1;
                            $("#" + id + ".begen").html(sayi);
                            $("#" + id + ".icon").css("color", "white");

                        } else {
                            swal({
                                title: "Tarifi Beğendiniz",
                                text: "Başka tariflere göz atabilirsiniz...",
                                icon: "success",
                                button: false
                            });
                            setInterval(function() {
                                window.location.reload(1);
                            }, 1500);

                            var c = $("#" + id + ".begen").html();
                            var sayi = parseInt(c) + 1;
                            $("#" + id + ".begen").html(sayi);
                            $("#" + id + ".icon").css("color", "red");

                        }
                    }

                });

            });
        });
        $(function() {

            $("a.oyla").click(function(e) {

                var nesne = $(this);
                var id = nesne.attr("id");
                var data_id = $(this).attr("data-id");
                var veri = "id=" + id + "&durum=0&" + "data-id=" + data_id;

                $.ajax({

                    url: "ajaxoyla.php",
                    data: veri,
                    type: "post",
                    dataType: "json",
                    success: function(e) {
                        if (e.ok) {
                            swal({
                                title: "Daha önce oylama yaptınız.",
                                text: "Başka tariflere göz atabilirsiniz.",
                                icon: "warning",
                                button: "Tamam"
                            });
                        }
                        if (e.hata) {
                            swal({
                                title: "Oylama Yapıldı.",
                                text: "Puanınz başarılı şekilde kaydedildi.",
                                icon: "success",
                                button: false
                            });
                            setInterval(function() {
                                window.location.reload(1);
                            }, 2000);
                        }
                    }
                });

            });
        });
        $(document).on("submit", "#yorumyap", function(event) {
            event.preventDefault();
            $.ajax({
                url: "ajaxyorum.php",
                type: "POST",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data['data']);
                    setInterval(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });

        });


        $(function() {
            $("a.yorumsil").click(function(e) {

                var nesne = $(this);
                var id = nesne.attr("id");
                var tarif_id = $(this).attr("data-id");
                var veri = "id=" + id + "&durum=1&data-id=" + tarif_id;

                $.ajax({

                    url: "ajaxyorumsil.php",
                    data: veri,
                    type: "post",
                    dataType: "json",
                    success: function(data) {
                        setInterval(function() {
                            window.location.reload(1);
                        }, 100);
                    }
                });

            });
        });
    </script>

    <?php include 'footer.php' ?>