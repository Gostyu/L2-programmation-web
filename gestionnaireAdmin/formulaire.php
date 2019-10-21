<?php
function accesRefuse($quitter){
      echo "<div class='container center mt-5'>
                <div class='alert alert-danger' role='alert'>
                    <strong>Accés refusé !<strong>
                    <a href='".$quitter."' class='btn btn-outline-primary'>Retour à l'accueil</a> 
                </div>
            </div>";
    session_destroy();
}
function verification($db,$mail){
    $SQL="SELECT * FROM gestionnaires";
    try{
        $requete=$db->prepare($SQL);
        $requete->execute();
        if($requete->rowCount()==0){
            return -1;
        }else{
            while($row=$requete->fetch()){
                if(strcmp($row["email"],$mail)==0){
                    return $row["gid"];
                }
            }
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ".$e->getMessage());
    }
}
function getToken($db,$gid){
    $SQL="SELECT token FROM gestionnaires WHERE gid= ?";
    try{
        $requete=$db->prepare($SQL);
        $requete->execute(array($gid));
        if($requete->rowCount()==0){
            return -1;
        }else{
            return $requete->fetch();
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ".$e->getMessage());
    }
}
function verificationToken($db,$token){
    $SQL="SELECT token FROM gestionnaires";
      try{
        $requete=$db->prepare($SQL);
        $requete->execute();
        if($requete->rowCount()==0){
            return -1;
        }else{
            while($row=$requete->fetch()){
                if(strcmp($token,$row["token"])==0){
                    return true;
                }
            }
            return false;
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ".$e->getMessage());
    }
}
function afficheFormulaire(){
echo'
<form method="post" action="notes.php">
    <div class="form-group col-md-6">
        <label for="form1">Adresse mail</label>
        <input type="email" name="email" class="form-control" id="form1" required aria-describedby="emailHelp" placeholder="Entrer votre mail">
        <small id="emailHelp" class="form-text text-muted">Votre mail est de la forme : example@scola.u-pec.fr</small>
    </div>
      <button type="submit" name="connexion" class="btn btn-primary">Connexion</button>
</form>'; 
}
function afficheFormulaireToken($token){
echo'
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Voir la liste des notes</h5>
        </button>
      </div>
      <div class="modal-body">
      <form method="get" action="notes.php">
    <div class="form-group col-md-6">
        <label for="form1">Votre token</label>
            <p name="Token" value='.$token["token"].'>'.$token["token"].'</p>

    </div>
     <small id="emailHelp" class="form-text text-muted center">Valider ou entrer dans l\'URL: ?accesNotes=votreToken</small>
    </div>
      <div class="modal-footer">
      <button type="submit" name="valider" class="btn btn-primary" value="ok">Valider</button>
    </form>
      </div>
    </div>
  </div>
';
}
function navbarGestionnaire($quitter){
  echo'<div class="container">
                   <div class="row">
                       <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
                       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                       </button>
                        <a class="navbar-brand" href="'.$quitter.'">Flash Stages</a>
                        <div class="collapse navbar-collapse" id="navbarToggler">
                           <ul class="navbar-nav ml-auto">
                                <li class="nav-item"><a class="nav-link" href="'.$quitter.'">Déconnexion</a></li>
                           </ul>
                        </div>
                    </nav>
                </div>
        </div>';
}
?>