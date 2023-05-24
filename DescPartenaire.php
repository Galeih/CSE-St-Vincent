<?php
require 'include/connectionbdd.php';
?>
<DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link  rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap">
        <link rel="icon" href="assets/sv_logo.png">
        <title>CSE Saint-Vincent - Description partenaire</title>
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
            <?php
                // Redirection pour afficher la desc partenaire
                if (isset($_GET['partInfos'])) {
                $req = $connexion->prepare("SELECT * FROM partenaire WHERE Id_Partenaire = :id");
                $req->bindParam('id', $_GET['partInfos']);
                $req->execute();
                $partenaire = $req->fetch();
                $reqImage = $connexion->prepare("SELECT Nom_Image FROM images WHERE Id_Image = :id");
                $reqImage->bindParam('id', $partenaire['Id_Image']);
                $reqImage->execute();
                $imagepartenaire = $reqImage->fetch();
            ?>

            <div class="right">
                <div>
                    <h1><?= $partenaire['Nom_Partenaire'] ?></h1>
                    <div class="imagePartenaire">
                        <img class="imagePartenaire" src="assets/<?php echo $imagepartenaire['Nom_Image'] ?>" alt="Image du partenaire">
                    </div>
                    <p><?= $partenaire['Description_Partenaire'] ?></p>
                    <a target="_blank" href="<?= $partenaire['Lien_Partenaire'] ?>"><div id="offres_decouvrir">Voir le Site officiel du Partenaire</div></a>
                </div>
                <div class="back">
                    <a href="partenariats.php?anciennepage=<?= isset($_GET['pageoffre']) ? $_GET['pageoffre'] : 1 ?>"><img src="assets/chevron-droit.png" class="chevron" alt="chevron">Retour</a>
                </div>
            </div>
            <?php } ?>

        </main>
    </body>
</HTML>
