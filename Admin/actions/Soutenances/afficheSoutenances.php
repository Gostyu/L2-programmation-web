<?php
 require_once("modifTuteurN.php");
 require_once("ajoutSoutenance.php");
function modalSupprimerSoutenance($idModal,$soutenance){
            echo '<div class="modal fade" id="supprimerSoutenanceModal'.$idModal.'">
          <div class="modal-dialog ">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Suppression d\'une soutenance</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                Etes-vous sûr de vouloir supprimer la soutenance <strong>n°'.$soutenance.' ?</strong>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <a href="?sup_soutenance='.$soutenance.'"class="btn btn-primary">Valider</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              </div>
            </div>
          </div>
        </div>';
}
function modalAjouterSoutenance($db){
        echo' 
        <div class="modal fade" id="ajouterGestionnaireModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Ajout d\'une nouvelle soutenance</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
            <form method="get" id="formulaire">
              <div class="modal-body">
              ';
               afficheAjoutSoutenanceForm($db);
             echo '
                </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              </div>
            </div>
          </div>
        </div>';
}
function modalModifier($db,$typeTuteur,$attributID,$attributName,$idModal,$stid,$idTN){
     echo' 
        <div class="modal fade" id="'.$attributID.''.$idModal.'">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Changement du tuteur '.$typeTuteur.'</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
            <form method="get" id="formulaire">
            <div class="modal-body">
                <input type="hidden" name="idSoutenance" value="'.$stid.'">
                <input type="hidden" name="'.$attributName.'" value="'.$idTN.'">
                <h5>Choisissez un nouveau tuteur '.$typeTuteur.'</h5>

              ';
               modifTuteurNForm($db,$typeTuteur);
             echo '
                </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              </div>
            </div>
          </div>
        </div>';
}
function modalModifierTuteur($typeTuteur,$db,$idModal,$stid,$idTN){
        $attributID="";
        $attributName="";
        if(strcmp($typeTuteur,"principal")==0){
            $attributID="modifierT1Soutenance";
            $attributName="modifT1";
            modalModifier($db,$typeTuteur,$attributID,$attributName,$idModal,$stid,$idTN);
        }else if(strcmp($typeTuteur,"secondaire")==0){
            $attributID="modifierT2Soutenance";
            $attributName="modifT2";
            modalModifier($db,$typeTuteur,$attributID,$attributName,$idModal,$stid,$idTN);
        }
}
function afficheBouton_ajoutSoutenance($db){
   modalAjouterSoutenance($db);
  echo' <h2>Soutenances</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#ajouterGestionnaireModal">Nouvelle soutenance</button>';
}
function afficheSoutenances($db){
    try{
    $SQL ="SELECT stid,salle,soutenances.date,tuteur1 AS idT1, t1.nom AS nomTuteur1,t1.prenom AS prenomTuteur1,tuteur2 AS idT2,t2.nom AS nomTuteur2,t2.prenom AS prenomTuteur2 FROM soutenances INNER JOIN stages ON soutenances.sid=stages.sid INNER JOIN users t1 ON soutenances.tuteur1=t1.uid INNER JOIN users t2 ON soutenances.tuteur2=t2.uid ORDER BY date";
        $soutenances=$db->prepare($SQL);
        $soutenances->execute();
        if($soutenances->rowCount()==0){
            afficheBouton_ajoutSoutenance($db);
            echo '<div class="alert alert-info text-center" role="alert">
                <strong>Action indisponible !</strong>
            </div>';
        }else{
            $idModal=0;
            afficheBouton_ajoutSoutenance($db);
            echo'
            <table class="table table-responsive table-striped table-bordered center">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th>Date</th>
                <th colspan=2>Tuteur principal et tuteur secondaire</th>
                <th>Salle de la soutenance</th>
                <th>Supprimer</th>
                </tr>
            </thead>
        <tbody>';
            while($soutenance=$soutenances->fetch()){
                echo '
                <tr>
                    <th scope="row">'.$soutenance["stid"].'</th>
                    <td>'.$soutenance["date"].'</td>
                    <td>'.$soutenance["nomTuteur1"].' '.$soutenance["prenomTuteur1"].'
                       <!-- <a href="?idSoutenance='.$soutenance["stid"].'&amp;modifT1='.$soutenance["idT1"].'"class="btn btn-warning">Modify</a>-->
                       ';
                        modalModifierTuteur("principal",$db,$idModal,$soutenance["stid"],$soutenance["idT1"]);
                        echo'
                        <!--Bouton de modification d\'un tuteur principal d\'une soutenance-->
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modifierT1Soutenance'.$idModal.'">Modifier</button>
                    </td>
                    <td>'.$soutenance["nomTuteur2"].' '.$soutenance["prenomTuteur2"].'
                       <!-- <a href="?idSoutenance='.$soutenance["stid"].'&amp;modifT2='.$soutenance["idT2"].'"class="btn btn-warning">Modify</a>-->
                       ';
                    modalModifierTuteur("secondaire",$db,$idModal,$soutenance["stid"],$soutenance["idT2"]);
                    echo'
                       <!--Bouton de modification d\'un tuteur secondaire d\'une soutenance-->
                       <button class="btn btn-warning" data-toggle="modal" data-target="#modifierT2Soutenance'.$idModal.'">Modifier</button>
                    </td>
                    <td>'.$soutenance["salle"].'</td>
                    ';
                    modalSupprimerSoutenance($idModal,$soutenance["stid"]);
                    echo'<td>
                        <!--Bouton de suppression d\'une soutenance-->
                        <button class="btn btn-danger" data-toggle="modal" data-target="#supprimerSoutenanceModal'.$idModal.'">Supprimer</button>
                    </td>
                </tr>';
                $idModal++;
            }
            $soutenances->closeCursor();
        echo' </tbody>
        </table>';
        }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD !".$e->getMessage());
    }
}
?>