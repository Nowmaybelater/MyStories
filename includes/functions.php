<?php
        //fonction qui met à jour les point et la mort du joueur au fur et à mesure des choix
        function Points($id_user, $bdd, $chapter, $choice, $points_chapter)
        {
            //sélection des points associés au choix du chapitre en paramètre
            $requete11 = "SELECT * FROM points WHERE id_story = :story_id AND chapter= :chapter AND numChoice= :choice";
            $req11 = $bdd->prepare($requete11);
            $req11->execute(array(
                'story_id'=> $_GET['story_id'],
                'chapter'=> $chapter,
                'choice'=>$choice
            ));
            //si le chapitre possède des point ou provoque l'échec 
            if($req11->rowCount() ==1){
                $ligne2=$req11->fetch();
                $pts=$ligne2['points'];
                $death=$ligne2['death'];

                //on sélectionne les points perdu par le joueur ou/et si il a perdu
                $requete8 = "SELECT * FROM player_points WHERE id_user = :usr_id AND id_story = :story_id";
                $req8 = $bdd->prepare($requete8);
                $req8->execute(array(
                    'usr_id' => $id_user,
                    'story_id'=> $_GET['story_id']
                ));
                //Si le joueur à perdu des point ou à perdu la partie
                if($req8->rowCount() == 1){
                    $ligne=$req8->fetch();
                    $points=$ligne['points'] + $pts;
                    //on update player_points avec les nouveaux nombre de points
                    $req9="UPDATE player_points SET points=$points WHERE id_user = :usr_id AND id_story = :story_id";
                    $requete9 = $bdd->prepare($req9);
                    $requete9->execute(array(
                        'usr_id' => $id_user,
                        'story_id'=> $_GET['story_id']
                    ));
                    //on update le nombre de mort
                    $req12="UPDATE player_points SET death=$death WHERE id_user = :usr_id AND id_story = :story_id";
                    $requete12 = $bdd->prepare($req12);
                    $requete12->execute(array(
                        'usr_id' => $id_user,
                        'story_id'=> $_GET['story_id']
                    ));
                }
                else{
                    //si le joueur n'avait pas encore perdu de point pour cette histoire on insert les données dans la table player_points
                    $req10= $bdd->prepare('INSERT INTO player_points (id_user, id_story, points,death) VALUES (:usr_id, :id_story, :points, :death)');
                    $req10->execute(array(
                        'usr_id' => $id_user,
                        'id_story' => $_GET['story_id'],
                        'points' => $pts,
                        'death'=>$death
                    ));
                    $points=$pts;                    
                }
                //retourne 1 si le joueur n'a plus de point ou est mort, utilisé dans chapter.php pour savoir si le joueur est renvoyé sur end.php
                if($death==1){
                    return 1;
                }
                else{
                    if($points==$points_chapter){
                        return 1;
                    }
                    else{
                        return 0;
                    }
                }
            }
            return 0;
        }

        //enregistre l'avancement de l'utilisateur à chaque nouveau chapitre
        function Advancement($story_id, $chap, $login, $bdd){
            //on récupère l'id_user
            $requete = "SELECT * FROM user WHERE login_usr = :usr_login";
            $req = $bdd->prepare($requete);
            $req->execute(array(
                'usr_login' => $login,
            ));
            $ligne = $req->fetch();  
            $id_user = $ligne['id_usr'];
            //on récupère les données qui pourraient déjà exister pour cette histoire te cet utilisateur
            $requete2 = "SELECT * FROM advancement WHERE id_usr = :usr_id AND id_story = :story_id";
            $req2 = $bdd->prepare($requete2);
            $req2->execute(array(
                'usr_id' => $id_user,
                'story_id'=> $story_id
            ));
            if ($req2->rowCount() == 1){
                //si les données exitent, on les update avec le bon numéro de chapitre...
                $req3="UPDATE advancement SET numChapter=$chap WHERE id_usr = :usr_id AND id_story = :story_id";
                $requete3 = $bdd->prepare($req3);
                $requete3->execute(array(
                    'usr_id' => $id_user,
                    'story_id'=> $story_id
                ));
                //...et la bonne date
                $req5="UPDATE advancement SET jour=NOW() WHERE id_usr = :usr_id AND id_story = :story_id";
                $requete5 = $bdd->prepare($req5);
                $requete5->execute(array(
                    'usr_id' => $id_user,
                    'story_id'=> $story_id
                ));
            }
            else{
                // sinon on insert ces données dans advancement
                $req4 = $bdd->prepare('INSERT INTO advancement (id_usr, id_story, numChapter,jour) VALUES (:usr_id, :id_story, :numChap, :jour)');
                $req4->execute(array(
                    'usr_id' => $id_user,
                    'id_story' => $story_id,
                    'numChap' => $chap,
                    'jour'=>date('y-m-d')
                ));
            }
        }

        //créer le résumé des choix du joueurs et de ses performances en fin de partie (utilisé dans end.php)
        function Resume($id_user, $id_story, $bdd){
            //récupère les potentiels points perdus pas le joueur
            $requete1 = $bdd->prepare('SELECT * FROM player_points WHERE id_user=? AND id_story=?');
            $requete1->execute(array($id_user, $id_story));

            //récupère les données associées à l'histoire
            $requete2 = $bdd->prepare('SELECT * FROM stories WHERE id_story=?');
            $requete2->execute(array($id_story));
            $ligne2=$requete2->fetch();

            //si le joueur a perdu des points on les soustrait aux points totale de l'histoire et on initialise la variable death avec les données de la table
            if($requete1->rowCount()==1){
                $ligne1=$requete1->fetch();
                $nbPoints=$ligne2['nbrPoints']-$ligne1['points'];
                $death=$ligne1['death'];
            }
            else{
                //sinon on les initialise à leur valeur apr défaut
                $nbPoints=$ligne2['nbrPoints'];
                $death=0;
            }

            echo "Nombre de points restant : " . $nbPoints;
            ?>
            <br/><br/>
            <?php
            if($death==1){
                echo "Vous avez fait une erreur fatale";
            }
            else{
                echo "Vous n'avez pas fait d'erreur fatale";
            }

            ?> <br/><br/> Résumé de vos choix : <?php
            //récupère les choix de l'utilisateur pour cette histoire
            $requete3 = $bdd->prepare('SELECT * FROM choices WHERE id_usr=? AND id_story=?');
            $requete3->execute(array($id_user, $id_story));

            while($ligne3=$requete3->fetch()){
                //pour chaque histoire on va cherché le bon intitulé du chox réaliser dnas la table chapters et on affiche le choix associé au chapitre
                $requete4 = $bdd->prepare('SELECT * FROM chapters WHERE id_story=? AND numChapter=?');
                $requete4->execute(array($id_story, $ligne3['numChapter']));
                $ligne4=$requete4->fetch();

                if($ligne3['choice']==1){
                    $choice=$ligne4['choice1'];
                }
                else{
                    if($ligne3['choice']==2){
                        $choice=$ligne4['choice2'];
                    }
                    else{
                        $choice=$ligne4['choice3'];
                    }
                }
                ?> <br/> 
                <?php
                echo "Au chapitre " . $ligne3['numChapter'] . " vous avez fait le choix : " . $choice;
            }
            return $ligne2['nbrPoints'];//on retourne le nombre de points de l'histoire

        }
        ?>

<?php
// Rediriger vers un URL
function redirect($url)
{
    header("Location: $url");
}
?>

<?php
// pour se protéger des attaques XSS
function escape($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}
?>