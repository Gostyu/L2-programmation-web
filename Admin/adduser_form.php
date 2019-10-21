<p class="error"><?= $error??""?></p>
<!-- Modal -->
<div class="modal fade" id="ajoutTuteur"  role="dialog" aria-labelledby="modalAjoutTuteurLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAjoutTuteurLabel">Ajout d'un utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="post" id="formulaire">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Nom</label>
                        <input type="text" name="nom" class="form-control"  placeholder="Nom" required value="<?= $data['nom']??""?>"
                        >
                    </div>
                    <div class="col-md-6">
                       <label>Prénom</label>
                        <input type="text" name="prenom" class="form-control"  placeholder="Prénom" required aria-required="true" value="<?= $data['prenom']??""?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">       
                        <label>Login</label>
                        <input type="text" name="login" class="form-control" placeholder="Login" required value="<?= $data['login']??""?>">
                    </div>
                </div>
                  <div class="form-group row">
                    <div class="col-md-6">
                        <label>Mot de passe</label>
                      <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required value="">
                    </div>
                    <div class="col-md-6">
                           <label for="inputMDP2">Répéter le mot de passe</label>
                           <input type="password" name="mdp2" class="form-control"  placeholder="Répéter le mot de passe" required value="">
                        </div>
                    </div>
                    <div class="form-group row center">
                      <div class="col">
                       <button type="submit" name="ajoutTuteur" class="btn btn-primary">Valider ajout</button>
                       </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
  </div>