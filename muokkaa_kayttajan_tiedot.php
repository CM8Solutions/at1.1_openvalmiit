<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo'<!DOCTYPE html>

<html>
    <head>
        <title>Muokkaa käyttäjän tietoja</title>';
include("header.php");
include("tietokantayhteys.php");


echo'<div>';
if (empty($_POST[etunimi]) || empty($_POST[sukunimi]) || empty($_POST[sposti]) || empty($_POST[tunnus]) || empty($_POST[kokemus_sanallinen]) || empty($_POST[kokemus_arvio])) {
    echo'<p>Et täyttänyt kaikkia kenttiä!</p>';

    echo' <p><a href="muokkaa_kayttaja.php?id=' . $_POST[id] . '&muokkaa"> &#8617 &nbsp  Palaa takaisin </a></p>';
} else {

    $etunimi = $_POST[etunimi];
    $sukunimi = $_POST[sukunimi];
    $sposti = $_POST[sposti];
    $tunnus = $_POST[tunnus];
    $kielet = implode(',', $_POST['kielet']);
    $kokemus_arvio = $_POST[kokemus_arvio];
    $kokemus_sanallinen = $_POST[kokemus_sanallinen];
    $id = $_POST[id];

    if ($kokemus_arvio == "valitse") {
        echo'<p>Et antanut arviota siitä, kuinka kokenut koodari käyttäjä on!</p>';


        echo' <p><a href="muokkaa_kayttaja.php?id=' . $_POST[id] . '&muokkaa"> &#8617 &nbsp  Palaa takaisin </a></p>';
        ;
    } else {

        $muokkaus = $yhteys->prepare("UPDATE kayttajat SET etunimi=?, sukunimi=?, sposti=?, tunnus=?, koodikielet=?, koodauskokemus_sanallinen=?, koodauskokemus_arvio=? WHERE id=?");
        if (!$muokkaus) {
            die('<p>Tietokantamuokkauksessa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
        }


        $muokkaus->bind_param("ssssssii", $etunimi, $sukunimi, $sposti, $tunnus, $kielet, $kokemus_sanallinen, $kokemus_arvio, $id);



        if (!$muokkaus->execute()) {
            die('<p>Tietokantamuokkauksessa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($muokkaus->error) . '</p>');
        }

        echo'<p>Tiedot tallennettu onnistuneesti!</p>';

        $headers .= "Organization: AT1.1 Internet ja verkkosivut\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: AT1.1 Internet ja verkkosivut <no-reply@syksy2020.tylykoodaa.fi>" . "\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";


        $otsikko = "Tietojasi on muutettu sivustolla syksy2020.tylykoodaa.fi/ope";
        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


        $viesti = 'Tiedoksesi, että tietojasi AT1.1 Internet ja verkkosivut tietokannassa on muutettu.<br><br><em>Tähän viestiin ei voi vastata.</em>';
        $viesti = str_replace("\n.", "\n..", $viesti);


        $lahetys = mail($sposti, $otsikko, $viesti, $headers);

        if ($lahetys) {
            echo'<p> Viesti lähetetty!</p>';
        } else {
            echo'<p>Viestiä ei pystytty lähettämään osoitteeseen ' . $sposti;
            echo'<br><br>';
            print_r(error_get_last());
        }

        $muokkaus->close();
        echo' <p><a href="kayttajat.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
    }
}

echo'</div>';

include('footer.php');

echo '</body>
</html>';
