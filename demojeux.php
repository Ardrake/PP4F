<!DOCTYPE html>
<!--
affiche les détails du jeux demo
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Demo</title>
         <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>
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
                require_once('Navigation.php');
                session_start();

                $jeuxid = $_GET['idjeux'];

                if ($jeuxid == '4101'){
                    header('Location: ferme.php');
                    
                }
                else {
                    
                    header('Location: construction.php');
                }
                ?>
                
            </div>
        </div>
    </body>
</html>