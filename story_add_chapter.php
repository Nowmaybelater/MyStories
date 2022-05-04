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
//FAIRE EN SORTE QUE LE CHAPITRE SOIT AJOUTE A L'HISTOIRE SELECTIONNEE
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

<main>
    <div id="backgroundConnexion">
        <p class="titre_petit">Ajoutez un chapitre</p>
        <div>
            <form action="story_add_info.php" method="post">
                <input type="hidden" name="id" value="<?= $chapterId ?>">
                <div>
                    <label>Numéro chapitre</label>
                    <div class="col-sm-6">
                        <input type="number" name="numero" class="form-control" placeholder="Entrez le numéro du chapitre" required autofocus>
                    </div>
                </div>
                <br />
                <div>
                    <label>Contenu</label>
                    <div class="col-sm-6">
                        <textarea name="contenu" class="form-control" placeholder="Entrez le contenu du chapitre" required></textarea>
                    </div>
                </div>
                <br />
                <div>
                    Choix proposés au lecteur
                    <br />
                    <ul>
                        <li>Choix 1</li>
                        <div class="col-sm-6">
                            <input type="text" name="choix1" class="form-control" placeholder="Intitulé du choix 1" required autofocus>
                            <br/>
                            <input type="number" name="numero" class="form-control" placeholder="Chapitre vers lequel ce choix renvoie" required autofocus>
                        </div>
                        <br />
                        <li>Choix 2</li>
                        <div class="col-sm-6">
                            <input type="text" name="choix2" class="form-control" placeholder="Intitulé du choix 2" required autofocus>
                            <br/>
                            <input type="number" name="numero" class="form-control" placeholder="Chapitre vers lequel ce choix renvoie" required autofocus>
                        </div>
                        <br />
                        <li>Choix 3</li>
                        <div class="col-sm-6">
                            <input type="text" name="choix3" class="form-control" placeholder="Intitulé du choix 3" required autofocus>
                            <br/>
                            <input type="number" name="numero" class="form-control" placeholder="Chapitre vers lequel ce choix renvoie" required autofocus>
                        </div>
                    </ul>
                </div>
                <div>
                    <div>
                        <button type="submit" class="btn btn-default btn-primary" href="story_add_chapter.php"><span class="glyphicon glyphicon-save"></span> Sauvegarder</button>
                        &nbsp;
                        <button type="submit" class="btn btn-default btn-primary" href="#"><span class="glyphicon glyphicon-save"></span> Terminer l'histoire</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>