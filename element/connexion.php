<?php
include("bdd.php");

//si le formulaire est soumis alors
if(isset($_POST['entrer']))
{
    //On verifie que tout les champs sont bien remplie
    if(!empty($_POST['login']) && !empty($_POST['password']))
    {
        $login_user = htmlspecialchars($_POST['login']);
        $pass_user =($_POST['password']);
        echo $login_user;

        // Si tout les champs sont ok alors on fait une requete en BDD pour connecter l'user
        $requete_connect =mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login='$login_user' ");
        $tableau=mysqli_fetch_assoc($requete_connect);
        $userexist = $requete_connect;

        
        if(isset($tableau['login']))
        {
        echo $tableau['login'];
        
        }

        if(isset($tableau['login']) && $tableau['login']==$login_user)
        {
            echo '<br>'.'login ok';         
            $_pass= $tableau['password'];

            if(password_verify($pass_user,$_pass)==TRUE)
            {
            echo 'ok c est le bon pass';
            $_SESSION['id']= $tableau['id'];
            $_SESSION['login']= $tableau['login'];
            $_SESSION['password']= $tableau['password'];
            header("location: index.php". $_SESSION['id']);

            }
            else
            $erreur = 'Mauvais mot de pass';
        }
       echo 'ok';

    }
  else 
    {
      $erreur = "Les informations ne sont pas corrects !";
       
    }    
}


    


?>


<html>

<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="style.css" />

    <?php
    // include("link.php")
    ?>
      <title>Connexion</title>
</head>

<?php
include("header.php"); 

?>

<body>

    <div id="container">
        <!-- zone de connexion -->

        <form action="connexion.php" method="POST">
            <h1>Connexion</h1>

            <label><b>Login d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le Login d'utilisateur" name="login" >

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="pass" >

            <input type="submit" id='submit' name ="entrer"value='LOGIN'>
            <?php
             if(isset($erreur))
             {
                 echo '<font color="red"> '.$erreur.'</font>';
             }
        
            ?>
        </form>
    </div>
    <footer> <?php
            // include("footer.php"); ?></footer>
</body>

</html>