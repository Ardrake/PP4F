<html>
	<head>
            <meta charset="utf-8" />
            <title>Jeux d'enfant ACME</title>
            <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	</head>
        <?php

        require_once('fonction.php');
        require_once('ClassMesJeux.php');
        require_once('Navigation.php');
        session_start();
        
        
        if(check_admin_user()){
            echo '<p><b><font size="4">Bonjour '.$_SESSION['admin_user'].'</font></b></p>';
            //show_nav_menu();
        }
        if(check_user()){
            $myClient = getMyClient($_SESSION['valid_user']);
            echo '<p><b><font size="4">Bonjour '.$myClient->FirstName.'</font></b></p>';
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
                  <h1 class="title">Jeux d'enfant ACME</h1>
                <h2>- Le pouvoir des connaissances</h2>
              </div>
            </div>
                    
            <div id="main">
                <div id="content">
                    <?php
                     if (check_admin_user() == 1){
                         //affiche_navigation('proprio');  
                         header('Location: Proprio.php');
                     }
                     else if (check_user() == 1){
                        header('Location: Client.php');
                        //affiche_navigation('user');
                     }
                     else {
                         affiche_navigation('guest'); 
                     }
                    ?>
                    <div id="left">
                        <div class="article">
                            <h3>Bienvenue à Jeux d'enfant ACME</h3>
                            <ul>
                                <li>Tu peux jouer à des jeux demo gratuits. Il y a des jeux pour toute la famille. </li>
                                <li>Si tu aime le jeux tu peut demandé a tes parents de te procurer le jeux au complet </li>
                            </ul>
                            <br>
                            <h2>Veuillez vous connectez ou vous inscrire pour avoir acces a vos jeux.</h2>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-8 center-block" >
                <?php
                    include 'sondage.php';
                ?>
            </div>                
            <hr>
            <div class="col-md-10">
                <?php
                    /* Compteur */
                    $datei = fopen("assets/compteur.txt","r");
                    $count = fgets($datei,1000);
                    fclose($datei);
                    $count=$count + 1 ;

                    echo "<center>Jeux d'enfant ACME - $count visiteurs </center>" ;

                    $datei = fopen("assets/compteur.txt","w");
                    fwrite($datei, $count);
                    fclose($datei);
                ?>
            </div>
        </body>
</html>
