<?php
require 'include/connectionbdd.php';

try {
  $requeteSelection = $connexion->prepare('SELECT Id_Info_Accueil FROM info_accueil');
  $requeteSelection->execute();
  $contactSelect = $requeteSelection -> fetch();


} catch (\Exception $exception) {
  // debug erreur :
  //var_dump($exception);
}

$erreurs = [];
if (empty($erreurs)) {
  try {
    $requeteModification = $connexion->prepare('
    UPDATE info_accueil
        SET
          Texte_Info_Accueil = :Texte_Info_Accueil,
          Titre_Info_Accueil = :Titre_Info_Accueil,
          Email_Info_Accueil = :Email_Info_Accueil,
          Num_Tel_Info_Accueil = :Num_Tel_Info_Accueil,
          Emplacement_Bureau_Info_Accueil = :Emplacement_Bureau_Info_Accueil
        WHERE Id_Info_Accueil= :id');

    $requeteModification->bindParam(':Titre_Info_Accueil', $_POST['titre']);
    $requeteModification->bindParam(':Texte_Info_Accueil', $_POST['description']);
    $requeteModification->bindParam(':Email_Info_Accueil', $_POST['email']);
    $requeteModification->bindParam(':Num_Tel_Info_Accueil', $_POST['telephone']);
    $requeteModification->bindParam(':Emplacement_Bureau_Info_Accueil', $_POST['emplacement']);
    $requeteModification->bindParam(':id', $contactSelect['Id_Info_Accueil']);

    $requeteModification->execute();



  } catch (\Exception $exception) {
    echo 'Erreur lors de l\'ajout de la demande de contact.';
    // Debug de l'erreur :
    var_dump($exception->getMessage());
  }
}
//Récupération des données du Titre de la page d'accueil
$titreInfoAccueil = $connexion -> prepare('SELECT Titre_Info_Accueil FROM info_accueil');
$titreInfoAccueil ->execute();
$TitreAccueil = $titreInfoAccueil->fetch();
$TitreAccueil = $TitreAccueil['Titre_Info_Accueil'];
//Récupération des données de la description de la page d'accueil
$texteInfoAccueil = $connexion -> prepare('SELECT Texte_Info_Accueil FROM info_accueil');
$texteInfoAccueil ->execute();
$TexteAccueil = $texteInfoAccueil->fetch();
$TexteAccueil = $TexteAccueil['Texte_Info_Accueil'];
 //Récupération des données de Téléphone
 $tel = $connexion -> prepare('SELECT Num_Tel_Info_Accueil FROM info_accueil');
 $tel ->execute();
 $phone = $tel->fetch();
 $phone = $phone['Num_Tel_Info_Accueil'];
 //Récpération des données de l'email
 $email = $connexion -> prepare('SELECT Email_Info_Accueil FROM info_accueil');
 $email ->execute();
 $adresseEmail = $email->fetch();
 $adresseEmail = $adresseEmail['Email_Info_Accueil'];
 //Récupération des données de l'emplacement du bureau du CSE
 $place = $connexion -> prepare('SELECT Emplacement_Bureau_Info_Accueil FROM info_accueil');
 $place ->execute();
 $office = $place->fetch();
 $office = $office['Emplacement_Bureau_Info_Accueil'];

?>


<!DOCTYPE HTML>
<html>
  <head>
    <meta name="viewport"> 
    <title>CSE Saint-Vincent</title>
    <link rel="shortcut icon" href="assets/Logo_parNodevo (1).png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7871bf468e.js" crossorigin="anonymous"></script>
    <meta charset="utf-8" />
  </head>

  <header>
        <div class="gris">
        </div>
        <div class="blue">
            <nav>
                <ul>
                    <a href="index.php">
                        <li class="active">
                            Accueil
                        </li>
                    </a>
                    <a href="partenariats.php">
                        <li>Partenariats</li>
                    </a>
                    <a href="billetterie.php">
                        <li>Billetterie</li>
                    </a>
                    <a href="contact.php">
                        <li>Contact</li>
                    </a>
                </ul>

            </nav>
        </div>
    </header>
        </header>


      <body>

        
      <h1 class="tittre-modif" style="margin-top: 50px;margin-bottom: 20px;">Modification des données de la page d'accueil</h1>

        <form action="#" method="POST" style="display:flex; flex-direction: column; width:25%;">
        
             <label for="titre">Titre : </label>
            <?= isset($erreurs['titre']) ? $erreurs['titre'] : null; ?>
            <input type="text" name="titre" value="<?= $TitreAccueil ?>">
            
            <label for="description">Description : </label>
            <textarea name="description" cols="5" rows="5"><?= $TexteAccueil ?></textarea>
            <?= isset($erreurs['description']) ? $erreurs['description'] : null; ?>
            
            <label for="email">Email : </label>
            <input type="text" name="email" value="<?= $adresseEmail ?>">
            <?= isset($erreurs['email']) ? $erreurs['email'] : null; ?>
            
            <label for="telephone">Téléphone : </label>
            <input type="text" name="telephone" value="<?= $phone ?>">
            <?= isset($erreurs['telephone']) ? $erreurs['telephone'] : null; ?>
            
            <label for="emplacement">Emplacement du bureau de CSE : </label>
            <input type="text" name="emplacement" value="<?= $office ?>">
            <?= isset($erreurs['emplacement']) ? $erreurs['emplacement'] : null; ?>
        
            <input type="submit" value="Modifier">
        </form>


    </body>


      </body>



