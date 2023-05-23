<?php
$parts = explode('/', $_SERVER["SCRIPT_NAME"]);
$file = $parts[count($parts) - 1];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/footer.css">
</head>
<body>
<footer>
    <div class="left_footer">
        <div class="logo_footer">
            <img src="assets/logo_st_vincent_1.png" alt="logo_st_vincent">
        </div>
    </div>
    <div class="right_footer">
        <div class="title_footer">
            <h1>CSE Lycée Saint-Vincent</h1>
        </div>
        <div class="links_footer">
        <!-- Définit les liens des pages du footer -->
            <ul class="links_list_footer">

                <?php if($file=='index.php'){?>
                <a href="partenariats.php">>Partenariats</a>
                <a href="billetterie.php">>Billetterie</a>
                <a href="contact.php">>Contact</a>
                <?php }?>

                <?php if($file=='partenariats.php'){?>
                <a href="partenariats.php">>Partenariats</a>
                <a href="billetterie.php">>Billetterie</a>
                <a href="contact.php">>Contact</a>
                <?php }?>

                <?php if($file=='billetterie.php'){?>
                <a href="partenariats.php">>Partenariats</a>
                <a href="billetterie.php">>Billetterie</a>
                <a href="contact.php">>Contact</a>
                <?php }?>

                <?php if($file=='contact.php'){?>
                <a href="partenariats.php">>Partenariats</a>
                <a href="billetterie.php">>Billetterie</a>
                <a href="contact.php">>Contact</a>
                <?php }?>
            </ul>
        </div>
    </div>
</footer>
</body>
</html>