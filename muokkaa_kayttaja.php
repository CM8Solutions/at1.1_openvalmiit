<?php

ob_start();
session_start();

include("tietokantayhteys.php");
$haku = $yhteys->prepare("SELECT id, etunimi, sukunimi, sposti, tunnus, koodikielet, koodauskokemus_sanallinen, koodauskokemus_arvio FROM kayttajat WHERE id=?");

if (!$haku) {
    die('<p>Tietokantahaussa virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
}

$haku->bind_param("i", $id);

if (isset($_POST[id])) {

    $id = $_POST[id];
} else if (isset($_GET[id])) {

    $id = $_GET[id];
}
if (!$haku->execute()) {
    die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($haku->error) . '</p>');
}

$haku->store_result();
$haku->bind_result($tulos1, $tulos2, $tulos3, $tulos4, $tulos5, $tulos6, $tulos7, $tulos8);

while ($haku->fetch()) {
    $id = $tulos1;
    $etunimi = $tulos2;
    $sukunimi = $tulos3;
    $sposti = $tulos4;

    $tunnus = $tulos5;

    $koodikielet = $tulos6;


    $kokemus_sanallinen = $tulos7;
    $kokemus_sanallinen = htmlspecialchars_decode($kokemus_sanallinen);
    $kokemus_arvio = $tulos8;
}


echo'<!DOCTYPE html>

<html>
    <head>
        <title>' . $etunimi . ' ' . $sukunimi . '</title>';
include("header.php");



echo '<body>';


echo'<div>';
echo'<div class="vali"></div>';



if (isset($_POST[muokkaa]) || isset($_GET[muokkaa])) {

    echo'<form action="muokkaa_kayttajan_tiedot.php" method="post" class="lomake">';
    echo'<fieldset>';
    echo'<legend>Muokkaa käyttäjän tietoja</legend>';
    echo'<p><a href="kayttajat".php"> &#8617 &nbsp  Palaa takaisin </a></p>';

    echo'<p style="font-size: 1em; font-weight: bold; color: red">Tähdellä * merkityt tiedot ovat pakollisia.</p>';

    echo'<p> Etunimi: <b style="margin-left: 10px; color: red">*</b></p>
                <input type="text" name="etunimi" value=' . $etunimi . '>
                <br>
            <p> Sukunimi:  <b style="margin-left: 10px; color: red">*</b></p>
                <input type="text" name="sukunimi" value=' . $sukunimi . '>
                <br>
       <p> Sähköpostiosoite: <b style="margin-left: 10px; color: red">*</b></p>
                <input type="email" name="sposti" value=' . $sposti . '>
                <br> 
                <p>Käyttäjätunnus: <b style="margin-left: 10px; color: red">*</b></p>         
                 <input type="text" name="tunnus" value=' . $tunnus . '>
                <br>
  
 
 <div class="vali"></div>
 <p> Käyttäjälle tutut koodikielet:</p>';


    if (strpos($koodikielet, 'html') !== false) {
        echo'<input type="checkbox" id="html" name="kielet[]" value="html" checked>';
    } else {
        echo'<input type="checkbox" id="html" name="kielet[]" value="html">';
    }

    echo'<label for="html">HTML</label><br>';


    if (strpos($koodikielet, 'php') !== false) {
        echo'<input type="checkbox" id="php" name="kielet[]" value="php" checked>';
    } else {
        echo'<input type="checkbox" id="php" name="kielet[]" value="php">';
    }
    echo'<label for="php">PHP</label><br>';


    if (strpos($koodikielet, 'css') !== false) {
        echo'<input type="checkbox" id="css" name="kielet[]" value="css" checked>';
    } else {
        echo'<input type="checkbox" id="css" name="kielet[]" value="css">';
    }
    echo'<label for="css">CSS</label><br>';


    if (strpos($koodikielet, 'javascript') != false) {
        echo'<input type="checkbox" id="javascript" name="kielet[]" value="javascript" checked>';
    } else {
        echo'<input type="checkbox" id="javascript" name="kielet[]" value="javascript">';
    }

    echo'<label for="javascript">JavaScript</label><br>';

    echo'<br>


 <p>Käyttäjän koodauskokemukset <b style="margin-left: 10px; color: red">*</b></p>
 <textarea name="kokemus_sanallinen">' . $kokemus_sanallinen . '</textarea>
 
<div class="vali"></div>
 <p>Asteikolla 1-5, kuinka kokenut koodari käyttäjä on <b style="margin-left: 10px; color: red">*</b><br>
(1=aloittelija, 5=ammattilainen) 
</p>

 <select name="kokemus_arvio">

 <option value' . $kokemus_arvio . '  name=' . $kokemus_arvio . ' selected>' . $kokemus_arvio . '</option>';

    for ($i = 1; $i <= 5; $i++) {
        if ($i != $kokemus_arvio) {

            echo'<option name=' . $i . ' value=' . $i . '>' . $i . '</option>';
        }
    }


    echo'</select>
<input type="hidden" name="id" value=' . $id . '>  
<div class="vali"></div>


<input type="submit" value="Tallenna">';



    echo'</fieldset></form>';
} else if (isset($_POST[poista])) {

    echo'<h3>Oletko varma, että haluat poistaa käyttäjän ' . $etunimi . ' ' . $sukunimi . '?</h3>';

    echo'<form action = "poista.php" method = "post">';
    echo'<input type = "hidden" name = "id" value = ' . $id . '>';
    echo'<input type="hidden" name="sposti" value=' . $sposti . '>';
    echo'<button type = "submit" value = "kylla" style = "margin-right: 20px" name = "valinta" class="nappula">Kyllä</button>';

    echo'<button type = "submit" value = "en" name = "valinta" class="nappula">En</button>';

    echo'</form>';
} else if (isset($_POST[viesti]) || isset($_GET[viesti])) {


    echo'<form action="laheta_viesti.php" method="post" class="lomake_viesti">';
    echo'<fieldset>';
    echo'<legend>Lähetä viesti käyttäjälle ' . $etunimi . ' ' . $sukunimi . '</legend>';
    echo'<p><a href="kayttajat".php"> &#8617 &nbsp  Palaa takaisin </a></p>';
    echo'<p style="font-size: 1em; font-weight: bold; color: red">Tähdellä * merkityt tiedot ovat pakollisia.</p>';

    echo'<br><label>Lähettäjän sähköpostiosoite: <b style="margin-left: 10px; color: red">*</b></label>';
    echo'<br><input type="email" name="lahettaja" value=' . $_SESSION[sposti] . '>';

    echo'<br><br><label>Vastaanottajan sähköpostiosoite:</label> &nbsp&nbsp&nbsp' . $sposti;
    echo' <input type="hidden" name="vastaanottaja" value=' . $sposti . '>';
    echo'<br><br><label>Otsikko: <b style="margin-left: 10px; color: red">*</b></label><br>';
    echo'<input type="text" name="otsikko">';
    echo'<br><br><label>Viesti: <b style="margin-left: 10px; color: red">*</b></label><br>';
    echo'<textarea name="viesti"></textarea>
    <input type="hidden" name="id" value=' . $id . '>';

    echo'<br><br><input type = "submit" value = "Lähetä">';

    echo'</form>';
} else {
    echo'<h3>Palaa takaisin ensin, jos haluat päivittää sivun.</h3> ';


    echo' <p><a href="kayttajat.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
}

$haku->close();


echo'<div class = "vali"></div>';
echo'</div>';


include('footer.php');

echo '</body>
        </html>';
