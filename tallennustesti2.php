<?php

       
            if(isset($_POST['submit'])){
            include("yhteys.php");
            if(isset($_POST['boxes'])){
         
            $valinnat = implode(',', $_POST['boxes']);
            $success = $db->query("insert into boxes (time) values ('" . $valinnat . "')");
                
                if(!$success){
                    echo "<p> Virhe lisäämisessä! </p>";
                    echo'<br>';
                      echo("<p>Virheen kuvaus: " . $db -> error."</p>");
                }
          }

        }


