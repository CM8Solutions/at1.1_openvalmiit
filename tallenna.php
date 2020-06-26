<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */





$siivottusposti = mysqli_real_escape_string($db, $_POST[Sposti]);
$siivottuetunimi = mysqli_real_escape_string($db, $_POST[Etunimi]);
$siivottusukunimi = mysqli_real_escape_string($db, $_POST[Sukunimi]);
// $siivottusalasana=mysqli_real_escape_string($db, $_POST[Salasana]);
// $siivottuuusisalasana=mysqli_real_escape_string($db, $_POST[UusiSalasana]);

$etunimi100 = $siivottuetunimi;
$sukunimi100 = $siivottusukunimi;
$sposti100 = $siivottusposti;
$rooli100 = $_POST[Rooli];


if (!$result100 = $db->query("select distinct * from koulut where id='" . $_POST[koulu] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
while ($row100 = $result100->fetch_assoc()) {
    $koulu100 = $row100[Nimi];
}


    //generoidaan salasana
    $salt = "CR85ms";
    $paivays = "" . date("h:i:s") . "";
    $krypattu = md5($salt . $paivays);

    //generoidaan tarkistuskoodi
    $salt2 = "CR74eve";
    $paivays = "" . date("h:i:s") . "";
    $krypattu2 = md5($salt2 . $paivays);


    $stmt = $db->prepare("INSERT INTO kayttajat (etunimi, sukunimi, kokonimi, salasana, rooli, sposti, vahvistettu, tarkistettu, tarkistuskoodi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiis", $etunimi, $sukunimi, $kokonimi, $salasana, $rooli, $sposti, $vahvistettu, $tarkistettu, $koodi);
    $etunimi = $siivottuetunimi;
    $sukunimi = $siivottusukunimi;
    $kokonimi = $siivottuetunimi . ' ' . $siivottusukunimi;
    $salasana = $krypattu;
    $rooli = $_POST[Rooli];
    $sposti = $siivottusposti;
    $vahvistettu = 0;
    $tarkistettu = 1;
    $koodi = $krypattu2;
    $stmt->execute();
    $stmt->close();


    $stmt2 = $db->prepare("SELECT DISTINCT id FROM kayttajat WHERE BINARY sposti=?");
    $stmt2->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

    $stmt2->execute();

    $stmt2->store_result();

    $stmt2->bind_result($column1);


    while ($stmt2->fetch()) {
        $id = $column1;
    }

    $db->query("insert into kayttajankoulut  (kayttaja_id, koulu_id, odottaa) values('" . $id . "', '" . $_POST[koulu] . "', 1)");
    $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";


    $otsikko = "Rekisteröinnin vahvistustiedot Cuulis-oppimisympäristöstä";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";





    $viesti = 'Olet rekisteröitynyt Cuulis-oppimisympäristöön seuraavilla tiedoilla:<br><br>Etunimi: ' . $etunimi100 . '<br>Sukunimi: ' . $sukunimi100 . '<br>Ensisijainen oppilaitos: ' . $koulu100 . '<br>Rooli: ' . $rooli100 . '<br><br><em>Tähän viestiin ei voi vastata.</em>';
    $viesti = str_replace("\n.", "\n..", $viesti);



    $varmistus = mail($siivottusposti, $otsikko, $viesti, $headers);

    if (!$tulos2 = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
    }

    while ($row2 = $tulos2->fetch_assoc()) {
        $sposti2 = $row2["sposti"];
    }

    $otsikko2 = "Uusi käyttäjä rekisteröitynyt Cuulis-oppimisympäristöön";
    $otsikko2 = "=?UTF-8?B?" . base64_encode($otsikko2) . "?=";
    $kysely2 = 'Cuulis-oppimisympäristöön on rekisteröitynyt uusi käyttäjä roolissa Opiskelija. Käyttäjän sähköpostiosoite: ' . $siivottusposti . '.';
//    $viesti2 = mail($sposti2, $otsikko2, $kysely2, $headers);







    $stmt2->close();