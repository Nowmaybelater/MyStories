<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<?php

//Se connecte à la base de données
function getDb()
{
    $server = "localhost";
    $username = "ClaraValentine";
    $password = "ensc*2024";
    $db = "mystories";

    return new PDO(
        "mysql:host=$server;dbname=$db;charset=utf8",
        "$username",
        "$password",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
}
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
        $num = escape($_POST['numero']);
        $contenu = escape($_POST['contenu']);

        //insérer le chapitre à la base de données
        $stmt = getDb()->prepare('insert into chapters
        (numChapter, chapterContent)
        values (?, ?)');
        $stmt->execute(array($num, $contenu));
        redirect("story_add_chapter.php");
    }
}

?>
<!--CETTE PAGE NE FONCTIONNE PAS ENCORE !!! -->
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit">Ajoutez un chapitre</p>
        <!--formulaire à compléter : il faudra faire en sorte que les données id_story, author, nbChapters, status et date s'auto-remplissent 
        dans la base de données (en plus des données saisies dans le formulaire) une fois que l'utilisateur appuie sur le bouton Sauvegarder -->
        <div class="well">
            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="story_add_info.php" method="post">
                <input type="hidden" name="id" value="<?= $chapterId ?>"><!-- essayer de compendre ça-->
                <div class="form-group">
                    <label class="col-sm-4 control-label">Numéro chapitre</label>
                    <div class="col-sm-6">
                        <input type="number" name="numero" class="form-control" placeholder="Entrez le numéro du chapitre" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Contenu</label>
                    <div class="col-sm-6">
                        <textarea name="contenu" class="form-control" placeholder="Entrez le contenu du chapitre" required></textarea>
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