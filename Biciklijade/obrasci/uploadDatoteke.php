
<div class="kontejner8">
            <form novalidate name="registracija" id="registracija" method="get" action="">
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
                    <label for="datum"><b>Datum rođenja: </b></label><br>
                    <input type="date" id="datum" name="datum" required="required" /><br>
                    <label for="email"><b>Email adresa: </b></label><br>
                    <input name="email" id="email" type="text" placeholder="Unesite email" size="20" maxlength="20" required="required"><br>
                    <label for="lozinka"><b>Lozinka: </b></label><br>
                    <input name="lozinka" id="lozinka" type="password" placeholder="Unesite lozinku" maxlength="8" size="35" required="required"/><br>
                    <label for="ponovljenaLozinka"><b>Ponovi lozinku: </b></label><br>
                    <input name="ponovljenaLozinka" id="ponovljenaLozinka" type="password" placeholder="Ponovite lozinku" maxlength="8" size="35" required="required"/><br>
                    <input type="submit" name="submit" id="registriraj" value="Registriraj se" />
                </div>
            </form>
        </div>
