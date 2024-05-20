<?php

require("nedmin/netting/connection.php");

session_start();

$data = [];

if ($_POST) {

    if ($_SESSION) {

        $id = $_POST["id"];
        $ben = $_SESSION["userkullanici_mail"];
    }

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
} else {
    $data["hata"] = "Üye girişi yapmanız gerekiyor..";
}

echo json_encode($data);
