<?php
function nouveauToken($gid){
    if(is_numeric($gid)){
        return array('gid' => $gid,'token' => bin2hex(random_bytes(26)));
    }
    return NULL;
}
function regenererToken($db,$nouveauToken){
    try{
        $SQL="UPDATE gestionnaires SET token=? WHERE gid=?";
        $requete=$db->prepare($SQL);
        if(!empty($nouveauToken)){
            $requete->execute(array($nouveauToken["token"],$nouveauToken["gid"]));
        }
        if($requete->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ".$e->getMessage());
    }
}
function messageSucces_regenererToken(){
           echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Regénération du token réussie !</strong></div>";
}
function messageEchec_regenererToken(){
        echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de la génération d'un token !</strong></div>";
}
?>