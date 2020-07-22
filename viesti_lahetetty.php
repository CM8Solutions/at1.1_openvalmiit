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
        <title>VIESTI LÄHETETTY ONNISTUNEESTI</title>';

include("ylatunniste.php");


echo' <body>
   <div style="border: 1px solid  #333333; margin-top: 20px; padding-bottom: 20px">
         
        <h3>Viestisi on lähetetty! </h3>
              <p><a href="kayttajat.php">&#8617 &nbsp Palaa käyttäjät-osioon </a></p> ';
echo'<div class="vali"></div>';



echo'</div>';

include("alatunniste.php");

echo '</body>
</html>';

