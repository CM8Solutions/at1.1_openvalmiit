<?php

$db = mysqli_connect('mysql1.shellit.org', 'u38085', 'Mariann3', 'u38085B2');


if (!$db){
      echo "<p>Tietokantayhteyttä ei voida muodostaa!" . PHP_EOL. '</p>';
    echo "<p>Virheen numero: " . mysqli_connect_errno() . PHP_EOL. '</p>';
    echo "<p>Virhe: " . mysqli_connect_error() . PHP_EOL.'</p>';
die();
    
}
else
    mysqli_set_charset($db, "utf8");

