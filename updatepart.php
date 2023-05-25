<?php
    require 'include/connectionbdd.php';
?>
<?php
$Id = $NomError = $descriptionError = $dateError = $lienError  = $imageError = $NomPartenaire  = $DescriptionPartenaire = $LienPartenaire  = $NomImage = "";


if(!empty($_GET['id'])) 
{
        
    $Id = checkInput($_GET['id']);
    $statement = $connexion->prepare("SELECT * FROM `images`,`partenaire` WHERE images.Id_Image = partenaire.Id_Image AND Id_Partenaire = ?");
    $statement->execute(array($Id));
    $row = $statement->fetch();
    $NomPartenaire              = $row['Nom_Partenaire'];
    $DescriptionPartenaire      = $row['Description_Partenaire'];
    $LienPartenaire             = $row['Lien_Partenaire'];
    $NomImage                   = $row['Nom_Image'];
}


if(!empty($_POST['Nom_Partenaire']))
{
    $NomPartenaire              = checkInput($_POST['Nom_Partenaire']);
    $DescriptionPartenaire        = checkInput($_POST['Description_Partenaire']);
    $LienPartenaire               = checkInput($_POST['Lien_Partenaire']);
    $NomImage           = checkInput($_FILES["Nom_Image"]["name"]);
    $imagePath          = '/asset/'. basename($NomImage);
    $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
    $isSuccess          = true;
    $isUploadSuccess    = true;
 
    header("Location: partview.php");
    

    if(empty($NomPartenaire)) 
    {
        $NomError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(empty($DescriptionPartenaire)) 
    {
        $descriptionError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    } 

    if(empty($LienPartenaire)) 
    {
        $lienError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }

    if(empty($NomImage)) 
    {
        $isImageUpdated = false;
    }
    else
    {
        $isImageUpdated = true;

        if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
        {
            $imageError = "Les fichiers autorisés sont: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }

        if(file_exists($imagePath)) 
        {
            $imageError = "Le fichier existe deja";
            $isUploadSuccess = false;
        }

        if($_FILES["Nom_Image"]["size"] > 600000) 
        {
            $imageError = "Le fichier ne doit pas dépasser les 600KB";
            $isUploadSuccess = false;
        }

        if($isUploadSuccess)
        {
            if(!move_uploaded_file($_FILES["Nom_Image"]["tmp_name"], $NomImage))
            {
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            } 
        } 
    }
    
    if(($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) 
    { 
        if($isImageUpdated)
        {
            $statement = $connexion->prepare("UPDATE partenaire set Nom_Partenaire =? , Description_Partenaire =?, Lien_Partenaire =? WHERE Id_Partenaire =?");
            $statement->execute(array($NomPartenaire, $DescriptionPartenaire, $LienPartenaire, $Id));
            $statement = $connexion->prepare("UPDATE images set Nom_Image =? WHERE Id_Image = (SELECT Id_Image FROM partenaire WHERE Id_Partenaire =?)");
            $statement->execute(array($NomImage, $Id));
        }
        else
        {
            $statement = $connexion->prepare("UPDATE partenaire set Nom_Partenaire =? , Description_Partenaire =?, Lien_Partenaire =? WHERE Id_Partenaire =?");
            $statement->execute(array($NomPartenaire, $DescriptionPartenaire, $LienPartenaire, $Id));
        }

       
    }
    else if($isImageUpdated && !$isUploadSuccess)
    {
        $statement = $connexion->prepare("SELECT Nom_Image FROM images WHERE Id_Image =?;");
        $statement->execute(array($Id));
        $row = $statement->fetch();
        $Image = $row['Nom_Image'];
    }     
}

    function checkInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>modifier un partenaire</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>

    <body>
    <header>
            <div class="light-gray">
            </div>
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
                            <li class="active">
                                Back-Partenariats
                            </li>
                        </a>
                        <a href="offreview.php">
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
        <section id="update">
             <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="" >Modifier un parteanire</h1>
                    </div>
                    
                    <div class="col-lg-6 col-md-12 col-sm-12">

                        <form class="form" role="form" action="<?php echo 'updatepart.php?id='. $Id; ?>" method="post" enctype="multipart/form-data">

                            <label for="Nom_Partenaire" class="">Nom Partenaire :</label>
                            <input type="text" class="form-control" id="Nom_Partenaire" class="form-control" name="Nom_Partenaire" placeholder="Nom du partenaire :" value="<?php echo $NomPartenaire;?>">
                            <span class="help-inline"><?php echo $NomError;?></span>

                            <div class="form-group">
                                <label for="Description" class="">Description Partenaire :</p></label>
                                <input type="text" class="form-control" id="Description" class="form-control" name="Description_Partenaire" placeholder="Description du partenaire :" value="<?php echo $DescriptionPartenaire;?>">
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            </div>

                            <div class="form-group">
                                <label for="Lien_Partenaire" class="">Lien :</label>
                                <input type="text" class="form-control" id="Lien_Partenaire" class="form-control" name="Lien_Partenaire" placeholder="lien du partenaire :" value="<?php echo $LienPartenaire;?>">
                                <span class="help-inline"><?php echo $dateError;?></span>
                            </div>

                            <div class="form-group">
                                <label class="">Image:</label>
                                <p class=""><?php echo $NomImage;?></p>
                                <label for="Nom_Image" class="">Sélectionner une image:</label>
                                <input type="file" id="Nom_Image" name="Nom_Image" class=""> 
                                <span class="help-inline"><?php echo $imageError;?></span>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-actions">
                                    <button type="submit" class="">Modifier</button>
                                    <a id="btnretour" href="partview.php" class="btn btn-primary">Retour</a>
                                </div>
                            </div>
                            
                        </form>    
                    </div>
                </div>
            </div>
        </section>

    </body>
</html>

