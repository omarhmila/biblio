<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Adhérent</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Roboto:wght@400;700&display=swap');

:root {
    --main-bg-color: #4e54c8;
    --form-bg-color: #fff;
    --input-border-color: #8f94fb;
    --button-bg-color: #ff6b6b;
    --button-hover-bg-color: #ff4b4b;
    --button-text-color: #fff;
    --table-bg-color: #fff;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--main-bg-color);
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    margin: 0;
    padding: 0;
}

.containers {
    margin-top: 0%;
    width: 25%;
    animation: fadeIn 1s ease-in-out;
    
    

 
}

.container {
    /* margin-top: 25%; */
    width: 400px;
    /* margin: 20px; */
    background-color: var(--form-bg-color);
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    /* animation: fadeIn 1s ease-in-out; */
    /* margin-left: -60%; */
    /* margin-top: 0px; */
    /* width: 25%;  */
    /* animation: fadeIn 1s ease-in-out; */

}
.container_add {
    /* margin-top: 0px; */
    width: 25%; 
    /* animation: fadeIn 1s ease-in-out; */
    
    

 
}

input {
    width: 100%;
    height: 45px;
    padding: 10px;
    margin: 15px 0;
    border: 2px solid var(--input-border-color);
    border-radius: 8px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input:focus {
    outline: none;
    border-color: #4e54c8;
}

button {
    width: 100%;
    height: 45px;
    padding: 10px;
    margin-top: 15px;
    background-color: var(--button-bg-color);
    border: none;
    color: var(--button-text-color);
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 16px;
    font-weight: 600;
    box-shadow: 0 10px 20px rgba(255, 107, 107, 0.4);
}

button:hover {
    background-color: var(--button-hover-bg-color);
    box-shadow: 0 15px 30px rgba(255, 107, 107, 0.6);
    transform: translateY(-3px);
}

h1 {
    margin-bottom: 20px;
    color: #4e54c8;
    font-size: 24px;
    font-weight: 700;
}

table {
    border-collapse: collapse;
    width: 140%;
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
    .parent{
        display: flex;
        align-items: center;
        width: 100%;
        gap: 20px;
        margin: 20px 0;
    }
</style>
    </style>
</head>
<body>

<div class='parent'>
<div class="container">
    <h1>Ajouter un Adhérent</h1>
    <form action="../controller/ControllerAdherent.php" method="POST">
        <label for="mat">Matricule:</label><br>
        <input type="text" id="mat" name="matajou" required><br>
        
        <label for="mdpajou">Mot de passe:</label><br>
        <input type="password" id="mdpajou" name="mdpajou" required><br>
        <button type="submit" name="ad">Ajouter Adhérent</button><br>
        <button type="submit" name="supprimer">Supprimer Adhérent</button>
        <button type="submit" name="mod">Modifier Adhérent</button>
    </form>
</div>
    <div class="container_add">
        
        <table border="1">
            <tr>
                <th>Matricule</th>
                <th>Mot de passe</th>
            </tr>
            
            <?php
    include_once '../modele/adherent.php';
    
    
    
    $adherents = Adherent::getAllAdherents();
    
    foreach ($adherents as $adherent) {
        echo "<tr>";
        echo "<td>" . $adherent['matricule'] . "</td>";
        echo "<td>" . $adherent['pass'] . "</td>";
        echo "</tr>";
    }
    ?>
    </table>
</div>


</div>
<div class='parent'>
<div class="container">
    <h1>Rechercher un Adhérent par Matricule</h1>
    <form action="../vues/biblio.php" method="POST">
        <label for="nom">Matricule:</label><br>
        <input type="text" id="nom" name="matcherrch" required><br>
        <button type="submit" name="cherad">Chercher</button>
    </form>
    <?php
    include_once '../modele/adherent.php';

    if (isset($_POST['matcherrch'])) {
        $adherent = new Adherent($_POST['matcherrch'], 12);
        $resultat = $adherent->rechercherAdherentParMatricule();

        if ($resultat) {
            echo "<div style='margin-top: 20px; text-align: center;'>";
            echo "<h2>Résultats de la recherche :</h2>";
            echo "<div style='display: flex; justify-content: center;'>";
            echo "<table style='width: 50%; border-collapse: collapse;'>";
            echo "<tr><th style='background-color: #f2f2f2; padding: 10px;'>Matricule</th><th style='background-color: #f2f2f2; padding: 10px;'>Mot de passe</th></tr>";
            echo "<tr><td '>{$resultat['matricule']}</td><td style='padding: 10px; text-align: center;'>{$resultat['pass']}</td></tr>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>Aucun adhérent trouvé pour ce matricule.</p>";
        }
    }
    ?>
</div> 
    </div>
    <div class='parent'>
       <div class="container">
        <h1>Ajouter un Livre</h1>
        <form action="../controller/ControllerLivre.php" method="POST">
            <label for="mat">id:</label><br>
            <input type="text" id="mat" name="id" required><br>
         
            <label for="mdpajou">Titre</label><br>
            <input type="text" id="mdpajou" name="titre" required><br>
            <label for="mdpajou">auteur</label><br>
            <input type="text" name="auteur" required><br>
            


            <button type="submit" name="adliv">Ajouter Livre</button><br>
            <button type="submit" name="supprimer">Supprimer Livre</button>
            <button type="submit" name="modif">Modifier Livre</button>
        </form>
        
    </div>
    <div class="containers">
 
 <table border="1">
<tr>
<th>id</th>
<th>titre</th>
<th>auteur</th>
<th>nbExemplaire</th>
</tr>

<?php
include_once '../modele/livre.php';



$livres = livre::getAllLivres();

foreach ($livres as $livre) {
echo "<tr>";    
echo "<td>" . $livre['id'] . "</td>";
echo "<td>" . $livre['titre'] . "</td>";
echo "<td>" . $livre['auteur'] . "</td>";
echo "<td>" . $livre['nbex'] . "</td>";
echo "</tr>";

        }
    ?>
</table>
       </div>
    </div>
    <div class='parent'>
    <div class="container">
          <h1>Rechercher un Livre par différents critères</h1>
        <form action="../vues/biblio.php" method="POST">
        <label for="mat">id:</label><br>
            <input type="text" id="mat" name="idcher" ><br>
         
            <label for="mdpajou">Titre</label><br>
            <input type="text" id="mdpajou" name="titrecher" ><br>
            <label for="mdpajou">auteur</label><br>
            <input type="text" name="auteurcherr" ><br>
            <label for="mdpajou">Nombre d'exemplaire</label><br>
            <input type="text" name="expcher" ><br>
            <button type="submit" name="cherr">Chercher</button>
          

        </form>
        <?php
        include_once "../modele/livre.php";
        if (isset($_POST['idcher'])) {
          echo "<script>console.log('Debug Objects:". "test555" ." ' );</script>";
          $id= $_POST['idcher'];
          $titre= $_POST['titrecher'];
          $auteur= $_POST['auteurcherr'];
          $exp= $_POST['expcher'];
       $livres=new livre($id, $titre, $auteur);
      $resultats = $livres->rechercherLivres($id, $titre, $auteur, $exp);
     
        if ($resultats) {
         
            echo "<table style='width: 100%; border-collapse: collapse;'>";
          
            echo "<tr><th style='background-color: #f2f2f2; padding: 10px;'>ID</th><th style='background-color: #f2f2f2; padding: 10px;'>Titre</th><th style='background-color: #f2f2f2; padding: 10px;'>Auteur</th><th style='background-color: #f2f2f2; padding: 10px;'>Nombre d'exemplaires</th></tr>";
           
            foreach ($resultats as $resultat) {
              echo "<script>console.log('Debug Objects: " . count($resultats) . " ' );</script>";
                echo "<tr>";
                echo "<td style='padding: 10px; text-align: center;'>" . $resultat['id'] . "</td>";
                echo "<td style='padding: 10px; text-align: center;'>" . $resultat['titre'] . "</td>";
                echo "<td style='padding: 10px; text-align: center;'>" . $resultat['auteur'] . "</td>";
                echo "<td style='padding: 10px; text-align: center;'>" . $resultat['nbex'] . "</td>";
                echo "</tr>";
             
            }
            echo "</table>";
        } else {
            echo "Aucun livre trouvé avec ces critères.";
        }
      }
        ?>
     </div>
    </div>
     

</table>
       </div>
       <div class='parent'>
     <div class="container">
        <h1>Ajouter un Emprunt</h1>
        <form action="../controller/ControllerEmprunt.php" method="POST">
            <label for="mat">idEmprunt:</label><br>
            <input type="text" id="mat" name="idem" required><br>
            <label for="mdpajou">Matricule</label><br>
            <select name="mt" >
                        
            <?php
            include_once "../modele/adherent.php";
            $tabF = adherent::getAllAdherents();
            foreach ($tabF as $f) {
                echo "<option>" . $f['matricule'] . "</option>";
            }
            ?>
            </select>
            <br>

            <label for="mdpajou">Id de livre</label><br>
            <select name="idliv" >
                        
            <?php
            include_once "../modele/livre.php";
            $tabF = livre::getAllLivres();
            foreach ($tabF as $f) {
                echo "<option>" . $f['id'] . "</option>";
            }
            ?>
            </select>
            <br>
            <label for="mdpajou">Date Debut </label><br>
            <input type="date" name="de" required><br>
            <label for="mdpajou">Date Fin</label><br>
            <input type="date" name="fe" required><br>
            


            <button type="submit" name="adEs">Ajouter Emprunt</button><br>
            <button type="submit" name="supprimerE">Supprimer Emprunt</button>
            <button type="submit" name="modifE">Modifier Emprunt</button>
        </form>
        
    </div>  
    <div class="containers">
 
 <table border="1">
<tr>
<th>Nemprunt</th>
<th>matricule</th>
<th>id livre</th>
<th>date debut </th>
<th>date fin</th>
</tr>
     <?php
include_once '../modele/emprunt.php';



$emprunts = emprunt::getAllemprunt();

foreach ($emprunts as $emprunt) {
echo "<tr>";    
echo "<td>" . $emprunt['idemprunt'] . "</td>";
echo "<td>" . $emprunt['matricule'] . "</td>";
echo "<td>" . $emprunt['id'] . "</td>";
echo "<td>" . $emprunt['datedeb'] . "</td>";
echo "<td>" . $emprunt['datefin'] . "</td>";
echo "</tr>";

        }
    ?>
    </table> 
       </div>
       </div>
       <div class='parent'>
     <div class="container">
          <h1>Rechercher un Emprunt par différents critères</h1>
        <form action="../vues/biblio.php" method="POST">
        <label for="mat">id Emprunt:</label><br>
            <input type="text" id="mat" name="idempcher" ><br>
         
            <label for="mdpajou">Matricule</label><br>
            <input type="text" id="mdpajou" name="matcheremp" ><br>
            <label for="mdpajou">Id Livre </label><br>
            <input type="text" name="idlivcheremp" ><br>
            <label for="mdpajou">Date Debut</label><br>
            <input type="date" name="ddcheremp" ><br>
            <label for="mdpajou">Date Fin</label><br>
            <input type="date" name="dfcheremp" ><br>
            <button type="submit" name="cherrEmp">Chercher</button>
          

        </form>
        <?php
        include_once "../modele/emprunt.php";
        if (isset($_POST['idempcher'])) {
          echo "<script>console.log('Debug Objects:". "test555" ." ' );</script>";
          $idemp= $_POST['idempcher'];
          $mat= $_POST['matcheremp'];
          $idliv= $_POST['idlivcheremp'];
          $dated= $_POST['ddcheremp'];
          $datef= $_POST['dfcheremp'];
       $emprunt=new emprunt($idemp, $mat, $idliv,$dated,$datef);
      $resultats = $emprunt->rechercherEmprunts($idemp, $mat, $idliv,$dated,$datef);
     
        if ($resultats) {
         
            echo "<table style='width: 100%; border-collapse: collapse;'>";
          
            echo "<tr><th style='background-color: #f2f2f2; padding: 10px;'>idemprunt</th><th style='background-color: #f2f2f2; padding: 10px;'>matricule</th><th style='background-color: #f2f2f2; padding: 10px;'>id Livre</th><th style='background-color: #f2f2f2; padding: 10px;'>date debut</th><th style='background-color: #f2f2f2; padding: 10px;'>date Fin</th></tr>";
           
            foreach ($resultats as $resultat) {
              echo "<script>console.log('Debug Objects: " . count($resultats) . " ' );</script>";
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
     </div> 


     <div class="container">
        <h1>La Gestion De Restitution</h1>
        <form action="../controller/ControllerEmprunt.php" method="POST">
           
            <label for="mdpajou">idEmprunt</label><br>
            <select name="idempsi" >
                        
            <?php
            include_once "../modele/emprunt.php";
            $tabF = emprunt::getAllemprunt();
            foreach ($tabF as $f) {
                echo "<option>" . $f['idemprunt'] . "</option>";
            }
            ?>
            </select>
            <br>

            <button type="submit" name="REST">Restituer </button><br>
           
        </form>
        
    </div>   
       </div>

    
     



        
</body>
</html>