<?php

session_start();
unset($_SESSION["kullanici_mail"]);
unset($_SESSION["kullanici_password"]);

header('Location:index.php?durum=exit');
