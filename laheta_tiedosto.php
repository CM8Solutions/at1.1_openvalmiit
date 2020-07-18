<?php
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> TIEDOSTON LÄHETYS </title>';
include("header.php");
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

            //jos on jo samanniminen tiedosto, lisätään perään merkki siitä
            while (file_exists($kohde)) {

                $i++;
                $nimi2 = $parts["filename"] . "(" . $i . ")." . $parts["extension"];

                $nimi[$j] = $nimi2;
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
                $lisays = $yhteys->prepare("INSERT INTO tiedostot (kohde, nimi) VALUES (?, ?)");

                if (!$lisays) {
                    throw new UploadException('Tietokantalisäyksessä virhe (prepare()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error));
                }

                $lisays->bind_param("ss", $kohde, $nimi[$j]);



                if (!$lisays->execute()) {
                    throw new UploadException('Tietokantalisäyksessä virhe (execute()-toiminto epäonnistui). <br>Syy: ' . htmlspecialchars($yhteys->error));
                }
            }


            //kaikki tiedostot kiinni
        }
        header("location: tiedosto_lisatty.php");
    } catch (UploadException $e) {
        echo' <body>
   <div style="border: 1px solid  #333333; margin-top: 20px; padding-bottom: 20px">
         
        <h2 style="color: red">Tiedoston lisäys epäonnistui! </h2>
        <p style="font-weight: bold">' . $e->getMessage() . '</p>
        <p><a href="tiedoston_lisays.php"> &#8617 &nbsp  Palaa takaisin </a></p>';

        echo'<div class="vali"></div>';
    }
}
//else{
//         echo'<p>Et lisännyt tiedostoa! </p>
//              <p><a href="tiedoston_lisays.php"> &#8617 &nbsp Palaa takaisin </a></p> ';
//}

echo'</div>';
echo'</div>';
echo'</div>';




include("footer.php");
?>

</body>
</html>	

</body>
</html>	
