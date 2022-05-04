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
            <h6 id="donneesHistoire">Statut : <?php if ($histoire['finished'] = 0) {
                                                    echo "En cours";
                                                } else {
                                                    echo "Terminée";
                                                } ?>, Nombre de Chapitres : <?php echo $histoire['nbChapters']; ?>, Mis à jour le : <?php echo $histoire['date']; ?></h6>
            <h4> <?php echo $histoire['summary']; ?> </h4>
            <div id="btn-lecture">
                <a class="btn btn-outline-secondary" href="ListeHistoires.php" role="button">Retour à l'accueil</a>
                &nbsp;
                <?php
                $id_story=$_GET['id'];
                $requete2 = "SELECT * FROM advancement WHERE id_story = :id_story AND id_usr = :id_usr";
                $req2 = $bdd->prepare($requete2);
                $req2->execute(array(
                    'id_story' => $id_story,
                    'id_usr' => $id_user
                ));
                if ($req2->rowCount() == 1){
                    $ligne= $req2->fetch();
                    $chapter=$ligne['numChapter'];
                    $link="chapter.php?story_id=$id_story&chapter_num=$chapter";?>
                    <a class="btn btn-outline-dark" href=<?= $link?> role="button">Reprendre la lecture !</a><?php
                }
                else{
                    $link="chapter.php?story_id=&chapter_num=1";?>
                    <a class="btn btn-outline-dark" href=<?= $link?> role="button">Commencer la lecture !</a> <?php
                }
                ?>
                
            </div>

    </div>
</main>
</body>

</html>