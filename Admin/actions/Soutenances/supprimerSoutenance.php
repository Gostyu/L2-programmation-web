<?php
function supprimerSoutenance($db,$sid){
    try{
        $SQL_sup_gestionnaire="DELETE FROM soutenances WHERE stid= ?";
        $supprime_gestionnaire=$db->prepare($SQL_sup_gestionnaire);
        if(is_numeric($sid)){
            $supprime_gestionnaire->execute(array($sid));
        }
        if($supprime_gestionnaire->rowCount()==0){
          return -1;
        }else{
         return 0;   
        }
    }catch(\PDOException $e){
     exit("Erreur dans la requête !".$e->getMessage());
    }
}
function messageSucces_supprimerSoutenance(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Suppression de la soutenance réussie !</strong></div>";
}
function messageEchec_supprimerSoutenance(){
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de la suppression de la soutenance !</strong></div>";
}
?>