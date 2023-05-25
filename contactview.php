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
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link  rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap">
        <link rel="icon" href="assets/sv_logo.png">
        <title>CSE Saint-Vincent - Back - Partenariats</title>
    </head>
    <body>
        <header>
            <div class="light-gray"></div>
            <div class="blue">
                <nav>
                    <div class="logo"><img src="assets/logo_st_vincent_1.png" alt="logo_st_vincent"></div>
                    <ul>
                        <a href="update-accueil.php">
                            <li>
                                Back-Accueil
                            </li>
                        </a>
                        <a href="partview.php">
                            <li>
                                Back-Partenariats
                            </li>
                        </a>
                        <a href="offreview.php">
                            <li>
                                Back-Billetterie
                            </li>
                        </a>
                        <a href="contactview.php">
                            <li class="active">
                                Back-Contact
                            </li>
                        </a>
                    </ul>
                </nav>
            </div>
        </header>
        <table style="margin: 60px;">
            <thead>
                <tr>
                    <th style="width: 10%;border: black solid 5px;">Nom partenaire</th>	
                    <th style="width: 30%;border: black solid 5px;">Description partenaire</th>		
                    <th style="border: black solid 5px;">Lien site partenaire</th>
                    <th style="width: 20%;border: black solid 5px;">Image</th>
                    <th style="width: 10%;border: black solid 5px;">Modifier partenaire</th>
                    <th style="width: 10%;border: black solid 5px;">Supprimer partenaire</th>
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
                <tr style="text-align: justify; width: 130px;">
                    <td><p class="partform"><?= $part['Nom_Partenaire'] ?></p></td>
                    <td><p style="padding: 10px;"><?= $part['Description_Partenaire'] ?></p></td>
                    <td><a class="imgpartview" href="<?= $part['Lien_Partenaire'] ?>"><?= $part['Lien_Partenaire'] ?></a></td>
                    <td><img class="imgpartview" src="assets/<?= $nomImgPartenaire['Nom_Image'] ?>"></td>
                    <td>
                        <a class="upPart" href="updatepart.php?id=<?= $part['Id_Partenaire'] ?>">modifier</a>
                    </td>
                    <td>
                        <a class="delPart" href="Delpartenaire.php?id=<?= $part['Id_Partenaire'] ?>">supprimer</a>
                    </td>
                </tr>
                    <?php } ?>
            </tbody>
        </table>
        <div style="display: flex; justify-content: center; padding: 10px;">
            <a class="adPart" href="partajt.php" style="padding: 10px; border-radius: 10px;">Ajouter partenaire</a>
        </div>
    </body>
</html>