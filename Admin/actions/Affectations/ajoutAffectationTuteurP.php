<?php
function nouvelleAffectation($idStage,$idTuteur){
    if(is_numeric($idStage) && is_numeric($idTuteur)){
        $affectation=array(
            'sid'=>$idStage,
            'uid'=>$idTuteur
        );
        return $affectation;
    }
}
function ajoutAffectationTuteurP($db,$tuteur){
    $SQL="UPDATE stages SET tuteurP=? WHERE sid=?";
    try{
        $requete=$db->prepare($SQL);
        $requete->execute(array($tuteur["uid"],$tuteur["sid"]));
        if($requete->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à BD ".$e->getMessage());
    }
}
function messageSucces_ajoutAffectationTuteurP(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Ajout de l'affectation réussi !</strong></div>";
}
function messageEchec_ajoutAffectationTuteurP(){
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de l'ajout de l'affectation !</strong></div>";
}
function listeStagesEtudiants($db){
     $SQL="SELECT stages.sid, stages.titre FROM stages WHERE stages.tuteurP IS NULL";
        try{
        $users=$db->prepare($SQL);
        $users->execute();
        if($users->rowCount()==0){
            echo "<div class='alert alert-info alert fade show text-center' role='alert'>
            <strong>Tous les stages ont été affectés à un tuteur !</strong></div>";
        }else{
            echo'
            <select name="stage" class="custom-select ">
                     ';
                    while($user=$users->fetch()){
                        echo' <option value="'.$user["sid"].'">
                        '.$user["sid"].'-'.$user["titre"].'
                        </option>';
                    }
            echo '
                 </select>
            ';
                $users->closeCursor();
            
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à BD !".$e->getMessage());
    }
}
function listeTuteursActifs($db){
    $SQL="SELECT DISTINCT users.uid, users.nom, users.prenom FROM users LEFT JOIN stages ON users.uid=stages.tuteurP
 WHERE users.role='user' AND users.actif=true";
    try{
        $users=$db->prepare($SQL);
        $users->execute();
        if($users->rowCount()==0){
            echo "<div class='alert alert-info alert fade show text-center' role='alert'>
            <strong>Tous les stages ont été affectés à un tuteur !</strong></div>";
        }else{
            echo'<select name="tuteurP" class="custom-select ">
                     ';
                    while($user=$users->fetch()){
                        echo' <option value="'.$user["uid"].'">
                        '.$user["uid"].'-'.$user["nom"].' '.$user["prenom"].'
                        </option>';
                    }
            echo '
                 </select>
            ';
                $users->closeCursor();
            
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à BD !".$e->getMessage());
    }
}
function ajoutAffectationTuteurP_Form($db){
 echo'
            <div class="form-group row">
                <div class="col-md-12">
                    <label>Choix du stage d\'un étudiant</label>
                    ';
                    listeStagesEtudiants($db);
            echo'</div>
            </div>
        <div class="form-group row">
		    <div class="col-md-6">
                <label>Choix d\'un tuteur</label>
              ';
            listeTuteursActifs($db);
         echo'</div>
        </div>
        <!--<div class="form-group row">
            <div class="col-md-3">
                <button type="submit" name="valider" class="btn btn-primary">Valider ajout</button>
            </div>
        </div>-->';
      
}
?>
