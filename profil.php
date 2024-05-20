<?php
include 'header.php';

$kullanicisor = $db->prepare("SELECT * FROM kullanici where  kullanici_mail=:mail");
$kullanicisor->execute(array(

    'mail' => $_SESSION['userkullanici_mail']

));
$say = $kullanicisor->rowCount();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

?>
<!-- Login Start -->
<style>
    .backg {
        background: url(images/burger_hamburger_black_burger_juicy_116248_1920x1080.jpg);
        background-size: contain;
    }
</style>
<div class="container-fluid bg-white p-4 backg">
    <div class="container login" style="margin-bottom: 50px!important;">
        <main class="login-form rounded d-flex" style="background: transparent;">
            <form method="POST" action="nedmin/netting/process.php">
                <?php if (isset($_GET['durum'])) {
                    if ($_GET['durum'] == "ok") { ?>
                        <div class="alert alert-success">
                            <Strong></Strong>Güncelleme başarılı..
                        </div>
                    <?php } elseif ($_GET['durum'] == "no") { ?>
                        <div class="alert alert-danger">
                            <Strong></Strong>Güncelleme başarsısız..
                        </div>
                <?php }
                } ?>
                <input type="text" class="form-control mb-3" hidden value="<?php echo $kullanicicek['kullanici_id'] ?>" name="kullanici_id">

                <h1 class="h3 mb-3 text-white">Profil Bilgilerim</h1>
                <input type="email" class="form-control mb-3" value="<?php echo $kullanicicek['kullanici_mail'] ?>" name="kullanici_mail" disabled="">
                <input type="text" class="form-control mb-3" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>" name="kullanici_adsoyad" autofocus>
                <input type="text" class="form-control mb-3" value="<?php echo $kullanicicek['kullanici_gsm'] ?>" name="kullanici_gsm">
                <input class="w-100 btn btn-lg btn-success" name="userupdate" type="submit" value="Güncelle"></input>
                <p class="mt-2 mb-3  text-white text-center">2021 PhpProje
                </p>
            </form>
        </main>
        <center> <a href="password.php"><input class="w-40 btn btn-lg btn-outline-primary mt-3  mr-5" type="submit" value="Şifremi Güncelle"></input></a></center>
    </div>
</div>

<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up"></i></button>
<!-- Login End -->
<?php include 'footer.php' ?>