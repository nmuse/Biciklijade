<?php


$putanja = dirname($_SERVER["REQUEST_URI"]);
//var_dump($putanja);
$direktorij = getcwd();
include './zaglavlje.php';


$veza = new Baza();
$veza->spojiDB();

$sql15 = "SELECT * FROM korisnik";
$rezultat15 = $veza->selectDB($sql15);


while($red = $rezultat15->fetch_assoc()){
    
    $polje['ime']=$red['ime'];
    $polje['prezime']=$red['prezime'];
    $polje['korime']=$red['korisnicko_ime'];
    $polje['email']=$red['email'];
    $polje['status']=$red['status'];
    
    $polje1[]=$polje;
    
}

echo json_encode($polje1);

$veza->zatvoriDB();

