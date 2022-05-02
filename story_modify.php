<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit"> Modification </p>
        <div>
            <form>













            </form>
            <?php
            $requete = "SELECT * FROM stories";
            $resultat = $bdd->query($requete);
            while ($histoire = $resultat->fetch()) {
                $valeur = $histoire["id_story"];
            ?>
                <div>
                    <h2><a href="StorySummary.php?id=<?= $valeur ?>" class="listeHistoires"><em><?= $histoire['title'] ?></em></a></h2>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>