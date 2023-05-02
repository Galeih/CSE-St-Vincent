<?php 
 require 'include/connectionbdd.php';

// Récupère le numéro de téléphone pour l'accès rapide de l'accueil
$numtel = $connexion -> prepare('SELECT Num_TEL_Info_Accueil FROM info_accueil');
$numtel ->execute();
$phone = $numtel->fetch();
$phone = $phone['Num_TEL_Info_Accueil'];
//Récupération des données de l'email
$email = $connexion -> prepare('SELECT Email_Info_Accueil FROM info_accueil');
$email ->execute();
$adresseEmail = $email->fetch();
$adresseEmail = $adresseEmail['Email_Info_Accueil'];
//Récupération des données de l'emplacement du bureau du CSE
$place = $connexion -> prepare('SELECT Emplacement_Bureau_Info_Accueil FROM info_accueil');
$place ->execute();
$office = $place->fetch();
$office = $office['Emplacement_Bureau_Info_Accueil'];
// Sélectionne toutes les images de la table Images, les mélangent de manière aléatoire et renvoie 3 résultats
$imgPart = $connexion -> prepare("SELECT DISTINCT * FROM images ORDER BY RAND() LIMIT 3");
$imgPart -> execute();
$nomImg = $imgPart->fetchAll();
// Récupère le titre pour l'accès rapide de l'accueil
$titreInfoAccueil = $connexion -> prepare('SELECT Titre_Info_Accueil FROM info_accueil');
$titreInfoAccueil ->execute();
$TitreAccueil = $titreInfoAccueil->fetch();
$TitreAccueil = $TitreAccueil['Titre_Info_Accueil'];
//Récupère le texte de présentation du CSE de la page d'accueil
$texteInfoAccueil = $connexion -> prepare('SELECT Texte_Info_Accueil FROM info_accueil');
$texteInfoAccueil ->execute();
$TexteAccueil = $texteInfoAccueil->fetch();
$TexteAccueil = $TexteAccueil['Texte_Info_Accueil'];
//Images partenaires
$offers = $connexion -> prepare("SELECT DISTINCT * FROM offre ORDER BY Id_Offre DESC LIMIT 3");
$offers -> execute();
$chaqueOffre = $offers->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap">
        <title>CSE Saint-Vincent - Accueil</title>
    </head>
    <body>
        <header>
            <div class="light-gray"></div>
            <div class="blue">
                <nav>
                    <div class="logo"><img src="assets/logo_st_vincent_1.png" alt="logo_st_vincent"></div>
                    <ul>
                        <a href="base.php">
                            <li class="active">Accueil</li>
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
        <main>
            <?php require 'include/aside.php'?>
        </main>
        <?php require 'include/footer.php'?>
    </body>
</html>