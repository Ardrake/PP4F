<?php
function affiche_navigation($type) {
    if ($type == "proprio"){?>
        <div id="right">
          <?php echo '<p><b><font size="4">Bonjour Proprio</font></b></p>';?>
          <ul id="nav">
            <li><a href="Proprio.php">Gestion</a></li>
            <li><a href="creerJeux.php">Inseré un Jeux</a></li>
            <li><a href="uploadMat.php">Téléverser image de jeux</a></li>
            <li><a href="LogOff.php">Deconnexion</a></li>
          </ul>
        </div>
        <?php
    }
      if ($type == "user"){
        ?>
        <div id="right">
          <?php echo '<p><b><font size="4">Bonjour '.$_SESSION['myClient']->FirstName.'</font></b></p>';?>
          <ul id="nav">
            <li><a href="Client.php">Mon Compte</a></li>
            <!--<li><a href="index.php">Accueil</a></li>-->
            <li><a href="ListeJeux.php">Jeux Offert</a></li>
            <!--<li><a href="achats.php">Achat de jeux</a></li>-->
            <li><a href="LogOff.php">Deconnexion</a></li>
          </ul>
        </div>
        <?php
    }
         if ($type == "guest"){
        ?>
        <div id="right">
          <?php echo '<p><b><font size="4">Bonjour</font></b></p>';?>
          <ul id="nav">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="ListeJeux.php">Jeux Offert</a></li>
            <li><a href="Enregistrement.php">Enregistrement</a></li>
          </ul>
        </div>
        <?php
    }
}
?>

