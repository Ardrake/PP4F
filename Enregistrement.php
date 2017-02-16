<!DOCTYPE html>
<!--
enregistrement nouvelle  usager
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enregistrement</title>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
        require_once('fonction.php');
        require_once('ClassMesJeux.php');
        require_once('Navigation.php');
        
        session_start();
        // definir les variable et initialisé leur contenu
       $nomErr = $prenomErr = $adsresseErr = $villeErr = $provinceErr = $codepostal = $usager = $mypassword = "";
       $nom = $prenom = $province = $ville = $addresse = $couriel = $cpErr = $courielErr = $userErr = $passwordErr = "";
       $valide = TRUE;
       
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["nom"])) {
              $nomErr = "le nom est requis";
              $valide = FALSE;
            } else {
              $nom = test_input($_POST["nom"]);
              // Validé le nom
              if (!preg_match("/[\w\p{L}\p{N}\p{Pd}]/u",$nom)) {
                $nomErr = "Seulement des lettre et espace sont permis";
                $valide = FALSE;
              }
            }
             if (empty($_POST["prenom"])) {
              $prenomErr = "le prenom est requis";
              $valide = FALSE;
            } else {
              $prenom = test_input($_POST["prenom"]);
              // Validé le prenom
              if (!preg_match("/[\w\p{L}\p{N}\p{Pd}]/u",$prenom)) {
                $prenomErr = "Seulement des lettre et espace sont permis";
                $valide = FALSE;
              }
            }
            
             if (empty($_POST["usager"])) {
              $userErr = "l'usager est requis";
              $valide = FALSE;
            } else {
              $usager = test_input($_POST["usager"]);
              // Validé le prenom
              if (!preg_match("/[\w\p{L}\p{N}\p{Pd}]/u",$usager)) {
                $userErr = "Seulement des lettre et espace sont permis";
                $valide = FALSE;
              }
            }
            
             if (empty($_POST["addresse"])) {
              $adsresseErr = "l'addresse est requis";
              $valide = FALSE;
            } else {
              $addresse = test_input($_POST["addresse"]);
              // Validé le prenom
              if (!preg_match("/[\w\p{L}\p{N}\p{Pd}]/u",$addresse)) {
                $adsresseErr = "Seulement des lettre et espace sont permis";
                $valide = FALSE;
              }
            }
            
             if (empty($_POST["ville"])) {
              $villeErr = "la ville est requis";
              $valide = FALSE;
            } else {
              $ville = test_input($_POST["ville"]);
              // Validé le prenom
              if (!preg_match("/[\w\p{L}\p{N}\p{Pd}]/u",$ville)) {
                $villeErr = "Seulement des lettre et espace sont permis";
                $valide = FALSE;
              }
            }
            
             if (empty($_POST["province"])) {
              $provinceErr = "la province est requis";
              $valide = FALSE;
            } else {
              $province = test_input($_POST["province"]);
              // Validé le prenom
              if (!preg_match("/[\w\p{L}\p{N}\p{Pd}]/u",$province)) {
                $provinceErr = "Seulement des lettre et espace sont permis";
                $valide = FALSE;
              }
            }
            
             if (empty($_POST["codepostal"])) {
              $cpErr = "le code postal est requis";
              $valide = FALSE;
            } else {
              $codepostal = test_input($_POST["codepostal"]);
              // Validé le codepostal
              if (!preg_match("/[\w\p{L}\p{N}\p{Pd}]/u",$codepostal)) {
                $cpErr = "Seulement des lettre et espace sont permis";
                $valide = FALSE;
              }
            }
            
              if (empty($_POST["couriel"])) {
              $courielErr = "le couriel est requis";
              $valide = FALSE;
            } else {
              $couriel = test_input($_POST["couriel"]);
              // Validé le couriel
              if (!preg_match("/[\w\p{L}\p{N}\p{Pd}]/u",$couriel)) {
                $courielErr = "Seulement des lettre et espace sont permis";
                $valide = FALSE;
              }
            }
              if (empty($_POST["_mypassword"])) {
              $passwordErr = "le mot de passe est requis";
              $valide = FALSE;
            } else {
              $mypassword = test_input($_POST["_mypassword"]);
              // Validé le couriel
              if (!preg_match("/[\w\p{L}\p{N}\p{Pd}]/u",$couriel)) {
                $passwordErr = "Seulement des lettre et espace sont permis";
                $valide = FALSE;
              }
            }
         }
        else {
            $valide = FALSE;
            }
            
        if ($valide) {
            // insere user dans la Base de donnée 
            $conn = db_connect();

            mysqli_set_charset($conn,"utf8");
            mysqli_select_db($conn, "acmejeux");

            $spGetid = "SELECT `ClientID` FROM `client` ORDER BY `ClientID` DESC LIMIT 1 ";
            $newid = mysqli_query($conn,$spGetid) ;
            if ($newid->num_rows>0) {
                 //echo "record trouvé";
                    $row = $newid->fetch_assoc();
                    $stringcurrentid = $row["ClientID"];
            }
            $newidval = intval ($stringcurrentid) + 1;
            
            $_id = strval ($newidval);
            $_password = $mypassword;
            
            $spUser = "CALL insereUser ('".$usager."','".$_password."')";
            
            $sp = "CALL insereClient('".$_id."','".$nom."','".$prenom."','".$addresse.
                    "','".$ville."','".$province."','".$codepostal."','".$couriel."','".$usager."')";
            
            if (!mysqli_query($conn,$spUser)) {
              die('Error: user insert');
              }
              else {
                  if (!mysqli_query($conn,$sp)){
                    die('Error: Client insert');
                  }
                    else {
                        login($usager, $_password);
                        header('Location: index.php');
                    }
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
                  <?php affiche_navigation('guest');?>
                  <div id="left">
                    <div class="article">
                        Enregistrment <span class="error">* champs obligatoire.</span>
                        <hr>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            Nom: <span class="error">* <?php echo $nomErr;?></span> 
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
                            Prénom: <span class="error">* <?php echo $prenomErr;?></span>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            Usager: <span class="error">* <?php echo $userErr;?></span> <br>
                            <input style='width: 140px;' type="text" name="nom" value="<?php echo $nom;?>">
                            <input style='width: 140px;' type="text" name="prenom" value="<?php echo $prenom;?>">
                            &emsp;&emsp;&emsp;
                            <input style='width: 120px;' type="text" name="usager" value="<?php echo $usager;?>"><br>
                            Addresse: <span class="error">* <?php echo $adsresseErr;?></span><br>
                            <input style='width: 350px;' type="text" name="addresse" value="<?php echo $addresse;?>"><br>
                            Ville: <span class="error">* <?php echo $villeErr;?></span> 
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                             Province: <span class="error">* <?php echo $provinceErr;?></span><br> 
                            <input style='width: 320px;' type="text" name="ville" value="<?php echo $ville;?>">&emsp;
                            <input style='width: 110px;' type="text" name="province" value="<?php echo $province;?>"><br>
                            Code Postal: <span class="error">* <?php echo $cpErr;?></span> <br>
                            <input style='width: 100px;' type="text" name="codepostal" value="<?php echo $codepostal;?>"><br>
                            Couriel: <span class="error">* <?php echo $courielErr;?></span> <br>
                            <input style='width: 400px;' type="text" name="couriel" value="<?php echo $couriel;?>"><br>
                            Mot de passe: <span class="error">* <?php echo $passwordErr;?></span> <br>
                            <input style='width: 100px;' type="password" name="_mypassword" value="<?php echo $mypassword;?>"><br>
                            
                            <br><input type="submit" name="submit" value="Envoyez"> 
                        </form>
                    </div>
                  </div>
              </div>
          </div>
    </body>
</html>
