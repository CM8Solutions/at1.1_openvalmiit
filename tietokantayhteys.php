<?php

ob_start();

$yhteys = mysqli_connect('mysql2.shellit.org', 'u60224', 'atsjm2020', 'u60224B1');


if (!$yhteys) {
    echo "<p>Tietokantayhteyttä ei voida muodostaa!" . PHP_EOL . '</p>';
    echo "<p>Virheen numero: " . mysqli_connect_errno() . PHP_EOL . '</p>';
    echo "<p>Virhe: " . mysqli_connect_error() . PHP_EOL . '</p>';
    die();
} else {

    mysqli_set_charset($yhteys, "utf8");
}

