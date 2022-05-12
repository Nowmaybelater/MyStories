<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<!--Cette page permet à l'utilisateur de se connecter sur le site en utilisant ses identifiants-->
<?php
// pour se protéger des attaques XSS
function escape($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}?>

<main>
    <div id=backgroundConnexion>
        <h2 class="connexion">Connexion</h2>
        <?php
        //Si les deux champs (login et mot de passe) sont remplis, on effectue les vérifications nécessaires avant de connecter l'utilisateur
        //il faut que la combinaison login/mot de passe soit la bonne, sinon on affiche un message d'erreur
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $login = escape($_POST['login']);
            $mdp = escape($_POST['password']);
            $requete = $bdd->prepare('SELECT * FROM user WHERE login_usr=? AND password_usr=?');
            $requete->execute(array($login, $mdp));
            if ($requete->rowCount() == 1) {
                $_SESSION['login'] = $login;
                header("Location: index.php");
            } 
            else { ?>
                <div class="erreurmdp">Mot de passe ou nom d'utilisateur incorrect</div>
        <?php
            }
        }


        ?>



        <br />
        <div class="well"></div>
        <!--L'affichage du formulaire commence ici-->
        <form class="form-signin form-horizontal" role="form" action="login.php" method="post" pb-autologin="true" autocomplete="off" id="formul">
            <div class="form-group" id="centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input type="text" name="login" class="form-control" placeholder="Entrez votre login" required="" autofocus="" pb-role="username">
                </div>
            </div>
            <br />
            <div class="form-group" id="centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required="" pb-role="password">
                </div>
            </div>
            <br />
            <!--Si l'utilisateur ne dispose pas de compte, il peut aller sur la page d'inscription pour en créer un-->
            <div id="centre">
                <a href="inscription.php" style="font-size : 0.5cm"> Pas de compte ? Inscrivez-vous !</a>

            </div>
            <br />
            <div class="form-group" id="centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <button id="size-btn" type="submit" class="btn btn-default btn-primary" pb-role="submit"><span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
                </div>
            </div>
            <br />
        </form>
    </div>
</main>
</body>

</html>