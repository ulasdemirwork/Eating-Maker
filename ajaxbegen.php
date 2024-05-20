<?php

require("nedmin/netting/connection.php");

session_start();

$data = [];

if ($_POST) {

    if ($_SESSION) {

        $id = $_POST["id"];
        $ben = $_SESSION["userkullanici_mail"];

        $query = $db->prepare("SELECT * FROM begeniler WHERE begenen_mail = ?  and begenilen_id = ?");
        $query->execute([$ben, $id]);
        $ok = $query->rowCount();
    }
    if ($ok) {
        $data["hata"] =  "Konuyu daha önce beğenmediniz..";
    } else {

        $ekle = $db->prepare("INSERT INTO begeniler SET
        
        begenen_mail = ?,
        begenilen_id = ?

        ");
        $ekle->execute([$ben, $id]);

        $guncelle = $db->prepare("UPDATE yemek_tarif SET begeni_sayisi = begeni_sayisi + 1 WHERE tarif_id = ?");

        $guncelle->execute([$id]);


        $tamam = $guncelle->rowCount();

        if ($tamam) {
        } else {
        }
    }
} else {
    $data["hata"] = "Üye girişi yapmanız gerekiyor..";
}

echo json_encode($data);
