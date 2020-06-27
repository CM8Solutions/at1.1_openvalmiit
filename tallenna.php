<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo'<!DOCTYPE html>

<html>
    <head>
        <title>Tietojen tallennus</title>';
include("header.php");
include("yhteys.php");
echo'</head>
  
    <body>
  
         <header>
        <h1>Tietojen tallennus tietokantaan. </h1>
        
    </header>';

echo'<div>';

//generoidaan salasana
$suola = "atsjm2020";
$paivays = "" . date("h:i:s") . "";
$krypattu_salasana = md5($suola . $paivays);


$etunimi = $_POST[etunimi];
$sukunimi = $_POST[etunimi];
$sposti = $_POST[sposti];
$tunnus = $_POST[tunnus];
$salasana = $krypattu_salasana;
$kielet = implode(',', $_POST['kielet']);
$kokemus_sanallinen = nl2br($_POST[kuvaus]);
$kokemus_arvio = $_POST[arvio];


$stmt = $db->prepare("INSERT INTO kayttajat (etunimi, sukunimi, sposti, tunnus, salasana, koodikielet, koodauskokemus_sanallinen, koodauskokemus_arvio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");


if (false === $stmt) {

    die('<p>Tallennus (prepare) epäonnistui. <br>Syy: ' . htmlspecialchars($db->error) . '</p>');
} else {
    $bp = $stmt->bind_param("sssssssi", $etunimi, $sukunimi, $sposti, $tunnus, $salasana, $kielet, $kokemus_sanallinen, $kokemus_arvio);

    if (false === $bp) {
        die('<p>Tallennus (bind_param()) epäonnistui. <br>Syy: ' . htmlspecialchars($stmt->error) . '</p>');
    } else {
        $tallennus = $stmt->execute();

        if (false === $tallennus) {
            die('<p>Tallennus (execute()) epäonnistui. <br>Syy: ' . htmlspecialchars($stmt->error) . '</p>');
        } else {
            echo'<p>Tiedot tallennettu onnistuneesti!</p>';

            $headers .= "Organization: AT1.1 Internet ja verkkosivut\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: AT1.1 Internet ja verkkosivut <no-reply@syksy2020.tylykoodaa.fi>" . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";


            $otsikko = "Rekisteröinnin vahvistustiedot sivustolta syksy2020.tylykoodaa.fi/ope";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


            $viesti = 'Tietosi on tallennettu kurssin AT1.1 Internet ja verkkosivut tietokantaan.<br><br><em>Tähän viestiin ei voi vastata.</em>';
            $viesti = str_replace("\n.", "\n..", $viesti);


            $siivottu_sposti = mysqli_real_escape_string($db, $sposti);
            $lahetys = mail($siivottu_sposti, $otsikko, $viesti, $headers);

            if ($lahetys) {
                echo'<p> Viesti lähetetty!</p>';
            } else {
                echo'<p>Viestiä ei pystytty lähettämään!' . $siivottu_sposti;
                print_r(error_get_last());
            }
        }
    }
}

$stmt->close();
           echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
echo'</div>';

include('footer.php');

echo '</body>
</html>';
