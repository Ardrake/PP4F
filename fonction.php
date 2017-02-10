<?php
require_once('ClassMesCours.php');

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
            //echo "log in magister";
            return 1;
        } //admin is false
        else {
            $_SESSION['valid_user'] = $username;
            $_SESSION['myStudent'] = getMyStudent($username);
            //echo "log in usager";
            return 1;
        }
    } else {
        echo "combinaison usager et mot de passe inexistant";
        $_SESSION['myCourse'] = getAllCourses();
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
   $result = new mysqli('localhost', 'root', '', 'MesCours');
   if (!$result) {
      echo 'erreur connection';
      return false;
   }
   $result->autocommit(TRUE);
   return $result;
}

function getMyStudent($username){
    $conn = db_connect();
    if (!$conn) {
      return 0;
    }
    // retour objet Etudiant
    $result = $conn->query("select * from students
                           where username='".$username."'");
                               
    if (!$result) {
       //echo "student non trouvé";
       return 0;
    }
     if ($result->num_rows>0) {
        /* fetch object array */
        //echo "Trouvé etudiant";
        //print_r($result);
        
        while ($obj = mysqli_fetch_array($result)) {
                $myStudent = new Etudiant($obj[0], $obj[1], $obj[2], $obj[3], $obj[4], $obj[5], $obj[6], $obj[7], $obj[8]);
                
                $sql = "SELECT * FROM courses 
                        left outer join studentscourses ON courses.CourseID =  studentscourses.CourseID
                        where StudentID = '".$myStudent->StudentID."'";
                
                $LesCours = $conn->query($sql);
                
                while ($objcours = mysqli_fetch_array($LesCours)) {
                    $myCours = new Cours($objcours[0], $objcours[1], $objcours[2], $objcours[3]);
                    $myStudent->ajouteCours($myCours);
                }
            }
        }
        return $myStudent;
    /* libéré les resultats */
    $result->close();
}

function getAllCourses(){
    $conn = db_connect();
    $listeDesCours = array();
    if (!$conn) {
      return 0;
    }
    else {
        // retour list des cours étutdian
        if (check_user() == 1){
            $myStudent = getMyStudent($_SESSION['valid_user']);
            $studentid = $myStudent->StudentID;
            //echo "list de cours pas prit par etudiant";
            $sql = "SELECT * FROM courses WHERE CourseID NOT IN (SELECT CourseID FROM studentscourses WHERE StudentID = '". $studentid ."')";
        }
         else {
             $sql = "SELECT * FROM courses";
         }
    }
    $result = $conn->query($sql);
                               
    if (!$result) {
       return 0;
    }
     if ($result->num_rows>0) {
        
        while ($obj = mysqli_fetch_array($result)) {
                $myCours = new Cours($obj[0], $obj[1], $obj[2], $obj[3]);
                $listeDesCours[] = $myCours;
        }
    return $listeDesCours;    
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
    
    function getMaterielCours($dir){
        $files = scandir($dir);
        return $files;
    }
?>

