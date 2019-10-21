<?php 
function getEid($db){
    try{
     //vérification et récupération de l'ID etudiant lié au dossier de l'etudiant
    $SQL="SELECT stages.eid AS id_etudiant FROM stages WHERE stages.sid = ? ";
    $stage_eid = $db->prepare($SQL);
    $stage_eid->execute(array($_SESSION["reference"]));
        if($stage_eid->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("getEid : Erreur de la requête => ".$e->getMessage());
    }
}
function informations(){
     echo'
        <div class="alert alert-warning alert-dismissible fade show center">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
             </button>
            <strong>Veuillez ressaisir votre référence de dossier</strong>
        </div>';
}
function messageDossierInexistant(){
     echo'
        <div class="alert alert-danger alert-dismissible fade show center">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
             </button>
            <strong>Le dossier n\'existe pas.</strong>
        </div>';
}
function affiche_dossierEtudiant($db,$sid){    
try{
        $SQL="SELECT stages.titre, IFNULL(tp.nom,'En') AS nomTP, IFNULL(tp.prenom,'Attente d\'un tuteur pédagogique') AS prenomTP,
        IFNULL(t1.nom,'En') AS nomTuteur1, 
        IFNULL(t1.prenom,'Attente d\'un tuteur prinpical en soutenance')AS prenomTuteur1,
        IFNULL(t2.nom,'En')AS nomTuteur2,
        IFNULL(t2.prenom,'Attente d\'un tuteur secondaire en soutenance') AS prenomTuteur2,
        IFNULL(stid,'Pas de soutenance') AS idSoutenance,
        IFNULL(date,'En attente') AS dateSoutenance, 
        IFNULL(notes.note,'En attente') AS noteSoutenance, 
        IFNULL(notes.commentaire,'En attente') AS commentaireSoutenance
        FROM stages LEFT JOIN soutenances ON stages.sid=soutenances.sid LEFT JOIN users tp 
        ON stages.tuteurP=tp.uid LEFT JOIN users t1 ON tuteur1=t1.uid LEFT JOIN users t2 ON tuteur2=t2.uid LEFT JOIN notes
        ON soutenances.sid=notes.sid WHERE stages.sid=?";
        
        $requete=$db->prepare($SQL);
        $requete->execute(array($sid));
        if($requete->rowCount()==0){
            echo '<div class="alert alert-info text-center" role="alert">
                <strong>Vous n\'avez pas crée votre dossier étudiant !</strong>
            </div>';
        }else{
             echo '
      <h2 class="text-center">Dossier étudiant</h2>
      <div class="table-responsive text-center">
       <table class="table table-striped table-bordered">
        <thead>
            <th scope="col">Votre Stage</th>
            <th scope="col">Tuteur pédagogique</th>
            <th scope="col">Tuteur principal</th>
            <th scope="col">Tuteur secondaire</th>
            <th scope="col">Numéro de soutenance</th>
            <th scope="col">Date de soutenance</th>
            <th scope="col">Note</th>
            <th scope="col">Commentaire(s)</th>
        </thead>
        <tbody>';
                while($row=$requete->fetch()){
                    echo '
                    <tr class="text-center">
                        <th scope="row">'.$row["titre"].'</th>
                        <td scope="row">'.$row["nomTP"].' '.$row["prenomTP"].'</td>
                        <td scope="row">'.$row["nomTuteur1"].' '.$row["prenomTuteur1"].'</td>
                        <td scope="row">'.$row["nomTuteur2"].' '.$row["prenomTuteur2"].'</td>
                        <td scope="row">'.$row["idSoutenance"].'</td>
                        <td scope="row">'.$row["dateSoutenance"].'</td>
                        <td scope="row">'.$row["noteSoutenance"].'</td>
                        <td scope="row">'.$row["commentaireSoutenance"].'</td>
                    </tr>';
                }
            $requete->closeCursor();
            echo '
        </tbody>
    </table>
    </div>';
        }
    }catch(\PDOException $e){
          exit("Erreur de connexion à la base de données =>".$e->getMessage());
    }
}
?>