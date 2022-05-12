<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<!--Cette page permet à un administrateur de visualiser les statistiques associées à son histoire (nombre de fois que l'histoire a été jouée, 
nombre de points moyen perdus par partie et pourcentage d'échecs-->
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit"> Statistiques</p>
        <?php $storyId = $_GET['id']; ?>
        <!--la requête permet de récupérer toutes les données de la table statistiques, dans laquelle sont stockées les données nécessaires à 
l'affichage des statistiques mentionnées plus haut -->
        <?php
        $req = "SELECT * FROM stats WHERE id_story=:id";
        $res = $bdd->prepare($req);
        $res->execute(array("id" => $storyId));
        //Si l'histoire a déjà été jouée, des statistiques sont présentes dans la table et on peut donc les afficher. Sinon, on affiche toutes les statistiques à 0
        if ($res->rowCount() == 1) {
            $ligne2 = $res->fetch();
        ?>
            <div>
                <br />
                Nombre de fois que l'histoire a été jouée :
                <?php
                if (!empty($ligne2['played'])) {
                    echo $ligne2['played'];
                } else {
                    echo 0;
                }
                ?>
                <br />
                <br />
                Nombre de points perdus en moyenne par partie :
                <?php
                if (!empty($ligne2['points']) && !empty($ligne2['played']) && $ligne2['played'] != 0) {
                    $pts = $ligne2['points'] / $ligne2['played'];
                } else {
                    $pts = 0;
                }
                echo number_format($pts,2);
                ?>
                <br />

                <?php
                $pourcentageMort = 0;
                if (!empty($ligne2['played']) && $ligne2['played'] != 0) {
                    $pourcentageMort = ($ligne2['death'] * 100) / $ligne2['played'];
                } else {
                    $pourcentageMort = 0;
                }
                ?>
                <br />
                Pourcentage d'échec : <?= number_format($pourcentageMort, 2) ?> %

            </div>
        <?php } else {
        ?>
            Nombre de fois que l'histoire a été jouée : 0
            <br />
            Nombre de points moyen par parties : 0
            <br />
            Pourcentage de morts : 0 %
        <?php
        }
        ?>
        <br />
        <!--le bouton permet de revenir à la page précédente, c'est-à-dire la liste des histoires écrites par l'utilisateur et dont il peut consulter les statistiques, etc-->
        <div id="btn-lecture">
            <a id="size-btn" class="btn btn-outline-dark" href="ListeHistoires.php" role="button"> Retour à la page précédente </a>
        </div>
    </div>
</main>
</body>

</html>