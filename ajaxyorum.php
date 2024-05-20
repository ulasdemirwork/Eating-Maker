<?php

require("nedmin/netting/connection.php");

session_start();

$data = [];

if ($_POST) {

    if ($_SESSION) {

        $kaydet = $db->prepare("INSERT INTO yorumlar SET
                yorum_detay=:yorum_detay,
                kullanici_id=:kullanici_id,
                tarif_id=:tarif_id,
                yorumlar_adsoyad=:yorumlar_adsoyad
                ");
        $insert = $kaydet->execute(array(
            'yorum_detay' => $_POST['yorum_detay'],
            'kullanici_id' => $_POST['kullanici_id'],
            'tarif_id' => $_POST['tarif_id'],
            'yorumlar_adsoyad' => $_POST['yorumlar_adsoyad']
        ));

        if ($insert) {
            $guncelle = $db->prepare("UPDATE yemek_tarif SET yorum_sayisi = yorum_sayisi + 1 WHERE tarif_id=:tarif_id");
            $guncelle->execute(array(
                'tarif_id' => $_POST['tarif_id']
            ));
        }
    }
} else {
    $data["hata"] = "Üye girişi yapmanız gerekiyor..";
}


echo json_encode($data);
