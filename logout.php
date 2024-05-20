<?php

session_start();
unset($_SESSION["userkullanici_mail"]);


header('Location:login.php?durum=exit');
