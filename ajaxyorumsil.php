<?php

require("nedmin/netting/connection.php");

session_start();

$data = [];

if ($_POST) {

    if ($_SESSION) {

        $tarif_id = $_POST['data-id'];
        $id = $_POST["id"];
        $ben = $_SESSION["userkullanici_mail"];

        $sil = $db->prepare("DELETE  FROM yorumlar where yorum_id=:yorum_id");
        $sil->execute(array(
            'yorum_id' => $id
        ));

        if ($sil) {

            $guncelle = $db->prepare("UPDATE yemek_tarif SET yorum_sayisi = yorum_sayisi - 1 WHERE tarif_id=:tarif_id");
            $guncelle->execute(array(

                'tarif_id' => $tarif_id
            ));
        }
    }
} else {
    $data["hata"] = "Üye girişi yapmanız gerekiyor..";
}


echo json_encode($data);
