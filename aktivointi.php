<?php

ob_start();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo'<!DOCTYPE html>

<html>
    <head>
        <title>Tunnuksen uudelleen aktivointi</title>';
include("ylatunniste.php");
include("tietokantayhteys.php");


echo'    <body>';

echo'<div>';

echo'<h2>Tunnuksen uudelleen aktivointi </h2>';

//katsotaan löytyykö tunnus, binary sen takia, että otetaan huomioon isot ja pienet kirjaimet

if (empty($_POST[sposti])) {
    echo'<p>Et täyttänyt kaikkia kenttiä!</p>';

    echo' <p><a href="unohtunut_tunnus.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
} else {
    $haku = $yhteys->prepare("SELECT tunnus FROM kayttajat WHERE BINARY sposti=?");

    if (!$haku) {
        die('<p>Tietokantahaussa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
    }

    $haku->bind_param("s", $sposti);

    $sposti = $_POST[sposti];


    if (!$haku->execute()) {
        die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku->error) . '</p>');
    }



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


        $tunnisteet .= "Organization: AT1.1 Internet ja verkkosivut\r\n";
        $tunnisteet .= "MIME-Version: 1.0" . "\r\n";
        $tunnisteet .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $tunnisteet .= "From: AT1.1 Internet ja verkkosivut <no-reply@syksy2020.tylykoodaa.fi>" . "\r\n";
        $tunnisteet .= "X-Priority: 3\r\n";
        $tunnisteet .= "X-Mailer: PHP" . phpversion() . "\r\n";


        $otsikko = "Viesti sivustolta syksy2020.tylykoodaa.fi/ope";
        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


        $viesti = 'Tunnuksesi sivustolla https://syksy2020.tylykoodaa.fi/ope_valmiit on ' . $tunnus . '.<br><br>Voit aktivoida tunnuksen uudelleen tästä linkistä <a href="https://syksy2020.tylykoodaa.fi/ope_valmiit/salasanan_vaihto.php"> tästä linkistä</a>.<br><br><em>Tähän viestiin ei voi vastata.</em>';
        $viesti = str_replace("\n.", "\n..", $viesti);

        $sposti = $_POST[sposti];
        $lahetys = mail($sposti, $otsikko, $viesti, $tunnisteet);

        if ($lahetys) {
            echo'<p>Linkki tunnuksen uudelleen aktivointiin on lähetetty antamaasi sähköpostiosoitteeseen!</p>';

            echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
        } else {
            echo'<h3>Viestiä ei pystytty lähettämään osoitteeseen ' . $sposti . '</h3>';
            echo'<br><br>';
            print_r(error_get_last());
            echo' <p><a href="unohtunut_tunnus.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
        }
    }
}

echo'</div>';

include('alatunniste.php');

echo '</body>
</html>';
