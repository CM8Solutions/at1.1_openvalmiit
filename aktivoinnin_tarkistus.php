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
        <title>Tunnuksen uudelleen aktivoinnin tarkistus</title>';
include("header.php");
include("yhteys.php");


echo'    <body>
  

<div>';

if (empty($_POST[tunnus]) || empty($_POST[salasana]) || empty($_POST[salasana2])) {
    echo'<p>Et täyttänyt kaikkia kenttiä!</p>';

    echo' <p><a href="salasanan_vaihto.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
} else {

    $haku = $db->prepare("SELECT * FROM kayttajat WHERE BINARY tunnus=?");
    $haku->bind_param("s", $tunnus);

    $tunnus = $_POST[tunnus];

    $haku->execute();

    $haku->store_result();


    if ($haku->num_rows == 0) {
        echo'<p>Käyttäjätunnusta ei löydy!</p>';

        echo' <p><a href="salasanan_vaihto.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
        $haku->close();
    } else {

        $haku->close();
        if ($_POST[salasana] != $_POST[salasana2]) {

            echo'<p>Antamasi salasanat eivät vastaa toisiaan!</p>';

            echo' <p><a href="salasanan_vaihto.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
        } else {

            // UPDATE

            $suola = "atsjm2020";


            $krypattu_salasana = md5($suola . $_POST[salasana]);

            $muokkaus = $db->prepare("UPDATE kayttajat SET salasana=? WHERE BINARY tunnus=?");

            $muokkaus->bind_param("ss", $salasana, $tunnus);

            $tunnus = $_POST[tunnus];
            $salasana = $krypattu_salasana;

            $tallennus = $muokkaus->execute();

            if (false === $tallennus) {
                die('<p>Tallennus (execute()) epäonnistui. <br>Syy: ' . htmlspecialchars($stmt->error) . '</p>');
            } else {
                echo'<p>Salasanasi on vaihdettu!</p>';
            }

            echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
        }
    }
}


echo'</div>';

include('footer.php');

echo '</body>
</html>';
