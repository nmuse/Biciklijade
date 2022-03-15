<?php

include './baza.class.php';

$veza = new Baza();
$veza->spojiDB();
$upit="";
$rezultat = $veza->selectDB($upit);


while($red = $rezultat->fetch_assoc()){
    
    $polje['lokacija']=$red['mjesto'];
    $polje['utrka']=$red['BrojUtrka'];
    
    $polje1[]=$polje;
    
}
echo json_encode($polje1);

$veza->zatvoriDB();