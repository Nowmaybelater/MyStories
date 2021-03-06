<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php include("includes/functions.php"); ?>
<!--Cette page permet à l'administrateur de modifier les informations relatives à l'un des chapitres de l'une de ses histoires 
(numéro de chapitre, contenu, choix) via un formulaire-->

<main>
    <div id="backgroundConnexion">
        <p class="titre_petit">Modifier un chapitre</p>
        <div>
            <?php
            $chapterId = $_GET["id_chapter"];
            $id_story = $_GET['id_story'];

            if (isset($_POST['numero'])) {
                //on récupère les données du formulaire(il s'agit de nouvelles données, ou des anciennes si l'utilisateur n'y a pas touché)
                $newNum = escape($_POST['numero']);
                $newContenu = escape($_POST['contenu']);
                $newChoice1 = escape($_POST['choice1']);
                $newChoice2 = escape($_POST['choice2']);
                $newChoice3 = escape($_POST['choice3']);
                $newRefChoice1 = escape($_POST['refChoice1']);
                $newRefChoice2 = escape($_POST['refChoice2']);
                $newRefChoice3 = escape($_POST['refChoice3']);
                $newPoints1 = escape($_POST['points1']);
                $newPoints2 = escape($_POST['points2']);
                $newPoints3 = escape($_POST['points3']);
//pour la récupération des données des checkbox, que l'on effectue via l'attribut valeur dans le input, on fait le choix de cocher la case 
//oui si le choix entraîne l'échec et la case non dans tous les autres cas même si elle n'était pas cochée à l'origine (ce choix a permis de 
//simplifier le code)
                if ($_POST['echec1'] == "oui") {
                    $newEchec1 = 1;
                } else {
                    $newEchec1 = 0;
                }
                if ($_POST['echec2'] == "oui") {
                    $newEchec2 = 1;
                } else {
                    $newEchec2 = 0;
                }
                if ($_POST['echec3'] == "oui") {
                    $newEchec3 = 1;
                } else {
                    $newEchec3 = 0;
                }

                //cette requête permet de mettre à jour le numéro du chapitre
                $requete1 = "UPDATE chapters SET numChapter=$newNum WHERE id_story=:id AND id_chapter=:idChap";
                $stmt = $bdd->prepare($requete1);
                $stmt->execute(array('id' => $id_story, 'idChap' => $chapterId));

                //cette requête permet de mettre à jour le contenu du chapitre
                $requete2 = "UPDATE chapters SET chapterContent='$newContenu' WHERE id_story= :id AND id_chapter=:idChap";
                $stmt = $bdd->prepare($requete2);
                $stmt->execute(array("id" => $id_story, "idChap" => $chapterId));

                //cette requête permet de mettre à jour l'intitulé du choix 1 du chapitre
                $requete3 = "UPDATE chapters SET choice1='$newChoice1' WHERE id_story=:id AND id_chapter=:idChap";
                $stmt = $bdd->prepare($requete3);
                $stmt->execute(array("id" => $id_story, "idChap" => $chapterId));

                //cette requête permet de mettre à jour l'intitulé du choix 2 du chapitre :si celui-ci n'est pas vide dans le formulaire, on lui donne 
                //sa nouvelle valeur, sinon on lui donne la valeur null
                if (!empty($newChoice2)) {
                    $requete4 = "UPDATE chapters SET choice2='$newChoice2' WHERE id_story=:id AND id_chapter=:idChap";
                    $stmt = $bdd->prepare($requete4);
                    $stmt->execute(array("id" => $id_story, "idChap" => $chapterId));
                } else {
                    $requete4 = "UPDATE chapters SET choice2=null WHERE id_story=:id AND id_chapter=:idChap";
                    $stmt = $bdd->prepare($requete4);
                    $stmt->execute(array("id" => $id_story, "idChap" => $chapterId));
                }

                //cette requête permet de mettre à jour l'intitulé du choix 3 du chapitre :si celui-ci n'est pas vide dans le formulaire, on lui donne 
                //sa nouvelle valeur, sinon on lui donne la valeur null
                if (!empty($newChoice3)) {
                    $requete5 = "UPDATE chapters SET choice3='$newChoice3' WHERE id_story=:id AND id_chapter=:idChap";
                    $stmt = $bdd->prepare($requete5);
                    $stmt->execute(array("id" => $id_story, "idChap" => $chapterId));
                } else {
                    $requete5 = "UPDATE chapters SET choice3=null WHERE id_story=:id AND id_chapter=:idChap";
                    $stmt = $bdd->prepare($requete5);
                    $stmt->execute(array("id" => $id_story, "idChap" => $chapterId));
                }

                //cette requête permet de mettre à jour le chapitre vers lequel renvoie le choix 1.
                //Si la zone du formulaire n'est pas une chaîne de caractère vide et que le choix existe dans la base de données, on met à jour les infos 
                //(on les ajoute si la table ne contient pas de ligne associée à ce choix). Sinon (i.e. la zone du formulaire contient une chaîne de 
                //caractères vides), on supprime les informations relatives à ce choix de la base de données. Le même fonctionnement est appliqué pour
                //les choix 2 et 3.
                if ($newRefChoice1 != '') {
                    $requete61 = "SELECT * FROM links WHERE id_story= :id AND Previous_Chapter = :previous AND Previous_Choice= :choice";
                    $stmt = $bdd->prepare($requete61);
                    $stmt->execute(array('id' => $id_story, "previous" => $newNum, "choice" => 1));
                    if ($stmt->rowCount() == 1) {
                        $requete6 = "UPDATE links SET Chapter=$newRefChoice1 WHERE id_story= :id AND Previous_Chapter = :previous AND Previous_Choice= :choice";
                        $stmt = $bdd->prepare($requete6);
                        $stmt->execute(array('id' => $id_story, "previous" => $newNum, "choice" => 1));
                    } else {
                        $requete6 = "INSERT INTO links  (id_story, Chapter, Previous_Chapter, Previous_Choice) VALUES (:id, :chap, :prev_chap, :prev_choice)";
                        $stmt = $bdd->prepare($requete6);
                        $stmt->execute(array(
                            'id' => $id_story,
                            'chap' => $newRefChoice1,
                            "prev_chap" => $newNum,
                            "prev_choice" => 1
                        ));
                    }
                } else {
                    $requete6 = "DELETE FROM links WHERE id_story= :id AND Previous_Chapter = :previous AND Previous_Choice= :choice";
                    $stmt = $bdd->prepare($requete6);
                    $stmt->execute(array('id' => $id_story, "previous" => $newNum, "choice" => 1));
                }


                //cette requête permet de mettre à jour le chapitre vers lequel renvoie le choix 2
                if ($newRefChoice2 != '') {
                    $requete71 = "SELECT * FROM links WHERE id_story= :id AND Previous_Chapter = :previous AND Previous_Choice= :choice";
                    $stmt = $bdd->prepare($requete71);
                    $stmt->execute(array('id' => $id_story, "previous" => $newNum, "choice" => 2));
                    if ($stmt->rowCount() == 1) {
                        $requete7 = "UPDATE links SET Chapter=$newRefChoice2 WHERE id_story= :id AND Previous_Chapter = :previous AND Previous_Choice= :choice";
                        $stmt = $bdd->prepare($requete7);
                        $stmt->execute(array('id' => $id_story, "previous" => $newNum, "choice" => 2));
                    } else {
                        $requete7 = "INSERT INTO links  (id_story, Chapter, Previous_Chapter, Previous_Choice) VALUES (:id, :chap, :prev_chap, :prev_choice)";
                        $stmt = $bdd->prepare($requete7);
                        $stmt->execute(array(
                            'id' => $id_story,
                            'chap' => $newRefChoice1,
                            "prev_chap" => $newNum,
                            "prev_choice" => 2
                        ));
                    }
                } else {
                    $requete7 = "DELETE FROM links WHERE id_story= :id AND Previous_Chapter = :previous AND Previous_Choice= :choice";
                    $stmt = $bdd->prepare($requete7);
                    $stmt->execute(array('id' => $id_story, "previous" => $newNum, "choice" => 2));
                }

                //cette requête permet de mettre à jour le chapitre vers lequel renvoie le choix 3
                if ($newRefChoice3 != '') {
                    $requete81 = "SELECT * FROM links WHERE id_story= :id AND Previous_Chapter = :previous AND Previous_Choice= :choice";
                    $stmt = $bdd->prepare($requete81);
                    $stmt->execute(array('id' => $id_story, "previous" => $newNum, "choice" => 3));
                    if ($stmt->rowCount() == 1) {
                        $requete8 = "UPDATE links SET Chapter=$newRefChoice3 WHERE id_story= :id AND Previous_Chapter = :previous AND Previous_Choice= :choice";
                        $stmt = $bdd->prepare($requete8);
                        $stmt->execute(array('id' => $id_story, "previous" => $newNum, "choice" => 3));
                    } else {
                        $requete8 = "INSERT INTO links  (id_story, Chapter, Previous_Chapter, Previous_Choice) VALUES (:id, :chap, :prev_chap, :prev_choice)";
                        $stmt = $bdd->prepare($requete8);
                        $stmt->execute(array(
                            'id' => $id_story,
                            'chap' => $newRefChoice1,
                            "prev_chap" => $newNum,
                            "prev_choice" => 3
                        ));
                    }
                } else {
                    $requete8 = "DELETE FROM links WHERE id_story= :id AND Previous_Chapter = :previous AND Previous_Choice= :choice";
                    $stmt = $bdd->prepare($requete8);
                    $stmt->execute(array('id' => $id_story, "previous" => $newNum, "choice" => 3));
                }


                //cette requête permet de mettre à jour le nombre de points perdus si on effectue le choix 1 
                if ($newPoints1 != null) {
                    $requete91="SELECT * FROM points WHERE id_story= :id AND chapter = :chapter AND numChoice= :choice";
                    $stmt = $bdd->prepare($requete91);
                    $stmt->execute(array('id' => $id_story, "chapter" => $newNum, "choice" => 1));
                    if($stmt->rowCount()==1){
                        $requete9 = "UPDATE points SET points=$newPoints1 WHERE id_story= :id AND chapter = :chapter AND numChoice= :choice";
                        $stmt = $bdd->prepare($requete9);
                        $stmt->execute(array('id' => $id_story, "chapter" => $newNum, "choice" => 1));
                    }
                    else{
                        $requete9 = "INSERT INTO points (points, id_story, chapter, numChoice, death) VALUES (?,?,?,?,?)";
                        $stmt = $bdd->prepare($requete9);
                        $stmt->execute(array($newPoints1, $id_story, $newNum, 1, 0));
                    }
                }
            
                //cette requête permet de mettre à jour le nombre de points perdus si on effectue le choix 2
                if ($newPoints2 != null) {
                    $requete101="SELECT * FROM points WHERE id_story= :id AND chapter = :chapter AND numChoice= :choice";
                    $stmt = $bdd->prepare($requete101);
                    $stmt->execute(array('id' => $id_story, "chapter" => $newNum, "choice" => 2));
                    if($stmt->rowCount()==1){
                        $requete10 = "UPDATE points SET points=$newPoints2 WHERE id_story= :id AND chapter = :chapter AND numChoice= :choice";
                        $stmt = $bdd->prepare($requete10);
                        $stmt->execute(array('id' => $id_story, "chapter" => $newNum, "choice" => 2));
                    }
                    else{
                        $requete10 = "INSERT INTO points (points, id_story, chapter, numChoice, death) VALUES (?,?,?,?,?)";
                        $stmt = $bdd->prepare($requete10);
                        $stmt->execute(array($newPoints2, $id_story, $newNum, 2, 0));
                    }
            
                }
            
                //cette requête permet de mettre à jour le nombre de points perdus si on effectue le choix 3
                if ($newPoints3 != null) {
                    $requete111="SELECT * FROM points WHERE id_story= :id AND chapter = :chapter AND numChoice= :choice";
                    $stmt = $bdd->prepare($requete111);
                    $stmt->execute(array('id' => $id_story, "chapter" => $newNum, "choice" => 3));
                    if($stmt->rowCount()==1){
                        $requete11 = "UPDATE points SET points=$newPoints3 WHERE id_story= :id AND chapter = :chapter AND numChoice= :choice";
                        $stmt = $bdd->prepare($requete11);
                        $stmt->execute(array('id' => $id_story, "chapter" => $newNum, "choice" => 3));
                    }
                    else{
                        $requete11 = "INSERT INTO points (points, id_story, chapter, numChoice, death) VALUES (?,?,?,?,?)";
                        $stmt = $bdd->prepare($requete11);
                        $stmt->execute(array($newPoints3, $id_story, $newNum, 3, 0));
                    }
            
                }

                //cette requête permet de mettre à jour la valeur de death si on effectue le choix 1
                $requete12 = "UPDATE points SET death=$newEchec1 WHERE id_story= :id AND chapter = :chapter AND numChoice= :choice";
                $stmt = $bdd->prepare($requete12);
                $stmt->execute(array('id' => $id_story, "chapter" => $newNum, "choice" => 1));

                //cette requête permet de mettre à jour la valeur de death si on effectue le choix 2
                $requete13 = "UPDATE points SET death=$newEchec2 WHERE id_story= :id AND chapter = :chapter AND numChoice= :choice";
                $stmt = $bdd->prepare($requete13);
                $stmt->execute(array('id' => $id_story, "chapter" => $newNum, "choice" => 2));

                //cette requête permet de mettre à jour la valeur de death si on effectue le choix 3
                $requete14 = "UPDATE points SET death=$newEchec3 WHERE id_story= :id AND chapter = :chapter AND numChoice= :choice";
                $stmt = $bdd->prepare($requete14);
                $stmt->execute(array('id' => $id_story, "chapter" => $newNum, "choice" => 3));
                
                redirect("story_modify.php?id=$id_story");
            }

            ?>


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
            if ($resultat->rowCount() == 0) {
                $refChoice1 = 0;
            } else {
                $links = $resultat->fetch();
                $refChoice1 = $links["Chapter"];
            }

            $requete = "SELECT * FROM links WHERE id_story= :id_story AND Previous_Chapter = :previous AND Previous_Choice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "previous" => $numChap, "choice" => 2));
            //il n'est pas requis d'avoir trois choix possibles pour chaque chapitre, donc on vérifie que la requête retourne quelque 
            //chose avant de récupérer le résultat et de poser la variable $refChoice2
            if ($resultat->rowCount() == 0) {
                $refChoice2 = 0;
            } else {
                $links = $resultat->fetch();
                $refChoice2 = $links["Chapter"];
            }

            $requete = "SELECT * FROM links WHERE id_story= :id_story AND Previous_Chapter = :previous AND Previous_Choice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "previous" => $numChap, "choice" => 3));
            //il n'est pas requis d'avoir trois choix possibles pour chaque chapitre, donc on vérifie que la requête retourne quelque 
            //chose avant de récupérer le résultat et de poser la variable $refChoice3
            if ($resultat->rowCount() == 0) {
                $refChoice3 = 0;
            } else {
                $links = $resultat->fetch();
                $refChoice3 = $links["Chapter"];
            }

            //on récupère les "anciennes" données de la table points pour qu'elles s'affichent dans le form et soient modifiables

            //pour récupérer le contenu des checkbox
            $requete = "SELECT * FROM points WHERE id_story= :id_story AND chapter = :chapter AND numChoice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "chapter" => $numChap, "choice" => 1));
            //il n'est pas requis d'avoir trois choix possibles pour chaque chapitre, donc on vérifie que la requête retourne quelque 
            //chose avant de récupérer le résultat et de poser la variable $echec1
            if ($resultat->rowCount() == 0) {
                $echec1 = 2;
            } else {
                $Echec = $resultat->fetch();
                $echec1 = $Echec["death"];
            }

            $requete = "SELECT * FROM points WHERE id_story= :id_story AND chapter = :chapter AND numChoice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "chapter" => $numChap, "choice" => 2));
            //il n'est pas requis d'avoir trois choix possibles pour chaque chapitre, donc on vérifie que la requête retourne quelque 
            //chose avant de récupérer le résultat et de poser la variable $echec2
            if ($resultat->rowCount() == 0) {
                $echec2 = 2;
            } else {
                $Echec = $resultat->fetch();
                $echec2 = $Echec["death"];
            }

            $requete = "SELECT * FROM points WHERE id_story= :id_story AND chapter = :chapter AND numChoice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "chapter" => $numChap, "choice" => 3));
            //il n'est pas requis d'avoir trois choix possibles pour chaque chapitre, donc on vérifie que la requête retourne quelque 
            //chose avant de récupérer le résultat et de poser la variable $echec3
            if ($resultat->rowCount() == 0) {
                $echec3 = 2;
            } else {
                $Echec = $resultat->fetch();
                $echec3 = $Echec["death"];
            }

            //on récupère les points associés à chaque chapitre
            $requete = "SELECT * FROM points WHERE id_story= :id_story AND chapter = :chapter AND numChoice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "chapter" => $numChap, "choice" => 1));
            //il n'est pas requis d'avoir trois choix possibles pour chaque chapitre, donc on vérifie que la requête retourne quelque 
            //chose avant de récupérer le résultat et de poser la variable $points1
            if ($resultat->rowCount() != 0) {
                $tablePoints = $resultat->fetch();
                $points1 = $tablePoints["points"];
            }

            $requete = "SELECT * FROM points WHERE id_story= :id_story AND chapter = :chapter AND numChoice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "chapter" => $numChap, "choice" => 2));
            //il n'est pas requis d'avoir trois choix possibles pour chaque chapitre, donc on vérifie que la requête retourne quelque 
            //chose avant de récupérer le résultat et de poser la variable $points2
            if ($resultat->rowCount() != 0) {
                $tablePoints = $resultat->fetch();
                $points2 = $tablePoints["points"];
            }

            $requete = "SELECT * FROM points WHERE id_story= :id_story AND chapter = :chapter AND numChoice= :choice";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $id_story, "chapter" => $numChap, "choice" => 3));
            //il n'est pas requis d'avoir trois choix possibles pour chaque chapitre, donc on vérifie que la requête retourne quelque 
            //chose avant de récupérer le résultat et de poser la variable $points3
            if ($resultat->rowCount() != 0) {
                $tablePoints = $resultat->fetch();
                $points3 = $tablePoints["points"];
            }
            ?>
        </div>
                <!--L'affichage du formulaire commence ici-->
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
                                    <h6> Quel est l'intitulé de ce choix ? (FIN si ce chapitre est le dernier)</h6>
                                </li>
                                <input type="text" name="choice1" class="form-control" value="<?= $choice1 ?>" required autofocus>
                                <br />
                                <li>
                                    <h6> Vers quel chapitre ce choix renvoie-t-il ? </h6>
                                </li>
                                <?php if ($refChoice1 == 0) { ?>
                                    <input type="number" name="refChoice1" class="form-control" autofocus>
                                <?php
                                } else { ?>
                                    <input type="number" name="refChoice1" class="form-control" value="<?= $refChoice1 ?>" autofocus>
                                <?php
                                } ?>
                                <br />
                                <li>
                                    <h6> Ce choix entraîne-t-il l'échec du personnage ? </h6>
                                </li>
                                <?php if ($echec1 == 1) { ?>
                                    <input type="radio" name="echec1" id="oui" value="oui" checked>
                                    <label style="font-size:medium" for="oui">Oui</label>
                                    <input type="radio" name="echec1" id="non" value="non">
                                    <label style="font-size:medium" for="oui">Non</label>
                                <?php
                                } else { ?>
                                    <input type="radio" name="echec1" id="oui" value="oui">
                                    <label style="font-size:medium" for="oui">Oui</label>
                                    <input type="radio" name="echec1" id="non" value="non" checked>
                                    <label style="font-size:medium" for="oui">Non</label>
                                <?php
                                } ?>

                                <br />
                                <li>
                                    <h6> Points de vie perdus pour ce choix (0 si aucun point perdu ou que vous avez coché oui précédemment)</h6>
                                </li>
                                <input type="number" name="points1" class="form-control" value="<?= $points1 ?>" autofocus>
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
                                <?php if ($refChoice2 == 0) { ?>
                                    <input type="number" name="refChoice2" class="form-control" autofocus>
                                <?php
                                } else { ?>
                                    <input type="number" name="refChoice2" class="form-control" value="<?= $refChoice2 ?>" autofocus>
                                <?php
                                } ?>
                                <br />
                                <li>
                                    <h6> Ce choix entraîne-t-il l'échec du personnage ? </h6>
                                </li>
                                <?php if ($echec2 == 1) { ?>
                                    <input type="radio" name="echec2" id="oui" value="oui" checked>
                                    <label style="font-size:medium" for="oui">Oui</label>
                                    <input type="radio" name="echec2" id="non" value="non">
                                    <label style="font-size:medium" for="oui">Non</label>
                                <?php
                                } else { ?>
                                    <input type="radio" name="echec2" id="oui" value="oui">
                                    <label style="font-size:medium" for="oui">Oui</label>
                                    <input type="radio" name="echec2" id="non" value="non" checked>
                                    <label style="font-size:medium" for="oui">Non</label>
                                <?php
                                } ?>

                                <br />
                                <li>
                                    <h6> Points de vie perdus pour ce choix (0 si aucun point perdu ou que vous avez coché oui précédemment)</h6>
                                </li>
                                <input type="number" name="points2" class="form-control" value="<?= $points2 ?>" autofocus>
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
                                <?php if ($refChoice3 == 0) { ?>
                                    <input type="number" name="refChoice3" class="form-control" autofocus>
                                <?php
                                } else { ?>
                                    <input type="number" name="refChoice3" class="form-control" value="<?= $refChoice3 ?>" autofocus>
                                <?php
                                } ?>
                                <br />
                                <li>
                                    <h6> Ce choix entraîne-t-il l'échec du personnage ? </h6>
                                </li>
                                <?php if ($echec3 == 1) { ?>
                                    <input type="radio" name="echec3" id="oui" value="oui" checked>
                                    <label style="font-size:medium" for="oui">Oui</label>
                                    <input type="radio" name="echec3" id="non" value="non">
                                    <label style="font-size:medium" for="oui">Non</label>
                                <?php
                                } else { ?>
                                    <input type="radio" name="echec3" id="oui" value="oui">
                                    <label style="font-size:medium" for="oui">Oui</label>
                                    <input type="radio" name="echec3" id="non" value="non" checked>
                                    <label style="font-size:medium" for="oui">Non</label>
                                <?php
                                } ?>
                                <br />
                                <li>
                                    <h6> Points de vie perdus pour ce choix (0 si aucun point perdu ou que vous avez coché oui précédemment)</h6>
                                </li>
                                <input type="number" name="points3" class="form-control" value="<?= $points3 ?>" autofocus>
                            </ul>
                        </div>
                    </ul>
                </div>
                <br />
                <div>
                    <div>
                        <button id="size-btn" type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Sauvegarder</button>
                        &nbsp;
                        <a id="size-btn" class="btn btn-outline-primary" href="story_modify.php?id=<?= $id_story ?>" role="button"> Retour sans sauvegarder</a>
                    </div>
                </div>
            </form>
        </div>
        <a class="btn btn-success" id="btnHautPage" href="#top" role="button" title="Haut de page"> <i class="bi bi-caret-up-fill"></i> </a>
    </div>
</main>
</body>

</html>