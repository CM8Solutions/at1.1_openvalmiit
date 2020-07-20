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
        <title>GET-lomakkeen lähetys</title>';

include("header.php");


echo' <body>
   <div>
         
        <h2>GET-lomakkeen lähetys</h2>
      <p><a href="post_ja_git.php"> &#8617 &nbsp Palaa  takaisin </a></p> ';
echo'<div class="vali"></div>';

if (!empty($_GET[arvo])) {
    echo'<p>Lähetetyn tekstin arvo on <b>' . $_GET[arvo] . '</b></p>';
    echo'<p style="color: red; font-weight: bold">Katso miten tämä arvo näkyy nyt selaimen osoite-kentässä!</p>';
} else {
    echo'<p style="font-weight: bold">Lähetetty kenttä on tyhjä!</p>';
}

echo'</div>';

include("footer.php");

echo '</body>
</html>';

