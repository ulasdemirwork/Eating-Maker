<?php

$pas = "123456";
$hash = password_hash($pas, PASSWORD_DEFAULT);

var_dump($hash);


if (password_verify($pas, $hash)) {
    echo "Geçerli ";
} else {
    echo "Geçersiz";
}
