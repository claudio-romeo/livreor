<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul>
        <li class="tete"><a href="index.php">Accueil</a></li>
    </ul>

    <ul class="listindex">
        <?php
        if (!isset($_SESSION['login'])) {
        ?>
            <li><a href="connexion.php">connexion</a></li>
            <li><a href="inscription.php">inscription</a></li>
        <?php
        } elseif ($_SESSION['login'] == "admin") { ?>

            <li><a href="deconnexion.php">deconnexion</a></li>
            <li><a href="profil.php">profil</a></li>
            <li><a href="admin.php">admin</a></li>
        <?php
        } else {
        ?>
            <li><a href="deconnexion.php">deconnexion</a></li>
            <li><a href="profil.php">profil</a></li>


        <?php
        }

        ?>
    </ul>
</nav>