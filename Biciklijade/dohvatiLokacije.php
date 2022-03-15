<?php

include './baza.class.php';

$veza = new Baza();
$veza->spojiDB();
$upit = "SELECT lokacija.mjesto, count(utrka.id_utrka) as BrojUtrka FROM lokacija, utrka WHERE lokacija.id_lokacija=utrka.id_lokacija GROUP BY lokacija.mjesto";
$rezultat = $veza->selectDB($upit);


while($red = $rezultat->fetch_assoc()){
    
    $polje['lokacija']=$red['mjesto'];
    $polje['utrka']=$red['BrojUtrka'];
    
    $polje1[]=$polje;
    
}
echo json_encode($polje1);

$veza->zatvoriDB();