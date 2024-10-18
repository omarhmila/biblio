<?php
include "connexion.php";
try {
    $conn = new PDO("mysql:host=localhost;dbname=gestionbib","omar");
  
} catch(PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>