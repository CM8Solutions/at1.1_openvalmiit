<?php

ob_start();

session_start();

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo'<!DOCTYPE html>

<html>
    <head>
        <title>Poistu järjestelmästä</title>';
include("ylatunniste.php");
include("tietokantayhteys.php");



echo'<div>';

if ($_POST[valinta] == "en") {

    header("location: omat_tiedot.php");
} else if ($_POST[valinta] == "kylla") {



    $poisto = $yhteys->prepare("DELETE FROM kayttajat WHERE id=?");

    if (!$poisto) {
        die('<p>Tietokantapoistossa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
    }



    $poisto->bind_param("i", $id);

    $id = $_SESSION[id];


    if (!$poisto->execute()) {
        die('<p>Tietokantapoistossa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($poisto->error) . '</p>');
    }



    echo'<h3>Olet poistunut järjestelmästä! </h3>';

    $tunnisteet .= "Organization: AT1.1 Internet ja verkkosivut\r\n";
    $tunnisteet .= "MIME-Version: 1.0" . "\r\n";
    $tunnisteet .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $tunnisteet .= "From: AT1.1 Internet ja verkkosivut <no-reply@syksy2020.tylykoodaa.fi>" . "\r\n";
    $tunnisteet .= "X-Priority: 3\r\n";
    $tunnisteet .= "X-Mailer: PHP" . phpversion() . "\r\n";

    $otsikko = "Tietosi on poistettu sivustolta syksy2020.tylykoodaa.fi/ope";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


    $viesti = 'Tietosi on poistettu kurssin AT1.1 Internet ja verkkosivut tietokannasta.<br><br><em>Tähän viestiin ei voi vastata.</em>';
    $viesti = str_replace("\n.", "\n..", $viesti);

    $sposti = $_POST[sposti];

    $lahetys = mail($sposti, $otsikko, $viesti, $tunnisteet);

    if ($lahetys) {
        echo'<p style="font-weight: bold">Viesti tietojen poistamisesta on lähetetty sähköpostiosoitteeseesi!</p>';
    } else {
        echo'<p style="font-weight: bold">Viestiä ei pystytty lähettämään osoitteeseen ' . $sposti;
        echo'<br><br>';
        print_r(error_get_last());
    }


    $poisto->close();


    session_destroy();
    echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
}



echo'</div>';

include('alatunniste.php');

echo '</body>
</html>';
