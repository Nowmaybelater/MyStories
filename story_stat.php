<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<main>
    <div id="backgroundConnexion">
        <p class="titre_petit"> Statistiques</p>
        <div class="accordion" id="accordion">
        <?php $requete = "SELECT id_story, title FROM stories";
              $resultat = $bdd->query($requete);
              while ($ligne = $resultat->fetch()) {
                $valeur = $ligne['id_story'];
                ?>

            <div class="accordion-item">
                <h2 class="accordion-header" id="heading">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="true" aria-controls="collapse">
                    <?= $ligne['title'] ?>
                    </button>
                </h2>
                <?php $req = "SELECT * FROM stats WHERE id_story=:id";
                        $res = $bdd->prepare($req);
                        $res->execute(array("id"=>$valeur));
                        $ligne2 = $res->fetch();
                
                ?>
                <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        Nombre de fois que l'histoire a été jouée : <?= $ligne2['played']?>
                    </div>
                </div>
                <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        Nombre de points moyen par parties : <?= $ligne2['points']?>
                    </div>
                </div>    
                <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordion">
                    <div class="accordion-body">
                        <?php 
                        $pourcentageMort=0;
                        if($ligne2['played']!=0){
                            $pourcentageMort = $ligne2['death']*100/$ligne2['played'];
                        }?>
                        Pourcentage de morts : <?= $pourcentageMort?>
                    </div>
                </div>  
            </div>

        <?php
              }
              ?>
        </div>
        </div>
    </div>
</main>