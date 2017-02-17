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
        $idjeux= "1101"
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
                 
                if (isset($_GET['message'])){
                 $message = $_GET['message'];
                } else {
                    $message = "";
                }
            ?>
                <h3>Téléchargement d'image de Jeux</h3>
                <hr>
                
                <table>
                    <thead>
                        <tr>
                            <th><?php 
                                $mesJeux = getAllJeux();
                                foreach ($mesJeux as $row) {
                                    $jeuxid = $row->id;
                                    $jeuxnom = $row->nom;
                                    $prix = $row->getCout();

                                    echo "<tr><td style='width: 200px; ' >".$jeuxid."</td>"
                                            . "<td style='width: 600px;'>".$jeuxnom."</td>"
                                             ."<td> <input type=button onClick=".'"'."location.href='uploadChoix.php?idjeux=".$jeuxid."'".'"'."value='Choisir'></td>"
                                        . "</tr>";
                            }
                            echo "</table>";
                            ?></th>
                        </tr>
                    </thead>
                </table>
                <h3><?php echo $message; ?> </h3>
            </div>
        </div>
    </body>
</html>