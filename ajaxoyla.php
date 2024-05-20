<?php

require("nedmin/netting/connection.php");

session_start();

$data = [];

if ($_POST) {

    if ($_SESSION) {

        $data_id = $_POST['data-id'];
        $id = $_POST["id"];
        $ben = $_SESSION["userkullanici_mail"];

        $query = $db->prepare("SELECT * FROM puan WHERE kullanici_mail = ?  and tarif_id = ?");
        $query->execute([$ben, $id]);
        $ok = $query->rowCount();
    }
    if ($ok) {
        $data["ok"] =  "Daha önce oylama yaptınız";
    } else {


        $data["hata"] =  "Oylama Yapıldı";
        $ekle = $db->prepare("INSERT INTO puan SET
        
        kullanici_mail = ?,
        tarif_id = ?,
        puan = ?

        ");
        $ekle->execute([$ben, $id, $data_id]);

        $guncelle = $db->prepare("UPDATE yemek_tarif SET tarif_puan = tarif_puan + $data_id , oy_sayisi = oy_sayisi + 1 , ortalama_puan = tarif_puan / oy_sayisi WHERE tarif_id = ?");

        $guncelle->execute([$id]);


        $tamam = $guncelle->rowCount();
    }
} else {
    $data["no"] = "Üye girişi yapmanız gerekiyor..";
}


echo json_encode($data);
