<html>
	<head>
            <meta charset="utf-8" />
            <title>Upload Materiel</title>
            <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	</head>
        <?php

        require_once('fonction.php');
        require_once('ClassMesCours.php');
        require_once('Navigation.php');
        session_start();
        
        $conn = db_connect();
        $idErr = $nomErr = $prixErr = $tuteurErr = "";
        $id = $nom = $prix = $tuteur = "";
        $valide = TRUE;
        $idcours = "1101"
        ?>
        <body>
            
        <div id="top"> 
        </div>
        <div id="banner">
         
            <div class="title_tagline">
                <h1 class="title">Mes Cours Enligne</h1>
              <h2>- Le pouvoir des connaissances</h2>
            </div>
        </div>
            
        <div id="main">
            <div id="content">
            <?php
                if (check_admin_user() == 1){
                 affiche_navigation('magister');
                  } else {
                 header('Location: index.php');
                 } 
                 
                if (isset($_GET['message'])){
                 $message = $_GET['message'];
                } else {
                    $message = "";
                }
            ?>
                <h3>Téléchargement de matériel de cours</h3>
                <hr>
                
                <table>
                    <thead>
                        <tr>
                            <th><?php 
                                $mesCours = getAllCourses();
                                foreach ($mesCours as $row) {
                                    $courseid = $row->id;
                                    $coursename = $row->nom;
                                    $price = $row->getCout();

                                    echo "<tr><td style='width: 200px; ' >".$courseid."</td>"
                                            . "<td style='width: 600px;'>".$coursename."</td>"
                                             ."<td> <input type=button onClick=".'"'."location.href='uploadChoix.php?idcour=".$courseid."'".'"'."value='Choisir'></td>"
                                        . "</tr>";
                            }
                            echo "</table>";
                            ?></th>
                        </tr>
                    </thead>
                </table>
                <h3><?php echo $message; ?> </h3>
            </div>
        </div>
    </body>
</html>