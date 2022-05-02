<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">

        <?php
            $storyId=$_GET['id'];
            //on suprime toutes les lignes faisant référence à cette histoire
            $req="UPDATE stories SET hide='0' WHERE id_story=?";
            $requete = $bdd->prepare($req);
            $requete->execute(array($storyId));
        ?>
        <div class="alert alert-success" role="alert">
            L'histoire est à présent visible !
        </div>
    </div>
</main>