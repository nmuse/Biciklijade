<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$direktorij = substr(getcwd(), 0, strpos(getcwd(), "privatno"));
$putanja = "../";
include '../zaglavlje.php';


?>
<html>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial scale=1.0">
        

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        
        <link rel="stylesheet" href="../css/main.css">
        
        <script type="text/javascript" src="../javascript/nmuse.js"></script>
        <title>Biciklijada</title>
    </head>
    <body onload="kreirajDogadaje3()">
        <header>
            <img src="../multimedija/biciklijada-logo.svg" alt="biciklijada-logo" class="logo">
<?php
include_once '../meni.php';
?>
        </header>
        

        <section>

                <table id="tbody17">
                    <caption>Ispis korisnika iz baze podataka</caption>
                    <thead>
                        <tr>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Korisničko ime</th>
                            <th>Email</th>
                            <th>Lozinka</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        
                    </tbody>
                </table>

        </section>



    </body>
