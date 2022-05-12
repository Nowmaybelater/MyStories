<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<!--Cette page permet l'affichage de toutes les informations relatives à l'histoire sur laquelle l'utilisateur a décidé d'en savoir plus-->
<main>
    <div id=backgroundConnexion>
        <?php
        //requêtes php pour récupérer le login de l'utilisateur connecté
        $requete = "SELECT * FROM user WHERE login_usr = :usr_login";
        $req = $bdd->prepare($requete);
        $req->execute(array(
            'usr_login' => $_SESSION['login'],
        ));
        $ligne = $req->fetch();
        $id_user = $ligne['id_usr'];
        //requête pour récupérer l'id_story, identifiant de l'histoire, qui permettra d'afficher seulement les informations relatives à cette histoires
        $requete = "SELECT * FROM stories WHERE id_story = :id";
        $req = $bdd->prepare($requete);
        $req->execute(array('id' => $_GET['id']));

        //requête pour récupérer les informations relatives à l'histoire
        $histoire = $req->fetch();
        $nbrChapitre = $histoire['nbChapters'];
        ?>
        <!--l'affichage des informations relatives à l'histoire commence ici-->
        <h1 id="centre"><?php echo $histoire['title']; ?></h1>
        <h3 id="centre"><?php echo $histoire['author']; ?></h3>
        <h6 id="donneesHistoire">Statut : <?php if ($histoire['finished'] == 0) {
            echo "En cours";
        } else {
            echo "Terminée";
        } ?>, Nombre de Chapitres : <?php echo $histoire['nbChapters']; ?>, Mis à jour le : <?php echo $histoire['date']; ?></h6>
        <br />
        <h4 id="centre">Résumé</h4>
        <p> <?php echo $histoire['summary']; ?> </p>
        <hr />
        <h4 id="centre">Modalités</h4>
        <p>Vous commencez cette histoire avec un total de <?= $histoire['nbrPoints'] ?> points de vie. Vous perdez des points de vie lorsque votre choix est dangereux et/ou blesse votre personnage. Si le nombre de vos points de vie tombe à 0, votre personnage échoue et l’histoire se termine. Attention, il existe également de très mauvais choix, qui peuvent conduire à l'échec immédiat de votre personnage et donc à la fin de l’histoire. Soyez donc bien attentifs aux différentes propositions qui s’offrent à vous, et tentez d’arriver jusqu’au bout de cette aventure !</p>
        <br />
        <br />
        <div id="centre">
            <!--si l'histoire n'a pas encore de chapitre, l'utilisateur ne peut pas en commencer la lecture-->
            <?php if ($nbrChapitre == 0) {
                echo "Cette histoire n'a pas encore de chapitre";
            }
            ?>
        </div>
        <!--l'affichage des boutons commence ici-->
        <div id="btn-lecture">
            <?php
            $id_story = $_GET['id'];
            $requete2 = "SELECT * FROM advancement WHERE id_story = :id_story AND id_usr = :id_usr";
            $req2 = $bdd->prepare($requete2);
            $req2->execute(array(
                'id_story' => $id_story,
                'id_usr' => $id_user
            ));
            //Si l'utilisateur a déjà commencé à lire l'histoire, il peut reprendre là où il s'était arrêté. Sinon, il peut démarrer l'histoire au début
            //Dans les deux cas, l'utilisateur peut décider de revenir à la page d'accueil pour choisir une autre histoire. 
            if ($req2->rowCount() == 1 && $nbrChapitre != 0) {
                $ligne = $req2->fetch();
                $chapter = $ligne['numChapter'];
                $link = "chapter.php?story_id=$id_story&chapter_num=$chapter&choice_num=0&prev_chap=0"; ?>
                <a id="size-btn" class="btn btn-outline-dark" href=<?= $link ?> role="button">Reprendre la lecture !</a><?php
                } 
                else {
                    if ($nbrChapitre != 0) {
                        $link = "chapter.php?story_id=$id_story&chapter_num=1&choice_num=0&prev_chap=0"; ?>
                    <a id="size-btn" class="btn btn-outline-dark" href=<?= $link ?> role="button">Commencer la lecture !</a> <?php
                    }
                }
                ?>
            &nbsp;
            <a id="size-btn" class="btn btn-outline-secondary" href="index.php" role="button">Retour à l'accueil</a>
        </div>
    </div>
</main>
</body>

</html>