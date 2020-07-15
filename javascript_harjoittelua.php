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
        <title>JAVASCRIPT-HARJOITTELUA</title>';

include("header.php");
include("javascript_funktiota.js");

echo' <body>
   <div style="border: 1px solid  #333333; margin-top: 20px; padding-bottom: 20px">
         
        <h2>Harjoitellaan JavaScript-funktioita. </h1>
         <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>

<br>';

echo'<p>When you submit the form, a function is triggered which alerts some text.</p>

<form action="/action_page.php" onsubmit="myFunction()">
  Enter name: <input type="text" name="fname">
  <input type="submit" value="Submit">
</form>';

//<script>
//function myFunction() {
//  alert("The form was submitted");
//}
//

        
echo'<div class="vali"></div>';        
        
echo'</div>';

include("footer.php");

echo '</body>
</html>';

