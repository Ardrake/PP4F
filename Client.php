<html>
	<head>
            <meta charset="utf-8" />
            <title>Mon Compte</title>
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
             if (check_user() == 1){
                 affiche_navigation('user');
                 $myClient = getMyClient($_SESSION['valid_user']);
                 
             }
             else {
                 header('Location: index.php');
             }
            ?>
                <div id="left">
                    <div class="article">
                        <h3>Mon Compte Client</h3>
                        <h4>Information</h4>
                        <hr>
                        
                        <?php 
                        echo "Prénom: <b>".$myClient->FirstName."&nbsp;&nbsp;"."</b> Nom: <b>".$myClient->LastName."</b></br>";
                        echo "Addresse: <b>".$myClient->Address."&nbsp;&nbsp;"."</b> Ville: <b>".$myClient->City."</b></br>";
                        echo "Province: <b>".$myClient->Province."&nbsp;&nbsp;"."</b> Code Postal: <b>".$myClient->PostalCode."</b></br>";
                        echo "Nom d'usager: <b>".$myClient->UserName."&nbsp;&nbsp;"."</b> Couriel: <b>".$myClient->EmailAddress."</b></br>";
                        ?>
                        <hr>
                        <br>
                        <h4>Mes Jeux</h4>
                        <hr>
                        <table>
                            <thead>
                                <tr>
                                    <td style='width: 200px; ' >ID Jeux</td>
                                    <td style='width: 600px;'>Nom</td>
                                </tr>
                            </thead>
                        </table>
                        <hr>
                        <table>
                            <thead>
                                <tr>
                                    <th><?php 
                                        $mesJeux = $myClient->getJeux();
                                        foreach ($mesJeux as $row) {
                                            $jeuxid = $row->id;
                                            $jeuxnom = $row->nom;

                                            echo "<tr><td style='width: 200px; ' >".$jeuxid."</td>"
                                                    . "<td style='width: 600px;'><a href='jeux.php?idjeux=".$jeuxid."'>".$jeuxnom."</td><td> <input type=button onClick=".'"'."location.href='demojeux.php?idjeux=".$jeuxid."'".'"'."value='Demo'></td>"
                                                . "</tr>";
                                    }
                                    echo "</table>";
                                    ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </body>
</html>