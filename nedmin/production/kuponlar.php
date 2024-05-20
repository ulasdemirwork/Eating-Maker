<?php
include 'header.php';
$tarifsor = $db->prepare("SELECT * FROM yemek_tarif WHERE begeni_sayisi >= 5");

$tarifsor->execute();

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
                        <h2>Kupon Listeleme
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
                                    <th>Sıra</th>
                                    <th>Tarifi paylaşan kişi</th>
                                    <th>Tarif isim</th>
                                    <th>Tarif Beğeni Sayisi</th>
                                    <th>Tarif kupon</th>
                                    <th>Kupon Miktarı</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $say = 0;
                                while ($tarifcek = $tarifsor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++ ?>
                                    <tr>
                                        <td width="10" align="center" style="padding-top: 35px;"><?php echo $say ?></td>
                                        <td width="10" align="center" style="padding-top: 35px;"><?php echo $tarifcek['paylasan_kullanici'] ?></td>
                                        <td>
                                            <?php echo $tarifcek['tarif_baslik'] ?>
                                        </td>
                                        <td><?php echo $tarifcek['begeni_sayisi'] ?></td>
                                        <td><?php echo $tarifcek['kupon_numarasi'] ?></td>
                                        <td><?php echo $tarifcek['kupon_miktari'] ?></td>
                                        <td>
                                            <center><a href="kuponlar-duzenle.php?tarif_id=<?php echo $tarifcek['tarif_id'] ?>"><button type="submit" class="btn btn-success btn-xs">Düzenle</button></a></center>
                                        </td>
                                        <td>
                                            <a href="../netting/process.php?tarif_id=<?php echo $tarifcek['tarif_id']; ?>&kuponsil=ok">
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