<?php

include("bdd.php");

//si le formulaire est soumis alors
if (isset($_POST['entrer'])) 
{
    //On verifie que tout les champs sont bien remplie
    if (!empty($_POST['login']) && !empty($_POST['password'])) 
    {
        $login_user = htmlspecialchars($_POST['login']);
        $pass_user = ($_POST['password']);
    

        // Si tout les champs sont ok alors on fait une requete en BDD pour connecter l'user
        $requete_connect = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE `login`='$login_user' ");
        $tableau = mysqli_fetch_assoc($requete_connect);
        $userexist = $requete_connect;


        if(isset($tableau['login']) && $tableau['login']==$login_user) { // S'il trouve pas de même login, il return false donc mauvais login
            $_pass = $tableau['password'];  // Récupere le resultat du tableau   /!\ et la colonne password
            if (password_verify($pass_user, $_pass)) // Si passwordconnect est hashé et qu'il est pareil que le password sql c'est bon 
            {
                $_SESSION['id'] = $tableau['id'];
                $_SESSION['login'] = $tableau['login'];
                $_SESSION['password'] = $tableau['password'];
                header("Location: index.php");
            } else {
                $erreur = "Mauvais login ou Mot de passe !";
            }
        } else
            $erreur = "Mauvais login ou Mot de passe !";
    } else {
        $erreur = "Tous les champs doivent être remplis !";
    }
}





?>


<html>

<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   


    <?php
    include("link.php")
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
            <input type="text" placeholder="Entrer le Login d'utilisateur" name="login">

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password">

            <input type="submit" id='submit' name="entrer" value='login'>
            <?php
    if (isset($erreur)) {
      echo '<p style="color:red"> ' . $erreur . '</p>';
    }

    ?>
        </form>
    </div>
    <footer> <?php
                include("footer.php"); 
                ?></footer>
</body>

</html>