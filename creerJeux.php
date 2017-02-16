<html>
	<head>
            <meta charset="utf-8" />
            <title>Créer Jeux</title>
            <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	</head>
        <?php

        require_once('fonction.php');
        require_once('ClassMesJeux.php');
        require_once('Navigation.php');
        session_start();
        
        $conn = db_connect();
        $idErr = $nomErr = $prixErr = "";
        $id = $nom = $prix = "";
        $valide = TRUE;

         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["id"])) {
              $idErr = "le id est requis";
              $valide = FALSE;
            } else{
                $id = test_input($_POST["id"]);
            }
            
             if (empty($_POST["nom"])) {
              $nomErr = "le nom du jeux est requis";
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
            
         }
         else {
              $valide = FALSE;
         }
        
        
        if ($valide) {
            
            $spJeux = "CALL InsereJeux ('".$id."','".$nom."','".$prix."')";
            echo $spJeux;
            if (!mysqli_query($conn,$spJeux)) {
              die('Error: jeux insertion ');
              }
              else {
                mkdir("assets/jeux/".$id."/");
                header('Location: uploadMat.php');
            }
        }
        ?>
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
                if (check_admin_user() == 1){
                 affiche_navigation('proprio');
                  } else {
                 header('Location: index.php');
                 } 
            ?>
                <h3>Création fiche de jeux en ligne</h3>
                <hr>
                <h4>Information</h4>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    Numéro du jeux (4 chiffres): <span class="error">* <?php echo $idErr;?></span> <br>
                    <input style='width: 50px;' type="text" name="id" value="<?php echo $id;?>">
                    <br>

                    Nom du jeux <span class="error">* <?php echo $nomErr;?></span> <br>
                    <input style='width: 400px;' type="text" name="nom" value="<?php echo $nom;?>"><br>
                    <br>

                    Prix <span class="error">* <?php echo $prixErr;?></span> <br>
                    <input style='width: 50px;' type="text" name="prix" value="<?php echo $prix;?>"><br>
                    <br>
                    
                    <br><input type="submit" name="submit" value="Créer"> 
                </form>
            </div>
        </div>
    </body>
</html>
