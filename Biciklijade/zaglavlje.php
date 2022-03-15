<?php

require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";
require "$direktorij/postavkeSustava.php";
Sesija::kreirajSesiju();


/*
 * dodaj zapis
 */

function dodaj_zapis() {
    global $direktorij;

    $sada = date('d.m.Y H:i:s');
    $fp = fopen("$direktorij/ostalo/dnevnik.log", "a+");

    fwrite($fp, $sada);
    fwrite($fp, ", ");
    if(isset($_SERVER["HTTP_REFERER"])){
        fwrite($fp, $_SERVER["HTTP_REFERER"]);
    }
    fwrite($fp, " - ");
    if(isset($_SESSION["korisnik"])){
        fwrite($fp, $_SESSION["korisnik"]);
    }
    fwrite($fp, "\n");
    fclose($fp);
}

dodaj_zapis();

/*
 * vrati asc polje
 */

function vrati_ascPolje($naziv) {
    $fp = fopen($naziv, "r");
    $rezultat = fread($fp, filesize($naziv));
    fclose($fp);
    
    $polje = explode("\n", $rezultat);
    
    
    for($i=1;$i<count($polje)-1;$i++){
        $kljuc=explode(", ",$polje[$i]);
        $ascPolje[$kljuc[0]]=$kljuc[1];
    }
    
    //var_dump($polje);
    
    //echo $contents;

    return $ascPolje;
}
