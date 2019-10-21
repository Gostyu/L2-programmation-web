<?php 
function nouveauMDP($idTuteur,$nouveauMDP){
    if(is_numeric($idTuteur)&& !empty($nouveauMDP)){
        return array(
            'idTuteur' => $idTuteur,
            'mdp' => password_hash(htmlspecialchars($nouveauMDP),PASSWORD_DEFAULT)
        );
    }
    return NULL;
}

function modifMDP($db,$nouveauMDP){
    try{
        $SQL="UPDATE users SET mdp=? WHERE uid= ?";
        $modificationMDP= $db->prepare($SQL);
        if(!empty($nouveauMDP)){
            $modificationMDP->execute(array($nouveauMDP["mdp"],$nouveauMDP["idTuteur"]));
        }
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
?>