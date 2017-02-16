<?php
// Classe  Jeux d'enfant ACME
class Client {
    var $ClientID;
    var $LastName;
    var $FirstName;
    var $Address;
    var $City;
    var $Province;
    var $PostalCode;
    var $EmailAddress;
    var $UserName;
    var $listeDesJeux=array();
    
    function Client($clientid, $lastname, $firstname, $adresse, $city, $province, $postalcode, $emailaddress, $username, $listedesjeux=array())
    {
        $this->ClientID = $clientid;
        $this->LastName = $lastname;
        $this->FirstName = $firstname;
        $this->Address = $adresse;
        $this->City = $city;
        $this->Province = $province;
        $this->PostalCode = $postalcode;
        $this->EmailAddress = $emailaddress;
        $this->UserName = $username;
        $this->listeDesJeux = $listedesjeux;
    }
    
    public function getNomClient()
    {
        return $this->FirstName." ".$this->LastName;
    }
    
    public function ajouteJeux(Jeux $monJeux)
    {
       $this->listeDesJeux[$monJeux->id] = $monJeux;
    }
    
    public function retireJeux($idJeux)
    {
        if (isset($this->listeDesJeux[$idJeux])) {        
            unset($this->listeDesJeux[$idJeux]);   
            echo "<br> Jeux ".$idJeux." trouvé et effacé de la liste <br><br>";
        }
        else {
            echo "Jeux NON trouvé <br>";
        }
    }
    
    public function getJeux()
    {
        return $this->listeDesJeux;
    }
}

class Jeux {
    public $id;
    public $nom;
    var $cout;
    
    public function Jeux($id, $nom, $cout) {
        $this->id = $id;
        $this->nom = $nom;
        $this->cout = $cout;
    }
    
    public function getCout() {
        return $this->cout;
    }
}


?>