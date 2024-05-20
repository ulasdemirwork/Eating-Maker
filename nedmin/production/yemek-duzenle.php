<?php
include 'header.php';

$tarifsor = $db->prepare("SELECT * FROM yemek_tarif where tarif_id=:id ");
$tarifsor->execute(array(
    'id' => $_GET['tarif_id']
));

$tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC);

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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resmi Tekrardan Seçiniz !<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img width="200" src="../../<?php echo $tarifcek['tarif_resimyol'] ?>">
                                    <input type="file" id="first-name" name="tarif_resimyol" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Ad <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="tarif_baslik" value="<?php echo $tarifcek['tarif_baslik'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <?php $uzunluk = strlen($tarifcek['tarif_aciklama']); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Açıklama : Karakter Sayısı <?php echo $uzunluk ?><span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="tarif_aciklama" value="<?php echo $tarifcek['tarif_aciklama'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Slogan <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="tarif_footer" value="<?php echo $tarifcek['tarif_footer'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label  col-md-3 col-sm-3 col-xs-12" for="first-name" required>Yemek Türünü Seçiniz <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="yemek_tur" id="" class="form-control">
                                        <option value="<?php echo $tarifcek['yemek_tur'] ?>" selected><?php echo $tarifcek['yemek_tur'] ?></option>
                                        <option value="sicak-yemek">Sıcak Yemek</option>
                                        <option value="soguk-yemek">Soğuk Yemek</option>
                                        <option value="salata">Salata</option>
                                        <option value="tatli">Tatlı</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label  col-md-3 col-sm-3 col-xs-12" for="first-name" required>İçeriği Seçiniz <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="yemek_icerik" id="" class="form-control">
                                        <option value="<?php echo $tarifcek['yemek_icerik'] ?>" selected><?php echo $tarifcek['yemek_icerik'] ?></option>
                                        <option value="Glütenli">Glütenli</option>
                                        <option value="Glütensiz">Glütensiz</option>
                                    </select>
                                </div>
                            </div>



                            <input type="hidden" name="tarif_id" value="<?php echo $tarifcek['tarif_id'] ?>"> </input>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Durum<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="tarif_durum" id="heard" class="form-control">

                                        <option value="1" <?php echo $tarifcek['tarif_durum'] == 1 ? 'selected=""' : '' ?>>Aktif</option>

                                        <option value="0" <?php echo $tarifcek['tarif_durum'] == 0 ? 'selected=""' : '' ?>>Pasif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="yemekduzenle" class="btn btn-success">Güncelle</button>
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