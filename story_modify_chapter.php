<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>

<?php include("includes/functions.php");
$chapterId = $_GET["id_chapter"];
$id_story = $_GET['id_story'];

if (isset($_POST['numero'])) {
    //on récupère les données du formulaire 
    $newNum = escape($_POST['numero']);
    $newContenu = escape($_POST['contenu']);
    $newChoice1 = escape($_POST['choice1']);
    $newChoice2 = escape($_POST['choice2']);
    $newChoice3 = escape($_POST['choice3']);
    $newRefChoice1 = escape($_POST['refChoice1']);
    $newRefChoice2 = escape($_POST['refChoice2']);
    $newRefChoice3 = escape($_POST['refChoice3']);

    //mettre à jour le numéro du chapitre
    $requete1 = "UPDATE chapters SET numChapter=$newNum WHERE id_story=:id";
    $stmt = $bdd->prepare($requete1);
    $stmt->execute(array('id' => $id_story));

    //mettre à jour le contenu du chapitre
    $requete2 = "UPDATE chapters SET chapterContent=$newContenu WHERE id_story=:id";
    $stmt = $bdd->prepare($requete2);
    $stmt->execute(array('id' => $id_story));

    //mettre à jour l'intitulé du choix 1 du chapitre
    $requete3 = "UPDATE chapters SET choice1=$newChoice1 WHERE id_story=:id";
    $stmt = $bdd->prepare($requete3);
    $stmt->execute(array('id' => $id_story));

    //mettre à jour l'intitulé du choix 2 du chapitre
    $requete4 = "UPDATE chapters SET choice2=$newChoice2 WHERE id_story=:id";
    $stmt = $bdd->prepare($requete4);
    $stmt->execute(array('id' => $id_story));

    //mettre à jour l'intitulé du choix 3 du chapitre
    $requete5 = "UPDATE chapters SET choice3=$newChoice3 WHERE id_story=:id";
    $stmt = $bdd->prepare($requete5);
    $stmt->execute(array('id' => $id_story));

    /*//mettre à jour le chapitre vers lequel renvoie le choix 1 
    $requete6 = "UPDATE links SET Chapter=$newRefChoice1 WHERE id_story= :id_story AND Previous_Chapter = :previous AND Previous_Choice= :choice";
    $stmt = $bdd->prepare($requete6);
    $stmt->execute(array('id' => $id_story, "previous" => $_GET['id'], "choice" => 1));

    //mettre à jour le chapitre vers lequel renvoie le choix 2
    $requete7 = "UPDATE links SET Chapter=$newRefChoice1 WHERE id_story= :id_story AND Previous_Chapter = :previous AND Previous_Choice= :choice";
    $stmt = $bdd->prepare($requete7);
    $stmt->execute(array('id' => $id_story, "previous" => $_GET['id'], "choice" => 2));

    //mettre à jour le chapitre vers lequel renvoie le choix 3 
    $requete8 = "UPDATE links SET Chapter=$newRefChoice1 WHERE id_story= :id_story AND Previous_Chapter = :previous AND Previous_Choice= :choice";
    $stmt = $bdd->prepare($requete8);
    $stmt->execute(array('id' => $id_story, "previous" => $_GET['id'], "choice" => 3));*/
}

?>

