<?php
include("bdd.php");

if (isset($_POST['envoyer'])) 
{

  if (!empty($_POST['commentaires'])) 
  {
    if (isset($_SESSION['id']))
     {
      $id = $_SESSION['id'];
 
      $com = str_replace("'", "\'", $_POST['commentaires']);
      $query = "INSERT INTO `commentaire`(`commentaires`, `id_utilisateur`, `date`) VALUES ('$com',$id, NOW())";

      $requete_insert = mysqli_query($bdd, $query);
       header("Location: index.php");
       exit;

    } 
    else 
    {
      $erreur = 'Veuillez vous inscrire pour laisser un commentaire !';
    
    }
  } else 
  {

    $erreur = "veuillez remplir tout les champs ";
  }

}

$requete_select = mysqli_query($bdd, "SELECT *, `date`, utilisateurs.login FROM `commentaire`
  INNER JOIN utilisateurs ON commentaire.id_utilisateur = utilisateurs.id
  WHERE 1 ORDER BY date DESC");
$result = mysqli_fetch_all($requete_select);


?>



<!DOCTYPE html>


<html lang="Fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


  <?php
  include("link.php") ?>


  <title>Accueil</title>
</head>
<header><?php
        include("header.php");
        ?></header>

<body>
  <main>

    <?php
    if (isset($erreur)) {
      echo '<p style="color:red"> ' . $erreur . '</p>';
    }

    ?>
    <div align=center>
       <form action="" method="POST">
      <textarea  class="textes" name="commentaires" placeholder="Laisser votre commentaire" id="commentaires" cols="50" rows="7"></textarea><br>
      <input type="submit" value="Envoyer" name="envoyer" class="btn btn-primary">
    </form>
    </div>
   

    <ul class="tableau">
      <?php

      foreach ($result as $key => $value) {
        echo '<hr><li><p>' . $value[1] . '</p><br/><p class="blue">' . $value[5] . '</p>' . $value[3] . '</li><hr>';
      }

      ?>


    </ul>




  </main>
  <footer>
    <?php
    include("footer.php");
    ?>
  </footer>

</body>


</html>