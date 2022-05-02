<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
    <div id="backgroundConnexion">
        <p class="titre"> Mes Histoires </p>
        <br />
        <div>
            <?php
            $requete = "SELECT * FROM stories";
            $resultat = $bdd->query($requete);
            while ($histoire = $resultat->fetch()) {
                $valeur = $histoire["id_story"];
            ?>
                <div>
                    <h2><em><?= $histoire['title'] ?></em> par <?= $histoire['author'] ?></h2>
                    <p><?= $histoire['summary'] ?></p>
                </div>
                <div id="btn-lecture">
                    <a class="btn btn-outline-dark" href="story_modify.php?id=<?= $histoire['id_story']?>" role="button">Modifier</a>
                    &nbsp;
                    <a class="btn btn-outline-dark" href="story_delete.php?id=<?= $histoire['id_story']?>" role="button">Supprimer</a>
                    &nbsp;
                    <?php
                    if($histoire['hide']=='0'){?>
                        <a class="btn btn-outline-dark" href="story_hide.php?id=<?= $histoire['id_story']?>" role="button">Cacher</a>
                    <?php }
                    else{?>
                        <a class="btn btn-outline-dark" href="story_reveal.php?id=<?= $histoire['id_story']?>" role="button">Révéler</a>
                    <?php } ?>
                    &nbsp;
                    <a class="btn btn-outline-dark" href="story_stat.php?id=<?= $histoire['id_story']?>" role="button">Statistiques</a>
                </div>
                <hr />
            <?php
            }
            ?>
        </div>

        <br />
        <a class="btn btn-success" id="btnHautPage" href="#top" role="button"> <i class="bi bi-caret-up-fill"></i> </a>
    </div>
</main>
</body>