<html>
	<head>
            <meta charset="utf-8" />
            <title>Mes Cours en Ligne</title>
            <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	</head>
        <?php

        require_once('fonction.php');
        require_once('ClassMesCours.php');
        require_once('Navigation.php');
        session_start();
        
        if(check_admin_user()){
            echo '<p><b><font size="4">Bonjour '.$_SESSION['admin_user'].'</font></b></p>';
            //show_nav_menu();
        }
        if(check_user()){
            $myStudent = getMyStudent($_SESSION['valid_user']);
            echo '<p><b><font size="4">Bonjour '.$myStudent->FirstName.'</font></b></p>';
        }
        ?>
        <body>
            <div id="top"> 
                <?php 
                   display_login_form();
                ?> 
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
                         //affiche_navigation('magister');  
                         header('Location: Magister.php');
                     }
                     else if (check_user() == 1){
                        header('Location: Etudiant.php');
                        //affiche_navigation('user');
                     }
                     else {
                         affiche_navigation('guest'); 
                     }
                    ?>
                    <div id="left">
                        <div class="article">
                            <h3>Bienvenue a Mes Cours en ligne</h3>
                            <ul>
                                <li>Un accès 24/7 de n’importe quel ordinateur connecté à internet </li>
                                <li>Réduit jusqu’à 75 % le temps de formation (1 jour en classe = 2 h à 3 h en ligne)  </li>
                                <li>Mises à jour et maintien du contenu facile </li>
                                <li>Disponible en temps voulu </li>
                            </ul>
                            <br>
                            <h2>Veuillez vous connectez ou vous inscrire pour avoir acces a vos cours.</h2>
                            
                        </div>
                    </div>
                </div>
            </div>
        </body>
</html>
