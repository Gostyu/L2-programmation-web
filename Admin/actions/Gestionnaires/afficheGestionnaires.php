<?php
function afficheGestionnaireForm(){
echo '
        <div class="form-group row">
		    <div class="col-md-6">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control"  placeholder="Nom" required value="">
            </div>
            <div class="col-md-6">
               <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" required aria-required="true"
                value="">
            </div>
        </div>
      <div class="form-group row">
        <div class="col-md-12">
               <label>Email</label>
                    <input type="email" name="email" class="form-control"  placeholder="Email" required aria-required="true"
                    value="">
        </div>
    </div>
    ';
}
function modalSupprimerGestionnaire($idModal,$nom,$prenom,$gid){
        echo' <div class="modal fade" id="supprimerGestionnaireModal'.$idModal.'">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Suppression d\'un gestionnaire administratif</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                Etes-vous sûr de vouloir supprimer le gestionnaire <strong>'.$nom.' '.$prenom.'</strong> ?
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <a href="?sup_gestionnaire='.$gid.'"class="btn btn-primary">Valider</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              </div>
            </div>
          </div>
        </div>';
}
function modalAjouterGestionnaire(){
        echo' <div class="modal fade" id="ajouterGestionnaireModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Ajout d\'un nouveau gestionnaire</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
            <form method="get" id="formulaire">
              <div class="modal-body">
              ';
                afficheGestionnaireForm();
             echo '
                </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                    <button type="submit" name="ajoutGestionnaire" value="ok" class="btn btn-primary">Valider</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              </div>
            </div>
          </div>
        </div>';
}
function afficheBouton_ajoutGestionnaire(){
    modalAjouterGestionnaire();
    echo'<h2>Gestionnaires Administatifs</h2>
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#ajouterGestionnaireModal">Nouveau gestionnaire</button>';
}
function afficheGestionnaires($db){
    try{
    $SQL="SELECT * FROM gestionnaires";
        $gestionnaires=$db->prepare($SQL);
        $gestionnaires->execute();
    if($gestionnaires->rowCount()==0){
        afficheBouton_ajoutGestionnaire();
    echo '<div class="alert alert-info text-center" role="alert">
        <strong>Action indisponible !</strong>
        </div>';
    }else{  
        $idModal=0;
        afficheBouton_ajoutGestionnaire();
    echo'
        <table class="table table-responsive table-striped table-bordered center">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Token</th>
                <th>Supprimer</th>
                </tr>
            </thead>
        <tbody>';
            while($gestionnaire=$gestionnaires->fetch()){
                echo '
                <tr>
                    <th scope="row">'.$gestionnaire["gid"].'</th>
                    <td>'.$gestionnaire["nom"].'</td>
                    <td>'.$gestionnaire["prenom"].'</td>
                    <td>'.$gestionnaire["email"].'</td>
                    <td>'.$gestionnaire["token"].'
                        <a href="?regenerer='.$gestionnaire["gid"].'"class="btn btn-primary">Regénérer</a>
                    </td>
                        <!-- Modal de confirmation de suppression d\' un gestionnaire-->
                    ';
                    modalSupprimerGestionnaire($idModal,$gestionnaire["nom"],$gestionnaire["prenom"],$gestionnaire["gid"]);
                    echo'
                    <td>
                        <!-- Bouton qui affiche le modal de confirmation de suppression d\' un gestionnaire-->
                        <button class="btn btn-danger" data-toggle="modal" data-target="#supprimerGestionnaireModal'.$idModal.'">Supprimer</a>
                    </td>
                </tr>';
                $idModal++;
            }
            $gestionnaires->closeCursor();
        echo' </tbody>
        </table>';
    }
    }catch(\PDOException $e){
        exit("Echec de la connexion à la BD ! ".$e->getMessage());
    }
}
?>