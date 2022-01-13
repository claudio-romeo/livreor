<?php 
include("bdd.php");
// si on est connecté 
if (isset($_SESSION['login'])) 
{
    // alors on met le login dans une variable 
    $login_entree=$_SESSION['login'];
    // Je vais recuperer les informations de la personne connecter 
    // $requete_connect =mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$login_entree' ");
    // $result= mysqli_fetch_assoc($requete_connect);var_dump(($result));
      $nom=$_SESSION['login'];
    // $prenom=$_SESSION['prenom'];

}

else {
    header('Location: index.php');

}
// exit();
    
    
  




if(isset($_POST['soumis'])) 
{
    
    if($_POST['pass'] == $_POST['pass2'])

    {
        $newlogin= htmlspecialchars($_POST['newlogin']);
      
        $newpass= password_hash($_POST['pass'], PASSWORD_DEFAULT);


        $requete =mysqli_query($bdd, "SELECT COUNT(*) FROM `utilisateurs` WHERE login = '$newlogin'");
         $result = mysqli_fetch_all($requete);
        $count= count($result);
        var_dump($result);
        var_dump($count);


        if($result[0][0] == 1 && $_POST['newlogin'] !=$login_entree)
        {
       echo $erreur="login non disponible ! ";
        }

        else 
        {
            
    
            $requete_insert= mysqli_query($bdd, "UPDATE `utilisateurs` SET `login`= '$newlogin',`password`= '$newpass'where login = '$login_entree'");
        
            $_SESSION['login']= $newlogin;
        
           
            $_SESSION['password']= $newpass;
            var_dump($_SESSION);

            echo "UPDATE `utilisateurs` SET `login`= '$newlogin',`password`= '$newpass'where login = '$login_entree'";

            header('location: profil.php?id='.$_SESSION['id']);
        }
        

    }
        else 
        
        {
            echo $erreur= "Erreur de saisie";
        }
        
   
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="style.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <?php
    include("link.php") ?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="edition">
<?php
include("header.php")
?>
    <h2>Profil de <?php

echo $_SESSION['login']; ?></h2>

<form action="" method="POST" class="profil_tab">
    <table >
        
        <input type="text" name="newlogin" placeholder="Modifier votre login" value="<?php echo $login_entree;?>"/><br>
    
        
        <input type="password" name="pass" placeholder="Nouveau Password"/><br>
        <input type="password" name="pass2" placeholder="verifier votre password"/><br>
        <input type="submit" name="soumis" value=" Mettre vos informations a jour">
        <?php
    if (isset($erreur)) {
      echo '<p style="color:red"> ' . $erreur . '</p>';
    }

    ?>
</table>
</form>

<footer> <?php
            include("footer.php"); ?></footer>
</body>
</html>
