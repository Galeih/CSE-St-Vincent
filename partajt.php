<?php
require 'include/connectionbdd.php';

if (empty($_GET) === false) {
    var_dump($_GET);
    $erreurs = [];
	if (empty($_GET['lien'])) {
		$erreurs['lien'] = 'Veuillez saisir un lien.';
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

    if (empty($_GET['image'])) {
		$erreurs['image'] = 'Veuillez saisir un nom pour une image.';
	} 

    if (empty($erreurs)) {
        try{
            $requeteInsertion1= $connexion->prepare('INSERT INTO images (Nom_Image) VALUES (:Nom_Image)');
            $requeteInsertion1->bindParam('Nom_Image', $_GET['image']);
            $requeteInsertion1->execute();
        } catch (\Exception $exception) {
            echo $exception;
        }
        try {
            $idImg =  $connexion->lastInsertId();
            $requeteInsertion = $connexion->prepare('INSERT INTO partenaire (Nom_Partenaire, Description_Partenaire, Lien_Partenaire, Id_Image) VALUES (:Nom_Partenaire, :Description_Partenaire, :Lien_Partenaire, :idimg)');
            $requeteInsertion->bindParam('Nom_Partenaire', $_GET['nom']);
            $requeteInsertion->bindParam('Description_Partenaire', $_GET['description']);
            $requeteInsertion->bindParam('Lien_Partenaire', $_GET['lien']);
            $requeteInsertion->bindParam('idimg', $idImg);

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
        <title>CSE Saint-Vincent - Partenariats</title>
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
                            <li class="active">
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
            <form id="formulaire_ajt" action="partajt.php" method="GET">
                <div>
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" value="<?= isset($_GET['nom']) ? $_GET['nom'] : null; ?>">
                    <?= isset($erreurs['nom']) ? $erreurs['nom'] : null; ?>
                </div>

                <div>
                    <label for="description">Description :</label>
                    <input type="text" name="description" value="<?= isset($_GET['description']) ? $_GET['description'] : null; ?>">
                    <?= isset($erreurs['description']) ? $erreurs['description'] : null; ?>
                </div>

                <div>
                    <label for="lien">Lien :</label>
                    <input type="text" name="lien" value="<?= isset($_GET['lien']) ? $_GET['lien'] : null; ?>">
                    <?= isset($erreurs['lien']) ? $erreurs['lien'] : null; ?>
                </div>

                <div>
                    <label for="image">Image :</label>
                    <input type="text" name="image" value="<?= isset($_GET['image']) ? $_GET['image'] : null; ?>">
                    <?= isset($erreurs['image']) ? $erreurs['image'] : null; ?>
                </div>

                <div>
                    <input type="submit" name="validation">
                </div>
            </form>
        </main>
    </body>
</html>