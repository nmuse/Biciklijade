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
    if (isset($_POST["pomak"], $_POST["stranicenje"], $_POST["sesija1"], $_POST["aktivacijski"], $_POST["prijaveNeuspjeh"], $_POST["kolacicTrajanje"])) {
  
        $pomak = $_POST['pomak'];
        $stranicenje = $_POST['stranicenje'];
        $sesija1 = $_POST['sesija1'];
        $aktivacijski = $_POST['aktivacijski'];
        $prijaveNeuspjeh = $_POST['prijaveNeuspjeh'];
        $kolacicTrajanje=$_POST['kolacicTrajanje'];
        
            $veza = new Baza();
            $veza->spojiDB();
            
            $sql77="UPDATE `postavke_sustava` SET `id`=1,`pomak`='$pomak',`broj_redaka`='$stranicenje',`broj_neuspjesnih_prijava`='$prijaveNeuspjeh',`trajanje_sesije`='$sesija1',`trajanje_aktivacijskog_linka`='$aktivacijski',`trajanje_kolacica`='$kolacicTrajanje' WHERE id=1";
            
            $rez = $veza->selectDB($sql77);
            
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
            <form novalidate name="konfiguriranje" id="konfiguriranje" method="post" action="">
                <div id="greske2"></div>
                <div id="greske3"></div>
                <div id="greske4"></div>
                <div>
                    <label for="pomak"><b>Pomak vremena: </b></label><br>
                    <input type="number" id="pomak" name="pomak" ><br>
                    
                    <label for="stranicenje"><b>Broj redaka: </b></label><br>
                    <input type="number" id="stranicenje" name="stranicenje" ><br>
                    
                    <label for="prijaveNeuspjeh"><b>Broj neuspješnih prijava: </b></label><br>
                    <input type="number" id="prijaveNeuspjeh" name="prijaveNeuspjeh" ><br>
                    
                    <label for="sesija1"><b>Trajanje sesije: </b></label><br>
                    <input type="number" id="sesija1" name="sesija1" ><br>
                    <!--<label for="cv"><b>CV: </b></label><br>
                    <input name="cv" id="cv" type="file"/><br>-->
                    <label for="aktivacijski"><b>Trajanje aktivacijskog linka: </b></label><br>
                    <input type="number" id="aktivacijski" name="aktivacijski" ><br>
                    
                    <label for="kolacicTrajanje"><b>Trajanje kolacica: </b></label><br>
                    <input type="number" id="kolacicTrajanje" name="kolacicTrajanje" ><br>
                    
                    <input type="submit" name="submit" id="submit" value="Postavi" />
                </div>
            </form>
        </div>
    </body>