<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit"> Choisissez une histoire à cacher </p>
        <div>
            <?php
            $requete = "SELECT * FROM stories"; //rajouter de quoi faire que l'utilisateur peut cacher uniquement les histoires que lui a écrites
            $resultat = $bdd->query($requete);
            while ($histoire = $resultat->fetch()) {
                $valeur = $histoire["id_story"];
            ?> <h2><a href="StorySummary.php?id=<?= $valeur ?>"><?= $histoire['title'] ?></a></h2>
            <?php
            }
            ?>
        </div>
    </div>
</main>