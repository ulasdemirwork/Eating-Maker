<?php
include 'header.php';
$memleketsor = $db->prepare("SELECT * FROM memleket_yemek");

$memleketsor->execute();

?>

<!-- page content -->
<style>
    td,
    th {
        text-align: center;
    }
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Memleket Yemek Listeleme
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
                        <div align="right"> <a href="memleket-yemek-ekle.php"><button class="btn btn-success btn-xs">Yeni Ekle</button></a></div>
                    </div>
                    <div class="x_content">

                        <!-- Div Start -->

                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>

                                    <th>Sıra</th>
                                    <th>Yemek Resim</th>
                                    <th>Memleket İsim</th>
                                    <th>Memleket Yemek İsim</th>
                                    <th>Yemek Video Link</th>
                                    <th>Yemek Aciklama * 250 Karakterden fazla girmeyin. Yazınız görünmeyecektir !.<br></th>
                                    <th>Yemek Durum</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $say = 0;
                                while ($memleketcek = $memleketsor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++ ?>
                                    <tr>
                                        <td width="20" align="center" style="padding-top: 35px;"><?php echo $say ?></td>
                                        <td><img width="200" src="../../<?php echo $memleketcek['memleket_resimyol'] ?>"></td>
                                        <td><?php echo $memleketcek['memleket_isim'] ?></td>

                                        <td><?php echo $memleketcek['memleket_yemek_isim'] ?></td>

                                        <td><?php echo $memleketcek['memleket_videoyol'] ?></td>

                                        <td> <?php $uzunluk = strlen($memleketcek['memleket_icerik']);

                                                if (strlen($memleketcek['memleket_icerik']) < 250) {
                                                    echo "<br>";
                                                    echo $memleketcek['memleket_icerik'];
                                                } ?></td>
                                        <td>
                                            <center><?php

                                                    if ($memleketcek['memleket_durum'] == 1) { ?>
                                                    <button class="btn btn-success btn-xs">Aktif</button>

                                                <?php } else { ?>
                                                    <button class="btn btn-danger btn-xs">Pasif</button>
                                                <?php }
                                                ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center><a href="memleket-duzenle.php?memleket_id=<?php echo $memleketcek['memleket_id'] ?>"><button type="submit" class="btn btn-success btn-xs">Düzenle</button></a></center>
                                        </td>
                                        <td>
                                            <a href="../netting/process.php?tarif_id=<?php echo $memleketcek['memleket_id']; ?>&tarifsil=ok">
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