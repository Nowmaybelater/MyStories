<?php include("includes/header.php") ?>
<?php include("includes/connect.php") ?>
<?php
    $requete = "SELECT * FROM user WHERE login_usr = :usr_login";
    $req = $bdd->prepare($requete);
    $req->execute(array(
        'usr_login' => $_SESSION['login'],
    ));
    $ligne = $req->fetch();  
    $id_user = $ligne['id_usr'];

    $requete2 = "SELECT * FROM advancement WHERE id_usr = :usr_id AND id_story = :story_id";
    $req2 = $bdd->prepare($requete2);
    $req2->execute(array(
        'usr_id' => $id_user,
        'story_id'=> $_GET['story_id']
    ));
    $chap=$_GET['chapter_num'];
    if ($req2->rowCount() == 1){
        $req3="UPDATE advancement SET numChapter=$chap WHERE id_usr = :usr_id AND id_story = :story_id";
        $requete3 = $bdd->prepare($req3);
        $requete3->execute(array(
            'usr_id' => $id_user,
            'story_id'=> $_GET['story_id']
        ));
        $req5="UPDATE advancement SET jour=NOW() WHERE id_usr = :usr_id AND id_story = :story_id";
        $requete5 = $bdd->prepare($req5);
        $requete5->execute(array(
            'usr_id' => $id_user,
            'story_id'=> $_GET['story_id']
        ));
    }
    else{
        $req4 = $bdd->prepare('INSERT INTO advancement (id_usr, id_story, numChapter,jour) VALUES (:usr_id, :id_story, :numChap, :jour)');
        $req4->execute(array(
            'usr_id' => $id_user,
            'id_story' => $_GET['story_id'],
            'numChap' => $chap,
            'jour'=>date('y-m-d')
        ));
    }

    header("Location: index.php");?>