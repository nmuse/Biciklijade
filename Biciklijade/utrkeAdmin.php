<?php
$putanja = dirname($_SERVER["REQUEST_URI"]);
$direktorij = getcwd();

include 'zaglavlje.php';

if(!isset($_SESSION["uloga"])){
    header("Location: ./prijava.php");
    exit();
}
if ($_SESSION["uloga"] !== "1") {
    header("Location: ./prijava.php");
    exit();
}


if (isset($_POST["submit"])) {
    if (isset($_POST["nazivUtrke"], $_POST["startnina"], $_POST["brojNatjecatelja"], $_POST["datumPocetka"], $_POST["vrijemePocetka"], $_POST["biciklijada"],$_POST['lokacija1'],$_POST['sudac'])) {
  
        $naziv = $_POST['nazivUtrke'];
        $startnina = $_POST['startnina'];
        $brojNatjecatelja = $_POST['brojNatjecatelja'];
        $datum = $_POST['datumPocetka'];
        $vrijeme = $_POST['vrijemePocetka'];
        $biciklijada=$_POST['biciklijada'];
        $lokacija1=$_POST['lokacija1'];
        $sudac=$_POST['sudac'];
                
            $veza = new Baza();
            $veza->spojiDB();
            
            
        $sql12 = "SELECT id_biciklijada FROM biciklijada WHERE naziv = '{$biciklijada}'";
        $rez12 = $veza->selectDB($sql12);

        $red = mysqli_fetch_array($rez12);
        $id_biciklijada = $red['id_biciklijada'];
        
        
        
        $sql13 = "SELECT id_lokacija FROM lokacija WHERE mjesto= '{$lokacija1}'";
        $rez13 = $veza->selectDB($sql13);

        $red = mysqli_fetch_array($rez13);
        $id_lokacija = $red['id_lokacija'];
        
        
        
        $sql13 = "SELECT id_korisnik FROM korisnik WHERE korisnicko_ime = '{$sudac}'";
        $rez13 = $veza->selectDB($sql13);

        $red = mysqli_fetch_array($rez13);
        $id_korisnik22 = $red['id_korisnik'];
            
            
            
            $sql = "INSERT INTO `utrka`(`id_utrka`, `naziv`, `datum_pocetka`, `vrijeme_pocetka`, `vrijeme_zavrsetka`, `broj_natjecatelja`, `kraj`, `startnina`, `id_lokacija`,`id_biciklijada`, `id_pobjednik`, `id_moderator`) VALUES"
                                            . " (DEFAULT,'$naziv','$datum','$vrijeme',null,'$brojNatjecatelja',0,'$startnina',$id_lokacija,'$id_biciklijada',null,$id_korisnik22)";
            
            $rez = $veza->selectDB($sql);
            
			$veza->zatvoriDB();
		}
                
    }



?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta rel="stylesheet" href="css/main.css">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <script type="text/javascript" src="javascript/nmuse.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <title>Biciklijada</title>
    </head>
    <body onload="kreirajDogadaje2()">
        <header>
            <img src="multimedija/biciklijada-logo.svg" alt="biciklijada-logo" class="logo">
<?php
include_once 'meni.php';
?>
        </header>
        <div class="kontejner6">
            <form novalidate name="registracija" id="registracija" method="post" action="">
                <div id="greske2"></div>
                <div id="greske3"></div>
                <div id="greske4"></div>
                <div>
                    <label for="nazivUtrke"><b>Naziv utrke: </b></label><br>
                    <input type="text" id="nazivUtrke" name="nazivUtrke" ><br>
                    
                    <label for="startnina"><b>Startnina: </b></label><br>
                    <input type="text" id="startnina" name="startnina" ><br>
                    
                    <label for="brojNatjecatelja"><b>Broj natjecatelja: </b></label><br>
                    <input type="text" id="brojNatjecatelja" name="brojNatjecatelja" ><br>
                    <!--<label for="cv"><b>CV: </b></label><br>
                    <input name="cv" id="cv" type="file"/><br>-->
                    <label for="datumPocetka"><b>Datum pocetka: </b></label><br>
                    <input type="date" id="datumPocetka" name="datumPocetka" ><br>
                    
                    <label for="vrijemePocetka"><b>Vrijeme pocetka: </b></label><br>
                    <input type="time" id="vrijemePocetka" name="vrijemePocetka" ><br>
                    
                    
                        <select id="biciklijada" name="biciklijada">
                            <?php
                            $veza1 = new Baza();
                            $veza1->spojiDB();

                            $sql7 = "SELECT naziv FROM biciklijada";
                            $rez7 = $veza1->selectDB($sql7);
                            

                            while ($red = mysqli_fetch_array($rez7)) {
                                echo "<option value = '{$red['naziv']}'" . ">{$red['naziv']}</option>";
                            }
                            $veza1->zatvoriDB();
                            
                            ?>
                        </select> <br>
                        
                        <select id="lokacija1" name="lokacija1">
                            <?php
                            $veza1 = new Baza();
                            $veza1->spojiDB();

                            $sql7 = "SELECT mjesto FROM lokacija";
                            $rez7 = $veza1->selectDB($sql7);
                            

                            while ($red = mysqli_fetch_array($rez7)) {
                                echo "<option value = '{$red['mjesto']}'" . ">{$red['mjesto']}</option>";
                            }
                            
                            $veza1->zatvoriDB();
                            ?>
                        </select> <br>
                        
                        <select id="sudac" name="sudac">
                            <?php
                            $veza1 = new Baza();
                            $veza1->spojiDB();

                            $sql7 = "SELECT korisnicko_ime FROM korisnik where id_tip = 2";
                            $rez7 = $veza1->selectDB($sql7);
                            

                            while ($red = mysqli_fetch_array($rez7)) {
                                echo "<option value = '{$red['korisnicko_ime']}'" . ">{$red['korisnicko_ime']}</option>";
                            }
                            
                            $veza1->zatvoriDB();
                            ?>
                        </select> <br>
                    
                    
                    
                    <input type="submit" name="submit" id="registriraj" value="NovaUtrka" />
                </div>
            </form>
        </div>
    </body>