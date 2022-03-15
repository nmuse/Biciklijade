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
    if (isset($_POST["mjesto"], $_POST["grad"], $_POST["drzava"], $_POST["moderator"])) {
  
        $mjesto = $_POST['mjesto'];
        $grad = $_POST['grad'];
        $drzava = $_POST['drzava'];
        $moderator = $_POST['moderator'];
                
            $veza = new Baza();
            $veza->spojiDB();
            
            
        
  
        
        $sql13 = "SELECT id_korisnik FROM korisnik WHERE korisnicko_ime = '{$moderator}'";
        $rez13 = $veza->selectDB($sql13);

        $red = mysqli_fetch_array($rez13);
        $id_korisnik22 = $red['id_korisnik'];
        
        
            
            $sql = "INSERT INTO `lokacija`(`id_lokacija`, `mjesto`, `grad`, `drzava`) VALUES (DEFAULT,'$mjesto','$grad','$drzava')";
            
            
            
            
            
            $veza->selectDB($sql);
            
            $sql12 = "SELECT id_lokacija FROM lokacija WHERE mjesto = '{$mjesto}'";
        $rez12 = $veza->selectDB($sql12);

        $red = mysqli_fetch_array($rez12);
        
        $id_lokacija3 = $red['id_lokacija'];
            
        
        $sqlUpit10="INSERT INTO `zaduzenja`(`id_lokacija`, `id_korisnik`) VALUES ('$id_lokacija3','$id_korisnik22')";
        
            $veza->selectDB($sqlUpit10);
            
            
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
            <form novalidate name="lokacijaBiciklijada" id="lokacijaBiciklijada" method="post" action="">
                <div id="greske2"></div>
                <div id="greske3"></div>
                <div id="greske4"></div>
                <div>
                          
                    <label for="mjesto"><b>Mjesto: </b></label><br>
                    <input type="text" id="mjesto" name="mjesto" placeholder="Unesite mjesto" size="15" maxlength="15" required="required" ><br>
                    
                    <label for="grad"><b>Grad: </b></label><br>
                    <input type="text" id="grad" name="grad" placeholder="Unesite grad" size="15" maxlength="15" required="required"><br>
                    
                    <label for="drzava"><b>Drzava: </b></label><br>
                    <input type="text" id="drzava" name="drzava" placeholder="Unesite drzavu" size="15" maxlength="15" required="required"><br>
                    <!--<label for="cv"><b>CV: </b></label><br>
                    <input name="cv" id="cv" type="file"/><br>-->
                    
                    <select id="moderator" name="moderator">
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
                    
                    
                    
                    <input type="submit" name="submit" id="registriraj" value="NovaLokacija" />
                </div>
            </form>
        </div>
    </body>