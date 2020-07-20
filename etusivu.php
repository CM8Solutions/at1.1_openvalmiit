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
        <title>HARJOITELLAAN KOODAUSTA</title>';

include("header.php");


echo' <body>
  
         <header style="border: 1px solid  #333333;">
        <h1>Harjoitellaan koodausta 	&#129321 </h1>
        
    </header>
        
        <div style="border: 1px solid  #333333; margin-top: 20px; padding-bottom: 20px">
            
            <p style="font-size: 1em; color: blue">Hello World!</p>
            
<div  style="text-align: center">
            <img class="kuva" src="https://i.imgur.com/2w4sYoJ.png" >
            
</div>
<br>
            <h3>Nettisivuja (järjestämätön lista)</h3>

<ul>
  <li> <a href="https://cuulis.cm8solutions.fi">Cuulis</a> </li>
  <li> <a href="https://wilma.edu.hel.fi">Wilma</a> </li>
  <li> <a href="https://www.office.com">Sähköposti</a> </li>
</ul>  
            
            <br>
            
        <h3>Lisää nettisivuja (järjestetty lista)</h3>

<ol>
  <li><a href="https://www.hel.fi/tyly/fi/uutiset/etu-toolon-lukion-oppimateriaalit-lukuvuodelle-2020-2021">Etu-Töölön lukion oppimateriaalit lukuvuodelle 2020-2021</a> </li>
  <li><a href="https://wilma.edu.hel.fi/news/48501">RO-tiedotteet</a> </li>
  <li><a href="https://google.fi/">Google</a> </li>
</ol>  

<br>
          <h3>Linkit toisille sivuille: </h3>
                  <a href="rekisteroityminen.php"><u>Tämä linkki vie sivulle rekisteroityminen.php</u></a>
      <br> <br>           
 <h3>Tallennetut käyttäjät: </h3>
                  <a href="kayttajat.php" class="kayttajat" >Käyttäjät</a>';

if (!isset($_SESSION[tunnus])) {
    echo'<br><br>';
    echo'<h3>Kirjautuminen: </h3>
                  <a href="kirjautuminen.php" class="kirjautuminen" >Kirjaudu sisään</a>';
} else {
    echo'<br><br>';


    echo'<h3>Olet kirjautunut sisään. </h3>
        
   <a href="omat_tiedot.php" class="kirjauduttu" style="margin-right: 40px" >Omat tiedot</a>
   <a href="kirjaudu_ulos.php" class="kirjauduttu" >Kirjaudu ulos</a>';
}

echo'<div class="vali"></div>';

echo'<br>
          <h3>Extra-harjoittelua: </h3>
          <ul>
              <li><a href="post_ja_git.php">POST:n ja GET:n erot</a></li>
              <li>    <a href="loopit.php">While ja do while</a></li>
                   <li><a href="taulukot.php">Taulukot</a></li>
                      <li style="margin-bottom: 8px"><a href="tiedoston_lisays.php" style="margin-right: 20px">Tiedoston lisäys</a>
                      -><a href="tiedostot.php" class="tiedostot_nappula" style="margin-left: 20px;" >Lisätyt tiedostot</a></li>
                       <li><a href="javascript_harjoittelua.php">JavaScript-harjoittelua</a></li>
                       
      </ul>';

echo'<div class="vali"></div>';

echo'</div>';

include("footer.php");

echo '</body>
</html>';

