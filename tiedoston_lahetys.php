<?php

// Paikkaillaan PHP:n vanhempien versioiden puutteita; nykyversioilla nämä eivät ole tarpeen.
defined("UPLOAD_ERR_OK") || define("UPLOAD_ERR_OK", 0);
defined("UPLOAD_ERR_INI_SIZE") || define("UPLOAD_ERR_INI_SIZE", 1);
defined("UPLOAD_ERR_FORM_SIZE") || define("UPLOAD_ERR_FORM_SIZE", 2);
defined("UPLOAD_ERR_PARTIAL") || define("UPLOAD_ERR_PARTIAL", 3);
defined("UPLOAD_ERR_NO_FILE") || define("UPLOAD_ERR_NO_FILE", 4);
defined("UPLOAD_ERR_NO_TMP_DIR") || define("UPLOAD_ERR_NO_TMP_DIR", 5);
defined("UPLOAD_ERR_CANT_WRITE") || define("UPLOAD_ERR_CANT_WRITE", 6);
defined("UPLOAD_ERR_EXTENSION") || define("UPLOAD_ERR_EXTENSION", 7);
if (!isset($_FILES) && isset($HTTP_POST_FILES)) {
    $_FILES = & $HTTP_POST_FILES;
}

class UploadException extends Exception {
    // Luokan vanha sisältö kelpaa meille.
}

/**
 * Tarkistaa, että tiedosto on lähetetty onnistuneesti.
 * Virhetilanteissa heitetään poikkeus (UploadException).
 *
 * @param $input        input-tagin nimi
 * @param $maksimikoko  suurin sallittu koko tavuina
 * @return string       palauttaa tiedoston alkuperäisen nimen
 */

function upload_tarkista($input, $maksimikoko = null) {
    $array = array();
    // Tarkistetaan, että tiedosto on edes yritetty lähettää.
    if (empty($_FILES[$input])) {
        throw new UploadException("Tiedosto ei täytä ehtoja!");
    }
    $myFile = $_FILES[$input];
    $myFile["name"] = str_replace('#', '_', $myFile["name"]);


    $fileCount = count($myFile["name"]);

    for ($i = 0; $i < $fileCount; $i++) {
        if ($maksimikoko !== null) {
            if ($myFile["size"][$i] > $maksimikoko) {
                $myFile["error"][$i] = UPLOAD_ERR_FORM_SIZE;
            }
        }


        switch ($myFile["error"][$i]) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new UploadException("Tiedosto on sallittua suurempi!");
            case UPLOAD_ERR_PARTIAL:
                throw new UploadException("Tiedoston 'lataus keskeytyi!");
            case UPLOAD_ERR_NO_FILE:
                throw new UploadException("Tiedosto puuttuu!");
            case UPLOAD_ERR_NO_TMP_DIR:
                throw new UploadException("Palvelimella ei ole paikkaa tiedostoille!");
            case UPLOAD_ERR_CANT_WRITE:
                throw new UploadException("Tiedoston tallentaminen palvelimelle ei onnistunut!");
            case UPLOAD_ERR_EXTENSION:
                throw new UploadException("Jokin PHP:n laajennos esti tiedoston latauksen!");
            default:
                throw new UploadException("Tuntematon virhe tiedoston latauksessa!");
        }
        if (!is_uploaded_file($myFile["tmp_name"][$i])) {
            throw new UploadException("PHP:n mukaan tiedoston tmp_name on viallinen!");
        }

        array_push($array, basename($myFile["name"][$i]));
    }

    // Tarkistetaan tiedoston koko.
    // Tarkistetaan lähetyksen virhetilanteet.
    // HUOMIO: oikeassa käytössä erilaiset ilmoitukset kannattaisi välittää
    // eri luokissa, jotta esim. käyttäjän virhe (liian suuri tiedosto)
    // olisi mahdollista erottaa palvelimen virheestä (tila lopussa).




    return $array;
}



?>