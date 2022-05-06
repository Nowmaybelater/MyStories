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
        //insérer le chapitre à la table chapters de la base de données
        $stmt = $bdd->prepare('insert into chapters
        (id_story,numChapter, chapterContent, choice1, choice2, choice3)
        values (?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($id_story, $num, $contenu, $choice1, $choice2, $choice3));

        //compléter la table links de la base de données
        $refChoice1 = escape($_POST['refChoice1']);
        $stmt = $bdd->prepare('insert into links
        (id_story,Chapter, Previous_Chapter, Previous_Choice)
        values (?, ?, ?, ?)');
        $stmt->execute(array($id_story, $refChoice1, $num, 1));

        $refChoice2 = escape($_POST['refChoice2']);
        $stmt = $bdd->prepare('insert into links
        (id_story,Chapter, Previous_Chapter, Previous_Choice)
        values (?, ?, ?, ?)');
        $stmt->execute(array($id_story, $refChoice2, $num, 2));

        $refChoice3 = escape($_POST['refChoice3']);
        $stmt = $bdd->prepare('insert into links
        (id_story,Chapter, Previous_Chapter, Previous_Choice)
        values (?, ?, ?, ?)');
        $stmt->execute(array($id_story, $refChoice3, $num, 3));

        redirect("story_add_chapter.php?id=$id_story");
    }
}

?>

<main>
    <div id="backgroundConnexion">
        <p class="titre_petit">Ajout d'un chapitre</p>
        <div id="centre">
            <form action="story_add_chapter.php" method="post">
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                <div>
                    <div>
                        <input type="number" name="numero" class="form-control" placeholder="Entrez le numéro du chapitre" required autofocus>
                    </div>
                </div>
                <br />
                <div>
                    <div>
                        <textarea name="contenu" class="form-control" placeholder="Entrez le contenu du chapitre" required></textarea>
                    </div>
                </div>
                <br />
                <div>
                    <h4 id="centre"> ~ Choix proposés au lecteur ~ </h4>
                    <ul>
                        <li>
                            <h5>Choix 1</h5>
                        </li>
                        <div>
                            <ul>
                                <li>
                                    <h6> Quel est l'intitulé de ce choix ? </h6>
                                </li>
                                <input type="text" name="choice1" class="form-control" placeholder="Intitulé" required autofocus>
                                <br />
                                <li>
                                    <h6> Vers quel chapitre ce choix renvoie-t-il ? </h6>
                                </li>
                                <input type="number" name="refChoice1" class="form-control" placeholder="Chapitre vers lequel ce choix renvoie" required autofocus>
                                <br />
                                <li>
                                    <h6> Ce choix entraîne-t-il l'échec du personnage ? </h6>
                                </li>
                                <input type="radio" name="echec1" id="oui">
                                <label style="font-size:medium" for="oui">Oui</label>
                                <input type="radio" name="echec1" id="non">
                                <label style="font-size:medium" for="oui">Non</label>
                                <br />
                                <li>
                                    <h6> Si non, combien de points de vie sont perdus si le lecteur fait ce choix ? (0 si aucun point perdu)</h6>
                                </li>
                                <input type="number" name="points1" class="form-control" placeholder="Nombre de points de vie perdus si on fait ce choix" required autofocus>
                            </ul>
                        </div>
                        <br />
                        <li>
                            <h5>Choix 2</h5>
                        </li>
                        <div>
                            <ul>
                                <li>
                                    <h6> Quel est l'intitulé de ce choix ? </h6>
                                </li>
                                <input type="text" name="choice2" class="form-control" placeholder="Intitulé" required autofocus>
                                <br />
                                <li>
                                    <h6> Vers quel chapitre ce choix renvoie-t-il ? </h6>
                                </li>
                                <input type="number" name="refChoice2" class="form-control" placeholder="Chapitre vers lequel ce choix renvoie" required autofocus>
                                <br />
                                <li>
                                    <h6> Ce choix entraîne-t-il l'échec du personnage ? </h6>
                                </li>
                                <input type="radio" name="echec2" id="oui">
                                <label style="font-size:medium" for="oui">Oui</label>
                                <input type="radio" name="echec2" id="non">
                                <label style="font-size:medium" for="oui">Non</label>
                                <br />
                                <li>
                                    <h6> Si non, combien de points de vie sont perdus si le lecteur fait ce choix ? (0 si aucun point perdu)</h6>
                                </li>
                                <input type="number" name="points2" class="form-control" placeholder="Nombre de points de vie perdus si on fait ce choix" required autofocus>
                            </ul>
                        </div>
                        <br />
                        <li>
                            <h5>Choix 3</h5>
                        </li>
                        <div>
                            <ul>
                                <li>
                                    <h6> Quel est l'intitulé de ce choix ? </h6>
                                </li>
                                <input type="text" name="choice3" class="form-control" placeholder="Intitulé" required autofocus>
                                <br />
                                <li>
                                    <h6> Vers quel chapitre ce choix renvoie-t-il ? </h6>
                                </li>
                                <input type="number" name="refChoice3" class="form-control" placeholder="Chapitre vers lequel ce choix renvoie" required autofocus>
                                <br />
                                <li>
                                    <h6> Ce choix entraîne-t-il l'échec du personnage ? </h6>
                                </li>
                                <input type="radio" name="echec3" id="oui">
                                <label style="font-size:medium" for="oui">Oui</label>
                                <input type="radio" name="echec3" id="non">
                                <label style="font-size:medium" for="oui">Non</label>
                                <br />
                                <li>
                                    <h6> Si non, combien de points de vie sont perdus si le lecteur fait ce choix ? (0 si aucun point perdu)</h6>
                                </li>
                                <input type="number" name="points3" class="form-control" placeholder="Nombre de points de vie perdus si on fait ce choix" required autofocus>
                            </ul>
                        </div>
                    </ul>
                </div>
                <br/>
                <div>
                    <div>
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Sauvegarder</button>
                        &nbsp;
                        <button type="submit" class="btn btn-default btn-primary" href="ConfirmationTerminee.php"><span class="glyphicon glyphicon-save"></span> Terminer l'histoire</button>
                    </div>
                </div>
            </form>
        </div>
        <a class="btn btn-success" id="btnHautPage" href="#top" role="button" title="Haut de page"> <i class="bi bi-caret-up-fill"></i> </a>
    </div>
</main>