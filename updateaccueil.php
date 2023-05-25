<?php
require 'include/connectionbdd.php';

try {
  $requeteSelection = $connexion->prepare('SELECT Id_Info_Accueil FROM info_accueil');
  $requeteSelection->execute();
  $contactSelect = $requeteSelection -> fetch();


} catch (\Exception $exception) {

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
    var_dump($exception->getMessage());
  }
}
//Récupération du Titre de la page d'accueil
$titreInfoAccueil = $connexion -> prepare('SELECT Titre_Info_Accueil FROM info_accueil');
$titreInfoAccueil ->execute();
$TitreAccueil = $titreInfoAccueil->fetch();
$TitreAccueil = $TitreAccueil['Titre_Info_Accueil'];
//Récupération de la description de la page d'accueil
$texteInfoAccueil = $connexion -> prepare('SELECT Texte_Info_Accueil FROM info_accueil');
$texteInfoAccueil ->execute();
$TexteAccueil = $texteInfoAccueil->fetch();
$TexteAccueil = $TexteAccueil['Texte_Info_Accueil'];
 //Récupération du numéro de Téléphone
 $tel = $connexion -> prepare('SELECT Num_Tel_Info_Accueil FROM info_accueil');
 $tel ->execute();
 $phone = $tel->fetch();
 $phone = $phone['Num_Tel_Info_Accueil'];
 //Récpération de l'email
 $email = $connexion -> prepare('SELECT Email_Info_Accueil FROM info_accueil');
 $email ->execute();
 $adresseEmail = $email->fetch();
 $adresseEmail = $adresseEmail['Email_Info_Accueil'];
 //Récupération de l'emplacement du bureau du CSE
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
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/7871bf468e.js" crossorigin="anonymous"></script>
    <meta charset="utf-8" />
  </head>

  <header>
        <div class="light-gray"></div>
        <div class="blue">
                <nav>
                    <div class="logo"><img src="assets/logo_st_vincent_1.png" alt="logo_st_vincent"></div>
                    <ul>
                    <a href="back.php">
                            <li>
                                Back-Accueil
                            </li>
                        </a>
                        <a href="partview.php">
                            <li>
                                Back-Partenariats
                            </li>
                        </a>
                        <a href="offreview.php">
                            <li>
                                Back-Billetterie
                            </li>
                        </a>
                        <a href="contactview.php">
                            <li>
                                Back-Contact
                            </li>
                        </a>
                    </ul>
                </nav>
            </div>
    </header>
        </header>

      <body>
      <h1 class="titre-modif" style="margin-top: 50px;margin-bottom: 20px;">Modification des données de la page d'accueil</h1>
      <div class="container-modif">

        <form action="#" method="POST" style="display:flex; flex-direction: column; width:25%;">
          <div class="sous-titre-modif">
            <label class="sous-titre-modif" for="titre">Titre : </label>
            <?= isset($erreurs['titre']) ? $erreurs['titre'] : null; ?>
            <input class="titre-modif" type="text" name="titre" value="<?= $TitreAccueil ?>">
          </div> 
          <div class="sous-titre-modif">
            <label for="description">Description : </label>
            <input class="texte-modif" type="text" name="description" value=" <?= $TexteAccueil ?>">
            <?= isset($erreurs['description']) ? $erreurs['description'] : null; ?>
          </div>   
          <div class="sous-titre-modif">
            <label for="email">Email : </label>
            <input class="email-modif" type="text" name="email" value="<?= $adresseEmail ?>">
            <?= isset($erreurs['email']) ? $erreurs['email'] : null; ?>
          </div> 
          <div class="sous-titre-modif">  
            <label for="telephone">Téléphone : </label>
            <input class="telephone-modif" type="text" name="telephone" value="<?= $phone ?>">
            <?= isset($erreurs['telephone']) ? $erreurs['telephone'] : null; ?>
          </div>
          <div class="sous-titre-modif">  
            <label for="emplacement">Emplacement du bureau de CSE : </label>
            <input class="bureau-modif" type="text" name="emplacement" value="<?= $office ?>">
            <?= isset($erreurs['emplacement']) ? $erreurs['emplacement'] : null; ?>
          </div>
          <div> 
            <input class="sous-titre-input" type="submit" value="Modifier">
          </div>
        </form>
      </div>

    </body>
  </html>