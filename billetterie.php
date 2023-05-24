<?php
require 'include/connectionbdd.php';

$count = $connexion->prepare("SELECT COUNT(Id_Offre)  as infos FROM offre");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount = $count->fetchAll();

$nb_elements_par_page = 5;
$pages = ceil($tcount[0]['infos'] / $nb_elements_par_page);
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

$select = $connexion->prepare("SELECT * FROM offre ORDER BY Date_Debut_Offre desc LIMIT $debut, $nb_elements_par_page ");
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();
$tab = $select->fetchAll();

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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/sv_logo.png">
    <title>CSE Saint-Vincent - Billetterie</title>
</head>
<body>
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
        <div class="right_billetterie">
            <h1>Toutes nos offres</h1>

            <?php foreach ($tab as $offre) {
                $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

                $datedeb = $offre['Date_Debut_Offre'];
                $datefin = $offre['Date_Fin_Offre'];

                $datedeb_formattee = date("d-m-y", strtotime($datedeb));
                $datedeb_formattee = explode(" ", $datedeb_formattee);
                $datedeb_formattee = implode(" ", $datedeb_formattee);

                $datefin_formattee = date("d-m-y", strtotime($datefin));
                $datefin_formattee = explode(" ", $datefin_formattee);
                $datefin_formattee = implode(" ", $datefin_formattee);
            ?>

            <div class="offre_billetterie">
                <div class="offre_billetterie_header">
                    <span class="tag_offre">OFFRE</span>
                    <span class="date_offre">Offre valable du <?php echo $datedeb_formattee ?> au <?php echo $datefin_formattee?>.</span>
                </div>
                <p><?= $offre['Description_Offre'] ?></p>
                <span class="offre_learnmore"><a href="infosOffre.php?id=<?= $offre['Id_Offre'] ?>&pageoffre=<?= $page ?>">EN SAVOIR PLUS <img class="chevron" src="assets/chevron-droit.png" alt="chevron"> </a></span>
            </div>

            <?php } ?>

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
    <?php require 'include/footer.php'?>
</body>

</html>