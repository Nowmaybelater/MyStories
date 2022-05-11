<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php include("includes/functions.php") ?>

<main>
    <div id=backgroundConnexion>
        <?php
        if ($_GET['failed'] == 1) {
        ?> <h1 class="titre">Perdu ! </h1>
        <?php
        } else {
        ?> <h1 class="titre">Gagné ! </h1>
        <?php
        }

        $storyId = $_GET['id'];
        $requete1 = $bdd->prepare('SELECT * FROM user WHERE login_usr=?');
        $requete1->execute(array($_SESSION['login']));
        $ligne1 = $requete1->fetch();
        $id_usr = $ligne1['id_usr'];
        $pts_story = Resume($id_usr, $storyId, $bdd);

        //enregistrement dans les stats
        $req = "SELECT * FROM stats WHERE id_story=:id";
        $res = $bdd->prepare($req);
        $res->execute(array("id" => $storyId));

        $req3 = "SELECT * FROM player_points WHERE id_story=:id AND id_user=:id_user";
        $req3 = $bdd->prepare($req3);
        $req3->execute(array("id" => $storyId, "id_user" => $id_usr));
        if($req3->rowCount()==1){
            $ligne2 = $req3->fetch();
            $death=$ligne2['death'];
            $pts=$ligne2['points'];
        }
        else{
            $death=0;
            $pts=0;
        }
        

        if ($res->rowCount() == 1) {
            $ligne3 = $res->fetch();
            $played = $ligne3['played'] + 1;
            $req2 = "UPDATE stats SET played=$played WHERE id_story=:id";
            $res2 = $bdd->prepare($req2);
            $res2->execute(array("id" => $storyId));

            if ($death == 1) {
                $dead = $ligne3['death'] + 1;
                $req4 = "UPDATE stats SET death=$dead WHERE id_story=:id";
                $req4 = $bdd->prepare($req4);
                $req4->execute(array("id" => $storyId));
            }
            $pts = $pts + $ligne3['points'];
            $req5 = "UPDATE stats SET points=$pts WHERE id_story=:id";
            $req5 = $bdd->prepare($req5);
            $req5->execute(array("id" => $storyId));
        } else {
            $req6 = $bdd->prepare('INSERT INTO stats (id_story, played, death, points) VALUES (:id_story, :played, :death, :points)');
            $req6->execute(array(
                'id_story' => $storyId,
                'played' => 1,
                'death' => $ligne2['death'],
                'points' => $ligne2['points']
            ));
        }

        //effacement des données liés a l'histoire pour le joueur car il a fini la partie
        $requete2 = $bdd->prepare('DELETE FROM advancement WHERE id_story=? AND id_usr=?');
        $requete2->execute(array($storyId, $id_usr));
        $requete3 = $bdd->prepare('DELETE FROM choices WHERE id_story=? AND id_usr=?');
        $requete3->execute(array($storyId, $id_usr));
        $requete4 = $bdd->prepare('DELETE FROM player_points WHERE id_story=? AND id_user=?');
        $requete4->execute(array($storyId, $id_usr));

        ?>
        <div id="btn-lecture">
            <a id="size-btn" class="btn btn-outline-dark" href="StorySummary.php?id=<?= $storyId ?>" role="button">Réessayer</a>
            &nbsp;
            <a id="size-btn" class="btn btn-outline-dark" href="index.php" role="button">Retour à l'accueil</a>
        </div>
    </div>
</main>
</body>

</html>