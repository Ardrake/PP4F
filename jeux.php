<!DOCTYPE html>
<!--
affiche les détails du jeux 
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mes Jeux</title>
         <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
          <div id="top"> 
        </div>
        <div id="banner">
         
            <div class="title_tagline">
                <h1 class="title">Jeux d'enfant ACME</h1>
              <h2>- Le pouvoir des connaissances</h2>
            </div>
        </div>
        
        <div id="main">
            <div id="content">
                <?php
                require_once('fonction.php');
                require_once('ClassMesJeux.php');
                require_once('Navigation.php');
                session_start();
                $conn = db_connect();

                $jeuxid = $_GET['idjeux'];
                if (check_admin_user() == 1){
                    //affiche_navigation('proprio');   
                }
                else if (check_user() == 1){

                    affiche_navigation('user');
                    $myClient = getMyClient($_SESSION['valid_user']);
                    $clientid = $myClient->ClientID;
                    $sql = "SELECT * FROM jeux 
                            WHERE JeuxID ='".$jeuxid."'";
                    $result = mysqli_query($conn,$sql);  
                    $num_rows = mysqli_num_rows($result); 
                    }

                     while($row = mysqli_fetch_array($result)) {
                        $jeuxid = $row['JeuxID'];
                        $jeuxnom = $row['JeuxNom'];

                        echo "<h3>".$jeuxid." - ".$jeuxnom."</h3><hr>";
                        
                    }
                    $files = getMaterielJeux(dirname(__FILE__)."\\assets\jeux\\".$jeuxid."\\"); 
                    //var_dump($files);
                    ?>
                <table>
                    <thead>
                        <tr>
                            <th><?php 
                                $lesJeux = $files;
                                $totfiles = count($lesJeux)-1;

                                for ($x = 2; $x <= $totfiles; $x++) {
                                    $matid = $lesJeux[$x];
                                    echo "<tr><td style='width: 200px; ' ><a href=assets\\jeux\\$jeuxid\\$matid>".$matid."</td></tr>";
                            }
                            echo "</table>";
                            ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </body>
</html>
