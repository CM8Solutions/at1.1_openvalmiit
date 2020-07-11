<?php

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
            <img class="kuva" src="https://i.imgur.com/2w4sYoJ.png" style="width: 500px; height: 300px;">
            
</div>
<br>
            <h2>Nettisivuja (järjestämätön lista)</h2>

<ul>
  <li> <a href="https://cuulis.cm8solutions.fi">Cuulis</a> </li>
  <li> <a href="https://wilma.edu.hel.fi">Wilma</a> </li>
  <li> <a href="https://www.office.com">Sähköposti</a> </li>
</ul>  
            
            <br>
            
        <h2>Lisää nettisivuja (järjestetty lista)</h2>

<ol>
  <li><a href="https://www.hel.fi/tyly/fi/uutiset/etu-toolon-lukion-oppimateriaalit-lukuvuodelle-2020-2021">Etu-Töölön lukion oppimateriaalit lukuvuodelle 2020-2021</a> </li>
  <li><a href="https://wilma.edu.hel.fi/news/48501">RO-tiedotteet</a> </li>
  <li><a href="https://google.fi/">Google</a> </li>
</ol>  

<br>
          <h2>Linkit toisille sivuille: </h2>
                  <a href="rekisteroityminen.php"><u>Tämä linkki vie sivulle rekisteroityminen.php</u></a>
      <br> <br>           
 <h2>Tallennetut käyttäjät: </h2>
                  <a href="kayttajat.php" class="kayttajat" >Käyttäjät</a>';

if (!isset($_SESSION[tunnus])) {
    echo'<br><br>';
    echo'<h2>Kirjautuminen: </h2>
                  <a href="kirjautuminen.php" class="kirjautuminen" >Kirjaudu sisään</a>';
} else {
    echo'<br><br>';


    echo'<h2>Olet kirjautunut sisään. </h2>
        
   <a href="omat_tiedot.php" class="kirjauduttu" style="margin-right: 40px" >Omat tiedot</a>
   <a href="kirjaudu_ulos.php" class="kirjauduttu" >Kirjaudu ulos</a>';
}

echo'<div class="vali"></div>';

echo'</div>';

include("footer.php");

echo '</body>
</html>';

