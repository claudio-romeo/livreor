<?php 
include("bdd.php"); 

if (isset($_POST['envoyer'])) 
{
  if (!empty($_POST['commentaires']))
  {
    $id =$_SESSION['id'];

    $com = $_POST['commentaires'];

    $requete_insert = mysqli_query($bdd, "INSERT INTO `commentaire`(`commentaires`, `id_utilisateur`, `date`) VALUES ('$com','$id', NOW())");


  
  }
  else 
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <!-- <link rel="stylesheet" href="style.css" /> -->


  <title>Accueil</title>
</head>
<header><?php
    include("header.php");
   ?></header>
<body>
  <main>

  
<form action="" method="POST">
<textarea name="commentaires" placeholder="Laisser votre commentaire" id="commentaires" cols="30" rows="10"></textarea><br>
<input type="submit" value="Envoyer" name="envoyer" class="btn btn-primary">
</form>

<ul class="tableau">
        <?php
        foreach ($result as $key => $value) {
            echo "<li> $value[1] $value[3] $value[5] </li>";
        }
        ?>


    </ul>
 

  
<?php
            if (isset($erreur)) {
                echo '<font color="red"> ' . $erreur . '</font>';
            }

            ?>
    
  </main>


</body>
<footer>
<?php 
  include("footer.php")
  ?>
  </footer>

</html>