<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<?php 
    if (isset($_POST['title'])) {
        $id_story = $_GET['id'];
        //on récupère les données du formulaire
        $newTitle = escape($_POST['title']);
        $newSummary = escape($_POST['summary']);
        $newPoints = escape($_POST['points']);

        //modifier l'histoire dans la base de données       
        
        $requete = "UPDATE stories SET title='$newTitle' WHERE id_story=:id";
        $stmt = $bdd->prepare($requete);
        $stmt->execute(array('id'=>$id_story));
        
        $requete = "UPDATE stories SET summary='$newSummary' WHERE id_story=:id";
        $stmt = $bdd->prepare($requete);
        $stmt->execute(array('id'=>$id_story));

        $requete = "UPDATE stories SET date=NOW() WHERE id_story=:id";
        $stmt = $bdd->prepare($requete);
        $stmt->execute(array('id'=>$id_story));

        $requete = "UPDATE stories SET nbrPoints=$newPoints WHERE id_story=:id";
        $stmt = $bdd->prepare($requete);
        $stmt->execute(array('id'=>$id_story));

        redirect("story_modify.php?id=$id_story");
    }

?>

<main>
    <div id="backgroundConnexion">
        <p class="titre_petit"> Modification </p>
        <div>
            <?php
            $requete = "SELECT * FROM stories WHERE id_story = :id_story";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $_GET['id']));
            $histoire = $resultat->fetch();
            $valeur = $histoire["id_story"];
            $title = $histoire["title"];
            $summary = $histoire["summary"];
            $points = $histoire["nbrPoints"];
            ?>
            <div>
                <h2><em id="centre" style="color :grey;"><?= $histoire['title'] ?></em></h2>
            </div>
        </div>

        <div>
            <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="<?= $storyId ?>">
                <div class="form-group">
                    <label>Titre</label>
                    <div class="col-sm-6">
                        <input type="text" name="title" class="form-control" value="<?= $title ?>" required autofocus>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <label>Résumé</label>
                    <div class="col-sm-6">
                        <textarea name="summary" class="form-control" required><?= $summary ?></textarea>
                    </div>
                </div>
                <br />
                <div>
                    <label>Nombre de points de vie</label>
                    <div>
                        <input type="number" name="points" class="form-control" value="<?= $points ?>" required autofocus>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <div>
                        <button id="size-btn" type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Sauvegarder les changements </button>
                        <a id="size-btn" class="btn btn-outline-primary" href="ListeHistoires.php" role="button"> Retour sans sauvegarder</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </main>
</body>

</html>