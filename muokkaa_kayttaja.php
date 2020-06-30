<?php

include("yhteys.php");

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Muokkaa käyttäjän tietoja</title>';
include("header.php");



echo '<body>';


echo'<div>';
echo'<div class="vali"></div>';

$haku = $db->query("select * from kayttajat where id='" . $_POST[id] . "'");
if (!$haku) {
    echo'<p>Tietokantahaussa virhe.</p>';
    echo'<p>Syy: ' . $db->error . '</p>';
    die();
} else {


    while ($rivi = $haku->fetch_assoc()) {
        $id = $rivi[id];
        $etunimi = $rivi[etunimi];
        $sukunimi = $rivi[sukunimi];
        $sposti = $rivi[sposti];

        $tunnus = $rivi[tunnus];

        $koodikielet = $rivi[koodikielet];


        $kokemus_sanallinen = $rivi[koodauskokemus_sanallinen];
        $kokemus_sanallinen = htmlspecialchars_decode($kokemus_sanallinen);
        $kokemus_arvio = $rivi[koodauskokemus_arvio];
    }

    if (isset($_POST[muokkaa])) {

        echo'<form action="muokkaa_kayttajan_tiedot.php" method="post">';
        echo'<fieldset>';
        echo'<legend>Muokkaa käyttäjän tietoja:</legend>';
        echo'<p><a href="kayttajat".php"> &#8617 &nbsp  Palaa takaisin </a></p>';


        echo'<p> Etunimi: </p>
                <input type="text" name="etunimi" value='.$etunimi.'>
                <br>
                <p> Sukunimi: </p>
                <input type="text" name="sukunimi" value='.$sukunimi.'>
                <br>
                <p> Sähköpostiosoite:</p>
                <input type="email" name="sposti" value='.$sposti.'>
                <br>
                <p>Käyttäjätunnus:</p>          
                 <input type="text" name="tunnus" value='.$tunnus.'>
                <br>
                <p> Halutessasi voit antaa käyttäjälle uuden salasanan: <br> (jätä tyhjäksi, jos et halua vaihtaa salasanaa)</p>               
                 <input type="password" name="salasana">
 
 <div class="vali"></div>
 <p> Käyttäjälle tutut koodikielet: </p>';

        
  if (strpos($koodikielet, 'html')!==false) {
      echo'<input type="checkbox" id="html" name="kielet[]" value="html" checked>';
  }
  else{
      echo'<input type="checkbox" id="html" name="kielet[]" value="html">';
  }

echo'<label for="html">HTML</label><br>';  


  if (strpos($koodikielet, 'php') !==false) {
      echo'<input type="checkbox" id="php" name="kielet[]" value="php" checked>';
  }
  else{
      echo'<input type="checkbox" id="php" name="kielet[]" value="php">';
  }
echo'<label for="php">PHP</label><br>';

  
  if (strpos($koodikielet, 'css') !==false ) {
      echo'<input type="checkbox" id="css" name="kielet[]" value="css" checked>';
  }
  else{
      echo'<input type="checkbox" id="css" name="kielet[]" value="css">';
  }  
  echo'<label for="css">CSS</label><br>';
  
  
  if (strpos($koodikielet, 'javascript') != false) {
      echo'<input type="checkbox" id="javascript" name="kielet[]" value="javascript" checked>';
  }
  else{
      echo'<input type="checkbox" id="javascript" name="kielet[]" value="javascript">';
  }
  
echo'<label for="javascript">JavaScript</label><br>';

echo'<br>


 <p>Käyttäjän koodauskokemukset</p>
 <textarea name="kuvaus">'.$kokemus_sanallinen.'</textarea>
 
<div class="vali"></div>
 <p>Asteikolla 1-5, kuinka kokenut koodari käyttäjä on <br>
(1=aloittelija, 5=ammattilainen) 
</p>

 <select name="arvio">

 <option value'.$kokemus_arvio.'  name='.$kokemus_arvio.' selected>'.$kokemus_arvio.'</option>';

        for ($i = 1; $i <= 5; $i++) {
            if($i != $kokemus_arvio){
                
            echo'<option name=' . $i . ' value=' . $i . '>' . $i . '</option>';
            }
        }


        echo'</select>
  
<div class="vali"></div>


<input type="submit" value="Tallenna" class="tallennusnappi">';
  
        
        
        echo'</fieldset></form>';
        
    } else {
        
        echo'<h3>Oletko varma, että haluat poistaa käyttäjän '.$etunimi. ' ' .$sukunimi.'</h3>';

        echo'<form action = "poista.php" method = "post">';
        echo'<input type = "hidden" name = "id" value = '.$id.'>';
        echo'<input type="hidden" name="sposti" value='.$sposti.'>';
        echo'<button type = "submit" value = "kylla" style = "margin-right: 20px" name = "valinta" class="nappula">Kyllä</button>';
      
        echo'<button type = "submit" value = "en" name = "valinta" class="nappula">En</button>';
        
        echo'</form>';
    }
}






echo'<div class = "vali"></div>';
echo'</div>';


include('footer.php');

echo '</body>
        </html>';
