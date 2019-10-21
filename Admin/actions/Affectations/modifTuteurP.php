<?php 
function nouveauTuteurP($tuteurChoisi,$idStage){
    if(is_numeric($tuteurChoisi)&&is_numeric($idStage)){
        $tuteur=array(
            'nouveauTp'=> $tuteurChoisi,
            'sid'=>$idStage
        );
        return $tuteur;
    }
    return NULL;
}
function changerTuteurP($db,$nouveauTuteurP){
    $SQL="UPDATE stages SET tuteurP=? WHERE sid=? ";
    try{
        $requete=$db->prepare($SQL);
        $requete->execute(array($nouveauTuteurP["nouveauTp"],$nouveauTuteurP["sid"]));
        if($requete->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
        $requete->closeCursor();
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ".$e->getMessage());
    }
}
function messageSucces_changerTuteurP(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Le changement du tuteur pédagogique réussi !</strong></div>";
}
function messageEchec_changerTuteurP(){
     echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
         <span aria-hidden='true'>&times;</span>
        </button>
     <strong>Echec du changement du tuteur pédagogique !</strong></div>";
}
function selectionnerTuteur($db,$idTuteurP){
        $SQL="SELECT DISTINCT users.uid,users.nom, users.prenom FROM users LEFT JOIN stages ON users.uid=stages.tuteurP WHERE users.role='user' AND users.actif=true AND uid!=?";
        try{
        $users=$db->prepare($SQL);
         $users->execute(array($idTuteurP));
            if($users->rowCount()==0){
                echo "<div class='alert alert-info alert fade show text-center' role='alert'>
                <strong>Tous les tuteurs sont désactivés !</strong></div>";
            }else{
                echo'
                <select name="tuteurChoisi" class="custom-select">
                         ';
                        while($user=$users->fetch()){
                            echo' <option value="'.$user["uid"].'">'.$user["uid"].'-'.htmlspecialchars($user["nom"]).' '.htmlspecialchars($user["prenom"]).'
                            </option>';
                        }
                echo '
                     </select>';
                $users->closeCursor(); 
            }
        }catch(\PDOException $e){
        exit("Echec de la connexion à BD !".$e->getMessage());
    }
}





?>