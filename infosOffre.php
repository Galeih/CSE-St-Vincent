<?php

require 'include/connectionbdd.php';

// Si $_GET est vide alors renvoie sur la page billetterie
if (empty($_GET) || empty($_GET['id'])) {
    header('Location: billetterie.php');
}

//Selection des valeurs de la table offre
$selectOffre = $connexion->prepare('SELECT * FROM offre WHERE Id_Offre = :id;');
$selectOffre->bindParam(':id', $_GET['id']);
$selectOffre->execute();
$DescOffre = $selectOffre->fetch(PDO::FETCH_ASSOC);

//Selection du nom de l'image par rapport a l'id de l'offre pour le partenaire
$imgContenuBilletterie = $connexion->prepare("SELECT images.Nom_Image, images.Id_Image FROM images INNER JOIN partenaire ON images.Id_Image = partenaire.Id_Image INNER JOIN offre ON partenaire.Id_Partenaire = offre.Id_Partenaire WHERE offre.Id_Offre = :id");
$imgContenuBilletterie->bindParam(":id", $_GET["id"]);
$imgContenuBilletterie->execute();
$imgContenu = $imgContenuBilletterie->fetch();

//Selection des données de la table partenaire en fonction de l'id de l'offre
$modalLink = $connexion->prepare("SELECT* FROM partenaire INNER JOIN offre ON partenaire.Id_Partenaire = offre.Id_Partenaire WHERE offre.Id_Offre = :id");
$modalLink->bindParam(":id", $_GET["id"]);
$modalLink->execute();
$link = $modalLink->fetch();

//Selection des images associées aux offres
$imgPourContenu = $connexion->prepare("SELECT images.Nom_Image FROM images INNER JOIN offre_image ON images.Id_Image = offre_image.Id_Image INNER JOIN offre ON offre_image.Id_Offre = offre.Id_Offre WHERE offre.Id_Offre = :id");
$imgPourContenu->bindParam(':id', $_GET['id']);
$imgPourContenu->execute();
$imgPourContenu = $imgPourContenu->fetchAll();


//Changement des mois d'anglais en français
$months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

    $datedeb = $DescOffre['Date_Debut_Offre'];
    $datefin = $DescOffre['Date_Fin_Offre'];

    $datedeb_ind = date("d-m-y", strtotime($datedeb));
    $datedeb_ind = explode(" ", $datedeb_ind);
    $datedeb_ind = implode(" ", $datedeb_ind);

    $datefin_ind = date("d-m-y", strtotime($datefin));
    $datefin_ind = explode(" ", $datefin_ind);
    $datefin_ind = implode(" ", $datefin_ind);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/sv_logo.png">
    <title>CSE Saint-Vincent - <?= $DescOffre['Nom_Offre'] ?></title>
</head>

<body id="body" class="no-transition">
    <div class="bodyDiv">
    <header>
        <div class="light-gray"></div>
        <div class="blue">
            <nav>
                <div class="logo"><img src="assets/logo_st_vincent_1.png" alt="logo_st_vincent"></div>
                <ul>
                    <a href="base.php">
                        <li>
                            Accueil
                        </li>
                    </a>
                    <a href="partenariats.php">
                        <li>Partenariats</li>
                    </a>
                    <a href="billetterie.php">
                        <li class="active">Billetterie</li>
                    </a>
                    <a href="contact.php">
                        <li>Contact</li>
                    </a>
                </ul>
            </nav>
        </div>
    </header>
        <main>
            <?php require 'include/aside.php' ?>

            <div class="right">
                <?php if (count($imgPourContenu) > 0) { ?>
                    <div class="divImagesOffre">
                        <?php foreach ($imgPourContenu as $imgContent) { ?>
                            <img src="assets/<?= $imgContent['Nom_Image'] ?>" alt="imgContenu" style="width:calc(100% / <?php echo count($imgPourContenu) ?>);">
                        <?php } ?>
                        <div class="img_gradient">
                        </div>
                    </div>
                <?php } ?>
                <h1><?= $DescOffre['Nom_Offre'] ?></h1>
                <div class="Description_Offre">
                    <p>
                        <?= $DescOffre['Description_Offre'] ?>
                    </p>
                </div>
                <div class="date_offre">
                    <span class="date_offre">Offre valable du <?php echo $datedeb_ind ?> au <?php echo $datefin_ind ?>.</span>
                </div><div class="img_partenaire">
                        <div class="contain_img_partenaire">
                            <h1>Partenaire</h1>
                            <a href="partenariats.php">
                                <img src="<?php echo "assets/" . $imgContenu['Nom_Image'] . "" ?>" alt="Image du partenaire">
                                <p id="voirPlus">Voir plus</p>
                            </a>
                        </div>
                    </div>
                <div class="back">
                    <a href="billetterie.php"><img src="assets/chevron-droit.png" class="chevron" alt="chevron">Retour</a>
                </div>
            </div>
        </main>

        <?php require 'include/footer.php' ?>
        
    </div>
</body>

</html>