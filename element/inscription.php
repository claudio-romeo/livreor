<?php

include("bdd.php"); /* ceci est la base de donné*/


if (isset($_POST['form_inscription']))
// si le formulaire est soumis alors 
{
    if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['password2']))
        // on verifie que tous les champs sont différent de vide et 

        if ($_POST['password'] === $_POST['password2'])
        //si les deux mot de pass sont identique alors 
        {
            $requete = mysqli_query($bdd, "SELECT COUNT(*) FROM `utilisateurs` WHERE login = '$_POST[login]'");
            $result = mysqli_fetch_assoc($requete);
            // on fait une requete en BDD pour compter le nombre de login correspondant a celui rentrer par l'utilisateur

            if ($result['COUNT(*)'] == 1)
            // et on vérifie que le login est bien disponible
            {
                $erreurs = 'Login non disponible !';
            }
            // Si tout est ok alors on inscrit en base de donné 
            else 
            {
                $login = htmlspecialchars($_POST['login']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $requete_insert = mysqli_query($bdd, "INSERT INTO `utilisateurs`(`id`, `Login`, `password`) VALUES (NULL,'$login','$password')");

                // si tout est ok alors on redirige vers la page de connexion 
                header('location: connexion.php');
            }
        } 
            else 
            {
                $erreurs = "Vos password ne correspondent pas !";
            }
            else 
            {
                $erreurs = 'Tous les champs doivent être complété !';
            }           
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css" />
    <?php
    // include("link.php") ?>

    <title>inscription</title>
</head>

<body>
    <header>
        <?php
        include("header.php")
        ?>
    </header>


<body>
    <div align="center">
        <h2>Inscription</h2>
        <br /> <br />
        <form action="" method="POST">
            <table>
                <tr>
                    <td>
                        <label for="login">Votre pseudo:</label>
                    </td>

                    <td>
                        <input type="text" placeholder="Votre pseudo" name="login" value="<?php if (isset($login)) {
                                                                                                echo $login;
                                                                                            } ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password:</label>
                    </td>
                    <td>
                    <input type="password" placeholder="Mot de pass" id="password" name="password"> <br>
                    </td>
                    <td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Confirmer votre password:</label>
                    </td>
                    <td>
                    <input type="password" placeholder="Confirmer votre mot de pass" id="password2" name="password2"> <br></td>
                    </td> <br>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="envoyer" name="form_inscription">
                    </td>
                </tr>
                </tr>
            </table>
        </form>

        <?php
        if (isset($erreurs)) {
            echo '<font color="red">' . $erreurs . "";
        }
        ?>
    </div>
</body>

</html>