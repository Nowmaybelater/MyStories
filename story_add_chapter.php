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
    if (isset($_POST['numero'])) {
        //on récupère les données du formulaire
        $id_story = $_POST['id'];
        $num = escape($_POST['numero']);
        $contenu = escape($_POST['contenu']);
        $choice1 = escape($POST_['choice1']);
        $choice2 = escape($POST_['choice2']);
        $choice3 = escape($POST_['choice3']);
        echo $choice3;
        echo $id_story;
        //insérer le chapitre à la base de données
        $stmt = $bdd->prepare('insert into chapters
        (id_story,numChapter, chapterContent, choice1, choice2, choice3)
        values (?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($id_story, $num, $contenu, $choice1, $choice2, $choice3));
        redirect("story_add_chapter.php?id=$id_story");
    }
}

?>

<main>
    <div id="backgroundConnexion">
        <p class="titre_petit">Ajoutez un chapitre</p>
        <div>
            <form action="story_add_chapter.php" method="post">
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
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
                            <input type="text" name="choice1" class="form-control" placeholder="Intitulé du choix 1" required autofocus>
                            <br />
                            <input type="number" name="refChoice1" class="form-control" placeholder="Chapitre vers lequel ce choix renvoie" required autofocus>
                        </div>
                        <br />
                        <li>Choix 2</li>
                        <div class="col-sm-6">
                            <input type="text" name="choice2" class="form-control" placeholder="Intitulé du choix 2" required autofocus>
                            <br />
                            <input type="number" name="refChoice2" class="form-control" placeholder="Chapitre vers lequel ce choix renvoie" required autofocus>
                        </div>
                        <br />
                        <li>Choix 3</li>
                        <div class="col-sm-6">
                            <input type="text" name="choice3" class="form-control" placeholder="Intitulé du choix 3" required autofocus>
                            <br />
                            <input type="number" name="refChoice3" class="form-control" placeholder="Chapitre vers lequel ce choix renvoie" required autofocus>
                        </div>
                    </ul>
                </div>
                <div>
                    <div>
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Sauvegarder</button>
                        &nbsp;
                        <button type="submit" class="btn btn-default btn-primary" href="#"><span class="glyphicon glyphicon-save"></span> Terminer l'histoire</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>