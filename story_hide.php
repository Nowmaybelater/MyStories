<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit"> Suppression </p>

        <?php
        if (isset($_POST['hide'])) {
            $story=$_POST['hide'];
            echo $story;
            $req="UPDATE stories SET hide='1' WHERE title=:t";
            $requete = $bdd->prepare($req);
            $requete->execute(array("t"=>$story));
        }


        ?>




        <div>
        <form method="post" action="story_hide.php">
        <div class="well"></div>
        <br />
            <div class="form-group" id="centre">
                 <select name="hide" id="hide"> 
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
                    <button type="submit" id='button' class="btn btn-default btn-primary" pb-role="submit"><span class="glyphicon glyphicon-log-in"></span> Cacher</button>
                </div>
                </div>
            </p>
        </form>
            
        </div>
    </div>
</main>