<?php 
function activationStatut($db,$idTuteur){
    try{
        $SQL="UPDATE users SET actif = 1 WHERE uid = ?";
        $statut=$db->prepare($SQL);
        if(is_numeric($idTuteur)){
            $statut->execute(array($idTuteur));
        }
        if($statut->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("Echec de connexion à la BD ".$e->getMessage());
    }
}
function desactivationStatut($db,$idTuteur){
    try{
        $SQL="UPDATE users SET actif = 0 WHERE uid = ?";
        $statut=$db->prepare($SQL);
        if(is_numeric($idTuteur)){
            $statut->execute(array($idTuteur));
        }
        if($statut->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("Echec de connexion à la BD ".$e->getMessage());
    }
}
function messageEchec_activationStatut(){
        echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
         <span aria-hidden='true'>&times;</span>
        </button>
     <strong>Echec de l'activation !</strong></div>";
}
function messageSucces_activationStatut(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Activation du statut réussie !</strong></div>"; 
}
function messageEchec_desactivationStatut(){
         echo "<div class='alert alert-danger  alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='close'>
             <span aria-hidden='true'>&times;</span>
            </button>
         <strong>Echec de la désativation !</strong></div>";
}
function messageSucces_desactivationStatut(){
         echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='close'>
            <span aria-hidden='true'>&times;</span>
           </button>
        <strong>Désactivation du statut réussie !</strong></div>"; 
    }
?>