<?php
require 'include/connectionbdd.php';

$req = $connexion->prepare("SELECT Id_Partenaire FROM partenaire");
$req->execute();
$idPartenaire = $req->fetchAll();


$count = $connexion->prepare("SELECT COUNT(Id_Partenaire) as parten FROM partenaire");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$nb_elements_par_page = 8 ;
$pages = ceil($tcount[0]['parten'] / $nb_elements_par_page);
@$page = $_GET["page"];
// Verif validité 
if (empty($page)) {
    $page = 1;
}
$page = max(1, min($pages, $page));
// Verif Si contenu offre renvoie une valeur de page 
if (isset($_GET["anciennepage"])) {
    try {
        $valeur = intval($_GET["anciennepage"]);
        if (gettype($valeur == "integer")) {
            $page = $valeur;
        }
    } catch (Exception $e) {
        $page = 1;
    }
}
if ($page === 0) {
    $page = 1;
}

$debut = ($page - 1) * $nb_elements_par_page;
// Nombre de pages à afficher avant et après la page courante
$pagesAffiche = 1;
// Calcul du début et de la fin de la plage de pages à afficher
$startPage = max(1, $page - $pagesAffiche);
$endPage = min($pages, $page + $pagesAffiche);

$select = $connexion->prepare("SELECT Nom_Image FROM images WHERE Id_Image IN (SELECT Id_Image FROM partenaire ) LIMIT $debut, $nb_elements_par_page");
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();
$tab = $select->fetchAll();

$imgPartenaire = $connexion->prepare("SELECT Nom_Image FROM images WHERE Id_Image in (SELECT Id_Image FROM partenaire) LIMIT $debut , $nb_elements_par_page");
$imgPartenaire->execute();
$nomImgPartenaire = $imgPartenaire->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylePartenariats.css">
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
                    <a href="index.php">
                        <li>
                            Accueil
                        </li>
                    </a>
                    <a href="partenariats.php">
                        <li class="active">Partenariats</li>
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
        <?php require 'include/aside.php' ?>
        <div class="right">
            <h1>Tous nos partenaires</h1>
            <div class="partenaire-container">
                <?php
                foreach ($nomImgPartenaire as $index => $image) {
                    $test = $idPartenaire[$index];
                ?>
                    <div class="partenaire-item"><a href="DescPartenaire.php?modalpartenaire=<?= $test['Id_Partenaire'] ?>"><img src="assets/<?= $image['Nom_Image'] ?>" alt="Image du partenaire"></a></div>
                <?php } ?>
            </div>
            <div class="pagination">
                <?php
                for ($i = 1; $i <= $pages; $i++) {
                    if ($page != $i) {
                ?>
                    <a href="?page=<?= $i ?>"> <span class="page"><?= $i ?></span></a>
                <?php } else { ?>
                    <a href="?page=<?= $i ?>"> <span class="page activepage"><?= $i ?></span></a>
                <?php }
                } ?>
            </div>
        </div>
    </main>

    <?php require 'include/footer.php' ?>
    
    <?php
    // Modale pour selectionner le partenaire
    if (isset($_GET['modalpartenaire'])) {
        $req = $connexion->prepare("SELECT * FROM partenaire WHERE Id_Partenaire = :id");
        $req->bindParam('id', $_GET['modalpartenaire']);
        $req->execute();
        $partenaire = $req->fetch();
        $reqImage = $connexion->prepare("SELECT Nom_Image FROM images WHERE Id_Image = :id");
        $reqImage->bindParam('id', $partenaire['Id_Image']);
        $reqImage->execute();
        $imagepartenaire = $reqImage->fetch();
    ?>

        <!-- <div id="modalupdatepart" class="modal">
            <div class="modal-content">
                <span class="closeModif">&times;</span>
                <div class="formBox">
                    <h1 style="margin-bottom:20px;"><?= $partenaire['Nom_Partenaire'] ?></h1>
                    <div class="imagePartenaire">
                        <img class="imagePartenaire" src="assets/<?php echo $imagepartenaire['Nom_Image'] ?>" alt="Image du partenaire">
                    </div>
                    <p><?= $partenaire['Desc-Partenaire'] ?></p>
                    <a target="_blank" href="<?= $partenaire['Lien_Partenaire'] ?>"><div id="offres_decouvrir">Voir Site du Partenaire</div></a>
                </div>
            </div>
        </div> -->
    <?php } ?>
    </body>
</html>