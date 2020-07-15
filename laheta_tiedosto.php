<?php
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> TIEDOSTON LÄHETYS </title>
';
include("tietokantayhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!




// header("Content-Type: text/plain");
// ini_set("error_reporting", E_ALL | E_STRICT);
// ini_set("display_errors", 1);
// Otetaan funktiot mukaan.
        require_once("tiedoston_lahety.php");

        // Esimerkki: Tarkistetaan, että tiedosto on lähetetty ja että se on kooltaan
        // enintään 10,0 megatavua. Käsitellään myös virheilmoitus.

        if (isset($_FILES['my_file'])) {
            $myFile = $_FILES['my_file'];

//tulee array!!


            try {

                $nimi = upload_tarkista('my_file', 20.0 * 1024 * 1024);

                $fileCount = count($nimi);

                $paateloyty = false;

                for ($j = 0; $j < $fileCount; $j++) {

                    $paatteet = array(".txt", ".pdf", ".rar", ".zip", ".csv", ".odt", ".ods", ".odg", "odp", ".tnsp", ".tns", ".doc", ".docx", ".rtf", ".dat", ".pptx", ".ppt", ".xls", ".xlsx", ".TXT", ".PDF", ".DOC", ".DOCX", ".RTF", ".DAT", ".PPTX", ".PPT", ".XLS", ".XLSX");

                    // Katsotaan, onko annetussa taulukossa tiedoston pääte.
                    // Jos ei ole, käytetään annettua päätettä ($turvapaate).
                    if (is_array($paatteet))
                        foreach ($paatteet as $paate) {
                            if (substr($nimi[$j], -strlen($paate)) == $paate) {
                                $turvapaate = $paate;
                                $paateloyty = true;
                                break;
                            }
                        }

                    // Jos $turvapaate puuttuu (eikä muuta löytynyt taulukosta), hylätään tiedosto.
                    if (!$paateloyty) {
                        throw new UploadException("Tiedostomuoto ei kelpaa! <br><br>Sallittuja tiedostopäätteitä ovat .txt, .pdf, .rar, .zip, .tnsp, .tns, .csv, .odt, .ods, .odp., .odg, .doc, .docx, .rtf, .dat, .pptx, .ppt, .xls, .xlsx");
                    }

                    // Luodaan tiedostolle turvallinen nimi ja tallennetaan tiedosto.
//    $nimi2 = preg_replace("/[^A-Z0-9._-]/i", "_",  $nimi[$j]);
                    $nimi2 = $nimi[$j];
                    if (strlen($turvapaate) && substr($nimi2, -strlen($turvapaate)) !== $paate) {
                        $nimi2 .= $paate;
                    }
                    // don't overwrite an existing file
                    $i = 0;
                    $parts = pathinfo($nimi2);
                    $kohde = "tiedostot/" . $nimi2;
                    while (file_exists($kohde)) {

                        $i++;
                        $nimi2 = $parts["filename"] . "(" . $i . ")." . $parts["extension"];
                        $kohde = "tiedostot/" . $nimi2;
                    }

                    $kohde = "tiedostot/" . $nimi2;
                    if (!file_exists($kohde)) {
                        // Tarkistetaan kirjoitusoikeus.
                        if (!is_writeable(dirname($kohde)) || (file_exists($kohde) && !is_writeable($kohde))) {
                            throw new UploadException("Virhe tiedoston kopioinnissa, ei kirjoitusoikeutta!" . $kohde);
                        }

                        // Yritetään kopioida tiedosto paikalleen.
                        if (!@move_uploaded_file($myFile["tmp_name"][$j], $kohde)) {
                            $virhe = error_get_last();
                            throw new UploadException("Virhe tiedoston kopioinnissa: {$virhe["message"]}!");
                        }

                        $db->query("insert into tiedostot (kansio_id) values('" . $_POST[kid] . "')");

                        if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $_POST[kid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }


                        while ($rowt = $haetiedostot->fetch_assoc()) {
                            $id = $rowt[id];
                            echo'<br>id: ' . $id;
                        }

//nimi, kohde = vanha, nimi
                        $db->query("update tiedostot set nimi='" . $kohde . "' where id = '" . $id . "'");
                        $db->query("update tiedostot set omatallennusnimi='" . $nimi[$j] . "' where id = '" . $id . "'");
                    }


                    //kaikki tiedostot kiinni
                }
            } catch (UploadException $e) {

                die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href="lisaaopetiedosto.php?kid=' . $_POST[kid] . '"><p style="font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
        }



//        header("location: tiedostot.php?k=" . $_POST[kid]);
        echo'</div>';
        echo'</div>';
        echo'</div>';




include("footer.php");
?>

</body>
</html>	

</body>
</html>	
