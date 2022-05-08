<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php include("includes/functions.php") ?>

<main>
    <div id=backgroundConnexion>
        <h1 class="titre">Gagné !    </h1>
        <?php 
        $requete1 = $bdd->prepare('SELECT * FROM user WHERE login_usr=?');
        $requete1->execute(array($_SESSION['login']));
        $ligne1=$requete1->fetch();
        $id_usr=$ligne1['id_usr'];
        Resume($id_usr, $_GET['id'], $bdd);

        ?>
    </div>
</main>
</body>

</html>