<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
echo'<!DOCTYPE html>

<html>
    <head>
        <title>Kirjautumisen tarkistus</title>';
include("header.php");
include("yhteys.php");


echo'    <body>
  

<div>';



$haku = $db->prepare("SELECT tunnus, salasana FROM kayttajat WHERE BINARY tunnus=?");
if (!$haku) {
    die('<p>Tietokantahaussa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($db->error) . '</p>');
}


$haku->bind_param("s", $tunnus);

$tunnus = $_POST[tunnus];

if (!$haku->execute()) {
    die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku->error) . '</p>');
}

$haku->store_result();

$haku->bind_result($tulos1, $tulos2);


if ($haku->num_rows == 0) {
    echo'<p>Käyttäjätunnusta ei löydy!</p>';

    echo' <p><a href="kirjautuminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
} else {

    while ($haku->fetch()) {
        $tunnus = $tulos1;
        $salasana = $tulos2;
    }
    $haku->close();
    $haku2 = $db->prepare("SELECT * FROM kayttajat WHERE BINARY tunnus=? AND BINARY salasana=?");
    if (!$haku2) {
        die('<p>Tietokantahaussa 2 virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($db->error) . '</p>');
    }

    $haku2->bind_param("ss", $tunnus, $salasana);

    $tunnus = $_POST[tunnus];

    $suola = "atsjm2020";


    $krypattu_salasana = md5($suola . $_POST[salasana]);

    $salasana = $krypattu_salasana;

    if (!$haku2->execute()) {
        die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku2->error) . '</p>');
    }
    $haku2->store_result();

    if ($haku2->num_rows == 0) {

        echo'<p>Antamasi salasana on väärin!</p>';

        echo' <p><a href="kirjautuminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
    } else {

        echo'Kirjautuminen onnistui!';

        $_SESSION[tunnus] = $tunnus;
        echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
    }



    $haku2->close();
}














echo'</div>';

include('footer.php');

echo '</body>
</html>';
