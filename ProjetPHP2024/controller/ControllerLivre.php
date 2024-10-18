<?php
include '../modele/livre.php';
include '../vues/biblio.php';

function ajouterLivre(){
   
      if (isset($_POST["id"])) {
      
   
     $id = $_POST['id'];
     $titre = $_POST['titre'];
     $auteur = $_POST['auteur'];
     

        
      
    
     $livre=new livre($id,$titre,$auteur);
   
     return($livre->ajouter());
     
     
    }
    else return 0;
 
    
 }

 function supprimerLivre()
 {
     if(isset($_POST["id"])) {
        $id = $_POST['id'];
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
 
         $livre = new livre($id, $titre,$auteur);
       
         return $livre->supprimer();
     } else {
        
         return false;
     }
 
 }
 function modifierLivre(){
    if(isset($_POST["id"])) {
      
        $id = $_POST['id'];
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $livre = new livre($id, $titre,$auteur);
        
 return($livre->modifier());
 
    }
    
    else{    
         return false ;}
    
 
 
 }
 if(isset($_POST["adliv"])) {   
 
    $ajout = ajouterLivre();
    if($ajout)
        echo "<script>alert('Ajout réussi.'); window.location='../vues/biblio.php';</script>";
    else  
        echo "<script>alert('Ajout échoué.'); window.location='../vues/biblio.php';</script>";
} else  if(isset($_POST["supprimer"])) {

    $suppression = supprimerLivre();
  
    if($suppression) {
        echo "<script>alert('supp réussi.'); window.location='../vues/biblio.php';</script>";
    } else {
        echo "<script>alert('supp échoué. Livre n existe pas ou il est dans un Emprunt '); window.location='../vues/biblio.php';</script>";
    }
 
     }else  {
    

  
    $modif= modifierLivre();
    
    if($modif)
    
    echo "<script>alert('Livre modifié'); window.location='../vues/biblio.php';</script>";
else  
echo "<script>alert('Aucune modification!.'); window.location='../vues/biblio.php';</script>";


}

?>