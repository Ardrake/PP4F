<?php
function affiche_navigation($type) {
    if ($type == "magister"){?>
        <div id="right">
          <?php echo '<p><b><font size="4">Bonjour Magister</font></b></p>';?>
          <ul id="nav">
            <li><a href="Magister.php">Gestion</a></li>
            <li><a href="creerCour.php">Inseré un cours</a></li>
            <li><a href="uploadMat.php">Téléverser matérial de cours</a></li>
            <li><a href="LogOff.php">Deconnexion</a></li>
          </ul>
        </div>
        <?php
    }
      if ($type == "user"){
        ?>
        <div id="right">
          <?php echo '<p><b><font size="4">Bonjour '.$_SESSION['myStudent']->FirstName.'</font></b></p>';?>
          <ul id="nav">
            <li><a href="Etudiant.php">Mon Compte</a></li>
            <!--<li><a href="index.php">Accueil</a></li>-->
            <li><a href="ListeCours.php">Cours Offert</a></li>
            <!--<li><a href="achats.php">Achat de cours</a></li>-->
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
            <li><a href="ListeCours.php">Cours Offert</a></li>
            <li><a href="Enregistrement.php">Enregistrement</a></li>
          </ul>
        </div>
        <?php
    }
}
?>

