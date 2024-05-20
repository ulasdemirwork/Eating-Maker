<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=eating-maker;charset=utf8", 'root', '');
    // echo "Veritabanı bağlantım başarılı";
} catch (PDOException  $e) {
    echo $e->getMessage();
}
