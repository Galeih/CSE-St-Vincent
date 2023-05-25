<?php
require 'include/connectionbdd.php';

$req = $connexion->prepare("SELECT Id_Partenaire FROM partenaire");
$req->execute();
$idPartenaire = $req->fetchAll();

$count = $connexion->prepare("SELECT COUNT(Id_Partenaire) as part FROM partenaire");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$nb_elements_par_page = 10 ;
$pages = ceil($tcount[0]['part'] / $nb_elements_par_page);
@$page = $_GET["page"];

if (empty($page)) {
    $page = 1;
}
$page = max(1, min($pages, $page));

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

$start = ($page - 1) * $nb_elements_par_page;
$pagesAffiche = 1;
$startPage = max(1, $page - $pagesAffiche);
$endPage = min($pages, $page + $pagesAffiche);
$select = $connexion->prepare("SELECT Nom_Image FROM images WHERE Id_Image IN (SELECT Id_Image FROM partenaire ) LIMIT $start, $nb_elements_par_page");
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();
$tab = $select->fetchAll();
$imgPartenaire = $connexion->prepare("SELECT Nom_Image FROM images WHERE Id_Image in (SELECT Id_Image FROM partenaire) LIMIT $start , $nb_elements_par_page");
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
        <div class="light-gray"></div>
        <div class="blue">
            <nav>
                <div class="logo"><img src="assets/logo_st_vincent_1.png" alt="logo_st_vincent"></div>
                <ul>
                    <a href="index.php">
                        <li>Accueil</li>
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
                    <div class="partenaire-item"><a href="DescPartenaire.php?partInfos=<?= $test['Id_Partenaire'] ?>"><img src="assets/<?= $image['Nom_Image']?>" alt="Image du partenaire"></a></div>
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

    </body>
</html>