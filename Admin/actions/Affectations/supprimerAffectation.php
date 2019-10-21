<?php
function supprimerAffectationTuteurP($db,$idStage){
    $SQL="UPDATE stages SET tuteurP=NULL WHERE sid = ?";
    if(is_numeric($idStage)){
    try{
        $requete=$db->prepare($SQL);
        $requete->execute(array($idStage));
        if($requete->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ".$e->getMessage());
    }
  }
}
function messageSucces_supprimerAffectationTuteurP(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Suppression de l'affectation réussie !</strong></div>";
}
function messageEchec_supprimerAffectationTuteurP(){
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de la suppression de l'affectation !</strong></div>";
}
?>