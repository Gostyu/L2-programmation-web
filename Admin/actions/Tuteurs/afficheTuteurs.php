<?php 
function modalModifierMDP($idModal,$nom,$prenom,$uid){
        echo' <div class="modal fade" id="modifierMDPmodal-'.$idModal.'">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title text-center">Changement de mot passe du tuteur n°'.$uid.'</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <form method="post">
              <div class="modal-body">
                <div class="form-group">
                    <label for="inputNom">Nouveau mot de passe</label>	
                        <input type="password" name="nouveauMDP" class="form-control" id="inputLogin" required placeholder="Nouveau mot de passe" value="">
                </div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="modifierMDP" value="'.$uid.'">Valider</button>
              </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              </div>
            </div>
          </div>
        </div>';
}
function afficheTuteurs($db){
  try{
        $SQL_users="SELECT * FROM users where role='user'";
        $users = $db->prepare($SQL_users);
        $users->execute();  
$idModal=0;
     require_once("adduser_form.php");
    echo'<h2>Tuteurs</h2>
     <!-- <a href="?ajoutTuteur=oui" class="btn btn-primary mb-3">Nouveau Tuteur</a>-->
      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#ajoutTuteur">Nouveau Tuteur</button>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
               <th>#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Status(actif/passif)</th>
                <th>MDP actuel</th>
                <th>Modifier MDP</th>
            </thead>
        <tbody>';
        while($user=$users->fetch()){
            echo '
            <tr>
            <th scope="row">'.$user["uid"].'</th>
            <td>'.$user["nom"].'</td>
            <td>'.$user["prenom"].'</td>
            <td><strong>'.$user["actif"].'</strong>
            <a class="btn btn-primary" href="?statut_on='.$user["uid"].'">On</a>
                <a class="btn btn-danger" href="?statut_off='.$user["uid"].'">Off</a>
            </td>
            <td>'.$user["mdp"].'</td>
            ';
            modalModifierMDP($idModal,$user["nom"],$user["prenom"],$user["uid"]);
            echo'
            <td>
                <!--<a class="btn btn-warning" href="?modifierMDP='.$user['uid'].'">Modifier</a>-->
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modifierMDPmodal-'.$idModal.'"
                       name="modifierMDP" value="'.$user['uid'].'">Modifier</button>
            </td>
            </tr>';
            $idModal++;
        }
      $users->closeCursor();
        echo'
            </tbody>
        </table>
    </div>
</div>';
  }catch(\PDOException $e){
         exit("Erreur dans la requête !".$e->getMessage());
     }
}
?> 