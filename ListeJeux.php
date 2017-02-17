<html>
	<head>
            <meta charset="utf-8" />
            <title>Liste des Jeux</title>
            <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	</head>
        <?php

        require_once('fonction.php');
        require_once('ClassMesJeux.php');
        require_once('Navigation.php');
        session_start();
        
        $conn = db_connect();
       
        mysqli_set_charset($conn,"utf8");

        $sql = "SELECT * FROM `jeux`";
        if ($sql === FALSE) {
           echo 'Echec de la requete ';
        }
        else {
           $result = mysqli_query($conn,$sql);  
           $num_rows = mysqli_num_rows($result); 
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
                 }
                 else if (check_user() == 1){

                     affiche_navigation('user');
                 }
                 else {
                     affiche_navigation('guest'); 
                 }
                ?>
                    <div id="left">
                        <div class="article">
                            <h3>La liste des jeux offert</h3>
                            <hr>
                               <?php
                                if (check_admin_user() == 1){
                                    //affiche_navigation('proprio');   
                                }
                                else if (check_user() == 1){
                                    $myClient = getMyClient($_SESSION['valid_user']);
                                    $clientid = $myClient->ClientID;
                                    //affiche  cours du user;
                                    ?>
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
                                                                . "<td style='width: 200px;'>".$prix."</td>"
                                                                 ."<td> <input type=button onClick=".'"'."location.href='achats.php?idjeux=".$jeuxid."'".'"'."value='Achetez'></td>"
                                                                ."<td> <input type=button onClick=".'"'."location.href='demojeux.php?idjeux=".$jeuxid."'".'"'."value='Demo'></td>"
                                                            . "</tr>";
                                                }
                                                echo "</table>";
                                                ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                <br>
                                <br>
                                <h3>La liste des jeux déja à votre compte</h3>
                                <hr>
                               <table>
                                        <thead>
                                            <tr>
                                                <th><?php 
                                                    $mesJeux = $myClient->getJeux();
                                                    foreach ($mesJeux as $row) {
                                                        $jeuxid = $row->id;
                                                        $jeuxnom = $row->nom;
                                                        $prix = $row->getCout();

                                                        echo "<tr><td style='width: 200px; ' >".$jeuxid."</td>"
                                                                . "<td style='width: 600px;'>".$jeuxnom."</td>"
                                                                . "<td style='width: 200px;'>".$prix."</td>"
                                                                ."<td> <input type=button onClick=".'"'."location.href='jeux.php?idjeux=".$jeuxid."'".'"'."value='Mon jeux'></td>"
                                                                ."<td> <input type=button onClick=".'"'."location.href='demojeux.php?idjeux=".$jeuxid."'".'"'."value='Demo'></td>"
                                                            . "</tr>";
                                                }
                                                echo "</table>";
                                                ?></th>
                                            </tr>
                                        </thead>
                                    </table>

                                 <?php
                                   }
                                // affiche liste de jeux pour guest
                                else {
                                    $sql = "SELECT * FROM `jeux`";
                                    $result = mysqli_query($conn,$sql);  
                                    $num_rows = mysqli_num_rows($result); 
                                    ?>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th><?php 
                                                while($row = mysqli_fetch_array($result)) {
                                                        $jeuxid = $row['JeuxID'];
                                                        $jeuxnom = $row['JeuxNom'];
                                                        $prix = $row['Prix'];
                                                        echo "<tr><td style='width: 200px;'>".$jeuxid."</td><td style='width: 600px;'>".$jeuxnom."</td><td> <input type=button onClick=".'"'."location.href='demojeux.php?idjeux=".$jeuxid."'".'"'."value='Demo'></td><td>".$prix."</td></tr>";
                                                }
                                                echo "</table>";
                                                ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                 <?php }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </body>
</html>