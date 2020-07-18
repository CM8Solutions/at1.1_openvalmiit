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
        <title>TAULUKOT</title>';

include("header.php");


echo' <body>
   <div style="border: 1px solid  #333333; margin-top: 20px; padding-bottom: 20px">
         
        <h2>Harjoitellaan taulukoita </h2>
              <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p> ';
echo'<div class="vali"></div>';


echo'<h3>Luetellaan sisältö:</h3>';

$varit = array("punainen", "vihreä", "sininen", "keltainen");

foreach ($varit as $sisalto) {
    echo $sisalto . '<br>';
}


echo'<p style="font-weight: bold">Kolmas väri on: ' . $varit[2] . '</p>';

echo'<div class="vali"></div>';


echo'<h3>Lisätään sisältöä push-toiminnolla:</h3>';

$arvotut_numerot = array();


for ($maara = 5; $maara > 0; $maara--) {

    $numero = rand(0, 99);
    array_push($arvotut_numerot, $numero);
}

echo'<p style="font-weight: bold; display: inline-block; margin-right: 20px">Arvotut 5 numeroa ovat:</p>';

$maara = count($arvotut_numerot);

foreach ($arvotut_numerot as $numero) {
    echo $numero;
    $maara--;
    if ($maara > 0) {
        echo', ';
    }
}


echo'<div class="vali"></div>';

echo'</div>';

include("footer.php");

echo '</body>
</html>';

