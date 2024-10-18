<?php
echo "<script>console.log('Debug Objects:". "5555152" ." ' );</script>";
include '../modele/adherent.php';
//include '../vues/authentificationAdherents.html';
       

    echo "<script>console.log('Debug Objects:". "test5559998" ." ' );</script>";
    $username = $_POST["username"];
    echo "<script>console.log('Debug Objects:". $username ." ' );</script>";
    $password = $_POST["password"];

    echo "<script>console.log('Debug Objects:". "test555" ." ' );</script>";
    $adherent=new adherent($username,$password);
    
    if ($adherent->authentifierUtilisateur($username, $password)) {
        echo "<script>console.log('Debug Objects:". "test555true" ." ' );</script>";
        
        session_start();
        $_SESSION["username"] = $username;  
        $_SESSION["password"] = $password;
         echo "<script>console.log('Debug Objects:". "test555true" ." ' );</script>";
        header("Location: ../vues/adherent.php");
        echo "<script>console.log('Debug Objects:". "test555true" ." ' );</script>";
    } else {
        echo "<script>alert('Échec de l\'authentification. Vérifiez vos identifiants.'); window.location='../vues/authentificationAdherents.html';</script>";
        echo "<script>console.log('Debug Objects:". "testfailed" ." ' );</script>";
    }
    ?>