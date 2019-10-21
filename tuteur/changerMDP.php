<?php
function nouveauMDP($idTuteur,$nouveauMDP){
    $mdp =array(
        'idTuteur' => $idTuteur,
        'mdp' => password_hash(htmlspecialchars($nouveauMDP),PASSWORD_DEFAULT)
    );
    return $mdp;
}
function modifMDP($db,$nouveauMDP){
    try{
        $SQL="UPDATE users SET mdp=? WHERE uid= ?";
        $modificationMDP= $db->prepare($SQL);
        $modificationMDP->execute(array($nouveauMDP["mdp"],$nouveauMDP["idTuteur"]));
        if($modificationMDP->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ".$e->getMessage());
    }
}
function messageSucces_modifMDP(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Le mot de passe a bien été modifié !</strong></div>";
}
function messageEchec_modfiMDP(){
     echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
         <span aria-hidden='true'>&times;</span>
        </button>
     <strong>Echec de l'activation !</strong></div>";
}
function afficheModifMDPForm(){
    echo'
    <div>
    <h1>Changement de mot de passe</h1>
    <form method="post">
        <div class="row">
          <div class="col-md-4">
            <input type="password" name="nouveauMDP" class="form-control" id="inputLogin" required placeholder="Nouveau mot de passe">
             <label for="inputNom"></label>	
            </div>
            <div class="col-md-4">
              <button type="submit" name="valider" class="btn btn-primary">Valider</button>
             </div>
        </div>
</form>
</div>
';
}

function changerMDP($db){
    if(isset($_POST["valider"],$_POST["nouveauMDP"])){
        if(modifMDP($db,nouveauMDP($_SESSION["tutor_id"],$_POST["nouveauMDP"]))!=0){
            messageEchec_modifMDP();
        }else{
            messageSucces_modifMDP();
        }
    }
    afficheModifMDPForm();
}
?>