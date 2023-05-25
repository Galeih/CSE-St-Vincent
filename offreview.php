<?php
require 'include/connectionbdd.php';

$req = $connexion->prepare("SELECT * FROM offre");
$req->execute();
$Billetterie = $req->fetchAll();

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
        <title>CSE Saint-Vincent - Back - Billetterie</title>
    </head>
    <body>
        <header>
            <div class="light-gray"></div>
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
                            <li>
                                Back-Partenariats
                            </li>
                        </a>
                        <a href="offreview.php">
                            <li class="active">
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
        <table style="margin: 60px;">
            <thead>
                <tr>
                    <th style="width: 10%;border: black solid 5px;">Nom offre</th>	
                    <th style="width: 30%;border: black solid 5px;">Description offre</th>		
                    <th style="border: black solid 5px;">Date début offre</th>
                    <th style="border: black solid 5px;">Date fin offre</th>
                    <th style="border: black solid 5px;">Nombre places offre</th>
                    <th style="width: 10%;border: black solid 5px;">Modifier offre</th>
                    <th style="width: 10%;border: black solid 5px;">Supprimer offre</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($Billetterie as $offer) {?>
                
                <tr style="text-align: justify; width: 130px;">
                    <td><p style="padding: 10px;" class="partform"><?= $offer['Nom_Offre'] ?></p></td>
                    <td><p style="padding: 10px;"><?= $offer['Description_Offre'] ?></p></td>
                    <td><p style="padding: 10px;"><?= $offer['Date_Debut_Offre'] ?></p></td>
                    <td><p style="padding: 10px;"><?= $offer['Date_Fin_Offre'] ?></p></td>
                    <td><p style="padding: 10px;"><?= $offer['Nombre_Place_Min_Offre'] ?></p></td>

                    <td>
                        <a class="upPart" href="updatebillet.php?id=<?= $offer['Id_Offre'] ?>">modifier</a>
                    </td>
                    <td>
                        <a class="delPart" href="Delpartenaire.php?id=<?= $offer['Id_Offre'] ?>">supprimer</a>
                    </td>

                </tr>
                    <?php } ?>
            </tbody>
        </table>
        <div style="display: flex; justify-content: center; padding: 10px;">
            <a class="adPart" href="offreajt.php" style="padding: 10px; border-radius: 10px;">Ajouter offre</a>
        </div>
    </body>
</html>