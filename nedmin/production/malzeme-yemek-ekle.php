<?php
include 'header.php';

$malzemesor = $db->prepare("SELECT * FROM malzemeler_yemek");

$malzemesor->execute();

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
                        <h2>Malzeme Yemek Ekleme
                            <small>
                            </small>
                        </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="../netting/process.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Ad <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="malzemeler_yemek_baslik" required="required" placeholder="Yemek Adını Giriniz" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gerekli Malzemeler <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" name="malzemeler_yemek_aciklama" id="" cols="300" rows="10" placeholder="Yemek Açıklamasını Giriniz"></textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yemek Video Link <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="" name="malzemeler_yemek_video" placeholder="Yemek video linki girin" class="form-control col-md-7 col-xs-12">
                                    <input type="text" placeholder="Örnek = PJ66Gjk6JSY" class="form-control" disabled>
                                </div>
                            </div>


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
                                    <button type="submit" name="malzemeyemekkaydet" class="btn btn-success">Kaydet</button>
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