<html>
	<head>
            <meta charset="utf-8" />
            <title>Mon Compte</title>
            <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	</head>
        <?php

        require_once('fonction.php');
        require_once('ClassMesCours.php');
        require_once('Navigation.php');
        session_start();
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
             if (check_user() == 1){
                 affiche_navigation('user');
                 $myStudent = getMyStudent($_SESSION['valid_user']);
             }
             else {
                 header('Location: index.php');
             }
            ?>
                <div id="left">
                    <div class="article">
                        <h3>Mon Compte Étudiant</h3>
                        <h4>Information</h4>
                        <hr>
                        
                        <?php 
                        echo "Prénom: <b>".$myStudent->FirstName."&nbsp;&nbsp;"."</b> Nom: <b>".$myStudent->LastName."</b></br>";
                        echo "Addresse: <b>".$myStudent->Address."&nbsp;&nbsp;"."</b> Ville: <b>".$myStudent->City."</b></br>";
                        echo "Province: <b>".$myStudent->Province."&nbsp;&nbsp;"."</b> Code Postal: <b>".$myStudent->PostalCode."</b></br>";
                        echo "Nom d'usager: <b>".$myStudent->UserName."&nbsp;&nbsp;"."</b> Couriel: <b>".$myStudent->EmailAddress."</b></br>";
                        ?>
                        <hr>
                        <br>
                        <h4>Mes Cours</h4>
                        <hr>
                        <table>
                            <thead>
                                <tr>
                                    <td style='width: 200px; ' >ID Cours</td>
                                    <td style='width: 600px;'>Titre</td>
                                    <td style='width: 200px;'>Tuteur</td>
                                </tr>
                            </thead>
                        </table>
                        <hr>
                        <table>
                            <thead>
                                <tr>
                                    <th><?php 
                                        $mesCours = $myStudent->getCours();
                                        foreach ($mesCours as $row) {
                                            $courseid = $row->id;
                                            $coursename = $row->nom;
                                            $tuteur = $row->tuteur;

                                            echo "<tr><td style='width: 200px; ' >".$courseid."</td>"
                                                    //. "<td style='width: 600px;'>".$coursename."</td>"
                                                    . "<td style='width: 600px;'><a href='cour.php?idcour=".$courseid."'>".$coursename."</td>"
                                                    . "<td style='width: 200px;'>".$tuteur."</td>"
                                                . "</tr>";
                                    }
                                    echo "</table>";
                                    ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </body>
</html>