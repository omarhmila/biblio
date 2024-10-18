<?php
include "../modele/emprunt.php";
   function ajouterEmp(){
  
      if (isset($_POST["idem"])) {
      
    
     $emp = $_POST['idem'];
     $mat = $_POST['mt'];
     $liv = $_POST['idliv'];
     $dtd = $_POST['de'];
     $dtf = $_POST['fe'];

        
      
   
     $art=new emprunt($emp,$mat,$liv,$dtd,$dtf);
   
     return($art->ajouterEmp());
     
     
    }
    else return 0;
 
 }
 function supprimerEmp()
 {
     if(isset($_POST["idem"])) {
        $emp = $_POST['idem'];
        $mat = $_POST['mt'];
        $liv = $_POST['idliv'];
        $dtd = $_POST['de'];
        $dtf = $_POST['fe'];
 
        $art=new emprunt($emp,$mat,$liv,$dtd,$dtf);
       
         return $art->supprimerEmprunt($emp);
     } else {
        
         return false;
     }
    
 
 }
 function supprimer()
 {
     if(isset($_POST["idempsi"])) {

        $idemp = $_POST['idempsi'];}
        $art=new emprunt(0,0,0,00,$idemp);
       
        return $art->supprimerEmprunt($idemp);
     }
 
 function modifierA(){
    if(isset($_POST["idem"])) {
        $emp = $_POST['idem'];
        $mat = $_POST['mt'];
        $liv = $_POST['idliv'];
        $dtd = $_POST['de'];
        $dtf = $_POST['fe'];
        $art=new emprunt($emp,$mat,$liv,$dtd,$dtf);
 return($art->modifierEmprunt());
    }
    else return false ;
 
 
 }

 if(isset($_POST["adEs"])) {   
    echo "<script>console.log('Debug Objects:". "alo55" ." ' );</script>";   
    $ajout = ajouterEmp();
    if($ajout)
        echo "<script>alert('Ajout réussi.'); window.location='../vues/biblio.php';</script>";
    else  
        echo "<script>alert('Ajout échoué.'); window.location='../vues/biblio.php';</script>";
}else if(isset($_POST["modifE"])) {   
    echo "<script>console.log('Debug Objects:". "alo55" ." ' );</script>";   
    $modif = modifierA();
    if($modif)
        echo "<script>alert('Modifier réussi.'); window.location='../vues/biblio.php';</script>";
    else  
        echo "<script>alert('Modifier échoué.'); window.location='../vues/biblio.php';</script>";
    }else if(isset($_POST["supprimerE"])) {   
        echo "<script>console.log('Debug Objects:". "alo55" ." ' );</script>";   
        $supp = supprimerEmp();
        if($supp)
            echo "<script>alert('Supprimer réussi.'); window.location='../vues/biblio.php';</script>";
        else  
            echo "<script>alert('Supprimer échoué.'); window.location='../vues/biblio.php';</script>";
        }else if(isset($_POST["REST"])) {   
            echo "<script>console.log('Debug Objects:". "alo55" ." ' );</script>";   
            $sup = supprimer();
            if($sup)
                echo "<script>alert('Restituer réussi.'); window.location='../vues/biblio.php';</script>";
            else  
                echo "<script>alert('Restituer échoué.'); window.location='../vues/biblio.php';</script>";
            }






?>