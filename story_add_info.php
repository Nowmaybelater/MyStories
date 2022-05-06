<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<?php
// Rediriger vers un URL
function redirect($url)
{
    header("Location: $url");
}

// pour se protéger des attaques XSS
function escape($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}

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
        $stmt = $bdd->prepare('insert into stories
        (title, summary, author, nbChapters, finished, date, nbrPoints)
        values (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($title, $summary, $author, $nbChapters, $finished, $date, $points));

        $req = "SELECT * FROM stories WHERE title=:titre";
        $res = $bdd->prepare($req);
        $res->execute(array("titre"=>$title));
        $ligne = $res->fetch();
        $id=$ligne['id_story'];

        redirect("story_add_chapter.php?id=$id");
    }
}

?>

<main>
    <div id="backgroundConnexion">
        <p class="titre_petit">Informations générales</p>
        <div class="well">
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
                <br/>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Sauvegarder</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>