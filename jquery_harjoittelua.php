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
        <title>JQUERY-HARJOITTELUA</title>';

// tuodaan ylätunniste ja tarvittava jquery-tiedosto
echo'<head>
     
       <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Architects Daughter" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="ulkoasu.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>

    </head>';


echo' <body>
   <div>
         
        <h2>Harjoitellaan jQuery-funktioita. </h2>
         <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';

echo'<div class="esilla" style="border: none; margin: 0px; padding: 0px"> ';
echo'<p style="padding-top: 15px; font-weight: bold">Katso, mitä tälle tapahtuu, kun klikkaat painiketta:</p>


<button onclick="vaihda()" class="vaihda1">Piilota</button>';

echo'</div>';

echo'<div class="piilossa" style="border: none; margin:0px; padding: 0px">

<button onclick="vaihda()" class="vaihda2">Näytä</button>';

echo'</div>';

echo'<div class="vali"><br></div>';
echo'<p style="padding-top: 15px; font-weight: bold">Katso, mitä alueelle tapahtuu, kun klikkaat sitä:</p>';


echo'<div style="background-color:#98bf21;height:100px;width:100px; position: relative;" class="alue"></div>';

echo'</div>';
echo'</div>';

include("alatunniste.php");

echo '</body>
</html>';
?>

<script>
$(document).ready(function(){
   
    $(".piilossa").hide();
   
  $(".vaihda1").click(function(){
         $(".esilla").hide();
          $(".piilossa").show();

  
  });
  
  $(".vaihda2").click(function(){
      $(".piilossa").hide();
          $(".esilla").show();
  });
});
</script>

<script> 
$(document).ready(function(){
    
     $(".alue").hover(function(){
    $(this).css("cursor", "pointer");
  
     }); 
    
  $(".alue").click(function(){
    $(".alue").animate({
      left: '250px',
      opacity: '0.5',
      height: '150px',
      width: '150px',
    });
    $(".alue").css({"background-image": "url(images/smile.png)"});
    
  });
});
</script> 