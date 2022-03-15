<?php

echo "
        <nav>
            <a href =\"#\" class=\"sakrij-racunalo\">
               <img src=\"multimedija/izbornik.svg\" alt=\"izbornik\" class=\"izbornik\" id=\"izbornik\">
            </a>

            <ul class=\"pokazi-racunalo sakrij-mobitel\" id=\"nav\">
                <li id = \"izadi\" class = \"izadi-botun sakrij-racunalo\"><img src = \"multimedija/izbornik-izlaz.svg\" alt=\"izadi-iz-izbornika\"></li>
                <li><a href=\"$putanja/index.php\">Početna</a></li>
                <li><a href=\"$putanja/obrasci/prijava.php\">Prijava</a></li>
                <li><a href=\"$putanja/lokacije.php\">Lokacije</a></li>
                <li><a href=\"$putanja/privatno/korisnici.php\">Korisnici</a></li>
                <li><a href=\"$putanja/obrasci/registracija.php\">Registracija</a></li>
                <li><a href=\"$putanja/autor.html\">O autoru</a></li>
                <li><a href=\"$putanja/dokumentacija.html\">Dokumentacija</a></li>";
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 4) {
    
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 3) {
    
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] === "1") {
    echo "<li><a href=\"$putanja/obrasci/vrijeme.php\">Virtualno vrijeme</a></li>";
    echo "<li><a href = \"$putanja/konfiguriranjeAdmin.php\">Konfiguracija</a></li>";
    echo "<li><a href=\"$putanja/lokacijaAdmin.php\">Dodavanje lokacija</a></li>";
    echo "<li><a href = \"$putanja/utrkeAdmin.php\">Dodavanje utrka</a></li>";
    echo "<li><a href=\"$putanja/obrasci/ostalo.php\">Ostalo</a></li>";
    echo "<li><a href=\"$putanja/deblokiranjeAdmin.php\">Blokiranje/Deblokiranje</a></li>";
}

echo"
         </ul>
        </nav>
    ";