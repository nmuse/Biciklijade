<?php



$putanja = dirname($_SERVER["REQUEST_URI"]);
//var_dump($putanja);
$direktorij = getcwd();
include './zaglavlje.php';



if (!isset($_SESSION['uloga'])) {
    if (!isset($_COOKIE['uvjetiKoristenja'])) {
        $veza = new Baza();
        $veza ->spojiDB();
        
        $upit = "SELECT trajanje_kolacica FROM postavke_sustava";
        $rezultat = $veza->selectDB($upit);
        $trajanje = "";
        
        $red = mysqli_fetch_array($rezultat);
        if(!empty($red)){
            $trajanje = $red['trajanje_kolacica'];
        }

        $dani = $trajanje/24;

        $ispis = "Klikom na gumb prihvaćate uvjete korištenja!";
        echo "<script type='text/javascript'>alert('$ispis');</script>";
        setcookie("uvjetiKoristenja", "prihvaceni", time() + (86400 * $dani), "/", false);
    }
}



$veza = new Baza();
$veza->spojiDB();

if(isset($_GET['korime'])){
    $korisnickoIme = $_GET['korime'];
    
    
    $sqlUpit = "SELECT * FROM korisnik WHERE '{$korisnickoIme}'=korisnicko_ime";
    $rezultat3 = $veza->selectDB($sqlUpit)->fetch_assoc();
    
    $korisnik = $rezultat3['id_korisnik'];
    $trenutno = Vrijeme();
    $vrijemeRegistriranja = date('Y-m-d H:i:s', strtotime($rezultat3[datumVrijemeRegistracije]));
    
    $aktivacija = trajanjeAktivacije();
    
    
    $istek="";
    if($vrijemeRegistriranja!=null){
        $istek = date('Y-m-d H:i:s', strtotime($vrijemeRegistriranja)+($aktivacija*3600));
    }
    
    if($trenutno < $istek){
        $upit = "UPDATE korisnik SET status = 1 WHERE id_korisnik = '{$korisnik}'";
        $dobro = $veza->selectDB($upit);
        
        if($dobro != null){
            header("Location: https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x089/index.php");
        }
        
        
    }else{
        
    }
    
}


$veza -> zatvoriDB();
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

        <script type="text/javascript" src="../javascript/nmuse.js"></script>
        <title>Biciklijada</title>
    </head>
    <body onload="kreirajDogadaje()">
        <div class="kontejner">
            <header>
                <img src="multimedija/biciklijada-logo.svg" alt="biciklijada-logo" class="logo">
<?php
include_once './meni.php';
?>
            </header>
            <section>
                <img src="multimedija/biciklijada-slika1.jpg" alt="bicikle-slika" class="bicikle">

                <h1>Biciklijade su dobre.</h1>
                <p class="podnaslov"></p>
                <img src="multimedija/slika1.svg" alt="slika1" class="slika1 sakrij-mobitel pokazi-racunalo">
            </section>
        </div>

        <div class="kontejner2">
            <div class="kontejner">
                <ul>
                    <li>
                        <img src="multimedija/slika2.svg" alt="slika2">
                        <p>1lorem ipsum dolor sit amet,...</p>
                    </li>
                    <li>
                        <img src="multimedija/slika3.svg" alt="slika3">
                        <p>2lorem ipsum dolor sit amet,...</p>
                    </li>
                    <li>
                        <img src="multimedija/slika4.svg" alt="slika4">
                        <p>3lorem ipsum dolor sit amet,...</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="kontejner3">
            <div class="kontejner">
                <ul>
                    <li>
                        <figure>
                            <img src="multimedija/slika5.svg" alt="slika5">
                            <blockquote>lorem ibusm...lorem ibusm...lorem ibusm...lorem ibusm...</blockquote>
                            <figcaption>lorem ibusm...</figcaption>
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <img src="multimedija/slika6.svg" alt="slika6">
                            <blockquote>lorem ibusm...lorem ibusm...lorem ibusm...lorem ibusm...</blockquote>
                            <figcaption>lorem ibusm...</figcaption>
                        </figure>
                    </li>
                </ul>
            </div>
        </div>

        <div class="kontejner">
            <h2>lorem ibsum...</h2>
            <a href="#" class="botun">lorem ibsum...</a>
        </div>

        <footer>
            <div class="kontejner4">
                <div class="kontejner">
                    <a href="#">
                        <img src="multimedija/slika7.svg" class="slika6" alt="slika7">
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