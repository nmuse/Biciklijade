<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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


?>
<html>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        
        
        <script type="text/javascript" src="javascript/nmuse.js"></script>
        <title>Biciklijada</title>
    </head>
    <body onload="kreirajDogadaje5()">
        <header>
            <img src="multimedija/biciklijada-logo.svg" alt="biciklijada-logo" class="logo">
<?php
include_once 'meni.php';
?>
        </header>
        

        <section>

                <table id="tablica16" border="1">
                    <caption>Blokiranje/Deblokiranje</caption>
                    <thead>
                        <tr>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Korisničko ime</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Blokiraj/deblokiraj</th>
                        </tr>
                    </thead>
                    <tbody id="tbody15">
                        
                    </tbody>
                </table>

        </section>



    </body>
