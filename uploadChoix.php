<html>
	<head>
            <meta charset="utf-8" />
            <title>Upload Image</title>
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
        $idjeux = "1101"
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
                 
                 if (isset($_GET['idjeux'])){
                    $jeuxid = $_GET['idjeux'];
                    $_SESSION['jeuxAchat'] = $_GET['idjeux'];
                } else {
                    $jeuxid = $_SESSION['coursAchat'];
                }
            ?>
                <h3>Téléchargement d'image de jeux</h3>
                <hr>
         
                <?php
                echo $jeuxid;
                echo "<form action='fichierRecu.php?idcour=".$jeuxid."'"."method='post' enctype='multipart/form-data'>"
                ?>
                    Choisir un fichier a téléchargé:
                <form>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                </form>
            </div>