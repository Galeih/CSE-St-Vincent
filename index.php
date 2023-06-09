<?php 
 require 'include/connectionbdd.php';

// Récupération du numéro de téléphone
$tel = $connexion -> prepare('SELECT Num_TEL_Info_Accueil FROM info_accueil');
$tel ->execute();
$phone = $tel -> fetch();
$phone = $phone['Num_TEL_Info_Accueil'];
// Récupération de l'email
$email = $connexion -> prepare('SELECT Email_Info_Accueil FROM info_accueil');
$email -> execute();
$adresseEmail = $email -> fetch();
$adresseEmail = $adresseEmail['Email_Info_Accueil'];
// Récupération de l'emplacement du bureau du CSE
$place = $connexion -> prepare('SELECT Emplacement_Bureau_Info_Accueil FROM info_accueil');
$place -> execute();
$office = $place -> fetch();
$office = $office['Emplacement_Bureau_Info_Accueil'];

// Images partenaires
$imgPart = $connexion -> prepare("SELECT DISTINCT * FROM images ORDER BY RAND() LIMIT 3");
$imgPart -> execute();
$nomImg = $imgPart -> fetchAll();

// Récupération du Titre de la page d'accueil
$titreInfoAccueil = $connexion -> prepare('SELECT Titre_Info_Accueil FROM info_accueil');
$titreInfoAccueil -> execute();
$TitreAccueil = $titreInfoAccueil -> fetch();
$TitreAccueil = $TitreAccueil['Titre_Info_Accueil'];
// Récupération de la description de la page d'accueil
$texteInfoAccueil = $connexion -> prepare('SELECT Texte_Info_Accueil FROM info_accueil');
$texteInfoAccueil -> execute();
$TexteAccueil = $texteInfoAccueil -> fetch();
$TexteAccueil = $TexteAccueil['Texte_Info_Accueil'];



$offres = $connexion -> prepare("SELECT DISTINCT * FROM offre ORDER BY Id_Offre DESC LIMIT 3");
$offres -> execute();
$chaqueOffre = $offres -> fetchAll();
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>CSE Saint-Vincent - Accueil</title>
</head>
<body>
    <header>
        <div class="light-gray"></div>
        <div class="blue">
            <nav>
                <div class="logo"><img src="assets/logo_st_vincent_1.png" alt="logo_st_vincent"></div>
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
    <main>

        <?php require 'include/aside.php'?>

        <div class="right">
            <div class="info_accueil">
                <h2 class="title"><?=$TitreAccueil?></h2>
                <p><?=$TexteAccueil?></p>
                <p>Découvrez l'équipe et le rôle et missions de votre CSE.</p>
            </div>
            <h1>Dernières offres de la Billetterie</h1>
            
            
            <?php foreach($chaqueOffre as $offre ){

                $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

                $datedeb = $offre['Date_Debut_Offre'];
                $datefin = $offre['Date_Fin_Offre'];

                $datedeb_ind = date("d-m-y", strtotime($datedeb));
                $datedeb_ind = explode(" ", $datedeb_ind);
                $datedeb_ind = implode(" ", $datedeb_ind);

                $datefin_ind = date("d-m-y", strtotime($datefin));
                $datefin_ind = explode(" ", $datefin_ind);
                $datefin_ind = implode(" ", $datefin_ind);
            ?>

            <div class="offre_billetterie">
                <div class="offre_billetterie_header">
                    <span class="tag_offre">OFFRE</span>
                    <span class="date_offre">Offre valable du <?php echo $datedeb_ind ?> au <?php echo $datefin_ind?>.</span>
                </div>
                <p><?=$offre['Description_Offre']?></p>
                    <span class="learnmore">
                        <a href="billetterie.php">EN SAVOIR PLUS
                            <img class="chevron" src="assets/chevron-droit.png" alt="chevron">
                        </a>
                    </span>
            </div>
            <?php } ?>

            <a href="billetterie.php">
                <span id="offres_decouvrir">Découvrir toutes nos offres</span>
            </a>
        </div>
    </main>

    <?php require 'include/footer.php'?>
    </body>
</html>