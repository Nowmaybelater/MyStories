<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<main>
    <div id=backgroundConnexion>
        <?php

        $requete = "SELECT * FROM user WHERE login_usr = :usr_login";
        $req = $bdd->prepare($requete);
        $req->execute(array(
            'usr_login' => $_SESSION['login'],
        ));
        $ligne = $req->fetch();
        $id_user = $ligne['id_usr'];

        $requete = "SELECT * FROM stories WHERE id_story = :id";
        $req = $bdd->prepare($requete);
        $req->execute(array('id' => $_GET['id']));

        $histoire = $req->fetch();
        ?> <h1 id="centre"><?php echo $histoire['title']; ?></h2>
            <h3 id="centre"><?php echo $histoire['author']; ?></h3>
            <h6 id="donneesHistoire">Statut : <?php if ($histoire['finished'] == 0) {
                                                    echo "En cours";
                                                } else {
                                                    echo "Terminée";
                                                } ?>, Nombre de Chapitres : <?php echo $histoire['nbChapters']; ?>, Mis à jour le : <?php echo $histoire['date']; ?></h6>
            <br />
            <h4 id="centre">Résumé</h4>
            <h5> <?php echo $histoire['summary']; ?> </h5>
            <hr/>
            <h4 id="centre">Modalités</h4>
            <h5>Vous commencez cette histoire avec un total de <?=$histoire['nbrPoints']?> points de vie. Vous perdez des points de vie lorsque votre choix est dangereux et/ou blesse votre personnage. Si le nombre de vos points de vie tombe à 0, votre personnage meurt et l’histoire se termine. Attention, il existe également de très mauvais choix, qui peuvent conduire à la mort immédiate de votre personnage ou bien à la fin de l’histoire. Soyez donc bien attentifs aux différentes propositions qui s’offrent à vous, et tentez d’arriver jusqu’au bout de cette aventure.</h5> 
            <br/>
            <div id="btn-lecture">
                <a class="btn btn-outline-secondary" href="index.php" role="button">Retour à l'accueil</a>
                &nbsp;
                <?php
                $id_story = $_GET['id'];
                $requete2 = "SELECT * FROM advancement WHERE id_story = :id_story AND id_usr = :id_usr";
                $req2 = $bdd->prepare($requete2);
                $req2->execute(array(
                    'id_story' => $id_story,
                    'id_usr' => $id_user
                ));
                if ($req2->rowCount() == 1) {
                    $ligne = $req2->fetch();
                    $chapter = $ligne['numChapter'];
                    $link = "chapter.php?story_id=$id_story&chapter_num=$chapter&choice_num=0"; ?>
                    <a class="btn btn-outline-dark" href=<?= $link ?> role="button">Reprendre la lecture !</a><?php
                    } 
                    else {
                    $link = "chapter.php?story_id=$id_story&chapter_num=1&choice_num=0"; ?>
                    <a class="btn btn-outline-dark" href=<?= $link ?> role="button">Commencer la lecture !</a> <?php
                    }
                    ?>

            </div>

    </div>
</main>
</body>

</html>