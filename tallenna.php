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


echo'    <body>
  
         <header>
        <h1>Tietojen tallennus tietokantaan. </h1>
        
    </header>';

echo'<div>';


if (empty($_POST[etunimi]) || empty($_POST[sukunimi]) || empty($_POST[sposti]) || empty($_POST[tunnus]) || empty($_POST[salasana]) || empty($_POST[salasana2]) || empty($_POST[kokemus_sanallinen]) || empty($_POST[kokemus_arvio])) {
    echo'<p>Et täyttänyt kaikkia kenttiä!</p>';

    echo' <p><a href="rekisteroityminen.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
} else {


    //katsotaan löytyykö tunnus, binary sen takia, että otetaan huomioon isot ja pienet kirjaimet

    $haku = $db->prepare("SELECT * FROM kayttajat WHERE BINARY tunnus=?");
    $haku->bind_param("s", $tunnus);

    $tunnus = $_POST[tunnus];

    $haku->execute();

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

                $haku2 = $db->prepare("INSERT INTO kayttajat (etunimi, sukunimi, sposti, tunnus, salasana, koodikielet, koodauskokemus_sanallinen, koodauskokemus_arvio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                $haku2->bind_param("sssssssi", $etunimi, $sukunimi, $sposti, $tunnus, $salasana, $kielet, $kokemus_sanallinen, $kokemus_arvio);


                $haku2->execute();


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




                $haku2->close();


                echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
            }
        }
    }
}






echo'</div>';

include('footer.php');

echo '</body>
</html>';
