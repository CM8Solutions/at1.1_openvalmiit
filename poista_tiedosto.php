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
        <title>Käyttäjän poisto</title>';
include("ylatunniste.php");
include("tietokantayhteys.php");



echo'<div>';

if ($_POST[valinta] == "en") {

    header("location: tiedostot.php");
} else if ($_POST[valinta] == "kylla") {

    $haku = $yhteys->prepare("SELECT id, kohde, nimi FROM tiedostot WHERE id=?");

    if (!$haku) {
        die('<p>Tietokantahaussa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
    }

    $haku->bind_param("i", $id);


    $id = $_POST[id];



    if (!$haku->execute()) {
        die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku->error) . '</p>');
    }

    $haku->store_result();
    $haku->bind_result($tulos1, $tulos2, $tulos3);

    while ($haku->fetch()) {
        $id = $tulos1;
        $kohde = $tulos2;
        $nimi = $tulos3;
    }


    if (file_exists($kohde)) {
        unlink($kohde);
        $poisto = $yhteys->prepare("DELETE FROM tiedostot WHERE id=?");

        if (!$poisto) {
            die('<p>Tietokantapoistossa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
        }



        $poisto->bind_param("i", $id);

        $id = $_POST[id];


        if (!$poisto->execute()) {
            die('<p>Tietokantapoistossa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($poisto->error) . '</p>');
        }
        $haku->close();
        $poisto->close();


        echo'<h3>Tiedoston poisto onnistui! </h3>';
    } else {
        echo'<h3>Tiedoston poisto epäonnistui!</h3> 
           <br><b>Tiedostoa ei löytynyt</b>';
    }






    echo' <p><a href="tiedostot.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
}



echo'</div>';

include('alatunniste.php');

echo '</body>
</html>';
