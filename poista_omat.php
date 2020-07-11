<?php

session_start();
ob_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo'<!DOCTYPE html>

<html>
    <head>
        <title>Poistu järjestelmästä</title>';
include("header.php");
include("yhteys.php");



echo'<div>';

if ($_POST[valinta] == "en") {

    header("location: omat_tiedot.php");
} else if ($_POST[valinta] == "kylla") {



    $poisto = $db->prepare("DELETE FROM kayttajat WHERE id=?");

    if (!$poisto) {
        die('<p>Tietokantapoistossa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($db->error) . '</p>');
    }



    $poisto->bind_param("i", $id);

    $id = $_SESSION[id];


    if (!$poisto->execute()) {
        die('<p>Tietokantapoistossa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($poisto->error) . '</p>');
    }



    echo'<p>Olet poistunut järjestelmästä! </p>';

    $headers .= "Organization: AT1.1 Internet ja verkkosivut\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: AT1.1 Internet ja verkkosivut <no-reply@syksy2020.tylykoodaa.fi>" . "\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

    $otsikko = "Tietosi on poistettu sivustolta syksy2020.tylykoodaa.fi/ope";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


    $viesti = 'Tietosi on poistettu kurssin AT1.1 Internet ja verkkosivut tietokannasta.<br><br><em>Tähän viestiin ei voi vastata.</em>';
    $viesti = str_replace("\n.", "\n..", $viesti);

    $sposti = $_POST[sposti];

    $lahetys = mail($sposti, $otsikko, $viesti, $headers);

    if ($lahetys) {
        echo'<p> Viesti lähetetty!</p>';
    } else {
        echo'<p>Viestiä ei pystytty lähettämään osoitteeseen ' . $sposti;
        echo'<br><br>';
        print_r(error_get_last());
    }


    $poisto->close();


    session_destroy();
    echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
}



echo'</div>';

include('footer.php');

echo '</body>
</html>';
