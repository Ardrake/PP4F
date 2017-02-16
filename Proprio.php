<html>
	<head>
            <meta charset="utf-8" />
            <title>Gestion de la boutique</title>
            <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	</head>
        <?php

        require_once('fonction.php');
        require_once('ClassMesJeux.php');
        require_once('Navigation.php');
        session_start();
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
             }
            else {
                 header('Location: index.php'); 
             }
            ?>
                <div id="left">
                    <div class="article">
                        <h3>Gestion de la boutique</h3>
                        <p>Benvenue a la section reservé au Gestionnaire de boutique</p>
                    </div>
                </div>
            </div>
        </div>
        </body>
</html>


  