<?php

ob_start();

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Rekisteröityminen</title>';
include("ylatunniste.php");



echo'  <body>
  


        
        <div>
                <h2>Rekisteröityminen </h2>
            <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>
            <br>
            <form action="tallenna.php" method="POST" class="lomake">
            <fieldset>
             <legend>Täytä tiedot</legend>
             
             <p style="font-size: 1em; font-weight: bold; color: red">Tähdellä * merkityt tiedot ovat pakollisia.</p>
                <p> Etunimi: <b style="margin-left: 10px; color: red">*</b></p>
                <input type="text" name="etunimi">
                <br>
                <p> Sukunimi:  <b style="margin-left: 10px; color: red">*</b></p>
                <input type="text" name="sukunimi">
                <br>
                <p> Sähköpostiosoite: <b style="margin-left: 10px; color: red">*</b></p>
                <input type="email" name="sposti">
                <br>
                <p>Käyttäjätunnus: <b style="margin-left: 10px; color: red">*</b></p>          
                 <input type="text" name="tunnus">
                <br>
                <p>Anna salasana: <b style="margin-left: 10px; color: red">*</b> </p>               
                 <input type="password" name="salasana">
 
  <p>Anna salasana uudelleen:  <b style="margin-left: 10px; color: red">*</b></p>               
                 <input type="password" name="salasana2">
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


 <p>Kerro koodauskokemuksistasi <b style="margin-left: 10px; color: red">*</b></p>
 <textarea name="kokemus_sanallinen"></textarea>
 
<div class="vali"></div>
 <p>Asteikolla 1-5, kuinka kokenut koodari olet?  <b style="margin-left: 10px; color: red">*</b><br>
(1=aloittelija, 5=ammattilainen) 
</p>

 <select name="kokemus_arvio">

 <option value="valitse" name="valitse" selected>Valitse</option>';

for ($i = 1; $i <= 5; $i++) {
    echo'<option name=' . $i . ' value=' . $i . '>' . $i . '</option>';
}


echo'</select>
  
<div class="vali"></div>


<input type="submit" value="Tallenna">
</fieldset>
</form>
        </div>';


include('alatunniste.php');

echo '</body>
</html>';