<main>
    <div id="backgroundConnexion">
        <p class="titre_petit">Modifier un chapitre</p>
        <div>
            <?php

            //on récupère les "anciennes" données de la table chapters pour qu'elles s'affichent dans le form et soient modifiables
            $requete = "SELECT * FROM chapters WHERE id_chapter = :id_chapter";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_chapter" => $chapterId));
            $chapitre = $resultat->fetch();
            $valeur = $chapitre["id_chapter"];
            $num = $chapitre["numChapter"];
            $contenu = $chapitre["chapterContent"];
            $choice1 = $chapitre["choice1"];
            $choice2 = $chapitre["choice2"];
            $choice3 = $chapitre["choice3"];

            //recuperer le numero de chapitre
            $requete = "SELECT * FROM chapters WHERE id_chapter = :id_chapter";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_chapter" => $chapterId));
            $chapitre = $resultat->fetch();
            $numChap = $chapitre["numChapter"];

            //on récupère les "anciennes" données de la table links pour qu'elles s'affichent dans le form et soient modifiables
            $requete = "SELECT * FROM links WHERE id_story= :id_story AND Previous_Chapter = :previous AND Previous_Choice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array('id_story' => $id_story, 'previous' => $numChap, 'choice' => 1)); 
            $links = $resultat->fetch();
            $refChoice1 = $links["Chapter"];

            $requete = "SELECT * FROM links WHERE id_story= :id_story AND Previous_Chapter = :previous AND Previous_Choice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "previous" => $numChap, "choice" => 2));
            $links = $resultat->fetch();
            $refChoice2 = $links["Chapter"];

            $requete = "SELECT * FROM links WHERE id_story= :id_story AND Previous_Chapter = :previous AND Previous_Choice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "previous" => $numChap, "choice" => 3));
            $links = $resultat->fetch();
            $refChoice3 = $links["Chapter"];

            ?>
        </div>
        <div id="centre">
            <form method="post">
                <input type="hidden" name="id" value="<?= $chapterId ?>">
                <div>
                    <div>
                        <input type="number" name="numero" class="form-control" value="<?= $num ?>" required autofocus>
                    </div>
                </div>
                <br />
                <div>
                    <div>
                        <textarea name="contenu" class="form-control" required><?= $contenu ?></textarea>
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
                                <input type="text" name="choice1" class="form-control" value="<?= $choice1 ?>" required autofocus>
                                <br />
                                <li>
                                    <h6> Vers quel chapitre ce choix renvoie-t-il ? </h6>
                                </li>
                                <input type="number" name="refChoice1" class="form-control" value ="<?=$refChoice1?>" required autofocus>
                                <br />
                                <li>
                                    <h6> Ce choix entraîne-t-il l'échec du personnage ? </h6>
                                </li>
                                <input type="radio" name="echec1" id="oui" value="oui">
                                <label style="font-size:medium" for="oui">Oui</label>
                                <input type="radio" name="echec1" id="non" value="non">
                                <label style="font-size:medium" for="oui">Non</label>
                                <br />
                                <li>
                                    <h6> Si non, combien de points de vie sont perdus si le lecteur fait ce choix ? (0 si aucun point perdu)</h6>
                                </li>
                                <input type="number" name="points1" class="form-control" placeholder="Nombre de points de vie perdus si on fait ce choix" autofocus>
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
                                <input type="text" name="choice2" class="form-control" value="<?= $choice2 ?>" autofocus>
                                <br />
                                <li>
                                    <h6> Vers quel chapitre ce choix renvoie-t-il ? </h6>
                                </li>
                                <input type="number" name="refChoice2" class="form-control" value ="<?=$refChoice2?>" autofocus>
                                <br />
                                <li>
                                    <h6> Ce choix entraîne-t-il l'échec du personnage ? </h6>
                                </li>
                                <input type="radio" name="echec2" id="oui" value="oui">
                                <label style="font-size:medium" for="oui">Oui</label>
                                <input type="radio" name="echec2" id="non" value="non">
                                <label style="font-size:medium" for="oui">Non</label>
                                <br />
                                <li>
                                    <h6> Si non, combien de points de vie sont perdus si le lecteur fait ce choix ? (0 si aucun point perdu)</h6>
                                </li>
                                <input type="number" name="points2" class="form-control" placeholder="Nombre de points de vie perdus si on fait ce choix" autofocus>
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
                                <input type="text" name="choice3" class="form-control" value="<?= $choice3 ?>" autofocus>
                                <br />
                                <li>
                                    <h6> Vers quel chapitre ce choix renvoie-t-il ? </h6>
                                </li>
                                <input type="number" name="refChoice3" class="form-control" value ="<?=$refChoice3?>" autofocus>
                                <br />
                                <li>
                                    <h6> Ce choix entraîne-t-il l'échec du personnage ? </h6>
                                </li>
                                <input type="radio" name="echec3" id="oui" value="oui">
                                <label style="font-size:medium" for="oui">Oui</label>
                                <input type="radio" name="echec3" id="non" value="non">
                                <label style="font-size:medium" for="oui">Non</label>
                                <br />
                                <li>
                                    <h6> Si non, combien de points de vie sont perdus si le lecteur fait ce choix ? (0 si aucun point perdu)</h6>
                                </li>
                                <input type="number" name="points3" class="form-control" placeholder="Nombre de points de vie perdus si on fait ce choix" autofocus>
                            </ul>
                        </div>
                    </ul>
                </div>
                <br />
                <div>
                    <div>
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Sauvegarder</button>
                        <a class="btn btn-outline-primary" href="ListeHistoires.php" role="button"> Retour sans sauvegarder</a>
                    </div>
                </div>
            </form>
        </div>
        <a class="btn btn-success" id="btnHautPage" href="#top" role="button" title="Haut de page"> <i class="bi bi-caret-up-fill"></i> </a>
    </div>
</main>