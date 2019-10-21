<?php 
    require_once("actions/Affectations/ajoutAffectationTuteurP.php"); 
    require_once("actions/Affectations/modifTuteurP.php");
function modalSupprimerAffectation($idModal,$affectation){
            echo '<div class="modal fade" id="supprimerAffectationModal'.$idModal.'">
          <div class="modal-dialog ">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Suppression d\'une affectation d\'un tuteur pédagogique</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                Etes-vous sûr de vouloir supprimer l\'affectation <strong>n°'.$affectation.' ?</strong>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <a href="?sup_affectation='.$affectation.'"class="btn btn-primary">Valider</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              </div>
            </div>
          </div>
        </div>';
}
function modalAjouterAffectation($db){
            echo '<div class="modal fade" id="ajouterAffectationModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Ajout d\'une affectation d\'un tuteur pédagogique</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                  <form method="get" id="formulaire">

              ';
            ajoutAffectationTuteurP_Form($db);
              echo'
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
               <!-- <a href="?ajoutAffectation=oui" class="btn btn-primary">Valider</a>-->
              <button type="submit" class="btn btn-primary">Valider</button>

              </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              </div>
            </div>
          </div>
        </div>';
}
function modalModifierTuteurAffectation($db,$idModal,$stage,$tuteur){
            echo '<div class="modal fade" id="modifierTuteurAffectationModal'.$idModal.'">
          <div class="modal-dialog ">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Changement du tuteur n°'.$tuteur.' du stage n°'.$stage.'</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <form method="get">
              <div class="modal-body">
                <input type="hidden" name="idStage" value="'.$stage.'">
                <input type="hidden" name="modifTuteurP" value="'.$tuteur.'">
                <h5>Choisissez un nouveau tuteur pédagogique</h5>
              ';
                selectionnerTuteur($db,$tuteur);
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
function afficheBouton_ajoutAffectation($db){
    modalAjouterAffectation($db);
    echo'<h2>Affectations</h2>
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#ajouterAffectationModal">Nouvelle affectation</button>'
    ;
}
function afficheAffectations($db){
    $SQL="SELECT sid,etudiants.nom AS nomEtu,etudiants.prenom AS prenomEtu,titre,tuteurP,users.nom AS Nom_tuteurP,users.prenom AS Prenom_tuteurP FROM stages INNER JOIN users ON stages.tuteurP=users.uid INNER JOIN 
etudiants ON stages.eid=etudiants.eid ORDER BY sid";
try{
        $affectations=$db->prepare($SQL);
        $affectations->execute();
        if($affectations->rowCount()==0){
            afficheBouton_ajoutAffectation($db);
            echo '<div class="alert alert-info text-center" role="alert">
                <strong>La liste des affectations est vide!</strong>
                (Vous pouvez ajouter des affectations ) 
            </div>';
        }else{
            $idModal=0;
            afficheBouton_ajoutAffectation($db);
            echo'
            <table class="table table-responsive table-striped table-bordered center">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Etudiant</th>
                <th scope="col">Stage</th>
                <th scope="col">idTuteurP</th>
                <th scope="col">Tuteur pédagogique</th>
                <th>Supprimer</th>
                </tr>
            </thead>
        <tbody>';
            while($affectation=$affectations->fetch()){
                echo '
                <tr>
                    <th scope="row">'.$affectation["sid"].'</th>
                    <td>'.$affectation["nomEtu"].' '.$affectation["prenomEtu"].'</td>
                    <td>'.$affectation["titre"].'</td>
                    <td>'.$affectation["tuteurP"].'</td>
                    <td>'.$affectation["Nom_tuteurP"].' '.$affectation["Prenom_tuteurP"].'
                        <!--<a href="?idStage='.$affectation["sid"].'&amp;modifTuteurP='.$affectation["tuteurP"].'"class="btn btn-warning">Modify</a>-->
                    ';
                    modalModifierTuteurAffectation($db,$idModal,$affectation["sid"],$affectation["tuteurP"]);
                    echo'
                        <!--Bouton de modification d\'une affectation de tuteur à un stage-->
                        <button data-toggle="modal" data-target="#modifierTuteurAffectationModal'.$idModal.'" class="btn btn-warning">Modifier</button>
                    </td>
                    ';
                    modalSupprimerAffectation($idModal,$affectation["sid"]);
                    echo'
                    <td>
                        <!--Bouton de suppression d\'une affectation de tuteur à un stage-->
                        <button class="btn btn-danger" data-toggle="modal" data-target="#supprimerAffectationModal'.$idModal.'">Supprimer</a>
                    </td>
                </tr>';
                $idModal++;
            }
            $affectations->closeCursor();
        echo' </tbody>
        </table>';
        }
}catch(\PDOException $e){
    exit("Echec de la connexion à la BD".$e->getMessage());
}

}

?>