<?php
include 'header.php';
$kullanicisor = $db->prepare("SELECT * FROM kullanici");

$kullanicisor->execute();

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
                        <h2>Kullanıcı Listeleme
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

                        <!-- Div Start -->

                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Kayıt Tarihi</th>
                                    <th>Ad Soyad</th>
                                    <th>Mail Adresi</th>
                                    <th>Telefon</th>
                                    <th>İl</th>
                                    <th>İlce</th>
                                    <th>Adres</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $kullanicicek['kullanici_zaman'] ?></td>
                                        <td><?php echo $kullanicicek['kullanici_adsoyad'] ?></td>
                                        <td><?php echo $kullanicicek['kullanici_mail'] ?></td>
                                        <td><?php echo $kullanicicek['kullanici_gsm'] ?></td>
                                        <td><?php echo $kullanicicek['kullanici_il'] ?></td>
                                        <td><?php echo $kullanicicek['kullanici_ilce'] ?></td>
                                        <td><?php echo $kullanicicek['kullanici_adres'] ?></td>
                                        <td>
                                            <center><a href="edit-user.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>"><button type="submit" class="btn btn-success btn-xs">Düzenle</button></a></center>
                                        </td>
                                        <td>
                                            <a href="../netting/process.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>&kullanicisil=ok">
                                                <center><button type="submit" class="btn btn-danger btn-xs">Sil</button></center>
                                            </a>
                                        </td>

                                    </tr>

                                <?php } ?>


                            </tbody>
                        </table>



                        <!-- Div End -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>