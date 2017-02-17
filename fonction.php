<?php
require_once('ClassMesJeux.php');

function login($username, $password) {
// check username and password with db
  //echo "login user: ".$username." User: ".$password."<br>";
  $conn = db_connect();
  if (!$conn) {
    echo "no connection";
    return 0;
  }
  // check if username is unique
  $result = $conn->query("select * from users
                         where username='".$username."'
                         and password = '".$password."'");
  if (!$result) {
     echo "no result";
     return 0;
  }
  if ($result->num_rows>0) {
        //echo "record trouvé";
  	$row = $result->fetch_assoc();
        //admin is true
        if ($row["admin"] == 1) {
            $_SESSION['admin_user'] = $username;
            //echo "log in proprio";
            return 1;
        } //admin is false
        else {
            $_SESSION['valid_user'] = $username;
            $_SESSION['myClient'] = getMyClient($username);
            //echo "log in usager";
            return 1;
        }
    } else {
        echo "combinaison usager et mot de passe inexistant";
        $_SESSION['myJeux'] = getAllJeux();
            return 0;
    }
}

function check_admin_user() {
  if (isset($_SESSION['admin_user'])) {
    return true;
  } else {
    return false;
  }
}

function check_user() {
	if(isset($_SESSION['valid_user'])) {
		return true;
	}else{
		return false;
	}
}

function db_connect() {
   $result = new mysqli('localhost', 'root', '', 'acmejeux');
   if (!$result) {
      echo 'erreur connection';
      return false;
   }
   $result->autocommit(TRUE);
   return $result;
}

function getMyClient($username){
    $conn = db_connect();
    if (!$conn) {
      return 0;
    }
    // retour objet Client
    $result = $conn->query("select * from client
                           where username='".$username."'");
                               
    if (!$result) {
       //echo "client non trouvé";
       return 0;
    }
     if ($result->num_rows>0) {
        /* fetch object array */
        //echo "Trouvé client";
        //print_r($result);
        
        while ($obj = mysqli_fetch_array($result)) {
                $myClient = new Client($obj[0], $obj[1], $obj[2], $obj[3], $obj[4], $obj[5], $obj[6], $obj[7], $obj[8]);
                
                $sql = "SELECT * FROM jeux 
                        left outer join clientjeux ON jeux.JeuxID =  clientjeux.JeuxID
                        where ClientID = '".$myClient->ClientID."'";
                
                $LesJeux = $conn->query($sql);
                
                while ($objjeux = mysqli_fetch_array($LesJeux)) {
                    $myJeux = new Jeux($objjeux[0], $objjeux[1], $objjeux[2], $objjeux[3]);
                    $myClient->ajouteJeux($myJeux);
                }
            }
        }
        //print_r($myClient);
        return $myClient;
        
    /* libéré les resultats */
    $result->close();
}

function getAllJeux(){
    $conn = db_connect();
    $listeDesJeux = array();
    if (!$conn) {
      return 0;
    }
    else {
        // retour list des jeux client
        if (check_user() == 1){
            $myClient = getMyClient($_SESSION['valid_user']);
            $clientid = $myClient->ClientID;
            //echo "list des jeux pas prit par client";
            $sql = "SELECT * FROM jeux WHERE JeuxID NOT IN (SELECT JeuxID FROM clientjeux WHERE ClientID = '". $clientid ."')";
        }
         else {
             $sql = "SELECT * FROM jeux";
         }
    }
    $result = $conn->query($sql);
                               
    if (!$result) {
       return 0;
    }
     if ($result->num_rows>0) {
        
        while ($obj = mysqli_fetch_array($result)) {
                $myJeux = new Jeux($obj[0], $obj[1], $obj[2]);
                $listeDesJeux[] = $myJeux;
        }
    return $listeDesJeux;    
    }
    /* libéré les resultats */
    $result->close();
}

function display_login_form() {
  // affiche formulaire pour le login
?>
    <form method="post" action="index.php">
        <h2>Usager:<input type="text" name="username"/>
           Mot de passe:<input type="password" name="password"/>
           <input type="submit" value="Connexion"/>
           <input type="submit" value="Réinitialiser"/></h2>
    </form>
    <?php
    $username = $password =  "";
    $valide = true;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
          $nomErr = "le nom est requis";
          echo $nomErr;
          $valide = false;
        } 
    }
    else {
         $valide = false;
    }
    if ($valide){
        login($_POST["username"], $_POST["password"]);
    }
}

  function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function getMaterielJeux($dir){
        $files = scandir($dir);
        return $files;
    }
?>

