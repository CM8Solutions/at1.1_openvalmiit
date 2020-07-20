<?php

ob_start();

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
include("tietokantayhteys.php");


echo'    <body>
  

<div>';

if (empty($_POST[tunnus]) || empty($_POST[salasana]) || empty($_POST[salasana2])) {
    echo'<p>Et täyttänyt kaikkia kenttiä!</p>';

    echo' <p><a href="salasanan_vaihto.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
} else {

    $haku = $yhteys->prepare("SELECT * FROM kayttajat WHERE BINARY tunnus=?");
    if (!$haku) {
        die('<p>Tietokantahaussa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
    }
    $haku->bind_param("s", $tunnus);

    $tunnus = $_POST[tunnus];


    if (!$haku->execute()) {
        die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku->error) . '</p>');
    }


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

            $muokkaus = $yhteys->prepare("UPDATE kayttajat SET salasana=? WHERE BINARY tunnus=?");
            if (!$muokkaus) {
                die('<p>Tietokantamuokkauksessa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
            }

            $muokkaus->bind_param("ss", $salasana, $tunnus);

            $tunnus = $_POST[tunnus];
            $salasana = $krypattu_salasana;


            if (!$muokkaus->execute()) {
                die('<p>Tietokantamuokkauksessa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($muokkaus->error) . '</p>');
            }
            echo'<p>Salasanasi on vaihdettu!</p>';

            $muokkaus->close();
            echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
        }
    }
}


echo'</div>';

include('footer.php');

echo '</body>
</html>';
