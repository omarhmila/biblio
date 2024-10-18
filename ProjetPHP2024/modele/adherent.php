<?php
class adherent 
{
    private $matricule;
    private $mdp ;

    public function __construct($matricule, $mdp)
    {
        $this->matricule = $matricule;
        $this->mdp = $mdp;
    }
    
    public function getMatricule()
    {
        return $this->matricule;
    }
    
    public function getmdp()
    {
        return $this->mdp;
    }
   
    public function __toString()
    {
        return "Matricule : " . $this->matricule . " mdp : " . $this->mdp;
    }

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
function ajouter(){
   
 
    try{
        $conn = new PDO("mysql:host=localhost;dbname=gestionbib","omar");
        $stmt_insert = $conn->prepare("INSERT INTO adherent(matricule, pass) VALUES(:Matricule, :Mdp)");
        echo "<script>console.log('Debug Objects:  test ' );</script>";
        $stmt_insert->bindParam(':Matricule',$this->matricule);
        $stmt_insert->bindParam(':Mdp',$this->mdp);
   
    $stmt_insert->execute();
    $stmt_insert->closeCursor();

   
        
    
    if($stmt_insert->rowCount()>0){
        return true;
 } else return false;
}
catch(PDOException $e) {
    return false;

}
}
public static function getAllAdherents()
{
    try {
        $conn = new PDO( "mysql:host=localhost;dbname=gestionbib","omar");
        
        $stmt = $conn->query("SELECT * FROM adherent");
        $adherents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $adherents;
    } catch(PDOException $e) {
        echo "<script>console.log('Debug Objects:". "alo55" ." ' );</script>";  
        error_log('PDO Exception: ' . $e->getMessage(), 0);
        return [];
    }
}
function supprimer() {
    $conn = new PDO("mysql:host=localhost;dbname=gestionbib", "omar");

    
    $stmt = $conn->prepare("SELECT COUNT(*) FROM emprunt WHERE matricule = :Matricule AND datefin >= CURDATE()");
    $stmt->bindParam(':Matricule', $this->matricule);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
       
        return false;
    }

    
    $stmt = $conn->prepare("DELETE FROM adherent WHERE matricule = :Matricule");
    $stmt->bindParam(':Matricule', $this->matricule);
    $stmt->execute();
    $stmt->closeCursor();

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
function modifier(){
    $conn = new PDO("mysql:host=localhost;dbname=gestionbib","omar");
   
    $stmt=$conn->prepare("UPDATE adherent SET pass = :Pass WHERE adherent.matricule = :Matricule") ;
    $stmt->bindParam(':Matricule',$this->matricule);
    $stmt->bindParam(':Pass',$this->mdp);

    $stmt->execute();
    $stmt->closeCursor();
    
    if($stmt->rowCount()>0){

        return true;
    }
    else return false;
}
function rechercherAdherentParMatricule() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=gestionbib", "omar");

        $stmt_search = $conn->prepare("SELECT * FROM adherent WHERE matricule = :Matricule");
        $stmt_search->bindParam(':Matricule', $this->matricule);
        $stmt_search->execute();
       
        $adherent = $stmt_search->fetch(PDO::FETCH_ASSOC);

        $stmt_search->closeCursor();

        if ($adherent) {
            return $adherent;
        } else {
            return array(); 
        }
    } catch (PDOException $e) {
        
        error_log('PDO Exception: ' . $e->getMessage(), 0);
        return array(); 
    }
}

function authentifierUtilisateur($matricule, $mot_de_passe) {
  
    echo "<script>console.log('Debug Objects:  test ' );</script>";
    
    try {
        
        $conn = new PDO("mysql:host=localhost;dbname=gestionbib","omar");
        echo "<script>console.log('Debug Objects:". "test555" ." ' );</script>";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "<script>console.log('Debug Objects:". "test555" ." ' );</script>";
        $stmt = $conn->prepare("SELECT * FROM adherent WHERE matricule = :Matricule");
        
        $stmt->bindParam(':Matricule', $matricule);
        $stmt->execute();
       

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
           
            
            if ($mot_de_passe ==$user['pass']) {
                echo "<script>console.log('Debug Objects:  test8aloo8' );</script>";
                echo "<script>console.log('Debug Objects:  true ' );</script>";
                return true;
                
            } else {
                echo "<script>console.log('Debug Objects:  false ' );</script>";
                return false;
            }
        } else {
          
            return false;
        }
    } catch(PDOException $e) {
      
        error_log('PDO Exception: ' . $e->getMessage(), 0);
        return false;
    }
}


       
}


 


?>