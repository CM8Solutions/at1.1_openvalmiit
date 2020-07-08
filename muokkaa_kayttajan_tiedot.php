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
$id  = $_POST[id];


//HHUOM JOS TYHJÄ, NIIN EI MUUTETA, PITÄÄ TSEKATA!

if($_POST[salasana]!=""){
    
    $suola = "atsjm2020";
$krypattu_salasana = md5($suola . $_POST[salasana]);
$salasana = $krypattu_salasana;

$muokkaus = $db->prepare("UPDATE kayttajat SET etunimi=?,  sukunimi=?,  sposti=?, tunnus=?, salasana=?, koodikielet=?, koodauskokemus_sanallinen=?, koodauskokemus_arvio=? WHERE id=?");

}
else{

$muokkaus = $db->prepare("UPDATE kayttajat SET etunimi=?, sukunimi=?, sposti=?, tunnus=?, koodikielet=?, koodauskokemus_sanallinen=?, koodauskokemus_arvio=? WHERE id=?");
    

}

if (false === $muokkaus) {

    die('<p>Tallennus (prepare) epäonnistui. <br>Syy: ' . htmlspecialchars($db->error) . '</p>');
} else {
    if($_POST[salasana]!=""){
           $bp = $muokkaus->bind_param("sssssssii", $etunimi, $sukunimi, $sposti, $tunnus, $salasana, $kielet, $kokemus_sanallinen, $kokemus_arvio, $id);
 
    }
    else{
           $bp = $muokkaus->bind_param("ssssssii", $etunimi, $sukunimi, $sposti, $tunnus, $kielet, $kokemus_sanallinen, $kokemus_arvio, $id);
 
    }
    

    if (false === $bp) {
        die('<p>Tallennus (bind_param()) epäonnistui. <br>Syy: ' . htmlspecialchars($stmt->error) . '</p>');
    } else {
        $tallennus = $muokkaus->execute();

   
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


            $otsikko = "Tietojasi on muutettu sivustolla syksy2020.tylykoodaa.fi/ope";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


            $viesti = 'Tiedoksesi, että tietojasi AT1.1 Internet ja verkkosivut tietokannassa on muutettu.<br><br><em>Tähän viestiin ei voi vastata.</em>';
            $viesti = str_replace("\n.", "\n..", $viesti);


            $lahetys = mail($sposti, $otsikko, $viesti, $headers);

            if ($lahetys) {
                echo'<p> Viesti lähetetty!</p>';
            } else {
                echo'<p>Viestiä ei pystytty lähettämään!' . $sposti;
                print_r(error_get_last());
            }
        }
    }
}

$muokkaus->close();
           echo' <p><a href="kayttajat.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
echo'</div>';

include('footer.php');

echo '</body>
</html>';
