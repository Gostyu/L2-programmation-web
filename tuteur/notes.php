<?php
function notation($sid,$note,$commentaire){
    if(is_numeric($note)&&$commentaire!=""){
       return array('soutenance'=>$sid,'note'=>$note,'commentaire'=>htmlspecialchars($commentaire));
    }
    return NULL;
}
function noterSoutenance($db,$notation){
    $SQL="INSERT INTO notes (sid,note,commentaire) VALUES (?,?,?)";
    try{
       $requete=$db->prepare($SQL);
       if(!empty($notation)){
           $requete->execute(array($notation["soutenance"],$notation["note"],$notation["commentaire"]));
        }
        if($requete->rowCount()==0){
            return -1;
        }else{
            return 0;
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion de la BD ".$e->getMessage());
    }
}
function modifierNote($db,$note,$soutenance){
    if(is_numeric($note)){
    $SQL="UPDATE notes SET note=? WHERE sid=?";
        try{
            $requete=$db->prepare($SQL);
            $requete->execute(array($note,$soutenance));
            if($requete->rowCount()==0){
                return -1;
            }else{
                return 0;
            }
        }catch(\PDOException $e){
            exit("Echec de la connexion de la BD ".$e->getMessage());
        }
    }
}
function modifierCommentaire($db,$commentaire,$soutenance){
    $SQL="UPDATE notes SET commentaire=? WHERE sid=?";
          try{
            $requete=$db->prepare($SQL);
            $requete->execute(array(htmlspecialchars($commentaire),$soutenance));
            if($requete->rowCount()==0){
                return -1;
            }else{
                return 0;
            }
        }catch(\PDOException $e){
            exit("Echec de la connexion de la BD ".$e->getMessage());
        }
}
function messageSucces_noterSoutenance(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>La notation de soutenance a bien été ajoutée !</strong></div>";
}
function messageEchec_noterSoutenance(){
     echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
         <span aria-hidden='true'>&times;</span>
        </button>
     <strong>Echec d'ajout de la notation de la soutenance !</strong></div>";
}
function messageSucces_nouvelleNote(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>La note a bien été modifiée !</strong></div>";
}
function messageEchec_nouvelleNote(){
     echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
         <span aria-hidden='true'>&times;</span>
        </button>
     <strong>Echec du changement de la note !</strong></div>";
}
function messageSucces_nouveauCommentaire(){
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
               <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                <span aria-hidden='true'>&times;</span>
               </button>
            <strong>Le commentaire a bien été modifié !</strong></div>";
}
function messageEchec_nouveauCommentaire(){
     echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
         <span aria-hidden='true'>&times;</span>
        </button>
     <strong>Echec du changement de commentaire !</strong></div>";
}
function notationSoutenance($db,$soutenance,$note,$commentaire){
    if(noterSoutenance($db,notation($soutenance,$note,$commentaire))!=0){
        messageEchec_noterSoutenance();
    }else{
        messageSucces_noterSoutenance();
    }
}
function nouvelleNote($db,$note,$idSoutenance){
        if(modifierNote($db,$note,$idSoutenance)!=0){
            messageEchec_nouvelleNote();
        }else{
            messageSucces_nouvelleNote();
        }
}
function nouveauCommentaire($db,$commentaire,$idCommentaire){
        if(modifierCommentaire($db,$commentaire,$idCommentaire)!=0){
            messageEchec_nouveauCommentaire();
        }else{
            messageSucces_nouveauCommentaire();
        }
}
function selectionStagesEtudiant($db){
     $SQL="SELECT stid AS soutenance,soutenances.sid,titre FROM notes RIGHT JOIN soutenances ON notes.sid = soutenances.sid 
     INNER JOIN stages ON soutenances.sid=stages.sid 
     WHERE (soutenances.tuteur1=? OR soutenances.tuteur2=?) AND (note IS NULL AND commentaire IS NULL)";
        try{
        $users=$db->prepare($SQL);
        $users->execute(array($_SESSION["tutor_id"],$_SESSION["tutor_id"]));
        if($users->rowCount()==0){
            echo "<div class='alert alert-info alert fade show text-center' role='alert'>
            <strong>Tous les stages auxquels vous avez participés sont notés  !</strong></div>";
        }else{
            echo'<select name="stageModal" class="custom-select ">
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
function modalNoterSoutenance($bd){
    echo'<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">Noter une soutenance</button>
            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg ">
                    <div class="modal-content">
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Noter une soutenance</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <!-- Modal body -->
            <form method="post">
                      <div class="modal-body form-group">
                        <label>Stage</label>
                        ';
                        selectionStagesEtudiant($bd);
                        echo'
                        <br><br/>
                        <div class="form-inline">
                            <label class="mr-2">Note</label>
                                <input type="text" name="noteModal" value="0"  class="form-control mr-sm-2" size="2">
                            <label class="mr-2">Commentaire</label>
                                <input type="text" name="commentaireModal" value="" class="form-control" placeholder="Ajouter un commentaire">
                        </div>
                      </div>
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="submit" name="ajouter" class="btn btn-primary">Valider</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                      </div>
                    </div>
                  </div>
                </form>
            </div>';
}
function afficheNotes($db){
    try{
    $SQL="SELECT nid,stid AS soutenance,soutenances.sid,titre,tuteur1,tuteur2, note AS noteStage, commentaire AS commentaireStage FROM notes
        INNER JOIN soutenances ON notes.sid = soutenances.sid INNER JOIN stages ON 
        soutenances.sid=stages.sid WHERE soutenances.tuteur1=? OR soutenances.tuteur2=?";
        $notes = $db->prepare($SQL);
        $notes->execute(array($_SESSION["tutor_id"],$_SESSION["tutor_id"]));
            if($notes->rowCount()==0){
                  echo '<h2>La liste des notes de stage lié à la soutenance</h2>';
                modalNoterSoutenance($db);  
                echo'
                  <div class="alert alert-info text-center" role="alert">
                <strong>Liste indisponible !</strong>
                </div>';
            }else{
            echo'
            <h2>La liste des notes de stage lié à la soutenance</h2>
            <!--Modal d\'ajout de notation de soutenance-->
            ';
              modalNoterSoutenance($db);  
            echo '    
            <table class="table table-responsive table-striped table-bordered center">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th>Titre du stage</th>
                    <th>Notes</th>
                    <th>Commentaires</th>
                    </tr>
                </thead>
            <tbody>';
            $i=0;
            while($note=$notes->fetch()){
                echo '
                <tr>
                    <th scope="row">'.$note["nid"].'</th>
                    <td>'.$note["titre"].'</td>
                    <td>'.$note["noteStage"].'
                    <button data-toggle="collapse" data-target="#formNote'.$i.'" class="btn btn-warning">Modifier</button>
                    <br></br>
                     <div id="formNote'.$i.'" class="collapse">
                        <form method="post">
                            <input type="text" name="note" value="'.$note["noteStage"].'" class="form-control form-control-sm">
                            <input type="hidden" name="idNote" value="'.$note["sid"].'">
                        <button type="submit" name="valider" class="btn btn-primary">Valider</button>
                        </form>
                     </div>
                    </td>
                    <td>'.$note["commentaireStage"].'
                    <button data-toggle="collapse" data-target="#formCommentaire'.$i.'" class="btn btn-warning">Modifier</button>
                    <br></br>
                     <div id="formCommentaire'.$i.'" class="collapse">
                        <form method="post">
                            <input type="text" name="commentaire" value="'.$note["commentaireStage"].'" class="form-control">
                            <input type="hidden" name="idCommentaire" value="'.$note["sid"].'">
                            <button type="submit" name="valider2" class="btn btn-primary">Valider</button>
                        </form>
                      </div>
                    </td>
                </tr>';
                $i++;
            }
            echo '</tbody>
            </table>';
            }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD. => ".$e->getMessage());
    }
  }
?>