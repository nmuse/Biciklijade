<?php
$putanja = dirname($_SERVER["REQUEST_URI"], 2);
$direktorij = dirname(getcwd());

include '../zaglavlje.php';

if(!isset($_SESSION["uloga"])){
    header("Location: ./prijava.php");
    exit();
}
if ($_SESSION["uloga"] !== "1") {
    header("Location: ./prijava.php");
    exit();
}

if (isset($_COOKIE['autenticiran'])) {
    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT * FROM korisnik";
    $rezultat = $veza->selectDB($upit);
    $veza->zatvoriDB();

    //var_dump($rezultat);
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
        <link rel="stylesheet" href="../css/main.css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script type="text/javascript" src="../javascript/nmuse.js"></script>
        <title>Biciklijada</title>
    </head>
    <body onload="kreirajDogadaje2()">
        <header>
            <img src="multimedija/biciklijada-logo.svg" alt="biciklijada-logo" class="logo">
<?php
include_once '../meni.php';
?>
        </header>
        <div>
            <?php
            echo "<p style = 'text-align:center'>Zapis iz dnevnika</p>";
            $ascPolje = vrati_ascPolje("../ostalo/dnevnik.log");
            //var_dump($ascPolje);

            $i = 1;
            foreach ($ascPolje as $datum => $stranica) {
                echo $i . ".['$datum']=>'$stranica' <br>";
                
                $i++;
            }
            ?>
        </div>

    </body>