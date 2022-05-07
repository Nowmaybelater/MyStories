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

        //modifier l'histoire dans la base de données
        $requete = "UPDATE stories SET title =?, summary=?, author=?, nbChapters=?, finished=?, date =?, nbrPoints=?";
        $stmt = $bdd->prepare($requete);
        $stmt->execute(array($title, $summary, $author, $nbChapters, $finished, $date, $points));
        $ligne = $stmt->fetch();

        $req = "SELECT * FROM stories WHERE title=:titre";
        $res = $bdd->prepare($req);
        $res->execute(array("titre" => $title));
        $ligne = $res->fetch();
        $id = $ligne['id_story'];

        /*redirect("story_modify.php?id=$id");*/
    }
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
                    <div class="col-sm-4 col-sm-offset-4">
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Sauvegarder les changements </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>