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
        <title>JAVASCRIPT-HARJOITTELUA</title>';
// tuodaan ylätunniste ja tarvittava .js-tiedosto
echo'<head>
     
       <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Architects Daughter" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="ulkoasu.css">

<script src="javascript_funktioita.js" language="javascript" type="text/javascript"></script> 

    </head>';


echo' <body>
   <div>
         
        <h2>Harjoitellaan JavaScript-funktioita. </h2>
         <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';


echo'<p style="padding-top: 15px; font-weight: bold" >Katso, mitä tapahtuu, kun klikkaat "Tallenna"-nappulaa, kun kenttä on tyhjä ja kun siinä on arvo: </p>';

echo'<form action="javascript_lomake_tallennettu.php" onSubmit ="return Tallenna()" method="post" > 

  Nimi: <input type="text" name="nimi" id="nimi"> <input style="margin-left: 20px;" type="submit" value="Tallenna">';

echo'</form>';

echo '<p id="tyhja"></p>';

echo'<div class="vali"></div>';

echo'</div>';

include("alatunniste.php");

echo '</body>
</html>';

