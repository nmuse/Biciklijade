<?php
include "./baza.class.php";
if (isset($_POST['posaljiEmail'])) {
    $postavljen_mail = "";
    
    if (isset($_POST['emailZaboravljeni'])) {
        $postavljen_mail = true;

        $email = $_POST['emailZaboravljeni'];
        $veza = new Baza();
        $veza->spojiDB();
        $sql2 = "SELECT email FROM korisnik WHERE email = '$email'";
        $rez = $veza->selectDB($sql2);
        $naden = "";
        
        
        $eMail1 = "";
        while ($red = mysqli_fetch_array($rez)) {
            $eMail1 = $red['email'];
        }

        if (empty($eMail1)) {
            $naden = false;
        } else {
            $naden = true;

            $nova = bin2hex(random_bytes(5));

              $salt = sha1(time());
              $kriptirano = sha1($salt.$nova);

              
              $mail_to = $eMail1;
              $email_from = "From: nmuse@foi.hr";
              $email_subject = "Zaboravljena lozinka";
              $email_body = "Zaboravili ste lozinku? Nema frke, stize nova: " . $nova;
              mail($mail_to, $email_subject, $email_body, $email_from);

              $kriptiranaLozinka=sha1($nova."fcbgthjui");
              
            $upit2 = "UPDATE korisnik SET lozinka = '$nova', lozinka_sha1 = '$kriptiranaLozinka' WHERE email = '$eMail1'";
            $rezultat2 = $veza->selectDB($upit2);
        }
        $veza->zatvoriDB();
    } else {
        $postavljen_mail = false;
    }
}


?>

<form novalidate name="zaboravljena" id="zaboravljena" method="post" action="" >
    <label for="emailZaboravljeni">Email</label>
    <input type="text" name="emailZaboravljeni" id="emailZaboravljeni" placeholder="Unesite email" required >
    <input id="posaljiEmail" name="posaljiEmail" type="submit" value="PoslanMail">
</form>

