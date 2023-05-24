<?php
require 'include/connectionbdd.php';


$req = $connexion->prepare("SELECT * FROM partenaire");
$req->execute();
$Partenaire = $req->fetchAll();

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
        <title>CSE Saint-Vincent - Back - Partenariats</title>
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
                            <li class="active">
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
        <table>
            <thead>
                <tr>
                    <th>Nom partenaire</th>	
                    <th>Déscription partenaire</th>		
                    <th>Lien site partenaire</th>
                    <th>Id image</th>
                    <th>Image</th>
                    <th>modifier un partenaire</th>
                    <th>Supprimmer un partenaire</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($Partenaire as $part) {
                    $imagepartenaire = $connexion->prepare("SELECT Nom_Image FROM images WHERE Id_Image = :id");
                    $imagepartenaire->bindParam("id",$part['Id_Image']);
                    $imagepartenaire->execute();
                    $nomImgPartenaire = $imagepartenaire->fetch();
                ?>
                <tr>
                    <td><p class="imgpartview"><?= $part['Nom_Partenaire'] ?></p></td>
                    <td><p><?= $part['Description_Partenaire'] ?></td>
                    <td><a class="imgpartview" href="<?= $part['Lien_Partenaire'] ?>"><?= $part['Lien_Partenaire'] ?></a></td>
                    <td><p class="imgpartview"><?= $part['Id_Image'] ?></p></td>
                    <td><img class="imgpartview" src="assets/<?= $nomImgPartenaire['Nom_Image'] ?>"></td>
                    <td>
                        <a class="upPart" href="updatepart.php?id=<?= $part['Id_Partenaire'] ?>">modifier</a>
                    </td>
                    <td>
                        <a class="delPart" href="Delpartenaire.php?id=<?= $part['Id_Partenaire'] ?>">supprimmer</a>
                    </td>
                </tr>
                    <?php } ?>
            </tbody>
        </table>
        <a class="adPart" href="partajt.php">Ajouter un parteanire</a>
    </body>
</html>
