<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
    <div id=backgroundConnexion>
        <?php
        $requete = "SELECT * FROM stories WHERE id_story = :id";
        $req = $bdd->prepare($requete);
        $req->execute(array('id' => $_GET['id']));

        $histoire = $req->fetch();
        ?> <h1 id="centre"><?php echo $histoire['title']; ?></h2>
            <h3 id="centre"><?php echo $histoire['author']; ?></h3>
            <h6 id="donneesHistoire">Statut : <?php if ($histoire['finished'] = 0) {
                                                    echo "En cours";
                                                } else {
                                                    echo "Terminée";
                                                } ?>, Nombre de Chapitres : <?php echo $histoire['nbChapters']; ?>, Mis à jour le : <?php echo $histoire['date']; ?></h6>
            <h4> <?php echo $histoire['summary']; ?> </h4>
            <div id="btn-lecture">
                <a class="btn btn-outline-secondary" href="Index.php" role="button">Retour à l'accueil</a>
                &nbsp;
                <a class="btn btn-outline-dark" href="chapter.php?story_id=1&chapter_num=1 " role="button">Commencer la lecture !</a>
            </div>

    </div>
</main>
</body>

</html>