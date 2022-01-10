<?php 

include("bdd.php");

if(isset($_POST['id']) && $_POST['id'] > 0)
{
    $login_profil = htmlspecialchars($_POST['id']);
    $postid = intval($_POST['id']);
    $requete_profil = mysqli_query($bdd, "SELECT* FROM utilisateurs WHERE login=$login_profil' ");
}
?>

<!DOCTYPE html>
 <html lang="Fr">

 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css" />
   <?php
    // include("link.php"); ?>

   <title>Profil</title>
 </head>

 <body>

   <?php include("header.php"); ?>

   <main class="text_profil">
     <P>
       <?php echo 'Bonjour et bienvenue ' . $_SESSION['login'] . ' si vous désirez changer vos informations <a href="edition.php">Mon profil</a>';
        ?>
        <br>
        <br>
      
     </P>



   </main>
   <footer> <?php
            include("footer.php"); ?></footer>
 </body>

 </html>