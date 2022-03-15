<?php

$putanja = dirname($_SERVER["REQUEST_URI"], 2);
$direktorij = dirname(getcwd());

if (!isset($_SERVER["HTTPS"]) ||
        strtolower($_SERVER["HTTPS"]) != "on") {
    $adresa = 'https://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    header("Location: $adresa");
    exit();
}

include '../zaglavlje.php';

//echo $direktorij;

//echo $putanja;

if (isset($_GET['submit'])) {
    
    //var_dump($_GET);
    $greska = '';
    $poruka = '';
    foreach ($_GET as $k => $v) {
        if (empty($v)) {
            $greska .= "Nije popunjeno" . $k . "<br>";
        } elseif ($k === 'lozinka') {
            $uzorak = '/^(?=.*\d).{4,10}$/';
            if (!preg_match($uzorak, $v)) {
                $greska .= " Format : Lozinka ima manje od 10 znaka ili više od 4 znakova i bar jedan broj"
                        . "<br>";
            }
        }
    }
    if (empty($greska)) {
        //$poruka = "Nema greske";
        $veza = new Baza();
        $veza->spojiDB();
        
        $tip="";
        $korime="";
        $lozinka="";
        if(isset($_GET['korime'],$_GET['lozinka'])){
            $korime = $_GET['korime'];
            $lozinka = $_GET['lozinka'];
        }
        
        $kriptiranaLozinka=sha1($lozinka."fcbgthjui");
        
            
        $upit = "SELECT * FROM korisnik WHERE "
                . "korisnicko_ime='{$korime}'"
                . "AND lozinka_sha1='{$kriptiranaLozinka}';";
        $rezultat = $veza->selectDB($upit);
        //var_dump($rezultat);
        $autenticiran = false;
        
        $red = mysqli_fetch_array($rezultat);
            //ako postoji korisnik s tom kombinacijom korime i lozinke
        if ($red) {
                // var_dump($red);
                
                //$tip = $red['id_tip']; // tip/uloga korisnika
               // $email = $red['email'];
               $status = $red['status'];
                
                if($status!=0){
                    $autenticiran = true;
                    $tip=$red['id_tip'];
                    $upit5 = "UPDATE korisnik SET broj_neuspjeha = 0 WHERE korisnicko_ime = '{$korime}'";
                    $rezultat = $veza->selectDB($upit5);
             
            }elseif($status==0){
                $autenticiran = false;
                echo "Blokiran račun";
            }
        }
        else{
            $upit = "SELECT * FROM korisnik WHERE "
                . "korisnicko_ime='{$korime}'";
        $rezultat = $veza->selectDB($upit);
        
        
        $red = mysqli_fetch_array($rezultat);
        
        $broj_pokusaja = $red['broj_neuspjeha'];
            $broj_pokusaja=$broj_pokusaja+1;
            
        $upit = "SELECT broj_neuspjesnih_prijava FROM postavke_sustava";
        $rezultat = $veza->selectDB($upit);
        $koliko = "";
        
        $red = mysqli_fetch_array($rezultat);
        if(!empty($red)){
            $koliko = $red['broj_neuspjesnih_prijava'];
        }
            
            
        if($broj_pokusaja==$koliko){
            $upitSql = "UPDATE korisnik SET status = 0, broj_neuspjeha = 3 WHERE korisnicko_ime = '{$korime}'";
            $veza->updateDB($upitSql);
            echo "Blokiran račun";
        }else{
            $upitSql = "UPDATE korisnik SET broj_neuspjeha = broj_neuspjeha+1 WHERE korisnicko_ime = '{$korime}'";;
            $veza->updateDB($upitSql);
            echo "Neuspješna prijava";
        }
        
}
        
        
        if ($autenticiran) {
            
            if (empty($_COOKIE['autenticiran'])) {
                //$mail_to = $email;
                //$mail_from = "From: nmuse@foi.hr";
                //$mail_subject = "Slanje maila!";
                //$mail_body = "Prijava u sustav!";
                //mail($mail_to, $mail_subject, $mail_body, $mail_from);
            }
            
            $poruka = 'Uspjesna prijava!';
            setcookie("autenticiran", $korime, false, '/', false);
            

            Sesija::kreirajKorisnika($korime, $tip);
                
            //var_dump($_SESSION);
            if (isset($_GET['zapamti'])) {
                setcookie("zapamti", $korime, false, '/', false);
            }
        } else {
            $poruka = 'Neuspjesna prijava!';
            
        }
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
        <link rel="stylesheet" href="../css/main.css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script type="text/javascript" src="../javascript/nmuse.js"></script>
        <title>Biciklijada</title>
    </head>
    <body onload="kreirajDogadaje()">
        <div class="kontejner">
            <header>
                <img src="../multimedija/biciklijada-logo.svg" alt="biciklijada-logo" class="logo">
<?php
$putanja = dirname($_SERVER["REQUEST_URI"], 2);
$direktorij = dirname(getcwd());
//var_dump($putanja);
include_once '../zaglavlje.php';
include_once '../meni.php';
?>
            </header>
            <section>
                <img src="../multimedija/biciklijada-slika1.jpg" alt="bicikle-slika" class="bicikle">

                <h1>Biciklijade su dobre.</h1>
                <?php
                    if(isset($_SESSION["uloga"])){
                        echo "<a href='../odjava.php'>odjava</a>";
                    }else{
                        echo "<a href='./prijava.php'>prijava</a>";
                    }
                ?>
                <p class="podnaslov"></p>

            </section>
        </div>

        <div class="kontejner5">
            <h2>Prijava</h2>
            <div id="greske" style ="color:green">
<?php
if (isset($poruka)) {
    echo "<p>$poruka</p>";
}
?>

            </div>
            <?php
            if(empty($_SESSION)){
      echo "Nema sesije";
}
?>          
            
            <form novalidate name="prijava" id="prijava" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <label for="korime">Korisničko ime</label>
                <input type="text" name="korime" id="korime" placeholder="Unesite korisničko ime" required value="<?php
               
                if (isset($_COOKIE['zapamti'])) {
                    $kuki = $_COOKIE['zapamti'];
                    echo $kuki;
                }
                ?>" > <br>               
                <label for="lozinka">Lozinka:</label>
                <input id="lozinka" name="lozinka" type="password" placeholder="Unesite lozinku" required><br>
                <input type="checkbox" checked="checked" name="zapamti">Zapamti me<br>
                <input id="submit" name="submit" type="submit" value="Prijavi se">
            </form>
            <a href="../zaboravljenaLozinka.php">Zaboravljena lozinka</a>
            <div id="poruka">
<?php
if (isset($greska)) {
    echo "<p>$greska</p>";
}
?>

            </div>
        </div>

        <div class="kontejner3">
            <div class="kontejner">
                <ul>
                    <li>
                        <figure>
                            <img src="../multimedija/slika5.svg" alt="slika5">
                            <blockquote>lorem ibusm...lorem ibusm...lorem ibusm...lorem ibusm...</blockquote>
                            <figcaption>lorem ibusm...</figcaption>
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <img src="../multimedija/slika6.svg" alt="slika6">
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
                        <img src="../multimedija/slika7.svg" class="slika6" alt="slika7">
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