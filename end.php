<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php include("includes/functions.php") ?>

<main>
    <div id=backgroundConnexion>
        <h1 class="titre">Gagné !    </h1>
        <?php 
        $storyId=$_GET['id'];
        $requete1 = $bdd->prepare('SELECT * FROM user WHERE login_usr=?');
        $requete1->execute(array($_SESSION['login']));
        $ligne1=$requete1->fetch();
        $id_usr=$ligne1['id_usr'];
        Resume($id_usr, $storyId, $bdd);

        //enregistrement dans les stats

        //effecement des données liés a l'histoire pour le joueur car il a fini la partie
            $requete2 = $bdd->prepare('DELETE FROM advancement WHERE id_story=? AND id_usr=?');
            $requete2->execute(array($storyId,$id_usr));
            $requete3 = $bdd->prepare('DELETE FROM choices WHERE id_story=? AND id_usr=?');
            $requete3->execute(array($storyId,$id_usr));
            $requete4 = $bdd->prepare('DELETE FROM player_points WHERE id_story=? AND id_user=?');
            $requete4->execute(array($storyId,$id_usr));
        
        ?>
    </div>
</main>
</body>

</html>