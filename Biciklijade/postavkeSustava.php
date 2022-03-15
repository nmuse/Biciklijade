<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('baza.class.php');

 function Dohvati(){
    $veza = new Baza();
    $veza ->spojiDB();
    
    $upit = "SELECT * FROM postavke_sustava WHERE id=1";
    $rezultat = $veza->selectDB($upit);
    
    $veza -> zatvoriDB();
    
    return $rezultat->fetch_assoc();
    
    
}

function trajanjeAktivacije(){
    
    
    $rezultat25 = Dohvati();
    
    
    return $rezultat25['trajanje_aktivacijskog_linka'];
    
}



function Vrijeme(){
    $postavke = Dohvati();
    $vrijeme = time() + $postavke['pomak']*3600;
    
    return date("Y-m-d H:i:s",$vrijeme);
}

