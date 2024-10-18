
<?php

class emprunt {
    private $idemprunt;
    private $matricule;
    private $id;
    private $datedeb;
    private $datefin;
    public function __construct($idemprunt,$matricule,$id,$datedeb,$datefin) {
        $this->idemprunt = $idemprunt;
        $this->matricule = $matricule;
        $this->id = $id;
        $this->datedeb = $datedeb;
        $this->datefin = $datefin;
    }
    public function getidemprunt()
    {
        return $this->idemprunt;
    }
    public function getmatricule()
    {
        return $this->matricule;
    }
    public function getid()
    {
        return $this->id;
    }
    public function getdatedeb()
    {
        return $this->datedeb;}
    public function getdatefin(){
        return $this->datefin;
    }
   public  function setidemprunt($idemprunt){
       $this->idemprunt = $idemprunt;
   }
   public  function setmatricule($matricule){
       $this->matricule = $matricule;
   }
   public  function setid($id){
       $this->id = $id;
   }
   public  function setdatedeb($datedeb){
       $this->datedeb = $datedeb;
   }
   public  function setdatefin($datefin){
       $this->datefin = $datefin;
   }
   public function __toString()
   {
       return $this->idemprunt." ".$this->matricule." ".$this->id." ".$this->datedeb." ".$this->datefin;
   }
   public function __isset($attr)
   {
    return isset($this->$attr);
   }
 
   public function __get($attr)
   {
    return $this->$attr;
   }

