<?php

ob_start();

session_start();
include("tietokantayhteys.php");

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Omat tiedot</title>';
include("ylatunniste.php");



echo '<body>';


echo'<div>';
echo'<div class="vali"></div>';



$haku = $yhteys->prepare("SELECT id, etunimi, sukunimi, sposti, tunnus, koodikielet, koodauskokemus_sanallinen, koodauskokemus_arvio FROM kayttajat WHERE id=?");

if (!$haku) {
    die('<p>Tietokantahaussa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
}

$haku->bind_param("i", $id);
$id = $_SESSION[id];


if (!$haku->execute()) {
    die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku->error) . '</p>');
}

$haku->store_result();
$haku->bind_result($tulos1, $tulos2, $tulos3, $tulos4, $tulos5, $tulos6, $tulos7, $tulos8);

while ($haku->fetch()) {
    $id = $tulos1;
    $etunimi = $tulos2;
    $sukunimi = $tulos3;
    $sposti = $tulos4;

    $tunnus = $tulos5;

    $koodikielet = $tulos6;


    $kokemus_sanallinen = $tulos7;
    $kokemus_sanallinen = htmlspecialchars_decode($kokemus_sanallinen);
    $kokemus_arvio = $tulos8;
}

echo'<form action="muokkaa_omat.php" method="post" class="lomake">';
echo'<fieldset>';
echo'<legend>Omat tiedot</legend>';
echo'<p><a href="etusivu".php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
echo'<div class="vali"></div>';

echo'<p> <b>Etunimi:</b> &nbsp&nbsp&nbsp ' . $etunimi . '</p>
                
         <p> <b>Sukunimi:</b> &nbsp&nbsp&nbsp' . $sukunimi . '</p>
       
            
       <p> <b>Sähköpostiosoite: </b> &nbsp&nbsp&nbsp' . $sposti . '</p>
             
                <p><b>Käyttäjätunnus:</b>  &nbsp&nbsp&nbsp' . $tunnus . '</p>       
                
 <p><b>Sinulle tutut koodikielet:</b> &nbsp&nbsp&nbsp' . $koodikielet . '</p>


 <p><b>Koodauskokemuksesi:</b>  &nbsp&nbsp&nbsp' . $kokemus_sanallinen . '</p> 
 
 <p><b>Asteikolla 1-5, kuinka kokenut koodari olet:</b>  &nbsp&nbsp&nbsp' . $kokemus_arvio . '</p>
     

<div class="vali"></div>


<input type="submit" value="Muokkaa" name="muokkaa" style="margin-right: 40px">
<input type="submit" value="Poistu" name="poistu">';


echo'</fieldset></form>';


$haku->close();


echo'<div class = "vali"></div>';
echo'</div>';


include('alatunniste.php');

echo '</body>
        </html>';
