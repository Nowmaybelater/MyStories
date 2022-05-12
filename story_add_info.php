<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php include("includes/functions.php");
//Cette page permet à l'administrateur de saisir les informations générales liées à une nouvelle histoire afin de la créer (titre, résumé, 
//nombre de points associés) via un formulaire

if (isset($_SESSION['login'])) {
    if (isset($_POST['title'])) {
        //on récupère les données du formulaire
        $title = escape($_POST['title']);
        $summary = escape($_POST['summary']);
        $author = $_SESSION['login'];
        $nbChapters = 0;
        $finished = 0;
        $date = date('y-m-d');
        $points = escape($_POST['points']);

        //insérer l'histoire à la base de données
        $stmt = $bdd->prepare('INSERT INTO stories
        (title, summary, author, nbChapters, finished, date, hide, nbrPoints)
        values (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title, $summary, $author, $nbChapters, $finished, $date, 0, $points));

        $req = "SELECT * FROM stories WHERE title=:titre";
        $res = $bdd->prepare($req);
        $res->execute(array("titre" => $title));
        $ligne = $res->fetch();
        $id = $ligne['id_story'];
        //on redirige vers la page générale qui permet de manager une histoire spécifique (ajout de chapitre, modifications, suppression, etc)
        redirect("story_modify.php?id=$id");
    }
}

?>
<!--Début de l'affichage-->
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit">Informations générales</p>
        <div class="well">
            <!--L'affichage du formulaire commence ici-->
            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="story_add_info.php" method="post">
                <input type="hidden" name="id" value="<?= $storyId ?>">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Titre</label>
                    <div class="col-sm-6">
                        <input type="text" name="title" class="form-control" placeholder="Entrez le titre de l'histoire" required autofocus>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <label class="col-sm-4 control-label">Résumé</label>
                    <div class="col-sm-6">
                        <textarea name="summary" class="form-control" placeholder="Entrez le résumé de l'histoire" required></textarea>
                    </div>
                </div>
                <br />
                <div>
                    <label class="col-sm-4 control-label">Nombre de points de vie</label>
                    <div>
                        <input type="number" name="points" class="form-control" placeholder="Entrez le nombre total de points dont dispose le lecteur au début de l'histoire" required autofocus>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                        <button id="size-btn" type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Sauvegarder</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
</body>

</html>