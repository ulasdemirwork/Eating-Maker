<?php

require("nedmin/netting/connection.php");

session_start();

$data = [];

if ($_POST) {

    if ($_SESSION) {
    }
} else {
    $data["hata"] = "Üye girişi yapmanız gerekiyor..";
}


echo json_encode($data);