   public function __set($attr, $value)
   {
    $this->$attr = $value;
   }
   function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    
}

   public static function getAllemprunt()
   {
       try {
           $conn = new PDO("mysql:host=localhost;dbname=gestionbib","omar");
           $stmt = $conn->query("SELECT * FROM emprunt");
           $emprunt = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
           return $emprunt;
       } catch(PDOException $e) {
          
           error_log('PDO Exception: ' . $e->getMessage(), 0);
           return [];
       }
   }
   function supprimerEmprunt($idEmprunt) {
    $conn = new PDO("mysql:host=localhost;dbname=gestionbib", "omar");

   
    $stmt_select = $conn->prepare("SELECT id FROM emprunt WHERE idemprunt = :idEmprunt");
    $stmt_select->bindParam(':idEmprunt', $idEmprunt);
    $stmt_select->execute();
    $idLivre = $stmt_select->fetchColumn();
    $stmt_select->closeCursor();

   
    $stmt_delete = $conn->prepare("DELETE FROM emprunt WHERE idemprunt = :idEmprunt");
    $stmt_delete->bindParam(':idEmprunt', $idEmprunt);
    $stmt_delete->execute();
    $rowsDeleted = $stmt_delete->rowCount();
    $stmt_delete->closeCursor();

    if ($rowsDeleted > 0) {
      
        $stmt_update = $conn->prepare("UPDATE livre SET nbex = nbex + 1 WHERE id = :idLivre");
        $stmt_update->bindParam(':idLivre', $idLivre);
        $stmt_update->execute();
        $stmt_update->closeCursor();
        return true;
    } else {
        return false;
    }
}
   function ajouterEmp(){
    try{
        $conn = new PDO("mysql:host=localhost;dbname=gestionbib","omar");
        $stmt_insert = $conn->prepare("INSERT INTO emprunt  VALUES(:idemprunt , :matricule ,:idlivre,:datedeb,:datefin)");
        $stmt_insert->bindParam(':idemprunt',$this->idemprunt);
        $stmt_insert->bindParam(':matricule',$this->matricule);
        $stmt_insert->bindParam(':idlivre',$this->id);
        $stmt_insert->bindParam(':datedeb',$this->datedeb);
        $stmt_insert->bindParam(':datefin',$this->datefin);
        
        $stmt_insert->execute();
        $stmt_insert->closeCursor();
        
        if($stmt_insert->rowCount()>0){
            
            $stmt_update = $conn->prepare("UPDATE livre SET nbex = nbex - 1 WHERE id = :idlivre");
            $stmt_update->bindParam(':idlivre',$this->id);
            $stmt_update->execute();
            $stmt_update->closeCursor();
            return true;
        } else return false;
    } catch(PDOException $e) {
        return false;
    }
}
function modifierEmprunt(){
    $conn = new PDO("mysql:host=localhost;dbname=gestionbib","omar");

   
    $stmt_select = $conn->prepare("SELECT id FROM emprunt WHERE idemprunt = :idemprunt");
    $stmt_select->bindParam(':idemprunt', $this->idemprunt);
    $stmt_select->execute();
    $ancien_id_livre = $stmt_select->fetchColumn();
    $stmt_select->closeCursor();

   
    $stmt_update = $conn->prepare("UPDATE emprunt SET matricule=:matricule, id=:idlivre, datedeb=:datedeb, datefin=:datefin WHERE idemprunt = :idemprunt");
    $stmt_update->bindParam(':idemprunt', $this->idemprunt);
    $stmt_update->bindParam(':matricule', $this->matricule);
    $stmt_update->bindParam(':idlivre', $this->id);
    $stmt_update->bindParam(':datedeb', $this->datedeb);
    $stmt_update->bindParam(':datefin', $this->datefin);
    $stmt_update->execute();
    $stmt_update->closeCursor();

    if ($stmt_update->rowCount() > 0) {
        
        if ($ancien_id_livre != $this->id) {
         
            $stmt_update_ancien = $conn->prepare("UPDATE livre SET nbex = nbex + 1 WHERE id = :ancien_id_livre");
            $stmt_update_ancien->bindParam(':ancien_id_livre', $ancien_id_livre);
            $stmt_update_ancien->execute();
            $stmt_update_ancien->closeCursor();

            $stmt_update_nouveau = $conn->prepare("UPDATE livre SET nbex = nbex - 1 WHERE id = :nouveau_id_livre");
            $stmt_update_nouveau->bindParam(':nouveau_id_livre', $this->id);
            $stmt_update_nouveau->execute();
            $stmt_update_nouveau->closeCursor();
        }

        return true;
    } else {
        return false;
    }
}
function rechercherEmprunts($idemprunt, $matricule, $idlivre, $datedeb, $datefin) {
    $conn = new PDO("mysql:host=localhost;dbname=gestionbib", "omar");

    $query = "SELECT * FROM emprunt WHERE idemprunt LIKE :idemprunt AND matricule LIKE :matricule AND id LIKE :idlivre AND datedeb LIKE :datedeb AND datefin LIKE :datefin";

    $stmt = $conn->prepare($query);

    $idempruntParam = '%' . $idemprunt . '%';
    $matriculeParam = '%' . $matricule . '%';
    $idlivreParam = '%' . $idlivre . '%';
    $datedebParam = '%' . $datedeb . '%';
    $datefinParam = '%' . $datefin . '%';

    $stmt->bindParam(':idemprunt', $idempruntParam);
    $stmt->bindParam(':matricule', $matriculeParam);
    $stmt->bindParam(':idlivre', $idlivreParam);
    $stmt->bindParam(':datedeb', $datedebParam);
    $stmt->bindParam(':datefin', $datefinParam);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function rechercherEmpruntParMatricule() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=gestionbib", "omar");

        $stmt_search = $conn->prepare("SELECT * FROM emprunt WHERE matricule = :Matricule");
        $stmt_search->bindParam(':Matricule', $this->matricule);
        $stmt_search->execute();
        echo "<script>console.log('Matricule Objects:". $this->matricule ." ' );</script>";
        $emprunt = $stmt_search->fetch(PDO::FETCH_ASSOC);

        $stmt_search->closeCursor();

        if ($emprunt) {
            return $emprunt;
        } else {
            return array(); 
        }
    } catch (PDOException $e) {
        
        error_log('PDO Exception: ' . $e->getMessage(), 0);
        return array();
    }
}
}
?>