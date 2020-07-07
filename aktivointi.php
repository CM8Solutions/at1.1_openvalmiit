<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo'<!DOCTYPE html>

<html>
    <head>
        <title>Tunnuksen uudelleen aktivointi</title>';
include("header.php");
include("yhteys.php");


echo'    <body>
  
         <header>
        <h1>Tunnuksen uudelleen aktivointi </h1>
        
    </header>';

echo'<div>';

//katsotaan löytyykö tunnus, binary sen takia, että otetaan huomioon isot ja pienet kirjaimet

$haku = $db->prepare("SELECT tunnus FROM kayttajat WHERE BINARY sposti=?");
$haku->bind_param("s", $sposti);

$sposti = $_POST[sposti];

$haku->execute();

$haku->store_result();
$haku->bind_result($tulos1);


if ($haku->num_rows == 0) {
    echo'<p>Sähköpostiosoitetta ei ole rekisteröity järjestelmään!</p>';

    echo' <p><a href="unohtunut_tunnus.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
    $haku->close();
} else {
    while ($haku->fetch()) {
        $tunnus = $tulos1;
    }
    $haku->close();


    $headers .= "Organization: AT1.1 Internet ja verkkosivut\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: AT1.1 Internet ja verkkosivut <no-reply@syksy2020.tylykoodaa.fi>" . "\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";


    $otsikko = "Viesti sivustolta syksy2020.tylykoodaa.fi/ope";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


    $viesti = 'Tunnuksesi sivustolla syksy2020.tylykoodaa.fi on ' . $tunnus . '.<br><br>Voit aktivoida tunnuksen uudelleen tästä linkistä <a href="salasanan_vaihto.php"> tästä linkistä</a>.<br><br><em>Tähän viestiin ei voi vastata.</em>';
    $viesti = str_replace("\n.", "\n..", $viesti);


    $lahetys = mail($_POST[sposti], $otsikko, $viesti, $headers);

    if ($lahetys) {
        echo'<p>Linkki tunnuksen uudelleen aktivointiin on lähetetty antamaasi sähköpostiosoitteeseen!</p>';

        echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
    } else {
        echo'<p>Viestiä ei pystytty lähettämään!' . $siivottu_sposti;


        echo' <p><a href="unohtunut_tunnus.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
    }
}







echo'</div>';

include('footer.php');

echo '</body>
</html>';
