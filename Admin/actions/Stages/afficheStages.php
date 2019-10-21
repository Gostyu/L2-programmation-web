<?php
function modalSupprimerStage($idModal,$titre,$sid){
            echo '<div class="modal fade" id="supprimerStageModal'.$idModal.'">
          <div class="modal-dialog ">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Suppression d\'un gestionnaire administratif</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                Etes-vous sûr de vouloir supprimer le stage <strong>'.$titre.' ?</strong>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <a href="?sup_stage='.$sid.'"class="btn btn-primary">Valider</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
              </div>
            </div>
          </div>
        </div>';
}
function afficheStages($db){
    try{
    $SQL_stages="SELECT stages.sid,etudiants.nom, etudiants.prenom,stages.titre,stages.description,stages.entreprise,stages.tuteurE,stages.emailTE,IFNULL(users.nom,'Sans') AS Nom_tuteurP, IFNULL(users.prenom,'Tuteur') AS Prenom_tuteurP, stages.dateDebut,stages.dateFin FROM `stages` INNER JOIN etudiants ON stages.eid=etudiants.eid LEFT JOIN users ON stages.tuteurP = users.uid";
        $stages=$db->prepare($SQL_stages);
        $stages->execute();
        $idModal=0;
        echo'
        <h2>Stages</h2>
        <div class="row">
        <div class="col table table-responsive">
        <table class="table-striped table-bordered ">
                <thead>
                   <th>#</th>
                    <th>Etudiant</th>
                    <th>Titre de stage</th>
                    <th>Description</th>
                    <th>Entreprise</th>
                    <th>Tuteur du stage</th>
                    <th>Adresse mail</th>
                    <th>Pédagogie</th>
                    <th>Début et fin de stage</th>
                    <th>Supprimer</th>
                </thead>
            <tbody>';
        while($stage=$stages->fetch()){
            echo '<tr>
            <th scope="row">'.$stage["sid"].'</th>
            <td>'.$stage["nom"].' '.$stage["prenom"].'</td>
            <td>'.$stage["titre"].'</td>
            <td>'.$stage["description"].'</td>
            <td>'.$stage["entreprise"].'</td>
            <td>'.$stage["tuteurE"].'</td>
            <td>'.$stage["emailTE"].'</td>
            <td>'.$stage["Nom_tuteurP"].' '.$stage["Prenom_tuteurP"].'</td>
            <td>
                Du '.$stage["dateDebut"].' au '.$stage["dateFin"].'
            </td>
            <!-- Modal de confirmation de suppression d\' un gestionnaire-->
            ';
            modalSupprimerStage($idModal,$stage["titre"],$stage["sid"]);
            echo'<td>
                <!--<a href="?sup_stage='.$stage["sid"].'"class="btn btn-danger">Delete</a>-->
                <!--Bouton de confirmation de suppression d\'un stage-->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#supprimerStageModal'.$idModal.'">Suppimer</button>
            </td>
            </tr>
            ';
            $idModal++;
        }
        $stages->closeCursor();
        echo "</tbody>
            </table>
            </div>
            </div>";
    }catch(\PDOException $e){
        exit("Erreur dans la requête !".$e->getMessage());   
    }

}
?>       
