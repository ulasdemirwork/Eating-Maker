<?php
include 'header.php';

$yorumsor = $db->prepare("SELECT * FROM yorumlar where yorum_id=:id ");
$yorumsor->execute(array(
    'id' => $_GET['yorum_id']
));

$yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC);

?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Yorum Düzenleme
                            <small>
                                <?php
                                if (isset($_GET['durum'])) {
                                    if ($_GET['durum'] == "ok") { ?>
                                        <b style="color:green;">İşlem Başarılı</b>
                                    <?php } elseif ($_GET['durum'] == "no") { ?>
                                        <b style="color:red">İşlem Başarısız</b>
                                <?php
                                    }
                                }
                                ?>
                            </small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="../netting/process.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">







                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorum yapan kullanıcı <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="yorumlar_adsoyad" value="<?php echo $yorumcek['yorumlar_adsoyad'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <?php $uzunluk = strlen($yorumcek['yorum_detay']); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorum detay : Karakter Sayısı <?php echo $uzunluk ?><span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="yorum_detay" value="<?php echo $yorumcek['yorum_detay'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yorum Zaman <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input disabled type="text" id="" name="yorum_zaman" value="<?php echo $yorumcek['yorum_zaman'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>



                            <input type="hidden" name="yorum_id" value="<?php echo $yorumcek['yorum_id'] ?>"> </input>

                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="yorumduzenle" class="btn btn-success">Güncelle</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>


<?php
include 'footer.php';
?>