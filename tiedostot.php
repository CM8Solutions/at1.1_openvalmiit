<?php

include("tietokantayhteys.php");

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Tiedostot</title>';
include("header.php");

echo '<body>
           <header>
        <h2>Tietokantaan lisätyt tiedostot </h2>

    </header>';

echo'<div>';
echo'<p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
echo'<div class="vali"></div>';

$haku = $yhteys->prepare("SELECT id, kohde, nimi FROM tiedostot");


if (!$haku) {
    die('<p>Tietokantahaussa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
}

if (!$haku->execute()) {
    die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku->error) . '</p>');
}


$haku->store_result();

if ($haku->num_rows == 0) {
    echo'<p>Ei lisättyjä tiedostoja.</p>';
} else {
    $haku->bind_result($tulos1, $tulos2, $tulos3);


    echo'<table class="tiedostot_table">';
    echo'<thead><th>Nimi</th><th></th></thead>';

    echo'<tbody>';
    while ($haku->fetch()) {
        $id = $tulos1;
        $kohde = $tulos2;
        $nimi = $tulos3;

        echo'<tr><td><a href="' . $kohde . '"> ' . $nimi . '</a></td>';
        echo'<td><form action="poista_tiedosto_varmennus.php" method="post"><input type="hidden" name="id" value=' . $id . '>
        <input type="submit" class="nappula" name="poista_tiedosto_varmennus" title="Poista tiedosto" value="Poista"></form></td></tr>';
    }
    echo'</tbody></table>';
}

$haku->close();

echo'<div class="vali"></div>';
echo'</div>';


include('footer.php');

echo '</body>
</html>';
