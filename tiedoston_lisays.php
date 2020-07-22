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
        <title>TIEDOSTON LISÄYS</title>';

include("ylatunniste.php");


echo' <body>
   <div>
         
        <h2>Harjoitellaan taulukoita ja listoja </h2>
        <p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>

<br>';

echo '<form action="laheta_tiedosto.php" class="lomake" method="POST" enctype="multipart/form-data"><fieldset>';
echo'<legend>Lisää tiedosto</legend>
       
	

<p style="color: red"><b>Huom! </b><b style="font-weight: normal">Tiedoston maksimikoko on 20,0MB.<br>Sallitut tiedostomuodot: .pdf,  .tnsp, .tns, .docx, .ods, .odt, .odp, .odg, .csv, .zip, .rar, .doc, .dat, .ppt, .txt tai .rtf, .ppt, .pptx, .xls, .xlsx	</b></p>

			<br><input type="file" name="tiedostot[]" style="font-size: 0.9em" multiple="" >
 	
		<br><br><br><input type="submit" value="&#10003 Tallenna" class="myButton9">
	</fieldset></form>';




echo'<div class="vali"></div>';

echo'</div>';

include("alatunniste.php");

echo '</body>
</html>';

