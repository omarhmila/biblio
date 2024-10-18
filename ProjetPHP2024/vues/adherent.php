<!DOCTYPE html>
<html lang="fr">
<head>
    <style>
     
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@400;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-image: linear-gradient(to right, #4e54c8, #8f94fb);
    color: #333;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 40px;
    background-color: #fff;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    text-align: center;
    animation: fadeIn 1s ease-in-out;
}

h1 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 30px;
    color: #4e54c8;
}

form {
    margin-top: 30px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: 600;
    color: #4e54c8;
}

input {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 2px solid #8f94fb;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input:focus {
    outline: none;
    border-color: #4e54c8;
}

button {
    padding: 14px 28px;
    background-color: #ff6b6b;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 700;
    text-transform: uppercase;
    box-shadow: 0 10px 20px rgba(255, 107, 107, 0.4);
    transition: all 0.3s ease;
}

button:hover {
    background-color: #ff4b4b;
    box-shadow: 0 15px 30px rgba(255, 107, 107, 0.6);
    transform: translateY(-3px);
}
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 0;
    margin-bottom: 20px;
    background-color: var(--table-bg-color);
    animation: fadeIn 1s ease-in-out;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    color: #4e54c8;
    font-weight: 600;
}


@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
} 
select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        color: #333;
    }

    select option {
        padding: 10px;
        font-size: 16px;
        background-color: #fff;
        color: #333;
    }

    select option:hover {
        background-color: #f2f2f2;
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="containers">
 <h2>Liste des Livres</h2>
        <table border="1">
       <tr>
       <th>id</th>
       <th>titre</th>
       <th>auteur</th>
       
       </tr>
       
       <?php
       include_once '../modele/livre.php';
       
     
       
       $livres = livre::getAllLivres();
       
       foreach ($livres as $livre) {
       echo "<tr>";    
       echo "<td>" . $livre['id'] . "</td>";
       echo "<td>" . $livre['titre'] . "</td>";
       echo "<td>" . $livre['auteur'] . "</td>";
     
       echo "</tr>";
       
               }
           ?>
       </table>
              </div>
</div>
<div class="container">
          <h1>Rechercher un Livre par différents critères</h1>
        <form action="../vues/adherent.php" method="POST">
        <label for="mat">id:</label><br>
            <input type="text" id="mat" name="idcherad" ><br>
         
            <label for="mdpajou">Titre</label><br>
            <input type="text" id="mdpajou" name="titrecherad" ><br>
            <label for="mdpajou">auteur</label><br>
            <input type="text" name="auteurcherrad" ><br>
           <br>
            <button type="submit" name="cherrad">Chercher</button>
          

        </form>
        <?php
        include_once "../modele/livre.php";
        if (isset($_POST['idcherad'])) {
          echo "<script>console.log('Debug Objects:". "test555" ." ' );</script>";
          $id= $_POST['idcherad'];
          $titre= $_POST['titrecherad'];
          $auteur= $_POST['auteurcherrad'];
          $exp="";
       $livres=new livre($id, $titre, $auteur);
      $resultats = $livres->rechercherLivres($id, $titre, $auteur, $exp);
     
        if ($resultats) {
         
            echo "<table style='width: 100%; border-collapse: collapse;'>";
          
            echo "<tr><th style='background-color: #f2f2f2; padding: 10px;'>ID</th><th style='background-color: #f2f2f2; padding: 10px;'>Titre</th><th style='background-color: #f2f2f2; padding: 10px;'>Auteur</th></tr>";
           
            foreach ($resultats as $resultat) {
              echo "<script>console.log('Debug Objects: " . count($resultats) . " ' );</script>";
                echo "<tr>";
                echo "<td style='padding: 10px; text-align: center;'>" . $resultat['id'] . "</td>";
                echo "<td style='padding: 10px; text-align: center;'>" . $resultat['titre'] . "</td>";
                echo "<td style='padding: 10px; text-align: center;'>" . $resultat['auteur'] . "</td>";
               
                echo "</tr>";
             
            }
            echo "</table>";
        } else {
            echo "Aucun livre trouvé avec ces critères.";
        }
      }
        ?>
     </div>
     <?php

include_once '../modele/emprunt.php';


if(isset($_SESSION["username"])) {
    
    $mat = $_SESSION["username"];
   
    $adherent = new emprunt("", $mat, "", "", ""); 
    $resultats = $adherent->rechercherEmpruntParMatricule(); 
    echo "<script>console.log('Result Objects:". count($resultats) ." ' );</script>";
    
    if ($resultats) {
       echo "<table style='width: 100%; border-collapse: collapse;'>";
          
       echo "<tr><th style='background-color: #f2f2f2; padding: 10px;'>idemprunt</th><th style='background-color: #f2f2f2; padding: 10px;'>matricule</th><th style='background-color: #f2f2f2; padding: 10px;'>id Livre</th><th style='background-color: #f2f2f2; padding: 10px;'>date debut</th><th style='background-color: #f2f2f2; padding: 10px;'>date Fin</th></tr>";
       
        foreach ($resultats as $resultat) {
          
        /*  echo "<script>console.log('Debug Objects: " . count($resultats) . " ' );</script>";*/
         /* echo "<script>console.log('Debug Objects: " . $resultat . " ' );</script>";*/
          
           echo "<tr>";
            echo "<td style='padding: 10px; text-align: center;'>" . $resultat['idemprunt'] . "</td>";
            echo "<td style='padding: 10px; text-align: center;'>" . $resultat['matricule'] . "</td>";
            echo "<td style='padding: 10px; text-align: center;'>" . $resultat['id'] . "</td>";
            echo "<td style='padding: 10px; text-align: center;'>" . $resultat['datedeb'] . "</td>";
            echo "<td style='padding: 10px; text-align: center;'>" . $resultat['datefin'] . "</td>";
            echo "</tr>";
         
        }
       echo "</table>";
    } else {
        echo "Aucun livre trouvé avec ces critères.";
    }
} 
?>
</body>
</html>