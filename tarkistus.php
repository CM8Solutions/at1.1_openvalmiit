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

//generoidaan salasana
$suola = "atsjm2020";


$krypattu_salasana = md5($suola . $_POST[salasana]);

$haku = $db->query("select * from kayttajat where tunnus = '" . $_POST[tunnus] . "'");

if (!$haku) {
    echo'<p>Tietokantahaussa virhe.</p>';
    echo'<p>Syy: ' . $db->error . '</p>';
    die();
} else {

    if ($haku->num_rows == 0) {
        echo'<p>Käyttäjätunnusta ei löydy!</p>';

        echo' <p><a href="kirjautuminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
    } else {


        while ($rivi = $haku->fetch_assoc()) {
            $tunnus = $rivi[tunnus];
            $salasana = $rivi[salasana];
        }


        $haku2 = $db->query("select * from kayttajat where tunnus = '" . $tunnus . "' AND  salasana='" . $krypattu_salasana . "'");
        if (!$haku2) {
            echo'<p>Tietokantahaussa virhe.</p>';
            echo'<p>Syy: ' . $db->error . '</p>';
            die();
        } else {
            if ($haku2->num_rows == 0) {

                echo'<p>Antamasi salasana on väärin!</p>';

                echo' <p><a href="kirjautuminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
            } else {

                echo'Kirjautuminen onnistui!';
             
                $_SESSION[tunnus] = $tunnus;   
                echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
            }
        }
    }
}




echo'</div>';

include('footer.php');

echo '</body>
</html>';
