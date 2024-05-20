<?php
include 'header.php';

$yemeksor = $db->prepare("SELECT * FROM anasayfa_yemek where yemek_id=:id ");
$yemeksor->execute(array(
    'id' => $_GET['yemek_id']
));

$yemekcek = $yemeksor->fetch(PDO::FETCH_ASSOC);

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
                        <h2>Yemek Düzenleme
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
                        <form action="../netting/process.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">




                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Ad<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="yemek_baslik" value="<?php echo $yemekcek['yemek_baslik'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <?php
                            $uzunluk = strlen($yemekcek['yemek_aciklama']);

                            ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Açıklama : Karakter Sayisi <?php echo $uzunluk++; ?><span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="yemek_aciklama" value="<?php echo $yemekcek['yemek_aciklama'] ?>" class="form-control col-md-7 col-xs-12">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Slogan <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="yemek_footer" value="<?php echo $yemekcek['yemek_footer'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>



                            <input type="hidden" name="yemek_id" value="<?php echo $yemekcek['yemek_id'] ?>"> </input>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Durum<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="yemek_durum" id="heard" class="form-control">

                                        <option value="1" <?php echo $yemekcek['yemek_durum'] == 1 ? 'selected=""' : '' ?>>Aktif</option>

                                        <option value="0" <?php echo $yemekcek['yemek_durum'] == 0 ? 'selected=""' : '' ?>>Pasif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="anasayfayemekduzenle" class="btn btn-success">Güncelle</button>
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