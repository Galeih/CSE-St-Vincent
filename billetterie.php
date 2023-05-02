<?php
require 'include/connectionbdd.php';
// Selectionne les offres 
$offers = $connexion -> prepare("SELECT DISTINCT * FROM offre ORDER BY Id_Offre DESC LIMIT 5");
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
    <?php require 'include/aside.php'?>
        <div class="right">
            <h1>Page de billetterie</h1>
            <?php foreach($chaqueOffre as $offers ){?>
            <div class="offre_billetterie">
                <div class="offre_billetterie_header">
                    <span class="tag_offre">OFFRE</span>
                    <span class="date_offre">Publié le <?php echo date('Y F d',strtotime($offers['Date_Debut_Offre']))?></span>
                </div>
                <p><?=$offers['Description_Offre']?></p>
                <span class="offre_learnmore"><a href="billetterie.php">EN SAVOIR PLUS<img class="chevron" src="assets/chevron-droit.png" alt="chevron"></a></span>
            </div>
                <?php } ?>
            <div class="pagination">
                <span class="page"><</span>
                <span class="page activepage">1</span>
                <span class="page">2</span>
                <span class="page">3</span>
                <span class="etc">...</span>
                <span class="page">5</span>
                <span class="page">></span>
            </div>
        </div>
    </main>
    <?php require 'include/footer.php'?>
</body>

</html>