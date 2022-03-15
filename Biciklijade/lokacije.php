<?php
$putanja = dirname($_SERVER["REQUEST_URI"]);
//var_dump($putanja);
$direktorij = getcwd();
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

        <meta name="viewport" content="width=device-width, initial scale=1.0">
        

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        
        <link rel="stylesheet" href="css/main.css">
        
        <script type="text/javascript" src="javascript/nmuse.js"></script>
        <title>Biciklijada</title>
    </head>
    <body onload="kreirajDogadaje4()">
        <div class="kontejner">
            <header>
                <img src="multimedija/biciklijada-logo.svg" alt="biciklijada-logo" class="logo">
                <?php
//var_dump($putanja);
                include_once 'zaglavlje.php';
                include_once 'meni.php';
                ?>
            </header>
            <section>
                <img src="multimedija/biciklijada-slika1.jpg" alt="bicikle-slika" class="bicikle">

                <h1>Biciklijade su dobre.</h1>
                
                <p class="podnaslov"></p>

                    <div>
                        <table id="tablicaLokacija" border ="1"> 
                            <thead>
                                <tr>
                                    <th>Lokacija</th>
                                    <th>Broj utrka</th>
                                </tr>
                            </thead>
                            <tbody id="lokacije">
                            </tbody>
                        </table>
                    </div>
            </section>
        </div>


        <footer>
            <div class="kontejner4">
                <div class="kontejner">
                    <a href="#">
                        <img src="/multimedija/slika7.svg" class="slika6" alt="slika7">
                    </a>
                    <p class="na-dnu">lorem ibsum...lorem ibsum...lorem ibsum...<br>lorem...</p>
                    <ul class="podnozje-poveznice">
                        <li><a href="#">lorem ibsum...lorem ibsum...</a></li>
                        <li><a href="#">lorem ibsum...lorem...</a></li>
                    </ul>
                </div>
            </div>
        </footer>

        <script>
            var izbornik = document.getElementById('izbornik');
            var nav = document.getElementById('nav');
            var izlaz = document.getElementById('izadi');

            izbornik.addEventListener('click', function (e) {
                nav.classList.toggle('sakrij-mobitel');
                e.preventDefault();
            });
            izlaz.addEventListener('click', function (e) {
                nav.classList.toggle('sakrij-mobitel');
                e.preventDefault();
            });
        </script>
    </body>
</html>