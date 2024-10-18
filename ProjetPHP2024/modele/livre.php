<?php 

class livre {
    private $id;
    private $titre;
    private $auteur;

    private $nbExemplaire =1;
    
    public function __construct($id, $titre, $auteur) {
        
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
      
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTitre() {
        return $this->titre;
    }
    
    public function getAuteur() {
        return $this->auteur;
    }
    // Setters
    public function setId($id) {
        $this->id = $id;
    }
    public function setTitre($titre) {
        $this->titre = $titre;
    }
    public function setAuteur($auteur) {
        
    }
   
    
    
    public function __get($attr) {
        return $this->$attr;
    }
    public function __set($attr, $value) {
        
        $this->$attr = $value;
    }
    public function __isset($attr) {
        return isset($this->$attr);
    }
    public function getNbExemplaire() {
        return $this->nbExemplaire;
    }
    public function setNbExemplaire($nbExemplaire) {
        $this->nbExemplaire = $nbExemplaire;
    }
    public function __toString() {
        return "id: ". $this->id. " titre: ". $this->titre. " auteur: ". $this->auteur . 
                " nbExemplaire: " . $this->nbExemplaire;
    }
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

public static function getAllLivres()
{
    try {
        $conn = new PDO("mysql:host=localhost;dbname=gestionbib","omar");
        $stmt = $conn->query("SELECT * FROM livre");
        $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
        return $livres;
    } catch(PDOException $e) {
       
        error_log('PDO Exception: ' . $e->getMessage(), 0);
        return [];
    }
}
function supprimer() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=gestionbib", "omar");
       
       
        $stmt_emprunt = $conn->prepare("SELECT * FROM emprunt WHERE id = :Id");
        $stmt_emprunt->bindParam(':Id', $this->id);
        $stmt_emprunt->execute();
        $emprunt = $stmt_emprunt->fetch(PDO::FETCH_ASSOC);

        if ($emprunt) {
          
            return false;
        }

      
        $stmt_check = $conn->prepare("SELECT * FROM livre WHERE id = :Id");
        $stmt_check->bindParam(':Id', $this->id);
        $stmt_check->execute();
        $livre = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($livre) {
            if ($livre['nbex'] > 1) {
                $stmt_update = $conn->prepare("UPDATE livre SET nbex = nbex - 1 WHERE id = :Id");
                $stmt_update->bindParam(':Id', $this->id);
                $stmt_update->execute();
                $stmt_update->closeCursor();
                return true;
            } else {
                $stmt_delete = $conn->prepare("DELETE FROM livre WHERE id = :Id");
                $stmt_delete->bindParam(':Id', $this->id);
                $stmt_delete->execute();
                $stmt_delete->closeCursor();
                return true;
            }
        } else {
            echo "<script>console.log('Debug Objects:". "test555" ." ' );</script>";
            return false; 
        }
    } catch (PDOException $e) {
        return false; 
    }
}
function modifier(){
  
    $conn = new PDO("mysql:host=localhost;dbname=gestionbib", "omar");
    $stmt=$conn->prepare("SELECT * FROM livre WHERE id = :Id");
    $stmt->bindParam(':Id',$this->id); 
    $stmt->execute();
    $modif=false;
    if($stmt->rowCount()>0){
        if($this->titre!=""){
            $stmt=$conn->prepare("UPDATE livre SET titre = :Titre WHERE id = :Id") ;
            $stmt->bindParam(':Id',$this->id);
            $stmt->bindParam(':Titre',$this->titre);
            $stmt->execute();
            $stmt->closeCursor();
            $modif=true;
            }
        if($this->auteur!=""){
            $stmt=$conn->prepare("UPDATE livre SET auteur = :Auteur WHERE id = :Id") ;
            $stmt->bindParam(':Auteur',$this->auteur);
            $stmt->bindParam(':Id',$this->id);
            $stmt->execute();
            $stmt->closeCursor();
            $modif=true;
            }
       
        }
        return $modif;
   
}   


function ajouter() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=gestionbib", "omar");

      
        $stmt_check = $conn->prepare("SELECT * FROM livre WHERE titre = :Titre AND auteur = :Auteur AND id =:Id");
        $stmt_check->bindParam(':Titre', $this->titre);
        $stmt_check->bindParam(':Auteur', $this->auteur);
        $stmt_check->bindParam(':Id', $this->id);
        $stmt_check->execute();
        $livre = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($livre) {
         
            $stmt_update = $conn->prepare("UPDATE livre SET nbex = nbex + 1 WHERE id = :Id");
            $stmt_update->bindParam(':Id', $livre['id']);
            $stmt_update->execute();
            $stmt_update->closeCursor();
            return true;
        } else {
         
            $stmt_insert = $conn->prepare("INSERT INTO livre(id, titre, auteur, nbex) VALUES(:Id, :Titre, :Auteur, :Nbex)");
            $stmt_insert->bindParam(':Id', $this->id);
            $stmt_insert->bindParam(':Titre', $this->titre);
            $stmt_insert->bindParam(':Auteur', $this->auteur);
            $stmt_insert->bindParam(':Nbex', $this->nbExemplaire);
            $stmt_insert->execute();
            $stmt_insert->closeCursor();
            return true;
        }
    } catch (PDOException $e) {
        return false;
    }
}

function rechercherLivres($id, $titre,$auteur,$nbx) {
    $conn = new PDO("mysql:host=localhost;dbname=gestionbib", "omar");
    
  
    $query = "SELECT * FROM livre WHERE id LIKE :isbn AND titre LIKE :titre AND auteur LIKE :auteur AND nbex LIKE :nbx";
    
   
    $stmt = $conn->prepare($query);
    
    
    $isbnParam = '%' . $id . '%'; 
    $titreParam = '%' . $titre . '%'; 
    $auteurParam = '%' . $auteur . '%'; 
    $nbxParam = '%' . $nbx . '%'; 

    $stmt->bindParam(':isbn', $isbnParam);
    $stmt->bindParam(':titre', $titreParam);
    $stmt->bindParam(':auteur', $auteurParam);
    $stmt->bindParam(':nbx', $nbxParam);
    
  
    $stmt->execute();
    
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}







?>