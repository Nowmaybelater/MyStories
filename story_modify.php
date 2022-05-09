<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
    <div id="backgroundConnexion">
        <?php
        $id_story=$_GET['id'];

        //affichage du titre et des informations relatives à l'histoire
        $requete = "SELECT * FROM user WHERE login_usr = :usr_login";
        $req = $bdd->prepare($requete);
        $req->execute(array(
            'usr_login' => $_SESSION['login'],
        ));
        $ligne = $req->fetch();
        $id_user = $ligne['id_usr'];

        $requete = "SELECT * FROM stories WHERE id_story = :id";
        $req = $bdd->prepare($requete);
        $req->execute(array('id' => $id_story));

        $histoire = $req->fetch();
        ?> <h1 id="centre"><?php echo $histoire['title']; ?></h2>
            <h3 id="centre"><?php echo $histoire['author']; ?></h3>
            <h6 id="donneesHistoire">Statut : <?php if ($histoire['finished'] == 0) {
                                                    echo "En cours";
                                                } else {
                                                    echo "Terminée";
                                                } ?>, Nombre de Chapitres : <?php echo $histoire['nbChapters']; ?>, Mis à jour le : <?php echo $histoire['date']; ?></h6>
            <br />

            <!--Possibilité d'ajouter un nouveau chapitre-->
            <div id="centre">
                <a class="btn btn-primary" href="story_add_chapter.php?id=<?= $id_story?>" role="button"> <i class="bi bi-plus-circle"></i> Nouveau Chapitre </a>
                &nbsp;
                <!--Possibilité de marquer l'histoire comme terminée : CE SERAIT INCROYABLE DE FAIRE EN SORTE QUE L'INVERSE SOIT POSSIBLE !!! -->
                <a class="btn btn-primary" href="ConfirmationTerminee.php?id=<?= $id_story?>" role="button"> <i class="bi bi-check-circle"></i> Histoire Terminée</a>
            </div>
            <br />
            <!--possibilité de modifier les infos générales de l'histoire (titre, résumé, nombre de points de vie)-->

            <div>
                <h2><em>Informations générales</em></h2>
            </div>
            <div id="btn-lecture">
                <a class="btn btn-outline-dark" href="story_modify_info.php?id=<?= $id_story ?>" role="button">Modifier</a>
            </div>
            <hr />
            <!--possibilité de modifier les chapitres existants de l'histoire-->
            <div>
                <?php
                $id = $_GET['id'];
                $requete = "SELECT * FROM chapters WHERE id_story='$id'";
                $resultat = $bdd->query($requete);
                $compteur = 0;
                while ($chapitre = $resultat->fetch()) {
                    $compteur = $compteur + 1;
                    $valeur = $chapitre["id_chapter"];
                ?>
                    <div>
                        <h2><em>Chapitre <?= $chapitre['numChapter'] ?></em></h2>
                    </div>
                    <div id="btn-lecture">
                        <a class="btn btn-outline-dark" href="story_modify_chapter.php?id_chapter=<?= $valeur ?>&id_story=<?= $id_story?>" role="button">Modifier</a>
                        &nbsp;
                        <a class="btn btn-outline-dark" href="story_delete_chapter.php?id=<?= $valeur ?>" role="button">Supprimer</a>
                    </div>
                    <hr />
                <?php
                }
                if ($compteur == 0) {
                    echo "Vous n'avez écrit aucun chapitre !";
                }
                ?>
            </div>
            <a class="btn btn-success" id="btnHautPage" href="#top" role="button" title="Haut de page"> <i class="bi bi-caret-up-fill"></i> </a>
    </div>
</main>
</body>