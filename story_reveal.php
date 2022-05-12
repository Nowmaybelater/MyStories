<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<!--Cette page permet de révéler l'histoire quand celle-ci a été cachée, et renvoie sur une page qui confirme qui en confirme la réalisation-->
<main>
    <div id="backgroundConnexion">

        <?php
            $storyId=$_GET['id'];
            //la requête permet de changer le booléen qui régit la visibilité de l'histoire dans la table stories
            $req="UPDATE stories SET hide='0' WHERE id_story=?";
            $requete = $bdd->prepare($req);
            $requete->execute(array($storyId));
        ?>
        <br />
        <br />
        <br />
        <br />
        <div id="centre" class="alert alert-success" role="alert">
            <h3>L'histoire est à présent visible !</h3>
        </div>
        <br />
        <br />
        <br />
<!--le bouton permet de revenir à la page précédente, c'est-à-dire la liste des histoires écrites par l'utilisateur et dont il peut consulter les statistiques, etc-->        <div id="btn-lecture">
            <a id="size-btn" class="btn btn-outline-dark" href="ListeHistoires.php" role="button"> Retour à la page précédente </a>
        </div>
    </div>
    </main>
</body>

</html>