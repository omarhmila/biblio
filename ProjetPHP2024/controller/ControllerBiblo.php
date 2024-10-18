<?php

include 'vues/authentificationBiblio.html';
include 'vues/biblio.php';
include 'modele/bibliothécaire.php';

if(isset($_POST['usernameB']) && isset($_POST['passB'])){
if ($_POST['usernameB'] == 'admin' && $_POST['passB'] == 'admin') {
    echo "<script>console.log('Debug Objects:  test ' );</script>";
    header('Location: ../vues/biblio.php');
   
} else {
   
    echo "<script>alert('Échec de l\'authentification.'); window.location='../vues/authentificationBiblio.html';</script>";
    
}
}






?>





