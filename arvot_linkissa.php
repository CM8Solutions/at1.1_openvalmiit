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
        <title>Arvojen lähetys linkissä</title>';

include("ylatunniste.php");


echo' <body>
   <div>
         
        <h2>Arvojen lähetys toiselle sivulle linkissä</h2>
      <p><a href="post_ja_git.php"> &#8617 &nbsp Palaa  takaisin </a></p> ';
echo'<div class="vali"></div>';


echo'<p>Lähetetyt arvot ovat:<br><br>
Vuosi on <b>' . $_GET[vuosi] . '</b>
<br>Maa on <b>' . $_GET[maa] . '</b></p>';

echo'<p style="color: red; font-weight: bold">Katso miten nämä arvot näkyy nyt selaimen osoite-kentässä!</p>';


echo'</div>';

include("alatunniste.php");

echo '</body>
</html>';

