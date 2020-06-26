<?php

       
            if(isset($_POST['submit'])){
            include("yhteys.php");
            if(isset($_POST['boxes'])){
            $t1=implode(',', $_POST['boxes']);
            
            $success = $db -> query("insert into checkbox (time) values ('2am')"); 
             $db->query("insert into checkbox (time) values ('" . $t1 . "')");
                
                if($success){
                    echo "insert success";
                }else{
                    echo "error in inserting";
                    echo'<br>';
                      echo("Error description: " . $db -> error);
                }
          }

        }


