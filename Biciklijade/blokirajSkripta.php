<?php


$putanja = dirname($_SERVER["REQUEST_URI"]);
//var_dump($putanja);
$direktorij = getcwd();
include './zaglavlje.php';

$korime=$_GET['korime'];


$upit="UPDATE `korisnik` SET `status`=0 WHERE korisnicko_ime='{$korime}'";

$veza = new Baza();

$veza->spojiDB();

$veza->updateDB($upit);

$veza->zatvoriDB();

header("Location: deblokiranjeAdmin.php");