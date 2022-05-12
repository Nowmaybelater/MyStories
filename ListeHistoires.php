<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<!--Cette page permet à l'administrateur d'avoir un aperçu des histoires qu'il a écrites,ainsi que d'accéder à la possibilité de voir leurs 
statistiques, de les modifier, supprimer, cacher/révéler-->
<main>
    <div id="backgroundConnexion">
        <p class="titre"> Mes Histoires </p>
        <div id="centre">
            <a id="size-btn" class="btn btn-primary" href="story_add_info.php" role="button"> <i class="bi bi-plus-circle"></i> Nouvelle Histoire </a>
        </div>
        <br />
        <hr />
        <div>
            <?php
            $login = $_SESSION['login'];
            $requete = "SELECT * FROM stories WHERE author='$login'";
            $resultat = $bdd->query($requete);
            $compteur = 0; //le compteur permet de savoir si l'utilisateur a ou non écrit des histoires
            while ($histoire = $resultat->fetch()) {
                $compteur = $compteur + 1;
                $valeur = $histoire["id_story"];
            ?>
                <div>
                    <h2><em><?= $histoire['title'] ?></em></h2>
                    <h6 style="color:grey">Statut : <?php if ($histoire['finished'] == 0) {
                                                        echo "En cours";
                                                    } else {
                                                        echo "Terminée";
                                                    } ?>, Nombre de Chapitres : <?php echo $histoire['nbChapters']; ?>, Mis à jour le : <?php echo $histoire['date']; ?></h6>
                    <p><?= $histoire['summary'] ?></p>
                </div>
                <!--Dans la div qui suit se trouvent les boutons correspondant aux différentes actions possibles sur une histoire-->
                <div id="btn-lecture">
                    <a id="size-btn" class="btn btn-outline-dark" href="story_modify.php?id=<?= $histoire['id_story'] ?>" role="button">Modifier</a>
                    &nbsp;
                    <a id="size-btn" class="btn btn-outline-dark" href="story_delete.php?id=<?= $histoire['id_story'] ?>" role="button">Supprimer</a>
                    &nbsp;
                    <?php
                    //Si l'histoire est visible, le bouton Cacher apparaît, et inversement
                    if ($histoire['hide'] == '0') { ?>
                        <a id="size-btn" class="btn btn-outline-dark" href="story_hide.php?id=<?= $histoire['id_story'] ?>" role="button">Cacher</a>
                    <?php } else { ?>
                        <a id="size-btn" class="btn btn-outline-dark" href="story_reveal.php?id=<?= $histoire['id_story'] ?>" role="button">Révéler</a>
                    <?php } ?>
                    &nbsp;
                    <a id="size-btn" class="btn btn-outline-dark" href="story_stat.php?id=<?= $histoire['id_story'] ?>" role="button">Statistiques</a>
                </div>
                <hr />
            <?php
            }
            //Si le compteur est nul, l'utilisateur n'a pas encore écrit d'histoires et on le lui signale
            if ($compteur == 0) {
                echo "Vous n'avez encore rien écrit !";
            }
            ?>
        </div>

        <br />
        <a class="btn btn-success" id="btnHautPage" href="#top" role="button" title="Haut de page"> <i class="bi bi-caret-up-fill"></i> </a>
    </div>
</main>
</body>

</html>