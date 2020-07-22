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
        <title>POST-lomakkeen lähetys</title>';

include("ylatunniste.php");


echo' <body>
   <div>
         
        <h2>POST-lomakkeen lähetys</h2>
      <p><a href="post_ja_git.php"> &#8617 &nbsp Palaa  takaisin </a></p> ';
echo'<div class="vali"></div>';

if (!empty($_POST[arvo])) {
    echo'<p>Lähetetyn tekstin arvo on <b>' . $_POST[arvo] . '</b></p>';
} else {
    echo'<p style="font-weight: bold">Lähetetty kenttä on tyhjä!</p>';
}

echo'</div>';

include("alatunniste.php");

echo '</body>
</html>';

