<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit"> Suppression </p>

        <?php
        $delete = filter_input(INPUT_POST, 'delete');
        if ($delete) {
            $story=$_POST['delete'];
            $requete = $bdd->prepare('SELECT * FROM stories WHERE title=?');
            $requete->execute(array($story));
            $id = $requete->fetch();
            echo $id['id_story'];
            //on suprime toutes les lignes faisant référence à cette histoire
            $requete2 = $bdd->prepare('SELECT * FROM chapters WHERE id_story=?');
            $requete3 = $bdd->prepare('DELETE FROM chapters WHERE id_story=?');
            $requete3->execute(array($id));
            $requete4 = $bdd->prepare('DELETE FROM links WHERE id_story=?');
            $requete4->execute(array($id));
            $requete5 = $bdd->prepare('DELETE FROM points WHERE id_story=?');
            $requete5->execute(array($id));
            $requete6 = $bdd->prepare('DELETE FROM advancement WHERE id_story=?');
            $requete6->execute(array($id));
            $requete7 = $bdd->prepare('DELETE FROM stats WHERE id_story=?');
            $requete7->execute(array($id));
            $requete8 = $bdd->prepare('DELETE FROM stories WHERE id_story=?');
            $requete8->execute(array($id));
        }


        ?>




        <div>
        <form method="post" action="story_delete.php">
        <div class="well"></div>
        <br />
            <div class="form-group" id="centre">
                 <select name="delete" id="delete"> 
                    <option value="" style="color: gray; font-size: medium;">Choissisez une histoire à supprimer</option>
                    <?php
                    $requete = "SELECT * FROM stories WHERE author=?";
                    $resultat = $bdd->prepare($requete);
                    $resultat->execute(array($_SESSION['login']));
                    while ($histoire = $resultat->fetch()) {
                        $valeur = $histoire["id_story"];
                    ?> <option value=<?= $histoire['title'] ?> style="font-size: medium;"><?= $histoire['title'] ?></option>
                    <?php
                    }
                    ?>
                </select> 
            </div>
                <br/>
                <div class="form-group" id="centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-default btn-primary" pb-role="submit"><span class="glyphicon glyphicon-log-in"></span> Supprimer</button>
                </div>
                </div>
            </p>
        </form>
            
        </div>
    </div>
</main>