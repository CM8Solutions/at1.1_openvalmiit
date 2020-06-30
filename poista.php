<?php
ob_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo'<!DOCTYPE html>

<html>
    <head>
        <title>Käyttäjän poisto</title>';
include("header.php");
include("yhteys.php");



echo'<div>';

if($_POST[valinta]=="en"){
   
    header("location: kayttajat.php");
}
else if($_POST[valinta]=="kylla"){

    $poisto = $db -> query("delete from kayttajat where id='".$_POST[id]."'");
    
    if(!$poisto){
        
    echo'<p>Tietokannasta poistamisessa virhe.</p>';
    echo'<p>Syy: '.$db->error.'</p>';
    die();

    }
    else{
        
        echo'<p>Käyttäjän poisto onnistui! </p>';
        
            $headers .= "Organization: AT1.1 Internet ja verkkosivut\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: AT1.1 Internet ja verkkosivut <no-reply@syksy2020.tylykoodaa.fi>" . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        
          $otsikko = "Tietosi on poistettu sivustolta syksy2020.tylykoodaa.fi/ope";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


            $viesti = 'Tietosi on poistettu kurssin AT1.1 Internet ja verkkosivut tietokannasta.<br><br><em>Tähän viestiin ei voi vastata.</em>';
            $viesti = str_replace("\n.", "\n..", $viesti);

            $sposti=$_POST[sposti];
          
            $lahetys = mail($sposti, $otsikko, $viesti, $headers);

            if ($lahetys) {
                echo'<p> Viesti lähetetty!</p>';
            } else {
                echo'<p>Viestiä ei pystytty lähettämään!' . $siivottu_sposti;
                print_r(error_get_last());
            }
    
        
        
        
    }
   
  echo' <p><a href="kayttajat.php"> &#8617 &nbsp  Palaa takaisin </a></p>';
    
    
}


         
echo'</div>';

include('footer.php');

echo '</body>
</html>';
