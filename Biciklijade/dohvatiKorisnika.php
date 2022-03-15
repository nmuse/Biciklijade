<?php

$putanja = dirname($_SERVER["REQUEST_URI"]);
//var_dump($putanja);
$direktorij = getcwd();

include 'zaglavlje.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$veza = new Baza();
$veza ->spojiDB();

$upitSql3 = "SELECT * FROM korisnik";
$rezultat=$veza->selectDB($upitSql3);



while($red = $rezultat->fetch_assoc()){
    
    $polje['ime']=$red['ime'];
    $polje['prezime']=$red['prezime'];
    $polje['korime']=$red['korisnicko_ime'];
    $polje['email']=$red['email'];
    $polje['lozinka']=$red['lozinka'];
    
    $polje1[]=$polje;
    
}

echo json_encode($polje1);

$veza->zatvoriDB();