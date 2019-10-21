<?php
function supprimerGestionnaire($db,$id_ges){
    try{
        $SQL_sup_gestionnaire="DELETE FROM gestionnaires WHERE gid= ?";
        $supprime_gestionnaire=$db->prepare($SQL_sup_gestionnaire);
        if(is_numeric($id_ges)){
            $supprime_gestionnaire->execute(array($id_ges));
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
function messageSucces_supprimerGestionnaire(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Suppression réussie !</strong></div>";
}
function messageEchec_supprimerGestionnaire(){
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de la suppression !</strong></div>";
}
?>