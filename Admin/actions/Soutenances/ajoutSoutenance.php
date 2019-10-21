<?php 
function selectionStagesEtudiant($db){
     $SQL="SELECT stages.sid, stages.titre FROM stages LEFT JOIN soutenances ON stages.sid=soutenances.sid
 WHERE soutenances.sid IS NULL";
        try{
        $users=$db->prepare($SQL);
        $users->execute();
        if($users->rowCount()==0){
            echo "<div class='alert alert-info alert fade show text-center' role='alert'>
            <strong>Tous les stages ont été distribués !</strong></div>";
        }else{
            echo'<select name="stage" class="custom-select ">
                     ';
                    while($user=$users->fetch()){
                        echo' <option value="'.$user["sid"].'">
                        '.$user["sid"].'-'.htmlspecialchars($user["titre"]).'
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
function selectionTuteurs($db,$typeTuteur){
        $SQL="SELECT uid,nom, prenom FROM users WHERE users.actif=true AND users.role='user'";
        try{
        $users=$db->prepare($SQL);
        $users->execute();
        if($users->rowCount()==0){
            echo "<div class='alert alert-info alert fade show text-center' role='alert'>
            <strong>Tous les tuteurs sont désactivés !</strong></div>";
        }else{
            echo'<select name="'.$typeTuteur.'" class="custom-select ">
                     ';
                    while($user=$users->fetch()){
                        echo' <option value="'.$user["uid"].'">
                        '.htmlspecialchars($user["nom"]).' '.htmlspecialchars($user["prenom"]).'
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

function selectionTuteur1($db){
    selectionTuteurs($db,"tuteur1Choisi");
}
function selectionTuteur2($db){
    selectionTuteurs($db,"tuteur2Choisi");
}
function selectionStageEtudiant($db){
    selectionStagesEtudiant($db);
}
function nouvelleSoutenance($idStage,$tuteur1,$tuteur2,$date,$salle){
    if(is_numeric($idStage)&&is_numeric($tuteur1)&&is_numeric($tuteur2)){
        return array(
            'sid'=> $idStage,
            'idT1' => $tuteur1,
            'idT2' => $tuteur2,
            'date' => $date,
            'salle' => htmlspecialchars($salle)
        );
    }
    return NULL;
}
function tuteursIdentiques($idT1,$idT2){
    return $idT1 === $idT2 ;
}
function message_tuteursIdentiques(){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Le tuteur principal ne peut pas être aussi tuteur secondaire !</strong>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
}
function ajoutSoutenance($db,$soutenance){
    $SQL="INSERT INTO soutenances (sid,tuteur1,tuteur2,date,salle)VALUES (?,?,?,?,?)";
    try{
    $requete=$db->prepare($SQL);
        $requete->execute(array($soutenance["sid"],$soutenance["idT1"],$soutenance["idT2"],$soutenance["date"],$soutenance["salle"]));
        if($requete->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ".$e->getMessage());
    }
}
function messageSucces_ajoutSoutenance(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Ajout de la soutenance réussi !</strong></div>";
}
function messageEchec_ajoutSoutenance(){
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Echec de l'ajout de la soutenance !</strong></div>";
}
function afficheAjoutSoutenanceForm($db){
echo'
       <div class="form-group row">
                <div class="col-md-12">
                    <label>Choix du stage d\'un étudiant</label>
                    ';
                    selectionStageEtudiant($db);
            echo'</div>
            </div>
        <div class="form-group row">
		    <div class="col-md-6">
                <label>Choix du tuteur principal</label>
              ';
            selectionTuteur1($db);
      echo     '</div>
            <div class="col-md-6">
                <label>Choix du tuteur secondaire</label>
                ';
             selectionTuteur2($db);
         echo'</div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
               <label>Date de la soutenance</label>
                    <input type="datetime-local"" name="datetime" class="form-control"  placeholder="date" required aria-required="true"
                    value="">
            </div>
            <div class="col-md-6">
               <label>Salle de la soutenance</label>
                    <input type="text" name="salle" class="form-control"  placeholder="Salle" required aria-required="true"
                    value="">
            </div>
        </div>
     ';
}
?>

