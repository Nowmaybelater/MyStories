<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<!--Cette page permet de confirmer la suppression de l'histoire par l'administrateur-->
<main>
    <div id="backgroundConnexion">
        <br />
        <br />
        <br />
        <br />
        <div id="centre" class="alert alert-success" role="alert">
            L'histoire a été supprimée avec succès!
        </div>
        <br />
        <br />
        <br />
        <!--le bouton permet de revenir à la page précédente, c'est-à-dire la liste des histoires écrites par l'utilisateur et dont il peut consulter les statistiques, etc-->
        <div id="btn-lecture">
            <a id="size-btn" class="btn btn-outline-dark" href="ListeHistoires.php" role="button"> Retour à la page précédente </a>
        </div>
    </div>
</main>
</body>

</html>