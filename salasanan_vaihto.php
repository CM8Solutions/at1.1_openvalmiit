<?php

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Salasanan vaihto</title>';
include("header.php");



echo'  <body>
  
         <header>
        <h1>Vaihda salasanasi: </h1>
        
    </header>
        
        <div>
            <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>
            <br>
            <form action="aktivoinnin_tarkistus.php" method="POST" class="lomake">
            <fieldset>
             <legend>Täytä tiedot</legend>
             
             <p style="font-size: 1em; font-weight: bold; color: red">Kaikki tiedot ovat pakollisia.</p>
           
                <p>Käyttäjätunnus: <b style="margin-left: 10px; color: red">*</b></p>          
                 <input type="text" name="tunnus">
                <br>
                <p>Anna salasana: <b style="margin-left: 10px; color: red">*</b> </p>               
                 <input type="password" name="salasana">
  <p>Anna salasana uudelleen:  <b style="margin-left: 10px; color: red">*</b></p>               
                 <input type="password" name="salasana2">
<br><br>

<input type="submit" value="Kirjaudu">


</fieldset>
</form>
        </div>';


include('footer.php');

echo '</body>
</html>';
