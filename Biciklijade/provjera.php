<?php

include('./baza.class.php');


if (isset($_POST['username_check'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $username = $_POST['korime'];
    $sql = "SELECT * FROM korisnik WHERE korisnicko_ime =$username";
    $rez = $veza->selectDB($sql);
    if (mysqli_num_rows($rez) > 0) {
        echo 'zauzeto';
    } else {
        echo 'slobodno';
    }
    echo $username;
    $veza->zatvoriDB();
    exit();
}