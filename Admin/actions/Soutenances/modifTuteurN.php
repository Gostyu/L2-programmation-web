<?php
require_once("ajoutSoutenance.php");
function nouveauTuteurN($stid,$uid){
    if(is_numeric($uid) && is_numeric($stid)){
        return array('stid'=> $stid,'idTN'=>$uid);
    }
    return NULL;
}
function modifTuteurN($db,$tuteur,$typeTuteur){
    if(strcmp($typeTuteur,"principal")==0){
        $SQL="UPDATE soutenances SET tuteur1=? WHERE stid=?";
    }else if(strcmp($typeTuteur,"secondaire")==0){
        $SQL="UPDATE soutenances SET tuteur2=? WHERE stid=?";
    }
    try{
        $requete=$db->prepare($SQL);
        if(!empty($tuteur)){
            $requete->execute(array($tuteur["idTN"],$tuteur["stid"]));
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
function messageSucces_modifTuteurN($typeTuteur){
    if(strcmp($typeTuteur,"principal")==0){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Le changement du tuteur ".$typeTuteur." réussi !</strong></div>";
    }else if(strcmp($typeTuteur,"secondaire")==0){
            echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Le changement du tuteur ".$typeTuteur." réussi !</strong></div>";
    }
}
function messageEchec_modifTuteurN($typeTuteur){
        if(strcmp($typeTuteur,"principal")==0){
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec du changement du tuteur ".$typeTuteur." !</strong></div>";
    }else if(strcmp($typeTuteur,"secondaire")==0){
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec du changement du tuteur ".$typeTuteur." !</strong></div>";
    }
}
function modifTuteurNForm($db,$typeTuteur){
    echo'<div class="form-group row">';
    if(strcmp($typeTuteur,"principal")==0){
    echo'<div class="col-md-6">';
            selectionTuteur1($db);
      echo'
        </div>';
    }else if(strcmp($typeTuteur,"secondaire")==0){
        echo'<div class="col-md-6">';
            selectionTuteur2($db);
      echo'
        </div>';
    }
    echo'</div>';
}
?>