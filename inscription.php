<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
    <div id=backgroundConnexion>
        <h2 class="connexion">Inscription à My Stories</h2>
        <?php
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $login = $_POST['login'];
            $mdp = $_POST['password'];
            $acces = "classique";
            $requete = $bdd->prepare('SELECT * FROM user WHERE login_usr=?');
            $requete->execute(array($login));
            if ($requete->rowCount() == 1) {
        ?><p class="erreurmdp"><?php echo "Le nom d'utilisateur est déjà assigné"; ?></p>
                <?php
            } else {
                if (strlen($mdp) < 8) {
                ?><p class="erreurmdp"><?php echo "Le mot de passe ne respecte pas le critère"; ?></p>
        <?php
                } else {
                    $req = $bdd->prepare('INSERT INTO user (login_usr, password_usr, acces) VALUES (:usr, :mdp, :acces)');
                    $req->execute(array(
                        'usr' => $login,
                        'mdp' => $mdp,
                        'acces' => $acces,
                    ));
                    $_SESSION['login'] = $login;
                    header("Location: Index.php");
                }
            }
        }
        ?>



        <br />
        <div class="well" id="connect"></div>
        <form class="form-signin form-horizontal" role="form" action="inscription.php" method="post" pb-autologin="true" autocomplete="off" id="formul">
            <div class="form-group" id="centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input type="text" name="login" class="form-control" placeholder="Entrez un nom d'utilisateur" required="" autofocus="" pb-role="username">
                </div>
            </div>
            <br />
            <div class="form-group" id="centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input type="password" name="password" class="form-control" placeholder="Entrez un mot de passe" required="" pb-role="password">
                    <h6>Le mot de passe doit avoir au moins 8 caractères</h6>
                </div>
            </div>
            <br />
            <div class="form-group" id="centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-default btn-primary" pb-role="submit"><span class="glyphicon glyphicon-log-in"></span> S'inscrire</button>
                </div>
            </div>
        </form>
    </div>
</main>
</body>

</html>