/*function Kolacici() {
 if (document.cookie.indexOf('uvjet') === -1) {
 if (confirm('Pritiskom na ok prihvaćate uvjete!')) {
 $.ajax({
 url: 'http://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x089/prihvacanjeUvjeta.php',
 type: 'GET'
 })
 }
 }
 }
 */
function kreirajDogadaje() {

    //Kolacici();
    console.log("prijava")

    formular = document.getElementById("prijava");

    greske = document.getElementById("greske");

    formular.addEventListener("submit", function (event) {
        korime = document.getElementById("korime").value;
        console.log(korime);
        greske.innerHTML = "";

        for (i = 0; i < formular.length; i++) {
            if (formular[i].value === '') {
                formular[i].style = "border-color:red";
                greske.innerHTML += "Nije popunjeno :" + formular[i].name + "<br>";
            } else {
                formular[i].style = "border-color:none";
            }

            //ako ima gresaka,ako nesto nije uneseno
        }
        if (greske.innerHTML.length !== 0) {
            event.preventDefault();
        }

    }, false)

    $('#korime').on('blur', function () {
        korime = document.getElementById("korime");
        var provjera = /^[a-z0-9_-]{3,16}$/igm;
        if (!provjera.test(korime.value) && korime.value !== "") {
            greske.innerHTML += "Korisnicko ime nije valjano!" + "<br>";
            korime.style = "border-color:red";
        } else {
            korime.style = "border-color:none";
        }
    });

    $('#lozinka').on('blur', function () {
        lozinka = document.getElementById("lozinka");
        var provjera = /^(?=.*\d).{4,10}$/;
        if (!provjera.test(lozinka.value) && lozinka.value !== "") {
            greske.innerHTML += "Lozinka nije valjana!" + "<br>";
            lozinka.style = "border-color:red";
        } else {
            lozinka.style = "border-color:none";
        }
    });


}


function kreirajDogadaje2() {
    //Kolacici();
    console.log("registracija")
    greske2 = document.getElementById("greske2");

    $('#korime').on('blur', function () {
        var korime = $('#korime').val();

        $.ajax({
            url: 'http://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x089/obrasci/provjeraKorime.php',
            type: 'post',
            data: {
                'korisnik': korime
            },

            success: function (response) {

                var r = JSON.parse(response);

                console.log(r.korisnik);

                if (r.korisnik != 0) {
                    console.log("zauzeto korisničko ime");
                    greske2.innerHTML += "Korisničko ime je zauzeto!" + "<br>";
                    $('#korime').attr('style', 'border-color:red');

                } else if (r.korisnik == 0) {
                    console.log("Slobodno korisničko ime");
                    $('#korime').attr('style', 'border-color:none');
                    ;
                }
            }
        });
    });


    $('#ime').on('blur', function () {
        ime = document.getElementById("ime");
        var provjera = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/g;
        if (!provjera.test(ime.value) && ime.value !== "") {
            greske2.innerHTML += "Ime nije valjano!" + "<br>";
            ime.style = "border-color:red";
        } else {
            ime.style = "border-color:none";
        }
    });

    $('#prezime').on('blur', function () {
        prezime = document.getElementById("prezime");
        var provjera = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/g;
        if (!provjera.test(prezime.value) && prezime.value !== "") {
            greske2.innerHTML += "Prezime nije valjano!" + "<br>";
            prezime.style = "border-color:red";
        } else {
            prezime.style = "border-color:none";
        }
    });

    $('#email').on('blur', function () {
        email = document.getElementById("email");
        var provjera = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
        if (!provjera.test(email.value) && email.value !== "") {
            greske2.innerHTML += "Email nije valjan!" + "<br>";
            email.style = "border-color:red";
        } else {
            email.style = "border-color:none";
        }
    });



    //Alphanumeric string that may include _ and – having a length of 3 to 16 characters

    $('#korime').on('blur', function () {
        korime = document.getElementById("korime");
        var provjera = /^[a-z0-9_-]{3,16}$/igm;
        if (!provjera.test(korime.value) && korime.value !== "") {
            greske2.innerHTML += "Korisnicko ime nije valjano!" + "<br>";
            korime.style = "border-color:red";
        } else {
            korime.style = "border-color:none";
        }
    });



    $('#datum').on('blur', function () {
        datum = document.getElementById("datum");
        cijeliUnos = datum.value.split("-");
        godina = cijeliUnos[0];
        //console.log(godina);
        if (datum.value !== "" && (godina < 1940 || godina > 2008)) {
            greske2.innerHTML += "Godina mora biti između 1940. i 2008. " + "<br>";
            datum.style = "border-color:red";
        } else if (datum.value !== "" && (godina >= 1940 && godina <= 2008)) {
            datum.style = "border-color:none";
        }
    });
    //Password must be at least 4 characters,
    // no more than 8 characters, and must include at least 
    // one upper case letter, one lower case letter, and one numeric digit.

    $('#lozinka').on('blur', function () {
        lozinka = document.getElementById("lozinka");
        var provjera = /^(?=.*\d).{4,10}$/;
        if (!provjera.test(lozinka.value) && lozinka.value !== "") {
            greske2.innerHTML += "Lozinka nije valjana!" + "<br>";
            lozinka.style = "border-color:red";
        } else {
            lozinka.style = "border-color:none";
        }
    });


    $('#lozinka').on('blur', function () {
        lozinka = document.getElementById("lozinka");
        ponovljenaLozinka = document.getElementById("ponovljenaLozinka");
        if (lozinka.value !== ponovljenaLozinka.value) {
            greske2.innerHTML += "Unesene lozinke moraju biti jednake!" + "<br>";
            ponovljenaLozinka.style = "border-color:red";
        } else {
            ponovljenaLozinka.style = "border-color:none";
            ;
        }
    });

    formular = document.getElementById("registracija");

    formular.addEventListener("submit", function (event) {
        var captchResponse = $('#g-recaptcha-response').val();
        var dobro = true;
        if (captchResponse.length === 0) {
            dobro = false;
        } else {
            dobro = true;
        }
        if (!dobro) {
            event.preventDefault();
        }
    }, false);

}
function kreirajDogadaje3() {

    $.ajax({
        url: 'http://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x089/dohvatiKorisnika.php',
        type: 'get',

        success: function (response) {

            var t = JSON.parse(response);
            console.log(this);

            $(t).each(function () {

                red = "<tr>";
                red += "<td>" + this.ime + "</td>";
                red += "<td>" + this.prezime + "</td>";
                red += "<td>" + this.korime + "</td>";
                red += "<td>" + this.email + "</td>";
                red += "<td>" + this.lozinka + "</td>";
                red += "</tr>";
                
                $("#tbody").append(red);
            })
            
            
            $('#tbody17').dataTable();
        }
    });

}

