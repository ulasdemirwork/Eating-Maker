<?php
include 'header.php';

$malzemesor = $db->prepare("SELECT * FROM malzemeler_yemek where malzemeler_yemek_id=:id ");
$malzemesor->execute(array(
    'id' => $_GET['malzemeler_yemek_id']
));

$malzemecek = $malzemesor->fetch(PDO::FETCH_ASSOC);

$malzemeurunsor = $db->prepare("SELECT * FROM malzeme_ekle");

$malzemeurunsor->execute();

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
                        <h2>Malzeme Düzenleme
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Malzeme Baslik<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="malzemeler_yemek_baslik" value="<?php echo $malzemecek['malzemeler_yemek_baslik'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <?php
                            $uzunluk = strlen($malzemecek['malzemeler_yemek_aciklama']);

                            ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gerekli Malzemeler : Karakter Sayisi <?php echo $uzunluk++; ?><span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="malzemeler_yemek_aciklama" value="<?php echo $malzemecek['malzemeler_yemek_aciklama'] ?>" class="form-control col-md-7 col-xs-12">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Video <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="malzemeler_yemek_video" value="<?php echo $malzemecek['malzemeler_yemek_video'] ?>" class="form-control col-md-7 col-xs-12">
                                    <input type="text" placeholder="Örnek = PJ66Gjk6JSY" class="form-control" disabled>
                                </div>
                            </div>



                            <input type="hidden" name="malzemeler_yemek_id" value="<?php echo $malzemecek['malzemeler_yemek_id'] ?>"> </input>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ana Malzeme<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="ana_malzeme" id="heard" class="form-control">
                                        <?php while ($malzemeuruncek = $malzemeurunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $malzemeuruncek['malzeme_isim'] ?>" <?php echo $malzemeuruncek['malzeme_isim'] == $malzemecek['ana_malzeme'] ? 'selected=""' : '' ?>><?php echo $malzemeuruncek['malzeme_isim'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="malzemeyemekduzenle" class="btn btn-success">Güncelle</button>
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