<?php

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Käyttäjät</title>';
include("header.php");
include ("yhteys");

echo'</head>
  
    <body>
  
         <header>
        <h1>Tietokantaan tallennetut käyttäjät </h1>

    </header>
        
        <div>';

$haku = $db->query("select distinct * from kayttajat");

if (!$haku) {
    echo'<p>Tietokantahaku epäonnistui!</p>';

    echo'<p>Syy: ' . $db->error();

    die();
}
echo'<asda';

if ($haku->num_rows == 0) {
    
    echo'<p>Ei tallennettuja käyttäjiä';
} else {

    echo'<table>';
    echo'<thead><th>Etunimi</th><th>Sukunimi</th>Sähköpostiosoite</th><th>Tunnus</th><th>Koodikielet</th><th>Koodauskokemus (sanallinen)</th><th>Koodauskokemus (arvio)</th></thead>';

    echo'<tbody>';

    while ($rivi = $haku->fetch_assoc()) {

        $etunimi = $rivi[etunimi];
        $sukunimi = $rivi[sukunimi];
        $sposti = $rivi[sposti];

        $tunnus = $rivi[tunnus];

        $koodikielet = $rivi[koodikielet];


        $kokemus_sanallinen = $rivi[koodauskokemus_sanallinen];
        $kokemus_arvio = $rivi[koodauskokemus_arvio];

        echo'<tr><td>' . $etunimi . '</td><td>' . $sukunimi . '</td><td>' . $sposti . '</td><td>' . $tunnus . '</td><td>' . $koodikielet . '</td><td>' . $kokemus_sanallinen . '</td><td>' . $kokemus_arvio . '</td></tr>';
    }

    echo'</tbody></table>';

}
    echo'</div>';


include('footer.php');

echo '</body>
</html>';
