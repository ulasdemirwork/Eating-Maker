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
                        <h2>Kupon Düzenleme
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarifi Paylaşan Kişi <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input disabled type="text" id="" name="paylasan_kullanici" value="<?php echo $tarifcek['paylasan_kullanici'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <?php $uzunluk = strlen($tarifcek['tarif_baslik']); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif Başlık : Karakter Sayısı <?php echo $uzunluk ?><span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="tarif_baslik" value="<?php echo $tarifcek['tarif_baslik'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif Beğeni Sayisi <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="begeni_sayisi" value="<?php echo $tarifcek['begeni_sayisi'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif Kupon <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="kupon_numarasi" value="<?php echo $tarifcek['kupon_numarasi'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kupon Miktarı <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="kupon_miktari" value="<?php echo $tarifcek['kupon_miktari'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kupon Durum<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="kupon_durum" id="heard" class="form-control">

                                        <option value="1" <?php echo $tarifcek['kupon_durum'] == 1 ? 'selected=""' : '' ?>>Aktif</option>

                                        <option value="0" <?php echo $tarifcek['kupon_durum'] == 0 ? 'selected=""' : '' ?>>Pasif</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="tarif_id" value="<?php echo $tarifcek['tarif_id'] ?>"> </input>

                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" name="kuponduzenle" class="btn btn-success">Güncelle</button>
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