<?php
require 'include/connectionbdd.php';

$req = $connexion->prepare("SELECT * FROM message");
$req->execute();
$Contact = $req->fetchAll();

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
        <title>CSE Saint-Vincent - Back - Messagerie</title>
    </head>
    <body>
        <header>
            <div class="light-gray"></div>
            <div class="blue">
                <nav>
                    <div class="logo"><img src="assets/logo_st_vincent_1.png" alt="logo_st_vincent"></div>
                    <ul>
                    <a href="updateaccueil.php">
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
                    <th style="width: 10%;border: black solid 5px;">Nom utilisateur</th>	
                    <th style="width: 30%;border: black solid 5px;">Prénom utilisateur</th>		
                    <th style="border: black solid 5px;">Adresse mail utilisateur</th>
                    <th style="width: 20%;border: black solid 5px;">Contenu message</th>
                    <th style="width: 10%;border: black solid 5px;">Supprimer partenaire</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($Contact as $cont) {?>
                <tr style="text-align: justify; width: 130px;">
                <td><p class="partform" style="padding: 10px;"><?= $cont['Nom_Message'] ?></p></td>
                    <td><p style="padding: 10px;"><?= $cont['Prenom_Message'] ?></p></td>
                    <td><p style="padding: 10px;"><?= $cont['Email_Message'] ?></p></td>
                    <td><p style="padding: 10px;"><?= $cont['Contenu_Message'] ?></p></td>
                    <td>
                        <a class="delPart" style="margin: 5px 0px 5px 0px" href="delmessage.php?id=<?= $cont['Id_Message'] ?>">supprimer</a>
                    </td>
                </tr>
                    <?php } ?>
            </tbody>
        </table>
    </body>
</html>