<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php include("includes/functions.php") ?>
<!--Cette page permet à l'administrateur de modifier les informations générales liées à l'une de ses histoires (titre, résumé, nombre de 
points associés) via un formulaire-->
<?php
if (isset($_POST['title'])) {
    $id_story = $_GET['id'];
    //on récupère les données du formulaire(il s'agit de nouvelles données, ou des anciennes si l'utilisateur n'y a pas touché)
    $newTitle = escape($_POST['title']);
    $newSummary = escape($_POST['summary']);
    $newPoints = escape($_POST['points']);

    //les requêtes suivantes permettent de modifier l'histoire dans la base de données, à partir des données récupérées au-dessus       
    $requete = "UPDATE stories SET title='$newTitle' WHERE id_story=:id";
    $stmt = $bdd->prepare($requete);
    $stmt->execute(array('id' => $id_story));

    $requete = "UPDATE stories SET summary='$newSummary' WHERE id_story=:id";
    $stmt = $bdd->prepare($requete);
    $stmt->execute(array('id' => $id_story));

    $requete = "UPDATE stories SET date=NOW() WHERE id_story=:id";
    $stmt = $bdd->prepare($requete);
    $stmt->execute(array('id' => $id_story));

    $requete = "UPDATE stories SET nbrPoints=$newPoints WHERE id_story=:id";
    $stmt = $bdd->prepare($requete);
    $stmt->execute(array('id' => $id_story));
    //Une fois qu'il a sauvegardé, on redirige l'utilisateur vers la page générale lui permettant de manager l'histoire et ses chapitres
    redirect("story_modify.php?id=$id_story");
}

?>
<!--Début de l'affichage-->
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit"> Modification </p>
        <div>
            <?php
            //cette requête permet de récupérer dans la table stories les "anciennes" données relatives à l'histoires, i.e celles précédent les modifications éventuelles par l'utilisateur
            $requete = "SELECT * FROM stories WHERE id_story = :id_story";
            $resultat = $bdd->prepare($requete);
            $resultat->execute(array("id_story" => $_GET['id']));
            $histoire = $resultat->fetch();
            $valeur = $histoire["id_story"];
            $title = $histoire["title"];
            $summary = $histoire["summary"];
            $points = $histoire["nbrPoints"];
            ?>
            <div>
                <h2><em id="centre" style="color :grey;"><?= $histoire['title'] ?></em></h2>
            </div>
        </div>
        <!--L'affichage du formulaire commence ici-->
        <div>
            <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="<?= $storyId ?>">
                <div class="form-group">
                    <label>Titre</label>
                    <div class="col-sm-6">
                        <!--La zone du formulaire est remplie avec l'ancien titre de l'histoire, afin de permettre à l'utilisateur
                    de le visualiser avant de le mettre à jour-->
                        <input type="text" name="title" class="form-control" value="<?= $title ?>" required autofocus>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <label>Résumé</label>
                    <div class="col-sm-6">
                        <!--La zone du formulaire est remplie avec l'ancien résumé de l'histoire, afin de permettre à l'utilisateur
                    de le visualiser avant de le mettre à jour-->
                        <textarea name="summary" class="form-control" required><?= $summary ?></textarea>
                    </div>
                </div>
                <br />
                <div>
                    <label>Nombre de points de vie</label>
                    <div>
                        <!--La zone du formulaire est remplie avec l'ancien nombre de points de l'histoire, afin de permettre à l'utilisateur
                    de le visualiser avant de le mettre à jour-->
                        <input type="number" name="points" class="form-control" value="<?= $points ?>" required autofocus>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <div>
                        <!-- L'utilisateur est libre de sauvegarder ou non les modifications effectuées-->
                        <button id="size-btn" type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Sauvegarder les changements </button>
                        <a id="size-btn" class="btn btn-outline-primary" href="ListeHistoires.php" role="button"> Retour sans sauvegarder</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
</body>

</html>