<?php
include 'header.php';
?>
<!-- Login Start -->
<style>
    body {
        background-color: #e6ecf2;
    }
</style>

<div class="container-fluid  p-4" style="margin-bottom: 230px;">
    <div class="container login" style="margin-bottom: 50px!important;">
        <main class="login-form rounded" style="background: transparent;">
            <form method="POST" action="nedmin/netting/process.php">
                <span class="logo text-center pl-5 pb-4">Eating-Maker</span>
                <?php if (isset($_GET['durum'])) {
                    if ($_GET['durum'] == "no") { ?>
                        <div class="alert alert-warning">
                            <strong>Hata !</strong> Giriş Yapılamadı Şifre Veya Kullanıcı adı hatalı
                        </div>
                <?php }
                } ?>
                <h1 class="h3 mb-3">Giriş Yapın</h1>
                <input type="email" class="form-control mb-3" placeholder="E-posta" name="kullanici_mail" required autofocus>
                <input type="password" class="form-control mb-3" placeholder="Şifre" name="kullanici_password" required>
                <input type="checkbox" value="1" name="hatirla"><span class="pl-2">Beni hatırla</span>

                <input class="w-100 btn btn-lg btn-warning mt-3" name="userlogin" type="submit" placeholder="Giriş Yap" value="Giriş Yap"></input>
                <p class="mt-2 mb-3  text-center">2021 Eating-Maker
                </p>
            </form>
        </main>
    </div>
</div>


<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up"></i></button>
<!-- Login End -->
<?php include 'footer.php' ?>