function kreirajDogadaje4() {

    $.ajax({
        url: 'dohvatiLokacije.php',

        success: function (data) {
            
            var podaciLokacija = '';
            var jdata = $.parseJSON(data);
            
           

            $.each(jdata, function (key, value) {
                
                podaciLokacija += '<tr>';
                podaciLokacija += '<td>' + this.lokacija + '</td>';
                podaciLokacija += '<td>' + this.utrka + '</td>';
                podaciLokacija += '</tr>';

            });

            $("#lokacije").append(podaciLokacija);
            $('#tablicaLokacija').dataTable();

        }
    });

}

function kreirajDogadaje5() {

    $.ajax({
        url: 'deblokiranjeDohvat.php',
        type: 'get',
        
        success: function (response) {
            console.log("radi");
            var podaci = '';
            var t = JSON.parse(response);
            //var jdata = $.parseJSON(data);
                        
            $(t).each(function() {
                
                if(this.status==1){
                    
                podaci += '<tr>';
                podaci += '<td>' + this.ime + '</td>';
                podaci += '<td>' + this.prezime + '</td>';
                podaci += '<td>' + this.korime + '</td>';
                podaci += '<td>' + this.email + '</td>';
                podaci += '<td>' + this.status + '</td>';
                podaci += "<td><a href='blokirajSkripta.php?korime=" + this.korime + "'>Blokiraj</a></td>";
                podaci += '</tr>';
            }else{
                podaci += '<tr>';
                podaci += '<td>' + this.ime + '</td>';
                podaci += '<td>' + this.prezime + '</td>';
                podaci += '<td>' + this.korime + '</td>';
                podaci += '<td>' + this.email + '</td>';
                podaci += '<td>' + this.status + '</td>';
                podaci += "<td><a href='deblokirajSkripta.php?korime=" + this.korime + "'>Deblokiraj</a></td>";
                podaci += '</tr>';
            }
            });
            $("#tbody15").append(podaci);
            $('#tablica16').dataTable();

        }
    });

}

