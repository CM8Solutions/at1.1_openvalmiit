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
include("yhteys.php");


echo'<div>';


$etunimi = $_POST[etunimi];
$sukunimi = $_POST[sukunimi];
$sposti = $_POST[sposti];
$tunnus = $_POST[tunnus];
$kielet = implode(',', $_POST['kielet']);
$kokemus_arvio = $_POST[kokemus_arvio];
$kokemus_sanallinen = $_POST[kokemus_sanallinen];
$id = $_POST[id];




    $muokkaus = $db->prepare("UPDATE kayttajat SET etunimi=?, sukunimi=?, sposti=?, tunnus=?, koodikielet=?, koodauskokemus_sanallinen=?, koodauskokemus_arvio=? WHERE id=?");



    if ($_POST[salasana] != "") {
        $muokkaus->bind_param("sssssssii", $etunimi, $sukunimi, $sposti, $tunnus, $salasana, $kielet, $kokemus_sanallinen, $kokemus_arvio, $id);
    } else {
        $muokkaus->bind_param("ssssssii", $etunimi, $sukunimi, $sposti, $tunnus, $kielet, $kokemus_sanallinen, $kokemus_arvio, $id);
    }


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
        echo'<p>Viestiä ei pystytty lähettämään osoitteeseen' . $sposti;
        print_r(error_get_last());
    }

$muokkaus->close();
echo' <p><a href="kayttajat.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
echo'</div>';

include('footer.php');

echo '</body>
</html>';
