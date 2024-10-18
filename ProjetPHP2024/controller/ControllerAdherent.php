<?php

include '../modele/adherent.php';
include '../vues/biblio.php';



    function ajouterAdherent(){
    
          if (isset($_POST["matajou"])) {
          
       
         $matricule = $_POST['matajou'];
         $mpd = $_POST['mdpajou'];

            
          
        
         $art=new adherent($matricule,$mpd);
       
         return($art->ajouter());
         
         
        }
        else return 0;
     
        
     }
    
     function chercher(): mixed{
        if(isset($_POST["mat"])){
          
            $matricule = $_POST['mat'];
            $mpd = 0;
            $art=new adherent($matricule,$mpd);
            
            return($art->rechercherAdherentParMatricule());
        }else
       
            return false;

        
        }
     function supprimerAdherent()
{
    if(isset($_POST["matajou"])) {
        $mat = $_POST["matajou"];
        $mpd = $_POST['mdpajou'];

        $adherent = new adherent($mat, $mpd);
      
        return $adherent->supprimer();
    } else {
       
        return false;
    }

}
function modifierA(){
   if(isset($_POST["matajou"])) {
    $mat = $_POST["matajou"];
    $mpd = $_POST['mdpajou'];
$art=new adherent($mat,$mpd);
return($art->modifier());
   }
   else return false ;


}

if(isset($_POST["ad"])) {      
    $ajout = ajouterAdherent();
    if($ajout)
        echo "<script>alert('Ajout réussi.'); window.location='../vues/biblio.php';</script>";
    else  
        echo "<script>alert('Ajout échoué.'); window.location='../vues/biblio.php';</script>";
} else  if(isset($_POST["supprimer"])) {
    echo "<script>console.log('Debug Objects:  test11 ' );</script>";
    $suppression = supprimerAdherent();
    echo "<script>console.log('Debug Objects:  test112 ' );</script>";
    if($suppression) {
        echo "<script>alert('supp réussi.'); window.location='../vues/biblio.php';</script>";
    } else {
        echo "<script>alert('supp échoué. Adherent n existe pas ou il a un Emprunt  '); window.location='../vues/biblio.php';</script>";
    }
     
}else  if(isset($_POST["mod"])) {
    $modif= modifierA();
    if($modif)
    
    echo "<script>alert('Adherent modifié'); window.location='../vues/biblio.php';</script>";
else  
echo "<script>alert('Aucune modification!.'); window.location='../vues/biblio.php';</script>";

}





?>