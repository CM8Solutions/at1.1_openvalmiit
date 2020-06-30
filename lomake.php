<?php

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Esimerkkilomake</title>';
include("header.php");
    
  
  
  echo'  <body>
  
         <header>
        <h1>Harjoitellaan tallentamaan seuraavan esimerkkilomakkeen tiedot tietokantaan. </h1>
        
    </header>
        
        <div>
            <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>
            <br>
            <form action="tallenna.php" method="POST" class="lomake">
            <fieldset>
             <legend>Täytä tiedot</legend>
                <p> Etunimi: </p>
                <input type="text" name="etunimi">
                <br>
                <p> Sukunimi: </p>
                <input type="text" name="sukunimi">
                <br>
                <p> Sähköpostiosoite:</p>
                <input type="email" name="sposti">
                <br>
                <p>Käyttäjätunnus:</p>          
                 <input type="text" name="tunnus">
                <br>
                <p> Salasana</p>               
                 <input type="password" name="salasana">
 
 <div class="vali"></div>
 <p> Mitkä koodikielistä on sinulle tuttuja?</p>
 
<input type="checkbox" id="html" name="kielet[]" value="html">
<label for="html">HTML</label><br>

<input type="checkbox" id="php" name="kielet[]"  value="php">
<label for="php">PHP</label><br>

<input type="checkbox" id="css" name="kielet[]" value="css">
<label for="css">CSS</label><br>

<input type="checkbox" id="javascript" name="kielet[]" value="javascript">
<label for="javascript">JavaScript</label><br>

<br>


 <p>Kerro koodauskokemuksistasi</p>
 <textarea name="kokemus_sanallinen"></textarea>
 
<div class="vali"></div>
 <p>Asteikolla 1-5, kuinka kokenut koodari olet? <br>
(1=aloittelija, 5=ammattilainen) 
</p>

 <select name="kokemus_arvio">

 <option value="valitse" name="valitse" selected>Valitse</option>';

for ($i = 1; $i <= 5; $i++) {
    echo'<option name=' . $i . ' value=' . $i . '>' . $i . '</option>';
}


echo'</select>
  
<div class="vali"></div>


<input type="submit" value="Tallenna" class="tallennusnappi">
</fieldset>
</form>
        </div>';


include('footer.php');

echo '</body>
</html>';
