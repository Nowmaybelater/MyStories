<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit"> Statistiques</p>
        <?php $storyId=$_GET['id']; ?>

            <?php $req = "SELECT * FROM stats WHERE id_story=:id";
                    $res = $bdd->prepare($req);
                    $res->execute(array("id"=>$storyId));
                    $ligne2 = $res->fetch();
            
            ?>
            <div>
                Nombre de fois que l'histoire a été jouée : 
                <?php 
                if(!empty($ligne2['played'])){
                    echo $ligne2['played'];
                }
                else{
                    echo 0;
                }
                ?>
                <br/>
                <br/>
                Nombre de points moyen par parties : 
                <?php 
                if(!empty($ligne2['points']) && !empty($ligne2['played']) && $ligne2['played']!=0){
                    $pts= $ligne2['points']/$ligne2['played'];
                }
                else{
                    $pts=0;
                }
                echo $pts;
                ?>
                <br/>

                <?php 
                $pourcentageMort=0;
                if(!empty($ligne2['played']) && $ligne2['played']!=0){
                    $pourcentageMort = $ligne2['death']*100/$ligne2['played'];
                }
                else{
                    $pourcentageMort = 0;
                }
                ?>
                <br/>
                Pourcentage de morts : <?= $pourcentageMort?> %

            </div>
        </div>
        </div>
    </div>
</main>