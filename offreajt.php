<?php
require 'include/connectionbdd.php';

if (empty($_GET) === false) {
    var_dump($_GET);
    $erreurs = [];
	if (empty($_GET['dateDebut'])) {
		$erreurs['dateDebut'] = 'Veuillez saisir un Date_Debut_Offre.';
	} 
	if (empty($_GET['dateFin'])) {
		$erreurs['dateFin'] = 'Veuillez saisir un Date_Fin_Offre.';
	} 
	if (empty($_GET['nbMinPlace'])) {
		$erreurs['nbMinPlace'] = 'Veuillez saisir un Nombre_Place_Min_Offre.';
	} 
	
	$expressionReguliere = '/[\d\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

	if (empty($_GET['description'])) {
		$erreurs['description'] = 'Veuillez saisir une description.';
	} 

	if (empty($_GET['nom'])) {
		$erreurs['nom'] = 'Veuillez saisir un nom.';
	} 

	if (empty($_GET['nom']) === false) {
		if (preg_match($expressionReguliere, $_GET['nom'])) {
			$erreurs['nom'] = 'Le nom ne doit pas contenir de chiffres et de caractères spéciaux.';
		}
	}

    if (empty($erreurs)) {

        try {
            $idImg =  $connexion->lastInsertId();
            $requeteInsertion = $connexion->prepare('INSERT INTO offre (Nom_Offre, Description_Offre, Date_Debut_Offre, Date_Fin_Offre, Nombre_Place_Min_Offre) VALUES (:Nom_Offre, :Description_Offre, :Date_Debut_Offre, :Date_Fin_Offre, :Nombre_Place_Min_Offre)');
            $requeteInsertion->bindParam('Nom_Partenaire', $_GET['nom']);
            $requeteInsertion->bindParam('Description_Offre', $_GET['description']);
            $requeteInsertion->bindParam('Date_Debut_Offre', $_GET['dateDebut']);
            $requeteInsertion->bindParam('Date_Fin_Offre', $_GET['dateFin']);
            $requeteInsertion->bindParam('Nombre_Place_Min_Offre', $_GET['nbMinPlace']);

            $requeteInsertion->execute();

            echo 'insertion réussi.';
        } catch (\Exception $exception) {
            echo $exception;
        }
    }else{
        var_dump($erreurs);
    }

    if(empty($erreurs)){
        
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link  rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap">
        <link rel="icon" href="assets/sv_logo.png">
        <title>CSE Saint-Vincent - Back - AjouterPartenaire</title>
    </head>
    <body>
        <header>
            <div class="light-gray">
            </div>
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
                        <a href="billetterieview.php">
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

        <main>
            <form id="formulaire_ajt" action="offreajt.php" method="GET" class=""
            style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px; border-radius: 5px; border: 1px solid #a39677">
                <div style="padding: 10px;">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" value="<?= isset($_GET['nom']) ? $_GET['nom'] : null; ?>">
                    <?= isset($erreurs['nom']) ? $erreurs['nom'] : null; ?>
                </div>

                <div style="padding: 10px;">
                    <label for="description">Description :</label>
                    <textarea name="description" value="<?= isset($_GET['description']) ? $_GET['description'] : null; ?>">
                    <?= isset($erreurs['description']) ? $erreurs['description'] : null; ?>
                    </textarea>
                </div>

                <div style="padding: 10px;">
                    <label for="date">Date début offre :</label>
                    <input type="date" name="dateDebut" value="<?= isset($_GET['dateDebut']) ? $_GET['dateDebut'] : null; ?>">
                    <?= isset($erreurs['dateDebut']) ? $erreurs['dateDebut'] : null; ?>
                </div>
                <div style="padding: 10px;">
                    <label for="date">Date fin offre :</label>
                    <input type="date" name="dateFin" value="<?= isset($_GET['dateFin']) ? $_GET['dateFin'] : null; ?>">
                    <?= isset($erreurs['dateFin']) ? $erreurs['dateFin'] : null; ?>
                </div>

                <div style="padding: 10px;">
                    <label for="nbMinPlace">Nombre Place Min Offre :</label>
                    <input type="number" name="nbMinPlace" value="<?= isset($_GET['nbMinPlace']) ? $_GET['nbMinPlace'] : null; ?>">
                    <?= isset($erreurs['nbMinPlace']) ? $erreurs['nbMinPlace'] : null; ?>
                </div>

                <div style="padding: 10px;">
                    <input type="submit" name="validation">
                </div>
            </form>
            <a href="offreview.php">Retour</a>
        </main>

    </body>
</html>