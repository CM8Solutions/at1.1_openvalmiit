<?php

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Kirjautuminen</title>';
include("header.php");



echo'  <body>
  
         <header>
        <h1>Kirjaudu sisään: </h1>
        
    </header>
        
        <div>
            <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>
            <br>
            <form action="tarkistus.php" method="POST" class="lomake">
            <fieldset>
             <legend>Täytä tiedot</legend>
             
             <p style="font-size: 1em; font-weight: bold; color: red">Kaikki tiedot ovat pakollisia.</p>
           
                <p>Käyttäjätunnus: <b style="margin-left: 10px; color: red">*</b></p>          
                 <input type="text" name="tunnus">
                <br>
                <p>Anna salasana: <b style="margin-left: 10px; color: red">*</b> </p>               
                 <input type="password" name="salasana">

<br><br>

<input type="submit" value="Kirjaudu">
<br><br>

<a href="unohtunut_tunnus.php"><u>Unohditko tunnuksen tai salasanan?</u></a>;

</fieldset>
</form>
        </div>';


include('footer.php');

echo '</body>
</html>';
