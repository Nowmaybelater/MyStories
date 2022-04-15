<?php include("includes/header.php")?>
<?php include("includes/connect.php")?>

<main>
    <div id=backgroundConnexion> 
        <h2 class="connexion">Connexion</h2>
        <?php
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $login = $_POST['login'];
            $mdp = $_POST['password'];
            $requete = $bdd->prepare('SELECT * FROM user WHERE login_usr=? AND password_usr=?');
            $requete->execute(array($login, $mdp));
            if ($requete->rowCount() == 1) {
                $_SESSION['login'] = $login;
                header("Location: Accueil.php");
            } else {
                echo "Mot de passe ou nom d'utilisateur incorrect";
            }
        }


        ?>


        
        <br />
        <div class="well" id="connect"></div>
        <form class="form-signin form-horizontal" role="form" action="login.php" method="post" pb-autologin="true" autocomplete="off" id="formul">
            <div class="form-group" id ="centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input type="text" name="login" class="form-control" placeholder="Entrez votre login" required="" autofocus="" pb-role="username">
                    <passwordboxicon pb-icon="username" icon-type="main" style="position: absolute; background: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAQCAYAAAAI0W+oAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDE0IDc5LjE1Njc5NywgMjAxNC8wOC8yMC0wOTo1MzowMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NzU4NUJBRkU1QkVFMTFFNDkyRkVDMDk0Nzk5RDFBMDQiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NzU4NUJBRkQ1QkVFMTFFNDkyRkVDMDk0Nzk5RDFBMDQiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjA5M0ZFMjdERDI5NDExRTE5Njc0OTU4Rjk3NzgwODJEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjA5M0ZFMjdFRDI5NDExRTE5Njc0OTU4Rjk3NzgwODJEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+MHuEgAAAAWtJREFUeNq8VCFMxEAQ3DZ1RRdfSUBTcg6JwdfjeQsaJCXYDxZ03/+7BtD/BsMLDAFdXebu9r7bpnxLSZhkvr9719vu7uxRVVXUiUlxDUbCjo2vA/qMPvr0M17AI2En7BsFX3xxBIZi7Qk8FvYh+9z+sJHx4EBEMXiHlw+MlalP/M7E+ox9xHvu+Z1B8HT9PM+r+0B0CU5x6DP7FAcu2NYlPAOv4HtzPfpdIFcSIs2Sgy7Bd/DEHO7WMlVKMfRii+rOwVTYqfGNVF2wkbJUW6ZyPCNTwho5Z6j3n7I4HC76Egq4/l0bS5b0XMi75P05B7a46S9dsGXt0WQwKXbwfAVT7tEotFWnG637sDJfbUv0Be6Ba/jm7NsHb50ghojBb1wxdjZWXBo3pB/ggkvnyrbmmYvHDGxomuqC2Ox2zazYeYk3N0emHoTUB6HuUaaWrbWkceXY/7U4eFjHZEQdgRatSzb5kxj+A98CDADG3MBsPyzvawAAAABJRU5ErkJggg==&quot;) right center no-repeat; width: 30px; height: 34px; z-index: auto; visibility: visible; top: 0px; left: 581px;"></passwordboxicon>
                </div>
            </div>
            <br />
            <div class="form-group" id = "centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required="" pb-role="password">
                    <passwordboxicon pb-icon="password" icon-type="main" style="position: absolute; background: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAQCAYAAAAI0W+oAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDE0IDc5LjE1Njc5NywgMjAxNC8wOC8yMC0wOTo1MzowMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NzU4NUJBRkU1QkVFMTFFNDkyRkVDMDk0Nzk5RDFBMDQiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NzU4NUJBRkQ1QkVFMTFFNDkyRkVDMDk0Nzk5RDFBMDQiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjA5M0ZFMjdERDI5NDExRTE5Njc0OTU4Rjk3NzgwODJEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjA5M0ZFMjdFRDI5NDExRTE5Njc0OTU4Rjk3NzgwODJEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+MHuEgAAAAWtJREFUeNq8VCFMxEAQ3DZ1RRdfSUBTcg6JwdfjeQsaJCXYDxZ03/+7BtD/BsMLDAFdXebu9r7bpnxLSZhkvr9719vu7uxRVVXUiUlxDUbCjo2vA/qMPvr0M17AI2En7BsFX3xxBIZi7Qk8FvYh+9z+sJHx4EBEMXiHlw+MlalP/M7E+ox9xHvu+Z1B8HT9PM+r+0B0CU5x6DP7FAcu2NYlPAOv4HtzPfpdIFcSIs2Sgy7Bd/DEHO7WMlVKMfRii+rOwVTYqfGNVF2wkbJUW6ZyPCNTwho5Z6j3n7I4HC76Egq4/l0bS5b0XMi75P05B7a46S9dsGXt0WQwKXbwfAVT7tEotFWnG637sDJfbUv0Be6Ba/jm7NsHb50ghojBb1wxdjZWXBo3pB/ggkvnyrbmmYvHDGxomuqC2Ox2zazYeYk3N0emHoTUB6HuUaaWrbWkceXY/7U4eFjHZEQdgRatSzb5kxj+A98CDADG3MBsPyzvawAAAABJRU5ErkJggg==&quot;) right center no-repeat; width: 30px; height: 34px; z-index: auto; visibility: visible; top: 0px; left: 581px;"></passwordboxicon>
                </div>
            </div>
            <br />
            <div id ="centre">
                <a href = "Inscription.php"  style = "font-size : 0.5cm"> Pas de compte ? Inscrivez-vous !</a>

            </div>
            <br /> 
            <div class="form-group" id ="centre">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <button type="submit" class="btn btn-default btn-primary" pb-role="submit"><span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
                </div>
            </div>
            <br />
        </form>
    </div>
</main>
</body>

</html>