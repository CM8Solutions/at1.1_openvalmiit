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
        <title>WHILE JA DO WHILE</title>';

include("header.php");


echo' <body>
   <div style="border: 1px solid  #333333; margin-top: 20px; padding-bottom: 20px">
         
        <h2>Harjoitellaan WHILE ja DO WHILE-looppeja. </h2>
      <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p> ';
echo'<div class="vali"></div>';
echo'<h3> WHILE-looppi:</h3>';


$numero1 = 1;

while($numero1 <= 5) {
  echo "Numero1 on: $numero1 <br>";
  $numero1++;
}
echo'<div class="vali"></div>'; 

echo'<h3> DO WHILE-looppi:</h3>';

$numero2 = 5;

do {
  echo "Numero2 on: $numero2 <br>";
  $numero2--;
} while ($numero2 > 0);



        
echo'<div class="vali"></div>';        
        
echo'</div>';

include("footer.php");

echo '</body>
</html>';

