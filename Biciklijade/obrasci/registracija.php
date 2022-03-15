<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());

include '../zaglavlje.php';
/*
if (isset($_POST["korisnik"])&& isset($_POST["username_check"])){
    
    
}
*/

if (isset($_POST["submit"])) {
    if (isset($_POST["ime"], $_POST["prezime"], $_POST["korime"], $_POST["datum"], $_POST["email"], $_POST["lozinka"], $_POST["ponovljenaLozinka"])) {

        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korime = $_POST['korime'];
        $datum = $_POST['datum'];
        $email = $_POST['email'];
        $lozinka = $_POST['lozinka'];
        $ponovljenaLozinka = $_POST['ponovljenaLozinka'];
        
        $imeDobro = false;
        $prezimeDobro = false;
        $korimeDobro = false;
        $emailDobro = false;
        $datumDobro = false;
        $lozinkaDobro = false;
        $lozinkeIste = false;
    
    
        if (preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", $ime)) {
            $imeDobro = true;
        }
        
        
        if (preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", $prezime)) {
            $prezimeDobro = true;
        }
        
        if (preg_match("/^[a-z0-9_-]{3,16}$/im", $korime)) {
            $korimeDobro = true;
        }
        
        if (preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $email)) {
            $emailDobro = true;
        }
        
        $skupa = explode("-", $datum);
        $godina = $skupa[0];
        if ($datum !== "" && ($godina >= 1940 && $godina <= 2008)) {
            $datumDobro = true;
        }
       
        if (preg_match("/^(?=.*\d).{4,10}$/", $lozinka)) {
            $lozinkaDobro = true;
        }
        
        if ($lozinka===$ponovljenaLozinka) {
            $lozinkeIste = true;
        }
        
        if ($imeDobro && $prezimeDobro && $korimeDobro &&  $emailDobro && $datumDobro && $lozinkaDobro && $lozinkeIste) {
            
            $salt = sha1(time());
            $kriptirano = sha1($salt . $lozinka);
			$veza = new Baza();
            $veza->spojiDB();
            
            $kriptiranaLozinka=sha1($lozinka."fcbgthjui");
            
            $sql = "INSERT INTO `korisnik`(`id_korisnik`, `ime`, `prezime`, `korisnicko_ime`, `datum_rodenja`, `email`, `lozinka`, `lozinka_sha1`, `prihvaceni_uvjeti_koristenja`, `status`, `id_tip`) VALUES (DEFAULT,'$ime','$prezime','$korime','$datum','$email','$lozinka','$kriptiranaLozinka',1,0,3)";
            $rez = $veza->selectDB($sql); 
			$veza->zatvoriDB();
		}
                
              $mail_to = $email;
              $email_from = "From: nmuse@foi.hr";
              $email_subject = "Aktivacija korisnika";
              $email_body = "https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x089/index.php?korime=".$korime;
              mail($mail_to, $email_subject, $email_body, $email_from);
                
    }
    
    
        
        
    
    /*    $userfile = $_FILES['cv']['tmp_name'];
      $userfile_name = $_FILES['cv']['name'];
      $userfile_size = $_FILES['cv']['size'];
      $userfile_type = $_FILES['cv']['type'];
      $userfile_error = $_FILES['cv']['error'];
      if ($userfile_error > 0) {
      echo 'Problem: ';
      switch ($userfile_error) {
      case 1: echo 'Veličina veća od ' . ini_get('upload_max_filesize');
      break;
      case 2: echo 'Veličina veća od ' . $_POST["MAX_FILE_SIZE"] . 'B';
      break;
      case 3: echo 'Datoteka djelomično prenesena';
      break;
      case 4: echo 'Datoteka nije prenesena';
      break;
      }
      exit;
      }

      $upfile = '../prijenosDatoteka/' . $userfile_name;

      if (is_uploaded_file($userfile)) {
      if (!move_uploaded_file($userfile, $upfile)) {
      echo 'Problem: nije moguće prenijeti datoteku na odredište';
      exit;
      }
      } else {
      echo 'Problem: mogući napad prijenosom. Datoteka: ' . $userfile_name;
      exit;
      } */
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
        <meta name="viewport" content="width=device-width, initial scale=1.0">
        <link rel="stylesheet" href="../css/main.css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <script type="text/javascript" src="../javascript/nmuse.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <title>Biciklijada</title>
    </head>
    <body onload="kreirajDogadaje2()">
        <header>
            <img src="../multimedija/biciklijada-logo.svg" alt="biciklijada-logo" class="logo">
<?php
include_once '../meni.php';
?>
        </header>
        <div class="kontejner6">
            <form novalidate name="registracija" id="registracija" method="post" action="">
                <div id="greske2"></div>
                <div id="greske3"></div>
                <div id="greske4"></div>
                <div>
                    <label for="ime"><b>Ime: </b></label><br>
                    <input type="text" id="ime" name="ime" placeholder="Unesite ime" size="15" maxlength="15" required="required" autofocus="autofocus"><br>
                    <label for="prezime"><b>Prezime: </b></label><br>
                    <input type="text" id="prezime" name="prezime" placeholder="Unesite prezime" size="35" maxlength="25" required="required"><br>
                    <label for="korime"><b>Korisničko ime: </b></label><br>
                    <input name="korime" id="korime" type="text" placeholder="Unesite korisničko ime" required="required" maxlength="16" size="16" /><br>
                    <!--<label for="cv"><b>CV: </b></label><br>
                    <input name="cv" id="cv" type="file"/><br>-->
                    <label for="datum"><b>Datum rođenja: </b></label><br>
                    <input type="date" id="datum" name="datum" required="required" /><br>
                    <label for="email"><b>Email adresa: </b></label><br>
                    <input name="email" id="email" type="text" placeholder="Unesite email" size="20" maxlength="20" required="required"><br>
                    <label for="lozinka"><b>Lozinka: </b></label><br>
                    <input name="lozinka" id="lozinka" type="password" placeholder="Unesite lozinku" maxlength="8" size="35" required="required"/><br>
                    <label for="ponovljenaLozinka"><b>Ponovi lozinku: </b></label><br>
                    <input name="ponovljenaLozinka" id="ponovljenaLozinka" type="password" placeholder="Ponovite lozinku" maxlength="8" size="35" required="required"/><br>
                    <div class="g-recaptcha" data-sitekey="6LdY2wAVAAAAAINrZqxFCH0n7X92XO_lqZHRvNJl"></div>
                    <input type="submit" name="submit" id="registriraj" value="Registriraj se" />
                </div>
            </form>
        </div>
    </body>