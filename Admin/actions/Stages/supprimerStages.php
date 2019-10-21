<?php
function supprimerStages($db,$id_stage){
    try{
        $SQL_sup_stage="DELETE FROM stages WHERE sid= ?";
        $supprime_stage=$db->prepare($SQL_sup_stage);
        if(is_numeric($id_stage)){
            $supprime_stage->execute(array($id_stage));
        }
        if($supprime_stage->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
     exit("Erreur dans la requête !".$e->getMessage());
    }
}
function messageSucces_supprimerStages(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Suppression réussie !</strong></div>";
}
function messageEchec_supprimerStages(){
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de la suppresion !</strong></div>";
}
?>