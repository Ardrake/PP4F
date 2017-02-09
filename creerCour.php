<html>
	<head>
            <meta charset="utf-8" />
            <title>Créer cours</title>
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

         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["id"])) {
              $idErr = "le id est requis";
              $valide = FALSE;
            } else{
                $id = test_input($_POST["id"]);
            }
            
             if (empty($_POST["nom"])) {
              $nomErr = "le nom du cours est requis";
              $valide = FALSE;
            } else {
                $nom = test_input($_POST["nom"]);
            }
            
             if (empty($_POST["prix"])) {
              $prixErr = "l'usager est requis";
              $valide = FALSE;
            } else {
                $prix = test_input($_POST["prix"]);
            }
            
             if (empty($_POST["tuteur"])) {
              $tuteurErr = "le tuteur est requis";
              $valide = FALSE;
            } else {
                $tuteur = test_input($_POST["tuteur"]);
            }
         }
         else {
              $valide = FALSE;
         }
        
        
        if ($valide) {
            
            $spCour = "CALL InsereCour ('".$id."','".$nom."','".$prix."','".$tuteur."')";
            //echo $spCour;
            if (!mysqli_query($conn,$spCour)) {
              die('Error: cours insertion ');
              }
              else {
                mkdir("assets/cours/".$id."/");
                header('Location: uploadMat.php');
            }
        }
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
            ?>
                <h3>Création fiche de cours en ligne</h3>
                <hr>
                <h4>Information</h4>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    Numéro du cours (4 chiffres): <span class="error">* <?php echo $idErr;?></span> <br>
                    <input style='width: 50px;' type="text" name="id" value="<?php echo $id;?>">
                    <br>

                    Nom du cours <span class="error">* <?php echo $nomErr;?></span> <br>
                    <input style='width: 400px;' type="text" name="nom" value="<?php echo $nom;?>"><br>
                    <br>

                    Prix <span class="error">* <?php echo $prixErr;?></span> <br>
                    <input style='width: 50px;' type="text" name="prix" value="<?php echo $prix;?>"><br>
                    <br>
                    
                    Tuteur <span class="error">* <?php echo $tuteurErr;?></span> <br>
                    <input style='width: 150px;' type="text" name="tuteur" value="<?php echo $tuteur;?>"><br>
                    <br>
                    <br><input type="submit" name="submit" value="Créer"> 
                </form>
            </div>
        </div>
    </body>
</html>
