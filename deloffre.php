<?php

require 'include/connectionbdd.php';

$id = "";

if(!empty($_GET['id'])) 
{
    $id =($_GET['id']);
}

/* requete delete */

if(!empty($_POST['id'])) 
{
    $id =($_POST['id']);

    $sql = "DELETE FROM offre WHERE Id_Offre = ?";
    $statement= $connexion->prepare($sql);
    $statement->execute(array($id));

    header("Location: offreview.php"); 
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Suppression d'un partenaire</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
     <body>
         <div class="container admin">
            <div class="row">
                <h1><strong>Supprimer une offre</strong></h1>
                <form class="form" action="deloffre.php" role="form" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                    <div class="form-actions">
                        <form action="offreview.php" method="POST" name="suppression">
                            <input type="hidden" name="suppression[id]" value="<?= $part['partenaire_id']?>">
                            <button class="deletebutton" type="submit">Supprimer</button>
                            <a class="bouttonnon" href="partview.php">Retour</a>
                        </form>
                    </div>
                </form>
            </div>
        </div> 
    </body>
</html>
