<?php

include("yhteys.php");

echo'<!DOCTYPE html>

<html>
    <head>
        <title>Käyttäjät</title>';
include("header.php");

    


echo '<body>
           <header>
        <h1>Tietokantaan tallennetut käyttäjät </h1>

    </header>';

echo'<div>';
  echo'<p><a href="etusivu.php"> &#8617 &nbsp  Palaa etusivulle </a></p>';
  echo'<div class="vali"></div>';
    
  $haku=$db->query("select * from kayttajat");
if(!$haku){
    echo'<p>Tietokantahaussa virhe.</p>';
    echo'<p>Syy: '.$db->error.'</p>';
    die();
}
else{
    
    if($haku->num_rows==0){
        echo'<p>Ei käyttäjiä.</p>';
    }
    
    else{
        
    echo'<table>';
    echo'<thead><th>Etunimi</th><th>Sukunimi</th><th>Sähköpostiosoite</th><th>Tunnus</th><th>Koodikielet</th><th>Koodauskokemus (sanallinen)</th><th>Koodauskokemus (arvio)</th></thead>';

    echo'<tbody>';

    while ($rivi = $haku->fetch_assoc()) {
        $id = $rivi[id];
        $etunimi = $rivi[etunimi];
        $sukunimi = $rivi[sukunimi];
        $sposti = $rivi[sposti];

        $tunnus = $rivi[tunnus];

        $koodikielet = $rivi[koodikielet];


        $kokemus_sanallinen = $rivi[koodauskokemus_sanallinen];
        $kokemus_sanallinen = str_replace("\n", "<br />", $kokemus_sanallinen);

        $kokemus_arvio = $rivi[koodauskokemus_arvio];

        echo'<tr><td>' . $etunimi . '</td><td>' . $sukunimi . '</td><td>' . $sposti . '</td><td>' . $tunnus . '</td><td>' . $koodikielet . '</td><td>' . $kokemus_sanallinen . '</td><td>' . $kokemus_arvio . '</td>';
        echo'<td><form action="muokkaa_kayttaja.php" method="post"><input type="hidden" name="id" value='.$id.'>'
                . '<input type="submit" class="nappula" style="margin-right: 10px" name="muokkaa" title="Muokkaa käyttäjän tietoja" value="Muokkaa">'
                .'<input type="submit" class="nappula" name="poista" title="Poista käyttäjä" value="Poista"></form></td></tr>';
                    


}
    echo'</tbody></table>';
    }
    
    
}
echo'<div class="vali"></div>';
echo'</div>';


include('footer.php');

echo '</body>
</html>';
