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
        <title>Tietojen tallennus</title>';
include("header.php");
include("tietokantayhteys.php");


echo'    <body>';


echo'<div>';

if (empty($_POST[etunimi]) || empty($_POST[sukunimi]) || empty($_POST[sposti]) || empty($_POST[tunnus]) || empty($_POST[salasana]) || empty($_POST[salasana2]) || empty($_POST[kokemus_sanallinen]) || empty($_POST[kokemus_arvio])) {
    echo'<p>Et täyttänyt kaikkia kenttiä!</p>';

    echo' <p><a href="rekisteroityminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
} else {


    //katsotaan löytyykö tunnus, binary sen takia, että otetaan huomioon isot ja pienet kirjaimet

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



    if ($haku->num_rows != 0) {
        echo'<p>Tunnus on jo rekisteröity järjestelmään!</p>';

        echo' <p><a href="rekisteroityminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
        $haku->close();
    } else {
        $haku->close();
        if ($_POST[salasana] != $_POST[salasana2]) {

            echo'<p>Antamasi salasanat eivät vastaa toisiaan!</p>';

            echo' <p><a href="rekisteroityminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
        } else {

            $suola = "atsjm2020";


            $krypattu_salasana = md5($suola . $_POST[salasana]);


            $etunimi = $_POST[etunimi];
            $sukunimi = $_POST[sukunimi];
            $sposti = $_POST[sposti];
            $tunnus = $_POST[tunnus];
            $salasana = $krypattu_salasana;
            $kokemus_sanallinen = $_POST[kokemus_sanallinen];
            $kielet = implode(', ', $_POST[kielet]);
            $kokemus_arvio = $_POST[kokemus_arvio];

            if ($kokemus_arvio == "valitse") {
                echo'<p>Et antanut arviota siitä, kuinka kokenut koodari olet!</p>';


                echo' <p><a href="rekisteroityminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
            } else {

                $lisays = $yhteys->prepare("INSERT INTO kayttajat (etunimi, sukunimi, sposti, tunnus, salasana, koodikielet, koodauskokemus_sanallinen, koodauskokemus_arvio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                if (!$lisays) {
                    die('<p>Tietokantalisäyksessä virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
                }

                $lisays->bind_param("sssssssi", $etunimi, $sukunimi, $sposti, $tunnus, $salasana, $kielet, $kokemus_sanallinen, $kokemus_arvio);



                if (!$lisays->execute()) {
                    echo'<p>Tietokantalisäyksessä virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($lisays->error) . '</p>';
                    echo' <p><a href="rekisteroityminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';

                    $lisays->close();
                } else {

                    $tunnisteet .= "Organization: AT1.1 Internet ja verkkosivut\r\n";
                    $tunnisteet .= "MIME-Version: 1.0" . "\r\n";
                    $tunnisteet .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $tunnisteet .= "From: AT1.1 Internet ja verkkosivut <no-reply@syksy2020.tylykoodaa.fi>" . "\r\n";
                    $tunnisteet .= "X-Priority: 3\r\n";
                    $tunnisteet .= "X-Mailer: PHP" . phpversion() . "\r\n";


                    $otsikko = "Rekisteröinnin vahvistustiedot sivustolta syksy2020.tylykoodaa.fi/ope";
                    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


                    $viesti = 'Tietosi on tallennettu kurssin AT1.1 Internet ja verkkosivut tietokantaan.<br><br><em>Tähän viestiin ei voi vastata.</em>';
                    $viesti = str_replace("\n.", "\n..", $viesti);

                    $lahetys = mail($sposti, $otsikko, $viesti, $tunnisteet);

                    if ($lahetys) {
                        $onnistui = 1;
                    } else {
                        $onnistui = 0;
                  
                    }

                    $lisays->close();

                    header("location: tiedot_tallennettu.php?viesti=".$onnistui);
                }
            }
        }
    }
}




echo'</div>';

include('footer.php');

echo '</body>
</html>';
