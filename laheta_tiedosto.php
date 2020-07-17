<?php
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> TIEDOSTON LÄHETYS </title>';
include("tietokantayhteys.php");
require_once("tiedoston_lahetys.php");

session_start(); // ready to go!

if (isset($_FILES['tiedostot'])) {

    $tiedostot = $_FILES['tiedostot'];

        
    try {


        $nimi = upload_tarkista('tiedostot', 20.0 * 1024 * 1024);

        $koko = count($nimi);
     
        $paateloyty = false;

        for ($j = 0; $j < $koko; $j++) {

            $paatteet = array(".txt", ".pdf", ".rar", ".zip", ".csv", ".odt", ".ods", ".odg", "odp", ".tnsp", ".tns", ".doc", ".docx", ".rtf", ".dat", ".pptx", ".ppt", ".xls", ".xlsx", ".TXT", ".PDF", ".DOC", ".DOCX", ".RTF", ".DAT", ".PPTX", ".PPT", ".XLS", ".XLSX");

            // Katsotaan, onko annetussa taulukossa tiedoston pääte.

            if (is_array($paatteet))
                foreach ($paatteet as $paate) {
                    if (substr($nimi[$j], -strlen($paate)) == $paate) {
                        $turvapaate = $paate;
                        $paateloyty = true;
                        break;
                    }
                }

            // Jos pääte puuttuu, hylätään tiedosto.
            if (!$paateloyty) {
                throw new UploadException("Tiedostomuoto ei kelpaa! <br><br>Sallittuja tiedostopäätteitä ovat .txt, .pdf, .rar, .zip, .tnsp, .tns, .csv, .odt, .ods, .odp., .odg, .doc, .docx, .rtf, .dat, .pptx, .ppt, .xls, .xlsx");
            }

            // Luodaan tiedostolle turvallinen nimi ja tallennetaan tiedosto.

            $nimi2 = $nimi[$j];
            if (strlen($turvapaate) && substr($nimi2, -strlen($turvapaate)) !== $paate) {
                $nimi2 .= $paate;
            }

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
                if (!@move_uploaded_file($tiedostot["tmp_name"][$j], $kohde)) {
                    $virhe = error_get_last();
                    throw new UploadException("Virhe tiedoston kopioinnissa: {$virhe["message"]}!");
                }

             

                //tallennus
                $lisays = $yhteys->prepare("INSERT INTO tiedostot (kohde, omatallennusnimi) VALUES (?, ?)");

                if (!$lisays) {
                    die('<p>Tietokantalisäyksessä virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error) . '</p>');
                }

                $lisays->bind_param("ss", $kohde, $nimi[$j]);



                if (!$lisays->execute()) {
                    die('<p>Tietokantahaussa virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($lisays->error) . '</p>');
                }
            }


            //kaikki tiedostot kiinni
        }
    } catch (UploadException $e) {

        die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href="tiedoston_lisays.php"><p style="font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    
        header("location: tiedosto_lisatty.php");
}
else{
         echo'<p>Et lisännyt tiedostoa! </p>
              <p><a href="tiedoston_lisays.php"> &#8617 &nbsp Palaa takaisin </a></p> ';
}

echo'</div>';
echo'</div>';
echo'</div>';




include("footer.php");
?>

</body>
</html>	

</body>
</html>	
