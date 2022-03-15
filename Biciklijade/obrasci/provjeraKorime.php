<?php
include '../baza.class.php';

$korime = $_POST["korisnik"];
    $upitSql2 = "SELECT * FROM korisnik where korisnicko_ime ='{$korime}'";
    $veza = new Baza();
    $veza ->spojiDB(); 
    $rezultat5=$veza->selectDB($upitSql2);
    
    $red10 = mysqli_fetch_array($rezultat5);
    
    if($red10 != null){
        $polje22['korisnik'] = $korime;
        echo json_encode($polje22);
    }else{
        $polje22['korisnik'] = 0;
        echo json_encode($polje22);
    }