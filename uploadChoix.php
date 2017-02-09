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
                 
                 if (isset($_GET['idcour'])){
                    $courseid = $_GET['idcour'];
                    $_SESSION['coursAchat'] = $_GET['idcour'];
                } else {
                    $courseid = $_SESSION['coursAchat'];
                }
            ?>
                <h3>Téléchargement de matériel de cours</h3>
                <hr>
         
                <?php
                echo $courseid;
                echo "<form action='fichierRecu.php?idcour=".$courseid."'"."method='post' enctype='multipart/form-data'>"
                ?>
                    Choisir un fichier a téléchargé:
                <form>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                </form>
            </div>