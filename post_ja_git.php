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
        <title>POST JA GET</title>';

include("ylatunniste.php");


echo' <body>
   <div>
         
        <h2>Harjoitellaan POST:n ja GET:n eroja </h2>
      <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p> ';
echo'<div class="vali"></div>';
echo'<h3>Lomakkeessa:</h3>';

echo'<br>';
echo'<form action="post_lahetys.php" method="POST" class="lomake">
            <fieldset>
             <legend>1) POST</legend>
             
           
                <p>Kenttä:</p>          
                 <input type="text" name="arvo">
                 <br><br><input type="submit" value="Tallenna">
                 </fieldset></form>';

echo'<br><br>';
echo'<form action="get_lahetys.php" method="GET" class="lomake">
            <fieldset>
             <legend>2) GET</legend>
             
           
                <p>Kenttä:</p>          
                 <input type="text" name="arvo">
                 <br><br><input type="submit" value="Tallenna">
                 </fieldset></form>';


echo'<div class="vali"><br></div>';

echo'<h3>Linkissä:</h3>';

echo'<p style="font-weight: bold">Linkissä arvoja voi lähettää seuraavalle sivulle näin: </p>';

$maa = "Suomi";

echo'<a href="arvot_linkissa.php?vuosi=2020&maa=' . $maa . '">arvot_linkissa.php?vuosi=2020&maa=' . $maa . ' </a>';


echo'</div>';

include("alatunniste.php");

echo '</body>
</html>';

