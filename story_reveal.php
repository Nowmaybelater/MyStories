<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">

        <?php
            $storyId=$_GET['id'];
            //on suprime toutes les lignes faisant référence à cette histoire
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
        <div id="btn-lecture">
            <a id="size-btn" class="btn btn-outline-dark" href="ListeHistoires.php" role="button"> Retour à la page précédente </a>
        </div>
    </div>
    </main>
</body>

</html>