<?php
require 'include/connectionbdd.php';

 //Récupération des données de Téléphone
$numtel = $connexion -> prepare('SELECT Num_TEL_Info_Accueil FROM info_accueil');
$numtel ->execute();
$phone = $numtel->fetch();
$phone = $phone['Num_TEL_Info_Accueil'];

//Récpération des données de l'email
$email = $connexion -> prepare('SELECT Email_Info_Accueil FROM info_accueil');
$email ->execute();
$adresseEmail = $email->fetch();
$adresseEmail = $adresseEmail['Email_Info_Accueil'];

//Récupération des données de l'emplacement du bureau du CSE
$place = $connexion -> prepare('SELECT Emplacement_Bureau_Info_Accueil FROM info_accueil');
$place ->execute();
$office = $place->fetch();
$office = $office['Emplacement_Bureau_Info_Accueil'];

//Images partenaires aléatoires sous une limite de 3
$imagepartenaire = $connexion -> prepare("SELECT DISTINCT * FROM images WHERE Id_Image in (SELECT Id_Image FROM partenaire) ORDER BY RAND() LIMIT 3 ");
$imagepartenaire -> execute();
$nomImg = $imagepartenaire->fetchAll();

?>

<aside class="left">
    <div class="home">
        <img src="assets/accueil.png">
        <img src="assets/chevron-droit.png" class="chevron">
        <a href="index.php" class="access-title">Accueil</a>
    </div>
    <div>
        <h1 class="access-title">Accès rapide</h1>
        <div class="offreaccess">
            <img src="assets/chevron-droit.png" class="chevron">
            <a href="billetterie.php">Offre / Billetterie</a>
        </div>
        <div class="contactaccess">
            <img src="assets/chevron-droit.png" class="chevron">
            <a href="contact.php">Nous contacter</a>
        </div>
    </div>
    <div class="infocontact">
        <h1 class="access-title">Informations de contact</h1>
        <div class="tel">
            <p><img src="assets/chevron-droit.png" class="chevron">
                Par téléphone : <a target="_blank" href="tel:+33303030303">+<?=$phone ?></a>
            </p>
        </div>
        <div class="email">
            <p><img src="assets/chevron-droit.png" class="chevron">
                Par email : <a target="_blank" href="mailto:cse@lyceestvincent.fr"><?= $adresseEmail ?></a>
            </p>
        </div>
        <div class="place">
            <p><img src="assets/chevron-droit.png" class="chevron">
                Au lycée : <?= $office ?></a>
            </p>
        </div>
    </div>
    <div class="partenaire">
        <h1 class="access-title">Nos partenaires</h1>
    </div>
    <div class="decouverte">
        <a href="partenariats.php">Découvrir tous nos partenaires</a>
    </div>
</aside>