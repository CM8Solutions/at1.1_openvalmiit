<?php

ob_start();

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Unohtunut tunnus/salasana</title>';
include("header.php");



echo'  <body>
        
        <div>
         <h2>Tunnuksen ja salasanan uudelleen aktivointi </h2>
            <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>
            <br>
            <form action="aktivointi.php" method="POST" class="lomake">
            <fieldset>
             <legend>Täytä tiedot</legend>
             
             <p style="font-size: 1em; font-weight: bold; color: red">Kaikki tiedot ovat pakollisia.</p>
           
                <p>Sähköpostiosoite: <b style="margin-left: 10px; color: red">*</b></p>          
                 <input type="text" name="sposti">
            

<br><br>

<input type="submit" value="Lähetä">



</fieldset>
</form>
        </div>';


include('footer.php');

echo '</body>
</html>';
