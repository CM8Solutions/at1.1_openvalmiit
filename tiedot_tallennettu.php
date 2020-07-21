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
        <title>TIETOJEN TALLENNUS</title>';

include("header.php");


echo' <body>
   <div style="border: 1px solid  #333333; margin-top: 20px; padding-bottom: 20px">';

echo'<h2>Tiedot tallennettu onnistuneesti!</h2>';

if ($_GET[viesti] == 1) {
    echo'<p style="font-weight: bold">Rekisteröinnin vahvistustiedot lähetetty antaamaasi sähköpostiosoitteeseen!</p>';
} else {
    echo'<p style="font-weight: bold">Rekisteröinnin vahvistustietoja ei pystytty lähettämään sähköpostiosoitteeseen</p>';
}




echo' <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';


echo'</div>';

include("footer.php");

echo '</body>
</html>';

