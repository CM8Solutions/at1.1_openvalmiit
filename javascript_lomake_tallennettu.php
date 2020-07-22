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
         
        <h2>Tässä voi tallentaa JavaScript-lomakkeen tiedot. </h2>
         <p><a href="javascript_harjoittelua.php"> &#8617 &nbsp  Palaa takaisin </a></p>';


echo'<p style="padding-top: 15px;">Tallennettu arvo on <b>'.$_POST[nimi].'</b></p>';



echo'</div>';

include("alatunniste.php");

echo '</body>
</html>';

