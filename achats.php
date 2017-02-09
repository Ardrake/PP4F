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
                <h3>Achats de cours</h3>
                <?php
                $conn = db_connect();
                $carteErr = $anneeErr = $moisErr = "";
                $carte = $mois = $annee = "";
                $valide = TRUE;
                
                if (isset($_GET['idcour'])){
                    $courseid = $_GET['idcour'];
                    $_SESSION['coursAchat'] = $_GET['idcour'];
                } else {
                    $courseid = $_SESSION['coursAchat'];
                }
                
                
                if (check_admin_user() == 1){
                    //affiche_navigation('magister');   
                }
                else if (check_user() == 1){
                    $myStudent = getMyStudent($_SESSION['valid_user']);
                    $studentid = $myStudent->StudentID;
                    $sql = "SELECT * FROM courses 
                            WHERE CourseID ='".$courseid."'";
                    $result = mysqli_query($conn,$sql);  
                    $num_rows = mysqli_num_rows($result); 
                    }

                     while($row = mysqli_fetch_array($result)) {
                        $myCours = new Cours($row['CourseID'], $row['CourseName'], $row['Price'], $row['Tutor']);
                        echo "<h4>".$myCours->id." - ".$myCours->nom." - ".$myCours->getCout()."$</h4>";
                        echo "<br>";
                    }
                    
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST["carte"])) {
                      $carteErr = "la carte est requis";
                      $valide = FALSE;
                    } else {
                      $carte = test_input($_POST["carte"]);
                      // Validé la carte
                    if (!is_numeric($carte)) {
                        $carteErr = "seul des numéro sont permis";
                        $valide = FALSE;
                    } else {
                    if (strlen($carte)!=16 ) {
                        $carteErr = "le numéro de carte doit avoir 16 chiffre)";
                        $valide = FALSE;
                      }
                    }
                    
                    if (empty($_POST["mois"])) {
                      $moisErr = "le mois d'expiration est requis";
                      $valide = FALSE;
                    } else {
                      $mois = test_input($_POST["mois"]);
                      // Validé la carte
                      
                        if (!is_numeric($mois)) {
                            $moisErr = "seul des numéro sont permis";
                            $valide = FALSE;
                        } else {
                        if (strlen($mois)!=2 ) {
                            $moisErr = "le mois doit avoir 2 chiffre)";
                            $valide = FALSE;
                                } else {
                                    if ($mois > 12){
                                        $moisErr = "le mois doit plus petit que 12)";
                                        $valide = FALSE;
                                }
                            }
                        } 
                    }

                     if (empty($_POST["annee"])) {
                      $anneeErr = "l'annee d'expiration est requis";
                      $valide = FALSE;
                    } else {
                      $annee = test_input($_POST["annee"]);
                      // Validé la carte
                    if (!is_numeric($annee)) {
                        $anneeErr = "seul des numéro sont permis";
                        $valide = FALSE;
                    } else {
                    if (strlen($annee)!=2 ) {
                        $anneeErr = "l'annee doit avoir 2 chiffre)";
                        $valide = FALSE;
                            } else {
                                if ($annee < 16){
                                    $anneeErr = "l'annee doit etre superieur ou égale a 2016 (16))";
                                }
                            }
                        } 
                      } 
                   }
                 }
                else {
                    $valide = FALSE;
                    }

                if ($valide) {
                    // insere user dans la Base de donnée ici
                    //echo "is valide";
                    $conn = db_connect();
                    mysqli_set_charset($conn,"utf8");
                    mysqli_select_db($conn, "mescours");  
                    
                    $myStudent->ajouteCours($myCours);
                    $spAchat = "CALL achatCours ('".$myStudent->StudentID."','".$myCours->id."')";
            
                    if (!mysqli_query($conn,$spAchat)) {
                        die('Error: achat');
                    } else {
                        echo "achat reussi";
                        header('Location: index.php');
                    }
                }
                ?>
                <hr>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <input style='width: 140px;' type="text" name="carte" value="<?php echo $carte;?>">
                        Numéro de carte de crédit (16 chiffres): <span class="error">* <?php echo $carteErr;?></span> 
                        <br>
                        
                        <input style='width: 40px;' type="text" name="mois" value="<?php echo $mois;?>">
                        Mois d'expiration (exemple 02) <span class="error">* <?php echo $moisErr;?></span>
                        <br>

                        <input style='width: 40px;' type="text" name="annee" value="<?php echo $annee;?>">
                        Année d'expiration (exemple 18) <span class="error">* <?php echo $anneeErr;?></span> <br>
                        <br>
                        
                        <br><input type="submit" name="submit" value="Achat"> 
                    </form>
            </div>
        </div>
    </body>
</html>
